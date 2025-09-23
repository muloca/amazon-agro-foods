<?php

namespace App\Filament\Resources\ConfigurationResource\Pages;

use App\Filament\Resources\ConfigurationResource;
use App\Models\Configuration;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditConfiguration extends EditRecord
{
    protected static string $resource = ConfigurationResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return ConfigurationResource::prepareLocalizedData($data);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $fallback = $data['value'] ?? null;

        foreach (['value_pt', 'value_en', 'value_ar'] as $localeField) {
            if (blank($data[$localeField] ?? null) && filled($fallback)) {
                $data[$localeField] = $fallback;
            }
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->after(function (Configuration $record) {
                    // Limpar cache quando excluir configuração
                    Cache::forget("config.{$record->key}");
                    Cache::forget("config.group.{$record->group}");
                }),
        ];
    }
    
    protected function afterSave(): void
    {
        // Limpar cache quando salvar configuração
        Cache::forget("config.{$this->record->key}");
        Cache::forget("config.group.{$this->record->group}");
    }
}
