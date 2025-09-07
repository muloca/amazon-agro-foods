@props(['category', 'variant' => 'default'])

@php
    $cardClasses = match($variant) {
        'compact' => 'group bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100',
        'featured' => 'group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden',
        'page' => 'group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden',
        default => 'group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden'
    };
    
    $iconSize = match($variant) {
        'compact' => 'w-12 h-12',
        'featured' => 'w-16 h-16',
        'page' => 'w-8 h-8',
        default => 'w-16 h-16'
    };
    
    $titleSize = match($variant) {
        'compact' => 'text-lg',
        'featured' => 'text-2xl',
        'page' => 'text-2xl',
        default => 'text-xl'
    };
@endphp

@if($variant === 'page')
    <!-- Design da página de categorias -->
    <div class="{{ $cardClasses }}">
        <!-- Category Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">{{ $category->name }}</h3>
                    <p class="text-blue-100 text-sm">
                        {{ $category->products_count ?? $category->products->count() }} {{ ($category->products_count ?? $category->products->count()) == 1 ? 'produto' : 'produtos' }}
                    </p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Category Content -->
        <div class="p-6">
            @if($category->description)
                <p class="text-gray-600 mb-6 line-clamp-3">
                    {{ $category->description }}
                </p>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="{{ route('frontend.category', $category) }}" 
                   class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium text-center">
                    Ver Produtos
                </a>
                <a href="{{ route('frontend.products', ['category' => $category->id]) }}" 
                   class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors font-medium text-center">
                    Filtrar
                </a>
            </div>
        </div>

        <!-- Category Preview (if has products) -->
        @if(($category->products_count ?? $category->products->count()) > 0)
            <div class="px-6 pb-6">
                <div class="border-t pt-4">
                    <p class="text-sm text-gray-500 mb-3">Alguns produtos desta categoria:</p>
                    <div class="flex -space-x-2">
                        @foreach($category->products->take(3) as $product)
                            <div class="relative">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-10 h-10 rounded-full border-2 border-white object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        
                        @if(($category->products_count ?? $category->products->count()) > 3)
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center">
                                <span class="text-xs font-medium text-gray-600">+{{ ($category->products_count ?? $category->products->count()) - 3 }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@else
    <!-- Design para home e outras páginas -->
    <div class="{{ $cardClasses }}">
        <div class="p-8 text-center">
            <div class="inline-flex items-center justify-center {{ $iconSize }} bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <h3 class="{{ $titleSize }} font-bold text-gray-900 mb-4">{{ $category->name }}</h3>
            <p class="text-gray-600 mb-6 leading-relaxed">
                {{ $category->description ?: 'Produtos frescos e de qualidade, cuidadosamente selecionados para sua família.' }}
            </p>
            <div class="inline-flex items-center bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                {{ $category->products_count ?? $category->products->count() }} {{ ($category->products_count ?? $category->products->count()) == 1 ? 'produto' : 'produtos' }}
            </div>
            <a href="{{ route('frontend.category', $category) }}" 
               class="inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                Ver Produtos
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
@endif
