@extends('frontend.layouts.app')

@section('title', 'Notícias - Amazon Frigorífico')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Notícias</h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Fique por dentro das novidades e tendências do setor
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Featured News -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Destaque</h2>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="h-64 lg:h-auto bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-6xl mb-4">📰</div>
                            <p class="text-gray-600">Imagem da notícia</p>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center mb-4">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                Destaque
                            </span>
                            <span class="ml-4 text-gray-500 text-sm">15 de Janeiro, 2024</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            Amazon Frigorífico investe em tecnologia sustentável
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            A empresa anuncia novos investimentos em tecnologia verde, incluindo sistemas 
                            de energia solar e processos de reciclagem avançados, reforçando seu compromisso 
                            com a sustentabilidade ambiental.
                        </p>
                        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                            Ler mais
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Grid -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Últimas Notícias</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- News Item 1 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🌱</div>
                            <p class="text-gray-600 text-sm">Imagem da notícia</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                Sustentabilidade
                            </span>
                            <span class="ml-3 text-gray-500 text-sm">12 de Janeiro, 2024</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            Programa de sustentabilidade ganha reconhecimento nacional
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Nossas práticas sustentáveis foram reconhecidas pela Associação Brasileira 
                            de Frigoríficos, destacando nosso compromisso com o meio ambiente.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Ler mais →
                        </a>
                    </div>
                </article>

                <!-- News Item 2 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🏆</div>
                            <p class="text-gray-600 text-sm">Imagem da notícia</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-medium">
                                Qualidade
                            </span>
                            <span class="ml-3 text-gray-500 text-sm">10 de Janeiro, 2024</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            Certificação de qualidade renovada com sucesso
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Renovamos nossa certificação ISO 9001, confirmando nosso compromisso 
                            com a excelência em todos os processos produtivos.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Ler mais →
                        </a>
                    </div>
                </article>

                <!-- News Item 3 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🤝</div>
                            <p class="text-gray-600 text-sm">Imagem da notícia</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">
                                Parceria
                            </span>
                            <span class="ml-3 text-gray-500 text-sm">8 de Janeiro, 2024</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            Nova parceria com produtores locais
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Firmamos parceria com 20 novos produtores locais, garantindo 
                            matéria-prima de qualidade e fortalecendo a economia regional.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Ler mais →
                        </a>
                    </div>
                </article>

                <!-- News Item 4 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🔬</div>
                            <p class="text-gray-600 text-sm">Imagem da notícia</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                Tecnologia
                            </span>
                            <span class="ml-3 text-gray-500 text-sm">5 de Janeiro, 2024</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            Laboratório de qualidade ampliado
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Investimos em novos equipamentos para nosso laboratório, 
                            garantindo ainda mais rigor nos controles de qualidade.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Ler mais →
                        </a>
                    </div>
                </article>

                <!-- News Item 5 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-4xl mb-2">👥</div>
                            <p class="text-gray-600 text-sm">Imagem da notícia</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                Recursos Humanos
                            </span>
                            <span class="ml-3 text-gray-500 text-sm">3 de Janeiro, 2024</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            Programa de capacitação da equipe
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Iniciamos novo programa de capacitação para nossa equipe, 
                            investindo no desenvolvimento profissional dos colaboradores.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Ler mais →
                        </a>
                    </div>
                </article>

                <!-- News Item 6 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-4xl mb-2">📈</div>
                            <p class="text-gray-600 text-sm">Imagem da notícia</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                Mercado
                            </span>
                            <span class="ml-3 text-gray-500 text-sm">1 de Janeiro, 2024</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            Crescimento recorde no último trimestre
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Registramos crescimento de 25% nas vendas no último trimestre, 
                            consolidando nossa posição no mercado regional.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Ler mais →
                        </a>
                    </div>
                </article>
            </div>
        </div>

        <!-- Newsletter Signup -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl p-8 text-center">
            <h3 class="text-2xl font-bold mb-4">Receba nossas notícias</h3>
            <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
                Cadastre-se em nossa newsletter e receba as principais notícias e novidades 
                do Amazon Frigorífico diretamente em seu e-mail.
            </p>
            <form class="max-w-md mx-auto flex gap-4">
                <input type="email" 
                       placeholder="Seu e-mail" 
                       class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                <button type="submit" 
                        class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Cadastrar
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
