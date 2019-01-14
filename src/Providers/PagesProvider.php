<?php

namespace Grundmanis\Laracms\Modules\Pages\Providers;

use Grundmanis\Laracms\Modules\Pages\Exception\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Grundmanis\Laracms\Facades\MenuFacade;

class PagesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'laracms.pages');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadRoutesFrom(__DIR__ . '/../laracms_pages_routes.php');

        $this->publishes([
            __DIR__.'/../views/pages/' => resource_path('views/laracms/pages/'),
        ], 'laracms_pages');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->addMenuRoutes();
    }

    /**
     *
     */
    private function addMenuRoutes()
    {
        $menu = [
            'admin.menu.pages' => 'laracms.pages'
        ];

        MenuFacade::addMenu($menu);
    }

}
