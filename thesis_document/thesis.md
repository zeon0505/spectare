# SISTEM MANAJEMEN BIOSKOP BERBASIS WEB MENGGUNAKAN LARAVEL DAN LIVEWIRE

## ABSTRAK

Sistem Manajemen Bioskop ini dikembangkan untuk memudahkan pengelolaan bioskop secara digital. Sistem ini dibangun menggunakan framework Laravel dan Livewire untuk menciptakan pengalaman pengguna yang interaktif dan responsif. Fitur utama meliputi manajemen film, pemesanan tiket online, sistem pembayaran terintegrasi, manajemen studio, dan laporan transaksi. 

Kata Kunci: Sistem Manajemen Bioskop, Laravel, Livewire, E-Ticketing, Sistem Pembayaran Online

## DAFTAR ISI

## BAB 1 PENDAHULUAN

### 1.1 Latar Belakang

Perkembangan teknologi informasi yang pesat telah merubah berbagai aspek kehidupan, termasuk dalam bidang bisnis hiburan seperti bioskop. Kebutuhan akan sistem manajemen bioskop yang terkomputerisasi menjadi semakin penting untuk meningkatkan efisiensi operasional dan kualitas pelayanan kepada pelanggan.

### 1.2 Rumusan Masalah
1. Bagaimana membangun sistem manajemen bioskop yang terintegrasi?
2. Bagaimana mengimplementasikan sistem pemesanan tiket online yang efisien?
3. Bagaimana mengelola jadwal tayang film dan ketersediaan kursi secara real-time?

### 1.3 Tujuan Penelitian
1. Mengembangkan sistem manajemen bioskop berbasis web yang terintegrasi
2. Menerapkan sistem pemesanan tiket online dengan pemilihan kursi
3. Membangun sistem manajemen konten film dan jadwal tayang
4. Mengintegrasikan sistem pembayaran elektronik

### 1.4 Manfaat Penelitian
1. Bagi Manajemen: Meningkatkan efisiensi operasional bioskop
2. Bagi Pelanggan: Kemudahan dalam memesan tiket secara online
3. Bagi Pengembang: Pengalaman dalam mengembangkan sistem enterprise

## BAB 2 TINJAUAN PUSTAKA

### 2.1 Landasan Teori

#### 2.1.1 Sistem Informasi Manajemen
Sistem Informasi Manajemen (SIM) adalah sistem perencanaan yang menjadi bagian dari pengendalian internal suatu bisnis yang meliputi pemanfaatan manusia, dokumen, teknologi, dan prosedur untuk memecahkan masalah bisnis. Menurut O'Brien dan Marakas (2011), SIM adalah kombinasi terorganisir dari perangkat keras, perangkat lunak, jaringan komunikasi, data, dan orang-orang yang mengumpulkan, mengubah, dan menyebarkan informasi dalam suatu organisasi.

**Komponen Utama SIM:**
1. **Perangkat Keras (Hardware)**
   - Server dan komputer
   - Perangkat jaringan
   - Perangkat penyimpanan data
   - Perangkat input/output

2. **Perangkat Lunak (Software)**
   - Sistem operasi
   - Aplikasi manajemen database
   - Aplikasi web server
   - Perangkat lunak khusus (custom software)

3. **Data**
   - Data mentah yang diolah
   - Basis data terstruktur
   - Metadata

4. **Sumber Daya Manusia**
   - Pengguna akhir
   - Staf TI
   - Manajemen

5. **Prosedur**
   - Kebijakan operasional
   - Standar pengolahan data
   - Panduan penggunaan sistem

**Diagram 2.1: Arsitektur Sistem Informasi**
```
+-------------------+     +-------------------+     +-------------------+
|   Perangkat Keras |<--->|  Perangkat Lunak  |<--->|       Data        |
+-------------------+     +-------------------+     +-------------------+
          ^                       ^                        ^
          |                       |                        |
          v                       v                        v
+-------------------+     +-------------------+     +-------------------+
| Sumber Daya Manusia |<->|     Prosedur      |<->|  Jaringan Komputer |
+-------------------+     +-------------------+     +-------------------+
```

#### 2.1.2 Konsep Sistem Terdistribusi
Sistem terdistribusi adalah kumpulan komputer independen yang muncul sebagai sistem yang terintegrasi kepada pengguna akhir. Dalam konteks sistem manajemen bioskop, ini melibatkan:

