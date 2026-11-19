@extends('layouts.master')

@section('title', 'Volt Energy - Tambah Perangkat')
@section('page_title', 'Perhitungan Konsumsi Energi & Biaya')
@section('page_subtitle', 'Masukkan detail perangkat untuk menghitung konsumsi kWh dan estimasi biaya listrik.')

@section('content')
    <main class="flex-1 min-w-0">
        <div class="p-margin-desktop max-w-container-max mx-auto space-y-6">

            @include('partials.alert')

            <div class="grid grid-cols-12 gap-gutter">

                <!-- Left: Form Detail Perangkat -->
                <div class="col-span-12 lg:col-span-7">
                    <section
                        class="bg-surface-container-lowest border border-outline-variant rounded-lg soft-inset-shadow overflow-hidden">
                        <header class="px-6 py-4 border-b border-outline-variant flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary" data-icon="notes">notes</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Detail Perangkat</h3>
                            </div>
                        </header>

                        <form id="form_perangkat" action="{{ route('add-device.store') }}" method="POST"
                            class="p-6 space-y-6">
                            @csrf

                            <!-- Nama Perangkat -->
                            <div class="space-y-2">
                                <label for="device_name"
                                    class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm" data-icon="monitor">monitor</span>
                                    NAMA PERANGKAT
                                </label>
                                <input
                                    class="w-full bg-white border @error('nama_perangkat') border-error @else border-outline-variant @enderror rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none"
                                    id="device_name" name="nama_perangkat"
                                    placeholder="Contoh: AC Kamar, TV LED, Kulkas 2 Pintu" type="text"
                                    value="{{ old('nama_perangkat') }}" required />
                                @error('nama_perangkat')
                                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- DAYA PERANGKAT -->
                            <div class="space-y-2">
                                <label for="power_rating"
                                    class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm" data-icon="bolt">bolt</span>
                                    DAYA PERANGKAT (WATT)
                                </label>
                                <div class="relative">
                                    <input
                                        class="w-full bg-white border @error('daya') border-error @else border-outline-variant @enderror rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none"
                                        id="power_rating" name="daya" type="number" step="any" min="1"
                                        max="100000" value="{{ old('daya', $calculator['defaultPower'] ?? 100) }}"
                                        required />
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-label-md">Watts</span>
                                </div>
                                @error('daya')
                                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- DURASI PEMAKAIAN Slider & Text -->
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <label for="daily_usage"
                                        class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm" data-icon="schedule">schedule</span>
                                        DURASI PEMAKAIAN (JAM PER HARI)
                                    </label>
                                    <span class="text-primary font-bold text-headline-sm"
                                        id="usage_value">{{ old('waktu_penggunaan', $calculator['defaultUsage'] ?? 8) }}
                                        jam</span>
                                </div>
                                <input class="w-full accent-primary cursor-pointer" id="daily_usage" name="waktu_penggunaan"
                                    max="24" min="0.5" step="0.5" type="range"
                                    value="{{ old('waktu_penggunaan', $calculator['defaultUsage'] ?? 8) }}" required />
                                <div class="flex justify-between text-label-sm text-on-surface-variant px-1">
                                    <span>0,5 jam</span>
                                    <span>12 jam</span>
                                    <span>24 jam</span>
                                </div>
                                @error('waktu_penggunaan')
                                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tarif Per-kWh -->
                            <div class="space-y-2">
                                <label for="utility_tariff"
                                    class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm" data-icon="payments">payments</span>
                                    TARIF LISTRIK (RP/KWH)
                                </label>
                                <div class="relative">
                                    <input
                                        class="w-full bg-white border @error('tarif_listrik') border-error @else border-outline-variant @enderror rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none"
                                        id="utility_tariff" name="tarif_listrik" step="any" min="1"
                                        max="1000000" type="number" value="{{ old('tarif_listrik', 1444) }}" required />
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-label-md">Rp/kWh</span>
                                </div>
                                @error('tarif_listrik')
                                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Form Buttons -->
                            <div class="flex gap-4 pt-4">
                                <a href="{{ route('add-device.reset') }}"
                                    class="flex-1 py-3 border border-outline-variant text-primary font-bold rounded-lg hover:bg-surface-container-low transition-colors text-label-md text-center inline-flex items-center justify-center gap-2"
                                    id="reset_btn">
                                    <span class="material-symbols-outlined text-sm">restart_alt</span>
                                    Reset
                                </a>
                                <button
                                    class="flex-[2] py-3 bg-[#16A34A] text-white font-bold rounded-lg hover:bg-[#15803d] transition-colors flex items-center justify-center gap-2 text-label-md shadow-sm"
                                    id="save_btn" type="submit">
                                    <span class="material-symbols-outlined text-lg" data-icon="save">save</span>
                                    Simpan Perangkat
                                </button>
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Right: Results Display -->
                <div class="col-span-12 lg:col-span-5 space-y-gutter">
                    <!-- Primary Blue Card -->
                    <div class="bg-primary-container rounded-lg p-8 text-on-secondary shadow-lg relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <p class="text-label-sm font-label-sm opacity-80 mb-2 uppercase tracking-widest">ESTIMASI BIAYA
                                BULANAN</p>
                            <h4 class="text-display-lg font-display-lg mb-8" id="result_monthly_cost">Rp0</h4>
                            <div class="space-y-4 pt-6 border-t border-white/20">
                                <div class="flex justify-between items-center">
                                    <span class="text-label-md opacity-70">Konsumsi Energi Bulanan</span>
                                    <span class="font-bold text-body-lg" id="result_monthly_energy">0,00 kWh</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-label-md opacity-70">Rata-rata Biaya Harian</span>
                                    <span class="font-bold text-body-lg" id="result_daily_cost">Rp0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-label-md opacity-70">Biaya Mingguan</span>
                                    <span class="font-bold text-body-lg" id="result_weekly_cost">Rp0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Supplemental Data Cards -->
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
                            <p class="text-label-sm font-label-sm text-on-surface-variant mb-1 uppercase">KONSUMSI HARIAN
                            </p>
                            <p class="text-headline-sm font-headline-sm text-primary" id="result_daily_energy">0,00 kWh
                            </p>
                        </div>
                        <div
                            class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
                            <p class="text-label-sm font-label-sm text-on-surface-variant mb-1 uppercase">KONSUMSI MINGGUAN
                            </p>
                            <p class="text-headline-sm font-headline-sm text-primary" id="result_weekly_energy">0,00 kWh
                            </p>
                        </div>
                    </div>

                    <!-- Info/Tip Card -->
                    <div class="bg-surface-container border border-outline-variant rounded-lg p-6 flex gap-4 items-start">
                        <span class="material-symbols-outlined text-primary-container"
                            data-icon="lightbulb">lightbulb</span>
                        <div>
                            <h5 class="font-bold text-label-md text-on-surface mb-1">Tips Efisiensi</h5>
                            <p class="text-label-sm text-on-surface-variant leading-relaxed">
                                Daya listrik dihitung otomatis dengan rumus <code
                                    class="bg-white/60 px-1 py-0.5 rounded font-mono text-primary">(Watt x Jam) /
                                    1000</code>. Kurangi durasi pemakaian perangkat berdaya tinggi untuk menurunkan tagihan
                                listrik secara signifikan.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        window.__CALCULASI_URL__ = "{{ route('kalkulasi.hitung') }}";
    </script>
    <script src="{{ asset('js/add-device.js') }}"></script>
@endpush
