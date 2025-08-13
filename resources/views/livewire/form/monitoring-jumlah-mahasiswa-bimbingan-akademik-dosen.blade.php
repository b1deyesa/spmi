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
                <th align="start" class="px-6 py-2 border-y border-gray-300" width="150px" rowspan="2">NID</th>
                <th align="start" class="px-6 py-2 border-y border-gray-300" width="300px" rowspan="2">Nama Dosen Pembimbing Akademik</th>
                <th align="start" class="px-6 py-2 border-t border-gray-300" colspan="7">Jumlah Mahasiswa Bimbingan</th>
                <th class="px-6 py-2 border-y border-gray-300" rowspan="2"></th>
            </tr>
            <tr>
                <th align="start" class="px-6 py-2 border-y border-gray-300/25">N</th>
                <th align="start" class="px-6 py-2 border-y border-gray-300/25">N-1</th>
                <th align="start" class="px-6 py-2 border-y border-gray-300/25">N-2</th>
                <th align="start" class="px-6 py-2 border-y border-gray-300/25">N-3</th>
                <th align="start" class="px-6 py-2 border-y border-gray-300/25">N-4</th>
                <th align="start" class="px-6 py-2 border-y border-gray-300/25">> N-4</th>
                <th align="start" class="px-6 py-2 border-y border-gray-300/25">Total</th>
            </tr>
        </thead>
        <tbody class="text-[13px]">
            @foreach ($datas as $key => $value)    
                <tr wire:key="{{ $key }}">
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="data-list-wire" :options="$dosens" wire="datas.{{ $key }}.nid" placeholder="NID" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="text" wire="datas.{{ $key }}.nama" placeholder="Nama Dosen" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="number" wire="datas.{{ $key }}.n" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="number" wire="datas.{{ $key }}.n1" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="number" wire="datas.{{ $key }}.n2" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="number" wire="datas.{{ $key }}.n3" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="number" wire="datas.{{ $key }}.n4" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="number" wire="datas.{{ $key }}.nn" placeholder="0" /></td>
                    <td class="px-5 py-3 border-y border-gray-300"><x-input type="number" wire="datas.{{ $key }}.total" placeholder="0" /></td>
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