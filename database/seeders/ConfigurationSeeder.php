<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configurations = [
            // Configurações Gerais
            [
                'key' => 'site_name',
                'group' => 'general',
                'label' => 'Nome do Site',
                'value' => 'Amazon Agro Foods',
                'type' => 'text',
                'description' => 'Nome que aparece no cabeçalho e título do site',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'site_description',
                'group' => 'general',
                'label' => 'Descrição do Site',
                'value' => 'Especialistas em produtos de qualidade para sua família',
                'type' => 'textarea',
                'description' => 'Descrição que aparece no meta description e sobre o site',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'logo_url',
                'group' => 'general',
                'label' => 'URL do Logo',
                'value' => '/images/logo.svg',
                'type' => 'image',
                'description' => 'Caminho para a imagem do logo do site',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Configurações de Cores
            [
                'key' => 'primary_color',
                'group' => 'colors',
                'label' => 'Cor Primária',
                'value' => '#03662c',
                'type' => 'color',
                'description' => 'Cor principal do site (botões, links, destaques)',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'secondary_color',
                'group' => 'colors',
                'label' => 'Cor Secundária',
                'value' => '#58ac43',
                'type' => 'color',
                'description' => 'Cor secundária para textos e elementos complementares',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'accent_color',
                'group' => 'colors',
                'label' => 'Cor de Destaque',
                'value' => '#e5d830',
                'type' => 'color',
                'description' => 'Cor para elementos de destaque e alertas',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'hero_background_start_color',
                'group' => 'colors',
                'label' => 'Hero - Cor de Fundo (Início)',
                'value' => '#03662c',
                'type' => 'color',
                'description' => 'Cor inicial do gradiente de fundo da seção hero',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'hero_background_end_color',
                'group' => 'colors',
                'label' => 'Hero - Cor de Fundo (Fim)',
                'value' => '#03662c',
                'type' => 'color',
                'description' => 'Cor final do gradiente de fundo da seção hero',
                'is_active' => true,
                'sort_order' => 5,
            ],

            // Configurações de Textos
            [
                'key' => 'hero_title',
                'group' => 'texts',
                'label' => 'Título Principal',
                'value' => 'Bem-vindo ao Amazon Agro Foods',
                'type' => 'text',
                'description' => 'Título principal da página inicial',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'hero_subtitle',
                'group' => 'texts',
                'label' => 'Subtítulo Principal',
                'value' => 'Descubra nossos produtos de qualidade e tradição familiar',
                'type' => 'textarea',
                'description' => 'Subtítulo da página inicial',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'cta_button_text',
                'group' => 'texts',
                'label' => 'Texto do Botão CTA',
                'value' => 'Ver Produtos',
                'type' => 'text',
                'description' => 'Texto do botão de call-to-action principal',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Configurações de Contato
            [
                'key' => 'contact_phone',
                'group' => 'contact',
                'label' => 'Telefone',
                'value' => '(11) 99999-9999',
                'type' => 'text',
                'description' => 'Número de telefone para contato',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'contact_phone_secondary',
                'group' => 'contact',
                'label' => 'Telefone (Secundário)',
                'value' => null,
                'type' => 'text',
                'description' => 'Número de telefone alternativo para contato',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'contact_email',
                'group' => 'contact',
                'label' => 'Email',
                'value' => 'contato@amazonfrigorifico.com.br',
                'type' => 'email',
                'description' => 'Email para contato',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'contact_address',
                'group' => 'contact',
                'label' => 'Endereço',
                'value' => 'Rua das Flores, 123 - Centro - São Paulo/SP',
                'type' => 'textarea',
                'description' => 'Endereço completo da empresa',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'contact_map_latitude',
                'group' => 'contact',
                'label' => 'Latitude do mapa',
                'value' => null,
                'type' => 'text',
                'description' => 'Latitude para posicionar o mapa de localização.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'key' => 'contact_map_longitude',
                'group' => 'contact',
                'label' => 'Longitude do mapa',
                'value' => null,
                'type' => 'text',
                'description' => 'Longitude para posicionar o mapa de localização.',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'key' => 'contact_map_url',
                'group' => 'contact',
                'label' => 'URL personalizada do mapa',
                'value' => null,
                'type' => 'url',
                'description' => 'Link completo do Google Maps (opcional). Usado como fallback ou link externo.',
                'is_active' => true,
                'sort_order' => 7,
            ],

            // Configurações de Redes Sociais
            [
                'key' => 'social_facebook',
                'group' => 'social',
                'label' => 'Facebook',
                'value' => 'https://facebook.com/amazonfrigorifico',
                'type' => 'url',
                'description' => 'Link do perfil no Facebook',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'social_instagram',
                'group' => 'social',
                'label' => 'Instagram',
                'value' => 'https://instagram.com/amazonfrigorifico',
                'type' => 'url',
                'description' => 'Link do perfil no Instagram',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'social_whatsapp',
                'group' => 'social',
                'label' => 'WhatsApp',
                'value' => 'https://wa.me/5511999999999',
                'type' => 'url',
                'description' => 'Link do WhatsApp para contato',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Configurações de SEO
            [
                'key' => 'meta_title',
                'group' => 'seo',
                'label' => 'Meta Title',
                'value' => 'Amazon Frigorífico - Produtos de Qualidade',
                'type' => 'text',
                'description' => 'Título que aparece nos resultados de busca',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'meta_description',
                'group' => 'seo',
                'label' => 'Meta Description',
                'value' => 'Especialistas em produtos de qualidade para sua família. Conheça nossa linha completa de produtos.',
                'type' => 'textarea',
                'description' => 'Descrição que aparece nos resultados de busca',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'meta_keywords',
                'group' => 'seo',
                'label' => 'Meta Keywords',
                'value' => 'frigorífico, produtos, qualidade, família, alimentação',
                'type' => 'text',
                'description' => 'Palavras-chave para SEO (separadas por vírgula)',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($configurations as &$config) {
            $baseValue = $config['value'] ?? null;
            $config['value_pt'] = $config['value_pt'] ?? $baseValue;
            $config['value_en'] = $config['value_en'] ?? $baseValue;
            $config['value_ar'] = $config['value_ar'] ?? $baseValue;
        }
        unset($config);

        foreach ($configurations as $config) {
            Configuration::updateOrCreate(
                ['key' => $config['key']],
                $config
            );
        }
    }
}
