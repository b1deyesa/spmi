<tr>
    <td class="p-2 border-b border-gray-200">{{ $program_studi->nama }}</td>
    <td class="p-2 border-b border-gray-200">
        <select 
            class="border rounded-md px-2 py-1 cursor-pointer border-gray-300 bg-zinc-50 w-full"
            wire:model.live="akreditasi_id"
        >
            <option value="">Tidak Terakreditasi</option>
            @foreach ($akreditasis as $akreditasi)
                <option value="{{ $akreditasi->id }}">
                    {{ $akreditasi->gelar }}
                </option>
            @endforeach
        </select>
    </td>
</tr>
