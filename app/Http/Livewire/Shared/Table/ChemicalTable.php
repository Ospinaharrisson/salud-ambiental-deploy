<?php

namespace App\Http\Livewire\Shared\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shared\Themes\ChemicalItem;

class ChemicalTable extends Component
{
    use WithPagination;

    public $module;
    public $pageRecordId;
    public $perPage = 10;
    public $searchRequest = '';
    public $sortField = 'name';
    public $sortBy = 'asc';
    public $actionsEnabled;
    public $showAllElements = true;

    public function mount($module = null, $pageRecordId, $theme)
    {
        $this->module = $module;
        $this->pageRecordId = $pageRecordId;
        $this->theme = $theme;
    }

    public function render()
    {
        $query = ChemicalItem::where('record_page_id', $this->pageRecordId);

        if(!$this->showAllElements) {
            $query->where('is_active', true);
        }

        if (!empty($this->searchRequest)) {
            $search = '%' . $this->searchRequest . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('cas_number', 'like', $search)
                  ->orWhere('onu_number', 'like', $search)
                  ->orWhere('monthly_stored', 'like', $search)
                  ->orWhere('monthly_used', 'like', $search)
                  ->orWhere('score', 'like', $search);
            });
        }
    
        $query->orderBy($this->sortField, $this->sortBy);

        $items = $query->paginate($this->perPage);

        return view('components.shared.chemical-view', [
            'module' => $this->module,
            'pageRecordId' => $this->pageRecordId,
            'items' => $items,
            'theme' => $this->theme,
            'sortField' => $this->sortField,
            'sortBy' => $this->sortBy,
            'actionsEnabled' => $this->actionsEnabled,
        ]);
    }


    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingSearchRequest()
    {
        $this->resetPage();
    }


    public function sortByColumn($field)
    {
        if ($this->sortField === $field) {
            $this->sortBy = $this->sortBy === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortBy = 'asc';
        }
        
        $this->resetPage();
    }
}