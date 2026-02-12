<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Registrasi UMKM</title>
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
            border-radius: 10px;
            overflow: hidden;
        }

        .logo img {
            width: 80px;
            margin-bottom: 10px;
        }

        .left {
            width: 50%;
            background: #fff;
            padding: 40px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .left h2 {
            color: #0b3c6d;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 13px;
            color: #777;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            width: 100%;
            max-width: 360px;
        }

        label {
            font-size: 13px;
            color: #0b3c6d;
            margin-top: 14px;
            display: block;
        }

        input {
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
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .password .eye img {
            width: 18px;
            height: 18px;
            object-fit: contain;
            opacity: 0.7;
            transition: 0.2s;
        }

        .password .eye:hover img {
            opacity: 1;
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

        .right {
            width: 50%;
            background: linear-gradient(180deg, #d8eef9, #9ccfe8);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }

        .right h1 {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }

        .right h1 span {
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
            width: auto;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .center img {
            width: 90px;
            /* sesuaikan ukuran */
            height: auto;
            object-fit: contain;
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

        @media (max-width: 768px) {
            .container {
                flex-direction: column-reverse;
            }

            .left,
            .right {
                width: 100%;
            }

            .left {
                padding: 40px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- LEFT : FORM -->
        <div class="left">
            <div class="logo">
                <img src="img/logo.png" alt="Logo UMKM">
            </div>
            <h2>Registrasi Akun</h2>
            <p class="subtitle">Lengkapi data berikut untuk registrasi akun</p>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Raysha Wijaya" value="{{ old('nama') }}">

                <label>Email</label>
                <input type="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email') }}">

                <label>Password</label>
                <div class="password">
                    <input type="password" name="password" placeholder="********">
                    <span class="eye">
                        <img src="img/eye.png" onclick="togglePassword()">
                    </span>
                </div>

                <label>Konfirmasi Password</label>
                <div class="password">
                    <input type="password" name="password_confirmation" placeholder="********">
                    <span class="eye">
                        <img src="img/eye.png" onclick="togglePassword()">
                    </span>
                </div>

                <button type="submit">Registrasi</button>
            </form>

            <p class="login-text">
                Sudah memiliki akun?
                <a href="{{ url('login') }}">Masuk</a>
            </p>
        </div>

        <!-- RIGHT : ORBIT -->
        <div class="right">
            <h1>Kelola <span>UMKM</span><br>Lebih Mudah</h1>

            <div class="orbit">
                <div class="center">
                    <img src="img/logo.png" alt="">
                </div>
                <span class="dot d1"></span>
                <span class="dot d2"></span>
                <span class="dot d3"></span>
                <span class="dot d4"></span>
                <span class="dot d5"></span>
                <span class="dot d6"></span>
            </div>

            <p class="desc">
                Satu platform untuk pengelolaan <strong>PIRT</strong> dan
                <strong>UMKM</strong> secara efektif dan terstruktur.
            </p>
        </div>

    </div>

</body>

</html>
