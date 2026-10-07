<aside class="fixed left-0 top-0 h-full w-[230px] bg-inverse-surface flex flex-col py-8 z-50">
    <div class="px-6 mb-10">
        <h1 class="text-headline-md font-headline-md font-bold text-on-secondary">Volt Energy Calculator</h1>
    </div>

    <nav class="flex-grow">
        <ul class="space-y-1">
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
        </ul>
    </nav>

    <div class="px-6 mt-auto space-y-1 pt-8 border-t border-on-secondary/10">
        <a href="#" class="flex items-center py-3 text-on-secondary-container opacity-70 hover:text-on-secondary transition-colors font-label-md text-label-md">
            <span class="material-symbols-outlined mr-4">settings</span>
            Settings
        </a>

        <a href="#" class="flex items-center py-3 text-on-secondary-container opacity-70 hover:text-on-secondary transition-colors font-label-md text-label-md">
            <span class="material-symbols-outlined mr-4">logout</span>
            Logout
        </a>
    </div>
</aside>
