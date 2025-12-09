<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    
    protected static ?string $navigationLabel = 'Produtos';
    
    protected static ?string $modelLabel = 'Produto';
    
    protected static ?string $pluralModelLabel = 'Produtos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Translations')
                    ->columnSpanFull()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Português (PT)')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nome (PT)')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('description')
                                    ->label('Descrição (PT)')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('English (EN)')
                            ->schema([
                                Forms\Components\TextInput::make('name_translations.en')
                                    ->label('Name (EN)')
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('description_translations.en')
                                    ->label('Description (EN)')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('العربية (AR)')
                            ->schema([
                                Forms\Components\TextInput::make('name_translations.ar')
                                    ->label('الاسم (AR)')
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('description_translations.ar')
                                    ->label('الوصف (AR)')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Forms\Components\Select::make('line')
                    ->label('Linha do Produto')
                    ->options([
                        'premium' => 'Linha Premium',
                        'traditional' => 'Linha Tradicional',
                        'special' => 'Linha Especial',
                    ])
                    ->placeholder('Selecione a linha')
                    ->searchable(),
                    
                Forms\Components\FileUpload::make('image')
                    ->label('Foto Principal')
                    ->image()
                    ->directory('products')
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->helperText('Foto principal do produto'),
                    
                Forms\Components\FileUpload::make('additional_images')
                    ->label('Fotos Adicionais')
                    ->image()
                    ->directory('products/additional')
                    ->disk('public')
                    ->visibility('public')
                    ->multiple()
                    ->columnSpanFull()
                    ->helperText('Fotos complementares do produto'),
                    
                Forms\Components\Select::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                Forms\Components\Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular()
                    ->size(60)
                    ->disk('public')
                    ->defaultImageUrl(url('/images/no-image.svg')),
                    
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('line')
                    ->label('Linha')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'premium' => 'success',
                        'traditional' => 'info',
                        'special' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'premium' => 'Premium',
                        'traditional' => 'Tradicional',
                        'special' => 'Especial',
                        default => 'N/A',
                    }),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->searchable(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('line')
                    ->label('Linha')
                    ->options([
                        'premium' => 'Linha Premium',
                        'traditional' => 'Linha Tradicional',
                        'special' => 'Linha Especial',
                    ]),
                    
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueLabel('Apenas ativos')
                    ->falseLabel('Apenas inativos')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
