<x-layout.setting>
    <div class="flex justify-between mb-5">
        <h2 class="text-xl font-semibold text-gray-700">Edit Fakultas</h2>
    </div>
    <form action="{{ route('setting.program-studi.update', ['program_studi' => $program_studi]) }}" method="POST" class="text-sm flex flex-col gap-4">
        @csrf
        @method('PUT')
        <x-input type="text" label="Nama Program Studi" name="nama" :required="true" :value="$program_studi->nama" />
        <x-input type="data-list" label="Jenjang" name="jenjang_id" :required="true" :options="$jenjangs" :value="$program_studi->jenjang_id" />
        <x-input type="data-list" label="Fakultas" name="fakultas_id" :required="true" :options="$fakultases" :value="$program_studi->fakultas_id" />
        <x-input type="date" label="Tanggal Didirikan" name="tanggal_didirikan" :required="true" :value="$program_studi->tanggal_didirikan" />
        <x-input type="date" label="Tanggal Ditutup" name="tanggal_ditutup" :value="$program_studi->tanggal_ditutup" />
        <div class="flex justify-end gap-2 mt-5">
            <a href="{{ route('setting.program-studi.index') }}" class="flex justify-center min-w-[80px] px-3 py-1 rounded-sm border border-gray-700 text-gray-700">Batal</a>
            <button type="submit" class="flex justify-center min-w-[80px] px-3 py-1 rounded-sm bg-gray-700 text-zinc-50">Simpan</button>    
        </div>
    </form>
</x-layout.setting>