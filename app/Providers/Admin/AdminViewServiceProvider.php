<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use App\Services\Admin\NavigationService;
use Illuminate\Support\Facades\Route;

class AdminViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(NavigationService::class, function ($app) {
            return new NavigationService();
        });
    }

    public function boot()
    {
        view()->composer('Admin.Components.Sidebar.dashboard-sidebar', function ($view) {
            $module = 'home';
            $moduleId = null;
        
            if (str_starts_with(Route::currentRouteName(), 'admin.themes')) {
                $module = 'themes';
                $moduleId = Route::current()->parameter('module_id');
            }
        
            $navigationItems = app(NavigationService::class)->getNavigationItems($module);
        
            $view->with([
                'navigationItems' => $navigationItems,
                'module_id' => $moduleId,
            ]);
        });
    }
}
