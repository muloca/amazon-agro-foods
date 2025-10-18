<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ($isRtl ?? false) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $config['meta_title'] ?? __('frontend.home.meta.title'))</title>
    <meta name="description" content="@yield('description', $config['meta_description'] ?? __('frontend.home.meta.description'))">
    <meta name="keywords" content="@yield('keywords', $config['meta_keywords'] ?? 'frigorífico, produtos, qualidade')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
    
    @php
        $heroBackgroundStart = $config['hero_background_start_color'] ?? ($config['primary_color'] ?? '#03662c');
        $heroBackgroundEnd = $config['hero_background_end_color'] ?? $heroBackgroundStart;
        $heroBackground = strtolower($heroBackgroundStart) === strtolower($heroBackgroundEnd)
            ? $heroBackgroundStart
            : "linear-gradient(135deg, {$heroBackgroundStart} 0%, {$heroBackgroundEnd} 100%)";
    @endphp

    <style>
        :root {
            --primary-color: {{ $config['primary_color'] ?? '#03662c' }};
            --secondary-color: {{ $config['secondary_color'] ?? '#58ac43' }};
            --accent-color: {{ $config['accent_color'] ?? '#e5d830' }};
            --text-heading-color: {{ $config['text_heading_color'] ?? '#111827' }};
            --text-body-color: {{ $config['text_body_color'] ?? '#1f2937' }};
            --text-secondary-color: {{ $config['text_secondary_color'] ?? '#374151' }};
            --text-muted-color: {{ $config['text_muted_color'] ?? '#6b7280' }};
            --hero-heading-color: {{ $config['hero_heading_color'] ?? '#ffffff' }};
            --hero-text-color: {{ $config['hero_text_color'] ?? '#f8fafc' }};
            --hero-background-start: {{ $heroBackgroundStart }};
            --hero-background-end: {{ $heroBackgroundEnd }};
            --hero-background: {{ $heroBackground }};
            --card-title-color: {{ $config['card_title_color'] ?? '#111827' }};
            --card-text-color: {{ $config['card_text_color'] ?? '#4b5563' }};
            --footer-heading-color: {{ $config['footer_heading_color'] ?? '#ffffff' }};
            --footer-text-color: {{ $config['footer_text_color'] ?? '#d1d5db' }};
        }
        /* Garantir que os textos estejam visíveis */
        body {
            color: var(--text-body-color) !important;
            background-color: #ffffff !important;
        }
        
        h1, h2, h3, h4, h5, h6 {
            color: var(--text-heading-color) !important;
        }
        
        p, span, div {
            color: var(--text-secondary-color) !important;
        }
        
        .text-gray-900 {
            color: var(--text-heading-color) !important;
        }
        
        .text-gray-700 {
            color: var(--text-secondary-color) !important;
        }
        
        .text-gray-600 {
            color: var(--text-muted-color) !important;
        }

        .text-gray-500 {
            color: var(--text-muted-color) !important;
        }

        .card-title,
        .card-title * {
            color: var(--card-title-color) !important;
        }

        .card-text,
        .card-text * {
            color: var(--card-text-color) !important;
        }

        /* Gradiente dinâmico para hero sections - sempre usa a cor primária configurada */
        .hero-primary-gradient {
            background: var(--hero-background);
            background-color: var(--hero-background-start);
        }

        .site-footer h1,
        .site-footer h2,
        .site-footer h3,
        .site-footer h4,
        .site-footer h5,
        .site-footer h6 {
            color: var(--footer-heading-color) !important;
        }

        .site-footer p,
        .site-footer span,
        .site-footer a,
        .site-footer li {
            color: var(--footer-text-color) !important;
        }

        .site-footer a:hover {
            color: var(--footer-heading-color) !important;
        }

        .site-footer .text-gray-300,
        .site-footer .text-gray-400,
        .site-footer .text-gray-500 {
            color: var(--footer-text-color) !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900 {{ ($isRtl ?? false) ? 'rtl' : '' }}">
    @php
        $localePromptData = $localePrompt ?? [];
        $languageNames = [
            'pt_BR' => __('frontend.language_names.pt_BR'),
            'en' => __('frontend.language_names.en'),
            'ar' => __('frontend.language_names.ar'),
        ];
        $suggestedLocale = $localePromptData['suggested'] ?? app()->getLocale();
    @endphp

    @if(($localePromptData['show'] ?? false) && !request()->routeIs('filament.*'))
        <div
            x-data="{ open: true }"
            x-init="$watch('open', value => document.body.classList.toggle('overflow-hidden', value))"
            x-cloak
            x-show="open"
            class="fixed inset-0 z-[999] flex items-center justify-center px-4"
        >
            <div class="absolute inset-0 bg-black/80 backdrop-blur-md transition-opacity" aria-hidden="true"></div>
            <div class="relative z-10 bg-white shadow-2xl rounded-2xl max-w-xl w-full p-8">
                <h2 class="text-2xl font-bold text-gray-900">{{ __('frontend.language_prompt.title') }}</h2>
                <p class="mt-2 text-gray-600">{{ __('frontend.language_prompt.description', ['language' => $languageNames[$suggestedLocale] ?? $suggestedLocale]) }}</p>

                <div class="mt-6 space-y-5">
                    <a href="{{ route('locale.switch', ['locale' => $suggestedLocale, 'remember' => 1]) }}" class="block w-full text-center px-5 py-3 rounded-xl text-white font-semibold bg-gradient-to-r from-amazon-verde-600 to-amazon-verde-700 hover:from-amazon-verde-700 hover:to-amazon-verde-800 transition">
                        {{ __('frontend.language_prompt.recommended', ['language' => $languageNames[$suggestedLocale] ?? $suggestedLocale]) }}
                    </a>

                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-3">{{ __('frontend.language_prompt.other_options') }}</p>
                        <div class="flex flex-wrap gap-3">
                            @foreach(($localePromptData['available'] ?? []) as $option)
                                @continue($option === $suggestedLocale)
                                <a href="{{ route('locale.switch', ['locale' => $option, 'remember' => 1]) }}" class="flex-1 min-w-[130px] text-center px-4 py-2.5 rounded-lg border border-gray-200 hover:border-amazon-verde-500 hover:bg-amazon-verde-50 text-gray-700 font-medium transition">
                                    {{ $languageNames[$option] ?? $option }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <p class="text-xs text-gray-500">{{ __('frontend.language_prompt.note') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Header -->
    <header x-data="{ mobileMenuOpen: false }" @keydown.window.escape="mobileMenuOpen = false" class="bg-white shadow-lg border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-12 h-12 flex items-center justify-center">
                            <x-application-logo class="w-12 h-12" />
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $config['site_name'] ?? 'Amazon Frigorífico' }}</h1>
                            <p class="text-sm text-gray-500">{{ $config['site_description'] ?? 'Especialistas em produtos de qualidade' }}</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-6 rtl:space-x-reverse">
                    @php
                        $navLinks = [
                            ['route' => 'home', 'label' => __('frontend.nav.home')],
                            ['route' => 'frontend.products', 'label' => __('frontend.nav.products')],
                            ['route' => 'frontend.about', 'label' => __('frontend.nav.about')],
                            ['route' => 'frontend.history', 'label' => __('frontend.nav.history')],
                            ['route' => 'frontend.news', 'label' => __('frontend.nav.news')],
                            ['route' => 'frontend.contact', 'label' => __('frontend.nav.contact')],
                        ];
                        $localeOptions = [
                            'pt_BR' => ['flag' => '🇧🇷', 'label' => __('frontend.language_names.pt_BR')],
                            'en' => ['flag' => '🇺🇸', 'label' => __('frontend.language_names.en')],
                            'ar' => ['flag' => '🇸🇦', 'label' => __('frontend.language_names.ar')],
                        ];
                        $currentLocale = app()->getLocale();
                    @endphp
                    <nav class="flex space-x-1 rtl:space-x-reverse">
                        @foreach($navLinks as $link)
                            <a href="{{ route($link['route']) }}" class="text-gray-700 hover:text-amazon-verde-600 hover:bg-amazon-verde-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </nav>
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        @foreach($localeOptions as $code => $option)
                            <a href="{{ route('locale.switch', $code) }}"
                               class="flex items-center justify-center w-10 h-10 border {{ $currentLocale === $code ? 'border-amazon-verde-600 bg-amazon-verde-50 text-amazon-verde-700' : 'border-gray-200 text-gray-500 hover:border-amazon-verde-300 hover:text-amazon-verde-600' }} rounded-full transition-all duration-200"
                               aria-label="{{ $option['label'] }}">
                                <span class="text-lg" role="img" aria-hidden="true">{{ $option['flag'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Auth Links -->
                @guest
                    <div class="hidden md:flex items-center space-x-3 rtl:space-x-reverse">
                        @auth
                            <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-gray-700 hover:text-amazon-verde-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                {{ __('frontend.nav.admin') }}
                            </a>
                        @endauth
                        @auth
                            <a href="{{ route('filament.admin.auth.logout') }}" class="bg-gradient-to-r from-amazon-verde-600 to-amazon-verde-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:from-amazon-verde-700 hover:to-amazon-verde-800 transition-all duration-200 shadow-md hover:shadow-lg" onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();">
                                {{ __('frontend.nav.logout') }}
                            </a>
                            <form id="logout-form-desktop" action="{{ route('filament.admin.auth.logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @endauth
                    </div>
                @endguest

                <div class="flex md:hidden items-center rtl:space-x-reverse">
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen.toString()" aria-controls="mobile-primary-navigation" aria-label="{{ __('frontend.nav.menu') }}" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-amazon-verde-600 hover:bg-amazon-verde-50 focus:outline-none focus:ring-2 focus:ring-amazon-verde-500 focus:ring-offset-2 focus:ring-offset-white transition-colors duration-200">
                        <svg x-cloak x-show="!mobileMenuOpen" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-cloak x-show="mobileMenuOpen" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">{{ __('frontend.nav.menu') }}</span>
                    </button>
                </div>
            </div>

            <div x-cloak x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-gray-100" id="mobile-primary-navigation">
                <div class="py-4 space-y-4">
                    <nav class="px-4 space-y-2">
                        @foreach($navLinks as $link)
                            @php $isActive = request()->routeIs($link['route']); @endphp
                            <a href="{{ route($link['route']) }}"
                               @click="mobileMenuOpen = false"
                               class="block px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ $isActive ? 'bg-amazon-verde-50 text-amazon-verde-700' : 'text-gray-700 hover:bg-amazon-verde-50 hover:text-amazon-verde-600' }}">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </nav>

                    <div class="border-t border-gray-100"></div>

                    <div class="px-4 space-y-3">
                        <p class="text-xs font-semibold text-gray-500">{{ __('frontend.language_switcher.label') }}</p>
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            @foreach($localeOptions as $code => $option)
                                <a href="{{ route('locale.switch', $code) }}"
                                   @click="mobileMenuOpen = false"
                                   class="flex items-center justify-center w-10 h-10 border {{ $currentLocale === $code ? 'border-amazon-verde-600 bg-amazon-verde-50 text-amazon-verde-700' : 'border-gray-200 text-gray-500 hover:border-amazon-verde-300 hover:text-amazon-verde-600' }} rounded-full transition-all duration-200"
                                   aria-label="{{ $option['label'] }}">
                                    <span class="text-lg" role="img" aria-hidden="true">{{ $option['flag'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @guest
                        <div class="border-t border-gray-100"></div>

                        <div class="px-4 space-y-2">
                            @auth
                                <a href="{{ route('filament.admin.pages.dashboard') }}" @click="mobileMenuOpen = false" class="block text-gray-700 hover:text-amazon-verde-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                    {{ __('frontend.nav.admin') }}
                                </a>
                            @endauth
                            @auth
                                <a href="{{ route('filament.admin.auth.logout') }}" @click.prevent="mobileMenuOpen = false; document.getElementById('logout-form-mobile').submit();" class="block bg-gradient-to-r from-amazon-verde-600 to-amazon-verde-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:from-amazon-verde-700 hover:to-amazon-verde-800 transition-all duration-200 shadow-md hover:shadow-lg">
                                    {{ __('frontend.nav.logout') }}
                                </a>
                                <form id="logout-form-mobile" action="{{ route('filament.admin.auth.logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-amazon-verde-800 to-amazon-verde-900 text-white site-footer">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-amazon-verde-500 to-amazon-verde-600 rounded-lg flex items-center justify-center">
                            <span class="text-white text-lg font-bold">A</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">{{ $config['site_name'] ?? 'Amazon Frigorífico' }}</h3>
                            <p class="text-amazon-verde-300 text-sm">{{ $config['site_description'] ?? 'Especialistas em produtos de qualidade' }}</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        {{ $config['site_description'] ?? 'Especialistas em produtos de qualidade para sua família' }}
                    </p>
                    <div class="flex space-x-4">
                        @if(!empty($config['social_facebook']))
                        <a href="{{ $config['social_facebook'] }}" target="_blank" class="w-10 h-10 bg-amazon-verde-700 hover:bg-amazon-azul-600 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        @endif
                        
                        @if(!empty($config['social_instagram']))
                        <a href="{{ $config['social_instagram'] }}" target="_blank" class="w-10 h-10 bg-amazon-verde-700 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                        @endif
                        
                        @if(!empty($config['social_whatsapp']))
                        <a href="{{ $config['social_whatsapp'] }}" target="_blank" class="w-10 h-10 bg-amazon-verde-700 hover:bg-green-600 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('frontend.footer.quick_links') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">{{ __('frontend.footer.links.home') }}</a></li>
                        <li><a href="{{ route('frontend.products') }}" class="text-gray-300 hover:text-white">{{ __('frontend.footer.links.products') }}</a></li>
                        <li><a href="{{ route('frontend.about') }}" class="text-gray-300 hover:text-white">{{ __('frontend.footer.links.about') }}</a></li>
                        <li><a href="{{ route('frontend.history') }}" class="text-gray-300 hover:text-white">{{ __('frontend.footer.links.history') }}</a></li>
                        <li><a href="{{ route('frontend.news') }}" class="text-gray-300 hover:text-white">{{ __('frontend.footer.links.news') }}</a></li>
                        <li><a href="{{ route('frontend.contact') }}" class="text-gray-300 hover:text-white">{{ __('frontend.footer.links.contact') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('frontend.footer.contact_title') }}</h3>
                    <ul class="space-y-2">
                        @if(contact_phone())
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span class="text-gray-300">{{ contact_phone() }}</span>
                        </li>
                        @endif

                        @if(contact_phone_secondary())
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span class="text-gray-300">{{ contact_phone_secondary() }}</span>
                        </li>
                        @endif
                        
                        @if(contact_email())
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <span class="text-gray-300">{{ contact_email() }}</span>
                        </li>
                        @endif
                        
                        @if(contact_address())
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-300 text-sm">{{ contact_address() }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">
                    © {{ date('Y') }} {{ $config['site_name'] ?? 'Amazon Frigorífico' }}. {{ __('frontend.footer.rights') }}
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
