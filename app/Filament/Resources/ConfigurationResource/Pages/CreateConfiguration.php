<?php

namespace App\Filament\Resources\ConfigurationResource\Pages;

use App\Filament\Resources\ConfigurationResource;
use App\Models\Configuration;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

class CreateConfiguration extends CreateRecord
{
    protected static string $resource = ConfigurationResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return ConfigurationResource::prepareLocalizedData($data);
    }

    protected function afterCreate(): void
    {
        // Limpar cache quando criar nova configuração
        Cache::forget("config.{$this->record->key}");
        Cache::forget("config.group.{$this->record->group}");
    }
}
