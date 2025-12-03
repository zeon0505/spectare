# 🎬 CinemaSpectare

Sistem Manajemen Bioskop Modern berbasis Laravel dengan Livewire

## 📖 Deskripsi Singkat

**CinemaSpectare** adalah aplikasi web terintegrasi untuk manajemen bioskop yang menyediakan sistem pemesanan tiket online, manajemen film, penjadwalan pertunjukan, dan pembelian snack. Aplikasi ini dibangun dengan teknologi modern menggunakan Laravel 12 dan Livewire 3, menawarkan pengalaman pengguna yang responsif dan interaktif.

Aplikasi ini dirancang untuk dua jenis pengguna:
- **Admin**: Mengelola film, jadwal tayang, studio, transaksi, pengguna, dan pengaturan sistem
- **User**: Memesan tiket, memilih kursi, membeli snack, dan mengelola profil booking

## ✨ Fitur Utama

### 🔐 Autentikasi & Otorisasi
- ✅ Registrasi dan login pengguna
- ✅ Sistem role-based (Admin & User)
- ✅ Lupa password dengan reset email
- ✅ Manajemen profil pengguna

### 👨‍💼 Panel Admin
- 📊 **Dashboard**: Statistik dan overview sistem
- 🎬 **Manajemen Film**: CRUD film dengan detail lengkap (genre, durasi, rating, poster, dll)
- 🏢 **Manajemen Studio**: Kelola studio bioskop dengan konfigurasi kursi
- 📅 **Penjadwalan Showtime**: Atur jadwal tayang film di berbagai studio
- 🍿 **Manajemen Snack**: Kelola produk makanan dan minuman
- 💳 **Transaksi**: Monitor dan kelola semua transaksi
- 📋 **Booking**: Lihat detail pemesanan tiket
- 👥 **Manajemen User**: Kelola pengguna dan blokir akun bermasalah
- ⚙️ **Site Settings**: Konfigurasi hero background, featured films

### 👤 Fitur Pengguna
- 🎭 **Katalog Film**: Browse film yang sedang/akan tayang dengan filter genre
- 🔍 **Pencarian Film**: Cari film berdasarkan judul
- 📺 **Jadwal Showtime**: Lihat jadwal tayang tersedia
- 🪑 **Pemilihan Kursi**: Sistem seat selection interaktif real-time
- 🍿 **Pembelian Snack**: Tambah snack ke booking
- 💰 **Pembayaran**: Integrasi payment gateway Midtrans
- 🎟️ **E-Ticket**: Generate QR code untuk tiket
- 📱 **Riwayat Booking**: Lihat semua booking yang pernah dilakukan
- ❤️ **Wishlist**: Simpan film favorit

### 🔔 Fitur Tambahan
- 📧 **Notifikasi Email**: Konfirmasi booking dan reset password
- 🎨 **UI/UX Modern**: Desain responsif dengan Tailwind CSS 4
- 🔔 **Real-time Alerts**: Notifikasi interaktif dengan Livewire Alert
- 📊 **Charts & Analytics**: Visualisasi data dengan ApexCharts
- 🔒 **Keamanan**: Laravel Sanctum untuk API authentication

## 🛠️ Teknologi yang Digunakan

