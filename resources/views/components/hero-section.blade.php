@props([
    'title' => 'Título Padrão',
    'subtitle' => 'Subtítulo padrão',
    'icon' => 'default',
    'background' => 'blue',
    'showPattern' => true
])

@php
    // Usar sempre o gradiente dinâmico baseado na cor primária configurada no painel
    $backgroundClasses = 'hero-primary-gradient';
    
    $iconSvg = match($icon) {
        'products' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>',
        'categories' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>',
        'about' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'history' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'news' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h4l2 2h4a2 2 0 012 2v11a2 2 0 01-2 2z"></path>',
        'contact' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8m-2 8a2 2 0 01-2 2H7a2 2 0 01-2-2V6"></path>',
        default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>'
    };
@endphp

<div class="relative {{ $backgroundClasses }} text-white overflow-hidden hero-section">
    @if($showPattern)
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
    @endif
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $iconSvg !!}
                </svg>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white" style="color: var(--hero-heading-color) !important; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                {{ $title }}
            </h1>
            <p class="text-xl text-white max-w-3xl mx-auto leading-relaxed" style="color: var(--hero-text-color) !important; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                {{ $subtitle }}
            </p>
        </div>
    </div>
</div>
