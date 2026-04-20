@php
    // Logika Tanggal menggunakan Carbon
    $now = \Carbon\Carbon::now();
    $startOfMonth = $now->copy()->startOfMonth();
    $endOfMonth = $now->copy()->endOfMonth();

    // Mulai kalender dari hari Minggu di minggu pertama bulan ini
    $date = $startOfMonth->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
    // Berakhir di akhir minggu (hari Sabtu) dari minggu terakhir bulan ini
    // endOfWeek() di Carbon menerima parameter hari AWAL minggu, jadi kita pakai SUNDAY
    $endOfCalendar = $endOfMonth->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);
@endphp

<div class="calendar-wrapper">
    <div class="calendar-header">
        <span class="month-name">{{ $now->translatedFormat('F Y') }}</span>
    </div>

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
            @while ($date->lte($endOfCalendar))
                <tr>
                    @for ($i = 0; $i < 7; $i++)
                        <td
                            class="
                            {{ $date->isToday() ? 'today' : '' }} 
                            {{ $date->month != $now->month ? 'other-month' : '' }}
                        ">
                            {{ $date->day }}
                        </td>
                        @php $date->addDay(); @endphp
                    @endfor
                </tr>
            @endwhile
        </tbody>
    </table>
</div>

<style>
    .calendar-wrapper {
        width: 100%;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .month-name {
        font-size: 14px;
        font-weight: 700;
        color: #083b6f;
        background: #e0f2fe;
        padding: 5px 12px;
        border-radius: 20px;
    }

    .dashboard-calendar {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-calendar th {
        padding: 10px 5px;
        font-size: 12px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
    }

    .dashboard-calendar td {
        padding: 12px 5px;
        font-size: 14px;
        text-align: center;
        color: #475569;
        transition: all 0.2s;
        border-radius: 8px;
    }

    .dashboard-calendar td:hover:not(.other-month) {
        background: #f1f5f9;
        color: #083b6f;
        cursor: pointer;
    }

    .today {
        background: #083b6f !important;
        color: #ffffff !important;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(8, 59, 111, 0.3);
    }

    .other-month {
        color: #cbd5e1 !important;
        cursor: default;
    }
</style>
