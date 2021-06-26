<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        if (App::environment('production')) {
            $this->app->bind('path.public', function ($app) {
                return base_path('public_html');
            });
        }

        $this->app->bind('cart.id', function() {
            $id = Cookie::get('cart_id');
            if (!$id) {
                $id = Str::uuid();
                Cookie::queue('cart_id', $id, 60 * 24 * 30);
            }

            return $id;
        });

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
