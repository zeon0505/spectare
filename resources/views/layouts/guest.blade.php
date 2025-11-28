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
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
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
            animation-fill-mode: forwards;
            /* Penting agar tetap terlihat setelah animasi */
        }
    </style>
    @livewireStyles
</head>

<body class="bg-gray-900 text-white antialiased selection:bg-yellow-500 selection:text-black">

    {{ $slot }}

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
    @livewireScripts
</body>

</html>
