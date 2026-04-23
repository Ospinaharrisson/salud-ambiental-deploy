<?php

namespace App\Http\Livewire\User\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shared\Content\PageAsset;

class AssetSearcher extends Component
{
    use WithPagination;

    public $query = '';
    public $categories = [];
    public $filterType;
    public $filterCategory = '';
    public $sortOrder = 'asc';
    public $pageId;
    public $theme;
    public $perPage = 8;

    protected $results;
    protected $baseQuery;
    protected $listeners = ['resetSearchFilters' => 'resetFilters'];

    public function mount($pageId, $theme)
    {
        $this->pageId = $pageId;
        $this->theme  = $theme;
    }

    public function applyFilters(){$this->searchAssets();}

    public function resetFilters()
    {
        $this->query = '';
        $this->categories = [];
        $this->filterType = '';
        $this->filterCategory = '';
        $this->sortOrder = 'asc';
        $this->baseQuery = null;

        $this->resetPage();
    }

    public function toggleOrder()
    {
        $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        $this->searchAssets();
    }

    public function searchAssets()
    {
        $this->resetPage();

        $this->baseQuery = $this->buildQuery();
        
        if (empty($this->filterCategory) && empty($this->filterType)) {
            $this->categories = $this->baseQuery
            ->get()
            ->pluck('category')
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();
        }

        $this->dispatchBrowserEvent('keepSearchOpen');
    }

    private function buildQuery()
    {
        $q = trim($this->query);

        $query = PageAsset::query()
            ->join('page_asset_categories as c', 'c.id', '=', 'page_assets.page_asset_category_id')
            ->where('page_assets.is_active', true)
            ->where('c.page_id', $this->pageId)
            ->where('c.is_active', true)
            ->select('page_assets.*')
            ->with('category');

        if ($q !== '') {
            $query->where('page_assets.name', 'like', "%{$q}%");
        }

        if (!empty($this->filterCategory)) {
            $query->where('page_assets.page_asset_category_id', $this->filterCategory);
        }
    
        if (!empty($this->filterType)) {
            $query->where('page_assets.type', $this->filterType);
        }

        $query->orderBy('page_assets.name', $this->sortOrder);

        return $query;
    }

    public function nextPage()
    {
        if (!$this->baseQuery) {
            $this->baseQuery = $this->buildQuery();
        }

        $page = $this->page + 1;
        $this->setPage($page);

        $this->dispatchBrowserEvent('keepSearchOpen');
    }

    public function previousPage()
    {
        if (!$this->baseQuery) {
            $this->baseQuery = $this->buildQuery();
        }

        $page = max($this->page - 1, 1);
        $this->setPage($page);

        $this->dispatchBrowserEvent('keepSearchOpen');
    }

    public function render()
    {
        $query = $this->baseQuery ? clone $this->baseQuery : null;
        $results = $query ? $query->paginate($this->perPage) : collect();
    
        return view('User.Content.Page.Module.Template.Resources.asset-searcher', [
            'results' => $results,
            'categories' => $this->categories,
            'theme' => $this->theme,
        ]);
    }
}
