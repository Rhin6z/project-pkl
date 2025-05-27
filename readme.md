# Aplikasi Manajemen PKL (Praktik Kerja Lapangan)

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![Filament](https://img.shields.io/badge/Filament-3.x-2C3E50?style=for-the-badge&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3.x-4B4B4B?style=for-the-badge&logo=livewire)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql)

Aplikasi manajemen Praktik Kerja Lapangan (PKL) ini dibangun menggunakan framework Laravel, FilamentPHP untuk panel admin yang intuitif, dan Livewire untuk interaksi front-end yang dinamis. Proyek ini bertujuan untuk menyederhanakan proses pengelolaan data siswa, guru pembimbing, perusahaan industri, dan informasi PKL itu sendiri.

## Fitur Utama

* **Manajemen Pengguna:**
    * Sistem autentikasi (Login, Register, Lupa Password, Verifikasi Email).
    * Manajemen peran dan izin menggunakan `spatie/laravel-permission` (Admin, Guru, Siswa, Industri).
    * Panel admin untuk mengelola pengguna (Filament).
* **Manajemen Data Siswa:**
    * Pencatatan data lengkap siswa (NISN, Nama, Kelas, Jurusan, dll.).
    * Akses dari panel admin (Filament) dan halaman khusus untuk siswa (Livewire).
* **Manajemen Data Guru Pembimbing:**
    * Pencatatan data guru pembimbing.
    * Akses dari panel admin (Filament).
* **Manajemen Data Industri/Perusahaan:**
    * Pencatatan detail perusahaan tempat PKL.
    * Akses dari panel admin (Filament).
* **Manajemen Data PKL:**
    * Pencatatan informasi PKL (Periode, Siswa, Industri, Guru Pembimbing, Status, dll.).
    * Akses dari panel admin (Filament) dan halaman khusus untuk siswa/guru (Livewire).
* **API Endpoints:**
    * RESTful API untuk data Guru, Industri, PKL, dan Siswa (menggunakan Laravel Sanctum untuk otentikasi API).
* **Panel Admin Intuitif:**
    * Antarmuka admin yang powerful dan mudah digunakan berkat FilamentPHP.

## Teknologi yang Digunakan

* **Backend:** Laravel 12
* **Database:** MySQL
* **Admin Panel:** FilamentPHP 3.x
* **Frontend Interactivity:** Laravel Livewire 3.x
* **Autentikasi API:** Laravel Sanctum
* **Manajemen Peran & Izin:** Spatie Laravel Permission
* **Versi PHP:** PHP 8.2+

## Persyaratan Sistem

Pastikan server Anda memenuhi persyaratan minimum untuk menjalankan Laravel:

* PHP >= 8.2
* Composer
* Node.js & npm (atau Yarn)
* MySQL Database
* Ekstensi PHP: `Ctype`, `cURL`, `DOM`, `Fileinfo`, `Filter`, `Mbstring`, `OpenSSL`, `PCRE`, `PDO`, `Session`, `Tokenizer`, `XML`.

## Instalasi

Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repositori:**
    ```bash
    git clone [https://github.com/your-username/project-pkl.git](https://github.com/your-username/project-pkl.git)
    cd project-pkl
    ```

2.  **Instal Dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Buat File `.env`:**
    Salin file `.env.example` dan ubah namanya menjadi `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Konfigurasi `.env`:**
    Edit file `.env` dan atur detail database Anda:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=username_database_anda
    DB_PASSWORD=password_database_anda
    ```
    Juga, generate kunci aplikasi:
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi Database dan Seed Data:**
    ```bash
    php artisan migrate --seed
    ```
    *Catatan: `--seed` akan menjalankan semua seeder, termasuk `UserSeeder`, `GuruSeeder`, `IndustriSeeder`, dan `PklSeeder` yang Anda miliki. Pastikan seeders sudah diatur untuk membuat data dummy yang relevan.*

6.  **Instal Dependensi NPM dan Kompilasi Aset Frontend:**
    ```bash
    npm install
    npm run dev # Atau npm run build untuk produksi
    ```

7.  **Jalankan Server Pengembangan Laravel:**
    ```bash
    php artisan serve
    ```

    Aplikasi akan tersedia di `http://127.0.0.1:8000`.

## Penggunaan Aplikasi

### Akses Panel Admin Filament

Panel admin tersedia di `http://127.0.0.1:8000/admin`.
Anda dapat login dengan akun yang dibuat melalui seeder (biasanya `admin@example.com` dengan password `password`, atau sesuai konfigurasi seeder Anda).

### Akses Frontend (Livewire)

Halaman utama aplikasi (dashboard, list siswa, guru, industri, pkl) dapat diakses melalui `http://127.0.0.1:8000/dashboard` setelah login sebagai pengguna biasa.

### API Endpoints

Akses API di bawah route `/api`. Anda mungkin perlu menggunakan token otentikasi (Laravel Sanctum) untuk mengakses endpoint yang dilindungi.

* `GET /api/gurus`
* `GET /api/gurus/{id}`
* `POST /api/gurus`
* `PUT /api/gurus/{id}`
* `DELETE /api/gurus/{id}`
* (dan seterusnya untuk `/api/industris`, `/api/pkls`, `/api/siswas`)

## Struktur Proyek

* `app/Filament/Resources`: Definisi Resource Filament untuk panel admin.
* `app/Http/Controllers/Api`: Controller untuk API RESTful.
* `app/Livewire`: Komponen Livewire untuk fungsionalitas front-end.
* `app/Models`: Model Eloquent untuk representasi tabel database.
* `app/Policies`: Kebijakan otorisasi untuk model.
* `database/migrations`: Skema database.
* `database/seeders`: Data awal untuk database.
* `routes/api.php`: Definisi route untuk API.
* `routes/web.php`: Definisi route untuk web.
* `resources/views`: Blade templates untuk tampilan.

## Kontribusi

Kontribusi dipersilakan! Silakan buka *issue* atau ajukan *pull request*.
