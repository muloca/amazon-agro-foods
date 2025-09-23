@extends('frontend.layouts.app')

@section('title', 'Notícias - Amazon Frigorífico')

@section('content')
<div class="min-h-screen bg-gray-50">
    <x-hero-section 
        title="Notícias"
        subtitle="Fique por dentro das novidades e tendências do setor"
        icon="news"
        :show-pattern="true" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @php use Illuminate\Support\Str; @endphp

        @if($newsItems->count())
            @php
                $featured = $newsItems->first();
                $otherNews = $newsItems->slice(1);
            @endphp

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Destaque</h2>
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <div class="h-64 lg:h-auto overflow-hidden">
                            <img src="{{ $featured->primary_image_url }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-8 flex flex-col">
                            <div class="flex items-center gap-3 mb-4 text-sm text-gray-500">
                                <span class="inline-flex items-center bg-blue-50 text-blue-700 px-3 py-1 rounded-full font-semibold">Destaque</span>
                                <span>{{ optional($featured->published_at ?? $featured->created_at)->format('d/m/Y H:i') }}</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $featured->title }}</h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                {{ $featured->summary ?: Str::limit(strip_tags($featured->content), 220) }}
                            </p>
                            <div class="mt-auto flex flex-wrap items-center gap-3">
                                <a href="{{ route('frontend.news.show', $featured->slug) }}" class="inline-flex items-center bg-gradient-to-r from-amazon-verde-600 to-amazon-verde-700 text-white px-5 py-2.5 rounded-lg font-semibold hover:from-amazon-verde-700 hover:to-amazon-verde-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    Ler no site
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                @if($featured->link)
                                    <a href="{{ $featured->link }}" target="_blank" rel="noopener" class="inline-flex items-center text-amazon-verde-600 hover:text-amazon-verde-700 font-semibold">
                                        Link externo
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @endif
                                <span class="inline-flex items-center text-sm text-gray-400">
                                    Publicado em {{ optional($featured->published_at ?? $featured->created_at)->format('d \d\e F \d\e Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($otherNews->count())
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Últimas Notícias</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($otherNews as $news)
                            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 flex flex-col">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ $news->primary_image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                        <span>{{ optional($news->published_at ?? $news->created_at)->format('d/m/Y H:i') }}</span>
                                        @if($news->additional_images_urls)
                                            <span class="inline-flex items-center bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                                                {{ count($news->additional_images_urls) }} imagem(ns)
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-semibold mb-3 line-clamp-2" style="color: var(--card-title-color) !important;">{{ $news->title }}</h3>
                                    <p class="text-sm mb-4 line-clamp-3" style="color: var(--card-text-color) !important;">
                                        {{ $news->summary ?: Str::limit(strip_tags($news->content), 140) }}
                                    </p>
                                    <div class="mt-auto">
                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('frontend.news.show', $news->slug) }}" class="inline-flex items-center text-amazon-verde-600 hover:text-amazon-verde-700 font-semibold">
                                                Ler no site
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                            @if($news->link)
                                                <a href="{{ $news->link }}" target="_blank" rel="noopener" class="inline-flex items-center text-sm text-gray-500 hover:text-amazon-verde-600">
                                                    Link externo
                                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($newsItems->hasPages())
                <div class="flex justify-center">
                    <div class="bg-white px-4 py-3 rounded-xl shadow-lg">
                        {{ $newsItems->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h4l2 2h4a2 2 0 012 2v11a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhuma notícia publicada</h3>
                <p class="text-gray-600">Em breve disponibilizaremos novidades e atualizações por aqui.</p>
            </div>
        @endif
    </div>
</div>
@endsection
