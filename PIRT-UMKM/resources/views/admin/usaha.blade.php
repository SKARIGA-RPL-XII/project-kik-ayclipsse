@extends('layouts.app')

@section('title', 'Produk Usaha')

@section('content')
    <div class="page-header">
        <h1>Selamat Datang Kembali <span>Raysha!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="card">

        <div class="table-card">

            <!-- TOP BAR -->
            <div class="table-top">
                <div class="search-wrapper">
                    <img src="{{ asset('img/search.png') }}" class="search-icon">
                    <input type="text" id="search" placeholder="Cari nama, jenis, alamat..." autocomplete="off">
                </div>
            </div>

            <!-- TABLE -->
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Jenis Usaha</th>
                            <th>Alamat Usaha</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="usaha-body">
                        @forelse ($usaha as $i => $item)
                            <tr>
                                <td>{{ $usaha->firstItem() + $i }}</td>
                                <td>{{ $item->nama_usaha }}</td>
                                <td>{{ $item->jenis_usaha }}</td>
                                <td>{{ $item->alamat_usaha }}</td>
                                <td>
                                    <span class="badge-success">Terdaftar PIRT</span>
                                </td>
                                <td class="action">
                                    <a href="javascript:void(0)" class="icon-btn">
                                        <img src="{{ asset('img/eye.png') }}">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;padding:20px">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- FOOTER -->
            <div class="table-footer">
                <div class="showing">
                    Showing {{ $usaha->count() }} of {{ $usaha->total() }} data
                </div>

                <div class="pagination">
                    {{-- PREV --}}
                    @if ($usaha->onFirstPage())
                        <button class="nav" disabled>‹</button>
                    @else
                        <a href="{{ $usaha->previousPageUrl() }}" class="nav">‹</a>
                    @endif

                    {{-- PAGES --}}
                    @foreach ($usaha->getUrlRange(1, $usaha->lastPage()) as $page => $url)
                        @if ($page == $usaha->currentPage())
                            <button class="active">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="page">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- NEXT --}}
                    @if ($usaha->hasMorePages())
                        <a href="{{ $usaha->nextPageUrl() }}" class="nav">›</a>
                    @else
                        <button class="nav" disabled>›</button>
                    @endif
                </div>
            </div>

        </div>

        <!-- MODAL EDIT PRODUK -->
        <div class="modal-overlay" id="editProdukModal">
            <div class="modal-edit-produk">

                <!-- HEADER -->
                <div class="modal-header">
                    <div>
                        <h2>Detail Usaha</h2>
                        <small>Usaha &nbsp;›&nbsp; <strong>Detail Usaha</strong></small>
                    </div>
                </div>

                <!-- CARD DETAIL USAHA -->
                <div class="modal-card usaha-card">
                    <div class="usaha-header">
                        <div class="avatar"></div>
                        <div>
                            <h3>DAPUR NUSANTARA</h3>
                            <span>Makanan / Minuman</span>
                        </div>
                    </div>

                    <div class="usaha-info">
                        <div><strong>Nama Usaha</strong></div>
                        <div>: DAPUR NUSANTARA</div>
                        <div><strong>Alamat Usaha</strong></div>
                        <div>: Jl. Kamboja Atas, RT3/RW4, Pesanggrahan, Kota Batu</div>
                        <div><strong>Jenis Usaha</strong></div>
                        <div>: Makanan / Minuman</div>
                        <div><strong>Produk</strong></div>
                        <div>
                            1. Jamu Temulawak<br>
                            2. Jamu Beras Kencur
                        </div>
                        <div><strong>Izin Usaha</strong></div>
                        <div><span class="badge-success">Izin usaha telah disetujui</span></div>
                        <div><strong>Tanggal Berdiri</strong></div>
                        <div>: 14 Januari 2015</div>
                    </div>

                    <button class="btn-detail-produk">Detail Produk Usaha</button>
                </div>

                <!-- CARD INSPEKSI -->
                <div class="modal-card">
                    <h3>Tabel Inspeksi</h3>

                    <div class="search-wrapper">
                        <input type="text" placeholder="Cari Data...">
                        <button class="btn-edit-table">Edit Tabel</button>
                    </div>

                    <div class="table-container">

                        <table class="custom-table inspeksi-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Variabel / Komponen</th>
                                    <th>Bobot</th>
                                    <th>Pelanggaran</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="section">
                                    <td>A.</td>
                                    <td colspan="4">LOKASI DAN LINGKUNGAN PRODUKSI</td>
                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td>Lokasi dan lingkungan IRTP tidak terawat, kotor dan berdebu</td>
                                    <td>2</td>
                                    <td>Tidak</td>
                                    <td>2</td>
                                </tr>

                                <tr class="section">
                                    <td>B.</td>
                                    <td colspan="4">BANGUNAN DAN FASILITAS</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Ruang produksi sempit, sukar dibersihkan</td>
                                    <td>1</td>
                                    <td>Tidak</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Lantai, dinding, dan langit-langit tidak terawat</td>
                                    <td>3</td>
                                    <td>Ya</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Ventilasi, pintu, dan jendela tidak terawat</td>
                                    <td>2</td>
                                    <td>Tidak</td>
                                    <td>2</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="table-footer">
                        <div class="showing">
                            Showing 5 data out of 20
                        </div>

                        <div class="pagination">
                            <button class="nav">‹</button>
                            <button class="active">1</button>
                            <button class="page">2</button>
                            <span class="dots">…</span>
                            <button class="page">5</button>
                            <button class="nav">›</button>
                        </div>
                    </div>

                    <div class="note" style="margin-top:12px;font-size:12px;line-height:1.6">
                        <strong>Keterangan:</strong><br>
                        Bobot 1 : Risiko rendah<br>
                        Bobot 2 : Risiko sedang<br>
                        Bobot 3 : Risiko tinggi / kritis<br><br>
                        Tanda <strong>Ya</strong> : Kondisi TIDAK memenuhi syarat<br>
                        Tanda <strong>Tidak</strong> : Kondisi memenuhi syarat<br><br>
                        Nilai = Jika Tanda Ya → Nilai = 0<br>
                        Nilai = Jika Tanda Tidak → Nilai = Bobot
                    </div>

                    <div class="note">
                        <small>Keterangan bobot dan penilaian sesuai standar PIRT</small>
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
                content: "⏳";
            }

            /* ACTION */
            .action {
                font-size: 14px;
                white-space: nowrap;
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


            /* =====================
                                                                                                           TABLE FOOTER
                                                                                                        ===================== */
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

            /* =====================
                                                                                       MODAL OVERLAY
                                                                                    ===================== */
            .modal-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.6);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 999;
            }

            /* =====================
                                                                                       MODAL DETAIL PRODUK
                                                                                    ===================== */
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

            /* HEADER MODAL */
            .modal-header h2 {
                font-size: 20px;
                color: #083b6f;
            }

            .modal-header small {
                color: #64748b;
            }

            /* USAHA CARD */
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

            /* BUTTON */
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
            document.addEventListener('click', function(e) {

                // === OPEN MODAL EDIT PRODUK ===
                const editBtn = e.target.closest('.btn-edit-produk');
                if (editBtn) {
                    e.preventDefault();
                    document.getElementById('editProdukModal').style.display = 'flex';
                    return;
                }

                // === CLOSE MODAL KLIK OVERLAY ===
                const modal = e.target.classList.contains('modal-overlay');
                if (modal) {
                    e.target.style.display = 'none';
                }

            });
            const searchInput = document.getElementById('search');
            const tbody = document.getElementById('usaha-body');

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
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.nama_usaha}</td>
                            <td>${item.jenis_usaha}</td>
                            <td>${item.alamat_usaha}</td>
                            <td>
                                <span class="badge-success">Terdaftar PIRT</span>
                            </td>
                            <td class="action">
                                <a href="javascript:void(0)" class="icon-btn">
                                    <img src="{{ asset('img/eye.png') }}">
                                </a>
                            </td>
                        </tr>
                    `;
                            });
                        });
                }, 300);
            });
        </script>


    @endsection
