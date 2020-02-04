<?php

namespace Modules\Directory\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Directory\Repositories\ContinentRepository;
use Modules\Directory\Repositories\ContinentRepositoryApi;
use Modules\Directory\Repositories\CountryRepository;
use Modules\Directory\Repositories\Interfaces\ContinentRepositoryInterface;
use Modules\Directory\Repositories\Interfaces\CountryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *  Easy replace realisation from ContinentRepository::class on ContinentRepositoryApi::class
     * @return void
     */
    public function register()
    {
       $this->app->bind(ContinentRepositoryInterface::class,ContinentRepository::class);
       $this->app->bind(CountryRepositoryInterface::class,CountryRepository::class);
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
