<?php

declare(strict_types=1);

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$fullPath = __DIR__ . $requestPath;

$allowedStaticPrefixes = [
    '/images/',
];

$blockedPrefixes = [
    '/vendor/',
    '/docker/',
    '/.git/',
];

$blockedFiles = [
    '/.env',
    '/composer.json',
    '/composer.lock',
    '/Dockerfile',
    '/docker-compose.yml',
    '/README.md',
    '/security.php',
];

foreach ($blockedPrefixes as $prefix) {
    if (str_starts_with($requestPath, $prefix)) {
        http_response_code(403);
        exit('Forbidden');
    }
}

foreach ($blockedFiles as $blockedFile) {
    if ($requestPath === $blockedFile || str_starts_with($requestPath, $blockedFile . '.')) {
        http_response_code(403);
        exit('Forbidden');
    }
}

if ($requestPath === '/' || $requestPath === '/index.php') {
    require __DIR__ . '/index.php';
    return true;
}

if ($requestPath === '/print.php') {
    require __DIR__ . '/print.php';
    return true;
}

foreach ($allowedStaticPrefixes as $prefix) {
    if (str_starts_with($requestPath, $prefix) && is_file($fullPath)) {
        return false;
    }
}

http_response_code(404);
require __DIR__ . '/index.php';
return true;
