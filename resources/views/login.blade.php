<x-layout.app>
    <div class="relative flex justify-center items-center min-h-screen">
        <div class="absolute top-0 bottom-0 right-0 left-0 w-full h-full object-cover -z-5 bg-gradient-to-t from-gray-700/90 to-zinc-500/90"></div>
        <img src="{{ asset('img/gedung-unpatti.jpg') }}" class="absolute top-0 bottom-0 right-0 left-0 w-full h-full object-cover -z-10 grayscale-10">
        <div x-data="{ open: true }">
            <div x-show="open" class="fixed flex items-center justify-center top-0 right-0 bottom-0 left-0 bg-zinc-900/50">
                <div class="flex flex-col justify-between h-[70vh] w-full max-w-[500px] items-center p-3 bg-white rounded-lg">
                    <img class="h-[90%] w-fit" src="{{ asset('img/komitmen-mutu.png') }}">
                    <button type="button" x-on:click="open = false" class="self-end w-20 border border-gray-700 text-gray-700 rounded-md px-2 py-1">Accept</button>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-10">
            <div class="flex flex-col gap-6">
                <div class="flex justify-center gap-2">
                    <img class="h-[60px]" src="{{ asset('img/logo-unpatti.png') }}" alt="">
                    <img class="h-[60px]" src="{{ asset('img/logo-penjaminan-mutu.png') }}" alt="">
                    <img class="h-[60px]" src="{{ asset('img/logo-dikstis.png') }}" alt="">
                </div>
                <div class="flex flex-col items-center gap-3">
                    <h1 class="text-white text-5xl font-bold" style="text-shadow: 0 0 10px #FFFFFF80">SIPENJAMU</h1>
                    <h2 class="text-white text-md leading-5 text-center opacity-80">Sistem Penjaminan Mutu Internal<br>Universitas Pattimura</h2>
                </div>
            </div>
            <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-2 w-80">
                @csrf
                <x-input type="text" name="email" placeholder="Email" class="bg-zinc-50/20 text-white border-gray-400" />
                <x-input type="password" name="password" placeholder="Password" class="bg-zinc-50/20 text-white border-gray-400" />
                <button class="btn text-[15px] rounded-sm px-3 py-2 mt-5 bg-gray-200 text-gray-700" type="submit">LOGIN</button>
            </form>
        </div>
        @error('failed')
            {{ $message }}
        @enderror
    </div>
</x-layout.app>