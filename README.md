# Skill Test WEB Developer

Project untuk menyelsaikan skill test web developer - Bisnis Indonesia

## Hasil
![image](https://github.com/gozali97/ticketing-app/assets/58220137/0999a89d-1f8f-4687-b71c-490f685520b0)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/21b4e89b-9071-4d42-b698-0cad3b2ae398)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/af37281e-368a-44fb-bfdd-f8b1ce6a8c94)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/8f827984-9a5e-4586-8aa9-bcef29172d41)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/e6a4e37a-34c4-42d4-9fe6-b3fce8c38c13)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/ecd22933-9bbd-4265-9734-fc500a6bc241)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/57578293-24df-4dac-bfe0-abdcb6774908)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/62601007-9517-4f44-8eba-195428276dd6)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/74284a9e-3dd0-47eb-9017-e2897c70a9bb)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/b96fdd54-3332-4d36-bd3d-39b9a57da636)
![image](https://github.com/gozali97/ticketing-app/assets/58220137/374a5fe7-15fd-4804-8917-9158a8768a69)


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
