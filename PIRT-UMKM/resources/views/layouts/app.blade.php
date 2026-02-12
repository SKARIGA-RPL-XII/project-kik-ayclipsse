<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            gap: 12px;
            padding: 20px;
            font-weight: 700;
            font-size: 40px;
        }

        .sidebar-logo img {
            width: 170px;
            height: 50px;
            object-fit: contain;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar-menu li a i {
            width: 18px;
            text-align: center;
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

        .main-content {
            flex: 1;
            padding: 30px;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div>
                <div class="sidebar-logo">
                    <img src="/img/logo2.png" alt="Logo">
                </div>

                @auth
                    @if (auth()->user()->role === 'user')
                        <ul class="sidebar-menu">
                            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                                <a href="{{ url('/dashboard') }}">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="{{ request()->is('profil') ? 'active' : '' }}">
                                <a href="{{ url('/profil') }}">
                                    <i class="fa-solid fa-store"></i>
                                    Usaha
                                </a>
                            </li>
                            <li class="{{ request()->is('produk') ? 'active' : '' }}">
                                <a href="{{ url('/produk') }}">
                                    <i class="fa-solid fa-box"></i>
                                    Produk
                                </a>
                            </li>
                        </ul>
                    @endif

                    @if (auth()->user()->role === 'admin')
                        <ul class="sidebar-menu">
                            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                <a href="{{ url('/dashboard') }}">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/usaha') ? 'active' : '' }}">
                                <a href="{{ url('/admin/usaha') }}">
                                    <i class="fa-solid fa-store"></i>
                                    Usaha
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/produk') ? 'active' : '' }}">
                                <a href="{{ url('/admin/produk') }}">
                                    <i class="fa-solid fa-box"></i>
                                    Produk
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/persetujuan') ? 'active' : '' }}">
                                <a href="{{ url('/admin/persetujuan') }}">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Persetujuan
                                </a>
                            </li>
                        </ul>
                    @endif
                @endauth
            </div>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        style="background:none;border:none;color:#fff;cursor:pointer;width:100%;text-align:left;font-size:14px;font-weight:500;display:flex;align-items:center;gap:12px;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Log Out
                    </button>
                </form>
            </div>

        </aside>

        <main class="main-content">
            @yield('content')
        </main>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const searchInput = document.getElementById('search');
            const tbody = document.getElementById('usaha-body');

            const deleteModal = document.getElementById("deleteModal");
            const successModal = document.getElementById("successModal");
            const confirmDelete = document.getElementById("confirmDelete");
            const cancelDelete = document.getElementById("cancelDelete");

            let deleteUrl = null;
            let selectedRow = null;
            let delay = null;

            searchInput.addEventListener('keyup', function() {

                clearTimeout(delay);

                delay = setTimeout(() => {

                    fetch(`{{ route('admin.usaha') }}?q=${encodeURIComponent(this.value)}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {

                            tbody.innerHTML = '';

                            if (data.length === 0) {
                                tbody.innerHTML = `
                        <tr>
                            <td colspan="6" style="text-align:center;padding:20px">
                                Data tidak ditemukan
                            </td>
                        </tr>`;
                                return;
                            }

                            data.forEach((item, index) => {
                                tbody.innerHTML += `
                        <tr data-id="${item.id}">
                            <td>${index+1}</td>
                            <td>${item.nama_usaha}</td>
                            <td>${item.jenis_usaha}</td>
                            <td>${item.alamat_usaha}</td>
                            <td>
                                <span class="badge-success">
                                    Terdaftar PIRT
                                </span>
                            </td>
                            <td class="action">
                                <a href="javascript:void(0)" class="icon-btn btn-detail">
                                    <img src="/img/eye.png">
                                </a>
                                <a href="javascript:void(0)"
                                   class="icon-btn btn-delete"
                                   data-url="/admin/usaha/${item.id}">
                                    <img src="/img/trash.png">
                                </a>
                            </td>
                        </tr>`;
                            });

                        });

                }, 300);
            });

            document.addEventListener("click", function(e) {

                const deleteBtn = e.target.closest(".btn-delete");
                if (!deleteBtn) return;

                deleteUrl = deleteBtn.dataset.url;
                selectedRow = deleteBtn.closest("tr");

                deleteModal.style.display = "flex";
            });

            cancelDelete.addEventListener("click", function() {
                deleteModal.style.display = "none";
            });

            confirmDelete.addEventListener("click", function() {

                fetch(deleteUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {

                            if (selectedRow) selectedRow.remove();

                            deleteModal.style.display = "none";
                            successModal.style.display = "flex";

                            setTimeout(() => {
                                successModal.style.display = "none";
                            }, 1500);
                        }

                    });

            });

            window.addEventListener("click", function(e) {
                if (e.target === deleteModal) deleteModal.style.display = "none";
                if (e.target === successModal) successModal.style.display = "none";
            });

        });
    </script>

</body>

</html>
