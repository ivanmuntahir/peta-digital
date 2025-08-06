Peta Digital Infrastruktur Jalan
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Demo Aplikasi
Anda bisa melihat video demo singkat tentang cara kerja aplikasi ini.

<div align="center">
<a href="https://drive.google.com/file/d/1rfj8Axyh2T1JzivYqtt947nc8GhbTdnJ/view?usp=sharing">
</a>
</div>

Cara menambahkan video demo:

Unggah video demo Anda ke platform seperti YouTube atau Vimeo.

Salin URL video tersebut.

Ubah bagian [URL_VIDEO_DEMO_ANDA] di atas dengan URL video Anda.

Tambahkan gambar thumbnail untuk pratinjau, lalu ganti [URL_GAMBAR_THUMBNAIL_ANDA] dengan URL gambarnya. Jika tidak ada gambar, Anda bisa menghapus tag <img>.

Tentang Proyek
Aplikasi Peta Digital Infrastruktur Jalan adalah platform untuk memvisualisasikan, mengelola, dan memantau data kondisi jalan secara interaktif. Pengguna dapat membuat, membaca, memperbarui, dan menghapus data jalan langsung dari peta.

Fitur
Visualisasi Peta: Menampilkan data infrastruktur jalan di atas OpenStreetMap.

CRUD Data: Pengelolaan data jalan yang lengkap (tambah, lihat, ubah, hapus).

Marker Interaktif: Menambahkan marker di peta dengan detail seperti gambar, koordinat, status jalan, dan data pembuat.

Manajemen Pengguna: Sistem akun untuk mengelola akses.

Teknologi
Framework: Laravel

Frontend: Livewire & Filament

Peta: OpenStreetMap

Database: MySQL

Cara Instalasi
Clone Repositori:

Bash

git clone https://github.com/nama-pengguna-anda/peta-digital.git
cd peta-digital
Instalasi & Konfigurasi:

Bash

composer install
cp .env.example .env
# Konfigurasi .env (database)
php artisan migrate
Jalankan Aplikasi:

Bash

php artisan serve
Akses aplikasi di http://127.0.0.1:8000.

Lisensi
Proyek ini dilisensikan di bawah Lisensi MIT.
