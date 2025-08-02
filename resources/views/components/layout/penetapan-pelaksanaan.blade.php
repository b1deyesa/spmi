<x-layout.dashboard>
    
    <div class="flex justify-end items-center gap-3 text-sm mb-7">
        <select class="border rounded-md w-[350px] px-2 py-1 cursor-pointer border-gray-300 bg-zinc-50" onchange="location.href = '{{ route(Route::currentRouteName(), ['fakultas' => '__FAKULTAS__', 'year' => request()->route('year')]) }}'.replace('__FAKULTAS__', this.value);">
            @foreach (Auth::user()->fakultases as $fakultas)
                <option value="{{ $fakultas->id }}" @selected($fakultas->id == request()->route('fakultas')->id)>{{ $fakultas->nama }}</option>
            @endforeach
        </select>
    </div>
    
    <ul class="relative flex justify-between gap-5">
        <li class="w-full"><a class="flex justify-center w-full text-sm px-3 py-2 rounded-md border border-x-gray-300 border-t-gray-300 border-zinc-50 text-gray-500 {{ request()->routeIs('dashboard.penetapan-pelaksanaan.profil-fakultas') ? 'font-medium pb-4 pt-3 rounded-b-none border-b-gray-200 bg-linear-to-b from-zinc-50 to-gray-200 text-gray-600' : 'border-b-gray-300 bg-zinc-100' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.profil-fakultas', ['year' => date('Y')]) }}">Profil UPPS</a></li>
        <li class="w-full"><a class="flex justify-center w-full text-sm px-3 py-2 rounded-md border border-x-gray-300 border-t-gray-300 border-zinc-50 text-gray-500 {{ request()->routeIs('dashboard.penetapan-pelaksanaan.pengaturan-kebijakan-spmi') ? 'font-medium pb-4 pt-3 rounded-b-none border-b-gray-200 bg-linear-to-b from-zinc-50 to-gray-200 text-gray-600' : 'border-b-gray-300 bg-zinc-100' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.pengaturan-kebijakan-spmi') }}">Pengaturan Kebijakan SPMI</a></li>
        <li class="w-full"><a class="flex justify-center w-full text-sm px-3 py-2 rounded-md border border-x-gray-300 border-t-gray-300 border-zinc-50 text-gray-500 {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.*') ? 'font-medium pb-4 pt-3 rounded-b-none border-b-gray-200 bg-linear-to-b from-zinc-50 to-gray-200 text-gray-600' : 'border-b-gray-300 bg-zinc-100' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.profil-fakultas') }}">Standar Nasional Pendidikan Tinggi</a></li>
        <li class="w-full"><a class="flex justify-center w-full text-sm px-3 py-2 rounded-md border border-x-gray-300 border-t-gray-300 border-zinc-50 text-gray-500 {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-yang-ditetapkan-institusi') ? 'font-medium pb-4 pt-3 rounded-b-none border-b-gray-200 bg-linear-to-b from-zinc-50 to-gray-200 text-gray-600' : 'border-b-gray-300 bg-zinc-100' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-yang-ditetapkan-institusi') }}">Standar yang Ditetapkan Institusi</a></li>
    </ul>
    
    <div class="relative top-[-1px] p-5 border rounded-b-md border-gray-300 bg-gray-200 text-gray-500">
        {{ $slot }}
    </div>
    
</x-layout.dashboard>