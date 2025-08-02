<x-layout.standar-nasional-pendidikan-tinggi.program-studi>

    <div class="flex flex-col gap-15">
        <div class="flex flex-col gap-5">
            <h3 class="text-sm font-semibold text-gray-400">Sarjana</h3>
            <table class="table-auto text-sm border-collapse">
                <thead class="text-xs">
                    <tr>
                        <th class="border-b-2 border-gray-400 p-2" width="1%">No.</th>
                        <th class="border-b-2 border-gray-400 p-2">Program Studi</th>
                        @foreach ($years as $year)
                            <th class="border-b-2 border-gray-400 p-2" width="15%">{{ $year }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programStudis_sarjana as $programStudi)
                        <tr>
                            <td class="border-b border-zinc-300 px-2 py-1" align="center"><span class="flex items-center justify-center text-[10px] w-[19px] h-[19px] rounded-full bg-zinc-200">{{ $loop->iteration }}</span></td>
                            <td class="border-b border-zinc-300 px-2 py-1">{{ $programStudi->nama }}</td>
                            @foreach ($years as $year)
                                <td class="border-b border-zinc-300 px-2 py-1" align="center">@if ($jenjang_sarjana[$programStudi->id][$year]) {{ $jenjang_sarjana[$programStudi->id][$year] }} @else <span class="text-red-300">⊗</span> @endif</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center" class="px-2 py-15 border-b border-zinc-300"><span class="text-xs text-gray-400">Belum ada program studi.</span></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex flex-col gap-5">
            <h3 class="text-sm font-semibold text-gray-400">Sarjana Terapan</h3>
            <table class="table-auto text-sm border-collapse">
                <thead class="text-xs">
                    <tr>
                        <th class="border-b-2 border-gray-400 p-2" width="1%">No.</th>
                        <th class="border-b-2 border-gray-400 p-2">Program Studi</th>
                        @foreach ($years as $year)
                            <th class="border-b-2 border-gray-400 p-2" width="15%">{{ $year }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programStudis_terapan as $programStudi)
                        <tr>
                            <td class="border-b border-zinc-300 px-2 py-1" align="center"><span class="flex items-center justify-center text-[10px] w-[19px] h-[19px] rounded-full bg-zinc-200">{{ $loop->iteration }}</span></td>
                            <td class="border-b border-zinc-300 px-2 py-1">{{ $programStudi->nama }}</td>
                            @foreach ($years as $year)
                                <td class="border-b border-zinc-300 px-2 py-1" align="center">@if ($jenjang_terapan[$programStudi->id][$year]) {{ $jenjang_terapan[$programStudi->id][$year] }} @else <span class="text-red-300">⊗</span> @endif</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center" class="px-2 py-15 border-b border-zinc-300"><span class="text-xs text-gray-400">Belum ada program studi.</span></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
</x-layout.standar-nasional-pendidikan-tinggi.program-studi>