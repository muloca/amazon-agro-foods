<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function in_array;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = ['pt_BR', 'en', 'ar'];
        $storedLocale = session('locale');
        $cookieLocale = $request->cookie('preferred_locale');

        if ($request->has('lang') && in_array($request->get('lang'), $availableLocales, true)) {
            $storedLocale = $request->get('lang');
            session(['locale' => $storedLocale]);
        }

        if ($cookieLocale && in_array($cookieLocale, $availableLocales, true)) {
            $storedLocale = $cookieLocale;
            session(['locale' => $storedLocale]);
        }

        $locale = $storedLocale ?? $this->detectLocaleFromRequest($request, $availableLocales, config('app.locale'));

        if (! in_array($locale, $availableLocales, true)) {
            $locale = config('app.fallback_locale', 'pt_BR');
        }

        session(['locale' => $locale]);

        app()->setLocale($locale);

        if ($locale === 'ar') {
            view()->share('isRtl', true);
        }

        $shouldPrompt = ! $cookieLocale;
        $suggestedLocale = $this->detectLocaleFromRequest($request, $availableLocales, $locale);

        view()->share('localePrompt', [
            'show' => $shouldPrompt,
            'suggested' => $suggestedLocale,
            'available' => $availableLocales,
            'current' => $locale,
        ]);

        return $next($request);
    }

    private function detectLocaleFromRequest(Request $request, array $availableLocales, ?string $fallback = null): string
    {
        $preferred = $request->getPreferredLanguage(['pt-BR', 'pt', 'en', 'ar']);
        $normalized = $preferred ? str_replace('-', '_', strtolower($preferred)) : null;

        if (in_array('pt_BR', $availableLocales, true) && in_array($normalized, ['pt_br', 'pt'], true)) {
            return 'pt_BR';
        }

        if (in_array('ar', $availableLocales, true) && in_array($normalized, ['ar', 'ar_sa', 'ar_ae'], true)) {
            return 'ar';
        }

        if (in_array('en', $availableLocales, true) && in_array($normalized, ['en', 'en_us', 'en_gb'], true)) {
            return 'en';
        }

        $fallbackLocale = $fallback ?? config('app.fallback_locale', 'pt_BR');

        return in_array($fallbackLocale, $availableLocales, true) ? $fallbackLocale : $availableLocales[0];
    }
}
