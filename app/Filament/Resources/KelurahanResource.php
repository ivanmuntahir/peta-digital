<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelurahanResource\Pages;
use App\Filament\Resources\KelurahanResource\RelationManagers;
use App\Models\Kelurahan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelurahanResource extends Resource
{
    protected static ?string $model = Kelurahan::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Administrasi Wilayah';
    protected static ?string $navigationLabel = 'Data Kelurahan/Desa';
     protected static ?string $title = 'Data Kelurahan/Desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kecamatan_id')
                    ->label('Kecamatan') // Label di form
                    ->relationship('kecamatan', 'name') 
                    ->searchable() 
                    ->preload() 
                    ->required(), 
                TextInput::make('name')
                            ->label('Nama Kelurahan/Desa')
                            ->required()
                            ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kecamatan.name') // 'kecamatan.name' merujuk ke relasi dan kolom 'name'
                    ->label('Kecamatan') // Label di tabel
                    ->searchable() // Bisa dicari
                    ->sortable(), // Bisa diurutkan
                TextColumn::make('name')
                    ->label('Nama Kelurahan/Desa')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListKelurahans::route('/'),
            'create' => Pages\CreateKelurahan::route('/create'),
            'edit' => Pages\EditKelurahan::route('/{record}/edit'),
        ];
    }
}
