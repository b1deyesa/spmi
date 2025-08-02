<x-layout.sidebar>
    <div class="sticky flex justify-between top-0 px-5 py-3 bg-gray-800" style="z-index: 100">
        <div class="flex items-center gap-2">
            <img class="w-7" src="{{ asset('img/logo-unpatti.png') }}">
            <h5 class="text-lg font-medium text-gray-300">Sistem Penjaminan Mutu Internal</h5>
        </div>
        <div class="flex items-center gap-10">
            <ul class="flex gap-3 text-gray-400">
                <li><a class="text-[15px] px-3 py-1 rounded-sm text-gray-400 {{ request()->routeIs('dashboard.index') ? 'bg-gray-600 text-zinc-100' : '' }}" href="{{ route_f('dashboard.index') }}">Home</a></li>
                <li><a class="text-[15px] px-3 py-1 rounded-sm text-gray-400 {{ request()->routeIs('dashboard.penetapan-pelaksanaan.*') ? 'bg-gray-600 text-zinc-100' : '' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.profil-fakultas', ['year' => date('Y')]) }}">Penetapan/Pelaksanaan</a></li>
                <li><a class="text-[15px] px-3 py-1 rounded-sm text-gray-400 {{ request()->routeIs('dashboard.evaluasi-pengendalian-peningkatan') ? 'bg-gray-600 text-zinc-100' : '' }}" href="{{ route_f('dashboard.evaluasi-pengendalian-peningkatan') }}">Evaluasi/Pengendalian/Peningkatan</a></li>
            </ul>
        </div>
    </div>
<div class="relative p-8">
        {{ $slot }}
    </div>
</x-layout.sidebar>