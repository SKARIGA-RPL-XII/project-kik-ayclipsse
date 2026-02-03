@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>Selamat Datang Kembali <span>Raysha!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="business-card">
        <div class="business-left">
            <div class="business-avatar"></div>

            <div class="business-info">
                <h2>JAMU DJENG NITA</h2>
                <span class="category">Makanan / Minuman</span>

                <table>
                    <tr>
                        <td>Nama Usaha</td>
                        <td>: DAPUR NUSANTARA</td>
                    </tr>
                    <tr>
                        <td>Alamat Usaha</td>
                        <td>: Jl. Kamboja Atas, RT3/RW4, Pesanggrahan, Kec. Batu, Kota Batu, Jawa Timur 65313</td>
                    </tr>
                    <tr>
                        <td>Jenis Usaha</td>
                        <td>: Makanan/Minuman</td>
                    </tr>
                    <tr>
                        <td>Izin Usaha</td>
                        <td>: <span class="badge-success">izin usaha telah disetujui</span></td>
                    </tr>
                    <tr>
                        <td>Tanggal Berdiri</td>
                        <td>: 14 Januari 2015</td>
                    </tr>
                    <tr>
                        <td>Hasil Inspeksi</td>
                        <td>:
                            <a href="javascript:void(0)" class="link" id="openInspeksi">
                                View Hasil Inspeksi
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <button class="btn-edit" id="openModal">
            <img src="{{ asset('img/edit-3.png') }}" alt="Edit">Edit Produk
        </button>
    </div>

    <!-- MODAL INSPEKSI -->
    <div class="modal-overlay" id="inspeksiModal">
        <div class="modal-inspeksi">
            <div class="inspeksi-container">
                <h2>Tabel Inspeksi</h2>

                <div class="search-box">
                    <input type="text" placeholder="Cari Data...">
                </div>

                <table class="inspeksi-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Variable / Komponen</th>
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

                <div class="pagination">
                    <span>Showing 5 data out of 20</span>
                    <div class="page-number">
                        <button>&lt;</button>
                        <button class="active">1</button>
                        <button>2</button>
                        <button>5</button>
                        <button>&gt;</button>
                    </div>
                </div>

                <div class="note">
                    <p><strong>Keterangan :</strong></p>
                    <p>Bobot 1 : Risiko rendah</p>
                    <p>Bobot 2 : Risiko sedang</p>
                    <p>Bobot 3 : Risiko tinggi / kritis</p>
                    <p>Tanda Ya : kondisi tidak memenuhi syarat</p>
                    <p>Tanda Tidak : kondisi memenuhi syarat</p>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal-overlay" id="editModal">
        <div class="modal">
            <h2>Edit Profil Usaha</h2>

            <div class="form-group">
                <label>Nama Usaha</label>
                <input type="text" value="DAPUR NUSANTARA">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea rows="3">Jl. Kamboja Atas, RT3/RW4, Pesanggrahan, Kec. Batu, Kota Batu, Jawa Timur 65313</textarea>
            </div>

            <div class="form-group">
                <label>Jenis Usaha</label>
                <input type="text" value="Minuman">
            </div>

            <div class="form-group">
                <label>Tanggal Berdiri</label>
                <input type="date" value="2015-01-14">
            </div>

            <button class="btn-submit">Edit</button>
        </div>
    </div>

    <style>
        /* HEADER */
        .dashboard-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #0b3b6f;
        }

        .dashboard-header span {
            color: #f4b400;
        }

        .dashboard-header p {
            margin-top: 6px;
            color: #6b7280;
        }

        /* CARD */
        .business-card {
            margin-top: 30px;
            background: #fff;
            border-radius: 10px;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .business-left {
            display: flex;
            gap: 20px;
        }

        .business-avatar {
            width: 70px;
            height: 70px;
            background: #ddd;
            border-radius: 50%;
        }

        .business-info h2 {
            font-size: 18px;
            font-weight: 700;
        }

        .category {
            display: block;
            margin-bottom: 12px;
            color: #6b7280;
            font-size: 14px;
        }

        .business-info table {
            font-size: 14px;
            color: #374151;
        }

        .business-info td {
            padding: 4px 8px 4px 0;
            vertical-align: top;
        }

        .badge-success {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e6f9ec;
            color: #16a34a;
            padding: 5px 10px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;

        }

        /* ICON CENTANG */
        .badge-success::before {
            border: 1px solid #16a34a;
            border-radius: 9999px;
            padding: 2px 4px;
            content: "✓";
            font-weight: 700;
            font-size: 8px;
        }

        .link {
            color: #2563eb;
            text-decoration: none;
        }

        /* BUTTON */
        .btn-edit {
            background: #16a34a;
            border: none;
            color: #fff;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;

            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit img {
            width: 18px;
            /* ukuran icon */
            height: 18px;
            object-fit: contain;
        }

        /* MODAL OVERLAY */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        /* MODAL BOX */
        .modal {
            background: #fff;
            width: 520px;
            border-radius: 8px;
            padding: 24px;
        }

        .modal h2 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 700;
            color: #0b3b6f;
        }

        /* FORM */
        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #0b3b6f;
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

        /* BUTTON SUBMIT */
        .btn-submit {
            width: 100%;
            margin-top: 16px;
            background: #0b3b6f;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }

        /* ================= INSPEKSI MODAL STYLE ================= */

        .inspeksi-container {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        /* JUDUL */
        .modal-inspeksi h2 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        /* SEARCH */
        .search-box input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #94a3b8;
            margin-bottom: 12px;
        }

        /* TABLE */
        .inspeksi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .inspeksi-table thead {
            background: #083b6f;
            color: #fff;
        }

        .inspeksi-table th {
            padding: 12px;
            text-align: center;
            font-weight: 600;
        }

        .inspeksi-table td {
            padding: 10px;
            border-bottom: 1px solid #cbd5e1;
        }

        /* ALIGN */
        .inspeksi-table td:nth-child(1),
        .inspeksi-table td:nth-child(3),
        .inspeksi-table td:nth-child(4),
        .inspeksi-table td:nth-child(5) {
            text-align: center;
        }

        /* SECTION ROW */
        .inspeksi-table .section {
            background: #f1f5f9;
            font-weight: 700;
        }

        /* PAGINATION */
        .modal-inspeksi .pagination {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
        }

        /* NOTE / KETERANGAN */
        .note {
            margin-top: 15px;
            font-size: 12px;
            color: #374151;
            line-height: 1.6;
        }
    </style>
    <script>
        /* ================= MODAL EDIT ================= */
        const openEditBtn = document.getElementById('openModal');
        const editModal = document.getElementById('editModal');

        openEditBtn.addEventListener('click', () => {
            editModal.style.display = 'flex';
        });

        editModal.addEventListener('click', (e) => {
            if (e.target === editModal) {
                editModal.style.display = 'none';
            }
        });

        /* ================= MODAL INSPEKSI ================= */
        const openInspeksiBtn = document.getElementById('openInspeksi');
        const inspeksiModal = document.getElementById('inspeksiModal');

        openInspeksiBtn.addEventListener('click', () => {
            inspeksiModal.style.display = 'flex';
        });

        inspeksiModal.addEventListener('click', (e) => {
            if (e.target === inspeksiModal) {
                inspeksiModal.style.display = 'none';
            }
        });
    </script>

@endsection
