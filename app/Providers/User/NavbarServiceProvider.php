<?php

namespace App\Providers\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Shared\Home\Module;
use App\Models\Shared\Themes\Page;
use App\Models\Shared\Themes\RecordsPage;
use App\Models\Shared\Themes\NavCollection;

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('User.Components.Navbar.layout', function ($view) {
    
            $modules = Module::where('is_active', true)
                ->where('type', 'global')
                ->orderBy('order')
                ->limit(9)
                ->get([
                    'id',
                    'name',
                    'image'
                ]);
    
            $pages = Page::where('is_active', true)
                ->where('show_in_navbar', true)
                ->orderBy('order')
                ->limit(15)
                ->get([
                    'id',
                    'slug',
                    'name',
                    'module_id'
                ])
                ->groupBy('module_id');
    
            $recordsPages = RecordsPage::where('is_active', true)
                ->orderBy('id')
                ->get([
                    'id',
                    'slug',
                    'name',
                    'module_id'
                ])
                ->groupBy('module_id');
    
            $navCollections = NavCollection::where('is_active', true)
                ->whereHas('entries', function ($q) {
                    $q->where('is_active', true);
                })
                ->with([
                    'entries' => function ($q) {
                        $q->where('is_active', true)
                            ->orderBy('order')
                            ->limit(10);
                    }
                ])
                ->orderBy('order')
                ->limit(8)
                ->get()
                ->groupBy('module_id');
    
            $districts = Module::where('is_active', true)
                ->where('type', 'district')
                ->orderBy('order')
                ->limit(6)
                ->get([
                    'id',
                    'name',
                    'image'
                ]);
    
            $view->with([
                'modules' => $modules,
                'pages' => $pages,
                'recordsPages' => $recordsPages,
                'navCollections' => $navCollections,
                'districts' => $districts
            ]);
        });
    }
}
