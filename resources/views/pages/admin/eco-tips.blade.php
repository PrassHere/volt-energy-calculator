@extends('layouts.master')

@section('title', 'Admin - Kelola Tips Hemat Energi')
@section('page_title', 'Kelola Tips Hemat Energi')
@section('user_name', 'Admin Volt')

@section('content')
<main class="flex-1 p-6 md:p-margin-desktop max-w-container-max mx-auto w-full space-y-8">
    <section>
        <div class="flex items-center gap-2 text-label-sm text-primary font-semibold uppercase tracking-wider mb-3">
            <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
            Area Admin
        </div>
        <h1 class="font-display-lg text-display-lg text-on-surface mb-2">Kelola Tips Hemat Energi</h1>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">
            Tambahkan atau ubah informasi tips hemat energi untuk pengguna.
        </p>
    </section>

    <section class="bg-surface-container-lowest border border-outline-variant rounded-xl soft-inset-shadow overflow-hidden">
        <div class="p-5 md:p-6 border-b border-outline-variant flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-headline-sm text-headline-sm text-on-surface">Daftar Tips</h2>
                <p class="font-body-md text-on-surface-variant mt-1">Daftar akan terhubung dengan data aplikasi.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <label class="sr-only" for="tip-search">Cari tips</label>
                <div class="flex items-center bg-surface-container-low px-3 py-2 rounded-lg border border-outline-variant">
                    <span class="material-symbols-outlined text-on-surface-variant mr-2">search</span>
                    <input id="tip-search" type="search" class="bg-transparent border-none focus:ring-0 text-label-md w-full text-on-surface" placeholder="Cari tips...">
                </div>
                <label class="sr-only" for="category-filter">Filter kategori</label>
                <select id="category-filter" class="rounded-lg border-outline-variant bg-surface text-on-surface text-label-md focus:ring-primary focus:border-primary">
                    <option value="">Semua kategori</option>
                    <option>Efisiensi</option>
                    <option>Air</option>
                    <option>Standby</option>
                    <option>Peralatan</option>
                    <option>Laundry</option>
                    <option>Terbarukan</option>
                    <option>Lainnya</option>
                </select>
            </div>
        </div>
        <div class="text-center px-6 py-12">
            <span class="material-symbols-outlined text-4xl text-on-surface-variant">eco</span>
            <h3 class="font-headline-sm text-headline-sm text-on-surface mt-3">Data tips belum terhubung</h3>
            <p class="text-body-md text-on-surface-variant mt-1">Daftar tips akan tampil setelah dihubungkan dengan backend.</p>
        </div>
    </section>

    <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-5 md:p-6 soft-inset-shadow">
        <div class="mb-6">
            <h2 class="font-headline-sm text-headline-sm text-on-surface">Form Tips</h2>
            <p class="font-body-md text-on-surface-variant mt-1">Tampilan formulir untuk menambah atau mengubah tips.</p>
        </div>
        <form class="space-y-5">
            <div>
                <label for="tip-title" class="block text-label-md text-on-surface mb-2">Judul tips</label>
                <input id="tip-title" name="title" type="text" class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary" placeholder="Masukkan judul tips">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="tip-category" class="block text-label-md text-on-surface mb-2">Kategori</label>
                    <select id="tip-category" name="category" class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary">
                        <option value="">Pilih kategori</option>
                        <option>Efisiensi</option>
                        <option>Air</option>
                        <option>Standby</option>
                        <option>Peralatan</option>
                        <option>Laundry</option>
                        <option>Terbarukan</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label for="tip-savings" class="block text-label-md text-on-surface mb-2">Estimasi penghematan</label>
                    <input id="tip-savings" name="savings" type="text" class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary" placeholder="Opsional">
                </div>
            </div>
            <div>
                <label for="tip-description" class="block text-label-md text-on-surface mb-2">Deskripsi</label>
                <textarea id="tip-description" name="description" rows="4" class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-primary" placeholder="Masukkan deskripsi tips"></textarea>
            </div>
            <label class="flex items-center gap-3 rounded-lg bg-surface-container-low p-4 cursor-pointer">
                <input id="tip-featured" name="featured" type="checkbox" class="rounded border-outline-variant text-primary focus:ring-primary">
                <span class="text-label-md text-on-surface">Jadikan tips unggulan</span>
            </label>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
                <button type="button" class="rounded-lg border border-outline-variant px-5 py-3 text-on-surface font-label-md hover:bg-surface-container-low">Batal</button>
                <button type="button" class="rounded-lg bg-primary px-5 py-3 text-white font-label-md hover:bg-primary-container">Simpan Tips</button>
            </div>
        </form>
    </section>
</main>
@endsection
