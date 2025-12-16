<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Customer';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([

            Forms\Components\Select::make('user_id')
                ->label('Nama Customer')
                ->options(
                    User::where('role', 'user')
                        ->pluck('name', 'id')
                )
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('no_ktp')
                ->label('No KTP')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('no_hp')
                ->label('Nomor HP')
                ->tel()
                ->required(),

            Forms\Components\Textarea::make('alamat')
                ->columnSpanFull(),

        ])->columns(2);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Customer')
                    ->searchable(),

                Tables\Columns\TextColumn::make('no_ktp')
                    ->label('No KTP'),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('HP'),

                Tables\Columns\TextColumn::make('kendaraans.nomor_plat')
                    ->label('Nomor Plat')
                    ->badge()
                    ->separator(', '),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}