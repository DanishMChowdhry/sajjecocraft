<?php

namespace App\Providers;

use App\Models\Policy;
use App\Models\Category;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;

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
        view()->share('no', 1);
        view()->share('site_settings', SiteSettings::first());
        view()->share('categories', Category::all());
        view()->share('policies', Policy::all());
         View::composer('*', function ($view) {
        $view->with('cartCount', Cart::count());
    });
    }
}
