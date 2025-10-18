@extends('frontend.layouts.app')

@section('title', __('frontend.pages.contact.meta.title'))
@section('description', __('frontend.pages.contact.meta.description'))

@section('content')
<div class="min-h-screen bg-gray-50">
    <x-hero-section 
        :title="__('frontend.pages.contact.hero.title')"
        :subtitle="__('frontend.pages.contact.hero.subtitle')"
        icon="contact"
        :show-pattern="true" />

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('frontend.pages.contact.form.title') }}</h2>

                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-green-500 bg-green-100 text-green-900 px-5 py-4 flex items-start gap-3 shadow-sm">
                        <svg class="w-6 h-6 mt-0.5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="font-semibold">{{ __('frontend.pages.contact.form.success_title') }}</p>
                            <p class="text-sm text-green-800">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-6" method="POST" action="{{ route('frontend.contact.submit') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('frontend.pages.contact.form.fields.name') }}
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('frontend.pages.contact.form.fields.email') }}
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('frontend.pages.contact.form.fields.phone') }}
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('frontend.pages.contact.form.fields.subject') }}
                            </label>
                            <select id="subject" 
                                    name="subject"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">{{ __('frontend.pages.contact.form.subject_options.placeholder') }}</option>
                                <option value="produtos" @selected(old('subject') === 'produtos')>{{ __('frontend.pages.contact.form.subject_options.products') }}</option>
                                <option value="parceria" @selected(old('subject') === 'parceria')>{{ __('frontend.pages.contact.form.subject_options.partnership') }}</option>
                                <option value="trabalho" @selected(old('subject') === 'trabalho')>{{ __('frontend.pages.contact.form.subject_options.careers') }}</option>
                                <option value="reclamacao" @selected(old('subject') === 'reclamacao')>{{ __('frontend.pages.contact.form.subject_options.complaint') }}</option>
                                <option value="sugestao" @selected(old('subject') === 'sugestao')>{{ __('frontend.pages.contact.form.subject_options.suggestion') }}</option>
                                <option value="outro" @selected(old('subject') === 'outro')>{{ __('frontend.pages.contact.form.subject_options.other') }}</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('frontend.pages.contact.form.fields.message') }}
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="6" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="{{ __('frontend.pages.contact.form.message_placeholder') }}">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        {{ __('frontend.pages.contact.form.submit') }}
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('frontend.pages.contact.info.title') }}</h2>
                
                <!-- Contact Cards -->
                <div class="space-y-6">
                    <!-- Phone -->
                    @if (contact_phone() || contact_phone_secondary())
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="bg-blue-100 rounded-full p-3 mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ __('frontend.pages.contact.info.phone.title') }}</h3>
                                    @if(contact_phone())
                                        <p class="text-gray-600">{{ contact_phone() }}</p>
                                    @endif
                                    @if(contact_phone_secondary())
                                        <p class="text-gray-600">{{ contact_phone_secondary() }}</p>
                                    @endif
                                    <p class="text-sm text-gray-500">{{ __('frontend.pages.contact.info.phone.hours') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Email -->
                    @if (contact_email())
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="bg-green-100 rounded-full p-3 mr-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ __('frontend.pages.contact.info.email.title') }}</h3>
                                    <p class="text-gray-600">{{ contact_email() }}</p>
                                    <p class="text-sm text-gray-500">{{ __('frontend.pages.contact.info.email.response_time') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Address -->
                    @if (contact_address())
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="bg-orange-100 rounded-full p-3 mr-4">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ __('frontend.pages.contact.info.address.title') }}</h3>
                                    <p class="text-gray-600">{{ contact_address() }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Map Placeholder -->
                @php
                    $mapEmbedUrl = contact_map_embed_url();
                    $mapExternalLink = contact_map_external_link();
                @endphp

                @if ($mapEmbedUrl)
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('frontend.pages.contact.info.map.title') }}</h3>
                        <div class="overflow-hidden rounded-xl shadow-lg border border-gray-200">
                            <iframe 
                                src="{{ $mapEmbedUrl }}"
                                width="100%"
                                height="320"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-3 gap-3">
                            @if (contact_address())
                                <p class="text-sm text-gray-500">{{ contact_address() }}</p>
                            @endif

                            @if ($mapExternalLink)
                                <a href="{{ $mapExternalLink }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                                    {{ __('frontend.pages.contact.info.map.button') }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('frontend.pages.contact.info.social.title') }}</h3>
                    <div class="flex space-x-4">
                        @if (!empty($config['social_facebook']))
                            <a href="{{ $config['social_facebook'] }}" target="_blank" rel="noopener" class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        @endif
                        @if (!empty($config['social_instagram']))
                            <a href="{{ $config['social_instagram'] }}" target="_blank" rel="noopener" class="bg-pink-600 text-white p-3 rounded-lg hover:bg-pink-700 transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                        @endif
                        @if (!empty($config['social_whatsapp']))
                            <a href="{{ $config['social_whatsapp'] }}" target="_blank" rel="noopener" class="bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                    @if (empty($config['social_facebook']) && empty($config['social_instagram']) && empty($config['social_whatsapp']))
                        <p class="text-gray-500 mt-3">{{ __('frontend.pages.contact.info.social.empty') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const phoneInput = document.getElementById('phone');
        if (!phoneInput) {
            return;
        }

        const formatPhone = (value) => {
            let digits = value.replace(/\D/g, '').slice(0, 11);

            if (digits.length > 10) {
                return `(${digits.slice(0, 2)}) ${digits.slice(2, 7)}-${digits.slice(7)}`;
            }

            if (digits.length > 6) {
                return `(${digits.slice(0, 2)}) ${digits.slice(2, 6)}-${digits.slice(6)}`;
            }

            if (digits.length > 2) {
                return `(${digits.slice(0, 2)}) ${digits.slice(2)}`;
            }

            if (digits.length > 0) {
                return `(${digits}`;
            }

            return '';
        };

        const handleInput = (event) => {
            const formatted = formatPhone(event.target.value);
            event.target.value = formatted;
        };

        phoneInput.addEventListener('input', handleInput);
        phoneInput.addEventListener('blur', handleInput);

        if (phoneInput.value) {
            phoneInput.value = formatPhone(phoneInput.value);
        }
    });
</script>
@endpush
