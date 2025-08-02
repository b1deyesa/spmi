<x-layout.standar-nasional-pendidikan-tinggi.fakultas>
    
    <form action="{{ route('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.profil-fakultas.update', ['fakultas' => $fakultas]) }}" method="POST" class="flex flex-col w-full gap-10">
        @csrf
        @method('PUT')
        @foreach ($fakultas->fakultasProfils->groupBy(fn($item) => $item->profil->profilCategory->nama ?? 'Lainnya') as $kategori => $profils)
            <div class="flex flex-col gap-5">
                <h2 class="text-lg font-semibold">{{ $kategori }}</h2>
                <div class="flex flex-col gap-4">
                    @foreach ($profils as $fakultas_profil)
                        <div class="flex items-center gap-3 w-full">
                            <x-input type="{{ $fakultas_profil->profil->type }}" label="{{ $fakultas_profil->profil->label }}" name="{{ $fakultas_profil->id }}" value="{{ $fakultas_profil->value }}" class="{{ $fakultas_profil->value ? 'border-green-500' : '' }}" />
                            @if ($fakultas_profil->value)
                                <i class="fas fa-check-circle mt-[2.8%] text-green-500"></i>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="flex gap-2 justify-end mt-10">
            <button type="submit" class="min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm bg-gray-700 text-zinc-50">Simpan</button>        
        </div>
    </form>
    
</x-layout.standar-nasional-pendidikan-tinggi.fakultas>