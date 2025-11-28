<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Film yang Anda tunggu kini tersedia!</title>
    <style>
        body {font-family: 'Inter', sans-serif; background-color: #1e293b; color: #f1f5f9; margin: 0; padding: 20px;}
        .container {max-width: 600px; margin: auto; background-color: #111827; padding: 30px; border-radius: 8px;}
        .header {text-align: center; margin-bottom: 20px;}
        .header h1 {color: #fbbf24; font-size: 24px;}
        .film-poster {width: 100%; border-radius: 6px; margin-bottom: 15px;}
        .cta {display: inline-block; background-color: #fbbf24; color: #1e293b; padding: 12px 20px; border-radius: 6px; text-decoration: none; font-weight: 600;}
        .footer {margin-top: 30px; font-size: 12px; color: #9ca3af; text-align: center;}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Hai {{ $user->name }}, film yang Anda tunggu kini tersedia!</h1>
    </div>
    <p>Film <strong>{{ $film->title }}</strong> telah berubah status menjadi <strong>{{ $film->status }}</strong>. Kami pikir Anda ingin menontonnya.</p>
    @if($film->poster_url)
        <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" alt="{{ $film->title }} poster" class="film-poster">
    @endif
    <p>{{ $film->description }}</p>
    <p style="text-align:center; margin:20px 0;">
        <a href="{{ route('films.show', $film->id) }}" class="cta">Lihat Film</a>
    </p>
    <p>Terima kasih telah menggunakan CinemaSpectare!</p>
    <div class="footer">
        © {{ date('Y') }} CinemaSpectare. Semua hak dilindungi.
    </div>
</div>
</body>
</html>
