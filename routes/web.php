<?php

use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Admin\Bookings\Detail as AdminBookingsDetail;
use App\Livewire\Admin\Bookings\Index as AdminBookingsIndex;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Films\Index as AdminFilmsIndex;
use App\Livewire\Admin\Films\Upsert as AdminFilmsUpsert;
use App\Livewire\Admin\Genres\Create as AdminGenresCreate;
use App\Livewire\Admin\Genres\Edit as AdminGenresEdit;
use App\Livewire\Admin\Genres\Index as AdminGenresIndex;
use App\Livewire\Admin\Reviews\Index as AdminReviewsIndex;
use App\Livewire\Admin\Reviews\Show as AdminReviewsShow;
use App\Livewire\Admin\Showtimes\Create as AdminShowtimesCreate;
use App\Livewire\Admin\Showtimes\Edit as AdminShowtimesEdit;
use App\Livewire\Admin\Showtimes\Index as AdminShowtimesIndex;
use App\Livewire\Admin\Snacks\Index as AdminSnacksIndex;
use App\Livewire\Admin\Snacks\Create as AdminSnacksCreate;
use App\Livewire\Admin\Snacks\Edit as AdminSnacksEdit;
use App\Livewire\Admin\Studios\Index as AdminStudiosIndex;
use App\Livewire\Admin\Studios\Upsert as AdminStudiosUpsert;
use App\Livewire\Admin\Transactions\Detail as AdminTransactionsDetail;
use App\Livewire\Admin\Transactions\Index as AdminTransactionsIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Features\Settings;
use App\Livewire\Home;
use App\Livewire\User\Bookings\Create as UserBookingsCreate;
use App\Livewire\User\Bookings\Detail as UserBookingsDetail;
use App\Livewire\User\Bookings\Index as UserBookingsIndex;
use App\Livewire\User\Bookings\SeatSelection as UserBookingsSeatSelection;
use App\Livewire\User\Bookings\Payment as UserBookingsPayment;
use App\Livewire\User\Films\Index as UserFilmsIndex;
use App\Livewire\User\Films\Show as UserFilmsShow;
use App\Http\Controllers\MidtransController;
use App\Livewire\User\Reviews\Index as UserReviewsIndex;
use App\Livewire\User\Reviews\Show as UserReviewsShow;
use App\Livewire\User\Showtimes\Index as UserShowtimesIndex;
use App\Livewire\User\Showtimes\Show as UserShowtimesShow;
use App\Livewire\User\Snacks\Index as UserSnacksIndex;
use App\Livewire\User\Snacks\ShoppingCart;
use App\Livewire\User\Snacks\Checkout as UserSnacksCheckout;
use App\Livewire\User\UserDashboard;
use App\Livewire\User\Studios\Index as UserStudiosIndex;
use App\Livewire\User\Studios\Show as UserStudiosShow;
use App\Livewire\User\Transactions\Detail as UserTransactionsDetail;
use App\Livewire\User\Transactions\Index as UserTransactionsIndex;
use App\Livewire\User\Wishlist\Index as UserWishlistIndex;
use App\Livewire\User\Profile; // Tambahkan ini
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Film;
use App\Models\Genre;

//
// ─── PUBLIC ROUTES ──────────────────────────────────────────────────────────
//
Route::get('/', function () {
    $search = request('search');
    $genreId = request('genre');

    // Get featured film IDs
    $nowShowingIds = \App\Models\FeaturedFilm::nowShowing()->pluck('film_id');
    $comingSoonIds = \App\Models\FeaturedFilm::comingSoon()->pluck('film_id');

    // Now Showing Films with search and filter
    $nowShowingFilms = Film::whereIn('id', $nowShowingIds)
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->when($genreId, function ($query, $genreId) {
            $query->whereHas('genres', function ($q) use ($genreId) {
                $q->where('genres.id', $genreId);
            });
        })
        ->get();

    // Coming Soon Films with search and filter
    $comingSoonFilms = Film::whereIn('id', $comingSoonIds)
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->when($genreId, function ($query, $genreId) {
            $query->whereHas('genres', function ($q) use ($genreId) {
                $q->where('genres.id', $genreId);
            });
        })
        ->get();

    $genres = Genre::all();
    return view('welcome', compact('nowShowingFilms', 'comingSoonFilms', 'genres', 'search', 'genreId'));
})->name('home');
Route::get('/films', UserFilmsIndex::class)->name('films.index');
Route::get('/films/{film}', UserFilmsShow::class)->name('films.show');
Route::get('/snacks', UserSnacksIndex::class)->name('snacks.index');

//
// ─── AUTH ROUTES ────────────────────────────────────────────────────────────
//
Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');

Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    session()->flash('success', 'Anda telah berhasil logout.');
    
    return redirect('/');
})->name('logout');

//
// ─── PROTECTED ROUTES (AUTH REQUIRED) ───────────────────────────────────────
//
    Route::post('/midtrans/notification', [MidtransController::class, 'notificationHandler']);
