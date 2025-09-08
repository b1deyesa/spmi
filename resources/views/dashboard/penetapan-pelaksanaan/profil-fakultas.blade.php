<x-layout.penetapan-pelaksanaan>
    
    @push('css')
        <style>
            td {
                vertical-align: top;
                padding: 1em .5em;
            }
        </style>
    @endpush
        
    <div class="flex justify-between">
        <div class="flex items-center gap-2 ml-2">
            <i class="fa-solid fa-address-card"></i>
            <h2 class="text-md">Profil UPPS</h2>
        </div>
        <div class="flex items-center text-sm">
            <select class="border rounded-md w-[100px] px-2 py-1 cursor-pointer border-gray-300 bg-zinc-50" onchange="location.href = '{{ route(Route::currentRouteName(), ['fakultas' => request()->route('fakultas'), 'year' => '__YEAR__']) }}'.replace('__YEAR__', this.value);">
                @foreach (range(date('Y'), date('Y') - 3) as $year)
                    <option value="{{ $year }}" @selected($year == request()->route('year'))>{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="flex flex-col gap-5 mt-5">
        <div class="text-sm p-5 border rounded-md border-gray-300 bg-zinc-50">
            <table>
                <tr>
                    <td>Akreditasi Program Studi</td>
                    <td>:</td>
                    <td>
                        <div class="flex flex-col gap-2">
                            <div class="flex flex-wrap gap-2">
                                <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-gray-200">A<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['A'] }}</span></span>
                                <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-gray-200">B<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['B'] }}</span></span>
                                <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-gray-200">C<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['C'] }}</span></span>
                                <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-gray-200">Baik<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['Baik'] }}</span></span>
                                <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-gray-200">Baik Sekali<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['Baik Sekali'] }}</span></span>
                                <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-gray-200">Unggul<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['Unggul'] }}</span></span>
                                <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-orange-200">Belum Terakreditasi<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['Belum Akreditasi'] }}</span></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Akreditasi Internasional</td>
                    <td>:</td>
                    <td>
                        <div class="flex gap-2">
                            <span class="flex items-center gap-2 px-3 pe-2 py-1 rounded-md bg-gray-200">Unggul<span class="text-xs px-2 py-1 bg-zinc-50 rounded-md">{{ $akreditasi['Internasional'] }}</span></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Program Studi</td>
                    <td>:</td>
                    <td>{{ $program_studi }}</td>
                </tr>
                <tr>
                    <td>Jumlah Program Studi yang Memperoleh Akreditasi Internasional</td>
                    <td>:</td>
                    <td>{{ $akreditasi['Internasional'] }}</td>
                </tr>
                <tr>
                    <td>Jumlah Dosen</td>
                    <td>:</td>
                    <td>{{ $dosen }}</td>
                </tr>
                <tr>
                    <td>Jumlah Tenaga Kependidikan</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <div class="flex flex-col items-center text-sm p-5 border rounded-md border-gray-300 bg-zinc-50">
            <h3 class="text-md font-bold">Jumlah Seluruh Mahasiswa</h3>
            <span class="text-xl font-bold">{{ $mahasiswa['Total'] }}</span>
            <p class="italic text-gray-400">(Data ini merupakan data pada tahun ajaran {{ request()->route('year') }})</p>
            <div class="grid grid-flow-row grid-cols-3 gap-3 w-full mt-5">
                <div class="flex flex-col items-center p-2 gap-1 rounded-md border-[.8px] border-zinc-200 bg-zinc-100">
                    <h5>Mahasiswa Doktor</h5>
                    <span class="text-lg font-bold">{{ $mahasiswa['Doktor'] }}</span>
                </div>
                <div class="flex flex-col items-center p-2 gap-1 rounded-md border-[.8px] border-zinc-200 bg-zinc-100">
                    <h5>Mahasiswa Magister</h5>
                    <span class="text-lg font-bold">{{ $mahasiswa['Magister'] }}</span>
                </div>
                <div class="flex flex-col items-center p-2 gap-1 rounded-md border-[.8px] border-zinc-200 bg-zinc-100">
                    <h5>Mahasiswa Profesi</h5>
                    <span class="text-lg font-bold">{{ $mahasiswa['Profesi'] }}</span>
                </div>
                <div class="flex flex-col items-center p-2 gap-1 rounded-md border-[.8px] border-zinc-200 bg-zinc-100">
                    <h5>Mahasiswa Sarjana</h5>
                    <span class="text-lg font-bold">{{ $mahasiswa['Sarjana'] }}</span>
                </div>
                <div class="flex flex-col items-center p-2 gap-1 rounded-md border-[.8px] border-zinc-200 bg-zinc-100">
                    <h5>Mahasiswa Sarjana Terapan</h5>
                    <span class="text-lg font-bold">{{ $mahasiswa['Sarjana Terapan'] }}</span>
                </div>
                <div class="flex flex-col items-center p-2 gap-1 rounded-md border-[.8px] border-zinc-200 bg-zinc-100">
                    <h5>Mahasiswa Diploma</h5>
                    <span class="text-lg font-bold">{{ $mahasiswa['Diploma'] }}</span>
                </div>
            </div>
        </div>
    </div>
    
</x-layout.penetapan-pelaksanaan>