<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Home\Module;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;

class ModuleService
{
    protected $validator;
    protected $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter)
    {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): Module
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);
        $this->validator->validateColorField(request: $request, field: 'theme', required: true);

        $module = new Module();
        $module->name = $request->name;
        $module->theme = $request->theme;
        $module->type = $request->type;
        $module->image = $this->fileConverter->convertToBase64($request->file('image'));

        $maxOrder = Module::where('type', $module->type)->max('order') ?? 0;
        $module->order = $maxOrder + 1;

        $module->save();

        return $module;
    }

    public function update(Request $request, Module $module): Module
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateColorField(request: $request, field: 'theme', required: true);

        if ($request->name !== $module->name) {
            $module->name = $request->name;
        }

        if ($request->theme !== $module->theme) {
            $module->theme = $request->theme;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $module->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $module->save();

        return $module;
    }

    public function toggle(Module $module): Module
    {
        $module->is_active = !$module->is_active;
        $module->save();

        return $module;
    }

    public function destroy(Module $module): void
    {
        $module->delete();
    }
}