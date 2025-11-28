<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spectare - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
            }
            50% {
                box-shadow: 0 0 30px rgba(251, 191, 36, 0.5);
            }
        }

        .card-cinema {
            animation: fadeIn 0.6s ease-out forwards;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid rgba(251, 191, 36, 0.2);
            backdrop-filter: blur(10px);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(251, 191, 36, 0.6);
            box-shadow: 0 10px 40px rgba(251, 191, 36, 0.15);
        }

        .stat-card {
            animation: slideInLeft 0.7s ease-out forwards;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        .accent-amber {
            color: #fbbf24;
        }

        .text-glow {
            animation: glow 2s ease-in-out infinite;
        }

        .menu-item:hover {
            background-color: rgba(251, 191, 36, 0.1);
            color: #fbbf24;
        }

        .menu-item.active {
            background-color: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border-left: 3px solid #fbbf24;
        }

        .hamburger {
            display: none;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 40;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-gray-100">

    <div class="flex h-screen">
        <!-- SIDEBAR -->
        @include('components.layouts.partials.sidebar')

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    <script>
        // Hamburger menu toggleburger menu toggle
        const hamburger = document.querySelector('.hamburger');
        const sidebar = document.querySelector('.sidebar');

        hamburger?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.sidebar') && !e.target.closest('.hamburger')) {
                sidebar.classList.remove('open');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
