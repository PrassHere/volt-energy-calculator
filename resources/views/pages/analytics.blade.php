@extends('layouts.master')

@section('title', 'Volt Energy - Analytics')
@section('page_title', 'Grafik & Analisis Konsumsi Energi')
@section('page_subtitle', 'Analisis komprehensif pola konsumsi energi, perkiraan biaya, dan alokasi per perangkat.')

@section('header_actions')
    <div class="flex bg-surface-container-low p-1 rounded-lg border border-outline-variant">
        <button
            class="px-4 py-1.5 text-label-sm font-label-sm bg-surface-container-lowest text-primary soft-inset-shadow rounded transition-all font-semibold"
            id="toggle-week" type="button">Mingguan</button>
        <button
            class="px-4 py-1.5 text-label-sm font-label-sm text-on-surface-variant hover:text-on-surface transition-all font-semibold"
            id="toggle-month" type="button">Bulanan</button>
    </div>
@endsection

@section('content')
    <main class="flex-1 min-w-0">
        <div class="p-8 space-y-8 max-w-[1400px] mx-auto">

            @include('partials.alert')

            @if ($kosong)
                <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6 text-center space-y-3">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[28px]">query_stats</span>
                    </div>
                    <h3 class="font-bold text-headline-sm text-on-surface">Data Analisis Belum Tersedia</h3>
                    <p class="text-body-md text-on-surface-variant max-w-md mx-auto">
                        Anda belum memiliki data perangkat. Tambahkan perangkat untuk mengaktifkan grafik analisis energi,
                        alokasi per alat, dan proyeksi biaya.
                    </p>
                    <div>
                        <a href="{{ route('add-device') }}"
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary-container transition-colors text-label-md">
                            <span class="material-symbols-outlined text-[20px]">add</span>
                            Tambah Perangkat Sekarang
                        </a>
                    </div>
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                <!-- Total Konsumsi Energi Card -->
                <div
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex justify-between items-start">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined"
                                    style='font-variation-settings: "FILL" 1;'>bolt</span>
                            </div>
                            <span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Total
                                Konsumsi Energi Bulanan</span>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-display-lg font-display-lg text-on-surface">
                                {{ $ringkasan['teks_kwh_bulanan'] }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-1 px-3 py-1 {{ $ringkasan['tren_arah_konsumsi'] === 'turun' ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-secondary-container text-on-secondary-container' }} rounded-full text-label-sm font-label-sm">
                        <span class="material-symbols-outlined text-[16px]">
                            {{ $ringkasan['tren_arah_konsumsi'] === 'turun' ? 'arrow_downward' : 'trending_up' }}
                        </span>
                        {{ $ringkasan['persen_konsumsi'] }}% vs acuan bulan lalu
                    </div>
                </div>

                <!-- Estimasi Biaya Card -->
                <div
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex justify-between items-start">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-secondary-container/50 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined"
                                    style='font-variation-settings: "FILL" 1;'>account_balance_wallet</span>
                            </div>
                            <span
                                class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Estimasi
                                Pengeluaran Bulanan</span>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-display-lg font-display-lg text-on-surface">
                                {{ $ringkasan['teks_biaya_bulanan'] }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-1 px-3 py-1 bg-surface-container text-on-surface-variant rounded-full text-label-sm font-label-sm border border-outline-variant">
                        <span class="material-symbols-outlined text-[16px]">payments</span>
                        Mingguan: {{ $ringkasan['teks_biaya_mingguan'] }}
                    </div>
                </div>
            </div>

            <!-- Side-by-Side Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
                <!-- Total Konsumsi Energi Bar Chart -->
                <div
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex flex-col">
                    <div class="flex justify-between items-center mb-6 border-b border-outline-variant pb-4">
                        <div>
                            <h4 class="text-headline-sm font-headline-sm text-on-surface">Tren Penggunaan Energi</h4>
                            <p class="text-xs text-on-surface-variant">Rata-rata Konsumsi Harian:
                                {{ $ringkasan['rata_rata_harian'] }}</p>
                        </div>
                        <span class="text-label-sm font-semibold text-primary bg-primary/10 px-2.5 py-1 rounded-full"
                            id="activePeriodLabel">Mingguan</span>
                    </div>

                    <div class="relative h-64 w-full flex items-center justify-center flex-1">
                        @if ($kosong)
                            <div class="text-center p-6 space-y-2">
                                <span class="material-symbols-outlined text-outline text-[32px]">bar_chart</span>
                                <p class="text-sm text-on-surface-variant font-medium">Belum ada data konsumsi untuk
                                    ditampilkan pada grafik.</p>
                            </div>
                        @else
                            <canvas id="analyticsConsumptionChart"></canvas>
                        @endif
                    </div>
                </div>

                <!-- Alokasi Perangkat Donut Chart -->
                <div
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex flex-col">
                    <div class="flex justify-between items-center mb-6 border-b border-outline-variant pb-4">
                        <div>
                            <h4 class="text-headline-sm font-headline-sm text-on-surface">Proporsi Pemakaian Perangkat</h4>
                            <p class="text-xs text-on-surface-variant">Distribusi pemakaian energi tiap alat elektronik</p>
                        </div>
                        <span class="text-label-sm text-on-surface-variant">{{ count($alokasi['items']) }} Perangkat</span>
                    </div>

                    @if ($kosong || empty($alokasi['items']))
                        <div class="h-64 flex items-center justify-center text-center p-6 space-y-2 flex-col">
                            <span class="material-symbols-outlined text-outline text-[32px]">pie_chart</span>
                            <p class="text-sm text-on-surface-variant font-medium">Belum ada data alokasi perangkat.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center flex-1">
                            <div class="md:col-span-6 relative h-56 flex items-center justify-center">
                                <canvas id="deviceAllocationChart"></canvas>
                            </div>
                            <div class="md:col-span-6 space-y-2.5 max-h-56 overflow-y-auto pr-2">
                                @foreach ($alokasi['items'] as $item)
                                    <div
                                        class="flex items-center justify-between text-xs p-1.5 rounded hover:bg-surface-container-low transition-colors">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <span class="w-3 h-3 rounded-full shrink-0"
                                                style="background-color: {{ $item['warna'] }};"></span>
                                            <span class="text-on-surface font-medium truncate"
                                                title="{{ $item['nama'] }}">{{ $item['nama'] }}</span>
                                        </div>
                                        <div class="text-right shrink-0 pl-2">
                                            <span class="font-bold text-on-surface">{{ $item['persentase'] }}%</span>
                                            <span
                                                class="text-[10px] text-on-surface-variant block">{{ $item['kwh_harian'] }}
                                                kWh/hari</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Proyeksi Biaya Chart -->
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow">
                <div
                    class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6 border-b border-outline-variant pb-4">
                    <div class="space-y-1">
                        <h4 class="text-headline-sm font-headline-sm text-on-surface">Proyeksi & Tren Biaya Listrik</h4>
                        <p class="text-body-md font-body-md text-on-surface-variant">Estimasi akumulasi pengeluaran biaya
                            listrik bulanan berdasarkan tarif perangkat.</p>
                    </div>
                    <div class="flex items-center gap-4 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-3.5 h-3.5 rounded bg-primary"></span>
                            <span class="text-on-surface-variant font-medium">Biaya Aktual</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3.5 h-1 border-t-2 border-dashed border-outline"></span>
                            <span class="text-on-surface-variant font-medium">Target Anggaran</span>
                        </div>
                    </div>
                </div>

                <div class="relative h-72 w-full">
                    @if ($kosong)
                        <div class="h-full flex items-center justify-center text-center p-6 space-y-2 flex-col">
                            <span class="material-symbols-outlined text-outline text-[32px]">ssid_chart</span>
                            <p class="text-sm text-on-surface-variant font-medium">Belum ada data proyeksi biaya untuk
                                ditampilkan.</p>
                        </div>
                    @else
                        <canvas id="costProjectionChart"></canvas>
                    @endif
                </div>
            </div>

        </div>
    </main>
@endsection

@push('head_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('scripts')
    <script>
        window.__ANALYTICS_DATA__ = {
            tren: @json($tren),
            alokasi: @json($alokasi),
            ringkasan: @json($ringkasan),
            kosong: @json($kosong)
        };
    </script>
    <script src="{{ asset('js/analytics.js') }}"></script>
@endpush
