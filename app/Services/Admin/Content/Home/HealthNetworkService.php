<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\HealthNetwork;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class HealthNetworkService
{
    protected $validator;
    protected $fileHandler;
    protected $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter, ConditionalFileHandler $fileHandler)
    {
        $this->validator = $validator;
        $this->fileHandler = $fileHandler;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): HealthNetwork
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);

        $network = new HealthNetwork();
        $network->name = $request->name;
        $network->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->fileHandler->handle(request: $request, model: $network);

        $maxOrder = HealthNetwork::max('order') ?? 0;
        $network->order = $maxOrder + 1;

        $network->save();

        return $network;
    }

    public function update(Request $request, HealthNetwork $network): HealthNetwork
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);

        if ($request->name !== $network->name) {
            $network->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $network->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $network);

        $network->save();

        return $network;
    }

    public function toggle(HealthNetwork $network): HealthNetwork
    {
        $network->is_active = !$network->is_active;
        $network->save();

        return $network;
    }

    public function destroy(HealthNetwork $network): void
    {
        $network->delete();
    }
}
