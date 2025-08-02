<x-layout.setting>
    <div class="flex justify-between mb-5">
        <h2 class="text-xl font-semibold text-gray-700">Tambah User</h2>
    </div>
    <form action="{{ route('setting.user.store') }}" method="POST" class="text-sm flex flex-col gap-4">
        @csrf
        <x-input type="text" label="Nama User" name="name" :required="true" />
        <x-input type="text" label="Email" name="email" :required="true" />
        <x-input type="text" label="Password" name="password" :required="true" />
        <x-input type="multiple-list" label="Fakultas" name="fakultases" :required="true" :options="$fakultases" />
        <div class="flex justify-end gap-2 mt-5">
            <a href="{{ route('setting.user.index') }}" class="flex justify-center min-w-[80px] px-3 py-1 rounded-sm border border-gray-700 text-gray-700">Batal</a>
            <button type="submit" class="flex justify-center min-w-[80px] px-3 py-1 rounded-sm bg-gray-700 text-zinc-50">Simpan</button>    
        </div>
    </form>
</x-layout.setting>