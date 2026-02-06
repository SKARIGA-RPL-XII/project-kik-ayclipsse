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

        /* ===== LEFT : FORM ===== */
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

        .eye {
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

        /* ===== RIGHT : ORBIT ===== */
        .right {
            width: 50%;
            background: linear-gradient(180deg, #d8eef9, #9ccfe8);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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

        .d1 { top: -11px; left: 50%; transform: translateX(-50%); }
        .d2 { right: -11px; top: 50%; transform: translateY(-50%); }
        .d3 { bottom: -11px; left: 50%; transform: translateX(-50%); }
        .d4 { left: -11px; top: 50%; transform: translateY(-50%); }
        .d5 { top: 45px; right: 70px; }
        .d6 { bottom: 45px; left: 70px; }

        .desc {
            font-size: 14px;
            color: #0b3c6d;
            max-width: 420px;
            text-align: center;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container {
                flex-direction: column-reverse;
            }

            .left, .right {
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
        <h2>Registrasi Akun</h2>
        <p class="subtitle">Lengkapi data berikut untuk registrasi akun</p>

        <form>
            <label>Nama Lengkap</label>
            <input type="text" placeholder="Raysha Wijaya">

            <label>Email</label>
            <input type="email" placeholder="contoh@gmail.com">

            <label>Password</label>
            <div class="password">
                <input type="password" placeholder="********">
                <span class="eye">👁</span>
            </div>

            <label>Konfirmasi Password</label>
            <div class="password">
                <input type="password" placeholder="********">
                <span class="eye">👁</span>
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
            <div class="center"></div>
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
