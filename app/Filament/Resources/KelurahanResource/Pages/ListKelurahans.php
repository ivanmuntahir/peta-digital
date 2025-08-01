<?php

namespace App\Filament\Resources\KelurahanResource\Pages;

use App\Filament\Resources\KelurahanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelurahans extends ListRecords
{
    protected static string $resource = KelurahanResource::class;
    protected static ?string $title = 'Data Kelurahan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Kelurahan')
            ->color('success'),
        ];
    }
}