- **Client-Server Architecture**
  - Server pusat untuk manajemen data
  - Klien untuk akses pengguna
  - Komunikasi melalui protokol HTTP/HTTPS

- **Microservices**
  - Layanan terpisah untuk setiap fitur (pemesanan, pembayaran, dll.)
  - Skalabilitas yang lebih baik
  - Pengembangan yang lebih cepat

**Diagram 2.2: Arsitektur Sistem Terdistribusi**
```
+------------------+     +------------------+     +------------------+
|   Web Browser    |     |  Mobile Devices  |     |  Admin Console   |
+--------+---------+     +--------+---------+     +---------+--------+
         |                        |                         |
         |                        |                         |
         v                        v                         v
+------------------------------------------------------------------------+
|                          Load Balancer                                 |
+------------------------------------------------------------------------+
         |                        |                         |
         |                        |                         |
+--------v---------+    +---------v--------+    +----------v----------+
|  Web Servers     |    |  API Gateway     |    |   Cache Layer       |
|  (Nginx/Apache)  |    |  (Laravel)       |    |   (Redis/Memcached) |
+--------+---------+    +---------+--------+    +----------+----------+
         |                        |                         |
         |                        |                         |
+--------v------------------------v-------------------------v----------+
|                                                                     |
|                        Application Servers                          |
|                  (Laravel + Livewire Components)                    |
|                                                                     |
+------------------------------------------------------------------------+
         |                        |                         |
         |                        |                         |
+--------v---------+    +---------v--------+    +----------v----------+
|  Database        |    |  File Storage    |    |   External Services  |
|  (MySQL)         |    |  (S3/Local)      |    |   (Payment Gateway)  |
+------------------+    +------------------+    +---------------------+
```

#### 2.1.3 Framework Laravel
Laravel adalah framework PHP open-source yang mengikuti arsitektur MVC (Model-View-Controller). Berikut penjelasan mendalam tentang komponen-komponen utamanya:

1. **Eloquent ORM (Object-Relational Mapping)**
   - Mewakili tabel database sebagai objek PHP
   - Mendukung relasi antar model
   - Contoh implementasi:
   ```php
   // Mendefinisikan model Film
   class Film extends Model
   {
       protected $fillable = ['title', 'description', 'duration'];
       
       // Relasi one-to-many dengan Showtime
       public function showtimes()
       {
           return $this->hasMany(Showtime::class);
       }
   }
   ```

2. **Blade Templating Engine**
   - Sintaks yang ringkas dan mudah dibaca
   - Template inheritance
   - Contoh penggunaan:
   ```blade
   @extends('layouts.app')
   
   @section('content')
       <div class="container">
           <h1>{{ $film->title }}</h1>
           <p>{{ $film->description }}</p>
           
           @if($film->showtimes->count() > 0)
               <h3>Jadwal Tayang:</h3>
               <ul>
                   @foreach($film->showtimes as $showtime)
                       <li>{{ $showtime->start_time->format('d M Y H:i') }}</li>
                   @endforeach
               </ul>
           @endif
       </div>
   @endsection
   ```

3. **Artisan CLI**
   - Alat baris perintah bawaan Laravel
   - Contoh perintah umum:
   ```bash
   # Membuat model beserta migration dan controller
   php artisan make:model Film -mcr
   
   # Menjalankan migrasi
   php artisan migrate
   
   # Menjalankan server pengembangan
   php artisan serve
   
   # Membuat komponen Livewire
   php artisan make:livewire Films/Index
   ```

4. **Database Migration**
   - Version control untuk skema database
   - Contoh migrasi untuk tabel films:
   ```php
   public function up()
   {
       Schema::create('films', function (Blueprint $table) {
           $table->id();
           $table->string('title');
           $table->text('description');
           $table->string('genre');
           $table->integer('duration'); // dalam menit
           $table->string('director');
           $table->string('cast');
           $table->string('poster_url')->nullable();
           $table->string('trailer_url')->nullable();
           $table->date('release_date');
           $table->timestamps();
       });
   }
   ```

