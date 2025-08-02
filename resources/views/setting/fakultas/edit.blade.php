<x-layout.setting>
    <div class="flex justify-between mb-5">
        <h2 class="text-xl font-semibold text-gray-700">Edit Fakultas</h2>
    </div>
    <form action="{{ route('setting.fakultas.update', ['fakulta' => $fakultas]) }}" method="POST" class="text-sm flex flex-col gap-4">
        @csrf
        @method('PUT')
        <x-input type="text" label="Nama Fakultas" name="nama" :value="$fakultas->nama" :required="true" />
        <x-input type="text" label="Inisial Fakultas" name="inisial" :value="$fakultas->inisial" :required="true" />
        <x-input type="date" label="Tanggal Didirikan" name="tanggal_didirikan" :value="$fakultas->tanggal_didirikan" :required="true" />
        <x-input type="date" label="Tanggal Ditutup" name="tanggal_ditutup" :value="$fakultas->ditutup" />
        <div class="flex justify-end gap-2 mt-5">
            <a href="{{ route('setting.fakultas.index') }}" class="flex justify-center min-w-[80px] px-3 py-1 rounded-sm border border-gray-700 text-gray-700">Batal</a>
            <button type="submit" class="flex justify-center min-w-[80px] px-3 py-1 rounded-sm bg-gray-700 text-zinc-50">Simpan</button>    
        </div>
    </form>
</x-layout.setting>