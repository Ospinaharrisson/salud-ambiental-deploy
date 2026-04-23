<?php

if (! function_exists('clarifyColor')) {
    function clarifyColor($hex, $alpha = 0.2)
    {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(str_repeat($hex[0], 2));
            $g = hexdec(str_repeat($hex[1], 2));
            $b = hexdec(str_repeat($hex[2], 2));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return "rgba($r, $g, $b, $alpha)";
    }
}

if (!function_exists('getBase64MimeType')) {
    function getBase64MimeType(string $base64): ?string
    {
        if (!$base64) return null;

        $decoded = base64_decode($base64, true);
        if ($decoded === false) return null;

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        return $finfo->buffer($decoded) ?: null;
    }
}

if (!function_exists('renderBase64Image')) {
    function renderBase64Image(string $base64): ?string
    {
        $mime = getBase64MimeType($base64);
        return $mime ? "data:$mime;base64,$base64" : null;
    }
}

if (!function_exists('generateBlankLink')) {
    function generateBlankLink(string $base64, string $mime): string
    {
        $key = uniqid('file_', true);
        cache()->put($key, [
            'mime' => $mime,
            'content' => $base64,
        ], now()->addMinutes(5));

        return route('blank.view', ['key' => $key]);
    }
}