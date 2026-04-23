<?php

namespace App\Providers\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Shared\Content\AppButton;

class AppButtonServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        View::composer('User.Components.Sections.AppButtons.app-buttons', function ($view) {
            $appButtons = AppButton::where('is_active', true)
                ->orderBy('order')
                ->limit(4)
                ->get();

            $view->with('appButtons', $appButtons);
        });
    }
}
