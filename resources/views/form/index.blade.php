<x-layout.form>
    <div class="flex justify-between">
        <h1 class="text-lg font-bold text-gray-700">Instrumen MONEV Pembelajaran (Instrumen TKS)</h1>
        <div class="flex text-sm">
            <select class="border rounded-md w-[350px] px-2 py-1 cursor-pointer border-gray-300 bg-zinc-50" onchange="location.href = '{{ route(Route::currentRouteName(), ['fakultas' => '__FAKULTAS__', 'programStudi' => request()->route('programStudi')]) }}'.replace('__FAKULTAS__', this.value);">
                @foreach (Auth::user()->fakultases as $fakultas)
                    <option value="{{ $fakultas->id }}" @selected($fakultas->id == request()->route('fakultas')->id)>{{ $fakultas->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="flex flex-col gap-2 mt-7">
        <div class="flex flex-col gap-2">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>Monitoring IPK dan Masa Studi Lulusan UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-ipk-dan-masa-studi-lulusan', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>Monitoring Skor Toefl Lulusan UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-skor-toefl-lulusan', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2" style="opacity: 50%; pointer-events: none">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>(Unreleased) Monitoring Jumlah Mahasiswa Bimbingan Akademik Dosen UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-jumlah-mahasiswa-bimbingan-akademik-dosen', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2" style="opacity: 50%; pointer-events: none">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>(Unreleased) Monitoring Materi dan Kehadiran Dosen Dalam Perkuliahan</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-materi-dan-kehadiran-dosen-dalam-perkuliahan', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2" style="opacity: 50%; pointer-events: none">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>(Unreleased) Monitoring Dosen Tetap UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-dosen-tetap', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2" style="opacity: 50%; pointer-events: none">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>(Unreleased) Monitoring Dosen Tidak Tetap UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-dosen-tidak-tetap', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2" style="opacity: 50%; pointer-events: none">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>(Unreleased) Monitoring Kinerja Dosen UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-kinerja-dosen', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2" style="opacity: 50%; pointer-events: none">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>(Unreleased) Monitoring Tenaga Kependidikan UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.monitoring-tenaga-kependidikan', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2" style="opacity: 50%; pointer-events: none">
            <div class="flex items-center justify-between text-sm p-2 pl-4 pr-3 rounded-md border border-zinc-300 bg-zinc-50">
                <div class="flex flex-col">
                    <p>(Unreleased) Rekapitulasi Evaluasi Skor Toefl Lulusan UNPATTI</p>
                    <small class="text-xs text-gray-400">Belum diisi</small>
                </div>
                <div class="flex">
                    <a href="{{ route_f('form.rekapitulasi-evaluasi-skor-toefl-lulusan', ['programStudi' => request()->route('fakultas')->programStudis()->orderBy('nama', 'asc')?->first()?->id, 'year' => date('Y')]) }}" class="flex items-center justify-center px-3 py-1 rounded-sm bg-gray-600 text-zinc-50">Buka File</a>
                </div>
            </div>
        </div>
    </div>
</x-layout.form>