<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas web del proyecto
|--------------------------------------------------------------------------
|
| Aquí se definen las rutas accesibles vía navegador.
|
*/
 
require __DIR__ . '/Admin/routes.php';

// Route::middleware('auth')->group(function () {
    Route::prefix('/admin/home/')
        ->name('admin.home.')
        ->group(function () {
            require __DIR__ . '/Admin/Home/article.php';
            require __DIR__ . '/Admin/Home/banner.php';
            require __DIR__ . '/Admin/Home/buttons.php';
            require __DIR__ . '/Admin/Home/calendar.php';
            require __DIR__ . '/Admin/Home/establishment.php';
            // require __DIR__ . '/Admin/Home/footer.php';
            require __DIR__ . '/Admin/Home/gallery.php';
            require __DIR__ . '/Admin/Home/image.php';
            require __DIR__ . '/Admin/Home/insight.php';
            require __DIR__ . '/Admin/Home/line.php';
            require __DIR__ . '/Admin/Home/media.php';
            require __DIR__ . '/Admin/Home/message.php';
            require __DIR__ . '/Admin/Home/modules.php';
            require __DIR__ . '/Admin/Home/network.php';
            require __DIR__ . '/Admin/Home/page.php';
            require __DIR__ . '/Admin/Home/point.php';
            require __DIR__ . '/Admin/Home/video.php';
        }
    );

    Route::prefix('admin/themes/{module}/')
        ->middleware(['module.context'])
        ->name('admin.themes.')
        ->group(function () {
            require __DIR__ . '/Admin/Themes/assets.php';
            require __DIR__ . '/Admin/Themes/banner.php';
            require __DIR__ . '/Admin/Themes/buttons.php';
            require __DIR__ . '/Admin/Themes/establishments.php';
            require __DIR__ . '/Admin/Themes/navigation.php';
            require __DIR__ . '/Admin/Themes/page.php';
            require __DIR__ . '/Admin/Themes/questions.php';
            require __DIR__ . '/Admin/Themes/records.php';
        }
    );
// });

require __DIR__ . '/Shared/routes.php';

require __DIR__ . '/User/routes.php';
require __DIR__ . '/User/page.php';
require __DIR__ . '/User/article.php';
require __DIR__ . '/User/gallery.php';
require __DIR__ . '/User/calendar.php';