<?php

namespace App\Filament\Resources\PlaceResource\Pages;

use App\Filament\Resources\PlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePlace extends CreateRecord
{
    protected static string $resource = PlaceResource::class;
    protected static ?string $title = 'Buat Lokasi Jalan';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // Set the user_id here
        return $data;
    }
}
