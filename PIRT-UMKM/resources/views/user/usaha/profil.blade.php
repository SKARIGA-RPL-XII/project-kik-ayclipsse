@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if (!$usaha)
        @include('component.empty-dashboard')
    @else
        <div class="dashboard-header">
            <h1>Usaha</h1>
            <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
        </div>

        <div class="business-card">
            <div class="business-left">
                <div class="business-avatar"></div>

                <div class="business-info">
                    <h2>{{ $usaha->nama_usaha }}</h2>
                    <span class="category">{{ $usaha->jenis_usaha }}</span>

                    <table>
                        <tr>
                            <td>Nama Usaha</td>
                            <td>: {{ $usaha->nama_usaha }}</td>
                        </tr>
                        <tr>
                            <td>Alamat Usaha</td>
                            <td>: {{ $usaha->alamat_usaha }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Usaha</td>
                            <td>: {{ $usaha->jenis_usaha }}</td>
                        </tr>
                        <tr>
                            <td>Izin Usaha</td>
                            <td>:
                                @if ($usaha->izin_usaha === 'disetujui')
                                    <span class="badge-success">izin usaha telah disetujui</span>
                                @else
                                    <span class="badge-danger">belum disetujui</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Berdiri</td>
                            <td>: {{ \Carbon\Carbon::parse($usaha->tanggal_berdiri)->translatedFormat('d F Y') }}</td>
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
                <img src="{{ asset('img/edit-3.png') }}" alt="Edit">Edit Usaha
            </button>
        </div>

        <div class="modal-overlay" id="editModal">
            <div class="modal">
                <h2>Edit Profil Usaha</h2>

                <form method="POST" action="{{ route('profil.usaha.update', $usaha->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama Usaha</label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $usaha->nama_usaha) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Alamat Usaha</label>
                        <textarea name="alamat_usaha" rows="3" required>{{ old('alamat_usaha', $usaha->alamat_usaha) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" value="{{ old('jenis_usaha', $usaha->jenis_usaha) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Berdiri</label>
                        <input type="date" name="tanggal_berdiri"
                            value="{{ old('tanggal_berdiri', $usaha->tanggal_berdiri) }}" required>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn-submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    @endif

    <style>
        .dashboard-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #000;
        }

        .dashboard-header span {
            color: #f4b400;
        }

        .dashboard-header p {
            margin-top: 6px;
            color: #6b7280;
        }

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
            height: 18px;
            object-fit: contain;
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
    </style>

    <script>
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
