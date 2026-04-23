<?php

namespace App\Services\Admin\Request;

use Illuminate\Http\Request;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;

class ConditionalFileHandler
{
    protected ValidationService $validator;
    protected FileConverterService $fileConverter;

    public function __construct(
        ValidationService $validator,
        FileConverterService $fileConverter
    ) {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
    }

    /**
     * Procesa un input tipo:
     * 'select' => [
     *     'type' => 'link' | 'image' | 'document',
     *     'file' => archivo (si aplica),
     *     'link' => string (si aplica)
     * ]
     */
    public function handle(
        Request $request,
        object $model,
        bool $isRequired = true,
        array $options = []
    ): void {
        $select = $request->input('select', []);
        $file = $request->file('select')['file'] ?? null;
        $type = $select['type'] ?? null;
        $shouldClear = isset($select['clear']) && $select['clear'];

        if ($shouldClear) {
            $model->link = null;
            $model->mime_type = null;
            $model->content_base64 = null;
            return;
        }

        if (!$type && !$file && !$isRequired) {
            return;
        }

        /**
         * Validar si existe un archivo actual compatible con el tipo seleccionado
         */
        $currentMime = $model->mime_type ?? null;

        $hasValidExistingFile =
            ($type === 'image' && str_starts_with($currentMime ?? '', 'image/')) ||
            ($type === 'document' && $currentMime === 'application/pdf');

        /**
         * Si el contenido es requerido, el tipo es image/document,
         * no se subió archivo nuevo y el archivo actual no coincide con el tipo,
         * se corta el flujo inmediatamente.
         */
        if (
            $isRequired &&
            in_array($type, ['document', 'image']) &&
            !$file &&
            !$hasValidExistingFile
        ) {
            $this->validator->validateArrayWithMessage(
                ['select.file' => null],
                ['select.file' => 'required'],
                'Debe cargar un archivo válido.'
            );
        }

        /**
         * Procesar enlace
         */
        if ($type === 'link') {
            $linkOptions = array_merge([
                'request' => $request,
                'field' => 'select.link',
                'required' => $isRequired,
                'customMessage' => 'Debe ingresar un enlace válido.'
            ], $options['link'] ?? []);

            $this->validator->validateLinkField(...$linkOptions);

            $model->link = $select['link'];
            $model->mime_type = null;
            $model->content_base64 = null;
            return;
        }

        /**
         * Procesar documento
         */
        if ($type === 'document') {
            if ($file) {
                $docOptions = array_merge([
                    'request' => $request,
                    'field' => 'select.file'
                ], $options['document'] ?? []);

                $this->validator->validateDocumentField(...$docOptions);

                $model->mime_type = $this->fileConverter->getMimeType($file);
                $model->content_base64 = $this->fileConverter->convertToBase64($file);
            }

            $model->link = null;
            return;
        }

        /**
         * Procesar imagen
         */
        if ($type === 'image') {
            if ($file) {
                $imgOptions = array_merge([
                    'request' => $request,
                    'field' => 'select.file'
                ], $options['image'] ?? []);

                $this->validator->validateImageField(...$imgOptions);

                $model->mime_type = $this->fileConverter->getMimeType($file);
                $model->content_base64 = $this->fileConverter->convertToBase64($file);
            }

            $model->link = null;
            return;
        }

        /**
         * Si es requerido y no se seleccionó una opción válida
         */
        if ($isRequired) {
            $this->validator->validateArrayWithMessage(
                ['select.type' => null],
                ['select.type' => 'required'],
                'Debe seleccionar una redirección válida.'
            );
        }
    }
}