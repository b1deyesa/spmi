<x-layout.app>
    <div class="p-20 flex flex-col gap-5">
        <div class="bg-white border border-gray-300 shadow-lg p-4 rounded-md">
            <h2 class="text-lg font-bold text-gray-700 mb-3">Ranking UPPS Terbaik</h2>
            <div class="flex items-end justify-center w-full gap-2 mt-6">
                <div class="md:col-span-2 flex flex-col items-center justify-end h-48 w-[25%]">
                    <div class="bg-gray-300 w-full h-36 rounded-t-lg flex flex-col p-6 px-8 items-center">
                        <span class="text-4xl font-bold text-gray-700 mt-2">2</span>
                        <div class="text-center mt-2">
                            <span class="text-sm font-bold text-gray-700 block">{{ $podium[1]['nama'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex flex-col items-center justify-end w-[25%]">
                    <div class="bg-yellow-400 w-full h-56 rounded-t-lg flex p-6 px-8 flex-col items-center">
                        <span class="text-4xl font-bold text-white mt-4">1</span>
                        <div class="text-center mt-2">
                            <span class="text-sm font-bold text-white block">{{ $podium[0]['nama'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2 flex flex-col items-center justify-end h-40 w-[25%]">
                    <div class="bg-amber-700 w-full h-32 rounded-t-lg flex flex-col p-6 px-8 items-center">
                        <span class="text-4xl font-bold text-white mt-1">3</span>
                        <div class="text-center mt-1">
                            <span class="text-sm font-bold text-white block">{{ $podium[2]['nama'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Detail Peringkat UPPS</h3>
                <div class="overflow-x-auto max-h-[600px]">
                    <table class="w-full text-xs">
                        <thead class="bg-gray-100 text-gray-700 sticky top-0">
                            <tr>
                                <th class="px-3 py-2 text-left">Peringkat</th>
                                <th class="px-3 py-2 text-left">Fakultas</th>
                                <th class="px-3 py-2 text-left">Profil</th>
                                <th class="px-3 py-2 text-left">Kebijakan</th>
                                <th class="px-3 py-2 text-left">Penetapan</th>
                                <th class="px-3 py-2 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fullRankings as $item)
                                <tr class="hover:bg-gray-100 bg-gray-50">
                                    <td width="1%" align="center" class="px-3 py-2 border border-gray-200">
                                        @if($item['rank'] == 1)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                                {{ $item['rank'] }}
                                            </span>
                                        @elseif($item['rank'] == 2)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                                {{ $item['rank'] }}
                                            </span>
                                        @elseif($item['rank'] == 3)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                                {{ $item['rank'] }}
                                            </span>
                                        @else
                                            {{ $item['rank'] }}
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 border border-gray-200">{{ $item['nama'] }}</td>
                                    <td class="px-3 py-2 border border-gray-200">
                                        @if($item['details']['profil']['rank'] == 1)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                                {{ $item['details']['profil']['rank'] }}
                                            </span>
                                        @elseif($item['details']['profil']['rank'] == 2)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                                {{ $item['details']['profil']['rank'] }}
                                            </span>
                                        @elseif($item['details']['profil']['rank'] == 3)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                                {{ $item['details']['profil']['rank'] }}
                                            </span>
                                        @else
                                            {{ $item['details']['profil']['rank'] ?? '-' }}
                                        @endif
                                        ({{ $item['details']['profil']['progress'] ?? 0 }}%)
                                    </td>
                                    <td class="px-3 py-2 border border-gray-200">
                                        @if($item['details']['kebijakan']['rank'] == 1)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                                {{ $item['details']['kebijakan']['rank'] }}
                                            </span>
                                        @elseif($item['details']['kebijakan']['rank'] == 2)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                                {{ $item['details']['kebijakan']['rank'] }}
                                            </span>
                                        @elseif($item['details']['kebijakan']['rank'] == 3)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                                {{ $item['details']['kebijakan']['rank'] }}
                                            </span>
                                        @else
                                            {{ $item['details']['kebijakan']['rank'] ?? '-' }}
                                        @endif
                                        ({{ $item['details']['kebijakan']['progress'] ?? 0 }}%)
                                    </td>
                                    <td class="px-3 py-2 border border-gray-200">
                                        @if($item['details']['penetapan']['rank'] == 1)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                                {{ $item['details']['penetapan']['rank'] }}
                                            </span>
                                        @elseif($item['details']['penetapan']['rank'] == 2)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                                {{ $item['details']['penetapan']['rank'] }}
                                            </span>
                                        @elseif($item['details']['penetapan']['rank'] == 3)
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                                {{ $item['details']['penetapan']['rank'] }}
                                            </span>
                                        @else
                                            {{ $item['details']['penetapan']['rank'] ?? '-' }}
                                        @endif
                                        ({{ $item['details']['penetapan']['progress'] ?? 0 }}%)
                                    </td>
                                    <td class="px-3 py-2 border border-gray-200 font-bold">{{ $item['total_score'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="flex gap-5">
            <div class="bg-white border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md w-full">
                <div class="flex items-center gap-2 mb-3">
                    <h2 class="text-lg font-bold text-gray-700">Ranking Pengisian Data Profil UPPS</h2>
                </div>
                @if(count($rankingProfil) > 0)
                    <div class="bg-white border border-gray-200 rounded">
                        <table class="w-full text-xs">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-3 py-2 text-left" width="1%">Peringkat</th>
                                    <th class="px-3 py-2 text-left">Fakultas</th>
                                    <th class="px-3 py-2 text-left" colspan="2">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rankingProfil as $ranking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 border border-gray-200 text-center text-xs">
                                            @if($ranking['rank'] == 1)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @elseif($ranking['rank'] == 2)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @elseif($ranking['rank'] == 3)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @else
                                                {{ $ranking['rank'] }}
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 border border-gray-200">{{ $ranking['data']['nama'] }}</td>
                                        <td class="px-3 py-2 border border-gray-200" width="100px">
                                            <div class="relative w-full border border-gray-300 rounded-full">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $ranking['data']['progress'] }}%"></div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 border border-gray-200" width="80px" align="center">
                                            {{ $ranking['data']['diisi'] }} / {{ $ranking['data']['total'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-3 py-2 text-gray-500">Tidak ada data yang tersedia.</div>
                @endif
            </div>
        </div>
        <div class="flex gap-5">
            <div class="bg-white border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md w-full">
                <div class="flex items-center gap-2 mb-3">
                    <h2 class="text-lg font-bold text-gray-700">Ranking Pengaturan Kebijakan per UPPS</h2>
                </div>
                @if(count($rankingKebijakan) > 0)
                    <div class="bg-white border border-gray-200 rounded">
                        <table class="w-full text-xs">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-3 py-2 text-left" width="1%">Peringkat</th>
                                    <th class="px-3 py-2 text-left">Fakultas</th>
                                    <th class="px-3 py-2 text-left" colspan="2">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rankingKebijakan as $ranking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 border border-gray-200 text-center text-xs">
                                            @if($ranking['rank'] == 1)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @elseif($ranking['rank'] == 2)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @elseif($ranking['rank'] == 3)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @else
                                                {{ $ranking['rank'] }}
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 border border-gray-200">{{ $ranking['data']['nama'] }}</td>
                                        <td class="px-3 py-2 border border-gray-200" width="100px">
                                            <div class="relative w-full border border-gray-300 rounded-full">
                                                <div class="bg-orange-600 h-2.5 rounded-full" style="width: {{ $ranking['data']['progress'] }}%"></div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 border border-gray-200" width="80px" align="center">{{ $ranking['data']['diisi'] }} / {{ $ranking['data']['total'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-3 py-2 text-gray-500">Tidak ada data kebijakan yang tersedia.</div>
                @endif
            </div>
            <div class="bg-white border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md w-full">
                <div class="flex items-center gap-2 mb-3">
                    <h2 class="text-lg font-bold text-gray-700">Ranking Penetapan Kebijakan per UPPS</h2>
                </div>
                @if(count($rankingPenetapan) > 0)
                    <div class="bg-white border border-gray-200 rounded">
                        <table class="w-full text-xs">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-3 py-2 text-left" width="1%">Peringkat</th>
                                    <th class="px-3 py-2 text-left">Fakultas</th>
                                    <th class="px-3 py-2 text-left" colspan="2">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rankingPenetapan as $ranking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 border border-gray-200 text-center text-xs">
                                            @if($ranking['rank'] == 1)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @elseif($ranking['rank'] == 2)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @elseif($ranking['rank'] == 3)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            @else
                                                {{ $ranking['rank'] }}
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 border border-gray-200">{{ $ranking['data']['nama'] }}</td>
                                        <td class="px-3 py-2 border border-gray-200" width="100px">
                                            <div class="relative w-full border border-gray-300 rounded-full">
                                                <div class="bg-orange-600 h-2.5 rounded-full" style="width: {{ $ranking['data']['progress'] }}%"></div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 border border-gray-200" width="80px" align="center">{{ $ranking['data']['diisi'] }} / {{ $ranking['data']['total'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-3 py-2 text-gray-500">Tidak ada data kebijakan yang tersedia.</div>
                @endif
            </div>
        </div>
        <div class="flex flex-col bg-white border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md gap-4">
            <h2 class="text-lg font-bold text-gray-700">Jumlah & Presentase Prodi UNPATTI berdasarkan Peringkat Akreditasi</h2>
            <div class="flex w-full gap-5">
                <x-chart id="bar_akreditasi_prodi" type="bar" :labels="$chartData['akreditasi_labels']" :data="$chartData['akreditasi_data']" :colors="$chartData['akreditasi_colors']" title="Jumlah Prodi per Tingkat Akreditasi" />
                <x-chart id="pie_akreditasi_prodi" type="pie" :labels="['Terakreditasi', 'Belum Terakreditasi']" :data="[$jumlah_terakreditasi, $jumlah_belum]" :colors="['#4ade80', '#f87171']" title="Jumlah" />
            </div>
            <x-chart id="bar_akreditasi_chart" type="bar_stacked" :labels="$chartData['akreditasi_labels']" :datasets="$chartData['datasets']" title="Distribusi Akreditasi Program Studi per Fakultas" />
            <div class="bg-white border border-gray-300 p-4 rounded-md mt-4">
                <h2 class="text-lg font-bold text-gray-700 mb-3">Daftar Akreditasi Program Studi</h2>
                <div class="overflow-x-auto max-h-[600px] bg-white border border-gray-200 rounded">
                    <table class="w-full text-xs">
                        <thead class="bg-gray-100 text-gray-700 sticky top-0">
                            <tr>
                                <th class="px-3 py-2 text-left">Program Studi</th>
                                <th class="px-3 py-2 text-left">Fakultas</th>
                                <th class="px-3 py-2 text-left">Masa Berlaku</th>
                                <th class="px-3 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akreditasi_data as $data)
                                @foreach ($data['prodis'] as $prodi)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 border border-gray-200">{{ $prodi->nama }}</td>
                                        <td class="px-3 py-2 border border-gray-200">{{ $prodi->fakultas->nama }}</td>
                                        <td class="px-3 py-2 border border-gray-200">
                                            @if($prodi->akreditasis->isNotEmpty())
                                                {{ $prodi->tanggal_berakhir?->isoFormat('D MMMM Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 border border-gray-200">
                                            @if($prodi->akreditasis->isEmpty())
                                                <span class="text-red-500 italic">Belum Terakreditasi</span>
                                            @else
                                                @php
                                                    $expired = $prodi->tanggal_berakhir?->isPast();
                                                    $sisaWaktu = $prodi->sisa_waktu;
                                                @endphp
                                                @if ($expired || is_null($expired))
                                                    <span class="text-red-500 italic">Kadaluarsa</span>
                                                @else
                                                    <span class="text-green-600 font-medium">Aktif ({{ $sisaWaktu }})</span>
                                                    @if($prodi->tanggal_berakhir?->diffInMonths(now()) > -2)
                                                        <span class="text-xs text-yellow-600 ml-1">(Akan berakhir)</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>                
        </div>
        <div class="flex gap-5">
            <div class="flex flex-col gap-5 bg-white border border-gray-300 p-4 rounded-md w-full">
                <h2 class="text-lg font-bold text-gray-700">Jumlah Dosen</h2>
                <div class="flex gap-5">
                    <h2 class="text-3xl font-black min-w-[120px]">{{ end($dosens['data']) }}</h2>
                    <x-chart id="line_dosens" type="line" :labels="$dosens['labels']" :data="$dosens['data']" title="Jumlah" height="100px" />
                </div>
            </div>
            <div class="flex flex-col gap-5 bg-white border border-gray-300 p-4 rounded-md w-full">
                <h2 class="text-lg font-bold text-gray-700">Jumlah Mahasiswa</h2>
                <div class="flex gap-5">
                    <h2 class="text-3xl font-black min-w-[120px]">{{ end($mahasiswas['data']) }}</h2>
                    <x-chart id="line_mahasiswa" type="line" :labels="$mahasiswas['labels']" :data="$mahasiswas['data']" title="Jumlah Mahasiswa" height="100px" />
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-5">
            @foreach ($mahasiswa as $gelar => $year)
                <div class="flex flex-col gap-5 bg-white border border-gray-300 p-4 rounded-md w-full">
                    <h2 class="text-md font-bold text-gray-700">Mahasiswa {{ $gelar }}</h2>
                    <div class="flex gap-5">
                        <h2 class="text-2xl font-bold min-w-[50px]">{{ end($year) }}</h2>
                        <x-chart id="line_mahasiswa_{{ $gelar }}" type="line" :labels="array_keys($year)" :data="array_values($year)" title="Jumlah Mahasiswa {{ $gelar }}" height="100px" />
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-col bg-white border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md gap-4">
            <h2 class="text-lg font-bold text-gray-700">Jumlah Program Studi per UPPS</h2>
            <x-chart id="bar_fakultas" type="bar" :labels="$fakultas_all->sortByDesc(fn($f) => $f->programStudis()->count())->pluck('nama')->values()->toArray()" :data="$fakultas_all->sortByDesc(fn($f) => $f->programStudis()->count())->map(fn($f) => $f->programStudis()->count())->values()->toArray()" :colors="$fakultas_all->pluck('warna')->values()->toArray()" title="Jumlah Program Studi per Fakultas" />
        </div>
        <div class="flex flex-col bg-white border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md gap-4">
            <h2 class="text-lg font-bold text-gray-700">Jumlah & Prosentase Jumlah Prodi Unpatti berdasarkan Strata Pendidikan dan Fakultas/UPPS</h2>
            <div class="flex gap-5">
                <x-chart id="pie_jenjang" width="50%" type="pie" :labels="$jenjangData['labels']" :data="$jenjangData['data']" :colors="$jenjangData['colors']" />
                <x-chart id="bar_jenjang" type="bar" :labels="$jenjangData['labels']" :data="$jenjangData['data']" :colors="$jenjangData['colors']" />
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($programStudiByStrata as $strata => $programStudis)
                    <div class="bg-white border border-gray-300 p-4 rounded-md">
                        <div class="flex items-center gap-2 mb-3">
                            <h2 class="text-sm font-semibold text-gray-600">{{ $strata }}</h2>
                        </div>
                        <div class="overflow-x-auto max-h-[300px] bg-white border border-gray-200 rounded">
                            <table class="w-full text-xs">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Program Studi</th>
                                        <th class="px-3 py-2 text-left" width="300px">Fakultas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programStudis as $program_studi)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-3 py-2 border border-gray-200">{{ $program_studi->nama }}</td>
                                            <td class="px-3 py-2 border border-gray-200">
                                                {{ $program_studi->fakultas->nama !== 'Pascasarjana' 
                                                   ? 'Fakultas ' . $program_studi->fakultas->nama 
                                                   : $program_studi->fakultas->nama }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout.app>