<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Themes\ModuleButton;

use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ValidationService;

class ModuleButtonService
{
    protected $validator;
    protected $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter)
    {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): ModuleButton
    {
        $this->validator->validateStringField($request, 'name', max: 200, required: true);
        $this->validator->validateLinkField($request, 'link', required: true);
        $this->validator->validateImageField($request, 'image', required: true);

        $button = new ModuleButton();
        $button->module_id = $request->module_id;
        $button->name = $request->name;
        $button->link = $request->link;
        $button->image = $this->fileConverter->convertToBase64($request->file('image'));

        $maxOrder = ModuleButton::where('module_id', $request->module_id)->max('order') ?? 0;
        $button->order = $maxOrder + 1;

        $button->save();

        return $button;
    }

    public function update(Request $request, ModuleButton $button): ModuleButton
    {
        $this->validator->validateStringField($request, 'name', max: 200, required: true);
        $this->validator->validateLinkField($request, 'link', required: true);

        $button->name = $request->name;
        $button->link = $request->link;

        if ($request->hasFile('image')) {
            $this->validator->validateImageField($request, 'image', required: true);
            $button->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $button->save();

        return $button;
    }

    public function toggle(ModuleButton $button): ModuleButton
    {
        $button->is_active = !$button->is_active;
        $button->save();

        return $button;
    }

    public function destroy(ModuleButton $button): void
    {
        $button->delete();
    }
}
