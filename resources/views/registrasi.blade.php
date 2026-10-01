@extends('layouts.master')

@section('title', 'Registrasi - Volt Energy Calculator')

@section('content')
<div class="auth-bg">
    <div class="auth-card p-8">
        <div class="text-center mb-8">
            <div class="mx-auto w-12 h-12 rounded-xl bg-primary text-white flex items-center justify-center">
                <span class="material-symbols-outlined">bolt</span>
            </div>
            <h1 class="mt-4 text-2xl font-bold">Buat Akun</h1>
            <p class="mt-1 text-sm text-on-surface-variant">Daftarkan akun untuk menggunakan Volt Energy Calculator.</p>
        </div>

        <form action = "{{route('dashboard')}}" method="GET" action="#" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input id="txtName" name="nama" type="text" required class="w-full rounded-lg border-outline-variant" placeholder="Masukkan nama lengkap">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input id="txtEmail" name="email" type="email" required class="w-full rounded-lg border-outline-variant" placeholder="Masukkan alamat email">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kata Sandi</label>
                <input id="txtPassword" name="password" type="password" required class="w-full rounded-lg border-outline-variant" placeholder="Masukkan kata sandi">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Kata Sandi</label>
                <input id="txtConfirmPassword" name="password_confirmation" type="password" required class="w-full rounded-lg border-outline-variant" placeholder="Ulangi kata sandi">
            </div>
            <button id="btnCreateAccount" type="submit" class="w-full rounded-lg bg-primary text-white py-3 font-semibold hover:bg-primary-container">
                Daftar Akun
            </button>
        </form>

        <p class="text-center text-sm text-on-surface-variant mt-6">
            Sudah memiliki akun?
            <a id="linkLogin" href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Masuk</a>
        </p>
    </div>
</div>
@endsection
