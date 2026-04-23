<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Themes\NavCollection;
use App\Services\Admin\Request\ValidationService;

class NavCollectionService
{
    protected $validator;

    public function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }

    public function store(Request $request): NavCollection
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);

        $collection = new NavCollection();
        $collection->name = $request->name;
        $collection->module_id = $request->module_id;

        $collection->save();

        return $collection;
    }

    public function update(Request $request, NavCollection $collection): NavCollection
    {
        if ($request->name !== $collection->name) {
            $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
            $collection->name = $request->name;
        }

        $collection->save();

        return $collection;
    }

    public function toggle(NavCollection $collection): NavCollection
    {
        $collection->is_active = !$collection->is_active;
        $collection->save();

        return $collection;
    }

    public function destroy(NavCollection $collection): void
    {
        $collection->delete();
    }
}
