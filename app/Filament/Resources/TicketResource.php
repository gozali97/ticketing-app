<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Master Data';
    public static function shouldRegisterNavigation():bool
    {
        if(auth()->user()->can('access ticket'))
            return true;
        else
            return false;
    }

    public static function canViewAny():bool
    {
        if(auth()->user()->can('access ticket'))
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
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('event_id')
                            ->relationship('event', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255)
                    ])->columns(2),
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('harga')
                            ->required()
                            ->Numeric(),
                        Forms\Components\TextInput::make('kuota')
                            ->required()
                            ->Numeric(),
                        Forms\Components\TextInput::make('maksimal_pembelian')
                            ->numeric()
                            ->required(),
                    ])->columns(3),
                    Forms\Components\Textarea::make('keterangan')
                    ->required()
                    ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.nama')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('harga')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('kuota')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('maksimal_pembelian')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
