@extends('layouts.app')

@section('title', 'Produk Usaha')

@section('content')

    <div class="page-header">
        <h1>Selamat Datang Kembali <span>Raysha!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="card">

        <div class="table-card">

            <div class="approval-top">
                <div class="search-wrapper">
                    <div class="search-input">
                        <img src="{{ asset('img/search.png') }}" class="search-icon">
                        <input type="text" id="search" placeholder="Cari Data...">
                    </div>

                    <button type="button" class="refresh-btn" id="refreshBtn">
                        <img src="{{ asset('img/refresh.png') }}">
                    </button>
                </div>
            </div>



            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo Produk</th>
                            <th>Nama Produk</th>
                            <th>Jenis Produk</th>
                            <th>Komposisi</th>
                            <th>Berat Bersih</th>
                            <th>Kemasan</th>
                            <th>Verifikasi</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="produk-body">
                        @forelse ($produk as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->usaha->jenis_usaha ?? '-' }}</td>
                                <td>{{ $item->komposisi }}</td>
                                <td>{{ $item->berat_bersih }} gr</td>
                                <td>{{ $item->kemasan }}</td>
                                <td>
                                    @php
                                        $verifikasi = $item->dokumen->first()?->verifikasi;
                                    @endphp

                                    @if ($verifikasi && $verifikasi->hasil_verifikasi === 'disetujui')
                                        <span class="badge-success">Terdaftar PIRT</span>
                                    @else
                                        <span class="badge-warning">Menunggu persetujuan</span>
                                    @endif

                                </td>
                                <td class="action">
                                    <a href="javascript:void(0)" class="icon-btn btn-edit-produk"
                                        data-id="{{ $item->id }}">
                                        <img src="{{ asset('img/eye.png') }}">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;padding:20px">
                                    Tidak ada data produk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

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

    <div class="modal-overlay" id="editProdukModal">
        <div class="modal-edit-produk">

            <div class="modal-header">
                <h2>Detail Produk Usaha</h2>
                <small>Produk Usaha › Detail Produk</small>
            </div>

            <div class="detail-grid">
                <div>Nama Usaha</div>
                <div>: <span id="m-nama-usaha"></span></div>

                <div>Nama Produk</div>
                <div>: <span id="m-nama-produk"></span></div>

                <div>Jenis Produk</div>
                <div>: <span id="m-jenis-produk"></span></div>

                <div>Komposisi</div>
                <div class="komposisi" id="m-komposisi"></div>

                <div>Berat Bersih</div>
                <div>: <span id="m-berat"></span> gr</div>

                <div>Kemasan</div>
                <div>: <span id="m-kemasan"></span></div>

                <div>Verifikasi</div>
                <div id="m-verifikasi"></div>

                <div>Tanggal Input</div>
                <div>: <span id="m-tanggal"></span></div>
            </div>

        </div>
    </div>



    <style>
        .table-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 16px;
            margin-top: 16px;
        }

        .table-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            gap: 12px;
        }

        .approval-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-input {
            position: relative;
        }

        .search-input input {
            width: 260px;
            height: 38px;
            padding: 0 14px 0 40px;
            border-radius: 6px;
            border: 1px solid #0b2e5b;
            outline: none;
            font-size: 13px;
            color: #374151;
        }

        .search-input input::placeholder {
            color: #9ca3af;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            opacity: 0.8;
        }

        .refresh-btn {
            width: 38px;
            height: 38px;
            border-radius: 6px;
            border: 1px solid #0b2e5b;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .refresh-btn img {
            width: 16px;
        }

        .refresh-btn:hover {
            background: #f1f5f9;
        }

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

        .table-container {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
        }

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

        .badge-success {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            font-size: 11px;
            border-radius: 20px;
            background: #e6f9ec;
            color: #16a34a;
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
        }

        .badge-warning::before {
            content: "⏳";
        }

        .action {
            font-size: 14px;
            white-space: nowrap;
        }

        .table-footer {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #6b7280;
        }

        .action {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

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

        .showing {
            display: flex;
            align-items: center;
            gap: 6px;
        }

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

        .pagination-wrapper {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .per-page {
            font-size: 13px;
            color: #6b7280;
        }


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

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-edit-produk {
            background: #ffffff;
            width: 820px;
            max-width: 95%;
            padding: 24px;
            border-radius: 10px;
        }

        .modal-edit-produk h2 {
            font-size: 18px;
            font-weight: 700;
            color: #083b6f;
        }

        .modal-subtitle {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 16px;
        }

        .modal-card {
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
        }

        .modal-card h3 {
            font-size: 18px;
            margin-bottom: 12px;
        }

        .modal-card h3 span {
            font-size: 12px;
            color: #64748b;
            margin-left: 6px;
        }

        .modal-header h2 {
            font-size: 20px;
            color: #083b6f;
        }

        .modal-header small {
            color: #64748b;
        }

        .usaha-header {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .avatar {
            width: 56px;
            height: 56px;
            background: #d1d5db;
            border-radius: 50%;
        }

        .usaha-info {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 6px 12px;
            font-size: 13px;
        }

=        .btn-detail-produk {
            margin-top: 16px;
            background: #083b6f;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-edit-table {
            background: #16a34a;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 8px 12px;
            font-size: 13px;
            color: #374151;
        }

        .komposisi {
            line-height: 1.6;
        }

        /* SECTION ROW INSPEKSI */
        .inspeksi-table .section {
            background: #f1f5f9;
            font-weight: 700;
        }

        .inspeksi-table td:nth-child(1),
        .inspeksi-table td:nth-child(3),
        .inspeksi-table td:nth-child(4),
        .inspeksi-table td:nth-child(5) {
            text-align: center;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const searchInput = document.getElementById('search');
            const refreshBtn = document.getElementById('refreshBtn');
            const tbody = document.getElementById('produk-body');

            function loadData(keyword = '') {
                fetch(`{{ route('admin.produk') }}?q=${keyword}`, {
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
                        <td colspan="8" style="text-align:center;padding:20px">
                            Data tidak ditemukan
                        </td>
                    </tr>`;
                            return;
                        }

                        data.forEach((item, index) => {
                            tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama_produk}</td>
                        <td>${item.jenis_usaha}</td>
                        <td>${item.komposisi}</td>
                        <td>${item.berat_bersih} gr</td>
                        <td>${item.kemasan}</td>
                        <td>
                            ${
                                item.verifikasi === 'disetujui'
                                ? '<span class="badge-success">Terdaftar PIRT</span>'
                                : '<span class="badge-warning">Menunggu persetujuan</span>'
                            }
                        </td>
                        <td class="action">
                            <a href="javascript:void(0)"
                               class="icon-btn btn-edit-produk"
                               data-id="${item.id}">
                                <img src="{{ asset('img/eye.png') }}">
                            </a>
                        </td>
                    </tr>`;
                        });

                    });
            }

            searchInput.addEventListener('keyup', function() {
                loadData(this.value);
            });

            refreshBtn.addEventListener('click', function() {
                searchInput.value = '';
                loadData();
            });

        });
    </script>




@endsection
