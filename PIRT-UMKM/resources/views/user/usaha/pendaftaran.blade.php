<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Usaha</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff;
            color: #0b2e5b;
        }

        .container {
            width: 900px;
            margin: 40px auto;
        }

        h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 40px;
        }

        .steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .step {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
        }

        .step.active {
            background: #08315f;
            color: #ffffff;
        }

        .step.inactive {
            background: #ffffff;
            color: #08315f;
            border: 2px solid #08315f;
        }

        .line {
            width: 140px;
            height: 3px;
            background: #08315f;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-size: 13px;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid #b7c7dd;
            font-size: 13px;
        }

        textarea {
            height: 120px;
            resize: none;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9aa8bd;
        }

        .upload-btn {
            width: 140px;
            padding: 7px;
            font-size: 12px;
            background: #ffffff;
            border: 1px solid #b7c7dd;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload-box {
            width: 140px;
        }

        input[type="file"] {
            padding: 6px;
            border: 1px solid #b7c7dd;
            border-radius: 4px;
            background: #fff;
            font-size: 13px;
        }

        .file-hidden {
            display: none;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .btn {
            width: 48%;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-prev {
            background: #ffffff;
            border: 1px solid #08315f;
            color: #08315f;
        }

        .btn-next {
            background: #08315f;
            border: none;
            color: #ffffff;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Pendaftaran Usaha</h2>

        <div class="steps">
            <div class="step active">1</div>
            <div class="line"></div>
            <div class="step inactive">2</div>
        </div>

        <form method="POST" action="{{ route('usaha.pendaftaran.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Usaha</label>
                <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" placeholder="Masukan disini..">
            </div>

            <div class="form-group">
                <label>Jenis Produk</label>
                <select name="jenis_produk">
                    <option value="">Pilih jenis Produk</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat Usaha</label>
                <textarea name="alamat_usaha" placeholder="Masukan disini..">{{ old('alamat_usaha') }}</textarea>
            </div>

            <div class="form-group">
                <label>Tanggal Berdiri</label>
                <input type="date" name="tanggal_berdiri" value="{{ old('tanggal_berdiri') }}">
            </div>

            <div class="form-group">
                <label>Unggah Logo Usaha</label>
                <input type="file" name="logo" id="logo" class="file-hidden">
                <button type="button" class="upload-btn" onclick="document.getElementById('logo').click()">
                    Unggah disini
                </button>
            </div>

            <div class="buttons">
                <button type="button" class="btn btn-prev">Sebelumnya</button>
                <button type="submit" class="btn btn-next">Selanjutnya</button>
            </div>
        </form>
    </div>

</body>
</html>
