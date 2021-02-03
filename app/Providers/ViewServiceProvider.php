<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Region;
use App\Models\City;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $view->with(['categories' => Category::where('parent_slug', null)->get()]);
            $view->with(['regions' => Region::all()]);
            $view->with(['cities' => City::all()]);
        });
    }
}
