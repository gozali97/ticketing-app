# Technical Test

Project untuk menyelsaikan technical test interview

## Url WEB
- localhost:8000/admin/login

## Fitur

-   Event
-   Ticket
-   Transaksi
-   Role
-   Permission

## User

- Super Admin
    - email : superadmin@dev.com
    - password: password
- Admin
  - email : admin@dev.com
  - password: password
- Kasir
    - email : kasir@dev.com
    - password: password

## Instalasi

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di mesin lokal Anda.

Pastikan Anda telah menginstal PHP, Composer, dan Node.js di mesin Anda sebelum melanjutkan.

### Langkah-langkah Instalasi

1. Clone repositori ini ke mesin lokal Anda:

`git clone https://github.com/gozali97/ticketing-app.git`

2. Pindah ke direktori proyek:

`cd ticketing-app`

3. Instal dependensi PHP dengan Composer:

`composer install`

4. Instal dependensi JavaScript dengan Node.js:

`npm install`
`php artisan migrate:fresh --seed`

5. Salin file .env.example ke .env:

6. Generate key aplikasi:

`php artisan key:generate`

7. Atur konfigurasi database di file .env sesuai dengan pengaturan mesin lokal Anda.

jangan lupa membuat database terlebih dahulu

8. Jalankan migrasi untuk membuat tabel database:

`php artisan migrate`

9. Jalankan server pengembangan lokal:

`php artisan serve`

dan

`npm run dev`

## API
Anda diwajibkan login terlebih dahulu unutk mendapatkan token agar bisa akses semua api yang ada, token menggunakan bearer token.
1. Login
   url = 127.0.0.1:8000/api/login
   paramater : 
            email: superadmin@dev.com
            password: password
2. Get Data Event
    url = 127.0.0.1:8000/api/events
    parameter :
        kategori = kategori
        provinsi = prov
        tanggal = 2024-09-01

3. Get Data Detail Event
   url = 127.0.0.1:8000/api/events/detail/2
