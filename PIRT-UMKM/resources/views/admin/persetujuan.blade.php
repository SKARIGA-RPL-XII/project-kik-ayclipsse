@extends('layouts.app')

@section('title', 'Produk Usaha')

@section('content')

    <div class="page-header">
        <h1>Persetujuan</h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="card">

        <div class="table-card">
            <div class="approval-top">
                <div class="tab-wrapper">
                    <button class="tab-btn active">Tabel Usaha</button>
                    <button class="tab-btn">Tabel Produk</button>
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

                    <tbody id="tableBody">
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
                                <a href="javascript:void(0)" class="icon-btn btn-delete" data-id="1">
                                    <img src="{{ asset('img/trash.png') }}">
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-overlaydelete" id="deleteModal">
                <div class="modal-boxdelete">

                    <div class="modal-icondelete warning">
                        !
                    </div>

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

                    <div class="modal-icondelete success">
                        🗑
                    </div>

                    <h3>Berhasil menghapus data</h3>
                    <p>Data telah dihapus secara permanen</p>

                </div>
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
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const searchInput = document.getElementById("searchInput");
            const refreshBtn = document.getElementById("refreshBtn");

            function getRows() {
                return document.querySelectorAll("#tableBody tr");
            }

            if (searchInput) {
                searchInput.addEventListener("input", function() {
                    const keyword = this.value.toLowerCase();
                    const rows = getRows();

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(keyword) ? "" : "none";
                    });
                });
            }

            if (refreshBtn) {
                refreshBtn.addEventListener("click", function() {
                    searchInput.value = "";

                    const rows = getRows();
                    rows.forEach(row => {
                        row.style.display = "table-row";
                    });
                });
            }


            let selectedRow = null;

            const deleteModal = document.getElementById("deleteModal");
            const successModal = document.getElementById("successModal");
            const confirmDelete = document.getElementById("confirmDelete");
            const cancelDelete = document.getElementById("cancelDelete");

            document.addEventListener("click", function(e) {

                const deleteBtn = e.target.closest(".btn-delete");
                if (deleteBtn) {
                    selectedRow = deleteBtn.closest("tr");
                    deleteModal.style.display = "flex";
                }

                if (e.target === deleteModal) {
                    deleteModal.style.display = "none";
                }

                if (e.target === successModal) {
                    successModal.style.display = "none";
                }
            });

            if (cancelDelete) {
                cancelDelete.addEventListener("click", function() {
                    deleteModal.style.display = "none";
                });
            }

            if (confirmDelete) {
                confirmDelete.addEventListener("click", function() {

                    if (selectedRow) {
                        selectedRow.remove();
                    }

                    deleteModal.style.display = "none";
                    successModal.style.display = "flex";

                    setTimeout(() => {
                        successModal.style.display = "none";
                    }, 1500);

                });
            }

        });
    </script>



@endsection
