# Portal Akademik ITS — PBKK Pertemuan 10

Kelanjutan project PBKK Week 4 (Laravel Blade) dengan implementasi Admin Dashboard dan Role-Based Access Control (RBAC).

## Teknologi

- Laravel 13 + Blade
- Laravel Breeze (session authentication / Blade auth flow)
- Laravel AdminLTE v4
- Spatie Laravel Permission v8
- SQLite (default) atau database lain yang didukung Laravel
- Faker untuk data dummy

## Fitur yang dibuat

### Wajib

1. **AdminLTE dashboard** menggunakan `@extends('adminlte::page')`.
2. **Login** menggunakan pola session authentication Laravel Breeze (Blade), validasi, session regeneration, dan logout; rute auth dipisah di `routes/auth.php`.
3. **Spatie RBAC** dengan role `Admin` dan `Staf`, disimpan di database.
4. **Tiga widget statistik dinamis**: total mahasiswa, total dosen, dan total tugas aktif. Semua angka dihitung dari query Eloquent `count()`.
5. **Proteksi server-side** pada route dan controller. Staf tidak dapat menghapus mahasiswa meskipun mengirim request DELETE secara manual.
6. Tombol hapus hanya dirender dengan Blade `@can('delete-mahasiswa')` untuk Admin.

### Challenge tambahan

- Pencarian multi-kolom nama / NRP / email menggunakan `when()`.
- Filter departemen dan status aktif/cuti menggunakan `when()`.
- Pagination menggunakan `withQueryString()` agar filter tetap terbawa.
- Seeder Faker membuat 40 mahasiswa, 12 dosen, dan 24 tugas (jumlah dapat bertambah bila seeder dijalankan ulang).
- Tombol auto-login Admin dan Staf tersedia pada halaman login saat `APP_ENV=local` saja.

## Instalasi

Pastikan PHP 8.3+, Composer, Node.js, dan npm sudah terpasang.

```bash
# 1. Install dependency PHP (composer.lock akan dibuat pada instalasi pertama)
composer install

# 2. Siapkan environment
cp .env.example .env
php artisan key:generate

# 3. Install dependency frontend AdminLTE dan publish asset
npm install
php artisan adminlte:install

# 4. Siapkan database SQLite
# Pastikan DB_CONNECTION=sqlite pada .env
# Buat file database/database.sqlite jika belum ada:
# Windows PowerShell: New-Item database/database.sqlite -ItemType File
# macOS/Linux: touch database/database.sqlite

# 5. Migrasi dan isi data contoh
php artisan migrate --seed

# 6. Build asset frontend
npm run build

# 7. Jalankan aplikasi
php artisan serve
```

Buka `http://127.0.0.1:8000` untuk website publik dan `http://127.0.0.1:8000/login` untuk login dashboard.

> Jika project menggunakan database MySQL, sesuaikan `DB_CONNECTION`, host, database, username, dan password pada `.env` sebelum menjalankan migrasi.

## Akun demo

| Role | Email | Password |
|---|---|---|
| Admin | `admin@its.ac.id` | `Admin123!` |
| Staf | `staf@its.ac.id` | `Staf123!` |

Tombol auto-login hanya muncul pada environment `local`. Akun demo dibuat oleh `RoleAndPermissionSeeder`.

## Matriks akses

| Fitur | Admin | Staf |
|---|:---:|:---:|
| Dashboard | ✓ | ✓ |
| Lihat data mahasiswa | ✓ | ✓ |
| Cari dan filter mahasiswa | ✓ | ✓ |
| Hapus data mahasiswa | ✓ | — |

Permission yang digunakan:

- `view-dashboard`
- `view-mahasiswa`
- `delete-mahasiswa`

## Route penting

| Method | URL | Keterangan |
|---|---|---|
| GET | `/` | Website publik (fitur Week 4 dipertahankan) |
| GET | `/login` | Form login |
| POST | `/login` | Proses login |
| POST | `/logout` | Logout |
| GET | `/admin/dashboard` | Dashboard Admin / Staf |
| GET | `/admin/mahasiswa` | Daftar, pencarian, dan filter mahasiswa |
| DELETE | `/admin/mahasiswa/{mahasiswa}` | Hapus mahasiswa (Admin saja) |

## Catatan struktur

- `app/Http/Controllers/Admin` berisi controller backoffice.
- `app/Models` berisi model `Mahasiswa`, `Dosen`, dan `Tugas` untuk data statistik.
- `database/seeders/RoleAndPermissionSeeder.php` membuat role, permission, dan akun demo.
- `database/seeders/AcademicDataSeeder.php` membuat data akademik dummy dengan Faker.
- `config/adminlte.php` mengatur menu AdminLTE; menu Hapus Data menggunakan Gate/permission filter.
- `bootstrap/app.php` mendaftarkan alias middleware Spatie untuk Laravel 13.

## Pengujian otomatis

Jalankan `php artisan test` untuk menguji bahwa Staf menerima HTTP 403 saat mencoba menghapus mahasiswa, sedangkan Admin dapat menghapusnya.

## Pengujian demo RBAC

1. Login sebagai Admin. Menu Hapus Data dan tombol Hapus akan terlihat.
2. Logout, lalu login sebagai Staf. Menu/tombol Hapus tidak akan terlihat.
3. Sebagai Staf, coba kirim request `DELETE /admin/mahasiswa/{id}` melalui Postman. Server harus mengembalikan HTTP 403.

## Keamanan repository

Jangan commit `.env`, `vendor/`, atau file database lokal yang berisi data pribadi. Gunakan `.env.example` sebagai template konfigurasi.
