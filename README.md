Peta Digital Infrastruktur Jalan
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Tentang Proyek
Proyek ini adalah sebuah aplikasi Peta Digital Infrastruktur Jalan yang dirancang untuk mempermudah visualisasi, pengelolaan, dan pemantauan kondisi jalan secara interaktif. Aplikasi ini memungkinkan pengguna untuk memetakan data infrastruktur jalan, melihat statusnya secara real-time, dan mengelola informasi terkait melalui antarmuka yang intuitif.

Fitur Utama
Visualisasi Peta Interaktif: Menampilkan data infrastruktur jalan di atas peta digital menggunakan OpenStreetMap. Pengguna dapat berinteraksi dengan peta untuk melihat detail setiap titik data.

Input Data (CRUD): Fitur lengkap untuk membuat (Create), membaca (Read), memperbarui (Update), dan menghapus (Delete) data jalan.

Pin Marker Location: Menambahkan marker pada peta yang menampilkan detail penting, seperti:

Gambar terakhir dari lokasi.

Titik koordinat (Latitude, Longitude).

Status permukaan jalan.

Nama pembuat/pengunggah data.

Informasi waktu dan pembuat saat data diperbarui terakhir.

Integrasi Data: Memastikan setiap data yang diinput langsung terintegrasi dan ditampilkan pada visualisasi peta.

Manajemen Akun Pengguna: Sistem autentikasi dan otorisasi untuk mengelola pengguna yang dapat mengakses dan mengelola data.

Tumpukan Teknologi
Proyek ini dibangun menggunakan kombinasi teknologi modern untuk performa dan kemudahan pengembangan:

Backend: Laravel sebagai kerangka kerja utama.

Frontend: Livewire dan Filament untuk membangun antarmuka pengguna yang dinamis dan efisien.

Database: MySQL untuk penyimpanan data yang terstruktur.

Peta: OpenStreetMap untuk menyediakan basis peta yang gratis dan open source.

Instalasi dan Penggunaan
Clone repositori ini:

Bash

git clone https://github.com/nama-pengguna-anda/peta-digital.git
cd peta-digital
Instal dependensi Composer:

Bash

composer install
Salin file .env dan konfigurasikan:

Bash

cp .env.example .env
Buka file .env dan sesuaikan pengaturan database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

Jalankan migrasi database:

Bash

php artisan migrate
Jalankan aplikasi:

Bash

php artisan serve
Aplikasi akan berjalan di http://127.0.0.1:8000.

Kontribusi
Kami menyambut kontribusi dari siapa saja. Jika Anda ingin berkontribusi pada proyek ini, silakan ikuti langkah-langkah berikut:

Fork repositori ini.

Buat branch baru (git checkout -b fitur-baru).

Lakukan perubahan dan commit (git commit -am 'Menambahkan fitur baru').

Push ke branch Anda (git push origin fitur-baru).

Buat Pull Request.

Lisensi
Proyek ini dilisensikan di bawah Lisensi MIT.
