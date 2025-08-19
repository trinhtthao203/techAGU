<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App;
use Illuminate\Support\Facades\Config;
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);
        if(in_array($locale, Config::get('app.arr_locale'))){
            app()->setLocale($locale);
            return $next($request);
        } else {
            echo 'NO LANGUAGE';
            exit();
        }
    }
}
