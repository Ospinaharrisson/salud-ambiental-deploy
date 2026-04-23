<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;

class ChemicalTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($module = null, $pageRecordId, $items, $theme, $sortField, $sortBy, $actionsEnabled = false)
    {
        $this->module = $module;
        $this->pageRecordId = $pageRecordId;
        $this->items = $items;
        $this->theme = $theme;
        $this->sortField = $sortField;
        $this->sortBy = $sortBy;
        $this->actionsEnabled = $actionsEnabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shared.chemical-table', [
            'module' => $this->module,
            'pageRecordId' => $this->pageRecordId,
            'items' => $this->items,
            'theme' => $this->theme,
            'sortField' => $this->sortField,
            'sortBy' => $this->sortBy,
            'actionsEnabled' => $this->actionsEnabled,
        ]);
    }
}