5. **Authentication & Authorization**
   - Sistem otentikasi bawaan
   - Middleware untuk otorisasi
   - Contoh implementasi:
   ```php
   // Middleware di route
   Route::middleware(['auth'])->group(function () {
       Route::get('/dashboard', 'DashboardController@index');
       
       // Hanya admin yang bisa mengakses rute di dalamnya
       Route::middleware(['admin'])->group(function () {
           Route::resource('films', 'FilmController');
           Route::resource('showtimes', 'ShowtimeController');
       });
   });
   ```

#### 2.1.4 Livewire
Livewire adalah framework full-stack Laravel yang memungkinkan pembuatan antarmuka pengguna yang dinamis dan interaktif tanpa perlu menulis JavaScript secara langsung.

**Keunggulan Livewire:**
1. **Full-Stack Framework**
   - Menggunakan PHP murni
   - Tidak perlu API endpoints terpisah
   - Integrasi penuh dengan Laravel

2. **Reaktivitas**
   - Perubahan state otomatis memperbarui UI
   - Tidak perlu menulis JavaScript untuk interaksi sederhana
   - Contoh implementasi:
   ```php
   namespace App\Http\Livewire;
   
   use Livewire\Component;
   use App\Models\Film;
   
   class FilmSearch extends Component
   {
       public $search = '';
       public $perPage = 10;
       
       public function render()
       {
           return view('livewire.film-search', [
               'films' => Film::where('title', 'like', '%'.$this->search.'%')
                             ->orderBy('release_date', 'desc')
                             ->paginate($this->perPage)
           ]);
       }
   }
   ```
   ```blade
   <div>
       <input type="text" wire:model.debounce.300ms="search" placeholder="Cari film...">
       
       <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
           @foreach($films as $film)
               <div class="border rounded-lg overflow-hidden shadow">
                   <img src="{{ $film->poster_url }}" alt="{{ $film->title }}" class="w-full h-64 object-cover">
                   <div class="p-4">
                       <h3 class="font-bold text-lg">{{ $film->title }}</h3>
                       <p class="text-gray-600">{{ $film->genre }}</p>
                       <p class="mt-2">{{ Str::limit($film->description, 100) }}</p>
                       <button wire:click="$emit('filmSelected', {{ $film->id }})" 
                               class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                           Pilih Film
                       </button>
                   </div>
               </div>
           @endforeach
       </div>
       
       <div class="mt-4">
           {{ $films->links() }}
       </div>
   </div>
   ```

3. **Siklus Hidup Komponen**
   - `mount()`: Inisialisasi komponen
   - `render()`: Menampilkan tampilan
   - `updated()`: Dipanggil saat properti diupdate
   - `hydrate()`: Dipanggil sebelum pembaruan
   - `dehydrate()`: Dipanggil setelah pembaruan

**Diagram 2.3: Arsitektur Livewire**
```
+---------------------+     +---------------------+     +---------------------+
|   Browser (Frontend)|     |  Livewire Server   |     |   Laravel Backend   |
+----------+----------+     +----------+----------+     +----------+----------+
           |                           |                           |
           | 1. Request Halaman Awal   |                           |
           |-------------------------->|                           |
           |                           | 2. Render Komponen        |
           |                           |--------------------------->|
           |                           |                           |
           | 3. Respon HTML + JS       |                           |
           |<--------------------------|                           |
           |                           |                           |
           | 4. Interaksi Pengguna     |                           |
           |-------------------------->|                           |
           |                           | 5. Proses Aksi            |
           |                           |--------------------------->|
           |                           |                           |
           | 6. Update DOM             |                           |
           |<--------------------------|                           |
           |                           |                           |
+----------v----------+     +----------v----------+     +----------v----------+
|  JavaScript         |     |  PHP                |     |  Database           |
|  - Handle Events    |     |  - Proses Logika    |     |  - MySQL/PostgreSQL |
|  - Update DOM       |     |  - Query Database   |     |  - Eloquent ORM     |
+---------------------+     +---------------------+     +---------------------+
```

4. **Fitur Lanjutan**
   - **Lazy Loading**: Menunda pemuatan komponen
   - **Pagination**: Dukungan bawaan untuk paginasi
   - **File Uploads**: Unggah file dengan mudah
   - **Real-time Validation**: Validasi form real-time
   - **Events**: Komunikasi antar komponen

#### 2.1.5 Arsitektur Sistem Manajemen Bioskop

