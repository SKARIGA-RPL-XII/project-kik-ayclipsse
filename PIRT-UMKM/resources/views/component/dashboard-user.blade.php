@section('content')
    <div class="dashboard-admin">

        <div class="dashboard-header">
            <h1>Selamat Datang Kembali <span>{{ auth()->user()->name }}</span></h1>
            <p>Kelola pendaftaran PIRT dan produk usahamu dengan mudah dan cepat.</p>
        </div>

        <div class="dashboard-cards">

            <div class="dashboard-card usaha">
                <div class="dashboard-icon">🏢</div>
                <div class="card-info">
                    <h4>Total Usaha</h4>
<h2>{{ $totalUsaha }}</h2>
                    <p>Usaha Terdaftar</p>
                </div>
            </div>

            <div class="dashboard-card produk">
                <div class="dashboard-icon">📦</div>
                <div class="card-info">
                    <h4>Total Produk</h4>
<h2>{{ $totalProduk }}</h2>
                    <p>Produk Terdaftar</p>
                </div>
            </div>

            <div class="dashboard-card persetujuan">
                <div class="dashboard-icon">✔️</div>
                <div class="card-info">
                    <h4>Produk Disetujui</h4>
<h2>{{ $totalDisetujui }}</h2>
                    <p>Status PIRT</p>
                </div>
            </div>

        </div>

        <div class="dashboard-grid">

            <div class="dashboard-box">
                <h3>Produk Terbaru</h3>
                <ul class="produk-list">
                    <li>
                        <span>Keripik Singkong Balado</span>
                        <small>Disetujui</small>
                    </li>
                    <li>
                        <span>Kue Kering Nastar</span>
                        <small>Menunggu</small>
                    </li>
                    <li>
                        <span>Sambal Kemasan</span>
                        <small>Disetujui</small>
                    </li>
                </ul>
            </div>

            <div class="dashboard-box">
                <h3>Profil Usaha</h3>
                <div class="profil-usaha">
                    <p><strong>Nama Usaha:</strong> -</p>
                    <p><strong>Alamat:</strong> -</p>
                    <p><strong>Status:</strong> Belum Terdaftar</p>
                </div>
            </div>

        </div>

    </div>

    <style>
        body {
            background: #f5f7fb;
        }

        .dashboard-header h1 {
            font-size: 26px;
            margin-bottom: 5px;
        }

        .dashboard-header span {
            color: #f6c000;
        }

        .dashboard-header p {
            color: #777;
            margin-bottom: 30px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .dashboard-card {
            display: flex;
            gap: 16px;
            padding: 22px;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.08);
        }

        .dashboard-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            border-radius: 12px;
        }

        .card-info h4 {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .card-info h2 {
            margin: 5px 0;
            font-size: 26px;
        }

        .card-info p {
            font-size: 13px;
            color: #888;
        }

        .dashboard-card.usaha {
            background: #fff4f4;
        }

        .dashboard-card.usaha .dashboard-icon {
            background: #ffdede;
        }

        .dashboard-card.produk {
            background: #eef5ff;
        }

        .dashboard-card.produk .dashboard-icon {
            background: #dbe9ff;
        }

        .dashboard-card.persetujuan {
            background: #eafaf1;
        }

        .dashboard-card.persetujuan .dashboard-icon {
            background: #d1f2e1;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .dashboard-box {
            background: #fff;
            padding: 22px;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .dashboard-box h3 {
            margin-bottom: 15px;
        }

        .produk-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .produk-list li {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .produk-list li:last-child {
            border-bottom: none;
        }

        .produk-list small {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 8px;
            background: #f2f2f2;
        }

        @media(max-width: 992px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
