<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Produk Usaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f5f9;
        }

        .container {
            width: 95%;
            max-width: 1100px;
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

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb span {
            color: #64748b;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .detail-title {
            margin-bottom: 20px;
        }

        .detail-title h2 {
            margin: 0;
            font-size: 28px;
        }

        .detail-title small {
            color: #6b7280;
            font-size: 14px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 10px 15px;
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
            margin-top: 25px;
            background: #083b6f;
            color: #fff;
            padding: 8px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary:hover {
            background: #062f57;
        }

        .komposisi {
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Detail Produk Usaha</h1>

        <div class="breadcrumb">
            <a href="{{ route('admin.produk') }}">Produk Usaha</a>
            <span> › </span>
            <span>Detail Produk Usaha</span>
        </div>

        <div class="card">

            <div class="detail-title">
                <h2>{{ $produk->nama_produk }}</h2>
                <small>{{ $produk->usaha->jenis_usaha }}</small>
            </div>

            <div class="detail-grid">

                <div>Nama Usaha</div>
                <div>: {{ $produk->usaha->nama_usaha }}</div>

                <div>Nama Produk</div>
                <div>: {{ $produk->nama_produk }}</div>

                <div>Jenis Produk</div>
                <div>: {{ $produk->usaha->jenis_usaha }}</div>

                <div>Komposisi</div>
                <div class="komposisi">: {!! nl2br(e($produk->komposisi)) !!}</div>

                <div>Berat Bersih</div>
                <div>: {{ $produk->berat_bersih }} ml</div>

                <div>Kemasan</div>
                <div>: {{ $produk->kemasan }}</div>

                <div>Verifikasi</div>
                <div>:
                    @if ($produk->status == 'disetujui')
                        <span class="badge-success">Terdaftar PIRT</span>
                    @elseif($produk->status == 'ditolak')
                        <span class="badge-danger">Ditolak</span>
                    @else
                        <span class="badge-warning">Menunggu Persetujuan</span>
                    @endif
                </div>

                <div>Tanggal Input</div>
                <div>: {{ \Carbon\Carbon::parse($produk->created_at)->translatedFormat('d F Y') }}</div>

            </div>

            <a href="{{ route('admin.produk') }}" class="btn-primary">
                Kembali
            </a>

        </div>

    </div>

</body>

</html>
