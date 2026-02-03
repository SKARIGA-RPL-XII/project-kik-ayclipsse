<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- CSS GLOBAL (layouting saja) --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: #f4f6f8;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #0b3c6d;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 20px;
            font-weight: 700;
        }

        .logo-icon {
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li a {
            display: block;
            padding: 14px 20px;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
        }

        .sidebar-menu li.active,
        .sidebar-menu li:hover {
            background: #09407a;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, .2);
            cursor: pointer;
        }

        /* MAIN */
        .main-content {
            flex: 1;
            padding: 30px;
        }
    </style>

    {{-- CSS KHUSUS HALAMAN --}}
    @stack('styles')
</head>

<body>

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <div>
                <div class="sidebar-logo">
                    <div class="logo-icon"></div>
                    <span>Dashboard Kit</span>
                </div>

                {{-- SIDEBAR USER --}}
                {{-- @if (($role ?? 'user') === 'user') --}}
                <span>User</span>

                <ul class="sidebar-menu">
                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="{{ request()->is('profil') ? 'active' : '' }}">
                        <a href="{{ url('/profil') }}">Profil Usaha</a>
                    </li>
                    <li class="{{ request()->is('produk') ? 'active' : '' }}">
                        <a href="{{ url('/produk') }}">Produk Usaha</a>
                    </li>
                </ul>

                {{-- SIDEBAR ADMIN --}}
                <span>Admin</span>
                <ul class="sidebar-menu">
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="{{ request()->is('admin/usaha') ? 'active' : '' }}">
                        <a href="{{ url('/admin/usaha') }}">Usaha</a>
                    </li>
                    <li class="{{ request()->is('admin/produk') ? 'active' : '' }}">
                        <a href="{{ url('/admin/produk') }}">Produk Usaha</a>
                    </li>
                    <li class="{{ request()->is('admin/persetujuan') ? 'active' : '' }}">
                        <a href="{{ url('/admin/persetujuan') }}">Persetujuan</a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                Log Out
            </div>

        </aside>

        <!-- MAIN -->
        <main class="main-content">
            @yield('content')
        </main>

    </div>

</body>

</html>
