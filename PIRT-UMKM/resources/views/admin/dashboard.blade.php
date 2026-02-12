@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

    <div class="header">
        <h1>Selamat Datang Kembali <span>Raysha!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="cards">
        <div class="stat-card usaha">
            <div class="stat-icon">🏢</div>
            <div class="stat-content">
                <h4>Total Usaha</h4>
                <h2>{{ $totalUsaha ?? 12 }} Usaha</h2>
                <p>Terdaftar di sistem</p>
            </div>
        </div>

        <div class="stat-card produk">
            <div class="stat-icon">📦</div>
            <div class="stat-content">
                <h4>Total Produk</h4>
                <h2>{{ $totalProduk ?? 48 }} Produk</h2>
                <p>Siap diajukan PIRT</p>
            </div>
        </div>

        <div class="stat-card persetujuan">
            <div class="stat-icon">✔️</div>
            <div class="stat-content">
                <h4>Persetujuan</h4>
                <h2>{{ $totalPersetujuan ?? 7 }} Disetujui</h2>
                <p>Menunggu & selesai</p>
            </div>
        </div>
    </div>
    <div class="main-grid">
        <div class="chart-card">
            <h3>Rekap Aktivitas Mingguan</h3>
            <canvas id="myChart"></canvas>
        </div>

        <div class="chart-card">
            <div class="calendar">
                <h3>Kalender</h3>
                <table>
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
                        <tr>
                            <td>13</td>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .header h1 {
            font-size: 26px;
            margin-bottom: 5px;
        }

        .header span {
            color: #f6c000;
        }

        .header p {
            color: #666;
            margin-bottom: 25px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-content h4 {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .stat-content h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-content p {
            font-size: 12px;
            color: #777;
        }

        .stat-card.usaha {
            background: #fff1f1;
        }

        .stat-card.usaha .stat-icon {
            background: #ffdddd;
        }

        .stat-card.produk {
            background: #eef5ff;
        }

        .stat-card.produk .stat-icon {
            background: #dbe9ff;
            color: #0b4a87;
        }


        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card.persetujuan {
            background: #eafaf1;
        }

        .stat-card.persetujuan .stat-icon {
            background: #d1f2e1;
            color: #1b8f5a;
        }

        @media(max-width: 992px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }

        .main-grid {
            display: grid;
            grid-template-columns: 2.5fr 1fr;
            gap: 20px;
            align-items: stretch;
        }

        .chart-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .chart-card canvas {
            width: 100% !important;
            height: 280px !important;
        }

=        .calendar {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

=        .calendar table {
            flex: 1;
        }


        .chart-card,
        .calendar {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

=        .calendar h3 {
            margin-bottom: 10px;
        }

        .calendar table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .calendar th,
        .calendar td {
            padding: 8px;
            font-size: 13px;
        }

        .calendar th {
            color: #0b4a87;
        }

        .calendar td {
            cursor: pointer;
            border-radius: 6px;
        }

        .calendar td:hover {
            background: #eaf2fb;
        }

        .today {
            background: #0b4a87;
            color: #fff;
        }

        @media(max-width: 992px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .main-grid {
                grid-template-columns: 1fr;
            }

            f
        }
    </style>

    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1 Mei', '2 Mei', '3 Mei', '4 Mei', '5 Mei', '6 Mei', '7 Mei'],
                datasets: [{
                    label: 'Jumlah Aktivitas',
                    data: [15, 14, 24, 20, 28, 21, 29],
                    borderColor: '#0b4a87',
                    backgroundColor: 'rgba(11, 74, 135, 0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 20,
                            boxHeight: 10,
                            color: '#555',
                            font: {
                                size: 13
                            }
                        }
                    }
                }
            }
        });
    </script>

@endsection
