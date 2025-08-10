<x-layout.dashboard>
    <div class="absolute top-0 left-0 right-0 bottom-0 h-[550px] w-full z-0">
        <img src="{{ asset('img/gedung-unpatti.jpg') }}" class="absolute top-0 left-0 right-0 h-full w-full object-cover grayscale-100 object-[0px_20%]">
        <div class="absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-b from-blue-900/30 to-zinc-200 to-100%"></div>
    </div>
    <div class="relative flex flex-col gap-2 z-10">
        {{-- <div class="flex justify-center mt-50 mb-40">
            <form method="GET" class="relative flex justify-center w-full text-sm max-w-[700px]">
                <div class="w-full">
                    <x-input type="search" name="search" placeholder="Pencarian Fakultas, Program Studi, Mahasiswa, dan Dosen" class="shadow-lg shadow-gray-500/10" />
                </div>
                <button type="submit" class="absolute h-full right-0 px-4 py-1 text-gray-800">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div> --}}
        <div class="flex flex-col gap-5 w-[1000px] m-auto py-8">
            <div class="flex gap-5">
                <div class="flex flex-col gap-5 justify-center items-center border border-gray-300 p-4 rounded-md bg-zinc-100">
                    <h2 class="text-2xl font-semibold text-gray-500 text-center w-[400px]">Ranking UPPS</h2>
                    @if(isset($podiumData['fakultas_data']['rank']))
                        @php $rank = $podiumData['fakultas_data']['rank']; @endphp
                        @if($rank == 1)
                            <span class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-yellow-500 text-white font-bold text-3xl">{{ $rank }}</span>
                        @elseif($rank == 2)
                            <span class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-400 text-white font-bold text-3xl">{{ $rank }}</span>
                        @elseif($rank == 3)
                            <span class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-amber-700 text-white font-bold text-3xl">{{ $rank }}</span>
                        @else
                            <span class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-300 text-black font-bold text-3xl">{{ $rank }}</span>
                        @endif
                    @else
                        <span class="text-gray-500">Data tidak tersedia</span>
                    @endif
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <div class="flex flex-col gap-2 bg-white border border-gray-300 p-4 rounded-md">
                        <div class="flex flex-col gap-2 bg border border-gray-300 p-4 rounded-md bg-zinc-100">
                            <h2 class="text-sm font-semibold text-gray-500">Ranking Dokumen Pengaturan Kebijakan</h2>
                            @if($progres_kebijakan['rank'] == 1)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                    {{ $progres_kebijakan['rank'] }}
                                </span>
                            @elseif($progres_kebijakan['rank'] == 2)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                    {{ $progres_kebijakan['rank'] }}
                                </span>
                            @elseif($progres_kebijakan['rank'] == 3)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                    {{ $progres_kebijakan['rank'] }}
                                </span>
                            @else
                                {{ $progres_kebijakan['rank'] }}
                            @endif
                            <div class="flex gap-4">
                                <td class="px-3 py-2 border border-gray-200" width="100px">
                                    <div class="relative w-full border border-gray-300 bg-zinc-50 rounded-full">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progres_kebijakan['progress'] }}%"></div>
                                    </div>
                                </td>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 bg border border-gray-300 p-4 rounded-md bg-zinc-100">
                            <h2 class="text-sm font-semibold text-gray-500">Ranking Penetapan Kebijakan</h2>
                            @if($progres_penetapan['rank'] == 1)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                    {{ $progres_penetapan['rank'] }}
                                </span>
                            @elseif($progres_penetapan['rank'] == 2)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                    {{ $progres_penetapan['rank'] }}
                                </span>
                            @elseif($progres_penetapan['rank'] == 3)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                    {{ $progres_penetapan['rank'] }}
                                </span>
                            @else
                                {{ $progres_penetapan['rank'] }}
                            @endif
                            <div class="flex gap-4">
                                <td class="px-3 py-2 border border-gray-200" width="100px">
                                    <div class="relative w-full border border-gray-300 bg-zinc-50 rounded-full">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progres_penetapan['progress'] }}%"></div>
                                    </div>
                                </td>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 bg border border-gray-300 p-4 rounded-md bg-zinc-100">
                            <h2 class="text-sm font-semibold text-gray-500">Ranking Pengisian Data Profil UPPS</h2>
                            @if($progres_profil['rank'] == 1)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-yellow-500 text-white font-bold">
                                    {{ $progres_profil['rank'] }}
                                </span>
                            @elseif($progres_profil['rank'] == 2)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-400 text-white font-bold">
                                    {{ $progres_profil['rank'] }}
                                </span>
                            @elseif($progres_profil['rank'] == 3)
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-700 text-white font-bold">
                                    {{ $progres_profil['rank'] }}
                                </span>
                            @else
                                {{ $progres_profil['rank'] }}
                            @endif
                            <div class="flex gap-4">
                                <td class="px-3 py-2 border border-gray-200" width="100px">
                                    <div class="relative w-full border border-gray-300 bg-zinc-50 rounded-full">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progres_profil['progress'] }}%"></div>
                                    </div>
                                </td>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-5 bg-white border border-gray-300 p-4 rounded-md">
                <h2 class="text-lg font-bold text-gray-700">Akreditasi</h2>
                <div class="flex flex-col w-full gap-7">
                    <div class="flex gap-5">
                        <div class="flex flex-col gap-3 w-full">
                            <h2 class="text-sm font-semibold text-gray-500">Total Program Studi Terakreditasi</h2>
                            <x-chart id="bar_akreditasi_faklutas" height="200px" type="bar"  :labels="['Terakreditasi', 'Belum Terakreditasi']"  :data="[$akreditasi_fakultas['jumlah_terakreditasi'], $akreditasi_fakultas['jumlah_belum']]"  :colors="['#4ade80', '#f87171']"  title="Jumlah Prodi Terakreditasi vs Belum" />
                        </div>
                        <div class="flex flex-col gap-3 w-full">
                            <h2 class="text-sm font-semibold text-gray-500">Presentase Program Studi Terakreditasi</h2>
                            <x-chart id="pie_akreditasi_faklutas" height="200px" type="pie" :labels="['Terakreditasi', 'Belum Terakreditasi']" :data="[$akreditasi_fakultas['jumlah_terakreditasi'], $akreditasi_fakultas['jumlah_belum']]" :colors="['#4ade80', '#f87171']" title="Persentase Prodi" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h2 class="text-sm font-semibold text-gray-500">Total Program Studi per Level Akreditasi</h2>
                        <x-chart id="bar_akreditasi_fakultas" height="200px" type="bar" :labels="$akreditasi_fakultas['chart_data']['labels']" :data="$akreditasi_fakultas['chart_data']['data']" :colors="$akreditasi_fakultas['chart_data']['colors']" title="Distribusi Tingkat Akreditasi" />
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h2 class="text-sm font-semibold text-gray-500">Detail Akerditasi per Program Studi</h2>
                        <div class="overflow-x-auto bg-white border border-gray-200 rounded">
                            <table class="w-full text-xs">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Program Studi</th>
                                        <th class="px-3 py-2 text-left">Status Akreditasi</th>
                                        <th class="px-3 py-2 text-left">Sisa Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($akreditasi_fakultas['akreditasi_data'] as $data)
                                        @foreach ($data['prodis'] as $prodi)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-3 py-2 border border-gray-200">{{ $prodi->nama }}</td>
                                                <td width="150px" align="center" class="px-3 py-2 text-white border border-gray-200">
                                                    <div class="flex text-center justify-center py-1 rounded-full" style="background: {{ $data['color'] }}">
                                                        {{ $data['gelar'] }}
                                                    </div>
                                                </td>
                                                <td width="250px" class="px-3 py-2 border border-gray-200">
                                                    {{ $prodi->sisa_waktu }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-7 bg-white border border-gray-300 p-4 rounded-md">
                <h2 class="text-lg font-bold text-gray-700">Lulusan Fakultas {{ $fakultas->nama }}</h2>
                <div class="flex gap-5">
                    <div class="flex flex-col gap-3 w-full">
                        <h2 class="text-sm font-semibold text-gray-500">Presentase Lulusan per Program Studi</h2>
                        <x-chart height="280px" id="pie_jumlah_lulusan_current_year" type="pie" :labels="$jumlah_lulusan_fakultas['current_year_lulusan_prodi']['labels']" :data="$jumlah_lulusan_fakultas['current_year_lulusan_prodi']['data']" :colors="$jumlah_lulusan_fakultas['current_year_lulusan_prodi']['colors']" title="Jumlah Lulusan Tahun {{ date('Y') }}" />
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h2 class="text-sm font-semibold text-gray-500">Presentase Putus Studi per Program Studi</h2>
                        <x-chart height="280px" id="pie_jumlah_putus_studi_current_year" type="pie" :labels="$jumlah_lulusan_fakultas['current_year_putus_studi_prodi']['labels']" :data="$jumlah_lulusan_fakultas['current_year_putus_studi_prodi']['data']" :colors="$jumlah_lulusan_fakultas['current_year_putus_studi_prodi']['colors']" title="Jumlah Mahasiswa Putus Studi Tahun {{ date('Y') }}" />
                    </div>
                </div>
                <div class="flex gap-5">
                    <div class="flex flex-col gap-3 w-[60%]">
                        <h2 class="text-sm font-semibold text-gray-500">Total Lulusan per Tahun</h2>
                        <div class="flex flex-col gap-5">
                            <x-chart id="bar_jumlah_lulusan_fakultas" height="200px" type="bar_stacked" :labels="$jumlah_lulusan_fakultas['total_lulusan']['chart_data']['labels']" :datasets="$jumlah_lulusan_fakultas['total_lulusan']['chart_data']['datasets']" title="Jumlah" />
                            <x-chart id="pie_jumlah_lulusan_fakultas" height="200px" type="pie" :labels="$jumlah_lulusan_fakultas['total_lulusan']['chart_data']['labels']" :data="$jumlah_lulusan_fakultas['total_lulusan']['chart_data']['datasets'][0]['data']" :colors="$jumlah_lulusan_fakultas['current_year_lulusan_prodi']['colors']" title="Jumlah" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h2 class="text-sm font-semibold text-gray-500">Total Lulusan per Program Studi</h2>
                        <x-chart id="bar_jumlah_lulusan_current_year" height="452px" type="bar_horizontal_stacked" :labels="$jumlah_lulusan_fakultas['current_year_lulusan']['chart_data']['labels']" :datasets="$jumlah_lulusan_fakultas['current_year_lulusan']['chart_data']['datasets']" title="Jumlah Lulusan Tahun {{ date('Y') }}" />
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-7 bg-white border border-gray-300 p-4 rounded-md">
                <h2 class="text-lg font-bold text-gray-700">IPK Lulusan</h2>
                <div class="flex gap-5">
                    <div class="flex flex-col gap-3 w-full">
                        <h2 class="text-sm font-semibold text-gray-500">Mahasiswa dengan IPK ≥ 3,0</h2>
                        <x-chart id="line_presentase_lulus_ipk3" height="200px" type="line" :labels="$presentase_lulus_ipk3['labels']" :datasets="$presentase_lulus_ipk3['datasets']" title="Lulus dengan IPK ≥ 3" />
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h2 class="text-sm font-semibold text-gray-500">Mahasiswa dengan IPK ≥ 2,0</h2>
                        <x-chart id="line_presentase_lulus_ipk2" height="200px" type="line" :labels="$presentase_lulus_ipk2['labels']" :datasets="$presentase_lulus_ipk2['datasets']" title="Persentase Mahasiswa Lulus dengan IPK ≥ 2" />
                    </div>
                </div>
            </div>
            <div class="flex gap-5">
                <div class="flex flex-col gap-5 bg-white border border-gray-300 p-4 rounded-md w-full">
                    <h2 class="text-lg font-bold text-gray-700">Jumlah Dosen</h2>
                    <div class="flex gap-5">
                        <h2 class="text-3xl font-black min-w-[120px]">{{ end($dosens_fakultas['data']) }}</h2>
                        <x-chart id="line_dosens_fakultas" type="line" :labels="$dosens_fakultas['labels']" :data="$dosens_fakultas['data']" title="Jumlah" height="100px" />
                    </div>
                </div>
                <div class="flex flex-col gap-5 bg-white border border-gray-300 p-4 rounded-md w-full">
                    <h2 class="text-lg font-bold text-gray-700">Jumlah Mahasiswa</h2>
                    <div class="flex gap-5">
                        <h2 class="text-3xl font-black min-w-[120px]">{{ end($mahasiswas_fakultas['data']) }}</h2>
                        <x-chart id="line_mahasiswa_fakultas" type="line" :labels="$mahasiswas_fakultas['labels']" :data="$mahasiswas_fakultas['data']" title="Jumlah Mahasiswa" height="100px" />
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-7 bg-white border border-gray-300 p-4 rounded-md">
                <h2 class="text-lg font-bold text-gray-700">Total Mahasiswa per Jenjang</h2>
                <div class="grid grid-cols-3 gap-5">
                    @foreach ($mahasiswa_fakultas as $gelar => $year)
                        <div class="flex flex-col gap-3">
                            <h2 class="text-sm font-semibold text-gray-500">Mahasiswa {{ $gelar }}</h2>
                            <div class="flex flex-col gap-4 border border-gray-300 p-4 rounded-md w-full bg-zinc-100">
                                <h2 class="text-2xl font-bold min-w-[50px]">{{ end($year) }}</h2>
                                <x-chart id="line_mahasiswa_fakultas_{{ $gelar }}" type="line" :labels="array_keys($year)" :data="array_values($year)" title="Jumlah Mahasiswa {{ $gelar }}" height="100px" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout.dashboard>