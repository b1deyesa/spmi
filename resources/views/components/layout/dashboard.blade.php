<x-layout.sidebar>
    <div class="sticky flex justify-between top-0 px-5 py-3 bg-gray-700" style="z-index: 20">
        <div class="flex items-center gap-2">
            <img class="w-7" src="{{ asset('img/logo-unpatti.png') }}">
            <h5 class="text-lg font-medium text-gray-300">SIPENJAMU</h5>
        </div>
        <div class="flex items-center gap-10">
            <ul class="flex gap-3 text-gray-400">
                <li><a class="text-[15px] px-3 py-1 rounded-sm text-gray-400 {{ request()->routeIs('dashboard.index') ? 'bg-gray-600 text-zinc-100' : '' }}" href="{{ route_f('dashboard.index') }}">Home</a></li>
                <li><a class="text-[15px] px-3 py-1 rounded-sm text-gray-400 {{ request()->routeIs('dashboard.penetapan-pelaksanaan.*') ? 'bg-gray-600 text-zinc-100' : '' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.profil-fakultas', ['year' => date('Y')]) }}">Penetapan/Pelaksanaan</a></li>
                {{-- <li><a class="text-[15px] px-3 py-1 rounded-sm text-gray-400 {{ request()->routeIs('dashboard.evaluasi-pengendalian-peningkatan') ? 'bg-gray-600 text-zinc-100' : '' }}" href="{{ route_f('dashboard.evaluasi-pengendalian-peningkatan') }}">Evaluasi/Pengendalian/Peningkatan</a></li> --}}
            </ul>
        </div>
        <div class="flex">
            <select class="border rounded-md w-[350px] h-fit px-2 py-1 cursor-pointer border-gray-300/20 bg-zinc-50/20 text-zinc-50/80" onchange="location.href = '{{ route(Route::currentRouteName(), ['fakultas' => '__FAKULTAS__', 'year' => request()->route('year')]) }}'.replace('__FAKULTAS__', this.value);">
                @foreach (Auth::user()->fakultases as $fakultas)
                    <option value="{{ $fakultas->id }}" @selected($fakultas->id == request()->route('fakultas')->id)>{{ $fakultas->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="relative p-8">
        {{ $slot }}
    </div>
</x-layout.sidebar>