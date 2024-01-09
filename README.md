## **Petunjuk Pengunaan**
Proyek ini menggunakan framework [Laravel 9](https://laravel.com/docs/9.x/deployment#server-requirements) yang siap digunakan untuk keperluan tes keahlian web developer

### **Software pendukung yang perlu disiapkan sebelum memulai**

- PHP minimal versi 8.0.2 atau versi terbaru
- Composer
- NodeJS minimal versi 16 atau versi terbaru
- Git minimal versi 2 atau versi terbaru (Optional)

#
## **Github Repository**

### **Clone Repository atau Download ZIP**

- Clone via Git Bash (Windows) atau Terminal (Linux)
  ```
  git clone https://github.com/eskalink-id/keluhanpelanggan-testdev.git
  ```
  Setelah selesai clone, pada Command line arahkan ke folder **keluhanpelanggan-testdev**, seperti perintah berikut:
  ```
  cd keluhanpelanggan-testdev
  ```
- atau **Download ZIP** jika anda tidak memiliki git di lokal komputer anda, untuk mendownload klik tombol Download ZIP seperti pada gambar berikut:

  ![image](https://user-images.githubusercontent.com/116535942/199644260-9be931e5-7f71-482c-8b52-7a5f918bd8b0.png)

  setelah download selesai, extract zip ke folder yang anda inginkan

- Kemudian lakukan instalasi laravel dan npm, seperti **Panduan Instalasi** dibawah ini


----


### **Panduan Instalasi**

- Buka Command Line arahkan ke folder ***keluhanpelanggan-testdev***
- kemudian jalankan perintah:
  ```
  composer install
  ```
- selanjutnya, jalankan perintah:
  ```
  php -r "copy('.env.example', '.env');";
  ```
- selanjutnya, jalankan perintah:
  ```
  php artisan key:generate
  ```
- selanjutnya, buat database dengan nama ***keluhan_pelanggan***
- selanjutnya, sesuaikan parameter pada file **.env**, seperti berikut:
  ```
  APP_URL=http://localhost:8000

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=keluhan_pelanggan
  DB_USERNAME=root
  DB_PASSWORD=
  ```
- selanjutnya, jalankan perintah:
  ```
  php artisan migrate
  ```
- selanjutnya, jalankan perintah berikut untuk compiled assets (development):
  ```
  - npm install
  - npm run dev
  ```
- selanjutnya, buka command line yang baru, jalankan perintah:
  ```
  php artisan serve
  ```

- selanjutnya, buka browser dengan url [http://localhost:8000](http://localhost:8000)
- selanjutnya, klik link **Register** dan lengkapi isian pada form register
- Selamat melanjutkan Tes, dengan membaca ketentuan pada **Soal Tes Keahlian**

----

## **Soal Tes Keahlian**

1. Buat Model, migration, dan seeder sebanyak 50 record untuk struktur table sebagai berikut:
   ```
   Nama Tabel: keluhan_pelanggan
   Struktur Tabel:
   -------------------------------------------------------------------------------------------------
   | Column Name    | Type Data | Length | Note                                                    |
   -------------------------------------------------------------------------------------------------
   | id             | bigint    |        | not null, primary key, autoincrement                    |
   | nama           | varchar   | 50     | not null, min length 3                                  |
   | email          | varchar   | 100    | not null                                                |
   | nomor_hp       | varchar   | 15     | null, numeric only                                      |
   | status_keluhan | varchar   | 1      | not null default 'O' [0:Received, 1:In Process, 2: Done]|
   | keluhan        | varchar   | 255    | not null, min length 50                                 |
   | created_at     | datetime  |        | not null                                                |
   -------------------------------------------------------------------------------------------------

   Nama Table: keluhan_status_his
   Struktur Table:
   -------------------------------------------------------------------------------------------------
   | Column Name    | Type Data | Length | Note                                                    |
   -------------------------------------------------------------------------------------------------
   | id             | bigint    |        | not null, primary key, autoincrement                    |
   | keluhan_id     | bigint    |        | not null, foreign key to keluhan_pelanggan.id           |
   | status_keluhan | varchar   | 1      | not null  [0:Received, 1:In Process, 2: Done]           |
   | updated_at     | datetime  |        | not null                                                |
   -------------------------------------------------------------------------------------------------
   ```

2. Pada halaman Keluhan Pelanggan buat fungsi create, read, update, delete (CRUD), dan history data keluhan, menggunakan axios atau ajax.
   Pada fungsi History data keluhan, munculkan informasi timeline data keluhan dari sejak data di create s.d status terakhir secara kronologis.
   
3. Buat Controller dengan nama KeluhanPelangganController untuk proses CRUD.
   Setiap keluhan baru & perubahan status atas keluhan tsb, history data tersimpan di table keluhan_status_his.

4. Ketika melakukan create dan update data berikan validasi sesuai dengan atribute table, contoh:
    - field nama, jika diisi lebih dari 50 digit, maka tampilkan error message: text too long, maximum 50 characters.
    - field nomor_hp, jika diisi dengan huruf/spasi/karakter khusus, maka tampilkan error: input numeric only.
    - dst.
    
5. Buat fungsi export file untuk mengenerate data dari table keluhan_pelanggan agar bisa di download kedalam format file:
    - .txt (library maatwebsite/excel)
    - .csv (library maatwebsite/excel)
    - .xls (library maatwebsite/excel)
    - .pdf (library dompdf/dompdf atau maatwebsite/excel)

6. Buat 1 halaman menu dashboard yang menyajikan summary data keluhan pelanggan yang sudah diinput dengan ketentuan:
    - pie chart berisi persentase total data keluhan pelanggan by status (Received, In Process, Done) di table keluhan_pelanggan
    - column/bar chart berisi jumlah keluhan berdasarkan status keluhan selama 6 bulan terakhir dari table keluhan_status_his.
    - table view berisi data top 10 keluhan dengan umur keluhan paling lama (umur keluhan dihitung dari pertama kali data di create s.d current date)
    - Referensi dashboard: https://1drv.ms/x/s!AsNatlBKVuH5rACl8DLrzW_QmmJ_?e=YrV3gx&nav=MTVfe0VBNDg4NDZGLTRBMUQtN0Q0NS04OERDLTMwOEM1MjUzMDNBRX0

7. Buat RestAPI fungsi crud untuk melakukan:
    - update status by id keluhan
    - delete status by id keluhan

8. Buat unit test untuk salah satu fungsi crud.
   
**Selamat mengerjakan, semoga sukses**
