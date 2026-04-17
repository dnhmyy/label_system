<?php

declare(strict_types=1);

const APP_MAX_QTY = 200;
const APP_MAX_POST_BYTES = 16384;

function isSecureRequest(): bool
{
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        return true;
    }

    if (!empty($_SERVER['SERVER_PORT']) && (string) $_SERVER['SERVER_PORT'] === '443') {
        return true;
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        return strtolower((string) $_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https';
    }

    return false;
}

function isLocalRequest(): bool
{
    $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
    $serverName = strtolower((string) ($_SERVER['SERVER_NAME'] ?? ''));
    $remoteAddr = (string) ($_SERVER['REMOTE_ADDR'] ?? '');

    $localHosts = ['localhost', '127.0.0.1', '::1'];

    foreach ($localHosts as $localHost) {
        if (str_starts_with($host, $localHost) || $serverName === $localHost || $remoteAddr === $localHost) {
            return true;
        }
    }

    return false;
}

function enforceHttps(): void
{
    if (isSecureRequest() || isLocalRequest()) {
        return;
    }

    $host = (string) ($_SERVER['HTTP_HOST'] ?? '');
    $requestUri = (string) ($_SERVER['REQUEST_URI'] ?? '/');

    if ($host === '') {
        return;
    }

    header('Location: https://' . $host . $requestUri, true, 301);
    exit;
}

function applyRuntimeSecurityIni(): void
{
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
    ini_set('html_errors', '0');
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Strict');
    ini_set('expose_php', '0');
}

function startSecureSession(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_name('label_session');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => isSecureRequest(),
        'httponly' => true,
        'samesite' => 'Strict',
    ]);

    session_start();

    if (!isset($_SESSION['session_initialized'])) {
        session_regenerate_id(true);
        $_SESSION['session_initialized'] = time();
    }
}

function buildCsp(string $nonce): string
{
    $directives = [
        "default-src 'self'",
        "base-uri 'none'",
        "frame-ancestors 'none'",
        "form-action 'self'",
        "object-src 'none'",
        "img-src 'self' data:",
        "font-src 'self' https://fonts.gstatic.com",
        "style-src 'self' 'nonce-{$nonce}' https://fonts.googleapis.com",
        "script-src 'self' 'nonce-{$nonce}'",
        "connect-src 'self'",
        "manifest-src 'self'",
        "worker-src 'none'",
    ];

    if (isSecureRequest()) {
        $directives[] = 'upgrade-insecure-requests';
    }

    return implode('; ', $directives);
}

function applySecurityHeaders(?string $nonce = null, string $contentType = 'text/html; charset=UTF-8'): void
{
    header('Content-Type: ' . $contentType);
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    header('Referrer-Policy: no-referrer');
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Cross-Origin-Opener-Policy: same-origin');
    header('Cross-Origin-Resource-Policy: same-origin');
    header('Permissions-Policy: accelerometer=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()');

    if ($nonce !== null) {
        header('Content-Security-Policy: ' . buildCsp($nonce));
    }

    if (isSecureRequest()) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

function bootstrapPageSecurity(bool $withCsp = true, string $contentType = 'text/html; charset=UTF-8'): array
{
    applyRuntimeSecurityIni();
    enforceHttps();
    startSecureSession();

    $nonce = $withCsp ? base64_encode(random_bytes(18)) : null;
    applySecurityHeaders($nonce, $contentType);

    return ['nonce' => $nonce];
}

function rejectRequest(int $statusCode, string $message = 'Permintaan tidak valid.'): void
{
    http_response_code($statusCode);
    header('Content-Type: text/plain; charset=UTF-8');
    echo $message;
    exit;
}

function enforceMethod(string $expectedMethod): void
{
    $requestMethod = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));

    if ($requestMethod !== strtoupper($expectedMethod)) {
        rejectRequest(405, 'Method tidak diizinkan.');
    }
}

function enforcePostSizeLimit(int $maxBytes = APP_MAX_POST_BYTES): void
{
    $contentLength = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);

    if ($contentLength > $maxBytes) {
        rejectRequest(413, 'Payload terlalu besar.');
    }
}

function rateLimit(string $bucket, int $limit, int $windowSeconds): void
{
    $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    $dir = sys_get_temp_dir() . '/label-rate-limit';

    if (!is_dir($dir) && !mkdir($dir, 0700, true) && !is_dir($dir)) {
        rejectRequest(500, 'Gagal memproses permintaan.');
    }

    $file = $dir . '/' . hash('sha256', $bucket . '|' . $ip) . '.json';
    $handle = fopen($file, 'c+');

    if ($handle === false) {
        rejectRequest(500, 'Gagal memproses permintaan.');
    }

    flock($handle, LOCK_EX);
    $raw = stream_get_contents($handle);
    $data = json_decode($raw ?: '[]', true);

    if (!is_array($data)) {
        $data = [];
    }

    $now = time();
    $validEntries = [];

    foreach ($data as $timestamp) {
        if (is_int($timestamp) && $timestamp >= ($now - $windowSeconds)) {
            $validEntries[] = $timestamp;
        }
    }

    if (count($validEntries) >= $limit) {
        flock($handle, LOCK_UN);
        fclose($handle);
        rejectRequest(429, 'Terlalu banyak permintaan. Coba lagi sebentar.');
    }

    $validEntries[] = $now;

    rewind($handle);
    ftruncate($handle, 0);
    fwrite($handle, json_encode($validEntries, JSON_THROW_ON_ERROR));
    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['csrf_token'];
}

function verifyCsrfToken(?string $providedToken): void
{
    $sessionToken = (string) ($_SESSION['csrf_token'] ?? '');

    if ($sessionToken === '' || !is_string($providedToken) || !hash_equals($sessionToken, $providedToken)) {
        rejectRequest(403, 'Token keamanan tidak valid.');
    }
}

function sanitizeProductName(string $value): string
{
    $value = trim(preg_replace('/\s+/u', ' ', $value) ?? '');

    if ($value === '' || mb_strlen($value, 'UTF-8') > 80) {
        rejectRequest(422, 'Nama produk tidak valid.');
    }

    if (!preg_match('/^[\p{L}\p{N}\s\-\.,&\/()+]+$/u', $value)) {
        rejectRequest(422, 'Nama produk tidak valid.');
    }

    return $value;
}

function validateIsoDate(string $value, string $fieldLabel): string
{
    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value);
    $errors = DateTimeImmutable::getLastErrors();
    $warningCount = is_array($errors) ? (int) ($errors['warning_count'] ?? 0) : 0;
    $errorCount = is_array($errors) ? (int) ($errors['error_count'] ?? 0) : 0;

    if ($date === false || $warningCount > 0 || $errorCount > 0 || $date->format('Y-m-d') !== $value) {
        rejectRequest(422, $fieldLabel . ' tidak valid.');
    }

    return $date->format('Y-m-d');
}

function validateQty(mixed $value): int
{
    $qty = filter_var($value, FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 1,
            'max_range' => APP_MAX_QTY,
        ],
    ]);

    if ($qty === false) {
        rejectRequest(422, 'Jumlah cetak tidak valid.');
    }

    return $qty;
}

function escapeHtml(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
