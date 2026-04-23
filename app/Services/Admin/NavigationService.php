<?php

namespace App\Services\Admin;

use App\Models\Admin\Components\Navigation\NavigationItem;

class NavigationService
{
    public function getNavigationItems(string $module): array
    {
        return NavigationItem::where('is_active', true)
            ->where('module', $module)
            ->orderBy('category') 
            ->orderBy('order')    
            ->get()
            ->groupBy('category')
            ->toArray();         
    }
}
