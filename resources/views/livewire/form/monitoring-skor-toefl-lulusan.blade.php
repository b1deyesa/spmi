<form wire:submit="save()">
    @push('css')
        <style>
            td { vertical-align: top }
        </style>
    @endpush
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table>
        <thead class="text-xs bg-gray-500 text-zinc-50">
            <tr>
                <th rowspan="2" align="start" width="200px" class="px-6 py-1 border-y border-r border-gray-300 rowspan="2"">NIM</th>
                <th rowspan="2" align="start" class="px-6 py-1 border-y border-r border-gray-300">Nama Calon Lulusan</th>   
                <th colspan="4" align="center" class="px-6 py-1 border-y border-r border-gray-300">Score</th>
                <th rowspan="2" align="center" width="150px" class="px-6 py-1 border-y border-r border-gray-300">Total Score</th>
                <th rowspan="2" class="px-6 py-1 border-y border-gray-300"></th>
            </tr>
            <tr>
                <th align="center" width="50px" class="px-6 py-1 border-y border-r border-gray-300">Listening</th>
                <th align="center" width="50px" class="px-6 py-1 border-y border-r border-gray-300">Structure</th>
                <th align="center" width="50px" class="px-6 py-1 border-y border-r border-gray-300">Reading</th>
                <th align="center" width="50px" class="px-6 py-1 border-y border-r border-gray-300">Writting</th>
            </tr>
        </thead>
        <tbody class="text-[13px]">
            @foreach ($datas as $key => $value)    
                <tr wire:key="{{ $key }}">
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="data-list-wire" :options="$mahasiswas" wire="datas.{{ $key }}.nim" placeholder="NIM" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="text" wire="datas.{{ $key }}.nama" placeholder="Nama Calon Lulusan" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input class="text-center pe-0" type="number" wire="datas.{{ $key }}.listening" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input class="text-center pe-0" type="number" wire="datas.{{ $key }}.structure" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input class="text-center pe-0" type="number" wire="datas.{{ $key }}.reading" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input class="text-center pe-0" type="number" wire="datas.{{ $key }}.writting" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input class="text-center pe-0 font-bold text-blue-700 bg-gray-100" type="number" wire="datas.{{ $key }}.total_score" placeholder="0" disabled /></td>
                    <td class="px-5 py-3 border-y border-gray-300" width="70px">
                        <button class="w-[30px] h-[30px] mt-[3px] px-2 py-1 rounded-sm border border-gray-500 text-gray-600" type="button" wire:click="remove({{ $key }})"><i class="fa-solid fa-xmark"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
    <div class="flex justify-end gap-2 text-sm mt-10">
        <button type="button" wire:click="add()" class="min-w-[80px] px-3 py-1 rounded-sm border border-gray-700 text-gray-700">Tambah Data</button>
        <button type="submit" class="min-w-[80px] px-3 py-1 rounded-sm bg-gray-700 text-zinc-50">Simpan</button>
    </div>
</form>