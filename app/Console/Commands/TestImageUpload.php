<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestImageUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:image-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa se o upload de imagens está funcionando corretamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testando configuração de upload de imagens...');
        
        // Verifica se o diretório products existe
        if (Storage::disk('public')->exists('products')) {
            $this->info('✅ Diretório products existe');
        } else {
            $this->error('❌ Diretório products não existe');
            Storage::disk('public')->makeDirectory('products');
            $this->info('✅ Diretório products criado');
        }
        
        // Verifica permissões
        $path = storage_path('app/public/products');
        if (is_writable($path)) {
            $this->info('✅ Diretório products tem permissão de escrita');
        } else {
            $this->error('❌ Diretório products não tem permissão de escrita');
        }
        
        // Verifica se o link simbólico existe
        $linkPath = public_path('storage');
        if (is_link($linkPath)) {
            $this->info('✅ Link simbólico storage existe');
        } else {
            $this->error('❌ Link simbólico storage não existe');
            $this->info('Execute: php artisan storage:link');
        }
        
        // Verifica se a imagem padrão existe
        if (file_exists(public_path('images/no-image.svg'))) {
            $this->info('✅ Imagem padrão existe');
        } else {
            $this->error('❌ Imagem padrão não existe');
        }
        
        $this->info('Teste concluído!');
    }
}
