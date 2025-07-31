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
        $jalanLingkunganCategory = Category::where('name', 'Jalan Lingkungan')->first();
        // $jalanKabupatenCategory = Category::where('name', 'Jalan Kabupaten')->first();

        $totalJalanLingkungan = 0;
        if ($jalanLingkunganCategory) {
            // Diasumsikan 'fungsi' adalah kolom di tabel Place yang berelasi dengan kategori
            $totalJalanLingkungan = Place::where('fungsi', $jalanLingkunganCategory->id)->count();
            // ATAU jika 'fungsi' adalah kolom tersendiri di Place dan Category memiliki kolom 'fungsi_code'
            // $totalJalanLingkungan = Place::where('fungsi', $jalanLingkunganCategory->fungsi_code)->count();
        }

        // $totalJalanKabupaten = 0;
        // if ($jalanKabupatenCategory) {
        //     $totalJalanKabupaten = Place::where('category_id', $jalanKabupatenCategory->id)->count();
        // }

        return [
            Stat::make('Jalan Lingkungan', $totalJalanLingkungan)
                ->description('Total segmen jalan lingkungan') // Deskripsi opsional
                ->descriptionIcon('heroicon-s-map') // Ganti dengan ikon yang sesuai
                ->color('primary'), // Warna yang sesuai dengan tema Filament Anda

            // Stat::make('Jalan Arteri', $totalJalanArteri)
            //     ->description('Total segmen jalan arteri')
            //     ->descriptionIcon('heroicon-s-arrow-up')
            //     ->color('info'),


            // Stat::make('Jalan Kabupaten', $totalJalanKabupaten)
            //     ->description('Total segmen jalan kabupaten')
            //     ->descriptionIcon('heroicon-s-map')
            //     ->color('info'),

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
