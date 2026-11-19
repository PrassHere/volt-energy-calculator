@extends('layouts.master')

@section('title', 'Volt Energy - Riwayat Hitungan & Rekap')
@section('page_title', 'Riwayat Hitungan & Rekapitulasi')
@section('page_subtitle', 'Tinjau, cari, saring, ubah, dan ekspor data perangkat serta estimasi konsumsi energi.')

@section('content')
    <main class="p-margin-desktop max-w-container-max mx-auto space-y-6">

        @include('partials.alert')

        <!-- Heading & Actions -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-display-lg font-display-lg text-on-surface">Riwayat Perangkat</h2>
                <p class="text-body-md font-body-md text-on-surface-variant">
                    Total {{ $total['jumlah_perangkat'] }} perangkat terdata dalam riwayat kalkulasi.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <!-- Tombol Toggle Filter -->
                <button id="btnToggleFilter" type="button"
                    class="flex items-center px-4 py-2.5 border border-outline-variant bg-surface-container-lowest text-on-surface-variant rounded-lg hover:bg-surface-container-low transition-colors text-label-md font-label-md">
                    <span class="material-symbols-outlined text-[20px] mr-2" data-icon="filter_list">filter_list</span>
                    Filter & Urutkan
                </button>

                <!-- Tombol Ekspor CSV -->
                <a id="btnExport" href="{{ route('history.export', request()->query()) }}"
                    class="flex items-center px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-container transition-colors text-label-md font-label-md shadow-sm">
                    <span class="material-symbols-outlined text-[20px] mr-2" data-icon="ios_share">ios_share</span>
                    Ekspor Riwayat (.csv)
                </a>

                <!-- Tombol Tambah Perangkat -->
                <a href="{{ route('add-device') }}"
                    class="flex items-center px-4 py-2.5 bg-[#16A34A] text-white rounded-lg hover:bg-[#15803d] transition-colors text-label-md font-label-md shadow-sm">
                    <span class="material-symbols-outlined text-[20px] mr-2">add</span>
                    Tambah Baru
                </a>
            </div>
        </div>

        <!-- Total Rekap Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
                <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Perangkat Ditemukan
                </p>
                <h3 class="text-headline-md font-bold text-on-surface mt-1">{{ $total['jumlah_perangkat'] }} <span
                        class="text-xs font-normal text-on-surface-variant">Unit</span></h3>
                <p class="text-xs text-on-surface-variant mt-2">Sesuai filter pencarian</p>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
                <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Total kWh Harian</p>
                <h3 class="text-headline-md font-bold text-primary mt-1">
                    {{ number_format($total['kwh']['harian'], 2, ',', '.') }} <span
                        class="text-xs font-normal text-on-surface-variant">kWh</span></h3>
                <p class="text-xs text-on-surface-variant mt-2">Mingguan:
                    {{ number_format($total['kwh']['mingguan'], 2, ',', '.') }} kWh</p>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
                <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Total kWh Bulanan
                </p>
                <h3 class="text-headline-md font-bold text-primary mt-1">
                    {{ number_format($total['kwh']['bulanan'], 2, ',', '.') }} <span
                        class="text-xs font-normal text-on-surface-variant">kWh</span></h3>
                <p class="text-xs text-on-surface-variant mt-2">Estimasi 30 hari</p>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
                <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Total Biaya Bulanan
                </p>
                <h3 class="text-headline-md font-bold text-tertiary mt-1">
                    Rp{{ number_format($total['biaya']['bulanan'], 0, ',', '.') }}</h3>
                @if ($total['biaya_tersimpan_bulan_ini'] !== null)
                    <p class="text-xs text-tertiary mt-2">Tersimpan:
                        Rp{{ number_format($total['biaya_tersimpan_bulan_ini'], 0, ',', '.') }}</p>
                @else
                    <p class="text-xs text-on-surface-variant mt-2">Harian:
                        Rp{{ number_format($total['biaya']['harian'], 0, ',', '.') }}</p>
                @endif
            </div>
        </div>

        <!-- Filter & Pencarian Box -->
        <div id="filterPanel"
            class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow {{ empty($filter['q']) && empty($filter['dari']) && empty($filter['sampai']) && $filter['urut'] === 'tanggal' && $filter['arah'] === 'desc' && $filter['per_halaman'] == 10 ? 'hidden' : '' }}">
            <form id="filterForm" action="{{ route('history') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Kata Kunci -->
                    <div class="md:col-span-4">
                        <label for="filter_q" class="text-xs font-semibold text-on-surface-variant uppercase">Pencarian Nama
                            Perangkat</label>
                        <div class="relative mt-1">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                            <input id="filter_q" name="q" type="text" value="{{ $filter['q'] }}"
                                placeholder="Ketik nama perangkat..."
                                class="w-full pl-9 pr-3 py-2 bg-white border border-outline-variant rounded-md text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none" />
                        </div>
                    </div>

                    <!-- Tanggal Dari -->
                    <div class="md:col-span-2">
                        <label for="filter_dari" class="text-xs font-semibold text-on-surface-variant uppercase">Tanggal
                            Dari</label>
                        <input id="filter_dari" name="dari" type="date" value="{{ $filter['dari'] }}"
                            class="w-full mt-1 px-3 py-2 bg-white border border-outline-variant rounded-md text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none" />
                    </div>

                    <!-- Tanggal Sampai -->
                    <div class="md:col-span-2">
                        <label for="filter_sampai" class="text-xs font-semibold text-on-surface-variant uppercase">Tanggal
                            Sampai</label>
                        <input id="filter_sampai" name="sampai" type="date" value="{{ $filter['sampai'] }}"
                            class="w-full mt-1 px-3 py-2 bg-white border border-outline-variant rounded-md text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none" />
                    </div>

                    <!-- Urutkan Berdasarkan -->
                    <div class="md:col-span-2">
                        <label for="filter_urut"
                            class="text-xs font-semibold text-on-surface-variant uppercase">Urutkan</label>
                        <select id="filter_urut" name="urut"
                            class="w-full mt-1 px-3 py-2 bg-white border border-outline-variant rounded-md text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            <option value="tanggal" {{ $filter['urut'] === 'tanggal' ? 'selected' : '' }}>Tanggal Input
                            </option>
                            <option value="nama" {{ $filter['urut'] === 'nama' ? 'selected' : '' }}>Nama Perangkat
                            </option>
                            <option value="daya" {{ $filter['urut'] === 'daya' ? 'selected' : '' }}>Daya Watt</option>
                            <option value="kwh" {{ $filter['urut'] === 'kwh' ? 'selected' : '' }}>Konsumsi kWh</option>
                            <option value="biaya" {{ $filter['urut'] === 'biaya' ? 'selected' : '' }}>Estimasi Biaya
                            </option>
                        </select>
                    </div>

                    <!-- Arah & Per Halaman -->
                    <div class="md:col-span-2 flex gap-2">
                        <div class="w-1/2">
                            <label for="filter_arah"
                                class="text-xs font-semibold text-on-surface-variant uppercase">Arah</label>
                            <select id="filter_arah" name="arah"
                                class="w-full mt-1 px-2 py-2 bg-white border border-outline-variant rounded-md text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                                <option value="desc" {{ $filter['arah'] === 'desc' ? 'selected' : '' }}>Turun (Z-A)
                                </option>
                                <option value="asc" {{ $filter['arah'] === 'asc' ? 'selected' : '' }}>Naik (A-Z)
                                </option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <label for="filter_per_halaman"
                                class="text-xs font-semibold text-on-surface-variant uppercase">Limit</label>
                            <select id="filter_per_halaman" name="per_halaman"
                                class="w-full mt-1 px-2 py-2 bg-white border border-outline-variant rounded-md text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                                <option value="5" {{ $filter['per_halaman'] == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $filter['per_halaman'] == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $filter['per_halaman'] == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $filter['per_halaman'] == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2 border-t border-outline-variant/40">
                    <a href="{{ route('history') }}"
                        class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-md text-sm hover:bg-surface-container-low transition-colors">
                        Reset Filter
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-primary text-white rounded-md text-sm font-semibold hover:bg-primary-container transition-colors shadow-sm">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Table Card -->
        <div class="bg-white soft-inset-card rounded-lg border border-outline-variant overflow-hidden">
            @if ($daftar->isEmpty())
                <!-- Tampilan Rekap Kosong -->
                <div class="p-12 text-center space-y-4">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-surface-container-low text-on-surface-variant flex items-center justify-center">
                        <span class="material-symbols-outlined text-[36px]">inventory_2</span>
                    </div>
                    <h3 class="text-headline-sm font-bold text-on-surface">Data Rekap Kosong</h3>
                    <p class="text-body-md text-on-surface-variant max-w-md mx-auto">
                        @if (!empty($filter['q']) || !empty($filter['dari']) || !empty($filter['sampai']))
                            Tidak ada perangkat yang cocok dengan kriteria filter atau pencarian Anda.
                        @else
                            Belum ada data perangkat yang dicatat. Silakan tambah perangkat terlebih dahulu.
                        @endif
                    </p>
                    <div class="pt-2 flex justify-center gap-3">
                        @if (!empty($filter['q']) || !empty($filter['dari']) || !empty($filter['sampai']))
                            <a href="{{ route('history') }}"
                                class="px-4 py-2 border border-outline text-primary rounded-lg text-sm font-semibold hover:bg-surface-container-low transition-colors">
                                Hapus Filter
                            </a>
                        @endif
                        <a href="{{ route('add-device') }}"
                            class="px-5 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary-container transition-colors shadow-sm">
                            + Tambah Perangkat Sekarang
                        </a>
                    </div>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant">
                                <th
                                    class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">
                                    Perangkat</th>
                                <th
                                    class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">
                                    Daya</th>
                                <th
                                    class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">
                                    Durasi</th>
                                <th
                                    class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">
                                    Konsumsi (kWh)</th>
                                <th
                                    class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">
                                    Estimasi Biaya</th>
                                <th
                                    class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">
                                    Tanggal Input</th>
                                <th
                                    class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach ($daftar as $item)
                                <tr class="hover:bg-surface-container-lowest transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-primary-container/10 flex items-center justify-center mr-3 text-primary">
                                                <span class="material-symbols-outlined text-[22px]">devices</span>
                                            </div>
                                            <div>
                                                <p class="text-label-md font-semibold text-on-surface">
                                                    {{ $item->nama_perangkat }}</p>
                                                <p class="text-[11px] text-on-surface-variant">Tarif:
                                                    Rp{{ number_format($item->tarif_listrik, 0, ',', '.') }}/kWh</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-body-md font-body-md text-on-surface whitespace-nowrap">
                                        {{ number_format($item->daya, 0, ',', '.') }} W
                                    </td>
                                    <td class="px-6 py-4 text-body-md font-body-md text-on-surface whitespace-nowrap">
                                        {{ str_replace('.', ',', (string) $item->waktu_penggunaan) }} jam/hari
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-body-md font-bold text-primary">
                                            {{ number_format($item->kwh, 2, ',', '.') }} kWh/hari</p>
                                        <p class="text-[11px] text-on-surface-variant">
                                            {{ number_format($item->kwh_bulanan, 2, ',', '.') }} kWh/bulan</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-body-md font-bold text-on-surface">
                                            Rp{{ number_format($item->biaya_bulanan, 0, ',', '.') }}/bln</p>
                                        <p class="text-[11px] text-on-surface-variant">
                                            Rp{{ number_format($item->biaya_harian, 0, ',', '.') }}/hari</p>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-body-md font-body-md text-on-surface-variant whitespace-nowrap">
                                        {{ $item->tanggal_input ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end space-x-1">
                                            <!-- Tombol Edit -->
                                            <button type="button"
                                                class="btn-edit p-2 text-on-surface-variant hover:text-primary transition-colors rounded-md hover:bg-surface-container-low"
                                                title="Ubah Perangkat" data-id="{{ $item->id_perangkat }}"
                                                data-nama="{{ $item->nama_perangkat }}" data-daya="{{ $item->daya }}"
                                                data-jam="{{ $item->waktu_penggunaan }}"
                                                data-tarif="{{ $item->tarif_listrik }}"
                                                data-action="{{ route('perangkat.update', $item) }}">
                                                <span class="material-symbols-outlined text-[20px]"
                                                    data-icon="edit">edit</span>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button type="button"
                                                class="btn-delete p-2 text-on-surface-variant hover:text-error transition-colors rounded-md hover:bg-surface-container-low"
                                                title="Hapus Perangkat" data-id="{{ $item->id_perangkat }}"
                                                data-nama="{{ $item->nama_perangkat }}"
                                                data-action="{{ route('perangkat.destroy', $item) }}">
                                                <span class="material-symbols-outlined text-[20px]"
                                                    data-icon="delete">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Area Pagination -->
                <div
                    class="px-6 py-4 bg-surface-container-low border-t border-outline-variant flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-label-md font-label-md text-on-surface-variant">
                        Menampilkan {{ $daftar->firstItem() ?? 0 }} sampai {{ $daftar->lastItem() ?? 0 }} dari
                        {{ $daftar->total() }} perangkat
                    </p>

                    <div>
                        {{ $daftar->links() }}
                    </div>
                </div>
            @endif
        </div>

    </main>

    <!-- Modal Ubah Data Perangkat -->
    <div id="modalEdit" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden">
        <div
            class="bg-white rounded-xl shadow-2xl max-w-lg w-full overflow-hidden border border-outline-variant animate-in fade-in zoom-in duration-200">
            <header
                class="px-6 py-4 border-b border-outline-variant flex items-center justify-between bg-surface-container-low">
                <h3 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_note</span>
                    Ubah Data Perangkat
                </h3>
                <button id="btnCloseEditModal" type="button" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </header>

            <form id="formEditPerangkat" method="POST" action="" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_nama" class="text-xs font-semibold text-on-surface-variant uppercase">Nama
                        Perangkat</label>
                    <input id="edit_nama" name="nama_perangkat" type="text" required
                        class="w-full mt-1 px-4 py-2.5 bg-white border border-outline-variant rounded-lg text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                </div>

                <div>
                    <label for="edit_daya" class="text-xs font-semibold text-on-surface-variant uppercase">Daya
                        (Watt)</label>
                    <input id="edit_daya" name="daya" type="number" step="any" min="1" max="100000"
                        required
                        class="w-full mt-1 px-4 py-2.5 bg-white border border-outline-variant rounded-lg text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                </div>

                <div>
                    <label for="edit_jam" class="text-xs font-semibold text-on-surface-variant uppercase">Durasi Pemakaian
                        (Jam/Hari)</label>
                    <input id="edit_jam" name="waktu_penggunaan" type="number" step="any" min="0.1"
                        max="24" required
                        class="w-full mt-1 px-4 py-2.5 bg-white border border-outline-variant rounded-lg text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                </div>

                <div>
                    <label for="edit_tarif" class="text-xs font-semibold text-on-surface-variant uppercase">Tarif Listrik
                        (Rp/kWh)</label>
                    <input id="edit_tarif" name="tarif_listrik" type="number" step="any" min="1"
                        max="1000000" required
                        class="w-full mt-1 px-4 py-2.5 bg-white border border-outline-variant rounded-lg text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant">
                    <button id="btnCancelEdit" type="button"
                        class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-lg text-sm hover:bg-surface-container-low transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary-container transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Data Perangkat -->
    <div id="modalDelete" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden">
        <div
            class="bg-white rounded-xl shadow-2xl max-w-md w-full overflow-hidden border border-outline-variant animate-in fade-in zoom-in duration-200">
            <header class="px-6 py-4 border-b border-outline-variant flex items-center justify-between bg-red-50">
                <h3 class="font-headline-sm text-headline-sm text-error flex items-center gap-2">
                    <span class="material-symbols-outlined text-error">warning</span>
                    Konfirmasi Hapus
                </h3>
                <button id="btnCloseDeleteModal" type="button" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </header>

            <form id="formDeletePerangkat" method="POST" action="" class="p-6 space-y-4">
                @csrf
                @method('DELETE')
                <!-- Hidden input konfirmasi=1 untuk HapusPerangkatRequest -->
                <input type="hidden" name="konfirmasi" value="1">

                <p class="text-body-md text-on-surface leading-relaxed">
                    Apakah Anda yakin ingin menghapus perangkat <strong id="deleteDeviceName"
                        class="text-error"></strong>?
                </p>
                <p class="text-xs text-on-surface-variant">
                    Tindakan ini tidak dapat dibatalkan. Riwayat kalkulasi yang terkait dengan perangkat ini juga akan
                    dihapus.
                </p>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant">
                    <button id="btnCancelDelete" type="button"
                        class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-lg text-sm hover:bg-surface-container-low transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 bg-error text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors shadow-sm">
                        Ya, Hapus Perangkat
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/history.js') }}"></script>
@endpush
