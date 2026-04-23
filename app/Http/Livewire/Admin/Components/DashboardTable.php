<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shared\Home\Module;
use Illuminate\Support\Facades\Schema;

class DashboardTable extends Component
{
    use WithPagination;

    public ?Module $module = null;
    public $ancestors = [];
    public $header = [];
    public $columns = [];
    public $fields = [];
    public $sort = [];
    public $status = [];
    public $edit = [];
    public $toggle = [];
    public $actions = [];
    public $delete = [];
    public $create = [];
    public $alignments = [];
    public $pageSize = true;
    public $perPage = 5;
    public $model = '';
    public $customQuery = [];

    protected $paginationTheme = 'bootstrap';

    public function mount(
        Module $module = null,
        $ancestors = [],
        $header = [],
        $columns = [],
        $fields = [],
        $sort = [],
        $status = [],
        $edit = [],
        $toggle = [],
        $actions = [],
        $delete = [],
        $create = [],
        $alignments = [],
        $pageSize = true,
        $model = ''
    ) {
        $this->module = $module;
        $this->ancestors = $ancestors;
        $this->header = $header;
        $this->columns = $columns;
        $this->fields = $fields;
        $this->sort = $sort;
        $this->status = $status;
        $this->edit = $edit;
        $this->toggle = $toggle;
        $this->actions = $actions;
        $this->delete = $delete;
        $this->create = $create;
        $this->alignments = $alignments;
        $this->model = $model;
        $this->pageSize = $pageSize;
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    protected function buildQuery()
    {
        if (!$this->model || !class_exists($this->model)) {
            return null;
        }

        $modelClass = $this->model;
        $instance = new $modelClass;
        $table = $instance->getTable();

        $query = $modelClass::query();

        if (Schema::hasColumn($table, 'is_active')) {
            $query->orderByDesc('is_active');
        }

        if (Schema::hasColumn($table, 'order')) {
            $query->orderBy('order');
        }

        if (Schema::hasColumn($table, 'created_at')) {
            $query->orderByDesc('created_at');
        }

        foreach ($this->customQuery as $filter) {
            $method = $filter['method'] ?? 'where';
            $field  = $filter['field'] ?? null;
            $value  = $filter['value'] ?? null;

            if ($method === 'where' && $field && $value !== null) {
                $query->where($field, $value);
            }

            if ($method === 'like' && $field && $value) {
                $query->where($field, 'like', "%{$value}%");
            }
        }
        
        return $query;
    }

    public function render()
    {
        $query = $this->buildQuery();

        $items = $query ? $query->paginate($this->perPage) : collect();
        
        return view('Admin.Components.Sections.Table.dashboard-table')->with([
            'module' => $this->module,
            'ancestors' => $this->ancestors,
            'header' => $this->header,
            'columns' => $this->columns,
            'fields' => $this->fields,
            'sort' => $this->sort,
            'status' => $this->status,
            'edit' => $this->edit,
            'toggle' => $this->toggle,
            'actions' => $this->actions,
            'delete' => $this->delete,
            'create' => $this->create,
            'alignments' => $this->alignments,
            'items' => $items,
        ]);
    }
}
