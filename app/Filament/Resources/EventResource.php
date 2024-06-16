<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Master Data';
    public static function shouldRegisterNavigation():bool
    {
        if(auth()->user()->can('access event'))
            return true;
        else
            return false;
    }

    public static function canViewAny():bool
    {
        if(auth()->user()->can('access event'))
            return true;
        else
            return false;

    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('nama')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('lokasi')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('provinsi')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('kategori')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('deskripsi')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('informasi')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DateTimePicker::make('mulai')
                        ->required(),
                    Forms\Components\DateTimePicker::make('akhir')
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('lokasi')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('provinsi')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('kategori')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('deskripsi')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('informasi')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('mulai')
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('akhir')
                ->searchable()
                ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            RelationManagers\TicketsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
