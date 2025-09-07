@extends('frontend.layouts.app')

@section('title', $product->name . ' - Amazon Frigorífico')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                            <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('frontend.products') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Produtos</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-4 text-sm font-medium text-gray-500">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Image Gallery -->
            <div x-data="imageGallery()" class="space-y-4">
                <!-- Main Image -->
                <div class="relative group">
                    <img 
                        :src="images[currentIndex]" 
                        :alt="$product.name"
                        @click="openFullscreen()"
                        class="w-full h-96 lg:h-[500px] object-cover rounded-lg cursor-pointer transition-transform duration-300 hover:scale-105 shadow-lg">
                    
                    <!-- Fullscreen Button -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-lg flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Navigation Controls -->
                    <div x-show="images.length > 1" class="absolute inset-0 flex items-center justify-between pointer-events-none">
                        <!-- Previous Button -->
                        <button 
                            @click="previousImage()"
                            class="pointer-events-auto ml-4 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-3 shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Next Button -->
                        <button 
                            @click="nextImage()"
                            class="pointer-events-auto mr-4 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-3 shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Thumbnail Navigation -->
                <template x-if="images.length > 1">
                    <div class="flex space-x-2 overflow-x-auto pb-2">
                        <template x-for="(image, index) in images" :key="index">
                            <button 
                                @click="currentIndex = index"
                                :class="currentIndex === index ? 'ring-2 ring-blue-500' : 'ring-1 ring-gray-300'"
                                class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden">
                                <img :src="image" :alt="`Imagem ${index + 1}`" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>
                </template>

                <!-- Image Counter -->
                <template x-if="images.length > 1">
                    <div class="text-center text-sm text-gray-500">
                        <span x-text="currentIndex + 1"></span> de <span x-text="images.length"></span>
                    </div>
                </template>
            </div>

            <!-- Product Info -->
            <div class="space-y-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $product->category->name }}
                        </span>
                        @if($product->line)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                {{ ucfirst($product->line) }}
                            </span>
                        @endif
                    </div>
                </div>

                @if($product->description)
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Descrição</h2>
                        <div class="prose prose-lg text-gray-600 max-w-none">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Product Features -->
                <div class="bg-white rounded-lg p-6 shadow-sm border">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Características</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Produto Fresco</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Qualidade Garantida</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Tradição Familiar</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Entrega Rápida</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Produtos Relacionados</h2>
                    <p class="text-lg text-gray-600">Outros produtos que você pode gostar</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                            <div class="relative overflow-hidden">
                                <img src="{{ $relatedProduct->image_url }}" 
                                     alt="{{ $relatedProduct->name }}"
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $relatedProduct->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ $relatedProduct->category->name }}</p>
                                <a href="{{ route('frontend.product', $relatedProduct) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                    Ver Detalhes
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Fullscreen Modal -->
    <div x-data="fullscreenModal()" 
         x-show="isOpen" 
         x-cloak
         class="fixed inset-0 z-50 bg-black bg-opacity-95 flex items-center justify-center"
         @keydown.escape="close()"
         @click.self="close()">
        <div class="relative max-w-7xl max-h-full p-4">
            <button @click="close()" 
                    class="absolute top-4 right-4 text-white hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full p-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <img :src="currentImage" 
                 :alt="$product.name"
                 class="max-w-full max-h-full object-contain rounded-lg">
            
            <template x-if="images.length > 1">
                <div>
                    <button @click="previous()"
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button @click="next()"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </template>
            
            <!-- Image Counter in Fullscreen -->
            <template x-if="images.length > 1">
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white bg-black bg-opacity-50 rounded-full px-4 py-2">
                    <span x-text="currentIndex + 1"></span> de <span x-text="images.length"></span>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
function imageGallery() {
    return {
        currentIndex: 0,
        images: @json($product->all_images_urls),
        
        nextImage() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        
        previousImage() {
            this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
        },
        
        openFullscreen() {
            // Find the fullscreen modal and open it
            const fullscreenModal = document.querySelector('[x-data*="fullscreenModal"]');
            if (fullscreenModal && fullscreenModal._x_dataStack) {
                const modalData = fullscreenModal._x_dataStack[0];
                modalData.isOpen = true;
                modalData.currentIndex = this.currentIndex;
            }
        }
    }
}

function fullscreenModal() {
    return {
        isOpen: false,
        currentIndex: 0,
        images: @json($product->all_images_urls),
        
        get currentImage() {
            return this.images[this.currentIndex];
        },
        
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        
        previous() {
            this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
        },
        
        close() {
            this.isOpen = false;
        }
    }
}

// Initialize Alpine.js components
document.addEventListener('alpine:init', () => {
    Alpine.data('imageGallery', imageGallery);
    Alpine.data('fullscreenModal', fullscreenModal);
});
</script>
@endsection