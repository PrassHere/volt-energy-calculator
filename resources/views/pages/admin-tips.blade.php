@extends('layouts.master')

@section('title', 'Admin - Kelola Tips Hemat Energi')
@section('page_title', 'Kelola Tips Hemat Energi')
@section('user_name', 'Admin Volt')

@section('content')
    <main class="flex-1 p-6 md:p-margin-desktop max-w-container-max mx-auto w-full space-y-8">

        @include('partials.alert')

        <section>
            <div class="flex items-center gap-2 text-label-sm text-primary font-semibold uppercase tracking-wider mb-3">
                <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                Area Admin
            </div>
            <h1 class="font-display-lg text-display-lg text-on-surface mb-2">Kelola Tips Hemat Energi</h1>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">
                Tambahkan atau ubah informasi tips hemat energi untuk pengguna. Halaman ini hanya dapat diakses oleh
                Administrator (<span class="font-semibold text-primary">admin@gmail.com</span>).
            </p>
        </section>

        <!-- Section Daftar Tips -->
        <section
            class="bg-surface-container-lowest border border-outline-variant rounded-xl soft-inset-shadow overflow-hidden">
            <div
                class="p-5 md:p-6 border-b border-outline-variant flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-headline-sm text-headline-sm text-on-surface">Daftar Tips ({{ count($tips) }})</h2>
                    <p class="font-body-md text-on-surface-variant mt-1">Kelola data tips hemat energi yang tampil di halaman
                        Eco Tips pengguna.</p>
                </div>
                <form action="{{ route('admin.tips') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <label class="sr-only" for="tip-search">Cari tips</label>
                    <div
                        class="flex items-center bg-surface-container-low px-3 py-2 rounded-lg border border-outline-variant">
                        <span class="material-symbols-outlined text-on-surface-variant mr-2">search</span>
                        <input id="tip-search" name="search" type="search" value="{{ $search ?? '' }}"
                            class="bg-transparent border-none focus:ring-0 text-label-md w-full text-on-surface outline-none"
                            placeholder="Cari tips..." />
                    </div>
                    <label class="sr-only" for="category-filter">Filter kategori</label>
                    <select id="category-filter" name="category" onchange="this.form.submit()"
                        class="rounded-lg border-outline-variant bg-surface text-on-surface text-label-md focus:ring-primary focus:border-primary px-3 py-2">
                        <option value="">Semua kategori</option>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ ($selectedCategory ?? '') === $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                    @if (!empty($search) || !empty($selectedCategory))
                        <a href="{{ route('admin.tips') }}"
                            class="px-3 py-2 border border-outline-variant rounded-lg text-sm text-on-surface-variant hover:bg-surface-container-low text-center flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            @if ($tips->isEmpty())
                <div class="text-center px-6 py-12">
                    <span class="material-symbols-outlined text-4xl text-on-surface-variant">eco</span>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface mt-3">Tidak Ada Data Tips</h3>
                    <p class="text-body-md text-on-surface-variant mt-1">Belum ada tips atau tidak ditemukan tips yang cocok
                        dengan pencarian.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant">
                                <th class="px-6 py-3 text-label-sm font-label-sm text-on-surface-variant uppercase">Judul &
                                    Kategori</th>
                                <th class="px-6 py-3 text-label-sm font-label-sm text-on-surface-variant uppercase">
                                    Deskripsi</th>
                                <th class="px-6 py-3 text-label-sm font-label-sm text-on-surface-variant uppercase">
                                    Penghematan</th>
                                <th
                                    class="px-6 py-3 text-label-sm font-label-sm text-on-surface-variant uppercase text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach ($tips as $item)
                                <tr class="hover:bg-surface-container-lowest transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <p class="font-semibold text-on-surface text-sm">{{ $item->judul_tips }}</p>
                                            @if ($item->is_featured)
                                                <span
                                                    class="px-2 py-0.5 rounded bg-primary text-white text-[10px] font-bold uppercase tracking-wider">Unggulan</span>
                                            @endif
                                        </div>
                                        @if ($item->kategori)
                                            <span
                                                class="inline-block mt-1 text-[11px] px-2 py-0.5 rounded bg-surface-container-high text-on-surface-variant font-medium">
                                                {{ $item->kategori }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-on-surface-variant max-w-md">
                                        <p class="line-clamp-2">{{ $item->konten }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-semibold text-tertiary whitespace-nowrap">
                                        {{ $item->penghematan ?: '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.tips', ['edit' => $item->id_tips]) }}#form-section"
                                                class="p-2 text-primary hover:bg-surface-container-low rounded-lg transition-colors"
                                                title="Ubah Tips">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.tips.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus tips ini?');"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-error hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Hapus Tips">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <!-- Section Form Tips -->
        <section id="form-section"
            class="bg-surface-container-lowest border border-outline-variant rounded-xl p-5 md:p-6 soft-inset-shadow">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="font-headline-sm text-headline-sm text-on-surface">
                        {{ $editTip ? 'Ubah Data Tips' : 'Form Tambah Tips' }}
                    </h2>
                    <p class="font-body-md text-on-surface-variant mt-1">
                        {{ $editTip ? 'Perbarui informasi tips yang dipilih di bawah ini.' : 'Tampilan formulir untuk menambah tips hemat energi baru.' }}
                    </p>
                </div>
                @if ($editTip)
                    <a href="{{ route('admin.tips') }}" class="text-xs font-semibold text-primary hover:underline">
                        + Tambah Tips Baru
                    </a>
                @endif
            </div>

            <form action="{{ $editTip ? route('admin.tips.update', $editTip) : route('admin.tips.store') }}" method="POST"
                class="space-y-5">
                @csrf
                @if ($editTip)
                    @method('PUT')
                @endif

                <div>
                    <label for="tip-title" class="block text-label-md text-on-surface mb-2 font-medium">Judul tips</label>
                    <input id="tip-title" name="title" type="text" required
                        value="{{ old('title', $editTip->judul_tips ?? '') }}"
                        class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary px-4 py-2.5 text-sm"
                        placeholder="Masukkan judul tips" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="tip-category"
                            class="block text-label-md text-on-surface mb-2 font-medium">Kategori</label>
                        <select id="tip-category" name="category"
                            class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary px-3 py-2.5 text-sm">
                            <option value="">Pilih kategori</option>
                            @foreach ($kategoriList as $kat)
                                <option value="{{ $kat }}"
                                    {{ old('category', $editTip->kategori ?? '') === $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tip-savings" class="block text-label-md text-on-surface mb-2 font-medium">Estimasi
                            penghematan</label>
                        <input id="tip-savings" name="savings" type="text"
                            value="{{ old('savings', $editTip->penghematan ?? '') }}"
                            class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary px-4 py-2.5 text-sm"
                            placeholder="Contoh: Hemat 10-15% atau Rp50.000 / bulan" />
                    </div>
                </div>

                <div>
                    <label for="tip-description"
                        class="block text-label-md text-on-surface mb-2 font-medium">Deskripsi</label>
                    <textarea id="tip-description" name="description" rows="4" required
                        class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary px-4 py-2.5 text-sm"
                        placeholder="Masukkan deskripsi penjelasan tips">{{ old('description', $editTip->konten ?? '') }}</textarea>
                </div>

                <label class="flex items-center gap-3 rounded-lg bg-surface-container-low p-4 cursor-pointer">
                    <input id="tip-featured" name="featured" value="1" type="checkbox"
                        {{ old('featured', $editTip->is_featured ?? false) ? 'checked' : '' }}
                        class="rounded border-outline-variant text-primary focus:ring-primary" />
                    <span class="text-label-md text-on-surface font-medium">Jadikan tips unggulan (Featured Tip di bagian
                        atas halaman Eco Tips)</span>
                </label>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
                    @if ($editTip)
                        <a href="{{ route('admin.tips') }}"
                            class="rounded-lg border border-outline-variant px-5 py-3 text-on-surface font-label-md hover:bg-surface-container-low text-center">
                            Batal
                        </a>
                    @else
                        <button type="reset"
                            class="rounded-lg border border-outline-variant px-5 py-3 text-on-surface font-label-md hover:bg-surface-container-low">
                            Batal
                        </button>
                    @endif
                    <button type="submit"
                        class="rounded-lg bg-primary px-5 py-3 text-white font-label-md hover:bg-primary-container font-semibold transition-colors shadow-sm">
                        {{ $editTip ? 'Perbarui Tips' : 'Simpan Tips' }}
                    </button>
                </div>
            </form>
        </section>

    </main>
@endsection
