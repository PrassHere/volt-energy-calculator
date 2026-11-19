@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm p-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-green-600 text-[20px]">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('info'))
    <div class="mb-4 rounded-lg bg-blue-50 border border-blue-200 text-blue-800 text-sm p-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-blue-600 text-[20px]">info</span>
        <span>{{ session('info') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 text-sm p-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-red-600 text-[20px]">error</span>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 text-sm p-4">
        <div class="flex items-center gap-2 font-semibold mb-2">
            <span class="material-symbols-outlined text-red-600 text-[20px]">warning</span>
            <span>Perhatian:</span>
        </div>
        <ul class="list-disc pl-8 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
