<?php

namespace Grundmanis\Laracms\Modules\Pages\Providers;

use Grundmanis\Laracms\Modules\Pages\Exception\Handler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class PagesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Rewrites the default error handler
//        App::singleton(
//            \App\Exceptions\Handler::class,
//            Handler::class
//        );

        $this->loadViewsFrom(__DIR__ . '/../views', 'laracms.pages');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadRoutesFrom(__DIR__ . '/../laracms_pages_routes.php');

        $this->publishes([
            __DIR__.'/../views/' => resource_path('views/laracms/pages/'),
        ], ['laracms', 'laracms_views', 'laracms_page_views']);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
