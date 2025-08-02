<x-layout.form>
    
    <div class="flex items-center gap-5">
        <i class="fa-solid fa-file-lines text-2xl text-gray-400"></i>
        <div class="flex flex-col gap-[2px]">
            <h2 class="flex items-center gap-2 text-xl font-semibold text-gray-700">Monitoring Jumlah Mahasiswa Bimbingan Akademik Dosen UNPATTI</h2>
            <h4 class="text-sm text-gray-400">Fakultas {{ request()->route('fakultas')->nama }}, Program Studi {{ request()->route('programStudi')->nama }}</h4>
        </div>
    </div>
    
    <table class="text-sm my-7 text-gray-600">
        <tr>
            <td class="py-1" style="vertical-align: middle" width="130px">Program Studi</td>
            <td class="py-1" style="vertical-align: middle">:</td>
            <td class="py-1" style="vertical-align: middle">
                <select class="border rounded-md w-[250px] px-2 py-1 cursor-pointer border-gray-300 bg-zinc-50" onchange="location.href = '{{ route(Route::currentRouteName(), ['fakultas' => request()->route('fakultas'), 'programStudi' => '__PROGRAMSTUDI__', 'year' => request()->route('year')]) }}'.replace('__PROGRAMSTUDI__', this.value);">
                    @foreach ($program_studis as $program_studi)
                        <option value="{{ $program_studi->id }}" @selected($program_studi->id == request()->route('programStudi')->id)>{{ $program_studi->nama }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="py-1" style="vertical-align: middle" width="130px">Periode Lulusan</td>
            <td class="py-1" style="vertical-align: middle">:</td>
            <td class="py-1" style="vertical-align: middle">
                <select class="border rounded-md w-[250px] px-2 py-1 cursor-pointer border-gray-300 bg-zinc-50" onchange="location.href = '{{ route(Route::currentRouteName(), ['fakultas' => request()->route('fakultas'), 'programStudi' => request()->route('programStudi'), 'year' => '__YEAR__']) }}'.replace('__YEAR__', this.value);">
                    @foreach (range(2020, date('Y')) as $year)
                        <option value="{{ $year }}" @selected($year == request()->route('year'))>{{ $year }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    </table>
    
    <hr class="mb-8 border-gray-400 border-dashed">
    
</x-layout.form>