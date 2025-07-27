<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Place; // Import model Place Anda
use App\Models\Category; // Import model Category Anda (jika diperlukan)

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Ambil data dari tabel Places berdasarkan kolom 'fungsi_jalan'
        $totalJalanLingkungan = Place::where('fungsi', '4')->count();
        $totalJalanKabupaten = Place::where('category_id', '2')->count();

        return [
            Stat::make('Jalan Lingkungan', $totalJalanLingkungan)
                ->description('Total segmen jalan lingkungan') // Deskripsi opsional
                ->descriptionIcon('heroicon-s-map') // Ganti dengan ikon yang sesuai
                ->color('primary'), // Warna yang sesuai dengan tema Filament Anda

            // Stat::make('Jalan Arteri', $totalJalanArteri)
            //     ->description('Total segmen jalan arteri')
            //     ->descriptionIcon('heroicon-s-arrow-up')
            //     ->color('info'),


            Stat::make('Jalan Kabupaten', $totalJalanKabupaten)
                ->description('Total segmen jalan kabupaten')
                ->descriptionIcon('heroicon-s-map')
                ->color('info'),

            // // Anda bisa menambahkan statistik lain, contoh:
            // Stat::make('Total Titik Peta', $totalPlaces)
            //     ->description('Jumlah total tempat di peta')
            //     ->descriptionIcon('heroicon-s-map-pin')
            //     ->color('success'),

            // Stat::make('Total Kategori', $totalCategories)
            //     ->description('Jumlah jenis kategori')
            //     ->descriptionIcon('heroicon-s-tag')
            //     ->color('secondary'),
        ];
    }
}
