<x-layout.setting>
    <div class="flex justify-between">
        <h1 class="text-lg font-bold text-gray-700">Pengaturan Aplikasi SPMI</h1>
    </div>
    <div class="grid grid-flow-row grid-cols-4 gap-4 w-full mt-10 text-sm">
        <a href="{{ route('setting.fakultas.index') }}" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-building-columns text-4xl"></i>
            <h5>Fakultas</h5>
        </a>
        <a href="{{ route('setting.program-studi.index') }}" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-school text-4xl"></i>
            <h5>Program Studi</h5>
        </a>
        <a href="" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-chalkboard-user text-4xl"></i>
            <h5>Dosen</h5>
        </a>
        <a href="" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-user-graduate text-4xl"></i>
            <h5>Mahasiswa</h5>
        </a>
        <a href="" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-star text-4xl"></i>
            <h5>Jenjang</h5>
        </a>
        <a href="" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-medal text-4xl"></i>
            <h5>Akreditasi</h5>
        </a>
        <a href="{{ route('setting.user.index') }}" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-users text-4xl"></i>
            <h5>User</h5>
        </a>
        <a href="" class="flex flex-col items-center p-5 gap-2 rounded-md border-[.8px] border-zinc-500 bg-zinc-100 text-gray-600">
            <i class="fa-solid fa-key text-4xl"></i>
            <h5>Role</h5>
        </a>
    </div>
</x-layout.setting>