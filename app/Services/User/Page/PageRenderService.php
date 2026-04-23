<?php

namespace App\Services\User\Page;

use App\Models\Shared\Themes\Page;
use App\Models\Shared\Themes\ModuleBanner;
use App\Models\Shared\Themes\ModuleButton;
use App\Models\Shared\Themes\RecordsPage;
use App\Models\Shared\Home\HomePage;
use App\Models\Shared\Home\Module;

class PageRenderService
{
    public function getPageData($id, $slug)
    {
        $page = Page::with(['categories' => function ($q) {
            $q->where('is_active', true)
              ->orderBy('order')
              ->whereHas('assets', fn($qa) => $qa->where('is_active', true))
              ->withCount(['assets as assets_active_count' => fn($qa) => $qa->where('is_active', true)]);
        }])
        ->where('is_active', true)
        ->where('id', $id)
        ->where('slug', $slug)
        ->firstOrFail();

        $theme = optional($page->module)->theme;
        $banner = ModuleBanner::where('module_id', $page->module_id)->first();
        $buttons = ModuleButton::where('module_id', $page->module_id)
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(5)
            ->get();

        $totalAssets = $page->categories->sum('assets_active_count');
        $categoriesByGroup = $page->categories->groupBy(fn($cat) => $cat->groupTitle ?? '');
        $config = $this->getConfigFromCategories($categoriesByGroup, 12, 4);

        return compact('page', 'banner', 'buttons', 'theme', 'categoriesByGroup', 'totalAssets', 'config');
    }

    public function getRecordsPageData($id, $slug)
    {
        $page = RecordsPage::where('is_active', true)
            ->where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        $theme = optional($page->module)->theme;
        $banner = ModuleBanner::where('module_id', $page->module_id)->first();
        $buttons = ModuleButton::where('module_id', $page->module_id)
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(5)
            ->get();

        return compact('page', 'banner', 'buttons', 'theme');
    }

    public function getQuestionsModules()
    {
        $modules = Module::select('id', 'name', 'theme')
            ->with([
                'banner',
                'questions' => function ($q) {
                    $q->where('is_active', true)->orderBy('order');
                }
            ])
            ->where('is_active', true)
            ->get();

        return compact('modules');
    }

    public function getEstablishmentsByCategory(string $category)
    {
        $relationName = match ($category) {
            'accredited' => 'accreditedEstablishments',
            'favorable'  => 'favorableEstablishments',
            default      => 'establishmentAssets',
        };

        $modules = Module::select('id', 'name', 'theme')
            ->with([
                $relationName => function ($q) {
                    $q->where('is_active', true)
                      ->orderBy('order');
                },
                'banner'
            ])
            ->where('is_active', true)
            ->get();

        $config = [
            'category'  => $category,
            'title'     => $category === 'accredited'
                ? 'Establecimientos acreditados'
                : 'Establecimientos favorables',
            'banner'    => "assets/images/user/Content/Establishment/{$category}-banner.png",
            'theme'     => $category === 'accredited' ? '#0072bb' : '#009688',
            'emptyText' => $category === 'accredited'
                ? 'Sin establecimientos acreditados'
                : 'Sin establecimientos favorables',
        ];

        return compact('modules', 'config');
    }
    
    public function getHomePageData($id)
    {
        $page = HomePage::findOrFail($id);
        return compact('page');
    }

    public function getConfigFromCategories($categoriesByGroup, int $gap = 12, int $maxVisible = 4): array
    {
        $result = [
            'gap' => $gap,
            'groups' => [],
        ];

        foreach ($categoriesByGroup as $groupName => $categories) {
            $count = is_countable($categories) ? count($categories) : 0;
        
            $visible = $count > 0 ? min($count, $maxVisible) : 0;

            if ($visible > 0) {
                $percent = 100 / $visible;
                $subtract = (($visible - 1) * $gap) / $visible;
                $basis = "calc({$percent}% - {$subtract}px)";
            } else {
                $basis = '100%';
            }

            $bases = [];
            for ($i = 0; $i < $count; $i++) {
                $bases[] = $basis;
            }

            $result['groups'][(string)$groupName] = [
                'count'   => $count,
                'visible' => $visible,
                'basis'   => $basis,
                'bases'   => $bases,
            ];
        }

        return $result;
    }
}
