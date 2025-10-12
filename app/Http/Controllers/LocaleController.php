<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        $available = ['pt_BR', 'en', 'ar'];

        if (! in_array($locale, $available, true)) {
            abort(404);
        }

        session(['locale' => $locale]);
        session()->forget('locale_prompt_suggested');

        $redirectUrl = $request->headers->get('referer') ?? route('home');
        $remember = $request->boolean('remember', true);

        $response = redirect()->to($redirectUrl);

        if ($remember) {
            $response->withCookie(cookie('preferred_locale', $locale, 60 * 24 * 365));
        }

        return $response;
    }
}
