@extends('layouts.master')

@section('title', 'Volt Energy - Profil')
@section('page_title', 'Profil Saya')
@section('page_subtitle', 'Lihat dan ubah nama serta foto profilmu.')

@section('content')
<div class="p-margin-desktop max-w-3xl mx-auto space-y-gutter">

    @include('partials.alert')

    <section class="bg-surface-container-lowest border border-outline-variant rounded-lg soft-inset-shadow overflow-hidden">
        <header class="px-6 py-4 border-b border-outline-variant flex items-center gap-3">
            <span class="material-symbols-outlined text-primary">person</span>
            <h3 class="font-headline-sm text-headline-sm text-on-surface">Data Profil</h3>
        </header>

        {{-- enctype wajib agar file foto ikut terkirim --}}
        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Foto profil -->
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 shrink-0 rounded-full overflow-hidden border border-outline-variant bg-primary text-white flex items-center justify-center text-display-lg">
                    <img id="fotoPreview" alt="Foto profil"
                         @if ($user->foto_url) src="{{ $user->foto_url }}" @endif
                         class="w-full h-full object-cover {{ $user->foto_url ? '' : 'hidden' }}">
                    <span id="fotoInisial" class="{{ $user->foto_url ? 'hidden' : '' }}">{{ $user->inisial }}</span>
                </div>

                <div class="space-y-2">
                    <label for="fileFoto" class="text-label-sm font-label-sm text-on-surface-variant">FOTO PROFIL</label>
                    <input id="fileFoto" name="foto" type="file" accept="image/png,image/jpeg,image/webp"
                           class="block text-sm text-on-surface-variant">
                    <p class="text-label-sm text-on-surface-variant">JPG, PNG, atau WEBP. Maksimal 2 MB. Foto otomatis diperkecil menjadi 256 x 256 piksel.</p>

                    @if ($user->foto_versi)
                        <label class="flex items-center gap-2 text-sm text-on-surface-variant">
                            <input type="checkbox" name="hapus_foto" value="1" class="rounded border-outline-variant">
                            Hapus foto saat ini
                        </label>
                    @endif
                </div>
            </div>

            <!-- Nama -->
            <div class="space-y-2">
                <label for="txtNama" class="text-label-sm font-label-sm text-on-surface-variant">NAMA LENGKAP</label>
                <input id="txtNama" name="nama" type="text" value="{{ old('nama', $user->nama) }}" required
                       class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none">
            </div>

            <!-- Email (hanya dilihat) -->
            <div class="space-y-2">
                <label for="txtEmail" class="text-label-sm font-label-sm text-on-surface-variant">EMAIL</label>
                <input id="txtEmail" type="email" value="{{ $user->email }}" disabled
                       class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 text-body-md text-on-surface-variant cursor-not-allowed">
                <p class="text-label-sm text-on-surface-variant">Email tidak dapat diubah.</p>
            </div>

            <button id="btnSimpanProfil" type="submit"
                    class="rounded-lg bg-primary text-white px-6 py-3 font-semibold hover:bg-primary-container transition-colors">
                Simpan Perubahan
            </button>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Pratinjau foto sebelum disimpan
    document.getElementById('fileFoto').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const img = document.getElementById('fotoPreview');
        img.src = URL.createObjectURL(file);
        img.classList.remove('hidden');
        document.getElementById('fotoInisial').classList.add('hidden');
    });
</script>
@endpush