<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login UMKM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #fff;
            padding: 30px;
        }

        .container {
            width: 100%;
            height: calc(100vh - 60px);
            display: flex;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        /* ===== KIRI (GAMBAR / ILUSTRASI) ===== */
        .left {
            width: 50%;
            background: linear-gradient(180deg, #d8eef9, #9ccfe8);
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
        }

        .left h1 {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }

        .left h1 span {
            font-style: italic;
        }

        /* ORBIT */
        .orbit {
            width: 280px;
            height: 280px;
            position: relative;
            margin-bottom: 30px;
        }

        .orbit::before,
        .orbit::after {
            content: "";
            position: absolute;
            border: 2px solid #fff;
            border-radius: 50%;
        }

        .orbit::before {
            width: 100%;
            height: 100%;
        }

        .orbit::after {
            width: 200px;
            height: 200px;
            top: 40px;
            left: 40px;
        }

        .center {
            width: 60px;
            height: 60px;
            background: #0b3c6d;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .dot {
            width: 22px;
            height: 22px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
        }

        .d1 {
            top: -11px;
            left: 50%;
            transform: translateX(-50%);
        }

        .d2 {
            right: -11px;
            top: 50%;
            transform: translateY(-50%);
        }

        .d3 {
            bottom: -11px;
            left: 50%;
            transform: translateX(-50%);
        }

        .d4 {
            left: -11px;
            top: 50%;
            transform: translateY(-50%);
        }

        .d5 {
            top: 45px;
            right: 70px;
        }

        .d6 {
            bottom: 45px;
            left: 70px;
        }

        .desc {
            font-size: 14px;
            color: #0b3c6d;
            max-width: 420px;
            text-align: center;
        }

        /* ===== KANAN (FORM LOGIN) ===== */
        .right {
            width: 50%;
            background: #fff;
            padding: 40px 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 45px;
            margin-bottom: 15px;
        }

        .right h2 {
            color: #0b3c6d;
            margin-bottom: 5px;
            text-align: center;
        }

        .subtitle {
            font-size: 13px;
            color: #777;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 360px;
        }

        form label {
            font-size: 13px;
            color: #0b3c6d;
            margin-top: 14px;
            display: block;
        }

        form input {
            width: 100%;
            height: 42px;
            padding: 10px;
            border: 1px solid #e3e7ef;
            border-radius: 6px;
            font-size: 13px;
            margin-top: 6px;
        }

        .password {
            position: relative;
        }

        .password .eye {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        button {
            width: 100%;
            height: 44px;
            background: #0b3c6d;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
        }

        .login-text {
            margin-top: 18px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }

        .login-text a {
            color: #0b3c6d;
            font-weight: bold;
            text-decoration: none;
            margin-left: 3px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left,
            .right {
                width: 100%;
            }

            .right {
                padding: 40px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- KIRI -->
        <div class="left">
            <h1>Kelola <span>UMKM</span> Lebih<br>Mudah di Satu Platform</h1>

            <div class="orbit">
                <div class="center"></div>
                <span class="dot d1"></span>
                <span class="dot d2"></span>
                <span class="dot d3"></span>
                <span class="dot d4"></span>
                <span class="dot d5"></span>
                <span class="dot d6"></span>
            </div>

            <p class="desc">
                Dirancang untuk membantu pengelolaan usaha secara efektif
                dan terstruktur. <strong>PIRT</strong> bagi
                <strong>Usaha Mikro, Kecil, dan Menengah (UMKM)</strong>.
            </p>
        </div>

        <!-- KANAN -->
        <div class="right">
            <div class="logo">
                <img src="logo-umkm.png" alt="Logo UMKM">
            </div>

            <h2>Masuk Akun Anda</h2>
            <p class="subtitle">Masukkan email dan kata sandi yang telah terdaftar</p>

            <form method="POST" action="{{ route('proses.login') }}">
                @csrf

                <label>Email</label>
                <input type="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email') }}"
                    required>

                @error('email')
                    <small style="color:red">{{ $message }}</small>
                @enderror

                <label>Password</label>
                <div class="password">
                    <input type="password" name="password" id="password" placeholder="********" required>
                    <span class="eye" onclick="togglePassword()">👁</span>
                </div>

                @error('password')
                    <small style="color:red">{{ $message }}</small>
                @enderror

                <button type="submit">Masuk</button>
            </form>


            <p class="login-text">
                Belum memiliki akun?
                <a href="{{ url('register') }}">Registrasi</a>
            </p>
        </div>

    </div>
</body>
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

</html>
