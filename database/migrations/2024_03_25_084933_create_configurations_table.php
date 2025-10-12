<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Ex: 'site_name', 'primary_color', 'logo_url'
            $table->string('group')->default('general'); // Ex: 'general', 'colors', 'texts', 'social'
            $table->string('label'); // Ex: 'Nome do Site', 'Cor Primária', 'Logo'
            $table->text('value')->nullable(); // O valor da configuração
            $table->string('type')->default('text'); // Ex: 'text', 'color', 'image', 'textarea', 'select'
            $table->json('options')->nullable(); // Opções para campos select
            $table->text('description')->nullable(); // Descrição da configuração
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0); // Para ordenar no painel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
