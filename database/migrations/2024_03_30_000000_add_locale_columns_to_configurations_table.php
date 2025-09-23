<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->text('value_pt')->nullable()->after('value');
            $table->text('value_en')->nullable()->after('value_pt');
            $table->text('value_ar')->nullable()->after('value_en');
        });

        DB::table('configurations')->update([
            'value_pt' => DB::raw('COALESCE(value_pt, value)'),
            'value_en' => DB::raw('COALESCE(value_en, value)'),
            'value_ar' => DB::raw('COALESCE(value_ar, value)'),
        ]);
    }

    public function down(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->dropColumn(['value_pt', 'value_en', 'value_ar']);
        });
    }
};
