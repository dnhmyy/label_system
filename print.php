<?php

require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// 1. Ambil data dari form
$fn = $_POST['fn'] ?? '';
$prod_date = $_POST['prod_date'] ?? '';
$bb_date = $_POST['bb_date'] ?? '';
$qty = (int) ($_POST['qty'] ?? 1);

// Security & Performance: Batasi jumlah cetak (max 200)
if ($qty > 200) {
    echo "Jumlah label terlalu banyak (maksimal 200), pastikan printer/server bisa handle.";
    exit;
}
$qty = max(1, $qty);

// Input dari form sekarang adalah format DD/MM/YYYY
function parseCustomDate($dateStr)
{
    if (empty($dateStr))
        return '';
    $dateObj = DateTime::createFromFormat('Y-m-d', $dateStr);
    return $dateObj ? $dateObj->format('d/m/Y') : $dateStr;
}

function normalizeBarcodePart($value)
{
    $value = trim($value);
    $value = preg_replace('/\s+/', ' ', $value);
    return strtoupper($value);
}

$prod_date_formatted = parseCustomDate($prod_date);
$bb_date_formatted = parseCustomDate($bb_date);

// 2. Setup mPDF
// Ukuran kertas custom: 40mm x 30mm
$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => [40, 30],
    'margin_left' => 2.5,
    'margin_right' => 1.5,
    'margin_top' => 1,
    'margin_bottom' => 0.5,
    'default_font_size' => 10,
    'default_font' => 'Arial'
]);

// Logic Font Size Otomatis
// Base size 14pt. Jika text panjang, font mengecil.
$char_len = strlen($fn);
$font_size_pt = 14;

if ($char_len > 12) {
    $scale_factor = 12 / $char_len;
    $font_size_pt = max(6, 14 * $scale_factor); // Min 6pt biar terbaca
}

// Sanitasi input sekali saja
$safe_fn = htmlspecialchars($fn);
$safe_prod = htmlspecialchars($prod_date_formatted);
$safe_bb = htmlspecialchars($bb_date_formatted);

// Barcode value: kombinasi nama produk + tanggal produksi + tanggal BB
$barcode_value = sprintf(
    'FN:%s|P:%s|BB:%s',
    normalizeBarcodePart($fn),
    normalizeBarcodePart($prod_date),
    normalizeBarcodePart($bb_date)
);
$safe_barcode_value = htmlspecialchars($barcode_value, ENT_QUOTES);

// 3. Template HTML Label - satu blok utuh per halaman
// Layout: Rata kiri, tabel 3 baris dengan tinggi fixed
// agar konten terdistribusi rata tengah secara vertikal
$full_label_html = "
<style>
    @page {
        margin: 0;
        size: 40mm 30mm;
    }
    body {
        font-family: 'Times New Roman', serif;
        margin: 0;
        padding: 0;
    }
    .label-table {
        width: 100%;
        height: 20mm;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .label-table td {
        text-align: left;
        padding-left: 1.5mm;
        padding-right: 0;
    }
    /* Baris 1: Nama Produk - 8mm */
    .td-product {
        height: 8mm;
        vertical-align: middle;
    }
    .product-name {
        font-weight: bold;
        font-size: {$font_size_pt}pt;
        line-height: 1.1;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border-bottom: 1.5px solid #000;
        padding-bottom: 0.8mm;
        white-space: nowrap;
    }
    /* Baris 2: Tanggal P & BB - 12mm */
    .td-dates {
        height: 12mm;
        vertical-align: middle;
    }
    .line {
        font-size: 9.5pt;
        white-space: nowrap;
        line-height: 1.4;
    }
    .line strong {
        font-weight: bold;
    }
    .barcode-wrap {
        width: 100%;
        margin: 0;
        padding: 0;
        text-align: left;
        padding-left: 1.5mm;
        padding-top: 1.5mm;
    }
</style>
<table class='label-table'>
    <tr>
        <td class='td-product'>
            <div class='product-name'>{$safe_fn}</div>
        </td>
    </tr>
    <tr>
        <td class='td-dates'>
            <div class='line'><strong>P:</strong> {$safe_prod}</div>
            <div class='line'><strong>BB:</strong> {$safe_bb}</div>
        </td>
        
    </tr>
</table>
<div class='barcode-wrap'>
    <barcode
        code='{$safe_barcode_value}'
        type='C128B'
        height='0.5'
        size='0.55'
        quiet_zone_left='0'
        quiet_zone_right='0'
        style='margin: 0; padding: 0;'
    />
</div>
";

// 4. Render halaman pertama
$mpdf->WriteHTML($full_label_html);

// 5. Loop halaman ke-2 dst: AddPage() lalu tulis ulang HTML lengkap
for ($i = 1; $i < $qty; $i++) {
    $mpdf->AddPage();
    $mpdf->WriteHTML($full_label_html);
}

// 6. Output PDF (Inline di browser)
$filename = 'label-' . date('YmdHis') . '.pdf';
$mpdf->Output($filename, 'I');
