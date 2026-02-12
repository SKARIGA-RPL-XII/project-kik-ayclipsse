<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #0b3c6d;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .logo {
            padding: 20px;
            font-weight: bold;
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            padding: 15px 20px;
            cursor: pointer;
        }

        .sidebar ul li.active,
        .sidebar ul li:hover {
            background: #09407a;
        }

        .sidebar-footer {
            padding: 20px;
            font-size: 14px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="admin-wrapper">

    <aside class="sidebar">
        <div>
            <div class="logo">Dashboard Kit</div>
            <ul>
                <li class="active">Dashboard</li>
                <li>Usaha</li>
                <li>Produk Usaha</li>
                <li>Persetujuan</li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <div>Profil User</div>
            <div>Log Out</div>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</div>

</body>
</html>
