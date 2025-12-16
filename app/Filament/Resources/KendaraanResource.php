<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KendaraanResource\Pages;
use App\Models\Kendaraan;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Data Kendaraan';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([

            Forms\Components\Select::make('customer_id')
                ->label('Nama Customer')
                ->options(
                    Customer::with('user')
                        ->get()
                        ->pluck('user.name', 'id')
                )
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('nomor_plat')
                ->label('Nomor Plat')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('merk')
                ->required(),

            Forms\Components\TextInput::make('tipe')
                ->required(),

            Forms\Components\TextInput::make('tahun')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('warna'),

        ])->columns(2);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nomor_plat')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer.user.name')
                    ->label('Customer')
                    ->searchable(),

                Tables\Columns\TextColumn::make('merk'),
                Tables\Columns\TextColumn::make('tipe'),
                Tables\Columns\TextColumn::make('tahun'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
            'edit' => Pages\EditKendaraan::route('/{record}/edit'),
        ];
    }
}