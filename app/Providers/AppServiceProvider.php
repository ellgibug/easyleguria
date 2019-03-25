<?php

namespace App\Providers;

use App\Page;
use App\Footer;
use App\House;
use App\Slider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('front.partials.footer', function ($view){
            $view->with('footer', Footer::findOrFail(1));
        });

        view()->composer('front.*', function ($view){
            $view->with('slider', Slider::inRandomOrder()->take(1)->first());
        });

        view()->composer('admin.houses.left_menu', function ($view){
            $view->with('houses', House::all());
        });

        view()->composer('admin.pages.left_menu', function ($view){
            $view->with('pages', Page::all());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
