<x-layout.setting>
    <div class="flex justify-between mb-5">
        <h2 class="text-xl font-semibold text-gray-700">User</h2>
    </div>
    <div class="flex justify-end mb-5">
        <a href="{{ route('setting.user.create') }}" class="text-sm flex items-center justify-center text-center min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Tambah Data</a>
    </div>
    <table>
        <thead class="text-xs bg-gray-500 text-zinc-50">
            <tr>
                <th class="px-6 py-2 border border-gray-400">Nama</th>
                <th class="px-6 py-2 border border-gray-400"></th>
            </tr>
        </thead>
        <tbody class="text-[13px]">
            @forelse ($users as $user)    
                <tr>
                    <td class="px-3 py-1 border border-gray-400" style="border-top-style: dashed; border-bottom-style: dashed">{{ $user->name ?? '-' }}</td>
                    <td class="px-2 py-1 border border-gray-400" style="border-top-style: dashed; border-bottom-style: dashed" align="center" width="1%">
                        <div class="flex gap-[5px]">
                            <a href="{{ route('setting.user.edit', ['user' => $user]) }}" class="text-xs min-w-[60px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Edit</a>
                            <div x-data="{ open: false }">
                                <button x-on:click="open = true" class="text-xs min-w-[60px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Hapus</button>
                                <span x-show="open" class="text-sm flex items-center justify-center fixed top-0 right-0 left-0 bottom-0 p-5 w-screen h-screen z-100 bg-gray-800/50" x-cloak>
                                    <div class="flex flex-col gap-5 p-4 rounded-sm w-[300px] bg-gray-50">
                                        <p class="text-start">Data user <b>{{ $user->nama }}</b> akan dihapus</p>
                                        <div class="flex gap-2 justify-end">
                                            <button x-on:click="open = false" class="min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Batal</button>
                                            <form action="{{ route('setting.user.destroy', ['user' => $user]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm bg-gray-700 text-zinc-50">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" align="center" class="px-2 py-15 border-b border-zinc-300"><span class="text-xs text-gray-400">Belum ada user.</span></td>
                </tr>
            @endforelse
        </tbody>
    </table>  
</x-layout.setting>