<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Home\FooterItem;
use App\Services\Admin\Content\Home\FooterItemService;

class FooterItemController extends Controller
{
    protected $footerManager;

    public function __construct(FooterItemService $footerManager)
    {
        $this->footerManager = $footerManager;
    }
    
    public function footerHomeView()
    {
        $paginatedItems = $this->footerManager->getPaginatedFooterGroups();
        return view('Admin.Dashboard.Home.footer.footer-home', compact('paginatedItems'));
    }

    public function footerCreateView(string $category)
    {
        return view('Admin.Dashboard.Home.footer.footer-create', compact('category'));
    }

    public function footerUpdateView(string $category, int $id)
    {
        $item = FooterItem::findOrFail($id);
        return view('Admin.Dashboard.Home.footer.footer-edit', compact('category', 'item'));
    }

    public function storeFooterItem(Request $request)
    {
        $this->footerManager->store($request);
        return redirect()->route('admin.home.footer')->with('mensaje', 'elemento creado con exito');
    }

    public function updateFooterItem(Request $request, string $category, $id)
    {
        $item = FooterItem::findOrFail($id);
        $this->footerManager->update($request, $item);

        return redirect()->route('admin.home.footer')->with('mensaje', 'elemento actualizado con exito');
    }

     public function toggleFooterItem(string $category, $id)
    {
        $item = FooterItem::findOrFail($id);
        $this->footerManager->toggle($item);

        return redirect()->back()->with('mensaje', 'El estado del elemento ha sido actualizado exitosamente.');
    }

    public function sortFooterItem(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            FooterItem::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }
}
