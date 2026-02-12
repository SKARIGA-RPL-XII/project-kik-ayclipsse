@extends('layouts.app')

@section('title', 'Usaha')

@section('content')
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

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            opacity: 0.9;
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

        .btn-detail-produk {
            margin-top: 16px;
            background: #083b6f;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
        }

        .badge-danger {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            font-size: 11px;
            border-radius: 20px;
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-danger::before {
            content: "✕";
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
    <div class="page-header">
        <h1>Selamat Datang Kembali <span>Raysha!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="card">
        <div class="table-card">

            <div class="table-top">
                <div class="search-wrapper">
                    <img src="{{ asset('img/search.png') }}" class="search-icon">
                    <input type="text" id="search" placeholder="Cari nama, jenis, alamat..." autocomplete="off">
                </div>
            </div>

            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Jenis Usaha</th>
                            <th>Alamat Usaha</th>
                            <th>Status</th>
                            <th width="120"></th>
                        </tr>
                    </thead>

                    <tbody id="usaha-body">
                        @foreach ($usaha as $i => $item)
                            <tr data-id="{{ $item->id }}">
                                <td>{{ $usaha->firstItem() + $i }}</td>
                                <td>{{ $item->nama_usaha }}</td>
                                <td>{{ $item->jenis_usaha }}</td>
                                <td>{{ $item->alamat_usaha }}</td>
                                <td>
                                    @if ($item->status === 'disetujui')
                                        <span class="badge-success">Terdaftar PIRT</span>
                                    @elseif ($item->status === 'ditolak')
                                        <span class="badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge-warning">Menunggu Persetujuan</span>
                                    @endif
                                </td>

                                <td class="action">
                                    <a href="javascript:void(0)" class="icon-btn btn-detail">
                                        <img src="{{ asset('img/eye.png') }}">
                                    </a>
                                    <a href="javascript:void(0)" class="icon-btn btn-delete"
                                        data-url="{{ route('admin.usaha.destroy', $item->id) }}">
                                        <img src="{{ asset('img/trash.png') }}">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="modal-overlay" id="deleteModal">
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

    <div class="modal-overlay" id="successModal">
        <div class="modal-boxdelete">
            <div class="modal-icondelete success">🗑</div>
            <h3>Berhasil menghapus data</h3>
            <p>Data telah dihapus secara permanen</p>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const searchInput = document.getElementById('search');
            const tbody = document.getElementById('usaha-body');

            const deleteModal = document.getElementById("deleteModal");
            const successModal = document.getElementById("successModal");
            const confirmDelete = document.getElementById("confirmDelete");
            const cancelDelete = document.getElementById("cancelDelete");

            let selectedUrl = null;
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
                                <span class="badge-success">Terdaftar PIRT</span>
                            </td>
                            <td class="action">
                                <a href="javascript:void(0)"
                                   class="icon-btn btn-delete"
                                   data-url="/admin/usaha/${item.id}">
                                    <img src="/img/trash.png">
                                </a>
                            </td>
                        </tr>
                    `;
                            });

                        });

                }, 300);
            });

            document.addEventListener("click", function(e) {

                const deleteBtn = e.target.closest(".btn-delete");
                if (deleteBtn) {

                    selectedUrl = deleteBtn.dataset.url;
                    selectedRow = deleteBtn.closest("tr");

                    deleteModal.style.display = "flex";
                }

            });

            cancelDelete.addEventListener("click", function() {
                deleteModal.style.display = "none";
            });

            confirmDelete.addEventListener("click", function() {

                fetch(selectedUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {

                            if (selectedRow) {
                                selectedRow.remove();
                            }

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

@endsection
