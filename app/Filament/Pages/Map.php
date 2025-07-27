<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Map extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = 'Peta Jalan';

    protected static ?string $title = 'Peta Jalan';

    protected static string $view = 'filament.pages.map';
    protected static ?string $navigationGroup = 'Pemetaan';
}