### Backend
- **[Laravel 12](https://laravel.com)** - PHP Framework terkini
- **[Livewire 3.6](https://livewire.laravel.com)** - Full-stack framework untuk Laravel
- **[Laravel Sanctum](https://laravel.com/docs/sanctum)** - API authentication
- **PHP 8.2+** - Bahasa pemrograman

### Frontend
- **[Tailwind CSS 4](https://tailwindcss.com)** - Utility-first CSS framework
- **[Vite 7](https://vitejs.dev)** - Build tool modern
- **[Alpine.js](https://alpinejs.dev)** (via Livewire) - JavaScript framework minimal
- **[ApexCharts](https://apexcharts.com)** - Library charting interaktif

### Payment Gateway
- **[Midtrans](https://midtrans.com)** - Payment gateway Indonesia

### Additional Libraries
- **[Livewire Alert](https://github.com/jantinnerezo/livewire-alert)** - SweetAlert2 untuk Livewire
- **[Simple QR Code](https://github.com/SimpleSoftwareIO/simple-qrcode)** - Generator QR code untuk e-ticket

### Database
- **SQLite** (Default untuk development)
- Support MySQL, PostgreSQL, SQL Server

### Development Tools
- **[Laravel Pint](https://laravel.com/docs/pint)** - Code style fixer
- **[Pest PHP](https://pestphp.com)** - Testing framework
- **[Laravel Pail](https://laravel.com/docs/pail)** - Log viewer

## 📋 Prasyarat

Sebelum menginstal aplikasi, pastikan sistem Anda memiliki:

- **PHP >= 8.2** dengan ekstensi:
  - Ctype
  - cURL
  - DOM
  - Fileinfo
  - Filter
  - Hash
  - Mbstring
  - OpenSSL
  - PCRE
  - PDO
  - Session
  - Tokenizer
  - XML
- **Composer** (Dependency Manager untuk PHP)
- **Node.js >= 18** dan **npm** (Untuk asset compilation)
- **SQLite** atau database lain (MySQL, PostgreSQL)

## 🚀 Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/zeon0505/spectare.git
cd cinemaspectare
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Konfigurasi Environment

```bash
# Salin file .env.example menjadi .env
copy .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi:

```env
APP_NAME="CinemaSpectare"
APP_URL=http://localhost:8000

# Database (Default SQLite)
DB_CONNECTION=sqlite

# Untuk MySQL/PostgreSQL, uncomment dan sesuaikan:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=cinemaspectare
# DB_USERNAME=root
# DB_PASSWORD=

# Midtrans Configuration
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false

# Email Configuration (Opsional untuk forgot password)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Buat Database SQLite (jika menggunakan SQLite)

```bash
# Buat folder database jika belum ada
mkdir database

# Buat file database.sqlite
type nul > database\database.sqlite
```

### 7. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 8. Seed Data Awal (Opsional)

```bash
php artisan db:seed
```

### 9. Buat Storage Link

```bash
php artisan storage:link
```

### 10. Build Assets

```bash
npm run build
```

## ▶️ Cara Menjalankan Project

### Development Mode (Recommended)

Jalankan semua service sekaligus (server, queue, logs, vite):

```bash
composer run dev
```

Command ini akan menjalankan:
- 🌐 Laravel development server (http://localhost:8000)
- 📬 Queue worker untuk background jobs
- 📝 Log viewer (Pail)
- ⚡ Vite development server untuk hot reload

### Atau Jalankan Manual Satu Per Satu

#### 1. Jalankan Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

#### 2. Jalankan Vite Dev Server (untuk hot reload CSS/JS)

Di terminal baru:

```bash
npm run dev
```

#### 3. Jalankan Queue Worker (untuk background jobs)

Di terminal baru:

```bash
php artisan queue:work
```

#### 4. Monitor Logs (Opsional)

Di terminal baru:

```bash
php artisan pail
```

### Production Mode

```bash
# Build production assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan dengan web server (Apache/Nginx)
```

## 👥 Akun Default

Setelah seeding, Anda dapat login dengan:

**Admin:**
- Email: admin@example.com
- Password: password

**User:**
- Email: user@example.com
- Password: password

## 📁 Struktur Project

```
cinemaspectare/
├── app/
│   ├── Livewire/           # Livewire components
│   │   ├── Admin/          # Admin components
│   │   ├── User/           # User components
│   │   └── Auth/           # Authentication components
│   ├── Models/             # Eloquent models
│   ├── Services/           # Business logic (PaymentService, dll)
│   └── Http/
│       └── Middleware/     # Custom middleware (RoleMiddleware)
├── database/
│   ├── migrations/         # Database migrations
│   ├── seeders/            # Database seeders
│   └── factories/          # Model factories
├── resources/
│   ├── views/
│   │   ├── livewire/       # Livewire blade templates
│   │   └── components/     # Reusable blade components
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
├── public/                 # Public assets
└── storage/                # Uploaded files, logs, cache
```

## 🧪 Testing

Jalankan automated tests:

```bash
composer test
```

Atau:

```bash
php artisan test
```

## 🔧 Troubleshooting

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: Vite manifest not found
```bash
npm run build
```

### Permission denied pada Windows
Jalankan terminal sebagai Administrator

### Queue jobs tidak berjalan
Pastikan queue worker aktif:
```bash
php artisan queue:work
```

## 📝 Catatan Pengembangan

- Database menggunakan **SQLite** secara default untuk kemudahan development
- Payment menggunakan **Midtrans Sandbox** mode untuk testing
- Untuk production, ubah konfigurasi database dan payment di `.env`
- Pastikan `queue:work` selalu berjalan untuk proses payment callback

## 📄 Lisensi

Aplikasi ini dibangun dengan [Laravel](https://laravel.com) yang merupakan open-source software berlisensi [MIT](https://opensource.org/licenses/MIT).

## 👤 Author

**Zeon0505**
- GitHub: [@zeon0505](https://github.com/zeon0505)
- Repository: [spectare](https://github.com/zeon0505/spectare)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Livewire](https://livewire.laravel.com) - Full-stack framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Midtrans](https://midtrans.com) - Payment Gateway
- All open-source contributors

---

**Dibuat dengan menggunakan Laravel & Livewire**
