<div x-data="{ open: false }" class="mb-4">
    <button x-on:click="open = true" class="flex items-center gap-1 text-[13px] min-w-[60px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700"><i class="fa-solid fa-file-import opacity-70"></i>Import Data</button>
    <span x-show="open" class="text-sm flex items-center justify-center fixed top-0 right-0 left-0 bottom-0 p-5 w-screen h-screen z-100 bg-gray-800/50" x-cloak>
        <div class="flex flex-col gap-3 p-4 rounded-sm w-[350px] bg-gray-50">
            <h5 class="text-md text-start font-bold text-gray-700">Import Data</h5>
            <div class="flex flex-col gap-4 mt-3">
                <p class="text-start text-gray-500">Data yang di-import harus sesuai dengan template ini. <a wire:click="download" class="underline text-gray-800 cursor-pointer">download</a></p>
                <x-input type="file" wire="file" />
                <div class="flex gap-2 justify-end">
                    <a href="{{ route('form.monitoring-ipk-dan-masa-studi-lulusan', ['fakultas' => $fakultas, 'programStudi' => $programStudi, 'year' => $year]) }}" class="flex justify-center min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm text-gray-700">Batal</a>
                    <button type="button" wire:click="import" class="min-w-[80px] px-3 py-1 border border-gray-700 rounded-sm bg-gray-700 text-zinc-50">Import</button>
                </div>
            </div>
        </div>
    </span>
</div>