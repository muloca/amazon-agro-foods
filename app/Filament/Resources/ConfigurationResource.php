<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigurationResource\Pages;
use App\Filament\Resources\ConfigurationResource\RelationManagers;
use App\Models\Configuration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

class ConfigurationResource extends Resource
{
    protected static ?string $model = Configuration::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationLabel = 'Configurações';
    
    protected static ?string $modelLabel = 'Configuração';
    
    protected static ?string $pluralModelLabel = 'Configurações';
    
    protected static ?string $navigationGroup = 'Sistema';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações Básicas')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Chave')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Identificador único da configuração (ex: site_name, primary_color)'),
                        
                        Forms\Components\Select::make('group')
                            ->label('Grupo')
                            ->required()
                            ->options([
                                'general' => 'Geral',
                                'colors' => 'Cores',
                                'texts' => 'Textos',
                                'social' => 'Redes Sociais',
                                'contact' => 'Contato',
                                'seo' => 'SEO',
                            ])
                            ->helperText('Agrupa configurações relacionadas'),
                        
                        Forms\Components\TextInput::make('label')
                            ->label('Rótulo')
                            ->required()
                            ->helperText('Nome que aparecerá no painel'),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Descrição')
                            ->rows(2)
                            ->helperText('Descrição opcional da configuração'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Configuração do Campo')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Tipo de Campo')
                            ->required()
                            ->options([
                                'text' => 'Texto',
                                'textarea' => 'Texto Longo',
                                'color' => 'Cor',
                                'image' => 'Imagem',
                                'select' => 'Seleção',
                                'number' => 'Número',
                                'url' => 'URL',
                                'email' => 'Email',
                            ])
                            ->reactive()
                            ->helperText('Tipo de campo para edição'),
                        
                        Forms\Components\Textarea::make('options')
                            ->label('Opções (JSON)')
                            ->rows(3)
                            ->visible(fn (Get $get) => $get('type') === 'select')
                            ->helperText('Para campos de seleção, use formato JSON: ["opção1", "opção2"]'),
                        
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Ordem')
                            ->numeric()
                            ->default(0)
                            ->helperText('Ordem de exibição no painel'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true)
                            ->helperText('Se a configuração está ativa'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Valor')
                    ->schema([
                        Forms\Components\Select::make('brand_color_preset')
                            ->label('Paleta da marca')
                            ->options(static::brandColorOptions())
                            ->placeholder('Selecionar cor principal')
                            ->native(false)
                            ->dehydrated(false)
                            ->visible(fn (Get $get) => $get('type') === 'color')
                            ->default(fn (Get $get) => array_key_exists($get('value'), static::brandColorOptions()) ? $get('value') : null)
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, ?string $state): void {
                                if (filled($state)) {
                                    $set('value', $state);
                                    $set('value_pt', $state);
                                    $set('value_en', $state);
                                    $set('value_ar', $state);
                                }
                            })
                            ->helperText('Use uma cor da identidade visual sem precisar copiar o código.'),
                        Forms\Components\Tabs::make('value_translations')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('Português')
                                    ->schema([
                                        Forms\Components\Textarea::make('value_pt')
                                            ->label('Valor (Português)')
                                            ->rows(fn (Get $get) => $get('type') === 'textarea' ? 5 : 3)
                                            ->default(fn (Get $get) => $get('value'))
                                            ->helperText('Conteúdo exibido para visitantes em Português.'),
                                    ]),
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\Textarea::make('value_en')
                                            ->label('Value (English)')
                                            ->rows(fn (Get $get) => $get('type') === 'textarea' ? 5 : 3)
                                            ->default(fn (Get $get) => $get('value_en') ?? $get('value'))
                                            ->helperText('Content shown to visitors in English.'),
                                    ]),
                                Forms\Components\Tabs\Tab::make('العربية')
                                    ->schema([
                                        Forms\Components\Textarea::make('value_ar')
                                            ->label('القيمة (العربية)')
                                            ->rows(fn (Get $get) => $get('type') === 'textarea' ? 5 : 3)
                                            ->default(fn (Get $get) => $get('value_ar') ?? $get('value'))
                                            ->helperText('المحتوى المعروض للزوار باللغة العربية.'),
                                    ]),
                            ])
                            ->visible(fn (Get $get) => in_array($get('type'), ['text', 'textarea'])
                                && ! in_array($get('key'), [
                                    'social_facebook',
                                    'social_instagram',
                                    'social_whatsapp',
                                    'contact_map_latitude',
                                    'contact_map_longitude',
                                    'contact_phone',
                                    'contact_phone_secondary',
                                ]))
                            ->columnSpanFull(),
                        Forms\Components\ColorPicker::make('value')
                            ->label('Valor')
                            ->visible(fn (Get $get) => $get('type') === 'color')
                            ->default('#ffffff')
                            ->helperText('Selecione a cor desejada'),
                        Forms\Components\TextInput::make('value')
                            ->label(fn (Get $get) => $get('type') === 'url' ? 'Link' : 'Valor')
                            ->visible(fn (Get $get) => in_array($get('type'), ['url', 'email', 'number'])
                                || in_array($get('key'), [
                                    'contact_map_latitude',
                                    'contact_map_longitude',
                                    'contact_phone',
                                    'contact_phone_secondary',
                                ]))
                            ->url(fn (Get $get) => $get('type') === 'url')
                            ->email(fn (Get $get) => $get('type') === 'email')
                            ->numeric(fn (Get $get) => $get('type') === 'number')
                            ->default(fn (Get $get) => $get('value') ?? $get('value_pt') ?? $get('value_en') ?? $get('value_ar'))
                            ->helperText('Valor atual da configuração'),
                        Forms\Components\Textarea::make('value')
                            ->label('Valor')
                            ->rows(3)
                            ->columnSpanFull()
                            ->visible(fn (Get $get) => ! in_array($get('type'), ['color', 'text', 'textarea', 'url', 'email', 'number']))
                            ->helperText('Valor atual da configuração'),
                    ])
                    ->columns(1),
            ]);
    }

    protected static function brandColorOptions(): array
    {
        return [
            '#03662c' => 'Verde escuro (Primária)',
            '#58ac43' => 'Verde claro (Secundária)',
            '#07668f' => 'Azul de detalhe',
            '#e5d830' => 'Amarelo (Acento)',
            '#ffffff' => 'Branco',
        ];
    }

    public static function prepareLocalizedData(array $data): array
    {
        $type = $data['type'] ?? null;
        $key = $data['key'] ?? null;

        if (in_array($type, ['color', 'url', 'email', 'number'])
            || in_array($key, [
                'social_facebook',
                'social_instagram',
                'social_whatsapp',
                'contact_map_latitude',
                'contact_map_longitude',
                'contact_phone',
                'contact_phone_secondary',
            ])) {
            $value = $data['value'] ?? $data['value_pt'] ?? null;
            $data['value'] = $value;
            $data['value_pt'] = $value;
            $data['value_en'] = $value;
            $data['value_ar'] = $value;

            return $data;
        }

        $valuePt = Arr::get($data, 'value_pt');
        $valueEn = Arr::get($data, 'value_en');
        $valueAr = Arr::get($data, 'value_ar');
        $valueBase = Arr::get($data, 'value');

        $fallback = $valuePt ?? $valueBase ?? $valueEn ?? $valueAr ?? null;

        $data['value_pt'] = $valuePt ?? $fallback;
        $data['value_en'] = $valueEn ?? $fallback;
        $data['value_ar'] = $valueAr ?? $fallback;

        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('key')
                    ->label('Chave')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Chave copiada!')
                    ->color('gray'),
                
                Tables\Columns\BadgeColumn::make('group')
                    ->label('Grupo')
                    ->colors([
                        'primary' => 'general',
                        'success' => 'colors',
                        'warning' => 'texts',
                        'info' => 'social',
                        'secondary' => 'contact',
                        'danger' => 'seo',
                    ]),
                
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color('gray'),
                
                Tables\Columns\TextColumn::make('value_pt')
                    ->label('Valor (pt-BR)')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),

                Tables\Columns\ColorColumn::make('value')
                    ->label('Pré-visualização')
                    ->visible(fn (?Configuration $record): bool => ($record?->type === 'color'))
                    ->copyable()
                    ->copyMessage('Cor copiada!'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordem')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Grupo')
                    ->options([
                        'general' => 'Geral',
                        'colors' => 'Cores',
                        'texts' => 'Textos',
                        'social' => 'Redes Sociais',
                        'contact' => 'Contato',
                        'seo' => 'SEO',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Ativo')
                    ->boolean()
                    ->trueLabel('Apenas ativos')
                    ->falseLabel('Apenas inativos')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar')
                    ->after(function (Configuration $record) {
                        Cache::forget("config.{$record->key}");               
                        Cache::forget("config.group.{$record->group}");
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Excluir selecionados')
                        ->after(function ($records) {
                            foreach ($records as $record) {
                                Cache::forget("config.{$record->key}");
                                Cache::forget("config.group.{$record->group}");
                            }
                        }),
                ]),
            ])
            ->defaultSort('group')
            ->groups([
                Tables\Grouping\Group::make('group')
                    ->label('Grupo')
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConfigurations::route('/'),
            'create' => Pages\CreateConfiguration::route('/create'),
            'edit' => Pages\EditConfiguration::route('/{record}/edit'),
        ];
    }
}
