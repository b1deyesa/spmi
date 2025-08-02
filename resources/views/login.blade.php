<x-layout.app>
    
    <div class="flex justify-center items-center min-h-screen">
        <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-2 w-80">
            @csrf
            <x-input type="text" name="email" placeholder="Email" />
            <x-input type="password" name="password" placeholder="Password" />
            <button class="btn text-[15px] rounded-sm px-3 py-2 mt-5 bg-gray-600 text-gray-50" type="submit">Login</button>
        </form>
        @error('failed')
            {{ $message }}
        @enderror
    </div>
    
</x-layout.app>