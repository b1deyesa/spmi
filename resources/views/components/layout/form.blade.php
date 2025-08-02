<x-layout.sidebar>
    <div class="sticky flex justify-between top-0 z-100 px-5 py-3 bg-gray-800">
        <div class="flex items-center gap-2">
            <img class="w-7" src="{{ asset('img/logo-unpatti.png') }}">
            <h5 class="text-lg font-medium text-gray-300">Sistem Penjaminan Mutu Internal</h5>
        </div>
    </div>
    <div class="p-8">
        {{ $slot }}
    </div>
</x-layout.sidebar>