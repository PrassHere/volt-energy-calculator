@extends('layouts.master')

@section('title', 'Volt Energy - Dashboard')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle')
    Selamat datang, {{ auth()->user()?->nama ?? 'Pengguna' }}. Pantau konsumsi energi dan estimasi biaya listrik Anda.
@endsection

@section('content')
    <main class="p-8 max-w-container-max mx-auto w-full space-y-6">

        @include('partials.alert')

        {{-- Banner Akun Demo --}}
        @if ($akunDemo)
            <div class="bg-primary/10 border border-primary/20 rounded-lg p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-[24px]">info</span>
                    <div>
                        <p class="font-semibold text-primary text-sm">Mode Demo Aktif</p>
                        <p class="text-xs text-on-surface-variant">Anda sedang melihat data simulasi contoh. Anda dapat
                            menambahkan data perangkat baru melalui menu Tambah Perangkat.</p>
                    </div>
                </div>
                <a href="{{ route('add-device') }}"
                    class="px-4 py-2 bg-primary text-white rounded text-xs font-semibold hover:bg-primary-container transition-colors">
                    Tambah Perangkat
                </a>
            </div>
        @endif

        {{-- Banner Data Kosong --}}
        @if ($kosong)
            <div class="bg-surface-container-low border border-outline-variant rounded-lg p-6 text-center space-y-3">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-[28px]">devices</span>
                </div>
                <h3 class="font-bold text-headline-sm text-on-surface">Belum Ada Perangkat Terdaftar</h3>
                <p class="text-body-md text-on-surface-variant max-w-md mx-auto">
                    Mulai hitung konsumsi listrik dan perkiraan pengeluaran dengan menambahkan perangkat elektronik Anda
                    sekarang.
                </p>
                <div>
                    <a href="{{ route('add-device') }}"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary-container transition-colors text-label-md">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        Tambah Perangkat Pertama
                    </a>
                </div>
            </div>
        @endif

        <!-- Kartu Rangkuman Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Total Perangkat Aktif -->
            <div
                class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary">
                <div class="flex justify-between items-start mb-4">
                    <div class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary" data-icon="devices">devices</span>
                    </div>
                    <span
                        class="bg-primary-container/10 text-primary text-[11px] font-bold px-2.5 py-1 rounded-full">Aktif</span>
                </div>
                <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Total Perangkat
                    Terdaftar</p>
                <h3 class="text-display-lg font-display-lg text-on-surface mt-1">{{ $kartu['total_perangkat'] }}</h3>
                <div class="mt-4 flex items-center gap-2 text-label-sm text-tertiary">
                    <span class="material-symbols-outlined text-[16px]"
                        style='font-variation-settings: "FILL" 1;'>check_circle</span>
                    <span>{{ $kosong ? 'Belum ada data' : 'Terhubung ke kalkulator' }}</span>
                </div>
            </div>

            <!-- Card 2: Total kWh Bulanan -->
            <div
                class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary">
                <div class="flex justify-between items-start mb-4">
                    <div class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary" data-icon="bolt">bolt</span>
                    </div>
                    <span class="bg-primary-container/10 text-primary text-[11px] font-bold px-2.5 py-1 rounded-full">Per
                        Bulan</span>
                </div>
                <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Total Konsumsi
                    Bulanan</p>
                <h3 class="text-display-lg font-display-lg text-on-surface mt-1">{{ $kartu['kwh_bulanan'] }}</h3>
                <div
                    class="mt-4 flex items-center gap-2 text-label-sm text-on-surface-variant bg-surface-container-low px-2 py-1 rounded border border-outline-variant/30">
                    <span class="text-[11px] font-medium text-on-surface-variant">Estimasi 30 hari pemakaian</span>
                </div>
            </div>

            <!-- Card 3: Perkiraan Pengeluaran Bulanan -->
            <div
                class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary">
                <div class="flex justify-between items-start mb-4">
                    <div class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary"
                            data-icon="account_balance_wallet">account_balance_wallet</span>
                    </div>
                    <span
                        class="bg-tertiary-container/10 text-tertiary text-[11px] font-bold px-2.5 py-1 rounded-full">Estimasi
                        Biaya</span>
                </div>
                <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Perkiraan
                    Pengeluaran Bulanan</p>
                <h3 class="text-display-lg font-display-lg text-on-surface mt-1">{{ $kartu['biaya_bulanan'] }}</h3>
                <div class="mt-4 flex items-center gap-2 text-label-sm text-on-surface-variant">
                    <span class="h-2 w-2 bg-tertiary rounded-full"></span>
                    <span>Berdasarkan tarif listrik terdaftar</span>
                </div>
            </div>
        </div>

        <!-- Grafik Penggunaan Energi -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-8 soft-inset-shadow">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-8">
                <div>
                    <h4 class="text-headline-sm font-headline-sm text-on-surface">Grafik Tren Konsumsi Energi</h4>
                    <p class="text-body-md font-body-md text-on-surface-variant">Visualisasi penggunaan energi listrik (kWh)
                        per periode.</p>
                </div>
                <div
                    class="flex bg-surface-container-low p-1 rounded-lg border border-outline-variant self-start sm:self-auto">
                    <button
                        class="px-4 py-2 rounded-md text-label-sm font-label-sm transition-all bg-surface-container-lowest text-primary soft-inset-shadow font-semibold"
                        id="view-week" type="button">Mingguan</button>
                    <button
                        class="px-4 py-2 rounded-md text-label-sm font-label-sm transition-all text-on-surface-variant hover:bg-surface-container-highest/20 font-semibold"
                        id="view-month" type="button">Bulanan</button>
                </div>
            </div>
            <div class="h-[400px] w-full relative">
                <canvas id="consumptionChart"></canvas>
            </div>
        </div>

    </main>
@endsection

@push('head_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('scripts')
    <script>
        window.__DASHBOARD_DATA__ = {
            week: @json($tren['week'] ?? ['labels' => [], 'data' => []]),
            month: @json($tren['month'] ?? ['labels' => [], 'data' => []])
        };
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
