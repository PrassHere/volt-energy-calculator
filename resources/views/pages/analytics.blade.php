@extends('layouts.master')

@section('title', 'Volt Energy - Analytics')
@section('page_title', 'Grafik & Analisis Overview')
@section('user_name', 'Alex Steventio')

@section('header_actions')
<div class="flex bg-surface-container-low p-1 rounded-lg border border-outline-variant">
    <button class="px-4 py-1 text-label-sm font-label-sm bg-surface-container-lowest text-primary soft-inset-shadow rounded transition-all"
            id="toggle-week" type="button">Minggu</button>
    <button class="px-4 py-1 text-label-sm font-label-sm text-on-surface-variant hover:text-on-surface transition-all"
            id="toggle-month" type="button">Bulan</button>
</div>
@endsection

@section('content')
<main class="flex-1 min-w-0"><div class="p-8 space-y-8 max-w-[1400px]">
<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<!-- Total Konsumsi Energi Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex justify-between items-start">
<div class="space-y-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined" style='font-variation-settings: "FILL" 1;'>bolt</span>
</div>
<span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Total Konsumsi Energi</span>
</div>
<div class="space-y-1">
<h3 class="text-display-lg font-display-lg text-on-surface">1,284.5 <span class="text-headline-sm font-headline-sm text-on-surface-variant">kWh</span></h3>
</div>
</div>
<div class="flex items-center gap-1 px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full text-label-sm font-label-sm">
<span class="material-symbols-outlined text-[16px]">arrow_downward</span>
                        12% vs bulan lalu
                    </div>
</div>

<!-- Estimasi Biaya Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex justify-between items-start">
<div class="space-y-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-secondary-container/50 flex items-center justify-center text-primary">
<span class="material-symbols-outlined" style='font-variation-settings: "FILL" 1;'>account_balance_wallet</span>
</div>
<span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Estimasi Biaya</span>
</div>
<div class="space-y-1">
<h3 class="text-display-lg font-display-lg text-on-surface">Rp241.08</h3>
</div>
</div>
<div class="flex items-center gap-1 px-3 py-1 bg-error-container text-on-error-container rounded-full text-label-sm font-label-sm">
<span class="material-symbols-outlined text-[16px]">arrow_upward</span>
                        3% vs dari perkiraan
                    </div>
</div>
</div>

<!-- Side-by-Side Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
<!-- Total Konsumsi Energi Bar Chart -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow">
<div class="flex justify-between items-center mb-8 border-b border-outline-variant pb-4">
<h4 class="text-headline-sm font-headline-sm text-on-surface">Total Konsumsi Energi</h4>
<span class="text-label-sm font-label-sm text-on-surface-variant">Rata-rata Harian: 42.1 kWh</span>
</div>
<div class="h-64 flex items-end justify-between gap-2 px-2">

