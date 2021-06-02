<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('filter', function($attribute, $value, $params) {
            foreach ($params as $word) {
                if (stripos($value, $word) !== false) {
                    return false;
                }
            }
            return true;
        }, 'Invalid Word!');

        // With vendor:publish
        //Paginator::defaultView('vendor.pagination.bootstrap-4');
        //Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-4');
        // Without vendor:publish
        Paginator::useBootstrap();
    }
}
