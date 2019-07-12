<?php

namespace Grundmanis\Laracms\Modules\Pages;

class LayoutsLoader {

    /**
     * @var array
     */
    protected $layouts = [];

    /**
     * Load layouts
     */
    public function load()
    {
        $layoutsFolder = resource_path('views/laracms/pages/pages/layouts');

        if (!file_exists($layoutsFolder)) {
            dd('Path ' . $layoutsFolder . ' doesn\'t exists, please create it ot run the console command "php artisan laracms:configure"');
        }

        foreach (array_diff(scandir($layoutsFolder), ['.', '..']) as $layout) {
            $name = str_replace('.blade.php', '', $layout);
            $this->layouts[] = $name;
        }

        return $this->layouts;
    }
}