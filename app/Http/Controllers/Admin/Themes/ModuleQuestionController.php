<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Admin\CurrentModule;
use App\Models\Shared\Themes\ModuleQuestion;
use App\Services\Admin\Content\Themes\ModuleQuestionService;

class ModuleQuestionController extends Controller
{
    protected $questionManager;

    public function __construct(ModuleQuestionService $questionManager)
    {
        $this->questionManager = $questionManager;
    }
    
    /* #region vistas */

    public function questionsHomeView()
    {
        return view('Admin.Dashboard.Themes.questions.question-home');
    }

    public function createQuestionView($module)
    {
        return view('Admin.Dashboard.Themes.questions.question-create');
    }
    
    public function editQuestionView($module, $question_id)
    {
        $module = CurrentModule::get();
        $question = ModuleQuestion::where('module_id', $module->id)->findOrFail($question_id);

        return view('Admin.Dashboard.Themes.questions.question-edit', ['module' => $module], compact('question'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeQuestion(Request $request, $module)
    {
        $this->questionManager->store($request);
        return redirect()->route('admin.themes.questions', ['module' => $module])
            ->with('mensaje', 'Pregunta guardada exitosamente.');
    }
    
    public function updateQuestion(Request $request, $module, $question_id)
    {
        $question = ModuleQuestion::findOrFail($question_id);
        $this->questionManager->update($request, $question);

        return redirect()->route('admin.themes.questions', ['module' => $module])
            ->with('mensaje', 'Pregunta actualizada exitosamente.');
    }
    
    public function toggleQuestion($module, $question_id)
    {
        $question = ModuleQuestion::findOrFail($question_id);
        $this->questionManager->toggle($question);

        return redirect()->back()->with('mensaje', 'El estado de la pregunta ha sido actualizado exitosamente.');
    }

    public function sortQuestions(Request $request, $module)
    {
        $module = CurrentModule::get();
        $items = $request->input('order');

        foreach ($items as $index => $id) {
            ModuleQuestion::where('id', $id)
                ->where('module_id', $module->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyQuestion($module, $question_id)
    {
        $question = ModuleQuestion::findOrFail($question_id);
        $this->questionManager->destroy($question);
        return redirect()->route('admin.themes.questions', ['module' => $module])
            ->with('mensaje', 'Pregunta eliminada exitosamente.');
    }
    /* #endregion acciones */
}
