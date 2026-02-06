@extends('layouts.app')

@section('title', 'Produk Usaha')

@section('content')

    <div class="page-header">
        <h1>Selamat Datang Kembali <span>Raysha!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="card">

        <div class="table-card">
            <!-- TABLE HEADER -->
            <div class="table-header">
                <button class="nav-btn">
                    ‹
                </button>

                <h3>Tabel Usaha</h3>

                <button class="nav-btn">
                    ›
                </button>
            </div>

            <!-- TOP BAR -->
            <div class="table-top">
                <div class="search-wrapper">
                    <img src="{{ asset('img/search.png') }}" class="search-icon" alt="search">
                    <input type="text" placeholder="Cari Data...">
                </div>
            </div>


            <!-- TABLE -->
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Nama Produk</th>
                            <th>Jenis Produk</th>
                            <th>Verifikasi</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DAPUR NUSANTARA</td>
                            <td>Jamu Temulawak</td>
                            <td>Minuman</td>
                            <td>
                                <span class="badge-success">Terdaftar PIRT</span>
                            </td>
                            <td class="action">
                                <a href="#" class="icon-btn">
                                    <img src="{{ asset('img/eye.png') }}">
                                </a>
                                <a href="#" class="icon-btn">
                                    <img src="{{ asset('img/trash.png') }}">
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>CEMALICIOUS</td>
                            <td>Keripik Singkong Original</td>
                            <td>Makanan</td>
                            <td>
                                <span class="badge-warning">Menunggu persetujuan</span>
                            </td>
                            <td class="action">
                                <a href="#" class="icon-btn">
                                    <img src="{{ asset('img/edit-2.png') }}">
                                </a>
                                <a href="#" class="icon-btn">
                                    <img src="{{ asset('img/trash.png') }}">
                                </a>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <!-- FOOTER -->
            <div class="table-footer">
                <div class="showing">
                    Showing
                    <span class="showing-count">
                        5 <span class="caret">▾</span>
                    </span>
                    data out of 20
                </div>

                <div class="pagination-wrapper">
                    <span class="per-page">Data per page</span>

                    <div class="pagination">
                        <button class="nav">‹</button>

                        <button class="active">1</button>
                        <button class="page">2</button>
                        <span class="dots">…</span>
                        <button class="page">5</button>

                        <button class="nav">›</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    </div>


    <style>
        /* CARD */
        .table-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 16px;
            margin-top: 16px;
        }

        /* =====================
                               TOP BAR
                            ===================== */
        .table-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            gap: 12px;
        }

        /* SEARCH */
        .search-wrapper {
            position: relative;
            flex: 1;
            max-width: 620px;
            gap: 5px;
        }

        .search-wrapper input {
            width: 100%;
            height: 40px;
            padding: 0 14px 0 42px;
            font-size: 14px;
            border: 1px solid #374151;
            border-radius: 5px;
            outline: none;
            color: #374151;
            flex: 1;
        }

        .search-wrapper input::placeholder {
            color: #9ca3af;
        }

        /* ICON SEARCH */
        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            opacity: 0.9;
        }

        /* =====================
                               BUTTON TAMBAH
                            ===================== */
        .btn-primary {
            height: 40px;
            background: #083b6f;
            color: #ffffff;
            border: none;
            padding: 0 18px;
            font-size: 13px;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: #062f57;
        }

        /* =====================
       TABLE HEADER
    ===================== */
        .table-header {
            background: #e9eef3;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 14px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            color: #000000;
        }

        /* NAV BUTTON */
        .nav-btn {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            background: #083b6f;
            color: #ffffff;
            border: none;
            font-size: 18px;
            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-btn:hover {
            background: #062f57;
        }

        /* TABLE CONTAINER */
        .table-container {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
        }

        /* TABLE */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;

        }

        .custom-table thead {
            background: #083b6f;
            color: #ffffff;
        }

        .custom-table th {
            padding: 12px 8px;
            font-weight: 500;
            text-align: center;
        }

        .custom-table td {
            padding: 10px 8px;
            text-align: center;
            color: #374151;
        }

        .custom-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .custom-table tbody tr:last-child {
            border-bottom: none;
        }


        /* BADGE */
        .badge-success {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            font-size: 11px;
            border-radius: 20px;
            background: #e6f9ec;
            color: #16a34a;
            /* border: 1px solid #16a34a; */
        }

        .badge-success::before {
            border: 1px solid #16a34a;
            border-radius: 9999px;
            padding: 2px 4px;
            content: "✓";
            font-weight: 700;
            font-size: 8px;
        }

        .badge-warning {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            font-size: 11px;
            border-radius: 20px;
            background: #eef2f7;
            color: #475569;
            /* border: 1px solid #cbd5e1; */
        }

        .badge-warning::before {
            content: "⟳";
            border: 1px solid #94a3b8;
            border-radius: 9999px;
            padding: 2px 4px;
            font-size: 8px;
        }


        /* ACTION */
        .action {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }


        /* FOOTER */
        .table-footer {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #6b7280;
        }

        /* ACTION ICON */
        .action {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* ICON BUTTON */
        .icon-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .icon-btn:hover {
            background: #e5e7eb;
        }

        .icon-btn img {
            width: 16px;
            height: 16px;
        }

        .table-footer {
            margin-top: 12px;
            padding: 14px 16px;
            background: #f5f6f8;
            border-radius: 8px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            font-size: 13px;
            color: #6b7280;
        }

        /* SHOWING TEXT */
        .showing {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* DROPDOWN NUMBER */
        .showing-count {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #374151;
            font-weight: 500;
        }

        .caret {
            font-size: 10px;
            color: #6b7280;
        }

        /* =====================
                                       PAGINATION WRAPPER
                                    ===================== */
        .pagination-wrapper {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .per-page {
            font-size: 13px;
            color: #6b7280;
        }


        /* PAGINATION */
        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pagination button {
            border: none;
            background: transparent;
            font-size: 12px;
            cursor: pointer;
            color: #083b6f;
            padding: 0;
        }

        .pagination .page {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #003366;
            color: #003366;
            font-size: 12px;
            font-weight: 500;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .active {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #003366;
            color: #ffffff;
            font-weight: 500;
        }

        .pagination .nav {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #083b6f;
            color: #ffffff;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .dots {
            font-size: 12px;
            color: #083b6f;
        }

        .pagination .page:hover {
            background: #003366;
            color: #ffffff;
        }
    </style>
@endsection
