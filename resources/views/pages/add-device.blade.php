@extends('layouts.master')

@section('title', 'Volt Energy - Add Device')
@section('page_title', 'Perhitungan Konsumsi Energi & Biaya')
@section('user_name', 'Alex Steventio')

@section('content')
<main class="flex-1 min-w-0"><div class="p-margin-desktop max-w-container-max mx-auto">
<div class="grid grid-cols-12 gap-gutter">

<!-- Left: Form Detail Perangkat -->
<div class="col-span-12 lg:col-span-7">
<section class="bg-surface-container-lowest border border-outline-variant rounded-lg soft-inset-shadow overflow-hidden">
<header class="px-6 py-4 border-b border-outline-variant flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary" data-icon="notes">notes</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Detail Perangkat</h3>
</div>
</header>
<div class="p-6 space-y-6">

<!-- Nama Perangkat -->
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="monitor">monitor</span>
                                    NAMA PERANGKAT
                                </label>
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none" id="device_name" placeholder="TV, Kulkas, AC, dll" type="text"/>
</div>

<!-- DAYA PERANGKAT -->
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="bolt">bolt</span>
                                    DAYA PERANGKAT (W)
                                </label>
<div class="relative">
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none" id="power_rating" type="number" value="100"/>
<span class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-label-md">Watts</span>
</div>
</div>

<!-- DURASI PEMAKAIAN Slider -->
<div class="space-y-4">
<div class="flex justify-between items-center">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="schedule">schedule</span>
                                        DURASI PEMAKAIAN (JAM)
                                    </label>
<span class="text-primary font-bold text-headline-sm" id="usage_value">8 jam</span>
</div>
<input id="daily_usage" max="24" min="0" step="0.5" type="range" value="8"/>
<div class="flex justify-between text-label-sm text-on-surface-variant px-1">
<span class="">0 jam</span>
<span class="">12 jam</span>
<span class="">24 jam</span>
</div>
</div>

<!-- Tarif Per-kWh -->
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="payments">payments</span>
                                    Tarif Per-kWh (Rp/kWh)
                                </label>
<div class="relative">
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none" id="utility_tariff" step="0.01" type="number" value="0.15"/>
<span class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-label-md">Rp/kWh</span>
</div>
</div>

<!-- Form Buttons -->
<div class="flex gap-4 pt-4">
<button class="flex-1 py-3 border border-outline-variant text-primary font-bold rounded-lg hover:bg-surface-container-low transition-colors text-label-md" id="reset_btn">
                                    Reset
                                </button>
<button class="flex-[2] py-3 bg-[#16A34A] text-white font-bold rounded-lg hover:bg-[#15803d] transition-colors flex items-center justify-center gap-2 text-label-md" id="save_btn">
<span class="material-symbols-outlined text-lg" data-icon="save">save</span>
                                    Simpan
                                </button>
</div>
</div>
</section>
</div>

<!-- Right: Results Display -->
<div class="col-span-12 lg:col-span-5 space-y-gutter">
<!-- Primary Blue Card -->
<div class="bg-primary-container rounded-lg p-8 text-on-secondary shadow-lg relative overflow-hidden">
<!-- Abstract Background Decoration -->
<div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
<div class="relative z-10">
<p class="text-label-sm font-label-sm opacity-80 mb-2 uppercase tracking-widest">ESTIMASI BIAYA BULANAN</p>
<h4 class="text-display-lg font-display-lg mb-8" id="result_monthly_cost">Rp50.000/bulan</h4>
<div class="space-y-4 pt-6 border-t border-white/20">
<div class="flex justify-between items-center">
<span class="text-label-md opacity-70">Konsumsi Energi Bulanan</span>
<span class="font-bold text-body-lg" id="result_monthly_energy">24.0 kWh</span>
</div>
<div class="flex justify-between items-center">
<span class="text-label-md opacity-70">Rata-rata Biaya Harian</span>
<span class="font-bold text-body-lg" id="result_daily_cost">Rp30.000</span>
</div>
</div>
</div>
</div>

<!-- Supplemental Data Cards -->
<div class="grid grid-cols-2 gap-4">
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
<p class="text-label-sm font-label-sm text-on-surface-variant mb-1">KONSUMSI ENERGI HARIAN</p>
<p class="text-headline-sm font-headline-sm text-primary" id="result_daily_energy">0.80 kWh</p>
</div>
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
<p class="text-label-sm font-label-sm text-on-surface-variant mb-1">KONSUMSI ENERGI MINGGUAN</p>
<p class="text-headline-sm font-headline-sm text-primary" id="result_weekly_energy">5.60 kWh</p>
</div>
</div>

<!-- Info/Tip Card -->
<div class="bg-surface-container border border-outline-variant rounded-lg p-6 flex gap-4 items-start">
<span class="material-symbols-outlined text-primary-container" data-icon="lightbulb">lightbulb</span>
<div>
<h5 class="font-bold text-label-md text-on-surface mb-1">Pro Tip</h5>
<p class="text-label-sm text-on-surface-variant leading-relaxed">Menghemat konsumsi energi listrik selama 2 jam bisa mengurangi pengeluaranmu sampai 25% untuk perangkat berdaya tinggi.</p>
</div>
</div>
</div>
</div>
</div></main>
@endsection

@push('scripts')
<script src="{{ asset('js/add-device.js') }}"></script>
@endpush
