<x-layout.dashboard>
    <div class="absolute top-0 left-0 right-0 bottom-0 h-[550px] w-full z-0">
        <img src="{{ asset('img/gedung-unpatti.jpg') }}" class="absolute top-0 left-0 right-0 h-full w-full object-cover grayscale-100 object-[0px_20%]">
        <div class="absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-b from-blue-900/30 to-zinc-200 to-100%"></div>
    </div>
    <div class="relative flex flex-col gap-2 z-10">
        <div class="flex justify-center mt-50">
            <form method="GET" class="relative flex justify-center w-full text-sm max-w-[700px]">
                <div class="w-full">
                    <x-input type="search" name="search" placeholder="Pencarian Fakultas, Program Studi, Mahasiswa, dan Dosen" class="shadow-lg shadow-gray-500/10" />
                </div>
                <button type="submit" class="absolute h-full right-0 px-4 py-1 text-gray-800">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="flex flex-col gap-5 w-[1100px] m-auto">
            <div class="flex flex-col bg-gray-50/80 p-4 rounded-md w-full gap-4 mt-40">
                <h2 class="text-lg font-bold text-gray-700">Jumlah Progarm Studi per UPPS</h2>
                <x-chart id="bar_fakultas" type="bar" :labels="($sorted = $fakultas->sortByDesc(fn($f) => $f->programStudis()->count()))->pluck('nama')->values()->toArray()" :data="$sorted->map(fn($f) => $f->programStudis()->count())->values()->toArray()" :colors="$sorted->pluck('warna')->values()->toArray()" title="Jumlah Program Studi per Fakultas" />
            </div>
            <div class="flex flex-col bg-gray-50/80 p-4 rounded-md w-full gap-4">
                <h2 class="text-lg font-bold text-gray-700">Jumlah & Presentase Prodi UNPATTI berdasarkan Peringkat Akreditasi</h2>
                <div class="flex w-full gap-5">
                    @php
                        $jumlah_total = \App\Models\ProgramStudi::count();
                        $jumlah_terakreditasi = \App\Models\ProgramStudi::has('akreditasis')->count();
                        $jumlah_belum = $jumlah_total - $jumlah_terakreditasi;
                        $labels = ['Terakreditasi', 'Belum Terakreditasi'];
                        $data = [$jumlah_terakreditasi, $jumlah_belum];
                        $colors = ['#4ade80', '#f87171'];
                    @endphp
                    <x-chart id="bar_akreditasi_prodi" type="bar" :labels="$labels" :data="$data" :colors="$colors" title="Jumlah" />
                    <x-chart id="pie_akreditasi_prodi" type="pie" :labels="$labels" :data="$data" :colors="$colors" title="Jumlah" />
                </div>
                @php
                    $orderedGelar = ['Unggul', 'A', 'Baik Sekali', 'B', 'Baik', 'C', 'Tidak Terakreditasi'];
                    $colorMap = [
                        'Unggul' => '#1e3a8a',
                        'A' => '#2563eb',
                        'Baik Sekali' => '#0ea5e9',
                        'B' => '#22c55e',
                        'Baik' => '#fde047',
                        'C' => '#facc15',
                        'Tidak Terakreditasi' => '#f87171',
                    ];
                    $labels = $data = $colors = [];
                    foreach ($orderedGelar as $gelar) {
                        $labels[] = $gelar;
                        $count = $gelar === 'Tidak Terakreditasi' ? \App\Models\ProgramStudi::doesntHave('akreditasis')->count() : \App\Models\ProgramStudi::whereHas('akreditasis', fn($q) => $q->where('gelar', $gelar))->count();
                        $data[] = $count;
                        $colors[] = $colorMap[$gelar];
                    }
                @endphp
                <x-chart id="bar_akreditasi" type="bar" :labels="$labels" :data="$data" :colors="$colors" title="Jumlah" />
            </div>
            @php
                $gelarList = ['Unggul', 'A', 'Baik Sekali', 'B', 'Baik', 'C', 'Belum Terakreditasi'];
                $colorMap = [
                    'Unggul' => 'from-blue-900 to-blue-800',
                    'A' => 'from-blue-700 to-blue-600',
                    'Baik Sekali' => 'from-sky-400 to-sky-300',
                    'B' => 'from-green-500 to-green-400',
                    'Baik' => 'from-yellow-300 to-yellow-200',
                    'C' => 'from-yellow-500 to-yellow-400',
                    'Belum Terakreditasi' => 'from-red-400 to-red-300',
                ];
                $data = [];
                foreach ($gelarList as $gelar) {
                    $data[$gelar] = $gelar === 'Belum Terakreditasi' ? \App\Models\ProgramStudi::doesntHave('akreditasis')->get() : \App\Models\ProgramStudi::whereHas('akreditasis', fn($q) => $q->where('gelar', $gelar))->with(['akreditasis' => fn($q) => $q->where('gelar', $gelar)])->get();
                }
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                @foreach ($data as $gelar => $prodis)
                    @php
                        $tableId = 'table_akreditasi_' . Str::slug($gelar, '_');
                        $isBelum = $gelar === 'Belum Terakreditasi';
                        $bgColor = $colorMap[$gelar] ?? 'from-gray-50 to-gray-100';
                    @endphp
                    <div class="{{ $isBelum ? 'md:col-span-2 xl:col-span-2' : '' }} bg-gradient-to-b {{ $bgColor }} border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md">
                        <h2 class="text-sm font-semibold mb-2 text-center uppercase text-white drop-shadow">Akreditasi {{ $gelar }}</h2>
                        @if ($prodis->isEmpty())
                            <p class="text-gray-100 italic text-sm text-center">Tidak ada prodi</p>
                        @else
                            <div class="overflow-x-auto max-h-[300px] bg-white rounded-md shadow-sm">
                                <table id="{{ $tableId }}" class="display w-full text-sm">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-2 py-1 text-left">Program Studi</th>
                                            <th class="px-2 py-1 text-left">Masa Berlaku</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prodis as $prodi)
                                            @if ($isBelum)
                                                <tr>
                                                    <td class="px-2 py-1">{{ $prodi->nama }}</td>
                                                    <td class="px-2 py-1 italic text-gray-400">—</td>
                                                </tr>
                                            @else
                                                @foreach ($prodi->akreditasis as $akreditasi)
                                                    <tr>
                                                        <td class="px-2 py-1">{{ $prodi->nama }}</td>
                                                        <td class="px-2 py-1">{{ \Carbon\Carbon::parse($akreditasi->pivot->tanggal_berlaku)->format('d M Y') }} — {{ \Carbon\Carbon::parse($akreditasi->pivot->tanggal_berakhir)->format('d M Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const table = document.querySelector("#{{ $tableId }}");
                            if (table) {
                                new simpleDatatables.DataTable(table, { perPage: 999, searchable: false, paging: false, sortable: false });
                            }
                        });
                    </script>
                @endforeach
            </div>
            <div class="flex flex-col bg-gray-50/80 p-4 rounded-md w-full gap-4">
                <h2 class="text-lg font-bold text-gray-700">Jumlah & Prosentase Jumlah Prodi Unpatti berdasarkan Strata Pendidikan dan Fakultas/UPPS</h2>

                @php
                    $j = $jenjang->filter(fn($j) => $j->programStudis()->count() > 0)->sortByDesc(fn($j) => $j->programStudis()->count());
                @endphp
                <div class="flex gap-5">
                    <x-chart id="pie_jenjang" width="50%" type="pie" :labels="$j->pluck('inisial')->values()->toArray()" :data="$j->map(fn($j) => $j->programStudis()->count())->values()->toArray()" :colors="$j->pluck('warna')->values()->toArray()" />
                    <x-chart id="bar_jenjang" type="bar" :labels="$j->pluck('inisial')->values()->toArray()" :data="$j->map(fn($j) => $j->programStudis()->count())->values()->toArray()" :colors="$j->pluck('warna')->values()->toArray()" />
                </div>
            </div>
            <div class="w-full bg-gradient-to-b from-gray-50 to-gray-100 border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md">
                <table id="table_program_studi" class="display overflow-auto h-[300px]">
                    <thead>
                        <tr>
                            <th>UPPS</th>
                            <th>Nama Program Studi</th>
                            <th>Strata</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program_studis as $program_studi)
                            <tr>
                                <td>{{ $program_studi->fakultas->nama !== 'Pascasarjana' ? 'Fakultas ' . $program_studi->fakultas->nama : $program_studi->fakultas->nama }}</td>
                                <td>{{ $program_studi->nama }}</td>
                                <td align="center">{{ $program_studi->jenjang->inisial }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new simpleDatatables.DataTable("#table_program_studi", { perPage: 9999 });
            new simpleDatatables.DataTable("#table_akreditasi", { perPage: 999 });
        });
    </script>
</x-layout.dashboard>