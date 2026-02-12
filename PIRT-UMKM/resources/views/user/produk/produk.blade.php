@extends('layouts.app')

@section('title', 'Produk Usaha')

@section('content')
    @if (!$usaha || $produk->isEmpty())
        @include('component.empty-dashboard')
    @else
        <div class="page-header">
            <h1>Produk</h1>
            <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
        </div>

        <div class="card">
            <div class="table-card">

                <div class="table-top">
                    <div class="search-wrapper">
                        <div class="search-input">
                            <img src="{{ asset('img/search.png') }}" class="search-icon">
                            <input type="text" id="searchInput" placeholder="Cari Data...">
                        </div>

                        <button type="button" class="refresh-btn" id="refreshBtn">
                            <img src="{{ asset('img/refresh.png') }}">
                        </button>
                    </div>

                    <a href="{{ route('user.produk.pendaftaran') }}" class="btn-add-produk">
                        <span class="icon-plus">+</span>
                        <span>Tambah Produk Usaha Baru</span>
                    </a>
                </div>

                <div class="table-container">
                    <table class="custom-table">
                        <thead>


                            <tr>
                                <th>No</th>
                                <th>Logo Produk</th>
                                <th>Nama Produk</th>
                                <th>Komposisi</th>
                                <th>Berat Bersih</th>
                                <th>Kemasan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="produk-body">
                            @forelse ($produk as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td></td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->komposisi }}</td>
                                    <td>{{ $item->berat_bersih }} gr</td>
                                    <td>{{ $item->kemasan }}</td>

                                    <td>
                                        @if ($item->status === 'disetujui')
                                            <span class="badge-success">Disetujui</span>
                                        @elseif ($item->status === 'ditolak')
                                            <span class="badge-danger">Ditolak</span>
                                        @else
                                            <span class="badge-warning">Menunggu</span>
                                        @endif
                                    </td>

                                    <td class="action">
                                        <a href="#" class="icon-btn open-modal"
                                            data-target="editModal-{{ $item->id }}">
                                            <img src="{{ asset('img/edit-2.png') }}">
                                        </a>

                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="icon-btn" style="border:none;background:none;">
                                                <img src="{{ asset('img/trash.png') }}">
                                            </button>
                                        </form>

                                    </td>
                                </tr>


                                <div class="modal-overlay" id="editModal-{{ $item->id }}">
                                    <div class="modal-edit-produk">
                                        <h2>Edit Produk</h2>

                                        <form method="POST" action="{{ route('produk.usaha.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" name="nama_produk" value="{{ $item->nama_produk }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Komposisi</label>
                                                <textarea name="komposisi" rows="3">{{ $item->komposisi }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Kemasan</label>
                                                <input type="text" name="kemasan" value="{{ $item->kemasan }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Berat Bersih</label>
                                                <input type="number" name="berat_bersih"
                                                    value="{{ $item->berat_bersih }}">
                                            </div>

                                            <div class="modal-action">
                                                <a href="#" class="btn-cancel close-modal">Batal</a>
                                                <button type="submit" class="btn-submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="8" style="text-align:center; padding:20px;">
                                        Belum ada produk
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="modal-delete" id="deleteModal">
            <div class="modal-card">

                <div class="modal-icon warning">
                    <div class="icon-circle">
                        !
                    </div>
                </div>

                <h3>Yakin ingin menghapus data ini?</h3>
                <p>Data yang sudah dihapus tidak dapat dikembalikan.</p>

                <div class="modal-actions">
                    <button class="btn-cancel" id="cancelDelete">Cancel</button>
                    <button class="btn-submit" id="confirmDelete">Submit</button>
                </div>

            </div>
        </div>

        <div class="modal-delete" id="successModal">
            <div class="modal-card">

                <div class="modal-icon success">
                    <div class="icon-circle">
                        🗑
                    </div>
                </div>

                <h3>Berhasil menghapus data</h3>
                <p>Data telah dihapus secara permanen</p>

            </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const searchInput = document.getElementById("searchInput");
                const refreshBtn = document.getElementById("refreshBtn");

                function getRows() {
                    return document.querySelectorAll("#produk-body tr");
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
                        getRows().forEach(row => row.style.display = "table-row");
                    });
                }

                document.addEventListener('click', function(e) {

                    const openBtn = e.target.closest('.open-modal');
                    if (openBtn) {
                        e.preventDefault();
                        const target = openBtn.dataset.target;
                        const modal = document.getElementById(target);
                        if (modal) modal.style.display = 'flex';
                        return;
                    }

                    const closeBtn = e.target.closest('.close-modal');
                    if (closeBtn) {
                        e.preventDefault();
                        closeBtn.closest('.modal-overlay').style.display = 'none';
                        return;
                    }

                    if (e.target.classList.contains('modal-overlay')) {
                        e.target.style.display = 'none';
                    }
                });

                let selectedId = null;
                let selectedRow = null;

                document.addEventListener("click", function(e) {

                    const deleteBtn = e.target.closest(".btn-delete");
                    if (deleteBtn) {
                        selectedId = deleteBtn.dataset.id;
                        selectedRow = deleteBtn.closest("tr");
                        deleteModal.style.display = "flex";
                        return;
                    }

                    if (e.target === deleteModal) deleteModal.style.display = "none";
                    if (e.target === successModal) successModal.style.display = "none";
                });

                cancelDelete.addEventListener("click", function() {
                    deleteModal.style.display = "none";
                });

                confirmDelete.addEventListener("click", function() {

                    fetch(`/produk/${selectedId}`, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                selectedRow.remove();
                                deleteModal.style.display = "none";
                                successModal.style.display = "flex";

                                setTimeout(() => {
                                    successModal.style.display = "none";
                                }, 1500);
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });

            });
        </script>

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

            .btn-add-produk {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                height: 42px;
                padding: 0 18px;
                background: linear-gradient(135deg, #083b6f, #0d4f8b);
                color: #ffffff;
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                border-radius: 8px;
                transition: all 0.25s ease;
                box-shadow: 0 4px 10px rgba(8, 59, 111, 0.25);
            }

            .btn-add-produk:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(8, 59, 111, 0.35);
                background: linear-gradient(135deg, #062f57, #083b6f);
            }

            .icon-plus {
                font-size: 20px;
                font-weight: 400;
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

            .modal-delete {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.75);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            .modal-card {
                width: 420px;
                background: #ffffff;
                padding: 40px 30px;
                border-radius: 20px;
                text-align: center;
                animation: fadeScale 0.25s ease;
            }

            .modal-icon {
                margin-bottom: 20px;
                display: flex;
                justify-content: center;
            }

            .icon-circle {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                font-weight: bold;
            }

            .modal-icon.warning .icon-circle {
                background: #fff3e0;
                color: #f59e0b;
                box-shadow: 0 0 0 12px rgba(245, 158, 11, 0.15);
            }

            .modal-icon.success .icon-circle {
                background: #ffe4e6;
                color: #dc2626;
                box-shadow: 0 0 0 12px rgba(220, 38, 38, 0.15);
            }

            .modal-card h3 {
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 8px;
                color: #111827;
            }

            .modal-card p {
                font-size: 13px;
                color: #6b7280;
                margin-bottom: 25px;
            }

            .modal-actions {
                display: flex;
                justify-content: center;
                gap: 14px;
            }

            .btn-cancel {
                padding: 10px 22px;
                border-radius: 10px;
                border: 1px solid #ef4444;
                background: #ffffff;
                color: #ef4444;
                font-weight: 500;
                cursor: pointer;
                transition: 0.2s ease;
            }

            .btn-cancel:hover {
                background: #fee2e2;
            }

            .btn-submit {
                padding: 10px 22px;
                border-radius: 10px;
                border: none;
                background: #0b2e5b;
                color: #ffffff;
                font-weight: 500;
                cursor: pointer;
                transition: 0.2s ease;
            }

            .btn-submit:hover {
                background: #082547;
            }

            @keyframes fadeScale {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
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
                width: 700px;
                max-width: 95%;
                padding: 24px;
                border-radius: 8px;
            }

            .modal-edit-produk h2 {
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 20px;
                color: #083b6f;
            }

            .modal-edit-produk .form-group {
                margin-bottom: 14px;
            }

            .modal-edit-produk label {
                display: block;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 6px;
                color: #083b6f;
            }

            .modal-edit-produk input,
            .modal-edit-produk textarea {
                width: 100%;
                padding: 10px 12px;
                border-radius: 6px;
                border: none;
                background: #e5e7eb;
                font-size: 13px;
                color: #374151;
            }

            .modal-edit-produk .btn-submit {
                margin-top: 18px;
                width: 100%;
                background: #083b6f;
                color: #ffffff;
                border: none;
                padding: 12px;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
            }

            .btn-cancel {
                display: inline-block;
                margin-top: 12px;
                color: #ef4444;
                text-decoration: none;
            }
        </style>
    @endif
@endsection
