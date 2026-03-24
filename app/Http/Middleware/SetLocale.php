<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * Рус: Устанавливает язык интерфейса (EN/RO/RU) через ?lang= и сессию.
 * EN — базовый.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $supported = ['en','ro','ru'];

        if ($request->has('lang')) {
            $lang = strtolower((string)$request->get('lang'));
            if (in_array($lang, $supported, true)) {
                Session::put('app_locale', $lang);
            }
        }

        $locale = (string) Session::get('app_locale', config('app.locale', 'en'));
        if (!in_array($locale, $supported, true)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
