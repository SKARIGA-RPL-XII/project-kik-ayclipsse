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
            margin-bottom: 30px;
            font-weight: 600;
        }

        /* ===== CARD ===== */
        .card {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e3eaf5;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .card-header h3 {
            margin: 0;
        }

        .toggle-icon {
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            margin-top: 20px;
            display: block;
        }

        .hidden {
            display: none;
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
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px 8px;
            border-radius: 4px;
            border: 1px solid #b7c7dd;
            font-size: 14px;
        }

        textarea {
            height: 60px;
            resize: none;
        }

        .readonly {
            background: #e6e7ea;
            border: none;
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
            text-align: center;
            text-decoration: none;
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

        /* ===== TAMBAH PRODUK ===== */
        .tambah-produk {
            color: #3399CC;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 20px;
        }


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
    </style>
</head>

<body>

    <div class="container">
        <h2>Pendaftaran PIRT Produk Usaha</h2>

        <form method="POST" action="{{ route('produk.usaha.pendaftaran.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="steps">
                <div class="step">1</div>
                <div class="line"></div>
                <div class="step">2</div>
            </div>

            <div id="produk-wrapper">
                <div class="row-3-atas">
                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input type="text" class="readonly" value="{{ now()->translatedFormat('d F Y') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Usaha</label>
                        <input type="text" class="readonly" value="{{ $usaha->nama_usaha }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <input type="text" class="readonly" value="{{ $usaha->jenis_usaha }}" readonly>
                    </div>
                </div>
                <!-- PRODUK PERTAMA -->
                <div class="card">
                    <div class="card-header" onclick="toggleCard(this)">
                        <h3>Produk 1</h3>
                        <span class="toggle-icon">−</span>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="produk[0][nama_produk]">
                        </div>

                        <div class="form-group">
                            <label>Komposisi</label>
                            <textarea name="produk[0][komposisi]"></textarea>
                        </div>

                        <div class="row-2">
                            <div class="form-group">
                                <label>Jenis Kemasan</label>
                                <select name="produk[0][kemasan]">
                                    <option value="">Pilih</option>
                                    <option>Botol</option>
                                    <option>Plastik</option>
                                    <option>Kaca</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Berat Bersih</label>
                                <input type="number" name="produk[0][berat_bersih]">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Logo Usaha</label>
                            <input type="file" name="produk[0][image]">
                        </div>
                    </div>
                </div>

            </div>

            <div class="tambah-produk" onclick="tambahProduk()">
                + Tambah Produk
            </div>

            <div class="buttons">
                <a href="{{ route('produk.usaha') }}" class="btn btn-prev">Sebelumnya</a>
                <button type="submit" class="btn btn-submit">Kirim</button>
            </div>

        </form>

    </div>

    <script>
        let produkIndex = 1;

        function tambahProduk() {
            const wrapper = document.getElementById('produk-wrapper');

            const card = document.createElement('div');
            card.classList.add('card');

            card.innerHTML = `
                <div class="card-header" onclick="toggleCard(this)">
                    <h3>Produk ${produkIndex + 1}</h3>
                    <span class="toggle-icon">−</span>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="produk[${produkIndex}][nama_produk]">
                    </div>

                    <div class="form-group">
                        <label>Komposisi</label>
                        <textarea name="produk[${produkIndex}][komposisi]"></textarea>
                    </div>

                    <div class="row-2">
                        <div class="form-group">
                            <label>Jenis Kemasan</label>
                            <select name="produk[${produkIndex}][kemasan]">
                                <option value="">Pilih</option>
                                <option>Botol</option>
                                <option>Plastik</option>
                                <option>Kaca</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Berat Bersih</label>
                            <input type="number" name="produk[${produkIndex}][berat_bersih]">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Logo Usaha</label>
                        <input type="file" name="produk[${produkIndex}][image]">
                    </div>
                </div>
            `;

            wrapper.appendChild(card);
            produkIndex++;
        }

        function toggleCard(header) {
            const body = header.nextElementSibling;
            const icon = header.querySelector('.toggle-icon');

            body.classList.toggle('hidden');

            if (body.classList.contains('hidden')) {
                icon.innerText = '+';
            } else {
                icon.innerText = '−';
            }
        }
    </script>

</body>

</html>
