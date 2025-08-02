<x-layout.penetapan-pelaksanaan>
    
    <div class="flex items-center gap-2 mb-5 ml-2">
        <i class="fa-solid fa-wrench"></i>
        <h2 class="text-md">Pengaturan Tentang Kebijakan SMPI</h2>
    </div>
    
    <div class="text-sm p-5 border rounded-md border-gray-300 bg-zinc-50">
        <table class="w-full table-auto">
            <thead>
                <tr class="border-b-[.8px] text-sm border-gray-300">
                    <th class="p-2" width="200px">Nama Pengaturan</th>
                    <th class="p-2">Status Pengaturan</th>
                    <th class="p-2">Tautan</th>
                    <th class="p-2">Tanggal Ditetapkan</th>
                    <th class="p-2" width="160px">Status Verfikasi</th>
                    <th class="p-2" width="200px">Status Dokumen</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fakultas->fakultasKebijakans as $fakultas_kebijakan)    
                    @livewire('pengaturan-kebijakan-spmi', ['fakultas_kebijakan' => $fakultas_kebijakan], key($fakultas_kebijakan->id))
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-layout.penetapan-pelaksanaan>