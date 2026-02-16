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
$qty = (int)($_POST['qty'] ?? 1);

// Format tanggal agar lebih mudah dibaca
// Sekarang input dari form menggunakan format d/m/Y
$prod_dt = DateTime::createFromFormat('d/m/Y', $prod_date);
$bb_dt = DateTime::createFromFormat('d/m/Y', $bb_date);

$prod_date_formatted = $prod_dt ? $prod_dt->format('d/m/Y') : $prod_date;
$bb_date_formatted = $bb_dt ? $bb_dt->format('d/m/Y') : $bb_date;

// 2. Setup mPDF
// Ukuran kertas custom: 40mm x 30mm
// Margin: 0 agar full content
$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => [40, 30], 
    'margin_left' => 1,
    'margin_right' => 1,
    'margin_top' => 1,
    'margin_bottom' => 1,
    'default_font_size' => 10,
    'default_font' => 'Arial'
]);

// Logic Font Size Otomatis
// Base size 15pt. Jika text panjang, font mengecil.
$full_text = "FN – " . $fn;
$char_len = strlen($fn); // Hitung panjang nama produk saja atau full text
$font_size_pt = 15; // Default

// Ambang batas karakter sebelum mengecil (kira-kira 15 char untuk 40mm)
if ($char_len > 12) {
    // Rumus scaling sederhana
    // Semakin panjang, semakin kecil
    $scale_factor = 12 / $char_len; 
    $font_size_pt = max(6, 15 * $scale_factor); // Min 6pt biar terbaca
}

// 3. Template HTML Label
// Styling CSS inline untuk memastikan layout pas di ukuran kecil
$html_content = "
<style>
    @page {
        margin: 0;
    }
    body {
        font-family: 'Times New Roman', serif;
        margin: 0;
        padding: 0;
        text-align: center;
    }
    /* Layout Baru dengan Tabel Baris */
    .layout-table {
        width: 100%;
        height: 28mm; /* Tentukan tinggi tetap mendekati ukuran kertas (30mm) */
        border-collapse: collapse;
        table-layout: fixed;
    }
    .layout-table td {
        text-align: center;
        vertical-align: middle;
        padding: 0;
    }
    
    /* Baris 1: Produk */
    .td-product {
        height: 12mm; /* Tinggi ditambah agar bisa menampung <br> */
        vertical-align: bottom;
        padding-bottom: 1mm;
    }
    
    /* Baris 2: Sudah dihapus, diganti border pada .product-name */

    /* Baris 3: Tanggal */
    .td-date {
        height: 14mm; /* Tinggi tetap untuk area tanggal */
        vertical-align: middle; 
        padding-top: 2mm;
    }

    .product-name {
        font-weight: bold;
        font-size: {$font_size_pt}pt; 
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block; /* Agar lebar sesuai teks saja */
        border-bottom: 2px solid #000; /* Garis pas di bawah tulisan */
        padding-bottom: 1mm; /* Jarak teks ke garis */
        margin-bottom: 2mm; /* Jarak garis ke bawah */
        white-space: nowrap; 
    }
    .line {
        font-size: 11pt;
        white-space: nowrap;
        line-height: 1.4;
        margin-bottom: 1px;
    }
    .line strong {
        font-weight: bold;
        margin-right: 2px;
    }
</style>
";

// Body content - Gunakan row TR terpisah agar 'forced' spacing-nya jalan
$label_body = "
<table class='layout-table'>
    <!-- Row 1: Produk -->
    <tr>
        <td class='td-product'>
            <div class='product-name'>" . htmlspecialchars($fn) . "</div>
            <br/> <!-- Menambah jarak sesuai permintaan -->
        </td>
    </tr>

    <!-- Row 3: Tanggal -->
    <tr>
        <td class='td-date'>
            <div class='line'><strong>P:</strong> " . $prod_date_formatted . "</div>
            <div class='line'><strong>BB:</strong> " . $bb_date_formatted . "</div>
        </td>
    </tr>
</table>
";

// 4. Output Styles & Loop create label pages
$mpdf->WriteHTML($html_content); // Write CSS once

for ($i = 0; $i < $qty; $i++) {
    if ($i > 0) {
        $mpdf->AddPage();
    }
    $mpdf->WriteHTML($label_body);
}

// 5. Output PDF (Inline di browser)
$filename = 'label-' . date('YmdHis') . '.pdf';
$mpdf->Output($filename, 'I'); 

