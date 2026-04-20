<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tabel Inspeksi</title>
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
        }

        select {
            padding: 5px;
            border-radius: 6px;
        }

        .btn-save {
            background: #083b6f;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            float: right;
            margin-top: 20px;
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

        <h1>Edit Tabel Inspeksi</h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.usaha') }}">Usaha</a>
            <span class="separator">›</span>

            <a href="{{ route('admin.usaha.detail', $usaha->id) }}">
                Detail Usaha
            </a>
            <span class="separator">›</span>

            <span class="active">Edit Inspeksi</span>
        </div>


        <div class="card">

            <form method="POST" action="{{ route('admin.inspeksi.update', $usaha->id) }}">
                @csrf
                @method('PUT') <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Variable / Komponen</th>
                            <th>Bobot</th>
                            <th>Tanda</th>
                            <th>Nilai (Preview)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($details as $kategori => $items)
                            <tr class="section">
                                <td>{{ $loop->iteration }}.</td>
                                <td colspan="4" style="text-align: left; padding-left: 20px;">
                                    {{ strtoupper($kategori) }}
                                </td>
                            </tr>

                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td style="text-align: left;">{{ $item->variabel->deskripsi }}</td>
                                    <td>
                                        <select name="bobot[{{ $item->id }}]">
                                            <option value="1" {{ $item->bobot == 1 ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ $item->bobot == 2 ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ $item->bobot == 3 ? 'selected' : '' }}>3</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="jawaban[{{ $item->id }}]">
                                            <option value="ya" {{ $item->jawaban == 'ya' ? 'selected' : '' }}>Ya
                                            </option>
                                            <option value="tidak" {{ $item->jawaban == 'tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                    </td>
                                    <td
                                        style="font-weight: bold; color: {{ $item->jawaban == 'ya' ? 'green' : 'red' }}">
                                        {{ $item->nilai }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                    <a href="{{ route('admin.usaha.detail', $usaha->id) }}"
                        style="float: right; margin-right: 10px; padding: 10px; color: #666; text-decoration: none;">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

</body>

</html>
