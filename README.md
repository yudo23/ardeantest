<h2>Panduan Instalasi</h2>

1. Clone repositori terlebih dahulu menggunakan git clone <br>
2. Buka cmd dan arahkan ke repositori project yang sudah diclone <br>
3. Jalankan composer i
4. Jalankan cp .env.example .env untuk membuat file .env baru
5. Lakukan konfigurasi database pada .env dengan mengubah nama database menjadi ardeantest
6. Konfigurasi selesai
7. Jalankan php artisan serve

<h2>Resource Endpoint API Product</h2>
[GET] localhost:8000/api/v1/products <br>
[GET] localhost:8000/api/v1/products/{id} <br>
[POST] localhost:8000/api/v1/products <br>
[PUT] localhost:8000/api/v1/products/{id} <br>
[DELETE] localhost:8000/api/v1/products/{id} <br>