//
// ─── ADMIN ROUTES ───────────────────────────────────────────────────────
//
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');

    // 🎬 Films
    Route::get('/films', AdminFilmsIndex::class)->name('films.index');
    Route::get('/films/create', AdminFilmsUpsert::class)->name('films.create');
    Route::get('/films/{film}/edit', AdminFilmsUpsert::class)->name('films.edit');

    // 🏷️ Genres
    Route::get('/genres', AdminGenresIndex::class)->name('genres.index');
    Route::get('/genres/create', AdminGenresCreate::class)->name('genres.create');
    Route::get('/genres/{id}/edit', AdminGenresEdit::class)->name('genres.edit');

    // 🎞️ Studios
    Route::get('/studios', AdminStudiosIndex::class)->name('studios.index');
    Route::get('/studios/create', AdminStudiosUpsert::class)->name('studios.create');
    Route::get('/studios/{studio}/edit', AdminStudiosUpsert::class)->name('studios.edit');

    // 🕒 Showtimes
    Route::get('/showtimes', \App\Livewire\Admin\Showtimes\Index::class)->name('showtimes.index');
    Route::get('/showtimes/create', \App\Livewire\Admin\Showtimes\Create::class)->name('showtimes.create');
    Route::get('/showtimes/{showtime}/edit', \App\Livewire\Admin\Showtimes\Edit::class)->name('showtimes.edit');


    // 🍿 Snacks (Makanan & Minuman)
    Route::get('/snacks', AdminSnacksIndex::class)->name('snacks.index');
    Route::get('/snacks/create', AdminSnacksCreate::class)->name('snacks.create');
    Route::get('/snacks/{snack}/edit', AdminSnacksEdit::class)->name('snacks.edit');

    // 💳 Transactions
    Route::get('/transactions', AdminTransactionsIndex::class)->name('transactions.index');
    Route::get('/transactions/{transaction}', AdminTransactionsDetail::class)->name('transactions.detail');

    // 🎟️ Bookings
    Route::get('/bookings', AdminBookingsIndex::class)->name('bookings.index');
    Route::get('/bookings/create', AdminFilmsIndex::class)->name('bookings.create');
    Route::get('/bookings/{booking}', AdminBookingsDetail::class)->name('bookings.detail');

    // ⭐ Reviews
    Route::get('/reviews', AdminReviewsIndex::class)->name('reviews.index');
    Route::get('/reviews/{id}', AdminReviewsShow::class)->name('reviews.show');

    // 📊 Reports
    Route::get('/reports', \App\Livewire\Admin\Reports\Index::class)->name('reports.index');

    // 👥 Users
    Route::get('/users', \App\Livewire\Admin\Users\Index::class)->name('users.index');
    Route::get('/users/{user}', \App\Livewire\Admin\Users\Detail::class)->name('users.detail');

    // ⚙️ Settings
    Route::get('/settings/site', \App\Livewire\Admin\Settings\SiteSettings::class)->name('settings.site');
});

//
// ─── USER ROUTES ────────────────────────────────────────────────────────
//
Route::middleware(['auth', RoleMiddleware::class . ':user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');

    // 🎬 Films
    Route::get('films', UserFilmsIndex::class)->name('films.index');
    Route::get('films/{film}', UserFilmsShow::class)->name('films.show');

    // 🕒 Showtimes
    Route::get('showtimes', UserShowtimesIndex::class)->name('showtimes.index');
    Route::get('showtimes/{id}', UserShowtimesShow::class)->name('showtimes.show');

    // 🎞️ Studios
    Route::get('studios', UserStudiosIndex::class)->name('studios.index');
    Route::get('studios/{studio}', UserStudiosShow::class)->name('studios.show');

    // 🍿 Snacks (Pembelian makanan & minuman)
    Route::get('snacks', UserSnacksIndex::class)->name('snacks.index');
    Route::get('checkout', UserSnacksCheckout::class)->name('snacks.checkout');
    Route::get('cart', ShoppingCart::class)->name('cart.index');

    // 💳 Transactions
    Route::get('transactions', UserTransactionsIndex::class)->name('transactions.index');
    Route::get('transactions/{id}', UserTransactionsDetail::class)->name('transactions.detail');

    // ⭐ Reviews
    Route::get('reviews', UserReviewsIndex::class)->name('reviews.index');
    Route::get('reviews/{id}', UserReviewsShow::class)->name('reviews.show');

    // 🎟️ Bookings
    Route::get('/bookings', UserBookingsIndex::class)->name('bookings.index');
    Route::get('/bookings/create/{showtime}', UserBookingsCreate::class)->name('bookings.create');
    Route::get('/bookings/seat-selection', UserBookingsSeatSelection::class)->name('bookings.seat-selection');
    Route::get('/bookings/{booking}', UserBookingsDetail::class)->name('bookings.detail');

    // ❤️ Wishlist
    Route::get('/wishlist', UserWishlistIndex::class)->name('wishlist.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('profile', Profile::class)->name('profile'); // Ubah baris ini
    Route::get('settings', Settings::class)->name('settings');
});


//
// ─── LOGOUT ROUTE ───────────────────────────────────────────────────────────
//
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
