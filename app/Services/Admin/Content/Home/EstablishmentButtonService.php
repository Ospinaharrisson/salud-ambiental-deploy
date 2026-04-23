<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\EstablishmentButton;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class EstablishmentButtonService
{
    protected $validator;
    protected $fileHandler;
    protected $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter, ConditionalFileHandler $fileHandler)
    {
        $this->validator = $validator;
        $this->LinkHandler = $fileHandler;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): EstablishmentButton
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateImageField($request, 'image', true);

        $establishment = new EstablishmentButton();
        $establishment->name = $request->name;
        $establishment->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->LinkHandler->handle(request: $request, model: $establishment,
            options: [
                'link' => ['required' => true, 'customMessage' => 'El enlace no es valido'],
                'image' => ['required' => true, 'customMessage' => 'La imagen proporcionada no es valida'],
                'document' => ['required' => true, 'customMessage' => 'El documento proporcionado  no es valido']
            ]
        );

        $maxOrder = EstablishmentButton::max('order') ?? 0;
        $establishment->order = $maxOrder + 1;

        $establishment->save();

        return $establishment;
    }

    public function update(Request $request, EstablishmentButton $establishment): EstablishmentButton
    {
        $this->validator->validateStringField($request, 'name', 200, true);

        if ($request->name !== $establishment->name) {
            $establishment->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField($request, 'image', true);
            $establishment->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->LinkHandler->handle(request: $request, model: $establishment,
            options: [
                'link' => ['required' => true, 'customMessage' => 'El enlace no es valido'],
                'image' => ['required' => true, 'customMessage' => 'La imagen proporcionada no es valida'],
                'document' => ['required' => true, 'customMessage' => 'El documento proporcionado  no es valido']
            ]
        );

        $establishment->save();

        return $establishment;
    }

    public function toggle(EstablishmentButton $establishment): EstablishmentButton
    {
        $establishment->is_active = !$establishment->is_active;
        $establishment->save();

        return $establishment;
    }

    public function destroy(EstablishmentButton $establishment): void
    {
        $establishment->delete();
    }
}
