<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\LineOfInterest;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class LineOfInterestService
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

    public function store(Request $request): LineOfInterest
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);

        $line = new LineOfInterest();
        $line->name = $request->name;
        $line->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->fileHandler->handle(request: $request, model: $line);

        $maxOrder = LineOfInterest::max('order') ?? 0;
        $line->order = $maxOrder + 1;

        $line->save();

        return $line;
    }

    public function update(Request $request, LineOfInterest $line): LineOfInterest
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);

        if ($request->name !== $line->name) {
            $line->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $line->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $line);

        $line->save();

        return $line;
    }

    public function toggle(LineOfInterest $line): LineOfInterest
    {
        $line->is_active = !$line->is_active;
        $line->save();

        return $line;
    }

    public function destroy(LineOfInterest $line): void
    {
        $line->delete();
    }
}
