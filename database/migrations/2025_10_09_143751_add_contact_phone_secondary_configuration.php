<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $exists = DB::table('configurations')
            ->where('key', 'contact_phone_secondary')
            ->exists();

        if (! $exists) {
            DB::table('configurations')->insert([
                'key' => 'contact_phone_secondary',
                'group' => 'contact',
                'label' => 'Telefone (secundário)',
                'value' => null,
                'value_pt' => null,
                'value_en' => null,
                'value_ar' => null,
                'type' => 'text',
                'options' => null,
                'description' => 'Número de telefone alternativo para contato.',
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('configurations')
            ->where('key', 'contact_phone_secondary')
            ->delete();
    }
};
