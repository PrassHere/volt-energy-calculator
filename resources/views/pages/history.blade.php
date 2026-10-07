@extends('layouts.master')

@section('title', 'Volt Energy - Riwayat Hitungan')
@section('user_name', 'Alex Steventio')

@section('header_left')
<div class="flex-1 max-w-xl">
    <div class="relative group">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
        <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-body-md font-body-md"
               placeholder="Cari perangkat yang pernah kamu hitung..." type="text">
    </div>
</div>
@endsection

@section('content')
<main class="p-margin-desktop max-w-container-max mx-auto">
<!-- Heading & Actions -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
<div>
<h2 class="text-display-lg font-display-lg text-on-surface mb-1">Riwayat Hitungan</h2>
<p class="text-body-md font-body-md text-on-surface-variant">Tinjau data konsumsi energi untuk perangkat yang terdaftar.</p>
</div>
<div class="flex items-center space-x-3 mt-4 md:mt-0">
<button class="flex items-center px-4 py-2 border border-outline text-on-surface-variant rounded hover:bg-surface-container-low transition-colors text-label-md font-label-md">
<span class="material-symbols-outlined text-[18px] mr-2" data-icon="filter_list">filter_list</span>
                        Filter
                    </button>
<button class="flex items-center px-4 py-2 border border-outline text-on-surface-variant rounded hover:bg-surface-container-low transition-colors text-label-md font-label-md">
<span class="material-symbols-outlined text-[18px] mr-2" data-icon="ios_share">ios_share</span>
                        Ekspor
                    </button>
</div>
</div>
<!-- Data Table Card -->
<div class="bg-white soft-inset-card rounded overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full border-collapse text-left">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant">
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Nama Perangkat</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Daya (W)</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Durasi (Jam/Hari)</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Energi (kWh)</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Estimasi Biaya</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Tanggal</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="computer">computer</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Workstation PC</p>
<p class="text-[11px] text-on-surface-variant">Dell Precision 5820</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">450W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">8.5h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">3.83 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.57</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 12, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="ac_unit">ac_unit</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">AC Unit - Main Lab</p>
<p class="text-[11px] text-on-surface-variant">Carrier Comfort 15</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">1,200W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">12.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">14.40 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$2.16</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 10, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="lightbulb">lightbulb</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Server Room Lighting</p>
<p class="text-[11px] text-on-surface-variant">LED Grid Array</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">85W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">24.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">2.04 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.31</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 09, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="print">print</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Industrial 3D Printer</p>
<p class="text-[11px] text-on-surface-variant">Ultimaker S7</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">500W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">5.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">2.50 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.38</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 08, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="kitchen">kitchen</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Breakroom Fridge</p>
<p class="text-[11px] text-on-surface-variant">Samsung RF28</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">150W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">24.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">3.60 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.54</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 07, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Area -->
<div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant flex flex-col sm:flex-row items-center justify-between gap-4">
<p class="text-label-md font-label-md text-on-surface-variant">
                        Menampilkan 1 sampai 5 dari 42 perangkat
                    </p>
<div class="flex items-center space-x-1">
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all">
<span class="material-symbols-outlined text-[18px]" data-icon="chevron_left">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-primary bg-primary text-white font-label-md text-label-md">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all font-label-md text-label-md">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all font-label-md text-label-md">3</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all">
<span class="material-symbols-outlined text-[18px]" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>

<div class="mt-4 pt-4 flex flex-col md:flex-row items-center justify-between gap-4">
<div class="flex items-center space-x-4">
<div class="flex items-center text-label-sm font-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] mr-1" data-icon="update">update</span>
                        Terakhir diperbarui: 14 menit lalu
</div>

</main>
@endsection

@push('scripts')
<script src="{{ asset('js/history.js') }}"></script>
@endpush
