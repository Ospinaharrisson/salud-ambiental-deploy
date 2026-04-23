<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Helpers\Admin\CurrentModule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shared\Home\Module;
use App\Models\Shared\Themes\NavCollection;
use App\Models\Shared\Content\NavEntry;

use App\Services\Admin\Content\Themes\NavCollectionService;
use App\Services\Admin\Content\Themes\NavEntryService;

class NavCollectionController extends Controller
{
    protected $collectionService;
    protected $entryService;

    public function __construct(NavCollectionService $collectionService, NavEntryService $entryService)
    {
        $this->collectionService = $collectionService;
        $this->entryService = $entryService;
    }

    /* #region Vistas */

    public function collectionHomeView()
    {
        $count = NavCollection::where('module_id', CurrentModule::get()->id)->count();
        return view('Admin.Dashboard.Themes.navigation.nav-collection-home',
            [
                'module' => CurrentModule::get(),
                'count' => $count
        ]);
    }

    public function editCollectionView($module, $collection_id)
    {
        $collection = NavCollection::findOrFail($collection_id);
        return view('Admin.Dashboard.Themes.navigation.nav-collection-edit', compact('collection'));
    }

    public function entryHomeView($module, $collection_id)
    {
        $collection = NavCollection::findOrFail($collection_id);
        return view('Admin.Dashboard.Themes.navigation.Entries.entry-home', [
            'module' => CurrentModule::get(),
            'collection' => $collection
        ]);
    }

    public function createEntryView($module, $collection_id)
    {   
        $collection = NavCollection::findOrFail($collection_id);
        return view('Admin.Dashboard.Themes.navigation.Entries.entry-create', compact('collection'));
    }

    public function editEntryView($module, $collection_id, $entry_id)
    {
        $entry = NavEntry::findOrFail($entry_id);
        return view('Admin.Dashboard.Themes.navigation.Entries.entry-edit', compact('collection_id', 'entry'));
    }

    /* #endregion */

    /* #region Acciones Collection */

    public function storeCollection(Request $request)
    {
        $this->collectionService->store($request);
        return redirect()->route('admin.themes.navigation', ['module' => CurrentModule::get()])->with('mensaje', 'Colección creada correctamente.');
    }

    public function updateCollection(Request $request, $module, $id)
    {
        $collection = NavCollection::findOrFail($id);
        $this->collectionService->update($request, $collection);

        return redirect()->route('admin.themes.navigation', ['module' => $module])->with('mensaje', 'Colección actualizada correctamente.');
    }

    public function toggleCollection($module, $id)
    {
        $collection = NavCollection::findOrFail($id);
        $this->collectionService->toggle($collection);

        return redirect()->route('admin.themes.navigation', ['module' => $module])->with('mensaje', 'Estado actualizado correctamente.');
    }

    public function sortCollections(Request $request, $module)
    {
        $module = CurrentModule::get();
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            NavCollection::where('id', $id)
                ->where('module_id', $module->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyCollection($module, $collection_id)
    {
        $collection = NavCollection::findOrFail($collection_id);
        $this->collectionService->destroy($collection);
        return redirect()->route('admin.themes.navigation', ['module' => $module])->with('mensaje', 'Colección eliminada correctamente.');
    }

    /* #endregion */

    /* #region Acciones Entry */

    public function storeEntry(Request $request, $module, $collection_id)
    {
        $this->entryService->store($request, $collection_id);
        return redirect()->route('admin.themes.navigation.entries', ['module' => $module, 'collection_id' => $collection_id])->with('mensaje', 'Entrada creada correctamente.');
    }

    public function updateEntry(Request $request, $module, $collection_id, $entry_id)
    {
        $entry = NavEntry::findOrFail($entry_id);
        $this->entryService->update($request, $entry);

        return redirect()->route('admin.themes.navigation.entries', ['module' => $module, 'collection_id' => $collection_id])->with('mensaje', 'Entrada actualizada correctamente.');
    }

    public function toggleEntry($module, $entry_id)
    {
        $entry = NavEntry::findOrFail($entry_id);
        $this->entryService->toggle($entry);

        return redirect()->back()->with('mensaje', 'Estado de la entrada actualizado.');
    }

    public function sortEntries(Request $request)
    {
        $items = $request->input('order');

        foreach ($items as $index => $id) {
            NavEntry::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyEntry($module, $collection_id, $entry_id)
    {
        $entry = NavEntry::findOrFail($entry_id);
        $this->entryService->destroy($entry);
        return redirect()->route('admin.themes.navigation.entries', ['module' => $module, 'collection_id' => $collection_id])->with('mensaje', 'Entrada eliminada correctamente.');
    }

    /* #endregion */
}
