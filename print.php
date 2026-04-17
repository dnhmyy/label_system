<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/security.php';

use Mpdf\Mpdf;

// bootstrap security settings
bootstrapPageSecurity(false);

// enforce POST and check CSRF
enforceMethod('POST');
verifyCsrfToken($_POST['csrf_token'] ?? null);

// sanitize & validate inputs
$fn = sanitizeProductName($_POST['fn'] ?? '');
$prod_date = validateIsoDate($_POST['prod_date'] ?? '', 'Tanggal Produksi');
$bb_date = validateIsoDate($_POST['bb_date'] ?? '', 'Tanggal Best Before');
$qty = validateQty($_POST['qty'] ?? 1);

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

// label page setup
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

// shrink long product names to fit the label
$char_len = strlen($fn);
$font_size_pt = 14;

if ($char_len > 12) {
    $scale_factor = 12 / $char_len;
    $font_size_pt = max(6, 14 * $scale_factor);
}

// escape display values once
$safe_fn = htmlspecialchars($fn);
$safe_prod = htmlspecialchars($prod_date_formatted);
$safe_bb = htmlspecialchars($bb_date_formatted);

function get_initials($text) {
    if (empty($text)) return "";
    $words = preg_split('/[\s-]+/', $text, -1, PREG_SPLIT_NO_EMPTY);
    $initials = "";
    foreach ($words as $w) {
        $initials .= strtoupper($w[0]);
    }
    return $initials;
}

// keep barcode content stable across preview and pdf
$initials = get_initials($fn);
$date_part = substr(str_replace('-', '', $prod_date), 2); // YYMMDD
$barcode_value = $initials ? "{$initials}-{$date_part}" : $date_part;
$safe_barcode_value = htmlspecialchars($barcode_value, ENT_QUOTES);

$barcode_size = 0.55;

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
    /* product line */
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
    /* date block */
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
        size='{$barcode_size}'
        quiet_zone_left='0'
        quiet_zone_right='0'
        style='margin: 0; padding: 0;'
    />
</div>
";

$mpdf->WriteHTML($full_label_html);

// duplicate the label for the remaining pages
for ($i = 1; $i < $qty; $i++) {
    $mpdf->AddPage();
    $mpdf->WriteHTML($full_label_html);
}

$filename = 'label-' . date('YmdHis') . '.pdf';
$mpdf->Output($filename, 'I');
