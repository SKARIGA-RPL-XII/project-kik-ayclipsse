<div class="dashboard-admin">

    <!-- HEADER -->
    <div class="dashboard-header">
        <h1>
            Selamat Datang Kembali
            <span>{{ auth()->user()->name }}</span>
        </h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <!-- STAT CARDS -->
    <div class="dashboard-cards">

        <div class="dashboard-card usaha">
            <div class="dashboard-icon">🏢</div>
            <div>
                <h4>Total Usaha</h4>
                <h2>{{ $totalUsaha }} Usaha</h2>
                <p>Terdaftar di sistem</p>
            </div>
        </div>

        <div class="dashboard-card produk">
            <div class="dashboard-icon">📦</div>
            <div>
                <h4>Total Produk</h4>
                <h2>{{ $totalProduk }} Produk</h2>
                <p>Siap diajukan PIRT</p>
            </div>
        </div>

        <div class="dashboard-card persetujuan">
            <div class="dashboard-icon">✔️</div>
            <div>
                <h4>Persetujuan</h4>
                <h2>{{ $totalPersetujuan }} Disetujui</h2>
                <p>Menunggu & selesai</p>
            </div>
        </div>

    </div>

    <div class="dashboard-grid">

        <div class="dashboard-box">
            <h3>Rekap Aktivitas Mingguan</h3>
            <canvas id="adminChart"></canvas>
        </div>

        <div class="dashboard-box">
            <h3>Kalender</h3>
            <table class="dashboard-calendar">
                <thead>
                    <tr>
                        <th>Min</th>
                        <th>Sen</th>
                        <th>Sel</th>
                        <th>Rab</th>
                        <th>Kam</th>
                        <th>Jum</th>
                        <th>Sab</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>7</td>
                        <td class="today">8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>


<style>
    .dashboard-header h1 {
        font-size: 26px;
        margin-bottom: 5px;
    }

    .dashboard-header span {
        color: #f6c000;
    }

    .dashboard-header p {
        color: #666;
        margin-bottom: 25px;
    }

    /* CARDS */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }

    .dashboard-card {
        display: flex;
        gap: 16px;
        padding: 20px;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .dashboard-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border-radius: 50%;
    }

    /* VARIANTS */
    .dashboard-card.usaha {
        background: #fff1f1;
    }

    .dashboard-card.usaha .dashboard-icon {
        background: #ffdddd;
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

    /* GRID */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2.5fr 1fr;
        gap: 20px;
    }

    .dashboard-box {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .dashboard-calendar {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    .dashboard-calendar th,
    .dashboard-calendar td {
        padding: 8px;
        font-size: 13px;
    }

    .dashboard-calendar td:hover {
        background: #eaf2fb;
        cursor: pointer;
    }

    .today {
        background: #0b4a87;
        color: #fff;
        border-radius: 6px;
    }

    @media(max-width:992px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('adminChart');

            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['1 Mei', '2 Mei', '3 Mei', '4 Mei', '5 Mei', '6 Mei', '7 Mei'],
                        datasets: [{
                            label: 'Jumlah Aktivitas',
                            data: [15, 14, 24, 20, 28, 21, 29],
                            borderColor: '#0b4a87',
                            backgroundColor: 'rgba(11,74,135,0.2)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'end'
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
