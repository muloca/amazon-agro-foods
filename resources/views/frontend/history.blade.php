@extends('frontend.layouts.app')

@section('title', 'Nossa História - Amazon Frigorífico')

@section('content')
<div class="min-h-screen bg-gray-50">
    <x-hero-section 
        title="Nossa História"
        subtitle="Uma trajetória de tradição, qualidade e inovação"
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
                        <div class="text-4xl font-bold text-blue-600 mb-2">1950</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Os Primeiros Passos</h3>
                        <p class="text-gray-600 leading-relaxed">
                            O Amazon Frigorífico foi fundado com a visão de levar qualidade e frescor 
                            para as famílias brasileiras. Desde o início, a empresa se dedicou à 
                            melhoria contínua e à inovação tecnológica.
                        </p>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🏭</div>
                        <h4 class="text-lg font-semibold text-gray-700">Fundação</h4>
                    </div>
                </div>
            </div>

            <!-- 1970s - Expansion -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">📈</div>
                        <h4 class="text-lg font-semibold text-gray-700">Expansão</h4>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">1970</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Crescimento e Modernização</h3>
                        <p class="text-gray-600 leading-relaxed">
                            A busca por melhorias levou o Amazon Frigorífico a expandir suas operações, 
                            inaugurando novas instalações e estabelecendo-se como referência em qualidade 
                            no mercado regional.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 1990s - Technology -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8 text-right">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">1990</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Revolução Tecnológica</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Investimentos em tecnologia de ponta transformaram nossos processos, 
                            garantindo maior eficiência, qualidade e segurança alimentar. 
                            A modernização trouxe novos padrões de excelência.
                        </p>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">💻</div>
                        <h4 class="text-lg font-semibold text-gray-700">Tecnologia</h4>
                    </div>
                </div>
            </div>

            <!-- 2000s - Quality -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🏆</div>
                        <h4 class="text-lg font-semibold text-gray-700">Qualidade</h4>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">2000</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Certificações e Qualidade</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Obtivemos importantes certificações de qualidade e implementamos 
                            rigorosos controles de segurança alimentar, estabelecendo novos 
                            padrões de excelência no setor.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2010s - Sustainability -->
            <div class="relative flex items-center mb-16">
                <div class="w-1/2 pr-8 text-right">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold text-blue-600 mb-2">2010</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Sustentabilidade</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Implementamos práticas sustentáveis em toda nossa cadeia produtiva, 
                            assumindo compromisso com o meio ambiente e a responsabilidade social, 
                            sempre mantendo a qualidade dos nossos produtos.
                        </p>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🌱</div>
                        <h4 class="text-lg font-semibold text-gray-700">Sustentabilidade</h4>
                    </div>
                </div>
            </div>

            <!-- Today -->
            <div class="relative flex items-center">
                <div class="w-1/2 pr-8">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🚀</div>
                        <h4 class="text-lg font-semibold text-gray-700">Hoje</h4>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-green-600 rounded-full border-4 border-white shadow-lg"></div>
                <div class="w-1/2 pl-8">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl shadow-lg p-8">
                        <div class="text-4xl font-bold mb-2">{{ date('Y') }}</div>
                        <h3 class="text-2xl font-bold mb-4">Presente e Futuro</h3>
                        <p class="text-green-100 leading-relaxed">
                            Hoje, o Amazon Frigorífico continua sua trajetória de excelência, 
                            combinando tradição e inovação para levar até sua mesa produtos 
                            de qualidade superior, sempre com responsabilidade social e ambiental.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="mt-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Nossos Valores
                </h2>
                <p class="text-xl text-gray-600">
                    Os princípios que guiam nossa trajetória
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white rounded-xl shadow-lg">
                    <div class="text-5xl mb-4">🎯</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Qualidade</h3>
                    <p class="text-gray-600">
                        Compromisso com a excelência em cada produto, desde a origem até a entrega.
                    </p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg">
                    <div class="text-5xl mb-4">🤝</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Confiança</h3>
                    <p class="text-gray-600">
                        Construindo relacionamentos duradouros baseados na transparência e honestidade.
                    </p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg">
                    <div class="text-5xl mb-4">🌍</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sustentabilidade</h3>
                    <p class="text-gray-600">
                        Responsabilidade com o meio ambiente e com as futuras gerações.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
