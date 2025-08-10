<x-layout.penetapan-pelaksanaan>
    
    <div class="flex items-center gap-2 mb-5 ml-2">
        <i class="fa-solid fa-graduation-cap"></i>
        <h2 class="text-md">Standar Universitas</h2>
    </div>
    
    <ul class="relative flex">
        <li><a class="flex justify-center py-2 w-40 rounded-t-lg text-sm border {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.*') ? 'font-medium border-b-zinc-50 border-gray-300 text-gray-600 bg-zinc-50' : 'border-zinc-100 bg-gray-100 text-gray-600 opacity-80 border-b-gray-300' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.profil-fakultas') }}">UPPS</a></li>
        <li><a class="flex justify-center py-2 w-40 rounded-t-lg text-sm border {{ request()->routeIs('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.*') ? 'font-medium border-b-zinc-50 border-gray-300 text-gray-600 bg-zinc-50' : 'border-zinc-100 bg-gray-100 text-gray-600 opacity-80 border-b-gray-300' }}" href="{{ route_f('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.peringkat-akreditasi') }}">Program Studi</a></li>
    </ul>
    
    <div class="relative flex gap-6 p-5 top-[-1px] border rounded-b-md border-gray-300 bg-zinc-50">
        {{ $slot }}
    </div>
    
</x-layout.penetapan-pelaksanaan>