@extends('layouts.master')

@section('title', 'Volt Energy - Dashboard')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle', 'Selamat datang, Alex. Mau hitung apa hari ini?')
@section('user_name', 'Alex Steventio')
@section('user_role', 'User')

@section('content')
<main class="p-8 max-w-container-max mx-auto w-full">
<!-- Kartu Rangkuman Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
<!-- Card 1: Total Perangkat Aktif -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary">
<div class="flex justify-between items-start mb-4">
<div class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center">
<span class="material-symbols-outlined text-primary" data-icon="devices">devices</span>
</div>
<span class="bg-primary-container/10 text-primary text-[10px] font-bold px-2 py-1 rounded-full">+12%</span>
</div>
<p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Total Perangkat Aktif</p>
<h3 class="text-display-lg font-display-lg text-on-surface mt-1">24</h3>
<div class="mt-4 flex items-center gap-2 text-label-sm text-tertiary">
<span class="material-symbols-outlined text-[16px]" style='font-variation-settings: "FILL" 1;'>check_circle</span>
<span class="">Semua Sistem Beroperasi Normal</span>
</div>
</div>
<!-- Card 2: Total kWh Bulanan -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary">
<div class="flex justify-between items-start mb-4">
<div class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center">
<span class="material-symbols-outlined text-primary" data-icon="bolt">bolt</span>
</div>
<span class="bg-primary-container/10 text-primary text-[10px] font-bold px-2 py-1 rounded-full">+4.2%</span>
</div>
<p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Total kWh Bulanan</p>
<h3 class="text-display-lg font-display-lg text-on-surface mt-1">1,248</h3>
<div class="mt-4 flex items-center gap-2 text-label-sm text-on-surface-variant bg-surface-container-low px-2 py-1 rounded border border-outline-variant/30">
<span class="text-[10px] font-bold text-primary">Perbandingan dengan Konsumsi Acuan</span>
</div>
</div>
<!-- Card 3: Perkiraan Pengeluaran Bulanan -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary">
<div class="flex justify-between items-start mb-4">
<div class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center">
<span class="material-symbols-outlined text-primary" data-icon="account_balance_wallet">account_balance_wallet</span>
</div>
<span class="bg-tertiary-container/10 text-tertiary text-[10px] font-bold px-2 py-1 rounded-full">-Rp10.000</span>
</div>
<p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Perkiraan Pengeluaran Bulanan</p>
<h3 class="text-display-lg font-display-lg text-on-surface mt-1">Rp100.000</h3>
<div class="mt-4 flex items-center gap-2 text-label-sm text-on-surface-variant">
<span class="h-2 w-2 bg-tertiary rounded-full"></span>
<span class="">Sesuai Target Anggaran</span>
</div>
</div>
</div>
<!-- Grafik Penggunaan Energi -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-8 soft-inset-shadow">
<div class="flex justify-between items-center mb-10">
<div>
<h4 class="text-headline-sm font-headline-sm text-on-surface">Penggunaan Energi</h4>
<p class="text-body-md font-body-md text-on-surface-variant">Distribusi penggunaan energi secara real-time pada periode yang dipilih.</p>
</div>
<div class="flex bg-surface-container-low p-1 rounded-lg border border-outline-variant">
<button class="px-4 py-2 rounded-md text-label-sm font-label-sm transition-all bg-surface-container-lowest text-primary soft-inset-shadow" id="view-week">Mingguan</button>
<button class="px-4 py-2 rounded-md text-label-sm font-label-sm transition-all text-on-surface-variant hover:bg-surface-container-highest/20" id="view-month">Bulanan</button>
</div>
</div>
<div class="h-[400px] w-full relative">
<canvas height="500" id="consumptionChart" style="display: block; box-sizing: border-box; height: 400px; width: 870.4px;" width="1088"></canvas>
</div>
</div>
<!-- Skrip Interaksi Dashboard -->
<script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('consumptionChart').getContext('2d');
                    
                    const weekData = {
                        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        datasets: [{
                            label: 'Konsumsi Energi (kWh)',
                            data: [42, 38, 55, 48, 62, 35, 30],
                            backgroundColor: '#1d4ed8',
                            borderRadius: 4,
                            barThickness: 32,
                        }]
                    };

                    const monthData = {
                        labels: ['Minggu Ke-1', 'Minggu Ke-2', 'Minggu Ke-3', 'Minggu Ke-4'],
                        datasets: [{
                            label: 'Konsumsi Energi (kWh)',
                            data: [320, 410, 380, 445],
                            backgroundColor: '#1d4ed8',
                            borderRadius: 4,
                            barThickness: 48,
                        }]
                    };

                    let currentChart = new Chart(ctx, {
                        type: 'bar',
                        data: weekData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#E5E7EB', drawBorder: false },
                                    ticks: { color: '#434655', font: { family: 'Inter', size: 12 } }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { color: '#434655', font: { family: 'Inter', size: 12, weight: '600' } }
                                }
                            }
                        }
                    });

                    // Toggle Logic
                    const weekBtn = document.getElementById('view-week');
                    const monthBtn = document.getElementById('view-month');

                    function setActive(btn, other) {
                        btn.classList.add('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
                        btn.classList.remove('text-on-surface-variant');
                        other.classList.remove('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
                        other.classList.add('text-on-surface-variant');
                    }

                    weekBtn.addEventListener('click', () => {
                        setActive(weekBtn, monthBtn);
                        currentChart.data = weekData;
                        currentChart.update();
                    });

                    monthBtn.addEventListener('click', () => {
                        setActive(monthBtn, weekBtn);
                        currentChart.data = monthData;
                        currentChart.update();
                    });
                });
            </script>
</main>
@endsection

@push('head_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
