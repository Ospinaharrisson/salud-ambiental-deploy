<?php
namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\CollectionPoint;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class CollectionPointService
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

    public function store(Request $request): CollectionPoint
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);

        $point = new CollectionPoint();
        $point->name = $request->name;
        $point->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->fileHandler->handle(request: $request, model: $point);

        $maxOrder = CollectionPoint::max('order') ?? 0;
        $point->order = $maxOrder + 1;

        $point->save();

        return $point;
    }

    public function update(Request $request, CollectionPoint $point): CollectionPoint
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);

        if ($request->name !== $point->name) {
            $point->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $point->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $point);

        $point->save();

        return $point;
    }

    public function toggle(CollectionPoint $point): CollectionPoint
    {
        $point->is_active = !$point->is_active;
        $point->save();

        return $point;
    }

    public function destroy(CollectionPoint $point): void
    {
        $point->delete();
    }
}
