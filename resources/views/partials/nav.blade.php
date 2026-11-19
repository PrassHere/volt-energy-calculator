<aside class="fixed left-0 top-0 h-full w-[230px] bg-inverse-surface flex flex-col py-8 z-50">
    <div class="px-6 mb-10">
        <h1 class="text-headline-md font-headline-md font-bold text-on-secondary">Volt Energy Calculator</h1>
    </div>

    <nav class="flex-grow">
        <ul class="space-y-1">
            @if (auth()->user()?->email === 'admin@gmail.com')
                {{-- Khusus Admin: Hanya menu Kelola Tips --}}
                <li>
                    <a href="{{ route('admin.tips') }}"
                        class="{{ request()->routeIs('admin.tips*') ? 'border-l-4 border-primary-container bg-inverse-surface text-amber-300 font-bold' : 'text-amber-200/80 hover:bg-secondary-container/10' }} flex items-center px-6 py-3 transition-colors font-label-md text-label-md">
                        <span class="material-symbols-outlined mr-4 text-amber-400">admin_panel_settings</span>
                        Kelola Tips
                    </a>
                </li>
            @else
                {{-- Menu Pengguna Biasa --}}
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold' : 'text-on-secondary-container opacity-70 hover:bg-secondary-container/10' }} flex items-center px-6 py-3 transition-colors font-label-md text-label-md">
                        <span class="material-symbols-outlined mr-4">grid_view</span>
                        Halaman Utama
                    </a>
                </li>

                <li>
                    <a href="{{ route('add-device') }}"
                        class="{{ request()->routeIs('add-device') ? 'border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold' : 'text-on-secondary-container opacity-70 hover:bg-secondary-container/10' }} flex items-center px-6 py-3 transition-colors font-label-md text-label-md">
                        <span class="material-symbols-outlined mr-4">add_circle</span>
                        Tambah Perangkat
                    </a>
                </li>

                <li>
                    <a href="{{ route('history') }}"
                        class="{{ request()->routeIs('history') ? 'border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold' : 'text-on-secondary-container opacity-70 hover:bg-secondary-container/10' }} flex items-center px-6 py-3 transition-colors font-label-md text-label-md">
                        <span class="material-symbols-outlined mr-4">history</span>
                        Riwayat
                    </a>
                </li>

                <li>
                    <a href="{{ route('analytics') }}"
                        class="{{ request()->routeIs('analytics') ? 'border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold' : 'text-on-secondary-container opacity-70 hover:bg-secondary-container/10' }} flex items-center px-6 py-3 transition-colors font-label-md text-label-md">
                        <span class="material-symbols-outlined mr-4">bar_chart</span>
                        Grafik Analisis
                    </a>
                </li>

                <li>
                    <a href="{{ route('eco-tips') }}"
                        class="{{ request()->routeIs('eco-tips') ? 'border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold' : 'text-on-secondary-container opacity-70 hover:bg-secondary-container/10' }} flex items-center px-6 py-3 transition-colors font-label-md text-label-md">
                        <span class="material-symbols-outlined mr-4">eco</span>
                        Eco Tips
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    <div class="px-6 mt-auto space-y-1 pt-8 border-t border-on-secondary/10">
        <a href="{{ route('profil') }}"
            class="{{ request()->routeIs('profil*') ? 'text-on-secondary font-bold' : 'text-on-secondary-container opacity-70' }} flex items-center py-3 hover:text-on-secondary transition-colors font-label-md text-label-md">
            <span class="material-symbols-outlined mr-4">person</span>
            Profil
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center py-3 text-on-secondary-container opacity-70 hover:text-on-secondary transition-colors font-label-md text-label-md">
                <span class="material-symbols-outlined mr-4">logout</span>
                Logout
            </button>
        </form>
    </div>
</aside>
