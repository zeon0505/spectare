<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background-color: #f8f9fa; padding: 10px 20px; border-bottom: 1px solid #ddd; text-align: center; }
        .content { padding: 20px; }
        .footer { text-align: center; font-size: 0.8em; color: #777; margin-top: 20px; }
        .details-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .details-table th, .details-table td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        .total { font-weight: bold; font-size: 1.2em; margin-top: 15px; text-align: right; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>CinemaSpectare</h2>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $booking->user->name }}</strong>!</p>
            <p>Terima kasih telah melakukan pemesanan tiket di CinemaSpectare. Berikut adalah detail pemesanan Anda:</p>

            <table class="details-table">
                <tr>
                    <th>ID Pemesanan</th>
                    <td>#{{ $booking->id }}</td>
                </tr>
                <tr>
                    <th>Film</th>
                    <td>{{ $booking->showtime->film->title }}</td>
                </tr>
                <tr>
                    <th>Studio</th>
                    <td>{{ $booking->showtime->studio->name }}</td>
                </tr>
                <tr>
                    <th>Waktu Tayang</th>
                    <td>{{ \Carbon\Carbon::parse($booking->showtime->date . ' ' . $booking->showtime->start_time)->translatedFormat('l, d F Y - H:i') }}</td>
                </tr>
                <tr>
                    <th>Kursi</th>
                    <td>
                        @foreach($booking->seats as $seat)
                            {{ $seat->seat_number }}{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </td>
                </tr>
            </table>

            <div class="total">
                Total Bayar: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
            </div>

            <p>Silakan tunjukkan email ini atau QR Code di aplikasi saat masuk ke studio.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} CinemaSpectare. All rights reserved.
        </div>
    </div>
</body>
</html>
