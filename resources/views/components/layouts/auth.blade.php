<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spectare-Register</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 50%, #0f1428 100%);
            min-height: 100vh;
            position: relative;
            /* Allow scrolling instead of overflow hidden */
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Enhanced animated background with multiple layers */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, transparent 70%);
            animation: float-reverse 25s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, -30px);
            }
        }

        @keyframes float-reverse {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-40px, 40px);
            }
        }

        /* Changed layout to allow scrolling with proper spacing */
        .wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 40px 20px;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            width: 100%;
            max-width: 1400px;
            /* Changed from fixed height to min-height for scrolling */
            min-height: 700px;
            background: rgba(15, 20, 40, 0.8);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.7), 0 0 100px rgba(212, 175, 55, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            position: relative;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left side - Register form with enhanced styling */
        .register-section {
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(135deg, rgba(10, 14, 39, 0.95) 0%, rgba(26, 31, 58, 0.95) 100%);
            position: relative;
            min-height: 700px;
        }

        .register-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.5), transparent);
        }

        .register-section::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.05) 0%, transparent 70%);
            animation: spotlight 8s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes spotlight {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(50px, 50px);
            }
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #8f0000 0%, #d43737 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #0a0e27;
            font-size: 28px;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
            transition: all 0.3s ease;
        }

        .logo-icon:hover {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 0 40px rgba(204, 12, 12, 0.7);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 56px;
            color: #ffffff;
            margin-bottom: 16px;
            font-weight: 800;
            letter-spacing: -1px;
            animation: fadeInDown 0.8s ease-out 0.1s both;
            text-shadow: 0 4px 20px rgba(212, 175, 55, 0.2);
        }

        .subtitle {
            color: #a0a8c0;
            font-size: 15px;
            margin-bottom: 50px;
            line-height: 1.8;
            animation: fadeInDown 0.8s ease-out 0.2s both;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 28px;
            position: relative;
            animation: fadeInUp 0.8s ease-out both;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.5s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.6s;
        }

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

        .form-group label {
            display: block;
            color: #d4af37;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .form-group input {
            width: 100%;
            padding: 16px 18px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 10px;
            color: #ffffff;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.1);
            border-color: #d4af37;
            box-shadow: 0 0 40px rgba(212, 175, 55, 0.4), inset 0 0 15px rgba(212, 175, 55, 0.15);
            transform: translateY(-3px);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease-out 0.7s both;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #d43737;
        }

        .checkbox-group label {
            color: #a0a8c0;
            font-size: 14px;
            cursor: pointer;
            margin: 0;
        }

        .checkbox-group a {
            color: #d4af37;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .checkbox-group a:hover {
            color: #f4d03f;
        }

        .btn-register {
            width: 100%;
            padding: 16px 28px;
            background: linear-gradient(135deg, #8f0000 0%, #d43737 100%);
            color: #0a0e27;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 15px 40px rgba(236, 43, 43, 0.4);
            margin-bottom: 32px;
            animation: fadeInUp 0.8s ease-out 0.8s both;
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 60px rgba(230, 28, 28, 0.6);
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 14px;
            text-align: center;
            animation: fadeInUp 0.8s ease-out 0.9s both;
        }

        .footer-links a {
            color: #d43737;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            position: relative;
        }

        .footer-links a::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: #f4d03f;
            transition: width 0.3s ease;
        }

        .footer-links a:hover {
            color: #f4d03f;
        }

        .footer-links a:hover::after {
            width: 100%;
        }

        /* Right side - Cinema visual with enhanced animations */
        .cinema-section {
            background: linear-gradient(135deg, #1a1f3a 0%, #0f1428 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            min-height: 700px;
        }

        .cinema-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                linear-gradient(90deg, rgba(212, 175, 55, 0.1) 0%, transparent 20%, transparent 80%, rgba(212, 175, 55, 0.1) 100%);
            pointer-events: none;
            animation: curtainFlicker 3s ease-in-out infinite;
        }

        @keyframes curtainFlicker {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.1;
            }
        }

        .cinema-visual {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .film-reel {
            width: 240px;
            height: 240px;
            position: relative;
            animation: spin 8s linear infinite;
            filter: drop-shadow(0 0 40px rgba(197, 156, 21, 0.5));
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .reel-circle {
            width: 100%;
            height: 100%;
            border: 4px solid #5a0505;
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 30px rgba(255, 88, 88, 0.4);
        }

        .reel-circle::before,
        .reel-circle::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            background: #ff0000;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
        }

        .reel-circle::before {
            left: 20px;
        }

        .reel-circle::after {
            right: 20px;
        }

        .reel-center {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ff0000 0%, #ff0000 100%);
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 50px rgba(212, 175, 55, 0.7), inset 0 0 25px rgba(255, 255, 255, 0.3);
        }

        .ticket {
            position: absolute;
            width: 100px;
            height: 150px;
            background: linear-gradient(135deg, #f10000 0%, #0a0800 100%);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            color: #0a0e27;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            animation: ticketFloat 4s ease-in-out infinite;
            letter-spacing: 1px;
        }

        .ticket:nth-child(4) {
            top: 10%;
            left: 8%;
            animation-delay: 0s;
        }

        .ticket:nth-child(5) {
            bottom: 15%;
            right: 12%;
            animation-delay: 1.5s;
        }

        @keyframes ticketFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-40px) rotate(8deg);
            }
        }

        .cinema-text {
            position: absolute;
            bottom: 50px;
            text-align: center;
            color: #d80000;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 4px;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }
        }

        .popcorn {
            position: absolute;
            font-size: 50px;
            opacity: 0.5;
            animation: float-popcorn 4s ease-in-out infinite;
            filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.4));
        }

        .popcorn:nth-child(6) {
            top: 15%;
            left: 12%;
            animation-delay: 0s;
        }

        .popcorn:nth-child(7) {
            top: 75%;
            right: 15%;
            animation-delay: 1s;
        }

        .popcorn:nth-child(8) {
            top: 45%;
            right: 8%;
            animation-delay: 2s;
        }

        @keyframes float-popcorn {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-30px);
            }
        }

        /* Added features section for scrolling */
        .features-section {
            width: 100%;
            max-width: 1400px;
            margin-top: 60px;
            padding: 60px 40px;
            background: rgba(15, 20, 40, 0.6);
            border-radius: 20px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            animation: slideIn 0.8s ease-out 0.3s both;
        }

        .features-title {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            color: #ffffff;
            margin-bottom: 40px;
            text-align: center;
            text-shadow: 0 4px 20px rgba(212, 175, 55, 0.2);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: rgba(212, 175, 55, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out both;
        }

        .feature-card:nth-child(1) {
            animation-delay: 0.4s;
        }

        .feature-card:nth-child(2) {
            animation-delay: 0.5s;
        }

        .feature-card:nth-child(3) {
            animation-delay: 0.6s;
        }

        .feature-card:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.4);
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.2);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: #b60000;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .feature-text {
            color: #a0a8c0;
            font-size: 14px;
            line-height: 1.8;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .register-section {
                min-height: auto;
                padding: 60px 40px;
            }

            .cinema-section {
                min-height: 500px;
            }
        }

        @media (max-width: 768px) {
            .wrapper {
                padding: 20px 15px;
            }

            .container {
                border-radius: 16px;
            }

            .register-section {
                padding: 40px 25px;
            }

            .cinema-section {
                display: none;
            }

            h1 {
                font-size: 40px;
            }

            .logo-text {
                font-size: 24px;
            }

            .features-section {
                margin-top: 40px;
                padding: 40px 20px;
            }

            .features-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <!-- Kiri: Register Form -->
            {{ $slot }}

            <!-- Kanan: Cinema Visual -->
            <div class="cinema-section">
                <div class="cinema-visual">
                    <div class="film-reel">
                        <div class="reel-circle"></div>
                        <div class="reel-center"></div>
                    </div>
                    <div class="ticket">TICKET</div>
                    <div class="ticket">TICKET</div>
                    <div class="popcorn">🍿</div>
                    <div class="popcorn">🍿</div>
                    <div class="popcorn">🍿</div>
                    <div class="cinema-text">Spectare</div>
                </div>
            </div>
        </div>

        <!-- Features Section for Scrolling -->
        <div class="features-section">
            <h2 class="features-title">Mengapa Memilih Spectare?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎥</div>
                    <div class="feature-title">Koleksi Lengkap</div>
                    <div class="feature-text">Ribuan film terbaru dan klasik dari seluruh dunia tersedia untuk Anda
                        nikmati kapan saja.</div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⭐</div>
                    <div class="feature-title">Kualitas Premium</div>
                    <div class="feature-text">Streaming dalam kualitas 4K Ultra HD dengan audio surround untuk
                        pengalaman sinematik terbaik.</div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎭</div>
                    <div class="feature-title">Konten Eksklusif</div>
                    <div class="feature-text">Akses konten eksklusif, premiere film, dan behind-the-scenes yang tidak
                        tersedia di tempat lain.</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
