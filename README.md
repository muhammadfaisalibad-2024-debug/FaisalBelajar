# RSHP - Veterinary Hospital Management System

Sistem Informasi Manajemen Rumah Sakit Hewan berbasis Laravel.

## Fitur Utama

- **Autentikasi & Manajemen User**
  - Login/Logout
  - Manajemen Role & Permission
  - Reset Password

- **Data Master**
  - Data Pemilik Hewan
  - Data Hewan Peliharaan
  - Jenis Hewan
  - Ras Hewan
  - Kategori
  - Kategori Klinis
  - Kode Tindakan Terapi

- **Modul Admin**
  - Dashboard
  - Laporan
  - Pengaturan Sistem

## Teknologi yang Digunakan

- **Framework**: Laravel 12.x
- **Database**: MySQL
- **Frontend**: Blade Templates, Bootstrap 5
- **Authentication**: Laravel Breeze

## Instalasi

### Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js & NPM (untuk asset compilation)

### Langkah Instalasi

1. Clone atau download project ini

2. Install dependencies:
```bash
composer install
npm install
```

3. Copy file environment:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Buat database MySQL dengan nama `rshp_laravel`

6. Konfigurasi database di file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rshp_laravel
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database:
```bash
php artisan migrate
```

8. (Opsional) Jalankan seeder untuk data awal:
```bash
php artisan db:seed
```

9. Compile assets:
```bash
npm run dev
```

10. Jalankan aplikasi:
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Default Login

Setelah menjalankan seeder:
- **Username**: admin
- **Password**: password

## Struktur Database

### Tabel Utama

- `users` - Data pengguna sistem
- `roles` - Role pengguna
- `owners` - Data pemilik hewan
- `pets` - Data hewan peliharaan
- `animal_types` - Jenis hewan (anjing, kucing, dll)
- `animal_breeds` - Ras hewan
- `categories` - Kategori umum
- `clinical_categories` - Kategori klinis
- `therapy_action_codes` - Kode tindakan terapi

## License

Project ini dibuat untuk keperluan pembelajaran dan menggunakan Laravel framework yang berlisensi [MIT license](https://opensource.org/licenses/MIT).
