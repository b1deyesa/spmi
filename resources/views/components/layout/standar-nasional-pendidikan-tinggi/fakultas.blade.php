<x-layout.standar-nasional-pendidikan-tinggi>
     
    <ul class="flex flex-col gap-3 text-sm w-50 min-w-50 p-3 border rounded-md border-gray-200 bg-gray-100">
        <li><a class="flex w-full px-2 py-1 rounded-sm {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.profil-fakultas') ? 'bg-linear-to-r from-zinc-400 to-gray-400 text-zinc-50 ' : '' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.profil-fakultas') }}">Profil UPPS</a></li>
        <li><a class="flex w-full px-2 py-1 rounded-sm {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.akreditasi') ? 'bg-linear-to-r from-zinc-400 to-gray-400 text-zinc-50 ' : '' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.akreditasi') }}">Akreditasi</a></li>
        {{-- <li><a class="flex w-full px-2 py-1 rounded-sm {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.data-terkait-standar-nasional-pendidikan-tinggi') ? 'bg-gray-400 text-zinc-50 ' : '' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.data-terkait-standar-nasional-pendidikan-tinggi') }}">Data Terkait Standar Nasional Pendidikan</a></li>
        <li><a class="flex w-full px-2 py-1 rounded-sm {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.data-terkait-standar-penelitian') ? 'bg-gray-400 text-zinc-50 ' : '' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.data-terkait-standar-penelitian') }}">Data Terkait Standar Penelitian</a></li>
        <li><a class="flex w-full px-2 py-1 rounded-sm {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.data-terkait-standar-pengabdian-pada-masyarakat') ? 'bg-gray-400 text-zinc-50 ' : '' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.data-terkait-standar-pengabdian-pada-masyarakat') }}">Data Terkait Standar Pengabdian pada Masyarakat</a></li> --}}
    </ul>
    
    {{ $slot }}
    
</x-layout.standar-nasional-pendidikan-tinggi>