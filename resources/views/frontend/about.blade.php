@extends('frontend.layouts.app')

@section('title', 'Sobre Nós - Amazon Frigorífico')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Sobre Nós</h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Tradição, qualidade e inovação em cada produto
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Introduction -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Amazon Frigorífico
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Somos uma empresa dedicada à produção de carnes e produtos frescos de alta qualidade, 
                combinando tradição familiar com tecnologia moderna para levar até sua mesa produtos 
                que reúnem sabor, frescor e confiança.
            </p>
        </div>

        <!-- Technology Section -->
        <div class="mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Tecnologia</h3>
                    <h4 class="text-xl font-semibold text-blue-600 mb-4">
                        Tecnologia aliada à excelência em carnes e cortes
                    </h4>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Sabemos que a tecnologia é essencial em toda a cadeia produtiva. No Amazon Frigorífico 
                        investimos constantemente em soluções tecnológicas para otimizar processos e garantir 
                        a qualidade dos produtos, desde o abate até a entrega final.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Controle de temperatura automatizado</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Sistema de rastreabilidade completo</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Processamento em ambiente controlado</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Qualidade garantida em cada etapa</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🔬</div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Inovação Constante</h5>
                        <p class="text-gray-600">
                            Investimos em tecnologia de ponta para garantir a melhor qualidade
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
                            <h5 class="text-xl font-semibold text-gray-900 mb-2">Segurança Alimentar</h5>
                            <p class="text-gray-600">
                                Garantia e procedência para reunir a família
                            </p>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Segurança Alimentar</h3>
                    <h4 class="text-xl font-semibold text-green-600 mb-4">
                        Garantia e procedência para reunir
                    </h4>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        No Amazon Frigorífico, a segurança alimentar é fundamental para garantir a qualidade 
                        dos produtos e proteger a saúde dos consumidores. Contamos com rigorosos protocolos 
                        de controle de qualidade em todas as etapas do processo.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Protocolos rigorosos de higiene</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Controle de temperatura rigoroso</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Rastreabilidade completa</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Inspeção contínua</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Humane Slaughter Section -->
        <div class="mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Abate Humanitário</h3>
                    <h4 class="text-xl font-semibold text-orange-600 mb-4">
                        Comprometimento com o bem-estar animal
                    </h4>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        O abate humanitário é uma prática central em nossas operações. Seguindo todos os 
                        protocolos nacionais e internacionais durante o processo, buscamos garantir que 
                        o abate ocorra da forma mais ética e respeitosa possível.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Protocolos de bem-estar animal</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Processo ético e respeitoso</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Conformidade com normas internacionais</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Treinamento contínuo da equipe</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🐄</div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Bem-estar Animal</h5>
                        <p class="text-gray-600">
                            Respeito e cuidado em todas as etapas
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Environmental Responsibility -->
        <div class="mb-20">
            <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-2xl p-12">
                <div class="text-center">
                    <h3 class="text-3xl md:text-4xl font-bold mb-6">Responsabilidade Ambiental</h3>
                    <p class="text-xl text-green-100 max-w-4xl mx-auto leading-relaxed">
                        No Amazon Frigorífico, assumimos o compromisso com o futuro, fazendo da responsabilidade 
                        ambiental peça fundamental em todos os processos. Assim, garantimos o respeito com o 
                        meio ambiente e a qualidade dos produtos até a sua mesa.
                    </p>
                </div>
            </div>
        </div>

        <!-- Social Responsibility -->
        <div class="mb-20">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl p-12">
                <div class="text-center">
                    <h3 class="text-3xl md:text-4xl font-bold mb-6">Responsabilidade Social</h3>
                    <p class="text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                        No Amazon Frigorífico, nosso objetivo vai além da produção de carne de alta qualidade. 
                        Somos formados por gente e entendemos o nosso compromisso e responsabilidade para com 
                        a sociedade após décadas de atuação.
                    </p>
                </div>
            </div>
        </div>

        <!-- Work With Us -->
        <div class="text-center">
            <div class="bg-gray-100 rounded-2xl p-12">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Trabalhe Conosco</h3>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Já pensou em fazer parte de uma equipe engajada e empenhada em fazer a diferença 
                    com produtos de qualidade? Então aqui é o seu lugar!
                </p>
                <a href="#contato" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-lg">
                    Cadastre seu Currículo
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
