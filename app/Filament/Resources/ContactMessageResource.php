<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Mensagens de Contato';
    protected static ?string $pluralModelLabel = 'Mensagens de Contato';
    protected static ?string $modelLabel = 'Mensagem de Contato';
    protected static ?string $navigationGroup = 'Atendimento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->disabled(),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefone')
                    ->tel()
                    ->disabled(),
                Forms\Components\TextInput::make('subject')
                    ->label('Assunto')
                    ->disabled(),
                Forms\Components\Textarea::make('message')
                    ->label('Mensagem')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Assunto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Mensagem')
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Recebido em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Visualizar')
                    ->modalHeading('Detalhes da Mensagem')
                    ->form([
                        Forms\Components\TextInput::make('name')->label('Nome')->disabled(),
                        Forms\Components\TextInput::make('email')->label('E-mail')->disabled(),
                        Forms\Components\TextInput::make('phone')->label('Telefone')->disabled(),
                        Forms\Components\TextInput::make('subject')->label('Assunto')->disabled(),
                        Forms\Components\Textarea::make('message')->label('Mensagem')->disabled()->columnSpanFull(),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Recebido em')
                            ->content(fn (ContactMessage $record) => $record->created_at?->format('d/m/Y H:i')),
                    ]),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListContactMessages::route('/'),
        ];
    }
}
