<?php

namespace App\Filament\Resources\PlaceResource\Pages;

use App\Filament\Resources\PlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlaces extends ListRecords
{
    protected static string $resource = PlaceResource::class;

    protected static ?string $title = 'Data Jalan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Jalan')
            ->color('success'),
        ];
    }
}
