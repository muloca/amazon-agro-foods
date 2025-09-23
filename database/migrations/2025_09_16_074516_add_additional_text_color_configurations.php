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
                'key' => 'hero_heading_color',
                'label' => 'Cor dos Títulos do Hero',
                'value' => '#ffffff',
                'description' => 'Cor aplicada aos títulos nas seções de destaque (hero).',
            ],
            [
                'key' => 'hero_text_color',
                'label' => 'Cor do Texto do Hero',
                'value' => '#f8fafc',
                'description' => 'Cor aplicada aos textos e descrições nas seções de destaque (hero).',
            ],
            [
                'key' => 'card_title_color',
                'label' => 'Cor dos Títulos dos Cards',
                'value' => '#111827',
                'description' => 'Cor aplicada aos títulos de cards de produtos e categorias.',
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
                'sort_order' => 60,
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
                'hero_heading_color',
                'hero_text_color',
                'card_title_color',
                'card_text_color',
                'footer_heading_color',
                'footer_text_color',
            ])->delete();
    }
};
