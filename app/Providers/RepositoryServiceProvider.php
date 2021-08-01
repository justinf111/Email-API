<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\EmailLogRepository::class, \App\Repositories\EmailLogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmailTemplateRepository::class, \App\Repositories\EmailTemplateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RecipientRepository::class, \App\Repositories\RecipientRepositoryEloquent::class);
        //:end-bindings:
    }
}
