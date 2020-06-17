<?php

namespace Modules\Skill\Providers;

use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Регистрируем все файлы с хелперами  для работы с DataStore или DataSource DevExtreme при загрузке проекта
        foreach (glob( Module::getModulePath('skill') .'/utils/DevExtreme'. '/*.php') as $file) {
            require_once $file;
        }
        spl_autoload_register(array("DevExtreme\LoadHelper", "LoadModule"));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
