<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = now();

        $colors = [
            [
                'key' => 'text_heading_color',
                'label' => 'Cor dos Títulos',
                'value' => '#111827',
                'description' => 'Cor padrão aplicada aos títulos (h1-h6).',
            ],
            [
                'key' => 'text_body_color',
                'label' => 'Cor do Texto Principal',
                'value' => '#1f2937',
                'description' => 'Cor padrão aplicada ao texto principal.',
            ],
            [
                'key' => 'text_secondary_color',
                'label' => 'Cor do Texto Secundário',
                'value' => '#374151',
                'description' => 'Cor aplicada a textos secundários e descrições.',
            ],
            [
                'key' => 'text_muted_color',
                'label' => 'Cor do Texto Suave',
                'value' => '#6b7280',
                'description' => 'Cor aplicada a textos menos destacados e placeholders.',
            ],
            [
                'key' => 'hero_heading_color',
                'label' => 'Cor dos Títulos do Hero',
                'value' => '#ffffff',
                'description' => 'Cor aplicada aos títulos presentes nas seções de destaque (hero).',
            ],
            [
                'key' => 'hero_text_color',
                'label' => 'Cor do Texto do Hero',
                'value' => '#f8fafc',
                'description' => 'Cor aplicada aos textos e descrições presentes nas seções de destaque (hero).',
            ],
            [
                'key' => 'card_title_color',
                'label' => 'Cor dos Títulos dos Cards',
                'value' => '#111827',
                'description' => 'Cor aplicada aos títulos exibidos em cards de produtos e categorias.',
            ],
            [
                'key' => 'card_text_color',
                'label' => 'Cor dos Textos dos Cards',
                'value' => '#4b5563',
                'description' => 'Cor aplicada às descrições e textos secundários dos cards.',
            ],
            [
                'key' => 'footer_heading_color',
                'label' => 'Cor dos Títulos do Rodapé',
                'value' => '#ffffff',
                'description' => 'Cor aplicada aos títulos e destaques do rodapé.',
            ],
            [
                'key' => 'footer_text_color',
                'label' => 'Cor dos Textos do Rodapé',
                'value' => '#d1d5db',
                'description' => 'Cor aplicada aos textos padrão do rodapé.',
            ],
        ];

        foreach ($colors as $color) {
            $exists = DB::table('configurations')->where('key', $color['key'])->exists();

            if ($exists) {
                continue;
            }

            DB::table('configurations')->insert([
                'key' => $color['key'],
                'group' => 'colors',
                'label' => $color['label'],
                'value' => $color['value'],
                'type' => 'color',
                'options' => null,
                'description' => $color['description'],
                'is_active' => true,
                'sort_order' => 50,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('configurations')
            ->whereIn('key', [
                'text_heading_color',
                'text_body_color',
                'text_secondary_color',
                'text_muted_color',
                'hero_heading_color',
                'hero_text_color',
                'card_title_color',
                'card_text_color',
                'footer_heading_color',
                'footer_text_color',
            ])->delete();
    }
};
