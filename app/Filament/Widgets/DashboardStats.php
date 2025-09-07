<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProducts = \App\Models\Product::count();
        $totalCategories = \App\Models\Category::count();
        $activeProducts = \App\Models\Product::where('is_active', true)->count();
        $activeCategories = \App\Models\Category::where('is_active', true)->count();

        return [
            Stat::make('Total de Produtos', $totalProducts)
                ->description('Produtos cadastrados')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),
            
            Stat::make('Total de Categorias', $totalCategories)
                ->description('Categorias cadastradas')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
            
            Stat::make('Produtos Ativos', $activeProducts)
                ->description('Produtos disponíveis')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            
            Stat::make('Categorias Ativas', $activeCategories)
                ->description('Categorias disponíveis')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
        ];
    }
}
