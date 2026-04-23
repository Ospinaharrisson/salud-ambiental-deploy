<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\WeatherInsight;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class InsightService
{
    protected $validator;
    protected $fileConverter;
    protected $LinkHandler;

    public function __construct(
        ValidationService $validator,
        FileConverterService $fileConverter,
        ConditionalFileHandler $fileHandler
    ) {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
        $this->LinkHandler = $fileHandler;
    }

    public function store(Request $request): WeatherInsight
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateImageField($request, 'image', true);

        $insight = new WeatherInsight();
        $insight->name = $request->name;
        $insight->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->LinkHandler->handle(request: $request, model: $insight,
            options: [
                'link' => ['required' => true, 'customMessage' => 'El enlace no es valido'],
                'image' => ['required' => true, 'customMessage' => 'La imagen proporcionada no es valida'],
                'document' => ['required' => true, 'customMessage' => 'El documento proporcionado  no es valido']
            ]
        );

        $maxOrder = WeatherInsight::max('order') ?? 0;
        $insight->order = $maxOrder + 1;

        $insight->save();

        return $insight;
    }

    public function update(Request $request, WeatherInsight $insight): WeatherInsight
    {
        $this->validator->validateStringField($request, 'name', 200, true);

        if ($request->name !== $insight->name) {
            $insight->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField($request, 'image', true);
            $insight->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->LinkHandler->handle(request: $request, model: $insight,
            options: [
                'link' => ['required' => true, 'customMessage' => 'El enlace no es valido'],
                'image' => ['required' => true, 'customMessage' => 'La imagen proporcionada no es valida'],
                'document' => ['required' => true, 'customMessage' => 'El documento proporcionado  no es valido']
            ]
        );

        $insight->save();

        return $insight;
    }

    public function toggle(WeatherInsight $insight): WeatherInsight
    {
        $insight->is_active = !$insight->is_active;
        $insight->save();

        return $insight;
    }

    public function destroy(WeatherInsight $insight): void
    {
        $insight->delete();
    }
}
