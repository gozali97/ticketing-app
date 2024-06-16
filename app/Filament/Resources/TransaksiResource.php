<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Ticket;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Transaksi';
    public static function shouldRegisterNavigation():bool
    {
        if(auth()->user()->can('access transaksi'))
            return true;
        else
            return false;
    }

    public static function canViewAny():bool
    {
        if(auth()->user()->can('access transaksi'))
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
                        Forms\Components\Select::make('ticket_id')
                            ->label('Ticket')
                            ->required()
                            ->searchable()
                            ->options(
                                Ticket::query()
                                    ->with('event')
                                    ->get()
                                    ->mapWithKeys(function ($ticket) {
                                        return [$ticket->id => $ticket->event->nama . ' - ' . $ticket->nama];
                                    })
                            )
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $ticket = Ticket::find($state);
                                $harga = $ticket?->harga ?? 0;
                                $jumlah = $get('jumlah') ?? 0;
                                $set('harga', $harga);
                                $set('total', $harga * $jumlah);
                            }),
                        Forms\Components\TextInput::make('harga')
                            ->required()
                            ->readOnly(),
                        Forms\Components\TextInput::make('jumlah')
                            ->required()
                            ->numeric()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $ticketId = $get('ticket_id');
                                $ticket = Ticket::find($ticketId);
                                $harga = $get('harga') ?? 0;
                                $total = $harga * $state;
                                $set('total', $total);

                                if ($ticket) {
                                    if ($state > $ticket->maksimal_pembelian) {
                                        Notification::make()
                                            ->title('Error')
                                            ->body("Jumlah tidak boleh lebih dari maksimal pembelian: {$ticket->maksimal_pembelian}")
                                            ->danger()
                                            ->send();
                                        $set('jumlah', $ticket->maksimal_pembelian);
                                    }

                                    $sisaKuota = $ticket->kuota - $state;
                                    if ($sisaKuota < 0) {
                                        Notification::make()
                                            ->title('Error')
                                            ->body("Kuota tiket tidak cukup. Sisa kuota yang tersedia: {$ticket->kuota}")
                                            ->danger()
                                            ->send();
                                        $set('jumlah', $ticket->kuota);
                                        $set('total', $harga * $ticket->kuota);
                                    }
                                }
                            }),
                        Forms\Components\TextInput::make('total')
                            ->required()
                            ->readOnly(),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->required(),
                        Forms\Components\TextInput::make('telepon')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'New' => 'New',
                                'Payment' => 'Payment',
                                'Done' => 'Done',
                            ])
                            ->default('New')
                            ->required(),
                    ])->columns(2),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('ticket.event.nama')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('ticket.nama')
                    ->label('Ticket')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('harga')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'New' => 'primary',
                        'Payment' => 'success',
                        'Done' => 'warning',
                    })
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
