@extends('layouts.master')

@section('title', 'Volt Energy - Eco Tips')
@section('page_title', 'Tips Hemat Energi')
@section('page_subtitle', 'Panduan dan kebiasaan cerdas untuk menghemat listrik dan mengurangi biaya tagihan.')

@section('header_left')
    <div class="flex-1 max-w-xl">
        <form action="{{ route('eco-tips') }}" method="GET"
            class="flex items-center bg-surface-container-low px-4 py-2 rounded-lg border border-outline-variant w-full max-w-md">
            <span class="material-symbols-outlined text-on-surface-variant mr-3">search</span>
            <input class="bg-transparent border-none focus:ring-0 text-label-md w-full text-on-surface outline-none"
                name="q" value="{{ $q ?? '' }}" placeholder="Cari tips efisiensi listrik..." type="text" />
            @if (!empty($q))
                <a href="{{ route('eco-tips') }}"
                    class="text-on-surface-variant hover:text-on-surface text-xs font-semibold">Reset</a>
            @endif
        </form>
    </div>
@endsection

@section('content')
    <main class="flex-1 p-margin-desktop max-w-container-max mx-auto w-full space-y-8">

        @include('partials.alert')

        <!-- HEADER SECTION -->
        <section>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                <div>
                    <h2 class="font-display-lg text-display-lg text-on-surface mb-2">Panduan Efisiensi Energi</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                        Perubahan kecil pada kebiasaan penggunaan perangkat elektronik dapat memangkas tagihan listrik
                        hingga 25% setiap bulannya.
                    </p>
                </div>
                @if (!empty($q))
                    <div class="bg-primary/10 text-primary px-3 py-1.5 rounded-lg text-xs font-semibold">
                        Hasil pencarian: "{{ $q }}" ({{ count($tips) }} tips)
                    </div>
                @endif
            </div>
        </section>

        <!-- TIPS DISPLAY -->
        @if ($tips->isEmpty())
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-12 text-center space-y-4">
                <span class="material-symbols-outlined text-outline text-[48px]">search_off</span>
                <h3 class="font-bold text-headline-sm text-on-surface">Tips Tidak Ditemukan</h3>
                <p class="text-body-md text-on-surface-variant max-w-md mx-auto">
                    Tidak ada tips hemat energi yang sesuai dengan kata kunci "{{ $q }}".
                </p>
                <div>
                    <a href="{{ route('eco-tips') }}"
                        class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-container transition-colors">
                        Lihat Semua Tips
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-gutter">
                <!-- FEATURED TIP (Index 0) -->
                @if ($featuredTip)
                    <div
                        class="bg-surface-container-lowest border border-outline-variant border-l-[6px] border-l-primary p-8 flex flex-col md:flex-row items-start soft-inset rounded-lg transition-transform hover:scale-[1.005] duration-300 gap-6">
                        <div
                            class="w-16 h-16 bg-primary-fixed flex items-center justify-center rounded-xl shrink-0 text-primary">
                            <span
                                class="material-symbols-outlined text-[32px]">{{ $featuredTip->icon ?: 'lightbulb' }}</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <span
                                    class="px-3 py-1 bg-secondary-container text-on-secondary-container font-label-sm text-label-sm rounded-full uppercase tracking-wider font-semibold">
                                    {{ $featuredTip->kategori ?: 'Prioritas' }}
                                </span>
                                <span class="text-primary font-label-md text-label-md font-bold">Rekomendasi Utama</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-3">
                                {{ $featuredTip->judul_tips }}
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
                                {{ $featuredTip->konten }}
                            </p>
                            @if ($featuredTip->penghematan)
                                <div class="flex items-center text-primary font-label-md text-label-md font-semibold">
                                    <span class="material-symbols-outlined mr-2">trending_down</span>
                                    Estimasi Penghematan: {{ $featuredTip->penghematan }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- GRID OF REMAINING TIPS -->
                @if ($otherTips->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                        @foreach ($otherTips as $tip)
                            <div
                                class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-4">
                                        <div
                                            class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors text-primary">
                                            <span
                                                class="material-symbols-outlined text-[24px]">{{ $tip->icon ?: 'eco' }}</span>
                                        </div>
                                        @if ($tip->kategori)
                                            <span
                                                class="px-2.5 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider font-medium">
                                                {{ $tip->kategori }}
                                            </span>
                                        @endif
                                    </div>
                                    <h4
                                        class="font-headline-sm text-headline-sm text-on-surface mb-2 group-hover:text-primary transition-colors">
                                        {{ $tip->judul_tips }}
                                    </h4>
                                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                        {{ $tip->konten }}
                                    </p>
                                </div>
                                @if ($tip->penghematan)
                                    <div
                                        class="mt-4 pt-4 border-t border-outline-variant/40 flex items-center text-xs font-semibold text-tertiary">
                                        <span class="material-symbols-outlined text-[16px] mr-1">savings</span>
                                        {{ $tip->penghematan }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

    </main>
@endsection
