<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboarduser.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon">●</div>
                <span>Dashboard Kit</span>
            </div>

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

            <div class="sidebar-footer">
                <span>Log Out</span>
            </div>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

</body>

</html>
