@extends('frontend.layouts.app')

@section('title', 'Nossas Categorias - Amazon Frigorífico')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <x-hero-section 
        title="Nossas Categorias"
        subtitle="Explore nossa variedade de categorias de produtos frescos"
        icon="categories"
        background="blue"
        :show-pattern="false" />

    <!-- Categories Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <x-category-card :category="$category" variant="page" />
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Não encontrou o que procura?</h3>
                    <p class="text-gray-600 mb-6">Explore todos os nossos produtos ou entre em contato conosco.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('frontend.products') }}" 
                           class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            Ver Todos os Produtos
                        </a>
                        <a href="#contato" 
                           class="bg-gray-100 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            Entrar em Contato
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhuma categoria disponível</h3>
                <p class="mt-2 text-gray-500">Em breve teremos categorias de produtos para você explorar.</p>
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
