@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-50 text-green-700 text-sm p-3">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 text-red-700 text-sm p-3">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