**Diagram 2.4: Arsitektur Sistem Manajemen Bioskop**
```
+-----------------------------------------------------------------------------+
|                          LAYER PRESENTASI (UI/UX)                           |
+-----------------------------------------------------------------------------+
|  +------------------+  +------------------+  +------------------+          |
|  |   Halaman Admin  |  |  Halaman User    |  |  Halaman Publik  |          |
|  |  - Dashboard     |  |  - Booking Tiket |  |  - Daftar Film   |          |
|  |  - Manajemen Film|  |  - Riwayat       |  |  - Jadwal Tayang |          |
|  |  - Laporan       |  |  - Profil        |  |  - Harga Tiket   |          |
|  +------------------+  +------------------+  +------------------+          |
+-------------------------------------+---------------------------------------+
                                      |
+-------------------------------------v---------------------------------------+
|                         LAYER APLIKASI (LOGIKA BISNIS)                     |
+-----------------------------------------------------------------------------+
|  +------------------+  +------------------+  +------------------+          |
|  |  Manajemen Film  |  |  Pemesanan Tiket |  |  Manajemen User  |          |
|  |  - CRUD Film     |  |  - Pilih Kursi   |  |  - Autentikasi   |          |
|  |  - Jadwal Tayang |  |  - Proses Bayar  |  |  - Otorisasi     |          |
|  |  - Upload Poster |  |  - Cetak Tiket   |  |  - Manajemen Role|          |
|  +------------------+  +------------------+  +------------------+          |
+-------------------------------------+---------------------------------------+
                                      |
+-------------------------------------v---------------------------------------+
|                            LAYER PERSISTENSI                               |
+-----------------------------------------------------------------------------+
|  +------------------+  +------------------+  +------------------+          |
|  |  Model Film      |  |  Model Booking   |  |  Model User      |          |
|  |  - Atribut       |  |  - Atribut       |  |  - Atribut       |          |
|  |  - Relasi        |  |  - Relasi        |  |  - Relasi        |          |
|  |  - Query Scope   |  |  - Status        |  |  - Enkripsi      |          |
|  +------------------+  +------------------+  +------------------+          |
+-------------------------------------+---------------------------------------+
                                      |
+-------------------------------------v---------------------------------------+
|                               LAYER PENYIMPANAN                            |
+-----------------------------------------------------------------------------+
|  +------------------+  +------------------+  +------------------+          |
|  |  Database        |  |  Penyimpanan File|  |  Cache           |          |
|  |  - MySQL         |  |  - Gambar Film   |  |  - Redis         |          |
|  |  - Tabel & Relasi|  |  - Dokumen       |  |  - File-based    |          |
|  |  - Stored Proc   |  |  - Backup        |  |  - In-memory     |          |
|  +------------------+  +------------------+  +------------------+          |
+-----------------------------------------------------------------------------+
```

#### 2.1.6 Keamanan Aplikasi Web

1. **Cross-Site Scripting (XSS)**
   - Pencegahan dengan escape output
   - Penggunaan {{ }} di Blade
   - Contoh kerentanan:
   ```blade
   <!-- Tidak Aman -->
   <div>{!! $user_input !!}</div>
   
   <!-- Aman -->
   <div>{{ $user_input }}</div>
   ```

2. **SQL Injection**
   - Pencegahan dengan parameter binding
   - Contoh kerentanan:
   ```php
   // Tidak Aman
   $users = DB::select("SELECT * FROM users WHERE email = '" . $email . "'");
   
   // Aman
   $users = DB::select("SELECT * FROM users WHERE email = ?", [$email]);
   
   // Lebih Aman (menggunakan Eloquent)
   $users = User::where('email', $email)->get();
   ```

3. **Cross-Site Request Forgery (CSRF)**
   - Token CSRF otomatis di Laravel
   - Penggunaan @csrf di form
   - Middleware VerifyCsrfToken

4. **Authentication & Authorization**
   - Validasi input
   - Hashing password
   - Proteksi brute force
   - Otorisasi berbasis peran (RBAC)

#### 2.1.7 Integrasi Pembayaran Digital

1. **Konsep Dasar**
   - Payment gateway
   - Proses otorisasi
   - Settlement
   - Rekonsiliasi

