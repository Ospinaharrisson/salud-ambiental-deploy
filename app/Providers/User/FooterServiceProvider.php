<?php

namespace App\Providers\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Shared\Content\LineOfInterest;
use App\Models\Shared\Content\HealthNetwork;
use App\Models\Shared\Home\FooterItem;

class FooterServiceProvider extends ServiceProvider
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
        View::composer('User.Components.Sections.Footer.footer', function ($view) {
            $lines = LineOfInterest::where('is_active', true)
                ->limit(8)
                ->orderBy('order')
                ->get();
        
            $networks = HealthNetwork::where('is_active', true)
                ->limit(8)
                ->orderBy('order')
                ->get();
        
            $itemLimits = [
                'Acerca del sitio' => 4,
                'Alcaldía Mayor de Bogotá' => 4,
                'Aliados estratégicos' => 8,
                'Secretaría Distrital de Salud' => 5,
                'Ayudas de accesibilidad' => 2,
            ];
        
            $allowedCategories = [
                'Secretaría Distrital de Salud',
                'Acerca del sitio',
                'Aliados estratégicos',
                'Alcaldía Mayor de Bogotá',
                'Ayudas de accesibilidad',
            ];
        
            $allItems = FooterItem::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->groupBy('category');
        
            $accessibilityItems = $allItems->get('Ayudas de accesibilidad', collect())
                ->take($itemLimits['Ayudas de accesibilidad'] ?? 8);
        
            $footerItems = collect();
        
            foreach ($allowedCategories as $category) {
                if ($category === 'Ayudas de accesibilidad') continue;
            
                if ($allItems->has($category)) {
                    $items = $allItems[$category];
                    $limit = $itemLimits[$category] ?? 8;
                    $footerItems[$category] = $items->take($limit);
                }
            }
        
            $view->with([
                'lines' => $lines,
                'networks' => $networks,
                'footerItems' => $footerItems,
                'accessibilityItems' => $accessibilityItems,
            ]);
        });
    }
}
