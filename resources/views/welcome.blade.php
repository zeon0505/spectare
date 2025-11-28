<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cinemaspectare - Experience the Magic</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #111827;
        }

        ::-webkit-scrollbar-thumb {
            background: #F59E0B;
            border-radius: 4px;
        }

        /* Animasi Zoom Lambat untuk Background */
        @keyframes slowZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .hero-bg {
            animation: slowZoom 20s infinite alternate;
        }

        /* Efek Kaca (Glassmorphism) */
        .glass {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(to right, #F59E0B, #FCD34D);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Definisi Animasi Fade In Up Manual */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation-name: fadeInUp;
            animation-duration: 0.8s;
            animation-fill-mode: forwards; /* Penting agar tetap terlihat setelah animasi */
        }
    </style>
</head>

<body class="bg-gray-900 text-white antialiased selection:bg-yellow-500 selection:text-black">

    <header class="fixed w-full top-0 z-50 transition-all duration-300" id="navbar">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                @php
                    $logo = \App\Models\SiteSetting::get('logo');
                @endphp
                @if($logo)
                    <img src="{{ str_starts_with($logo, 'http') ? $logo : Storage::url($logo) }}" alt="Spectare Logo" class="h-10 w-auto group-hover:rotate-12 transition-transform">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                @endif
                <span class="text-2xl font-bold tracking-wide text-white">
                    Spectare
                </span>
            </a>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                       class="px-6 py-2 font-bold text-black transition-all duration-300 bg-yellow-400 rounded-full hover:bg-yellow-300 hover:shadow-lg hover:-translate-y-1">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}"
                       class="px-6 py-2 font-bold text-black transition-all duration-300 bg-white rounded-full hover:bg-yellow-400 hover:shadow-lg hover:-translate-y-1">
                        Register
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        <section class="relative h-screen overflow-hidden flex items-center justify-center">
            @php
                $heroBackground = \App\Models\SiteSetting::get('hero_background', 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=1600&auto=format&fit=crop');
                $backgroundUrl = str_starts_with($heroBackground, 'http') ? $heroBackground : Storage::url($heroBackground);
            @endphp
            <div class="absolute inset-0 bg-cover bg-center hero-bg"
                 style="background-image: url('{{ $backgroundUrl }}');">
            </div>

            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-gray-900/70 to-gray-900"></div>

            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-16">
                <span class="block text-yellow-400 font-bold tracking-[0.2em] uppercase mb-4 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
                    Welcome to Cinemaspectare
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight text-white opacity-0 animate-fade-in-up" style="animation-delay: 0.3s;">
                    {{ \App\Models\SiteSetting::get('hero_title', 'Experience Cinema Like Never Before') }}
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto opacity-0 animate-fade-in-up" style="animation-delay: 0.5s;">
                    {{ \App\Models\SiteSetting::get('hero_subtitle', 'Book your tickets now and immerse yourself in the magic of movies') }}
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center opacity-0 animate-fade-in-up" style="animation-delay: 0.7s;">
                    <a href="#now-showing" class="px-8 py-4 bg-yellow-500 text-black font-bold rounded-full text-lg transition-all hover:bg-yellow-400 hover:scale-105 shadow-lg shadow-yellow-500/30">
                        {{ \App\Models\SiteSetting::get('hero_cta_text', 'Explore Now') }}
                    </a>
                    <a href="#coming-soon" class="px-8 py-4 bg-transparent border-2 border-gray-500 text-white font-bold rounded-full text-lg transition-all hover:border-white hover:bg-white hover:text-black">
                        {{ \App\Models\SiteSetting::get('hero_cta_secondary', 'Coming Soon') }}
                    </a>
                </div>
            </div>

            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </div>
        </section>

        <section id="now-showing" class="py-20 bg-gray-900 relative">
            <div class="container mx-auto px-6 relative z-10">
                <div class="flex justify-between items-end mb-8" data-aos="fade-up">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-white">Now <span class="text-yellow-400">Showing</span></h2>
                        <div class="h-1 w-16 bg-yellow-500 mt-3 rounded-full"></div>
                    </div>
                </div>

                <!-- Search and Filter Form -->
                <form action="{{ route('home') }}#now-showing" method="GET" class="mb-12" data-aos="fade-up">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 bg-gray-800/50 p-6 rounded-xl border border-gray-700">
                        <div class="md:col-span-2 lg:col-span-2">
                            <label for="search" class="block text-sm font-medium text-gray-300 mb-2">Search Film</label>
                            <input type="text" name="search" id="search" placeholder="e.g., The Avengers"
                                   value="{{ $search ?? '' }}"
                                   class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border-transparent focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 transition">
                        </div>
                        <div>
                            <label for="genre" class="block text-sm font-medium text-gray-300 mb-2">Genre</label>
                            <select name="genre" id="genre"
                                    class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border-transparent focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 transition">
                                <option value="">All Genres</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ ($selectedGenre ?? '') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-2 px-4 rounded-lg hover:bg-yellow-400 transition-all duration-300 shadow-lg hover:shadow-yellow-500/30">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>

                @if(isset($nowShowingFilms) && $nowShowingFilms->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach ($nowShowingFilms as $index => $film)
                            <div class="group relative bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
                                 data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <a href="{{ route('films.show', $film) }}" class="block h-full">
                                    <div class="relative overflow-hidden aspect-[2/3]">
                                        <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}"
                                             alt="{{ $film->title }}"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <span class="bg-yellow-500 text-black font-bold py-2 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                                Book Now
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <h3 class="font-bold text-lg text-white group-hover:text-yellow-400 transition-colors truncate">{{ $film->title }}</h3>
                                        <p class="text-gray-400 text-xs mt-1 truncate">
                                            {{ $film->genres->pluck('name')->join(', ') }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 bg-gray-800/50 rounded-xl border border-gray-700" data-aos="fade-up">
                        <p class="text-xl text-gray-400">No films found matching your criteria.</p>
                    </div>
                @endif
            </div>
        </section>

        <section id="coming-soon" class="py-20 bg-gray-800 relative overflow-hidden">
            <div class="container mx-auto px-6 relative z-10">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl md:text-5xl font-bold text-white">Coming <span class="text-gradient">Soon</span></h2>
                </div>

                @if(isset($comingSoonFilms) && $comingSoonFilms->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach ($comingSoonFilms as $index => $film)
                            <div class="relative group cursor-pointer" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                <div class="relative aspect-[2/3] rounded-2xl overflow-hidden shadow-xl">
                                     <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}"
                                          alt="{{ $film->title }}"
                                          class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105">

                                    <div class="absolute top-4 left-4 bg-yellow-500 text-black font-bold px-3 py-1 rounded shadow-lg z-10 text-sm">
                                        {{ \Carbon\Carbon::parse($film->release_date)->format('d M Y') }}
                                    </div>

                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90"></div>
                                    <div class="absolute bottom-0 left-0 w-full p-6">
                                        <h3 class="text-xl font-bold text-white mb-1">{{ $film->title }}</h3>
                                        <p class="text-yellow-400 text-xs font-bold uppercase tracking-wider">Coming Soon</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <p class="text-gray-400">No upcoming films match your criteria.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <footer class="bg-black pt-16 pb-8 border-t border-gray-800">
        <div class="container mx-auto px-6 text-center">
            <a href="#" class="text-2xl font-bold text-white mb-4 block">
                Cinema<span class="text-yellow-400">spectare</span>
            </a>
            <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto">
                The best place to watch movies, eat popcorn, and enjoy the show.
            </p>
            <p class="text-gray-600 text-xs">&copy; {{ date('Y') }} Cinemaspectare. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi Animasi Scroll
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Efek Navbar Glass saat Scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('glass', 'shadow-lg');
            } else {
                navbar.classList.remove('glass', 'shadow-lg');
            }
        });
    </script>
</body>
</html>
