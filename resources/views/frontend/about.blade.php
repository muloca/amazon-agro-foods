@extends('frontend.layouts.app')

@section('title', __('frontend.pages.about.meta.title'))
@section('description', __('frontend.pages.about.meta.description'))
@section('description', __('frontend.pages.about.meta.description'))

@section('content')
<div class="min-h-screen bg-gray-50">
    <x-hero-section 
        :title="__('frontend.pages.about.hero.title')"
        :subtitle="__('frontend.pages.about.hero.subtitle')"
        icon="about"
        :show-pattern="true" />

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Introduction -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                {{ __('frontend.pages.about.intro.title') }}
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                {{ __('frontend.pages.about.intro.description') }}
            </p>
        </div>

        <!-- Technology Section -->
        <div class="mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ __('frontend.pages.about.technology.title') }}</h3>
                    <h4 class="text-xl font-semibold text-blue-600 mb-4">
                        {{ __('frontend.pages.about.technology.subtitle') }}
                    </h4>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ __('frontend.pages.about.technology.description') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.technology.highlights.temperature') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.technology.highlights.traceability') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.technology.highlights.environment') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.technology.highlights.quality') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🔬</div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">{{ __('frontend.pages.about.technology.card.title') }}</h5>
                        <p class="text-gray-600">
                            {{ __('frontend.pages.about.technology.card.description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Food Safety Section -->
        <div class="mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-8">
                        <div class="text-center">
                            <div class="text-6xl mb-4">🛡️</div>
                            <h5 class="text-xl font-semibold text-gray-900 mb-2">{{ __('frontend.pages.about.food_safety.card.title') }}</h5>
                            <p class="text-gray-600">
                                {{ __('frontend.pages.about.food_safety.card.description') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ __('frontend.pages.about.food_safety.title') }}</h3>
                    <h4 class="text-xl font-semibold text-green-600 mb-4">
                        {{ __('frontend.pages.about.food_safety.subtitle') }}
                    </h4>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ __('frontend.pages.about.food_safety.description') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.food_safety.highlights.hygiene') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.food_safety.highlights.temperature') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.food_safety.highlights.traceability') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.food_safety.highlights.inspection') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Humane Slaughter Section -->
        <div class="mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ __('frontend.pages.about.humane.title') }}</h3>
                    <h4 class="text-xl font-semibold text-orange-600 mb-4">
                        {{ __('frontend.pages.about.humane.subtitle') }}
                    </h4>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ __('frontend.pages.about.humane.description') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.humane.highlights.welfare') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.humane.highlights.ethical') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.humane.highlights.compliance') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('frontend.pages.about.humane.highlights.training') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🐔</div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">{{ __('frontend.pages.about.humane.card.title') }}</h5>
                        <p class="text-gray-600">
                            {{ __('frontend.pages.about.humane.card.description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Environmental Responsibility -->
        <div class="mb-20">
            <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-2xl p-12">
                <div class="text-center">
                    <h3 class="text-3xl md:text-4xl font-bold mb-6">{{ __('frontend.pages.about.environmental.title') }}</h3>
                    <p class="text-xl text-green-100 max-w-4xl mx-auto leading-relaxed">
                        {{ __('frontend.pages.about.environmental.description') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Social Responsibility -->
        <div class="mb-20">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl p-12">
                <div class="text-center">
                    <h3 class="text-3xl md:text-4xl font-bold mb-6">{{ __('frontend.pages.about.social.title') }}</h3>
                    <p class="text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                        {{ __('frontend.pages.about.social.description') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Work With Us -->
        <div class="text-center">
            <div class="bg-gray-100 rounded-2xl p-12">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ __('frontend.pages.about.careers.title') }}</h3>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    {{ __('frontend.pages.about.careers.description') }}
                </p>
                <a href="{{ route('frontend.contact') }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-lg">
                    {{ __('frontend.pages.about.careers.cta') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
