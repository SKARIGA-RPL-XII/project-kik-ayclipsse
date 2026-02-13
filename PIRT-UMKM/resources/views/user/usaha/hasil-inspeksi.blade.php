<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Inspeksi</title>
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
            font-size: 14px;
            margin-bottom: 25px;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #083b6f;
            font-weight: 500;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #083b6f;
            color: #fff;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: center;
        }

        .section {
            background: #f1f5f9;
            font-weight: bold;
            text-align: left;
        }

        .keterangan {
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            background: #083b6f;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Hasil Inspeksi</h1>

        <div class="breadcrumb">
            <a href="{{ url()->previous() }}">Usaha</a>
            <span> › </span>
            <span>Hasil Inspeksi</span>
        </div>

        <div class="card">

            <h2>{{ $usaha->nama_usaha }}</h2>

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
                            <td colspan="5">{{ strtoupper($kategori) }}</td>
                        </tr>

                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->variabel->deskripsi ?? '-' }}</td>
                                <td>{{ $item->bobot }}</td>
                                <td>{{ $item->jawaban == 'ya' ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $item->nilai }}</td>
                            </tr>
                        @endforeach

                    @empty
                        <tr>
                            <td colspan="5">Belum ada hasil inspeksi</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="keterangan">
                <strong>Keterangan:</strong><br>
                Bobot 1 → Risiko rendah<br>
                Bobot 2 → Risiko sedang<br>
                Bobot 3 → Risiko tinggi / kritis<br><br>
                Jika TANDA = Ya → Nilai = Bobot<br>
                Jika TANDA = Tidak → Nilai = 0
            </div>

            <a href="{{ url()->previous() }}" class="btn-back">Kembali</a>

        </div>

    </div>

</body>

</html>