2. **Alur Pembayaran**
   ```
   +----------+     +----------+     +----------+     +------------------+
   |  User    |     |  Aplikasi|     |  Payment |     |  Bank/Payment    |
   |  (Klien) |     |  Server  |     |  Gateway |     |  Provider        |
   +----+-----+     +----+-----+     +----+-----+     +---------+--------+
        |                 |                |                     |
        | 1. Pilih Pembayaran             |                     |
        |---------------->|                |                     |
        |                 | 2. Request Token Pembayaran         |
        |                 |------------------------------------>|
        |                 |                |                     |
        | 3. Redirect ke Halaman Pembayaran|                     |
        |<----------------+                |                     |
        |                 |                |                     |
        | 4. Input Detail Pembayaran       |                     |
        |--------------------------------->|                     |
        |                 |                | 5. Proses Pembayaran|
        |                 |                |-------------------->|
        |                 |                |                     |
        | 6. Hasil Pembayaran              |                     |
        |<---------------------------------|                     |
        |                 |                |                     |
        | 7. Redirect ke Halaman Konfirmasi|                     |
        |---------------->|                |                     |
        |                 | 8. Verifikasi Pembayaran             |
        |                 |------------------------------------>|
        |                 |                |                     |
        | 9. Tampilkan Status Pembayaran   |                     |
        |<----------------+                |                     |
   ```

3. **Implementasi dengan Midtrans**
   ```php
   // Konfigurasi
   \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
   \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
   \Midtrans\Config::$isSanitized = true;
   \Midtrans\Config::$is3ds = true;
   
   // Membuat transaksi
   $params = [
       'transaction_details' => [
           'order_id' => $booking->code,
           'gross_amount' => $booking->total_price,
       ],
       'customer_details' => [
           'first_name' => $user->name,
           'email' => $user->email,
           'phone' => $user->phone,
       ],
       'item_details' => [
           [
               'id' => $booking->id,
               'price' => $booking->total_price,
               'quantity' => 1,
               'name' => 'Pembayaran Tiket ' . $booking->film->title,
           ]
       ]
   ];
   
   $snapToken = \Midtrans\Snap::getSnapToken($params);
   ```

#### 2.1.8 Pengujian Perangkat Lunak

1. **Jenis Pengujian**
   - **Unit Testing**: Menguji komponen individual
   - **Feature Testing**: Menguji fitur lengkap
   - **Browser Testing**: Menguji interaksi pengguna

2. **Contoh Pengujian dengan PHPUnit**
   ```php
   // Contoh Unit Test
   public function test_film_creation()
   {
       $film = Film::factory()->create([
           'title' => 'Inception',
           'duration' => 148
       ]);
       
       $this->assertDatabaseHas('films', [
           'title' => 'Inception',
           'duration' => 148
       ]);
   }
   
   // Contoh Feature Test
   public function test_user_can_view_films_list()
   {
       $response = $this->get('/films');
       $response->assertStatus(200);
       $response->assertViewIs('films.index');
   }
   ```

3. **Pengujian Livewire**
   ```php
   public function test_search_films()
   {
       $film = Film::factory()->create(['title' => 'Inception']);
       
       Livewire::test(FilmSearch::class)
           ->set('search', 'Inception')
           ->assertSee('Inception')
           ->assertDontSee('Interstellar');
   }
   ```

#### 2.1.9 Manajemen Proyek

1. **Metodologi**
   - Agile/Scrum
   - Siklus hidup pengembangan perangkat lunak (SDLC)
   - Version control dengan Git

2. **Alat Bantu**
   - **GitHub/GitLab**: Kolaborasi kode
   - **Trello/Asana**: Manajemen tugas
   - **Docker**: Containerization
   - **CI/CD**: Otomatisasi deployment

### 2.2 Penelitian Terkait
- Sistem Manajemen Bioskop Berbasis Web (2023)
- Aplikasi Pemesanan Tiket Bioskop Online (2022)
- Implementasi Sistem Pembayaran Digital pada Bioskop (2023)

## BAB 3 METODOLOGI PENELITIAN

### 3.1 Metode Pengembangan Sistem
Metode pengembangan sistem yang digunakan adalah SDLC (Software Development Life Cycle) dengan model Waterfall yang terdiri dari:
1. Analisis Kebutuhan
2. Desain Sistem
3. Implementasi
4. Pengujian
5. Pemeliharaan

