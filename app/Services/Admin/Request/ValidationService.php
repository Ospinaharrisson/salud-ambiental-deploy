<?php

namespace App\Services\Admin\Request;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\Admin\Request\SanitizationService;
use Illuminate\Support\Str;

class ValidationService
{
    protected SanitizationService $sanitizer;

    public function __construct(SanitizationService $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    /**
     * Valida un campo de tipo string simple (como nombres o títulos).
     * Permite configurar si el campo es obligatorio y la longitud máxima.
     *
     * @param Request $request   La solicitud actual.
     * @param string  $field     Nombre del campo a validar. Por defecto: 'name'.
     * @param int     $max       Longitud máxima permitida. Por defecto: 255 caracteres.
     * @param bool    $required  Si el campo es obligatorio. Por defecto: true.
     * @param string|null $customMessage Mensaje personalizado de error. Si es null, se genera automáticamente.
     */
    public function validateStringField(Request $request, string $field = 'name', int $max = 255, bool $required = true, string $customMessage = null)
    {
        $rules = [$field => ($required ? 'required|' : 'nullable|') . "string|max:$max"];
        $message = $customMessage ?? "El campo {$field} " . ($required ? 'es obligatorio y ' : '') . "no debe superar los {$max} caracteres.";
    
        $this->validateWithMessage($request, $rules, $message);
    }

    /**
     * Valida un campo tipo string contenido dentro de un array, útil cuando no se usa un Request.
     *
     * @param string $value        Valor del campo a validar.
     * @param string $field        Nombre del campo. Por defecto: 'titulo'.
     * @param int    $max          Longitud máxima permitida. Por defecto: 200 caracteres.
     * @param bool   $required     Si el campo es obligatorio. Por defecto: true.
     * @param string|null $customMessage Mensaje de error personalizado. Si es null, se genera automáticamente.
     */
    public function validateStringFromArray(string $value, string $field = 'name', int $max = 200, bool $required = true, string $customMessage = null)
    {
        $rules = [$field => ($required ? 'required|' : 'nullable|') . "string|max:$max"];
        $data = [$field => $value];

        $message = $customMessage ?? "El campo {$field} " . ($required ? 'es obligatorio y ' : '') . "no debe superar los {$max} caracteres.";

        $this->validateArrayWithMessage($data, $rules, $message);
    }

    /**
     * Valida un campo numérico decimal con precisión, escala y rango opcional.
     *
     * @param Request $request   La solicitud actual.
     * @param string  $field     Nombre del campo a validar.
     * @param bool    $required  Si el campo es obligatorio (true) o puede ser nulo (false). Por defecto: false.
     * @param int     $precision Número total de dígitos permitidos (ej: 12 en decimal(12,2)).
     * @param int     $scale     Número de decimales permitidos (ej: 2 en decimal(12,2)).
     * @param string|null $customMessage Mensaje de error personalizado.
     * @param float|null  $min   Valor mínimo permitido (opcional).
     * @param float|null  $max   Valor máximo permitido (opcional).
     */
    public function validateDecimalField(Request $request, string $field, bool $required = false, int $precision = 12, int $scale = 2, string $customMessage = null, float $min = null, float $max = null) 
    {

        $rules = [
            $field => ($required ? 'required|' : 'nullable|') .
                      "numeric|regex:/^-?\\d{1,{$precision}}(\\.\\d{1,{$scale}})?$/"
        ];

        if (!is_null($min)) {
            $rules[$field] .= "|gte:{$min}";
        }
        if (!is_null($max)) {
            $rules[$field] .= "|lte:{$max}";
        }

        $message = $customMessage ?? "El campo {$field} debe ser un número válido con hasta {$precision} enteros y {$scale} decimales.";

        $this->validateWithMessage($request, $rules, $message);
    }

    /**
     * Valida un campo de texto enriquecido (HTML), útil para editores como Quill.
     * Elimina etiquetas peligrosas como <script> antes de validar.
     *
     * @param Request $request   La solicitud actual.
     * @param string  $field     Nombre del campo a validar. Por defecto: 'body'.
     * @param int     $min       Longitud mínima permitida. Por defecto: 10 caracteres.
     * @param bool    $required  Si el campo es obligatorio. Por defecto: false.
     * @param string|null $customMessage Mensaje personalizado de error.
     */
    public function validateRichTextField(Request $request, string $field = 'body', int $min = 30, bool $required = false, string $customMessage = null)
    {
        $rawContent = $request->input($field) ?? '';
        $cleanContent = $this->sanitizer->sanitizeRichText($rawContent);

        if ($required && !preg_match('/<\s*(p|img|iframe|ul|ol|li|h[1-6])\b/i', $cleanContent)) {
            throw ValidationException::withMessages([
                $field => 'El campo es obligatorio. Debe contener texto o contenido visual como imágenes o videos.',
            ]);
        }
    
        $rules = [
            $field => ($required ? 'required|' : 'nullable|') . "string|min:$min"
        ];
        $message = $customMessage ?? "El campo {$field} debe tener al menos {$min} caracteres.";
        $this->validateWithMessage($request, $rules, $message);

        $maxBytes = 15 * 1024 * 1024; 
        if (strlen($cleanContent) > $maxBytes) {
            throw ValidationException::withMessages([
                $field => 'El contenido es demasiado grande. El tamaño máximo permitido es 15 MB.',
            ]);
        }

        $maxCharacters = 500000; 
        if (strlen(strip_tags($cleanContent)) > $maxCharacters) {
            throw ValidationException::withMessages([
                $field => "El contenido excede el límite de caracteres permitidos. El límite es de {$maxCharacters} caracteres.",
            ]);
        }

        $request->merge([$field => $cleanContent]);

        $rules = [$field => ($required ? 'required|' : 'nullable|') . "string|min:$min"];
        $message = $customMessage ?? "El campo {$field} debe tener mínimo {$min} caracteres.";
        $this->validateWithMessage($request, $rules, $message);
    }
    
    /**
     * Valida un campo que debe contener una URL válida.
     *
     * @param Request $request         La solicitud actual.
     * @param string  $field           Nombre del campo a validar. Por defecto: 'link'.
     * @param bool    $required        Si el campo es obligatorio (true) o puede ser nulo (false). Por defecto: false.
     * @param int     $maxLength       Longitud máxima permitida. Por defecto: 2048 caracteres.
     * @param string|null $customMessage Mensaje de error personalizado. Si es null, se genera automáticamente.
     */
    public function validateLinkField(Request $request, string $field = 'link', bool $required = false, int $maxLength = 2048, string $customMessage = null)
    {
        $rules = [
            $field => ($required ? 'required|' : 'nullable|') . "url|max:$maxLength",
        ];

        $message = $customMessage ?? "El campo {$field} debe ser una URL válida y no superar los {$maxLength} caracteres.";

        $this->validateWithMessage($request, $rules, $message);
    }

    /**
     * Valida que un campo contenga una imagen válida (JPEG, PNG, JPG, GIF, WEBP) con un tamaño máximo de 2 MB.
     *
     * @param Request $request         La solicitud actual.
     * @param string  $field           Nombre del campo a validar. Por defecto: 'image'.
     * @param bool    $required        Si el campo es obligatorio (true) o puede ser nulo (false). Por defecto: false.
     * @param string|null $customMessage Mensaje personalizado de error. Si es null, se genera automáticamente.
     */
    public function validateImageField(Request $request, string $field = 'image', bool $required = false, string $customMessage = null)
    {
        $rules = [
            $field => ($required ? 'required|' : 'nullable|') . 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        $message = $customMessage ?? 'La imagen proporcionada no es válida o excede el tamaño permitido.';

        $this->validateWithMessage($request, $rules, $message);
    }
    
    /**
     * Valida que un archivo (no proveniente directamente de un Request) sea una imagen válida.
     *
     * @param mixed  $file     Archivo a validar.
     * @param string $key      Nombre lógico del campo (solo para el mensaje y la regla). Por defecto: 'image'.
     * @param string|null $customMessage Mensaje de error personalizado. Si es null, se genera uno por defecto.
     */
    public function validateImageFromArray($file, string $key = 'image', string $customMessage = null)
    {
        $rules = [
            $key => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        $message = $customMessage ?? "La imagen '{$key}' no es válida o no cumple con los requisitos.";

        $this->validateArrayWithMessage([$key => $file], $rules, $message);
    }

    /**
     * Valida un campo de archivo tipo documento (solo PDF).
     *
     * @param Request $request La solicitud actual.
     * @param string  $field   El nombre del campo a validar. Por defecto: 'document'.
     * @param bool    $required Si el campo es obligatorio. Por defecto: true.
     * @param string|null $customMessage Mensaje de error personalizado.
     */
    public function validateDocumentField(Request $request, string $field = 'document', bool $required = true, string $customMessage = null)
    {
        if ($request->hasFile($field)) {
            $rules = [
                $field => ($required ? 'required|' : 'nullable|') . 'file|mimes:pdf|max:15360',
            ];
            $message = $customMessage ?? "El documento proporcionado no es válido o supera el tamaño permitido (10MB).";

            $this->validateWithMessage($request, $rules, $message);
        }
    }

    /**
     * Valida un archivo de documento cargado individualmente (fuera de un Request).
     * Útil para validaciones manuales, como en servicios personalizados o en lógica con arrays.
     *
     * @param mixed  $file           Archivo a validar (por ejemplo, desde $request->file()).
     * @param string $key            Clave que representará el archivo en el array de validación (por defecto: 'archivo').
     * @param int    $maxSizeKB      Tamaño máximo permitido en KB (por defecto: 5120 = 5MB).
     * @param string|null $customMessage Mensaje personalizado de error.
     */
    public function validateDocumentFile($file, string $key = 'archivo', int $maxSizeKB = 5120, string $customMessage = null)
    {
        $rules = [
            $key => "required|file|mimes:pdf|max:$maxSizeKB"
        ];
    
        $message = $customMessage ?? 'El documento no es válido o no cumple con los requisitos.';
    
        $this->validateArrayWithMessage([$key => $file], $rules, $message);
    }

    /**
     * Valida un campo de tipo fecha con múltiples restricciones opcionales.
     *
     * @param Request $request          La solicitud actual.
     * @param string  $field            Nombre del campo. Por defecto: 'date'.
     * @param bool    $required         Si la fecha es obligatoria. Por defecto: true.
     * @param string|null $after        Fecha mínima permitida ('today', '2024-01-01', etc.). Null = sin restricción.
     * @param string|null $before       Fecha máxima permitida ('2025-12-31', etc.). Null = sin restricción.
     * @param string|null $customMessage Mensaje de error personalizado. Si es null, se genera automáticamente.
     */
    public function validateDateField(Request $request, string $field = 'date', bool $required = true, string $after = null, string $before = null, string $customMessage = null)
    {
        $rules = [];
        $base = $required ? 'required|date' : 'nullable|date';

        if ($after) $base .= "|after_or_equal:$after";
        if ($before) $base .= "|before_or_equal:$before";

        $rules[$field] = $base;

        $defaultMsg = "El campo {$field} debe ser una fecha válida";
        if ($after) $defaultMsg .= " posterior o igual a $after";
        if ($before) $defaultMsg .= " y anterior o igual a $before";
        $defaultMsg .= '.';

        $this->validateWithMessage($request, $rules, $customMessage ?? $defaultMsg);
    }

    /**
     * Valida un campo de color en formato HEX (#RRGGBB o #RGB).
     * Permite configurar si el campo es obligatorio.
     *
     * @param Request     $request        La solicitud actual.
     * @param string      $field          Nombre del campo a validar. Por defecto: 'theme'.
     * @param bool        $required       Si el campo es obligatorio. Por defecto: false.
     * @param string|null $customMessage  Mensaje personalizado de error. Si es null, se genera automáticamente.
     */
    public function validateColorField(Request $request, string $field = 'theme', bool $required = false, string $customMessage = null)
    {
        $baseRule = 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/';
        $rules = [$field => ($required ? 'required|' : 'nullable|') . $baseRule];
    
        $message = $customMessage ?? "El campo {$field} " . ($required ? 'es obligatorio y ' : '') . "debe ser un color HEX válido (como #fff o #ffffff).";
    
        $this->validateWithMessage($request, $rules, $message);
    }

    /**
    * Método interno para ejecutar validaciones con manejo de excepciones.
    */
    private function validateWithMessage(Request $request, array $rules, string $errorMessage)
    {
        try {
            $request->validate($rules);
        } catch (ValidationException $e) {
            return back()
                ->with('mensajeError', $errorMessage)
                ->throwResponse();
        }
    }

    /**
    * método para aceptar arrays.
    */
    public function validateArrayWithMessage(array $data, array $rules, string $errorMessage)
    {
        try {
            validator($data, $rules)->validate();
        } catch (ValidationException $e) {
            return back()
                ->with('mensajeError', $errorMessage)
                ->throwResponse();
        }
    }
}
