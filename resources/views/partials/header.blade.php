<header class="h-16 flex justify-between items-center px-margin-desktop w-full bg-surface border-b border-outline-variant sticky top-0 z-40">
    <div class="flex-1 min-w-0">
        @hasSection('header_left')
            @yield('header_left')
        @else
            <div class="flex flex-col">
                <h2 class="text-headline-sm font-headline-sm text-on-surface">
                    @yield('page_title')
                </h2>
                @hasSection('page_subtitle')
                    <p class="text-label-sm font-label-sm text-on-surface-variant">
                        @yield('page_subtitle')
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center gap-6 ml-4 shrink-0">
        @yield('header_actions')

        <button class="relative text-on-surface-variant hover:bg-surface-container-low p-2 rounded-full transition-colors" type="button">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface"></span>
        </button>

        <div class="flex items-center gap-3 border-l border-outline-variant pl-6">
            <div class="text-right">
                <p class="font-label-md text-label-md text-on-surface">{{ auth()->user()?->nama }}</p>
            </div>
            <img
                alt="User Avatar"
                class="w-8 h-8 rounded-full border border-outline-variant bg-surface-container-high object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCj0ZJL8kn8oDDmbdhfiJ6cVD78b5ms0HDLkaWa6jJiN2Et4Vr4RoxAl57NqoZuROgCznpybpK7HTGz9pqp7R1--JnubMFJxYgnvx54SIO3EdqH7thyJVtYDthjjV50aiJvtE8xxgxUJ17v6RKyGT1ZMNiHvCUo5JhNXnCqUqzXY0IWkK2YUarIRb0Xs40RaFqPqpUqCMkzGdNlcZH-6-RPoWbPCkoJVKgCERbRwBu3wNt4oRgDTcv0lp0WJfU_cjrColM2JXhFwF0"
            >
        </div>
    </div>
</header>
