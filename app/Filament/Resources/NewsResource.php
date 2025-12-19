<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Notícias';

    protected static ?string $modelLabel = 'Notícia';

    protected static ?string $pluralModelLabel = 'Notícias';

    protected static ?string $navigationGroup = 'Conteúdo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações principais')
                    ->schema([
                        Forms\Components\Tabs::make('translations')
                            ->columnSpanFull()
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('Português (PT)')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Título (PT)')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->formatStateUsing(fn ($record) => $record?->getRawOriginal('title')),

                                        Forms\Components\Textarea::make('summary')
                                            ->label('Resumo (PT)')
                                            ->rows(3)
                                            ->placeholder('Resumo breve da notícia (opcional)')
                                            ->columnSpanFull()
                                            ->formatStateUsing(fn ($record) => $record?->getRawOriginal('summary')),

                                        Forms\Components\RichEditor::make('content')
                                            ->label('Texto principal (PT)')
                                            ->required()
                                            ->columnSpanFull()
                                            ->formatStateUsing(fn ($record) => $record?->getRawOriginal('content'))
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'strike',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                                'blockquote',
                                                'h2',
                                                'h3',
                                                'undo',
                                                'redo',
                                            ]),
                                    ]),
                                Forms\Components\Tabs\Tab::make('English (EN)')
                                    ->schema([
                                        Forms\Components\TextInput::make('title_translations.en')
                                            ->label('Title (EN)')
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('summary_translations.en')
                                            ->label('Summary (EN)')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Forms\Components\RichEditor::make('content_translations.en')
                                            ->label('Content (EN)')
                                            ->columnSpanFull()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'strike',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                                'blockquote',
                                                'h2',
                                                'h3',
                                                'undo',
                                                'redo',
                                            ]),
                                    ]),
                                Forms\Components\Tabs\Tab::make('العربية (AR)')
                                    ->schema([
                                        Forms\Components\TextInput::make('title_translations.ar')
                                            ->label('العنوان (AR)')
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('summary_translations.ar')
                                            ->label('الملخص (AR)')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Forms\Components\RichEditor::make('content_translations.ar')
                                            ->label('المحتوى (AR)')
                                            ->columnSpanFull()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'strike',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                                'blockquote',
                                                'h2',
                                                'h3',
                                                'undo',
                                                'redo',
                                            ]),
                                    ]),
                            ]),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->disabled()
                            ->dehydrated()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Gerado automaticamente a partir do título.'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Mídia e publicação')
                    ->collapsed()
                    ->schema([
                        Forms\Components\FileUpload::make('primary_image')
                            ->label('Imagem principal')
                            ->image()
                            ->directory('news/primary')
                            ->disk('public')
                            ->visibility('public')
                            ->required()
                            ->helperText('Imagem exibida como destaque da notícia.'),

                        Forms\Components\FileUpload::make('additional_images')
                            ->label('Galeria de imagens')
                            ->image()
                            ->directory('news/gallery')
                            ->disk('public')
                            ->visibility('public')
                            ->multiple()
                            ->reorderable()
                            ->helperText('Imagens adicionais opcionais para ilustrar a notícia.'),

                        Forms\Components\TextInput::make('link')
                            ->label('Link externo')
                            ->url()
                            ->maxLength(255)
                            ->helperText('URL opcional para direcionar o leitor a uma página externa.'),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Data de publicação')
                            ->default(now())
                            ->seconds(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('primary_image')
                    ->label('Imagem')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->formatStateUsing(fn ($state, $record) => $record?->getRawOriginal('title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publicada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('link')
                    ->label('Link externo')
                    ->boolean()
                    ->trueIcon('heroicon-o-link')
                    ->falseIcon('heroicon-o-no-symbol')
                    ->tooltip(fn ($state) => $state ?: 'Sem link'),
            ])
            ->filters([
                TernaryFilter::make('published')
                    ->label('Publicação')
                    ->trueLabel('Apenas publicadas')
                    ->falseLabel('Sem data de publicação')
                    ->placeholder('Todas')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('published_at'),
                        false: fn (Builder $query) => $query->whereNull('published_at'),
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
