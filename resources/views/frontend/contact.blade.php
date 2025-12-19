@extends('frontend.layouts.app')

@section('title', __('frontend.pages.contact.meta.title'))
@section('description', __('frontend.pages.contact.meta.description'))

@php
    use Illuminate\Support\Str;

    $phoneEntries = collect([contact_phone(), contact_phone_secondary()])
        ->filter(fn ($phone) => filled($phone))
        ->map(function ($phone) {
            $trimmed = trim($phone);
            $digits = preg_replace('/\D+/', '', $trimmed);

            if (blank($digits)) {
                return null;
            }

            $internationalDigits = ltrim($digits, '0');
            if (! Str::startsWith($internationalDigits, '55')) {
                $internationalDigits = '55' . $internationalDigits;
            }

            return [
                'display' => $phone,
                'tel' => 'tel:+' . $internationalDigits,
                'whatsapp' => 'https://wa.me/' . $internationalDigits,
            ];
        })
        ->filter();
@endphp

@section('content')
<div class="min-h-screen bg-gray-50">
    <x-hero-section 
        :title="__('frontend.pages.contact.hero.title')"
        :subtitle="__('frontend.pages.contact.hero.subtitle')"
        icon="contact"
        :show-pattern="true" />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
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
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('frontend.pages.contact.info.title') }}</h2>
                <div class="space-y-6">
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
                                    @foreach($phoneEntries as $phone)
                                        <div class="flex flex-wrap items-center gap-3 mt-3 first:mt-0">
                                            @if($phone['tel'])
                                                <a href="{{ $phone['tel'] }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                                                    {{ $phone['display'] }}
                                                </a>
                                            @else
                                                <span class="text-gray-600">{{ $phone['display'] }}</span>
                                            @endif

                                            @if($phone['whatsapp'])
                                                <a href="{{ $phone['whatsapp'] }}" target="_blank" rel="noopener" aria-label="WhatsApp {{ $phone['display'] }}"
                                                   class="inline-flex items-center gap-2 px-3 py-1 border border-green-500 text-green-600 rounded-full text-sm font-semibold hover:bg-green-50 hover:text-green-700 transition">
                                                    <svg class="w-4 h-4" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true">
                                                        <path d="M16 2.667C8.636 2.667 2.667 8.636 2.667 16c0 2.75.873 5.296 2.357 7.38L3 29.333l6.154-1.955A13.26 13.26 0 0 0 16 29.333c7.364 0 13.333-5.969 13.333-13.333S23.364 2.667 16 2.667Zm0 24c-2.2 0-4.297-.633-6.123-1.83l-.438-.279-3.648 1.158 1.172-3.56-.29-.452A10.61 10.61 0 0 1 5.333 16c0-5.884 4.783-10.667 10.667-10.667 5.883 0 10.667 4.783 10.667 10.667 0 5.883-4.784 10.667-10.667 10.667Zm6.063-7.978c-.333-.167-1.966-.971-2.27-1.081-.303-.111-.524-.167-.746.167-.222.333-.857 1.08-1.051 1.303-.193.222-.386.25-.719.083-.333-.167-1.406-.519-2.678-1.654-.99-.883-1.658-1.973-1.852-2.306-.193-.333-.021-.513.146-.68.151-.15.333-.389.5-.583.167-.194.222-.333.333-.556.111-.222.055-.417-.028-.584-.084-.167-.746-1.8-1.022-2.47-.268-.645-.54-.558-.746-.568-.193-.01-.417-.012-.64-.012-.222 0-.583.083-.889.417-.306.333-1.167 1.14-1.167 2.78 0 1.639 1.195 3.223 1.363 3.445.167.222 2.35 3.588 5.698 5.03.797.344 1.422.55 1.908.705.802.255 1.53.219 2.108.133.643-.096 1.966-.804 2.245-1.58.278-.777.278-1.443.194-1.58-.084-.139-.306-.222-.64-.389Z"/>
                                                    </svg>
                                                    <span>WhatsApp</span>
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                    <p class="text-sm text-gray-500 mt-4">{{ __('frontend.pages.contact.info.phone.hours') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
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
                                    <a href="mailto:{{ contact_email() }}" class="text-gray-600 hover:text-green-600 font-medium transition">
                                        {{ contact_email() }}
                                    </a>
                                    <p class="text-sm text-gray-500">{{ __('frontend.pages.contact.info.email.response_time') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
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
                @php
                    $socialLinks = [
                        'facebook' => $config['social_facebook'] ?? null,
                        'instagram' => $config['social_instagram'] ?? null,
                        'whatsapp' => $config['social_whatsapp'] ?? null,
                    ];
                    $hasSocial = collect($socialLinks)->filter()->isNotEmpty();
                @endphp

                @if ($hasSocial)
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('frontend.pages.contact.info.social.title') }}</h3>
                        <div class="flex space-x-4">
                            @if (!empty($socialLinks['facebook']))
                                <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener" class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                            @endif
                            @if (!empty($socialLinks['instagram']))
                                <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener" class="bg-pink-600 text-white p-3 rounded-lg hover:bg-pink-700 transition-colors">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7Zm0 0" />
                                        <path d="M12 7a5 5 0 1 1 0 10a5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6a3 3 0 0 0 0-6Z" />
                                        <circle cx="17.5" cy="6.5" r="1" />
                                    </svg>
                                </a>
                            @endif
                            @if (!empty($socialLinks['whatsapp']))
                                <a href="{{ $socialLinks['whatsapp'] }}" target="_blank" rel="noopener" class="bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
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
