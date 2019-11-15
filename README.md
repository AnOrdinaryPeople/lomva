# aplikasi yg digunakan
1. [xampp PHP >= 7.2.3](https://www.apachefriends.org/download.html)
1. [git](https://git-scm.com/downloads)
1. [composer](https://getcomposer.org/download/)
1. [node.js](https://nodejs.org/en/download/current/)
1. Size 250 - 350 MB

# cara install
### cara panjang
1. buka htdocs
1. klik kanan, pilih `git bash here`
1. ketik `git clone https://github.com/AnOrdinaryPeople/lomva.git`
1. setelah beres donlot ketik `cd lomva`
1. ketik lagi `cp .env.example .env`
1. bikin database baru namanya bebas contoh `bebas`
1. di `.env` pastikan `DB_DATABASE`,`DB_USERNAME`,`DB_PASSWORD` sudah disesuaikan. contoh
   ```
   DB_DATABASE=bebas
   DB_USERNAME=myUsername
   DB_PASSWORD="1234 5678"
   ```
1. ketik lagi `composer install`
1. klo udh beres instal ketik lagi `npm install`
1. ketik lagi `php artisan jwt:secret`
1. ketik lagi `php artisan migrate`
1. ketik lagi `php artisan db:seed`
1. ketik lagi `php artisan key:generate`
1. ketik lagi `php artisan serve` jgn ditutup git bashnya
1. buka browser lalu ketik `localhost:8000` atau `127.0.0.1:8000`
### cara singkat
1. clone repo ini
1. ketik `cp .env.example .env`
1. instal composer dan node.js
1. sesuaikan `DB_DATABASE`,`DB_USERNAME`,`DB_PASSWORD` yg ada di `.env`
1. ketik:
   ```
   php artisan jwt:secret
   php artisan migrate --seed
   php artisan key:generate
   ```
1. masukkan credential recaptcha, google, dan facebook API ke `.env`
1. jalankan server

### email + password
liat di `database/seeds/UserTableSeeder.php`

## recaptcha
Ambil site key sama secret key di [recaptcha](https://www.google.com/recaptcha) simpen di `.env` buat site key `RECAPTCHA_SITE_KEY=kode_site_key`. buat secret key `RECAPTCHA_SECRET=kode_secret_key`

## Google dan Facebook API
Ambil client id sama secret key di [Google developer console](https://console.developers.google.com) sama [Facebook developer](https://developers.facebook.com)

- untuk Google simpen client id sama secret key di `.env` bagian `GOOGLE_CLIENT_ID=` dan `GOOGLE_CLIENT_SECRET=`
- untuk Facebook simpen client id sama secret key di `.env` bagian `FACEBOOK_CLIENT_ID=` dan `FACEBOOK_CLIENT_SECRET=`
