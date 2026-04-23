<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Themes\RecordsPage;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use Illuminate\Support\Str;

class RecordPageService
{
    protected $validator;
    protected $fileConverter;

    public function __construct(
        ValidationService $validator,
        FileConverterService $fileConverter
    ) {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): RecordsPage
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateImageField($request, 'image', false);
        $this->validator->validateRichTextField($request, 'description', 30, true);

        $page = new RecordsPage();
        $page->name = $request->name;
        $page->slug = $this->generateSlug($request->name);
        $page->description = $request->description;
        $page->image = $this->fileConverter->convertToBase64($request->file('image'));
        $page->module_id = $request->module_id;

        $page->save();

        return $page;
    }

    public function update(Request $request, RecordsPage $page): RecordsPage
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateRichTextField($request, 'description', 30, true);

        $page->name = $request->name;
        $page->description = $request->description;

        if ($request->hasFile('image')) {
            $this->validator->validateImageField($request, 'image', true);
            $page->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $page->save();

        return $page;
    }

    public function toggle(RecordsPage $page): RecordsPage
    {
        $page->is_active = !$page->is_active;
        $page->save();

        return $page;
    }

    public function destroy(RecordsPage $page): void
    {
        $page->delete();
    }

    private function generateSlug(string $title): string
    {
        return Str::slug($title);
    }
}
