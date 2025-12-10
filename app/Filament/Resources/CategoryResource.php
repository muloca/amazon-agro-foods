<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    
    protected static ?string $navigationLabel = 'Categorias';
    
    protected static ?string $modelLabel = 'Categoria';
    
    protected static ?string $pluralModelLabel = 'Categorias';

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
                                    ->maxLength(255)
                                    ->formatStateUsing(fn ($record) => $record?->getRawOriginal('name')),
                                
                                Forms\Components\Textarea::make('description')
                                    ->label('Descrição (PT)')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->formatStateUsing(fn ($record) => $record?->getRawOriginal('description')),
                            ]),
                        Forms\Components\Tabs\Tab::make('English (EN)')
                            ->schema([
                                Forms\Components\TextInput::make('name_translations.en')
                                    ->label('Name (EN)')
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('description_translations.en')
                                    ->label('Description (EN)')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('العربية (AR)')
                            ->schema([
                                Forms\Components\TextInput::make('name_translations.ar')
                                    ->label('الاسم (AR)')
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('description_translations.ar')
                                    ->label('الوصف (AR)')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Forms\Components\Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                    
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
