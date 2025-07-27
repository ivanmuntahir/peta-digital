<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Filament\Resources\PlaceResource\RelationManagers;
use App\Models\Place;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Humaidem\FilamentMapPicker\Fields\OSMMap;
use App\Models\Kelurahan;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static ?string $navigationIcon = 'solar-streets-navigation-linear';

    protected static ?string $navigationLabel = 'Data Jalan';

    protected static ?string $title = 'Daftar Lokasi';
    protected static ?string $navigationGroup = 'Pemetaan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kolom Umum
                Section::make('Informasi Dasar')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lokasi/Jalan')
                            ->required()
                            ->maxLength(255),
                        Select::make('fungsi')
                            ->label('Fungsi')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('kecamatan_id')
                            ->label('Kecamatan')
                            ->relationship('kecamatan', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->live(),
                        Forms\Components\Select::make('kelurahan_id')
                            ->label('Kelurahan')
                            ->options(fn (Forms\Get $get): array =>
                                Kelurahan::where('kecamatan_id', $get('kecamatan_id'))
                                    ->pluck('name', 'id')
                                    ->toArray()
                            )
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->hidden(fn (Forms\Get $get): bool => ! $get('kecamatan_id')),
                    ]),

                // Grup Koordinat (tanpa peta)
                Section::make('Koordinat Lokasi') // Ubah judul grup
                    ->description('Masukkan nilai Latitude dan Longitude secara manual.')
                    ->columns(2) // Atur layout di dalam Section ini menjadi 2 kolom
                    ->schema([
                        TextInput::make('latitude')
                            ->numeric()
                            ->required()
                            ->label('Latitude'), // Tambahkan label
                        TextInput::make('longitude')
                            ->numeric()
                            ->required()
                            ->label('Longitude'), // Tambahkan label
                    ]),

                // Grup Dimensi dan Tipe Jalan
                Section::make('Detail Dimensi & Jenis Jalan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('panjang')
                            ->label('Panjang (meter)')
                            ->numeric()
                            ->suffix('meter')
                            ->nullable(),
                        TextInput::make('lebar')
                            ->label('Lebar (meter)')
                            ->numeric()
                            ->suffix('meter')
                            ->nullable(),
                        Select::make('tipe')
                            ->label('Jenis Permukaan Jalan')
                            ->multiple()
                            ->options([
                                'aspal' => 'Aspal',
                                'paving' => 'Paving',
                                'rabbat' => 'Rabbat',
                                'makadam' => 'Makadam',
                            ])
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),
                    ]),

                // Grup Lampiran
                Section::make('Lampiran Gambar')
                    ->description('Unggah gambar-gambar terkait jalan ini.')
                    ->schema([
                        FileUpload::make('attachment')
                            ->label('Unggah Gambar')
                            ->multiple()
                            ->image()
                            ->imageResizeMode('contain')
                            ->imageResizeTargetWidth('1280')
                            ->imageResizeTargetHeight('720')
                            ->imagePreviewHeight('250')
                            ->maxSize(5000) // 5MB per gambar
                            ->directory('place-images')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->preserveFileNames()
                            ->appendFiles()
                            ->columnSpanFull(),
                    ]),

                // Field Hidden
                Hidden::make('user_id')
                    ->default(fn () => Auth::id()),
            ])
            ->columns(1); // Tetap 1 kolom agar Sections muncul di bawah satu sama lain
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Jalan') // Menambahkan label
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kecamatan_id.name')
                    ->label('Kecamatan') // Menambahkan label
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kelurahan_id.name')
                    ->label('Kelurahan') // Menambahkan label
                    ->searchable()
                    ->sortable(),
                TextColumn::make('latitude')
                    ->label('Latitude') // Menambahkan label
                    ->numeric()
                    ->sortable(),
                TextColumn::make('longitude')
                    ->label('Longitude') // Menambahkan label
                    ->numeric()
                    ->sortable(),
                TextColumn::make('panjang')
                    ->label('Panjang')
                    ->numeric()
                    ->suffix(' meter')
                    ->sortable(),
                TextColumn::make('lebar')
                    ->label('Lebar')
                    ->numeric()
                    ->suffix(' meter')
                    ->sortable(),
                // PERBAIKAN untuk kolom TIPE (JSON)
                TextColumn::make('tipe')
                    ->label('Jenis Permukaan')
                    ->badge() // Ini akan menampilkan setiap item array sebagai badge
                    ->searchable(), // Bisa dicari berdasarkan nilai array
                    // ->sortable(), // Sorting pada kolom JSON array tidak selalu intuitif, bisa dihapus jika bermasalah

                TextColumn::make('functionCategory.name')
                    ->label('Fungsi')
                    ->searchable()
                    ->sortable(),

                // PERBAIKAN untuk category.name
                TextColumn::make('category.name') // HARUSNYA 'category.name' BUKAN 'category_id.name'
                    ->label('Kategori') // Menambahkan label
                    ->searchable() // Ini teks, jadi searchable
                    ->sortable(), // Ini teks, jadi sortable

                // PERBAIKAN untuk user.name
                TextColumn::make('user.name')
                    ->label('Pengunggah')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('attachment')
                    ->label('Gambar Lampiran') // Menambahkan label
                    ->extraAttributes(['class' => 'h-16 w-auto'])
                     ->url(fn ($record) => (!empty($record->attachment) && is_array($record->attachment)) ? asset('storage/' . $record->attachment[0]) : null, shouldOpenInNewTab: true),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada') // Menambahkan label
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada') // Menambahkan label
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Dihapus Pada') // Menambahkan label
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter berdasarkan Kategori
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori'),

                // Filter berdasarkan Tipe Permukaan (jika data JSON array)
                Tables\Filters\SelectFilter::make('tipe')
                    ->options([
                        'aspal' => 'Aspal',
                        'paving' => 'Paving',
                        'rabbat' => 'Rabbat',
                    ])
                    ->query(function (Builder $query, array $data): Builder { // <-- PERHATIKAN INI
                        if (empty($data['value'])) {
                            return $query;
                        }
                        // Untuk kolom JSON array, gunakan whereJsonContains
                        return $query->whereJsonContains('tipe', $data['value']);
                    })
                    ->label('Filter Jenis Permukaan'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }
}
