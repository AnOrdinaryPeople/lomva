# lomva
1. [xampp PHP >= 7.2.3](https://www.apachefriends.org/download.html)
1. [git](https://git-scm.com/downloads)
1. [composer](https://getcomposer.org/download/)
1. [node.js](https://nodejs.org/en/download/current/)
1. Size 250 - 350 MB

# install
1. buka htdocs
1. klik kanan, pilih `git bash here`
1. ketik `https://github.com/AnOrdinaryPeople/lomva.git`
1. setelah beres donlot ketik `cd lomva`
1. ketik lagi `cp .env.example .env`
1. bikin database baru namanya bebas contoh `bebas`
1. di `.env` pastikan `DB_DATABASE` nya sesuai sama step yg di atas. contoh `DB_DATABASE=bebas`
1. di `git bash` ketik `composer install`
1. klo udh beres instal ketik lagi `npm install`
1. klo udh beres instal ketik lagi `php artisan key:generate`
1. ketik lagi `php artisan jwt:secret`
1. ketik lagi `php artisan migrate --seed`
1. ketik lagi `php artisan serve` jgn ditutup git bashnya
1. buka browser lalu ketik `localhost:8000` atau `127.0.0.1:8000`

### email + password
liat di `database/seeds/UserTableSeeder.php`

### recaptcha
Ambil site key sama secret key di [recaptcha](https://www.google.com/recaptcha) simpen di `.env` buat site key `RECAPTCHA_SITE_KEY=kode_site_key`. buat secret key `RECAPTCHA_SECRET=kode_secret_key`

### Google API sama Facebook API
Ambil client id sama secret key di [Google developer console](https://console.developers.google.com) sama [Facebook developer](https://developers.facebook.com)

- untuk Google simpen client id sama secret key di `.env` bagian `GOOGLE_CLIENT_ID=` dan `GOOGLE_CLIENT_SECRET=`
- untuk Facebook simpen client id sama secret key di `.env` bagian `FACEBOOK_CLIENT_ID=` dan `FACEBOOK_CLIENT_SECRET=`