### 3.2 Alat dan Bahan
#### 3.2.1 Perangkat Keras
- Komputer/Laptop dengan spesifikasi minimal 4GB RAM
- Koneksi internet

#### 3.2.2 Perangkat Lunak
- XAMPP (Apache, MySQL, PHP)
- Composer
- Visual Studio Code
- Git
- Node.js

### 3.3 Analisis Kebutuhan
#### 3.3.1 Kebutuhan Fungsional
1. Manajemen Film
   - CRUD Data Film
   - Kategori Film
   - Rating Usia

2. Manajemen Jadwal
   - Penentuan jadwal tayang
   - Manajemen studio
   - Pengaturan harga tiket

3. Sistem Pemesanan
   - Pemesanan tiket online
   - Pemilihan kursi
   - Pembayaran digital

#### 3.3.2 Kebutuhan Non-Fungsional
- Keamanan data
- Performa sistem
- Kemudahan penggunaan
- Kompatibilitas perangkat

## BAB 4 ANALISIS DAN PERANCANGAN SISTEM

### 4.1 Use Case Diagram
[Diagram use case akan ditambahkan]

### 4.2 Class Diagram
[Diagram class akan ditambahkan]

### 4.3 Entity Relationship Diagram (ERD)
[ERD akan ditambahkan]

### 4.4 Desain Antarmuka
[Desain antarmuka pengguna akan ditambahkan]

## BAB 5 IMPLEMENTASI SISTEM

### 5.1 Struktur Folder
```
app/
├── Http
├── Livewire
│   ├── Admin
│   └── User
├── Models
├── Providers
resources/
├── views
├── css
└── js
routes/
├── web.php
└── api.php
```

### 5.2 Implementasi Fitur Utama
#### 5.2.1 Sistem Autentikasi
```php
// Contoh kode autentikasi Laravel
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors(['email' => 'Kredensial tidak valid']);
}
```

#### 5.2.2 Manajemen Film
- Implementasi CRUD film
- Upload poster dan trailer
- Manajemen genre dan rating

#### 5.2.3 Sistem Pemesanan
- Pencarian jadwal tayang
- Pemilihan kursi
- Proses pembayaran

### 5.3 Integrasi Pembayaran
Integrasi dengan Midtrans untuk pemrosesan pembayaran:
```php
public function processPayment(Booking $booking)
{
    $params = [
        'transaction_details' => [
            'order_id' => $booking->code,
            'gross_amount' => $booking->total_price,
        ],
        'customer_details' => [
            'first_name' => $booking->user->name,
            'email' => $booking->user->email,
        ],
    ];
    
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    return view('payment', compact('snapToken', 'booking'));
}
```

## BAB 6 PENGUJIAN DAN ANALISIS

### 6.1 Metode Pengujian
- Pengujian Unit (Unit Testing)
- Pengujian Integrasi (Integration Testing)
- Pengujian Penerimaan Pengguna (User Acceptance Testing/UAT)

### 6.2 Hasil Pengujian
#### Tabel 6.1 Hasil Pengujian Fungsional
| Modul | Kasus Uji | Hasil |
|-------|-----------|-------|
| Login | Login Valid | Berhasil |
|       | Login Tidak Valid | Gagal |
| Film  | Tambah Film | Berhasil |
|       | Edit Film | Berhasil |

### 6.3 Analisis Hasil
- Performa sistem
- Keamanan data
- Pengalaman pengguna

## BAB 7 PENUTUP

### 7.1 Kesimpulan
Sistem Manajemen Bioskop ini telah berhasil dibangun dengan memenuhi seluruh kebutuhan fungsional dan non-fungsional yang telah ditetapkan.

### 7.2 Saran
1. Pengembangan aplikasi mobile
2. Integrasi dengan sistem keanggotaan
3. Penambahan fitur rekomendasi film

## DAFTAR PUSTAKA

1. Laravel Documentation. (2023). https://laravel.com/docs
2. Livewire Documentation. (2023). https://laravel-livewire.com
3. Pressman, R. S. (2015). Software Engineering: A Practitioner's Approach. McGraw-Hill.
4. Sommerville, I. (2016). Software Engineering. Pearson.

## LAMPIRAN

### Lampiran A: Kode Sumber
[Kode sumber tersedia di repository GitHub]

### Lampiran B: Panduan Penggunaan
[Panduan penggunaan sistem]
