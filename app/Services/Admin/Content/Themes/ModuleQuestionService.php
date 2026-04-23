<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Themes\ModuleQuestion;
use App\Services\Admin\Request\ValidationService;

class ModuleQuestionService
{
    protected $validator;
    
    public function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }

    public function store(Request $request): ModuleQuestion
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: true);

        $question = new ModuleQuestion();
        $question->name = $request->name;
        $question->description = $request->description;
        $question->module_id = $request->module_id;

        $maxOrder = ModuleQuestion::max('order') ?? 0;
        $question->order = $maxOrder + 1;

        $question->save();

        return $question;
    }

    public function update(Request $request, ModuleQuestion $question): ModuleQuestion
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: true);
    
        if ($request->name !== $question->name) {
            $question->name = $request->name;
        }
    
        if ($request->description !== $question->description) {
            $question->description = $request->description;
        }
    
        $question->save();
    
        return $question;
    }

    public function toggle(ModuleQuestion $question): ModuleQuestion
    {
        $question->is_active = !$question->is_active;
        $question->save();

        return $question;
    }

    public function destroy(ModuleQuestion $question): void
    {
        $question->delete();
    }
}