<!-- Senin -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[40%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">38kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Senin</span>
</div>

<!-- Selasa -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[65%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">52kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Selasa</span>
</div>

<!-- Rabu -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[55%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">45kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Rabu</span>
</div>

<!-- Kamis -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[85%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">68kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Kamis</span>
</div>

<!-- Jumat -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[70%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">58kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Jumat</span>
</div>

<!-- Sabtu -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[45%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">41kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">Sabtu</span>
</div>

<!-- Minggu -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container h-[35%] rounded-t-sm transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-100 transition-opacity">32kWh</div>
</div>
<span class="text-label-sm font-label-sm text-primary font-bold">Minggu</span>
</div>
</div>
</div>

<!-- Alokasi Perangkat Donut Chart -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow">
<div class="flex justify-between items-center mb-8 border-b border-outline-variant pb-4">
<h4 class="text-headline-sm font-headline-sm text-on-surface">Alokasi Perangkat</h4>
<span class="text-label-sm font-label-sm text-on-surface-variant">1 Okt - 7 Okt</span>
</div>
<div class="flex items-center justify-around h-64">
<!-- Custom SVG Donut -->
<div class="relative w-48 h-48">
<svg class="w-full h-full transform -rotate-90" viewbox="0 0 100 100">
<!-- Base Circle -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#E5E7EB" stroke-width="12"></circle>
<!-- HVAC 45% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#1D4ED8" stroke-dasharray="251.2" stroke-dashoffset="138.16" stroke-width="12"></circle>
<!-- Lighting 25% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#60A5FA" stroke-dasharray="251.2" stroke-dashoffset="200.96" stroke-width="12" transform="rotate(162 50 50)"></circle>
<!-- Appliances 20% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#93C5FD" stroke-dasharray="251.2" stroke-dashoffset="213.52" stroke-width="12" transform="rotate(252 50 50)"></circle>
<!-- Others 10% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#DBEAFE" stroke-dasharray="251.2" stroke-dashoffset="238.64" stroke-width="12" transform="rotate(324 50 50)"></circle>
</svg>
<div class="absolute inset-0 flex flex-col items-center justify-center">
<span class="text-display-lg font-display-lg leading-tight">45%</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">HVAC</span>
</div>
</div>
<!-- Legend -->
<div class="space-y-3">
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#1D4ED8]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">AC/Pendingin</span>
<span class="text-label-md font-label-md text-on-surface-variant">45%</span>
</div>
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#60A5FA]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">Pencahayaan</span>
<span class="text-label-md font-label-md text-on-surface-variant">25%</span>
</div>
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#93C5FD]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">Alat Elektronik</span>
<span class="text-label-md font-label-md text-on-surface-variant">20%</span>
</div>
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#DBEAFE]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">Lainnya</span>
<span class="text-label-md font-label-md text-on-surface-variant">10%</span>
</div>
</div>
</div>
</div>
</div>
<!-- Full-Width Cost Projection Chart -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow">
<div class="flex justify-between items-center mb-8 border-b border-outline-variant pb-4">
<div class="space-y-1">
<h4 class="text-headline-sm font-headline-sm text-on-surface">Proyeksi Biaya</h4>
<p class="text-body-md font-body-md text-on-surface-variant">Berdasarkan pola penggunaan dan tarif utilitas saat ini</p>
</div>
<div class="flex gap-4">
<div class="flex items-center gap-2">
<span class="w-4 h-0.5 bg-primary"></span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Biaya Aktual</span>
</div>
<div class="flex items-center gap-2">
<span class="w-4 h-0.5 border-t-2 border-dashed border-outline"></span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Anggaran yang Diprojeksikan</span>
</div>
</div>
</div>
<div class="relative h-80 w-full">
<!-- Simple SVG Line Chart Placeholder for professional look -->
<svg class="w-full h-full overflow-visible" preserveaspectratio="none" viewbox="0 0 1000 300">
<!-- Grid Lines -->
<line class="chart-grid-line" x1="0" x2="1000" y1="300" y2="300"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="225" y2="225"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="150" y2="150"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="75" y2="75"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="0" y2="0"></line>
<!-- Projected Budget Line (Dashed) -->
<polyline fill="none" points="0,200 250,180 500,160 750,140 1000,120" stroke="#94A3B8" stroke-dasharray="8,4" stroke-width="2"></polyline>
<!-- Actual Cost Line (Solid Blue) -->
<path d="M 0 250 Q 125 240, 250 210 T 500 180 T 750 145" fill="none" stroke="#1D4ED8" stroke-linecap="round" stroke-width="3"></path>
<!-- Data Point -->
<circle cx="750" cy="145" fill="#1D4ED8" r="5" stroke="white" stroke-width="2"></circle>
</svg>
<!-- X-Axis Labels -->
<div class="flex justify-between mt-4 px-4">
<span class="text-label-sm font-label-sm text-on-surface-variant">Minggu ke-1</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Minggu ke-2</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Minggu ke-3</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Minggu ke-4</span>
</div>
<!-- Y-Axis Labels -->
<div class="absolute -left-12 inset-y-0 flex flex-col justify-between text-label-sm font-label-sm text-on-surface-variant py-0">
<span class="">Rp400.000</span>
<span class="">Rp300.000</span>
<span class="">Rp200.000</span>
<span class="">Rp100.000</span>
<span class="">Rp0</span>
</div>
</div>
</div>
</div></main>
@endsection

@push('scripts')
<script src="{{ asset('js/analytics.js') }}"></script>
@endpush
