@extends('frontend.layouts.app')

@section('title', $config['meta_title'] ?? __('frontend.home.meta.title'))
@section('description', $config['meta_description'] ?? __('frontend.home.meta.description'))

@section('content')
<section class="relative hero-primary-gradient text-white overflow-hidden hero-section">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white bg-opacity-20 rounded-full shadow-lg">
                    <x-application-logo class="w-16 h-16" />
                </div>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white hero-title" style="color: var(--hero-heading-color) !important; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                {{ $config['hero_title'] ?? __('frontend.home.hero.default_title') }}
            </h1>
            <p class="text-xl text-white max-w-3xl mx-auto leading-relaxed hero-text" style="color: var(--hero-text-color) !important; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                {{ $config['hero_subtitle'] ?? __('frontend.home.hero.default_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('frontend.products') }}" class="border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-amazon-verde-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    {{ $config['cta_button_text'] ?? __('frontend.home.hero.primary_cta') }}
                </a>
                <a href="{{ route('frontend.contact') }}" class="border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-amazon-verde-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    {{ __('frontend.common.contact_us') }}
                </a>
            </div>
        </div>
    </div>
    
    
</section>
<section id="features" class="py-24 bg-gray-50 text-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                {{ __('frontend.home.sections.products.title') }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ __('frontend.home.sections.products.subtitle') }}
            </p>
        </div>

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories->take(6) as $category)
                    <x-category-card :category="$category" variant="featured" />
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-8">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('frontend.home.sections.products.empty_title') }}</h3>
                <p class="text-gray-600 text-lg">{{ __('frontend.home.sections.products.empty_text') }}</p>
            </div>
        @endif
    </div>
</section>
@if($featuredProducts->count() > 0)
<section class="py-24 bg-white text-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                {{ __('frontend.home.sections.products.featured_title') }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ __('frontend.home.sections.products.featured_subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
                <x-product-card :product="$product" variant="featured" :show-line="false" />
            @endforeach
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('frontend.products') }}" 
               class="inline-flex items-center bg-white text-amazon-verde-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 transition-all duration-300 border-2 border-amazon-verde-600 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                {{ __('frontend.home.sections.products.cta_all') }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif
<section class="py-24 bg-gradient-to-br from-amazon-verde-600 via-amazon-verde-700 to-amazon-verde-800 text-white relative overflow-hidden cta-highlight">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-8">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">
            {{ __('frontend.home.sections.cta.title') }}
        </h2>
        <p class="text-xl text-white mb-12 max-w-3xl mx-auto leading-relaxed">
            {{ __('frontend.home.sections.cta.subtitle') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ route('frontend.products') }}" class="bg-white text-amazon-verde-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                {{ __('frontend.home.sections.cta.cta_products') }}
            </a>
            <a href="{{ route('frontend.contact') }}" class="border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-amazon-verde-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                {{ __('frontend.home.sections.cta.cta_contact') }}
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    
body {
    color: var(--text-body-color) !important;
}

h1, h2, h3, h4, h5, h6 {
    color: var(--text-heading-color) !important;
}

p {
    color: var(--text-secondary-color) !important;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.text-white,
span.text-white {
    color: #ffffff !important;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3) !important;
}

.hero-section .hero-title {
    color: var(--hero-heading-color) !important;
}

.hero-section .hero-text,
.hero-section .hero-text span,
.hero-section .hero-text p {
    color: var(--hero-text-color) !important;
}

.hero-section a {
    color: var(--hero-text-color) !important;
}

.cta-highlight h2,
.cta-highlight h2 *,
.cta-highlight p,
.cta-highlight p * {
    color: #ffffff !important;
}
</style>
@endpush
