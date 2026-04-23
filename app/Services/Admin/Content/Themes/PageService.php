<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Themes\Page;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use Illuminate\Support\Str;

class PageService
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

    public function store(Request $request): Page
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateImageField($request, 'image', true);
        $this->validator->validateRichTextField($request, 'description', 30, true);

        $page = new Page();
        $page->name = $request->name;
        $page->slug = $this->generateSlug($request->name);
        $page->description = $request->description;
        $page->image = $this->fileConverter->convertToBase64($request->file('image'));
        $page->module_id = $request->module_id;
        $page->show_in_navbar = $request->has('show_in_navbar');

        $page->order = (Page::max('order') ?? 0) + 1;

        $page->save();

        return $page;
    }

    public function update(Request $request, Page $page): Page
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateRichTextField($request, 'description', 30, true);

        $page->name = $request->name;
        $page->description = $request->description;
        $page->show_in_navbar = $request->has('show_in_navbar');
        
        if ($request->hasFile('image')) {
            $this->validator->validateImageField($request, 'image', true);
            $page->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $page->save();

        return $page;
    }

    public function toggle(Page $page): Page
    {
        $page->is_active = !$page->is_active;
        $page->save();

        return $page;
    }

    public function destroy(Page $page): void
    {
        $page->delete();
    }

    private function generateSlug(string $title): string
    {
        return Str::slug($title);
    }
}
