<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\Article;
use App\Services\Admin\Content\Home\ArticleService;

class ArticleController extends Controller
{
    protected $articleManager;

    public function __construct(ArticleService $articleManager)
    {
        $this->articleManager = $articleManager;
    }

    /* #region vistas */

    public function articleHomeView()
    {
        return view('Admin.Dashboard.Home.article.article-home');
    }

    public function articleCreateView()
    {
        return view('Admin.Dashboard.Home.article.article-create');
    }

    public function articleUpdateView($id)
    {
        $article = Article::findOrFail($id);
        return view('Admin.Dashboard.Home.article.article-edit', compact('article'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeArticle(Request $request)
    {
        $this->articleManager->store($request);
        return redirect()->route('admin.home.article')->with('mensaje', 'Artículo guardado exitosamente.');
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $this->articleManager->update($request, $article);

        return redirect()->route('admin.home.article')->with('mensaje', 'Artículo actualizado exitosamente.');
    }

    public function toggleArticle($id)
    {
        $article = Article::findOrFail($id);
        $this->articleManager->toggle($article);

        return redirect()->back()->with('mensaje', 'El estado del artículo ha sido actualizado exitosamente.');
    }

    public function sortArticle(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            Article::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyArticle($id)
    {
        $article = Article::findOrFail($id);
        $this->articleManager->destroy($article);
        return redirect()->route('admin.home.article')->with('mensaje', 'Artículo eliminado correctamente.');
    }
    /* #endregion acciones */
}
