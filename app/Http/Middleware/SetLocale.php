<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = ['pt_BR', 'en', 'ar'];
        $storedLocale = session('locale');

        if ($request->has('lang') && in_array($request->get('lang'), $availableLocales, true)) {
            $storedLocale = $request->get('lang');
            session(['locale' => $storedLocale]);
        }

        $locale = $storedLocale ?? config('app.locale');

        if (! in_array($locale, $availableLocales, true)) {
            $locale = config('app.fallback_locale', 'pt_BR');
        }

        app()->setLocale($locale);

        if ($locale === 'ar') {
            view()->share('isRtl', true);
        }

        return $next($request);
    }
}
