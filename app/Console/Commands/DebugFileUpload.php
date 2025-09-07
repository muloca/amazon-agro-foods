<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DebugFileUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:file-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug FileUpload issues in Filament';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== DEBUG FILEUPLOAD ===');
        
        $product = Product::find(3);
        if (!$product) {
            $this->error('Produto ID 3 não encontrado');
            return;
        }
        
        $this->info('Produto: ' . $product->name);
        $this->info('Imagem principal: ' . ($product->image ?? 'NULL'));
        $this->info('Imagens adicionais: ' . json_encode($product->additional_images));
        
        // Verificar se os arquivos existem
        if ($product->image) {
            $exists = Storage::disk('public')->exists($product->image);
            $this->info('Arquivo principal existe: ' . ($exists ? 'SIM' : 'NÃO'));
            
            if ($exists) {
                $url = Storage::disk('public')->url($product->image);
                $this->info('URL principal: ' . $url);
            }
        }
        
        if ($product->additional_images) {
            foreach ($product->additional_images as $index => $image) {
                $exists = Storage::disk('public')->exists($image);
                $this->info("Arquivo adicional {$index} existe: " . ($exists ? 'SIM' : 'NÃO'));
                
                if ($exists) {
                    $url = Storage::disk('public')->url($image);
                    $this->info("URL adicional {$index}: " . $url);
                }
            }
        }
        
        // Verificar configuração do Filament
        $this->info('=== CONFIGURAÇÃO FILAMENT ===');
        $this->info('APP_URL: ' . config('app.url'));
        $this->info('FILESYSTEM_DISK: ' . config('filesystems.default'));
        
        $this->info('Debug concluído!');
    }
}
