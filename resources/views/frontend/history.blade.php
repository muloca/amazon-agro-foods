@extends('frontend.layouts.app')

@section('title', __('frontend.pages.history.meta.title'))
@section('description', __('frontend.pages.history.meta.description'))

@section('content')
<div class="min-h-screen bg-gray-50">
    <x-hero-section 
        :title="__('frontend.pages.history.hero.title')"
        :subtitle="__('frontend.pages.history.hero.subtitle')"
        icon="history"
        :show-pattern="true" />

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Timeline -->
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-blue-200"></div>

            <!-- 1950s - Foundation -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8 text-right">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ __('frontend.pages.history.timeline.foundation.year') }}</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('frontend.pages.history.timeline.foundation.title') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ __('frontend.pages.history.timeline.foundation.description') }}
                        </p>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🏭</div>
                        <h4 class="text-lg font-semibold text-gray-700">{{ __('frontend.pages.history.timeline.foundation.label') }}</h4>
                    </div>
                </div>
            </div>

            <!-- 1970s - Expansion -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">📈</div>
                        <h4 class="text-lg font-semibold text-gray-700">{{ __('frontend.pages.history.timeline.expansion.label') }}</h4>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ __('frontend.pages.history.timeline.expansion.year') }}</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('frontend.pages.history.timeline.expansion.title') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ __('frontend.pages.history.timeline.expansion.description') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 1990s - Technology -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8 text-right">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ __('frontend.pages.history.timeline.technology.year') }}</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('frontend.pages.history.timeline.technology.title') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ __('frontend.pages.history.timeline.technology.description') }}
                        </p>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">💻</div>
                        <h4 class="text-lg font-semibold text-gray-700">{{ __('frontend.pages.history.timeline.technology.label') }}</h4>
                    </div>
                </div>
            </div>

            <!-- 2000s - Quality -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🏆</div>
                        <h4 class="text-lg font-semibold text-gray-700">{{ __('frontend.pages.history.timeline.quality.label') }}</h4>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ __('frontend.pages.history.timeline.quality.year') }}</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('frontend.pages.history.timeline.quality.title') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ __('frontend.pages.history.timeline.quality.description') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2010s - Sustainability -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8 text-right">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ __('frontend.pages.history.timeline.sustainability.year') }}</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('frontend.pages.history.timeline.sustainability.title') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ __('frontend.pages.history.timeline.sustainability.description') }}
                        </p>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🌱</div>
                        <h4 class="text-lg font-semibold text-gray-700">{{ __('frontend.pages.history.timeline.sustainability.label') }}</h4>
                    </div>
                </div>
            </div>

            <!-- Today -->
            <div class="relative flex items-center">
                <div class="w-1/2 pr-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🚀</div>
                        <h4 class="text-lg font-semibold text-gray-700">{{ __('frontend.pages.history.timeline.today.label') }}</h4>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-green-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold mb-2" style="color: #ffffff !important;">{{ __('frontend.pages.history.timeline.today.year', ['year' => date('Y')]) }}</div>
                        <h3 class="text-2xl font-bold mb-4" style="color: #ffffff !important;">{{ __('frontend.pages.history.timeline.today.title') }}</h3>
                        <p class="leading-relaxed" style="color: #ffffff !important;">
                            {{ __('frontend.pages.history.timeline.today.description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="mt-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('frontend.pages.history.values.title') }}
                </h2>
                <p class="text-xl text-gray-600">
                    {{ __('frontend.pages.history.values.subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white rounded-xl shadow-lg">
                    <div class="text-5xl mb-4">🎯</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('frontend.pages.history.values.items.quality.title') }}</h3>
                    <p class="text-gray-600">
                        {{ __('frontend.pages.history.values.items.quality.description') }}
                    </p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg">
                    <div class="text-5xl mb-4">🤝</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('frontend.pages.history.values.items.trust.title') }}</h3>
                    <p class="text-gray-600">
                        {{ __('frontend.pages.history.values.items.trust.description') }}
                    </p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg">
                    <div class="text-5xl mb-4">🌍</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('frontend.pages.history.values.items.sustainability.title') }}</h3>
                    <p class="text-gray-600">
                        {{ __('frontend.pages.history.values.items.sustainability.description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
