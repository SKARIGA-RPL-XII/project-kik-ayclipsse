@extends('layouts.app')

@section('title', 'Produk Usaha')

@section('content')

    <div class="page-header">
        <h1>Persetujuan</h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="card">
        <div class="table-card">

            <!-- TOP BAR -->
            <div class="approval-top">
                <div class="tab-wrapper">
                    <a href="{{ route('admin.persetujuan', ['type' => 'usaha']) }}"
                        class="tab-btn {{ $type === 'usaha' ? 'active' : '' }}">
                        Tabel Usaha
                    </a>

                    <a href="{{ route('admin.persetujuan', ['type' => 'produk']) }}"
                        class="tab-btn {{ $type === 'produk' ? 'active' : '' }}">
                        Tabel Produk
                    </a>
                </div>


                <div class="search-wrapper">
                    <div class="search-input">
                        <img src="{{ asset('img/search.png') }}" class="search-icon">
                        <input type="text" id="searchInput" placeholder="Cari Data...">
                    </div>

                    <button type="button" class="refresh-btn" id="refreshBtn">
                        <img src="{{ asset('img/refresh.png') }}">
                    </button>
                </div>


            </div>

            <!-- TABLE -->
            <div class="table-container">
                <table class="custom-table" id="tableBody">
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
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                @if ($type === 'usaha')
                                    <td>{{ $item->nama_usaha }}</td>
                                    <td>-</td>
                                    <td>{{ $item->jenis_usaha }}</td>
                                @else
                                    <td>{{ $item->usaha->nama_usaha }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->usaha->jenis_usaha }}</td>
                                @endif

                                <td>
                                    @if ($item->status == 'disetujui')
                                        <span class="badge-success">Disetujui</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge-rejected">Ditolak</span>
                                    @else
                                        <span class="badge-warning">Menunggu</span>
                                    @endif
                                </td>

                                <td>
                                    <!-- Tombol buka modal -->
                                    <button class="btn-approval" data-id="{{ $item->id }}"
                                        data-type="{{ $type }}">
                                        Approve
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <div class="modal-overlay" id="approvalModal">
        <div class="modal-box">
            <h3>Konfirmasi Persetujuan</h3>

            <form id="approvalForm" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-actions">
                    <button type="submit" name="status" value="disetujui" class="btn-setuju">
                        Setujui
                    </button>

                    <button type="submit" name="status" value="ditolak" class="btn-tolak">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal-overlaydelete" id="deleteModal">
        <div class="modal-boxdelete">
            <div class="modal-icondelete warning">!</div>
            <h3>Yakin ingin menghapus data ini?</h3>
            <p>Data yang sudah dihapus tidak dapat dikembalikan.</p>
            <div class="modal-actionsdelete">
                <button class="btn-cancel" id="cancelDelete">Cancel</button>
                <button class="btn-submit" id="confirmDelete">Submit</button>
            </div>
        </div>
    </div>

    <div class="modal-overlaydelete" id="successModal">
        <div class="modal-boxdelete">
            <div class="modal-icondelete success">🗑</div>
            <h3>Berhasil menghapus data</h3>
            <p>Data telah dihapus secara permanen</p>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-detail">
            <h2>Detail Perubahan Usaha</h2>
            <hr>

            <div class="form-group">
                <label>Nama Usaha</label>
                <input type="text" id="modalNama" readonly>
            </div>

            <div class="form-group">
                <label>Nama Produk</label>
                <textarea id="modalAlamat" rows="3" readonly></textarea>
            </div>

            <div class="form-group">
                <label>Jenis Produk</label>
                <input type="text" id="modalJenis" readonly>
            </div>

            <div class="modal-actions">
                <button class="btn-tolak" id="btnTolak">Tolak</button>
                <button class="btn-setuju" id="btnSetuju">Setujui</button>
            </div>
        </div>
    </div>

    <style>
        /* ===== TABLE STYLE ===== */
        .table-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
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
            color: #fff;
        }

        .custom-table th,
        .custom-table td {
            padding: 10px;
            text-align: center;
        }

        .custom-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .badge-success {
            background: #dcfce7;
            color: #16a34a;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
        }

        .badge-warning {
            background: #eef2f7;
            color: #475569;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
        }

        .badge-approved {
            background: #dcfce7;
            color: #16a34a;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #dc2626;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
        }

        .action {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .icon-btn {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            cursor: pointer;
        }

        .icon-btn:hover {
            background: #e5e7eb;
        }

        .icon-btn img {
            width: 16px;
        }

        /* ===== MODAL STYLE ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-detail {
            background: #fff;
            width: 700px;
            max-width: 95%;
            padding: 25px;
            border-radius: 12px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            background: #e5e7eb;
            border-radius: 6px;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-tolak {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid red;
            background: #fff;
            color: red;
            cursor: pointer;
        }

        .btn-setuju {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            border: none;
            background: green;
            color: #fff;
            cursor: pointer;
        }

        /* DELETE MODAL */
        .modal-overlaydelete {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-boxdelete {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
        }

        .modal-icondelete {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .modal-icondelete.warning {
            background: #fde68a;
            color: #f59e0b;
        }

        .modal-icondelete.success {
            background: #fecaca;
            color: #dc2626;
        }

        .modal-actionsdelete {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-cancel {
            padding: 8px 18px;
            border-radius: 8px;
            border: 1px solid #ef4444;
            background: #fff;
            color: #ef4444;
        }

        .btn-submit {
            padding: 8px 18px;
            border-radius: 8px;
            border: none;
            background: #083b6f;
            color: #fff;
        }

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

        .tab-wrapper {
            display: flex;
            gap: 10px;
        }

        .tab-btn {
            padding: 8px 18px;
            border-radius: 6px;
            border: 1px solid #0b2e5b;
            background: #fff;
            cursor: pointer;
        }

        .tab-btn.active {
            background: #0b2e5b;
            color: #fff;
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
        }

        .badge-warning::before {
            content: "⟳";
            border: 1px solid #94a3b8;
            border-radius: 9999px;
            padding: 2px 4px;
            font-size: 8px;
        }

        .action {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
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

        .modal-overlaydelete {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-boxdelete {
            background: #fff;
            width: 400px;
            padding: 30px;
            border-radius: 14px;
            text-align: center;
        }

        .modal-icondelete {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .modal-icondelete.warning {
            background: #fde68a;
            color: #f59e0b;
        }

        .modal-icondelete.success {
            background: #fecaca;
            color: #dc2626;
        }

        .modal-actionsdelete {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .btn-cancel {
            padding: 8px 18px;
            border-radius: 8px;
            border: 1px solid #ef4444;
            background: #fff;
            color: #ef4444;
            cursor: pointer;
        }

        .btn-submit {
            padding: 8px 18px;
            border-radius: 8px;
            border: none;
            background: #083b6f;
            color: #fff;
            cursor: pointer;
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

        .modal-detail {
            background: #ffffff;
            width: 800px;
            max-width: 95%;
            padding: 24px;
            border-radius: 12px;
        }

        .modal-detail h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .modal-detail hr {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: none;
            background: #e5e7eb;
            font-size: 14px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const searchInput = document.getElementById("searchInput");
            const refreshBtn = document.getElementById("refreshBtn");
            const tbody = document.querySelector(".custom-table tbody");
            const tabs = document.querySelectorAll(".tab-btn");

            let currentType = "{{ $type }}";
            let debounceTimer;

            function loadData(keyword = "") {

                fetch(`{{ route('admin.persetujuan') }}?type=${currentType}&q=${keyword}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        tbody.innerHTML = "";

                        if (data.length === 0) {
                            tbody.innerHTML = `
                    <tr>
                        <td colspan="6">Tidak ada data</td>
                    </tr>
                `;
                            return;
                        }

                        data.forEach((item, index) => {

                            let badge = "";

                            if (item.status === "disetujui") {
                                badge = `<span class="badge-success">Disetujui</span>`;
                            } else if (item.status === "ditolak") {
                                badge = `<span class="badge-rejected">Ditolak</span>`;
                            } else {
                                badge = `<span class="badge-warning">Menunggu</span>`;
                            }

                            tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama_usaha}</td>
                        <td>${item.nama_produk}</td>
                        <td>${item.jenis}</td>
                        <td>${badge}</td>
                        <td>
                            <button class="btn-approval"
                                data-id="${item.id}"
                                data-type="${item.type}">
                                Approve
                            </button>
                        </td>
                    </tr>
                `;
                        });

                    });
            }

            // 🔥 SEARCH REALTIME (DEBOUNCE biar halus)
            searchInput.addEventListener("keyup", function() {

                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {
                    loadData(this.value);
                }, 300); // delay 300ms
            });

            // 🔄 REFRESH
            refreshBtn.addEventListener("click", function() {
                searchInput.value = "";
                loadData();
            });

            // 🔁 TAB SWITCH REALTIME
            tabs.forEach(tab => {
                tab.addEventListener("click", function(e) {
                    e.preventDefault();

                    tabs.forEach(t => t.classList.remove("active"));
                    this.classList.add("active");

                    currentType = this.textContent.includes("Produk") ? "produk" : "usaha";

                    loadData(searchInput.value);
                });
            });

        });
    </script>
    >

@endsection
