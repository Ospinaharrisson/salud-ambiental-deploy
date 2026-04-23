<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use App\Models\Shared\Home\Module;
use Illuminate\Support\Facades\View;
use App\Helpers\Admin\CurrentModule;

class setModuleContext
{
    public function handle(Request $request, Closure $next)
    {
        $moduleId = $request->route('module'); 
        $module = Module::findOrFail($moduleId);

        CurrentModule::set($module); 
        
        View::share('module', $module);

        $request->attributes->set('module', $module);

        return $next($request);
    }
}

