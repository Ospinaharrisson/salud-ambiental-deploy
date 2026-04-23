<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Home\HomePage;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;

class PageService
{
    protected $validator;
    protected $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter)
    {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): HomePage
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: true);

        $page = new HomePage();
        $page->name = $request->name;
        $page->description = $request->description;

        if($request->image)
        {
            $this->validator->validateImageField(request: $request, field: 'image', required: false);        
            $page->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $page->save();

        return $page;
    }

    public function update(Request $request, HomePage $page): HomePage
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: true);

        if ($request->name !== $page->name) {
            $page->name = $request->name;
        }

        if ($request->description !== $page->description) {
            $page->description = $request->description;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: false);
            $page->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $page->save();

        return $page;
    }

    public function toggle(HomePage $page): HomePage
    {
        $page->is_active = !$page->is_active;
        $page->save();

        return $page;
    }

    public function destroy(HomePage $page): void
    {
        $page->delete();
    }
}
