<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use App\Helpers\Admin\CurrentModule;
use App\Models\Shared\Home\Module;

class DashboardBreadcrumb extends Component
{
    public array $items;
    public string $theme = '#38465b';

    public function __construct()
    {
        $this->items = $this->buildItems();

        if (str_contains(Route::currentRouteName(), 'themes')) {
            $module = $this->resolveThemeModule();
            $this->theme = $module?->theme ?? $this->theme;
        }
    }

    private function buildItems(): array
    {
        $config = config('breadcrumbs');
        $rules = $config['rules'] ?? [];
        $tree = $config['tree'] ?? [];
        $segments = explode('.', Route::currentRouteName());

        if (count($segments) >= 2 && $segments[0] === 'admin' && $segments[1] === 'themes') {
            return $this->buildThemesBreadcrumb($segments, $rules, $tree);
        }

        return $this->buildGenericBreadcrumb($segments, $rules, $tree);
    }

    private function getParamFromPath(string $segmentName): ?string
    {
        $path = request()->segments();
        foreach ($path as $i => $seg) {
            if ($seg === $segmentName) {
                return $path[$i + 1] ?? null;
            }
        }
        return null;
    }

    private function resolveModelInstance(?string $modelClass, ?string $paramName, string $segmentKey)
    {
        if (!$modelClass || !$paramName) return null;

        $routeVal = request()->route($paramName);
        if (is_object($routeVal)) return $routeVal;

        $id = $routeVal ?? $this->getParamFromPath($segmentKey);
        if ($id && is_numeric($id) && class_exists($modelClass)) {
            return $modelClass::find($id);
        }

        return null;
    }

    private function buildThemesBreadcrumb(array $segments, array $rules, array $tree): array
    {
        $items = [];
        $module = $this->resolveThemeModule();

        $items[] = [
            'label' => 'Temas / ' . ($module->name ?? 'Sin nombre'),
            'url'   => $module ? route('admin.themes', ['module' => $module->id]) : null,
            'model' => $module,
        ];

        $initialParams = $module ? ['module' => $module->id] : [];
        $themesNode = $tree['admin']['children']['themes'] ?? null;

        if ($themesNode) {
            $this->traverseTree($themesNode, 2, '', $initialParams, $segments, $rules, $items);
        }

        return $items;
    }

    private function buildGenericBreadcrumb(array $segments, array $rules, array $tree): array
    {
        $items = [];

        if (!empty($tree)) {
            $rootKey = array_key_first($tree);
            $rootNode = $tree[$rootKey];
            $this->traverseTree($rootNode, 1, '', [], $segments, $rules, $items);
        } else {
            $items[] = ['label' => 'Ruta sin definición', 'url' => null];
        }

        return $items;
    }

    private function traverseTree(array $node, int $index, string $parentUrl, array $params, array $segments, array $rules, array &$items): void
    {
        $segment = $segments[$index] ?? null;
        if (!$segment || !isset($node['children'][$segment])) return;

        $child = $node['children'][$segment];
        $params = $this->mergeParams($child, $params, $segment);
        $url = $child['route'] ?? null ? route($child['route'], $params ?: []) : $parentUrl;

        $items[] = [
            'label' => $child['label'],
            'url'   => $url,
            'model' => $child['model'] ?? null,
        ];

        $this->appendModelBreadcrumb($child, $segment, $params, $items);

        $next = $segments[$index + 1] ?? null;
        if ($next) {
            if (isset($rules[$next])) {
                $this->appendRuleBreadcrumb($rules[$next], $child, $segment, $items);
            } else {
                $this->traverseTree($child, $index + 1, $url, $params, $segments, $rules, $items);
            }
        }
    }

    private function mergeParams(array $child, array $inherited, string $segment): array
    {
        if (empty($child['param'])) return $inherited;
        $param = $child['param'];

        $value = $inherited[$param] ?? request()->route($param) ?? $this->getParamFromPath($segment);
        if (is_object($value) && isset($value->id)) $value = $value->id;

        if ($value) $inherited[$param] = $value;
        return $inherited;
    }

    private function appendModelBreadcrumb(array $child, string $segment, array $params, array &$items): void
    {
        if (empty($child['model']) || empty($child['param']) || $child['param'] === 'module') return;

        $model = $this->resolveModelInstance($child['model'], $child['param'], $segment)
            ?? $this->resolveFromParams($child, $params);

        if ($model) {
            $items[] = ['label' => $model->name ?? 'Objeto', 'url' => null];
        }
    }

    private function appendRuleBreadcrumb(array $rule, array $child, string $segment, array &$items): void
    {
        $model = $this->resolveModelInstance($child['model'] ?? null, $child['param'] ?? null, $segment);
        $items[] = ['label' => $rule['label'], 'url' => null, 'model' => $model];
    }

    private function resolveThemeModule()
    {
        try {
            if (class_exists(CurrentModule::class)) {
                $module = CurrentModule::get();
                if ($module) return $module;
            }
        } catch (\Throwable) {}

        $routeModule = request()->route('module');
        if ($routeModule instanceof Module) return $routeModule;

        $maybeModuleId = request()->segments()[2] ?? null;
        if ($maybeModuleId && class_exists(Module::class)) {
            return Module::where('id', $maybeModuleId)
                ->orWhere('slug', $maybeModuleId)
                ->first();
        }

        return null;
    }

    private function resolveFromParams(array $child, array $params)
    {
        $param = $child['param'] ?? null;
        if ($param && isset($params[$param]) && class_exists($child['model'])) {
            $val = $params[$param];
            return is_object($val) ? $val : $child['model']::find($val);
        }
        return null;
    }

    public function render()
    {
        return view('Admin.Components.Layout.Includes.dashboard-breadcrumb', [
            'breadcrumbs' => $this->items,
            'theme' => $this->theme,
        ]);
    }
}
