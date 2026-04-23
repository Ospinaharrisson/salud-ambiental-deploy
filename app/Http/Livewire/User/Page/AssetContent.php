<?php

namespace App\Http\Livewire\User\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shared\Content\PageAsset;

class AssetContent extends Component
{
    use WithPagination;

    public $categoryId;
    public $theme;
    public $alpha;
    public $perPage = 5;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['loadCategory' => 'setCategoryId'];

    public function mount($categoryId = null, $theme = null, $alpha = null)
    {
        $this->categoryId = $categoryId;
        $this->theme = $theme;
        $this->alpha = $alpha;
    }

    public function setCategoryId($id)
    {
        $this->categoryId = $id;
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $items = PageAsset::query()
            ->when($this->categoryId, fn($q) => $q->where('page_asset_category_id', $this->categoryId))
            ->where('is_active', true)
            ->paginate($this->perPage);

        return view('User.Content.Page.Module.Template.Resources.asset-content', [
            'items' => $items,
            'theme' => $this->theme,
            'alpha' => $this->alpha
        ]);
    }
}
