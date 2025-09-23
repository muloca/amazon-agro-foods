<?php

namespace App\Filament\Resources\ConfigurationResource\Pages;

use App\Filament\Resources\ConfigurationResource;
use App\Models\Configuration;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListConfigurations extends ListRecords
{
    protected static string $resource = ConfigurationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $counts = Configuration::select('group')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('group')
            ->pluck('total', 'group');

        $totalCount = $counts->values()->sum() ?: Configuration::count();

        $makeTab = function (string $label, ?string $groupKey = null) use ($counts): Tab {
            $tab = Tab::make($label);

            if ($groupKey) {
                $tab->modifyQueryUsing(fn (Builder $query) => $query->where('group', $groupKey));
                $tab->badge($counts->get($groupKey) ?: null);
            }

            return $tab;
        };

        return [
            'all' => Tab::make('Todas')->badge($totalCount ?: null),
            'general' => $makeTab('Gerais', 'general'),
            'colors' => $makeTab('Cores', 'colors'),
            'texts' => $makeTab('Textos', 'texts'),
            'social' => $makeTab('Redes Sociais', 'social'),
            'contact' => $makeTab('Contato', 'contact'),
            'seo' => $makeTab('SEO', 'seo'),
        ];
    }
}
