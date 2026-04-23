<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Content\NavEntry;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\Request\ConditionalFileHandler;

class NavEntryService
{
    protected $validator;
    protected $fileHandler;

    public function __construct(ValidationService $validator, ConditionalFileHandler $fileHandler)
    {
        $this->validator = $validator;
        $this->fileHandler = $fileHandler;
    }

    public function store(Request $request, int $collection_id): NavEntry
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);

        $entry = new NavEntry();
        $entry->name = $request->name;
        $entry->nav_collection_id = $collection_id;

        $this->fileHandler->handle(request: $request, model: $entry);

        $maxOrder = NavEntry::where('nav_collection_id', $request->nav_collection_id)->max('order') ?? 0;
        $entry->order = $maxOrder + 1;

        $entry->save();

        return $entry;
    }

    public function update(Request $request, NavEntry $entry): NavEntry
    {
        if ($request->name !== $entry->name) {
            $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
            $entry->name = $request->name;
        }

        $this->fileHandler->handle(request: $request, model: $entry);

        $entry->save();

        return $entry;
    }

    public function toggle(NavEntry $entry): NavEntry
    {
        $entry->is_active = !$entry->is_active;
        $entry->save();

        return $entry;
    }

    public function destroy(NavEntry $entry): void
    {
        $entry->delete();
    }
}
