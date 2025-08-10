<x-layout.sidebar>
    <div class="sticky flex justify-between top-0 z-100 px-5 py-3 bg-gray-700">
        <div class="flex items-center gap-2">
            <img class="w-7" src="{{ asset('img/logo-unpatti.png') }}">
            <h5 class="text-lg font-medium text-gray-300">SIPENJAMU</h5>
        </div>
        <div class="flex">
            <select class="border rounded-md w-[350px] h-fit px-2 py-1 cursor-pointer border-gray-300/20 bg-zinc-50/20 text-zinc-50/80" onchange="location.href = '{{ route(Route::currentRouteName(), ['fakultas' => '__FAKULTAS__', 'year' => request()->route('year')]) }}'.replace('__FAKULTAS__', this.value);">
                @foreach (Auth::user()->fakultases as $fakultas)
                    <option value="{{ $fakultas->id }}" @selected($fakultas->id == request()->route('fakultas')->id)>{{ $fakultas->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="p-8">
        {{ $slot }}
    </div>
</x-layout.sidebar>