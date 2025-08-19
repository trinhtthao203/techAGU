<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TinTucSuKienController;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $locale = app()->getLocale();
        $arr_lang = Config::get('app.arr_language');
        $tags = TinTucSuKienController::get_tags();
        view()->share('arr_lang', $arr_lang);
        view()->share('tags', $tags);
        Paginator::useBootstrap();

    }
}
