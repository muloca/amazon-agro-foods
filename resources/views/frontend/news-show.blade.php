@extends('frontend.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', $news->title . ' - Amazon Frigorífico')
@section('description', $news->summary ?: Str::limit(strip_tags($news->content), 160))

@section('content')
<div class="min-h-screen bg-gray-50">
    <x-hero-section 
        :title="__('frontend.pages.news.hero.title')"
        :subtitle="__('frontend.pages.news.hero.subtitle')"
        icon="news"
        :show-pattern="true" />

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <nav class="text-sm mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-amazon-verde-600">{{ __('frontend.nav.home') }}</a>
                </li>
                <li>/</li>
                <li>
                    <a href="{{ route('frontend.news') }}" class="hover:text-amazon-verde-600">{{ __('frontend.pages.news.hero.title') }}</a>
                </li>
                <li>/</li>
                <li class="text-gray-700">{{ $news->title }}</li>
            </ol>
        </nav>

        <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="h-80 sm:h-96 overflow-hidden">
                <img src="{{ $news->primary_image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
            </div>

            <div class="p-8 sm:p-10">
                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 mb-4">
                    <span class="inline-flex items-center bg-blue-50 text-blue-700 px-3 py-1 rounded-full font-semibold">
                        {{ __('frontend.pages.news.hero.title') }}
                    </span>
                    <span>{{ __('frontend.pages.news.featured.published_at', ['date' => optional($news->published_at ?? $news->created_at)->translatedFormat(__('frontend.pages.news.dates.full_date'))]) }}</span>
                    @if($news->link)
                        <a href="{{ $news->link }}" target="_blank" rel="noopener" class="inline-flex items-center text-amazon-verde-600 hover:text-amazon-verde-700 font-semibold">
                            {{ __('frontend.pages.news.actions.external_link') }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">{{ $news->title }}</h1>

                @if($news->summary)
                    <p class="text-lg text-gray-600 mb-6">{{ $news->summary }}</p>
                @endif

                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! $news->content !!}
                </div>

                @if($news->additional_images_urls)
                    <div class="mt-10">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">{{ __('frontend.pages.news.show.gallery_title') }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($news->additional_images_urls as $imageUrl)
                                <a href="{{ $imageUrl }}" target="_blank" rel="noopener" class="group block overflow-hidden rounded-xl border border-gray-200">
                                    <img src="{{ $imageUrl }}" alt="{{ __('frontend.pages.news.show.gallery_image_alt') }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>

        @if($relatedNews->count())
            <div class="mt-16">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ __('frontend.pages.news.show.related_title') }}</h2>
                    <a href="{{ route('frontend.news') }}" class="text-amazon-verde-600 hover:text-amazon-verde-700 font-semibold">{{ __('frontend.pages.news.show.view_all') }}</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedNews as $related)
                        <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <a href="{{ route('frontend.news.show', $related->slug) }}" class="block h-40 overflow-hidden">
                                <img src="{{ $related->primary_image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                            </a>
                            <div class="p-5">
                                <span class="text-xs text-gray-500">{{ optional($related->published_at ?? $related->created_at)->format(__('frontend.pages.news.dates.date_format')) }}</span>
                                <h3 class="text-lg font-semibold text-gray-900 mt-2 mb-3 line-clamp-2">
                                    <a href="{{ route('frontend.news.show', $related->slug) }}" class="hover:text-amazon-verde-600">
                                        {{ $related->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ $related->summary ?: Str::limit(strip_tags($related->content), 120) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
