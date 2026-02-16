# Sistem Label Produksi Dapur

Sistem web sederhana untuk mencetak label produk dapur (40mm x 30mm) menggunakan PHP 8 dan mPDF, dirancang untuk printer thermal Xprinter XP-D4601B.

## Fitur
- **Minimalis Frontend:** Form input bersih dan responsif.
- **Auto PDF Generation:** Langsung membuat file PDF siap cetak.
- **Custom Size:** Ukuran pas 40mm x 30mm tanpa margin error.
- **Batch Print:** Bisa set jumlah label (Qty) dan otomatis menjadi halaman-halaman dalam satu PDF.

## Struktur Project
```
label-system/
│
├── index.php       # Form Input
├── print.php       # Logic Generate PDF
├── composer.json   # Dependency
├── README.md       # Dokumentasi ini
└── vendor/         # Library mPDF (hasil install composer)
```

## Persyaratan
- PHP 8.0 atau lebih baru.
- Ekstensi PHP GD (`php-gd`) aktif.
- Composer.

## Cara Install

1. **Clone/Download Project ini**.
2. **Install Dependency** menggunakan Composer:
   Buka terminal di folder project dan jalankan:
   ```bash
   composer install
   ```
   Ini akan mengunduh library mPDF ke dalam folder `vendor/`.

## Cara Menjalankan (Localhost)

Cara termudah adalah menggunakan PHP built-in server:

1. Buka terminal di folder project.
2. Jalankan perintah:
   ```bash
   php -S localhost:8000
   ```
3. Buka browser dan akses:
   `http://localhost:8000`

## Cara Penggunaan
1. Isi **Nama Produk** (contoh: Sambal Ijo).
2. Isi **Tanggal Produksi** (otomatis hari ini).
3. Isi **Tanggal Best Before**.
4. Isi **Jumlah Cetak** (misal: 5).
5. Klik **Generate & Print**.
6. Tab baru akan terbuka berisi PDF.
7. Tekan `Ctrl + P` (Print) di browser.
   - **Destination:** Pilih Xprinter XP-D4601B Anda.
   - **Paper Size:** Pastikan terdeteksi 40mm x 30mm (atau User Defined).
   - **Margins:** None (Kososngkan/Minimum).
   - **Scale:** Default / 100%.

## Konfigurasi mPDF
Konfigurasi inti ada di file `print.php`:

```php
$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => [40, 30], // Ukuran [Lebar, Tinggi] dalam mm
    'margin_left' => 1,
    'margin_right' => 1,
    'margin_top' => 1,
    'margin_bottom' => 1,
]);
```

## CSS @page
Agar margin benar-benar 0 saat dicetak:
```css
@page {
    margin: 0;
}
```

## Deployment ke Server / Docker

### Nginx / Apache
Upload semua file (termasuk folder `vendor` jika tidak bisa akses composer di server, atau jalankan `composer install` di server).
Pastikan folder memiliki permission yang sesuai.

### Docker (Contoh Dockerfile Sederhana)
```dockerfile
FROM php:8.1-apache
WORKDIR /var/www/html
COPY . .
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev && docker-php-ext-install gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev
EXPOSE 80
```
