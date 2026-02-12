<div class="main">

    <div class="header">
        <h1>Selamat Datang <span>{{ auth()->user()->name }}!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="empty-state">
        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486820.png" alt="No Data">

        <h2>Tidak ada data</h2>
        <p>Klik <strong>Pendaftaran PIRT</strong> untuk menambah data.</p>

        <a href="{{ route('usaha.pendaftaran') }}" class="btn-primary">
            Pendaftaran PIRT
        </a>
    </div>

</div>

<style>
    .main {
        padding: 40px 60px;
    }

    .header h1 {
        font-size: 28px;
        font-weight: 600;
        color: #1d3557;
    }

    .header h1 span {
        color: #f4b400;
    }

    .header p {
        margin-top: 5px;
        color: #6c757d;
        font-size: 14px;
    }

    .empty-state {
        margin-top: 60px;
        text-align: center;
    }

    .empty-state img {
        width: 280px;
        margin-bottom: 30px;
    }

    .empty-state h2 {
        font-size: 20px;
        color: #1d3557;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 25px;
    }

    .btn-primary {
        display: inline-block;
        background: #0d3b66;
        color: white;
        text-decoration: none;
        padding: 12px 40px;
        border-radius: 6px;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: #092c4d;
    }
</style>
