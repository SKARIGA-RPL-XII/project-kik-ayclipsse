@extends('layouts.app')
@section('title', 'Beranda PIRT')
@section('content')

    <body>
        <div class="font-['Montserrat']">
            <section class="hero">
                <!-- BACKGROUND IMAGE -->
                <div class="hero-bg">
                    <img src="img/features.jpg" alt="">
                </div>

                <!-- CONTENT -->
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span class="accent">Pendaftaran</span> Produk Industri Rumah Tangga<br>
                        <span class="yellow">(PIRT)</span> bagi Usaha Mikro, Kecil,<br>
                        dan Menengah <span class="yellow">(UMKM)</span>
                    </h1>

                    <div class="lengkung">
                        <img src="img/lengkung1.png">
                    </div>
                    <!-- SLIDER -->
                    <div class="slider-container">
                        <!-- overlay kiri -->
                        <div class="fade fade-left"></div>

                        <!-- slider -->
                        <div class="slider" id="slider">
                            <img src="img/food1.png">
                            <img src="img/food1.png">
                            <img src="img/food1.png">
                            <img src="img/food1.png">
                            <img src="img/food1.png">
                            <img src="img/food1.png">
                        </div>

                        <!-- overlay kanan -->
                        <div class="fade fade-right"></div>
                    </div>

                </div>
            </section>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const slider = document.getElementById("slider");
                if (!slider) return;

                let isDown = false;
                let startX;
                let scrollLeft;

                slider.addEventListener("mousedown", (e) => {
                    isDown = true;
                    startX = e.pageX - slider.offsetLeft;
                    scrollLeft = slider.scrollLeft;
                });

                slider.addEventListener("mouseup", () => isDown = false);
                slider.addEventListener("mouseleave", () => isDown = false);

                slider.addEventListener("mousemove", (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - slider.offsetLeft;
                    slider.scrollLeft = scrollLeft - (x - startX) * 1.5;
                });
            });
        </script>

    </body>

    <style>
        /* FONT */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
        }

        /* HERO */
        .hero {
            position: relative;
            width: 100%;
            min-height: 70vh;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* CONTENT */
        .hero-content {
            position: relative;
            z-index: 2;
            margin: 0 auto;
            padding: 100px 24px;
            text-align: center;
            color: #003366;
        }

        .hero-title {
            font-size: 30px;
            font-weight: 700;
            line-height: 1.3;
            margin: 0;
        }

        .accent {
            color: #f4b400;
        }

        .yellow {
            color: #f4b400;
        }

        /* SLIDER */
        .slider-container {
            width: 100%;
            overflow: hidden;
            padding-top: 100px 
        }

        .slider {
            display: flex;
            gap: 40px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 0 120px;
            cursor: grab;
        }

        .slider::-webkit-scrollbar {
            display: none;
        }

        .slider img {
            width: 280px;
            height: 220px;
            object-fit: cover;
            flex-shrink: 0;
        }

        /* Fade putih kiri & kanan */
        .fade {
            position: absolute;
            top: 0;
            width: 120px;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        .fade-left {
            left: 0;
            background: linear-gradient(to right, white 60%, transparent);
        }

        .fade-right {
            right: 0;
            background: linear-gradient(to left, white 60%, transparent);
        }
    </style>
@endsection
