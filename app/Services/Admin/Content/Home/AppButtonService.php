<?php
namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\AppButton;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class AppButtonService
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

    public function store(Request $request): AppButton
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 10, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);
        $this->validator->validateColorField(request: $request, field: 'theme', required: true);

        $button = new AppButton();
        $button->name = $request->name;
        $button->image = $this->fileConverter->convertToBase64($request->file('image'));
        $button->theme = $request->theme;

        $this->fileHandler->handle(request: $request, model: $button);

        $maxOrder = AppButton::max('order') ?? 0;
        $button->order = $maxOrder + 1;

        $button->save();

        return $button;
    }

    public function update(Request $request, AppButton $button): AppButton
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 10, required: true);
        $this->validator->validateColorField(request: $request, field: 'theme', required: true);

        if ($request->name !== $button->name) {
            $button->name = $request->name;
        }
        
        if ($request->theme !== $button->theme) {
            $button->theme = $request->theme;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $button->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $button);

        $button->save();

        return $button;
    }

    public function toggle(AppButton $button): AppButton
    {
        $button->is_active = !$button->is_active;
        $button->save();

        return $button;
    }
    
    public function destroy(AppButton $button): void
    {
        $button->delete();
    }

}
