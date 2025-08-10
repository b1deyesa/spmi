<x-layout.standar-nasional-pendidikan-tinggi.fakultas>
    
    <table class="w-full table-auto">
        <thead>
            <tr class="border-b-[.8px] text-sm border-gray-300">
                <th class="p-2">Program Studi</th>
                <th class="p-2" width="300px">Akreditasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fakultas->programStudis as $program_studi)    
                @livewire('akreditasi', ['program_studi' => $program_studi], key($program_studi->id))
            @endforeach
        </tbody>
    </table>

</x-layout.standar-nasional-pendidikan-tinggi.fakultas>
