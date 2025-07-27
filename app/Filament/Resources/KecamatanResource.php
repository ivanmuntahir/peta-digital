<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KecamatanResource\Pages;
use App\Filament\Resources\KecamatanResource\RelationManagers;
use App\Models\Kecamatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Administrasi Wilayah';
    protected static ?string $navigationLabel = 'Data Kecamatan';
     protected static ?string $title = 'Data Kecamatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                            ->label('Nama Kecamatan')
                            ->required()
                            ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kecamatan') // Menambahkan label
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
            'index' => Pages\ListKecamatans::route('/'),
            'create' => Pages\CreateKecamatan::route('/create'),
            'edit' => Pages\EditKecamatan::route('/{record}/edit'),
        ];
    }
}
