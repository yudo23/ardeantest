<h2>Panduan Instalasi</h2>

1. Clone repositori terlebih dahulu menggunakan git clone <br>
2. Buka cmd dan arahkan ke repositori project yang sudah diclone <br>
3. Jalankan composer i
4. Jalankan cp .env.example .env untuk membuat file .env baru
5. Lakukan konfigurasi database pada .env dengan mengubah nama database menjadi ardeantest
6. Konfigurasi selesai
7. Jalankan php artisan serve
8. Collection postman dapat diakses di https://www.postman.com/galactic-shuttle-49203/workspace/ardean-test/collection/12239810-1f92040f-4c2c-4003-a8c9-29ddce806556?action=share&creator=12239810<br>
9. Screenshot hasil bisa diakses di https://drive.google.com/drive/folders/1exADbyBtRo1CisSvJpgscUBcMp0bpj5-?usp=sharing<br>

<h2>Resource Endpoint API Product</h2>
[GET] localhost:8000/api/v1/products - Untuk mendapatkan data semua produk<br>
[GET] localhost:8000/api/v1/products/{id} - Untuk mendapatkan data detail produk<br>
[POST] localhost:8000/api/v1/products - Untuk menambakan produk<br>
[PUT] localhost:8000/api/v1/products/{id} - Untuk mendapatkan mengubah produk<br>
[DELETE] localhost:8000/api/v1/products/{id} - Untuk menghapus produk<br>

<h2>Penjelasan Tambahan</h2>
1. Project dibuat menggunakan service pattern untuk memisahkan logika antara controller dan model. Untuk file terdapat pada folder app/Services<br>
2. Validasi file dibuat secara terpisah . Untuk file terdapat pada folder app/Http/Requests<br>
3. Untuk menampilkan data json menggunakan helper . Untuk file terdapat pada folder app/Helpers