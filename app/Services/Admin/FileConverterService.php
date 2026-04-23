<?php

namespace App\Services\Admin;

class FileConverterService
{
    /**
     * Convierte un archivo (imagen o documento) a Base64.
     */
    public function convertToBase64($file): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $content = file_get_contents($file->getRealPath());
        return base64_encode($content);
    }

    /**
     * Obtiene el tipo MIME del archivo.
     */
    public function getMimeType($file): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        return $file->getMimeType();
    }
}
