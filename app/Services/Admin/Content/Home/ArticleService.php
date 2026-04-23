<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\Article;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class ArticleService
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

    public function store(Request $request): Article
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: true);

        $article = new Article();
        $article->name = $request->name;
        $article->description = $request->description;
        $article->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->fileHandler->handle(request: $request, model: $article);

        $article->order = 0;
        $article->save();

        Article::where('id', '!=', $article->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get()
            ->each(function ($a, $index) {
                $a->order = $index + 1;
                $a->save();
            }
        );

        $article->save();

        return $article;
    }

    public function update(Request $request, Article $article): Article
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: true);

        if ($request->name !== $article->name) {
            $article->name = $request->name;
        }

        if ($request->description !== $article->description) {
            $article->description = $request->description;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $article->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $article);

        $article->save();

        return $article;
    }

    public function toggle(Article $article): Article
    {
        $article->is_active = !$article->is_active;
        $article->save();

        return $article;
    }

    public function destroy(Article $article): void
    {
        $article->delete();
    }
}
