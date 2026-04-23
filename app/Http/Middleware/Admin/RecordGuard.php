<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class RecordGuard
{
    public function handle(Request $request, Closure $next)
    {
        $allowed = [
            'admin.themes.record.item.store.info',
            'admin.themes.record.item.store.stamp',
            'admin.themes.record.item.store.detail.economy',
            'admin.themes.record.item.store.detail.danger',
            'admin.themes.record.item.store',
        ];

        $response = $next($request);
        if (! in_array($request->route()?->getName(), $allowed)) {
            session()->forget([
                'item', 'step-1', 'step-2', 'step-3', 'step-4', 'step-5',
            ]);
        }
        return $response;
    }
}
