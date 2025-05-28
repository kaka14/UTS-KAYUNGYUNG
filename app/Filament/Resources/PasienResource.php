<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Filament\Resources\PasienResource\RelationManagers;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('nama')->required(),
            TextInput::make('nomor_ktp')->required()->unique(ignoreRecord: true),
            DatePicker::make('tanggal_lahir')->required(),
            TextInput::make('alamat')->required(),
            TextInput::make('keluhan')->label('Keluhan')->maxLength(255),
            TextInput::make('no_hp')->label('No HP')->maxLength(20),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('nama')->searchable()->sortable(),
            TextColumn::make('nomor_ktp')->searchable(),
            TextColumn::make('tanggal_lahir')->date(),
            TextColumn::make('alamat')->limit(50),
            TextColumn::make('keluhan')->label('Keluhan')->limit(50),
            TextColumn::make('no_hp')->label('No HP'),
        ])
        ->defaultSort('nama');
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
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
}
