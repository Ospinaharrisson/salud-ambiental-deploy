<?php

if (!function_exists('assetTypes')) {
    function assetTypes(): array
    {
        return [
            'link' => ['name' => 'Enlace', 'image' => 'assets/images/user/Icons/asset-type/url.png'],
            'image' => ['name' => 'Imagen', 'image' => 'assets/images/user/Icons/asset-type/image.png'],
            'document' => ['name' => 'Documento', 'image' => 'assets/images/user/Icons/asset-type/pdf.png'],
            'geo' => ['name' => 'Mapa', 'image' => 'assets/images/user/Icons/asset-type/geo.png'],
            '' => ['name' => 'Desconocido', 'image' => 'assets/images/user/Icons/asset-type/default.png'],
            null => ['name' => 'Desconocido', 'image' => 'assets/images/user/Icons/asset-type/default.png'],
        ];
    }
}

if (!function_exists('assetIcon')) {
    function assetIcon(?string $type): string
    {
        return asset(assetTypes()[$type]['image'] ?? assetTypes()['']['image']);
    }
}

if (!function_exists('assetName')) {
    function assetName(?string $type): string
    {
        return assetTypes()[$type]['name'] ?? assetTypes()['']['name'];
    }
}
