@extends('layouts.master')

@section('title', 'Volt Energy - Eco Tips')
@section('user_name', 'Alex Steventio')

@section('header_left')
<div class="flex-1 max-w-xl">
    <div class="flex items-center bg-surface-container-low px-4 py-2 rounded-lg border border-outline-variant w-96">
        <span class="material-symbols-outlined text-on-surface-variant mr-3">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-label-md w-full text-on-surface"
               placeholder="Cari..." type="text">
    </div>
</div>
@endsection

@section('content')
<main class="flex-1 p-margin-desktop max-w-container-max mx-auto w-full">
<!-- HEADER SECTION -->
<section class="mb-12">
<h2 class="font-display-lg text-display-lg text-on-surface mb-2">Tips Hemat Energi</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                    Perubahan kecil bisa berdampak besar. Temukan kebiasaan yang dapat membantu Anda menghemat energi dan mengurangi biaya.
                </p>
</section>
<!-- TIPS DISPLAY -->
<div class="space-y-gutter">
<!-- FEATURED TIP (Index 0) -->
<div class="bg-surface-container-lowest border border-outline-variant border-l-[6px] border-l-primary p-8 flex items-start soft-inset rounded-lg transition-transform hover:scale-[1.01] duration-300">
<div class="w-16 h-16 bg-primary-fixed flex items-center justify-center rounded-xl mr-8 shrink-0">
<span class="material-symbols-outlined text-primary text-[32px]" data-icon="lightbulb">lightbulb</span>
</div>
<div>
<div class="flex items-center space-x-3 mb-3">
<span class="px-3 py-1 bg-secondary-container text-on-secondary-container font-label-sm text-label-sm rounded-full uppercase tracking-wider">Priority Efficiency</span>
<span class="text-primary font-label-md text-label-md font-bold">Rekomendasi untuk rumah Anda</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-4">Optimasi Penjadwalan HVAC Anda</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6 max-w-4xl">
                            Menyesuaikan thermostat Anda hanya 7-10 derajat selama 8 jam sehari dari pengaturan normalnya dapat menghemat hingga 10% per tahun pada biaya pemanas dan pendingin. Program sistem Anda untuk mengurangi output selama jam puncak siang hari ketika rumah kosong, memastikan kenyamanan hanya saat Anda ada.
                        </p>
<div class="flex items-center text-primary font-label-md text-label-md">
<span class="material-symbols-outlined mr-2" data-icon="trending_down">trending_down</span>
                            Estimasi Penghematan Tahunan: Rp180.000 - Rp240.000
                        </div>
</div>
</div>
<!-- GRID OF REMAINING TIPS -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<!-- TIP 1 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="leaf">leaf</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Efficiency</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Tutup Kebocoran Udara dan Perbaiki Insulasi</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                              Periksa apakah ada celah atau kebocoran udara di sekitar jendela dan pintu. Gunakan weatherstripping atau sealant untuk menutup celah kecil agar udara yang sudah dikondisikan tidak keluar, sehingga beban kerja sistem pengatur suhu dapat berkurang.
                        </p>
</div>
<!-- TIP 2 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="water_drop">water_drop</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Water Heat</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Turunkan Suhu Pemanas Air</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Menurunkan suhu pemanas air ke 120°F memberikan panas yang cukup untuk sebagian besar rumah tangga sambil secara signifikan mengurangi kehilangan panas saat tidak digunakan dan penggunaan energi.
                        </p>
</div>
<!-- TIP 3 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="power_settings_new">power_settings_new</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Standby</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Hilangkan Konsumsi Listrik Tersembunyi</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Perangkat elektronik tetap mengonsumsi daya meskipun dimatikan. Gunakan power strip pintar untuk memutus aliran listrik ke perangkat seperti konsol, monitor, dan pengisi daya saat tidak digunakan.
                        </p>
</div>
<!-- TIP 4 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="microwave">microwave</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Appliances</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Beralih ke Lampu LED Pintar</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Lampu LED menggunakan setidaknya 75% lebih sedikit energi dan dapat bertahan hingga 25 kali lebih lama dibandingkan lampu pijar. LED pintar juga memungkinkan pengaturan jadwal otomatis dan tingkat kecerahan untuk mengurangi penggunaan cahaya yang tidak diperlukan.
                        </p>
</div>
<!-- TIP 5 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="laundry">laundry</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Laundry</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Gunakan Siklus Pencucian dengan Air Dingin</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Sekitar 90% energi yang digunakan mesin cuci digunakan untuk memanaskan air. Menggunakan siklus pencucian dengan air dingin untuk sebagian besar cucian dapat mengurangi biaya energi yang berkaitan dengan penggunaan mesin secara signifikan.
                        </p>
</div>
<!-- TIP 6 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="solar_power">solar_power</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Renewable</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Gunakan Lampu Luar Ruangan Tenaga Surya</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Ganti lampu jalan setapak dan lampu keamanan luar ruangan yang terhubung langsung ke listrik dengan lampu bertenaga surya. Lampu ini tidak membutuhkan listrik dari jaringan dan dapat mengurangi kerumitan serta biaya pemasangan.
                        </p>
</div>
</div>
</div>

</main>
@endsection

@push('scripts')
<script src="{{ asset('js/eco-tips.js') }}"></script>
@endpush
