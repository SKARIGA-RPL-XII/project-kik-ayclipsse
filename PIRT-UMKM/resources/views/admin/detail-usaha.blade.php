<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Usaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f5f9;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: 40px auto;
        }

        h1 {
            color: #083b6f;
            margin-bottom: 5px;
        }

        .breadcrumb {
            color: #64748b;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .detail-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            background: #d1d5db;
            border-radius: 50%;
        }

        .detail-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .kategori {
            color: #6b7280;
            font-size: 14px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 10px 15px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .badge-success {
            background: #dcfce7;
            color: #16a34a;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .badge-warning {
            background: #eef2f7;
            color: #475569;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .badge-danger {
            background: #fee2e2;
            color: #dc2626;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .btn-primary {
            display: inline-block;
            background: #083b6f;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .table-container {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead {
            background: #083b6f;
            color: #fff;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .section {
            background: #f1f5f9;
            font-weight: bold;
        }

        .keterangan {
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }

        .search-wrapper {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        .search-wrapper input {
            width: 70%;
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        .btn-edit {
            background: #16a34a;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .breadcrumb {
            margin-bottom: 25px;
            font-size: 14px;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #083b6f;
            font-weight: 500;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            margin: 0 8px;
            color: #9ca3af;
        }

        .breadcrumb .active {
            color: #64748b;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Detail Usaha</h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.usaha') }}">Usaha</a>
            <span class="separator">›</span>
            <span class="active">Detail Usaha</span>
        </div>


        <div class="card">

            <div class="detail-header">
                <div class="avatar"></div>
                <div>
                    <h2>{{ strtoupper($usaha->nama_usaha) }}</h2>
                    <div class="kategori">{{ $usaha->jenis_usaha }}</div>
                </div>
            </div>

            <div class="detail-grid">
                <div>Nama Usaha</div>
                <div>: {{ $usaha->nama_usaha }}</div>

                <div>Alamat Usaha</div>
                <div>: {{ $usaha->alamat_usaha }}</div>

                <div>Jenis Usaha</div>
                <div>: {{ $usaha->jenis_usaha }}</div>

                <div>Izin Usaha</div>
                <div>:
                    @if ($usaha->status === 'disetujui')
                        <span class="badge-success">Izin usaha telah disetujui</span>
                    @elseif($usaha->status === 'ditolak')
                        <span class="badge-danger">Izin usaha ditolak</span>
                    @else
                        <span class="badge-warning">Menunggu persetujuan</span>
                    @endif
                </div>

                <div>Tanggal Berdiri</div>
                <div>: {{ \Carbon\Carbon::parse($usaha->created_at)->translatedFormat('d F Y') }}</div>
            </div>

            <a href="{{ route('admin.usaha') }}" class="btn-primary">Kembali</a>

        </div>


        <div class="card">

            <h2>Tabel Inspeksi</h2>

            <div class="search-wrapper">
                <input type="text" placeholder="Cari Data...">
                <a href="{{ route('admin.usaha.editInspeksi', $usaha->id) }}" class="btn-edit">
                    Edit Tabel
                </a>
            </div>

            <div class="table-container">
                <table>
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

                        @php $no = 1; @endphp

                        @forelse($details as $kategori => $items)

                            <tr class="section">
                                <td>{{ $loop->iteration }}.</td>
                                <td colspan="4">{{ strtoupper($kategori) }}</td>
                            </tr>

                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->variabel->deskripsi }}</td>
                                    <td>{{ $item->bobot }}</td>
                                    <td>{{ $item->jawaban == 'ya' ? 'Ya' : 'Tidak' }}</td>
                                    <td>{{ $item->nilai }}</td>
                                </tr>
                            @endforeach

                        @empty
                            <tr>
                                <td colspan="5">Belum ada data inspeksi</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            <div class="keterangan">
                <strong>Keterangan:</strong><br>
                Bobot 1 → Risiko rendah<br>
                Bobot 2 → Risiko sedang<br>
                Bobot 3 → Risiko tinggi / kritis<br><br>
                Jika TANDA = Ya → Nilai = Bobot<br>
                Jika TANDA = Tidak → Nilai = 0
            </div>

        </div>

    </div>

</body>

</html>
