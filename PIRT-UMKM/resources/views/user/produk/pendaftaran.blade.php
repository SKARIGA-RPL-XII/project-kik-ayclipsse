<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran PIRT Produk Usaha</title>
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
            margin-bottom: 40px;
            font-weight: 600;
        }

        /* ===== STEP PROGRESS ===== */
        .steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .step {
            width: 45px;
            height: 45px;
            background: #0b2e5b;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .line {
            width: 120px;
            height: 4px;
            background: #0b2e5b;
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 15px;
        }

        .row-3-atas {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .row-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px 5px;
            border-radius: 4px;
            border: 1px solid #b7c7dd;
            font-size: 14px;
        }

        textarea {
            height: 60;
            resize: none;
        }

        .readonly {
            background: #e6e7ea;
            border: none;
            color: #0b2e5b;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9aa8bd;
        }

        /* ===== FILE UPLOAD ===== */
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

        /* ===== BUTTON ===== */
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .btn {
            width: 48%;
            padding: 12px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-prev {
            background: #ffffff;
            border: 1px solid #0b2e5b;
            color: #0b2e5b;
        }

        .btn-submit {
            background: #0b2e5b;
            border: none;
            color: #ffffff;
        }

        .btn-prev:hover {
            background: #f3f6fb;
        }

        .btn-submit:hover {
            background: #08315f;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Pendaftaran PIRT Produk Usaha</h2>

        <!-- STEP -->
        <div class="steps">
            <div class="step">1</div>
            <div class="line"></div>
            <div class="step">2</div>
            <div class="line"></div>
            <div class="step">3</div>
        </div>

        <!-- FORM -->
        <form>

            <!-- ROW SEJAJAR -->
            <div class="row-3-atas">
                <div class="form-group">
                    <label>Tanggal Input</label>
                    <input type="text" class="readonly" value="14 Januari 2026" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Usaha</label>
                    <input type="text" class="readonly" value="DJENG NITA" readonly>
                </div>

                <div class="form-group">
                    <label>Jenis Produk</label>
                    <input type="text" class="readonly" value="Minuman" readonly>
                </div>
            </div>


            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" placeholder="Masukan disini..">
            </div>

            <div class="form-group">
                <label>Komposisi</label>
                <textarea placeholder="Masukan disini.."></textarea>
            </div>
            <div class="row-2">
                <div class="form-group">
                    <label>Jenis Kemasan</label>
                    <select>
                        <option>Pilih jenis kemasan</option>
                        <option>Botol</option>
                        <option>Plastik</option>
                        <option>Kaca</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Berat Bersih</label>
                    <input type="text" placeholder="Masukan disini..">
                </div>
            </div>

            <div class="form-group upload-box">
                <label>Unggah Logo Usaha</label>
                <input type="file">
            </div>

            <!-- BUTTON -->
            <div class="buttons">
                <button type="button" class="btn btn-prev">Sebelumnya</button>
                <button type="submit" class="btn btn-submit">Kirim</button>
            </div>
        </form>
    </div>

</body>

</html>
