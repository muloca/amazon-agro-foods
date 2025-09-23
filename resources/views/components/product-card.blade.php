@props(['product', 'showLine' => true, 'variant' => 'default'])

@php
    $cardClasses = match($variant) {
        'compact' => 'group bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100 flex flex-col h-full',
        'featured' => 'group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100 flex flex-col h-full',
        default => 'group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100 flex flex-col h-full'
    };
    
    $imageHeight = match($variant) {
        'compact' => 'h-48',
        'featured' => 'h-56',
        default => 'h-56'
    };
    
    $titleSize = match($variant) {
        'compact' => 'text-lg',
        'featured' => 'text-xl',
        default => 'text-xl'
    };
@endphp

<div class="{{ $cardClasses }}">
    <!-- Product Image -->
    <div class="relative {{ $imageHeight }} bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden flex-shrink-0">
        <img src="{{ $product->image_url }}" 
             alt="{{ $product->name }}"
             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        
        <!-- Category Badge -->
        <div class="absolute top-4 left-4">
            <span class="bg-gradient-to-r from-amazon-verde-600 to-amazon-verde-700 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                {{ $product->category->name }}
            </span>
        </div>
    </div>

    <!-- Product Info - Flex container para distribuir espaço -->
    <div class="p-6 flex flex-col flex-grow">
        <div class="h-16 mb-4">
            <h3 class="{{ $titleSize }} font-bold text-gray-900 line-clamp-2 group-hover:text-amazon-verde-600 transition-colors leading-tight" style="color: var(--card-title-color) !important;">
                {{ $product->name }}
            </h3>
        </div>
        
        <!-- Descrição - Altura fixa para 4 linhas -->
        <div class="flex-grow mb-6">
            @if($product->description)
                <p class="text-gray-700 text-sm line-clamp-4 leading-relaxed" style="color: var(--card-text-color) !important;">
                    {{ $product->description }}
                </p>
            @else
                <p class="text-gray-500 text-sm line-clamp-4 leading-relaxed italic" style="color: var(--card-text-color) !important;">
                    {{ __('frontend.product_card.description_unavailable') }}
                </p>
            @endif
        </div>

        <!-- View Button - Sempre na parte inferior -->
        <div class="mt-auto">
            <a href="{{ route('frontend.product', $product) }}" 
               class="w-full bg-gradient-to-r from-amazon-verde-600 to-amazon-verde-700 text-white py-3 px-4 rounded-xl hover:from-amazon-verde-700 hover:to-amazon-verde-800 transition-all duration-300 font-semibold text-center block shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                {{ __('frontend.product_card.view_details') }}
            </a>
        </div>
    </div>
</div>
