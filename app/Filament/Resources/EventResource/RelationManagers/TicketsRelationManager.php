<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketsRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->Numeric(),
                Forms\Components\TextInput::make('kuota')
                    ->required()
                    ->Numeric(),
                Forms\Components\TextInput::make('maksimal_pembelian')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('keterangan')
                    ->required()
                    ->columnSpanFull(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('harga')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('kuota')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('maksimal_pembelian')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
