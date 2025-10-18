@extends('frontend.layouts.app')

@section('title', __('frontend.pages.products.meta.title'))
@section('description', __('frontend.pages.products.meta.description'))

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <x-hero-section 
        :title="__('frontend.pages.products.hero.title')"
        :subtitle="__('frontend.pages.products.hero.subtitle')"
        icon="products"
        :show-pattern="true" />

    <!-- Filters Section -->
    <div class="bg-white shadow-lg border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <form id="products-filter-form" method="GET" action="{{ route('frontend.products') }}" class="bg-gray-50 rounded-2xl p-6">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="{{ __('frontend.pages.products.filter.search_placeholder') }}"
                                   class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-amazon-verde-500 focus:border-amazon-verde-500 transition-all duration-200 text-gray-900 placeholder-gray-500 bg-white">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="lg:w-80">
                        <select name="category" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-amazon-verde-500 focus:border-amazon-verde-500 transition-all duration-200 text-gray-900 bg-white" onchange="this.form.submit()">
                            <option value="">{{ __('frontend.pages.products.filter.all_categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <x-product-card :product="$product" variant="default" :show-line="false" />
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-16 flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg p-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-8">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('frontend.pages.products.empty.title') }}</h3>
                <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">{{ __('frontend.pages.products.empty.description') }}</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('frontend.products') }}" class="bg-gradient-to-r from-amazon-verde-600 to-amazon-verde-700 text-white px-8 py-3 rounded-xl hover:from-amazon-verde-700 hover:to-amazon-verde-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        {{ __('frontend.common.view_all_products') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

@push('styles')
<style>
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

.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Garantir contraste adequado para todos os textos */
body {
    color: var(--text-body-color) !important;
}

/* Textos no header azul - FORÇAR BRANCO COM SOMBRA */
.bg-gradient-to-br h1,
.bg-gradient-to-br h2,
.bg-gradient-to-br h3,
.bg-gradient-to-br h4,
.bg-gradient-to-br h5,
.bg-gradient-to-br h6 {
    color: var(--hero-heading-color) !important;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3) !important;
}

.bg-gradient-to-br p {
    color: var(--hero-text-color) !important;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3) !important;
}

/* Forçar branco em qualquer elemento dentro do header azul */
.bg-gradient-to-br * {
    color: var(--hero-text-color) !important;
}

/* Específico para o container do header */
.relative.bg-gradient-to-br h1,
.relative.bg-gradient-to-br h2,
.relative.bg-gradient-to-br h3,
.relative.bg-gradient-to-br h4,
.relative.bg-gradient-to-br h5,
.relative.bg-gradient-to-br h6,
.relative.bg-gradient-to-br p,
.relative.bg-gradient-to-br span,
.relative.bg-gradient-to-br div {
    color: var(--hero-text-color) !important;
}

/* Textos nos cards de produtos */
.bg-white h1,
.bg-white h2,
.bg-white h3,
.bg-white h4,
.bg-white h5,
.bg-white h6 {
    color: var(--text-heading-color) !important;
}

.bg-white p {
    color: var(--text-secondary-color) !important;
}

/* Inputs e selects */
input[type="text"],
input[type="email"],
input[type="password"],
select,
textarea {
    color: var(--text-body-color) !important;
    background-color: #ffffff !important;
}

input::placeholder {
    color: var(--text-muted-color) !important;
}

/* Garantir que todos os textos tenham contraste */
.text-gray-900 {
    color: var(--text-heading-color) !important;
}

.text-gray-700 {
    color: var(--text-secondary-color) !important;
}

.text-gray-600 {
    color: var(--text-muted-color) !important;
}

.text-white {
    color: #ffffff !important;
}

.text-blue-100 {
    color: #dbeafe !important;
}

/* FORÇAR BRANCO ABSOLUTO - Sobrescrever qualquer classe */
.text-white,
h1.text-white,
h2.text-white,
h3.text-white,
h4.text-white,
h5.text-white,
h6.text-white,
p.text-white,
span.text-white,
div.text-white {
    color: #ffffff !important;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3) !important;
}

/* Garantir que textos grandes sejam brancos */
h1, h2, h3, h4, h5, h6 {
    color: #1f2937 !important;
}

/* Mas no header azul, forçar branco */
.bg-gradient-to-br h1,
.bg-gradient-to-br h2,
.bg-gradient-to-br h3,
.bg-gradient-to-br h4,
.bg-gradient-to-br h5,
.bg-gradient-to-br h6 {
    color: #ffffff !important;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3) !important;
}
</style>
@endpush
