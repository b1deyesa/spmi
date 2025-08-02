<x-layout.app>
    <div class="flex">
        @role(['admin', 'user'])
        <div class="flex flex-col items-center w-13 h-screen px-3 py-4 bg-gray-400 text-zinc-100">
            <ul class="flex flex-col gap-3">
                <li><a class="hover:text-gray-300" href="{{ route('dashboard.index', ['fakultas' => $fakultas]) }}"><i class="fa-solid fa-chart-line"></i></a></li>
                <li><a class="hover:text-gray-300" href=""><i class="fa-solid fa-user"></i></a></li>
                <li><a class="hover:text-gray-300" href="{{ route('form.index', ['fakultas' => $fakultas]) }}"><i class="fa-solid fa-file-lines"></i></a></li>
                <li><a class="hover:text-gray-300" href=""><i class="fa-solid fa-print"></i></a></li>
                @role(['admin'])
                    <li><a class="hover:text-gray-300" href="{{ route('setting.index') }}"><i class="fa-solid fa-gear"></i></a></li>
                @endrole
            </ul>
            <form class="mt-auto" action="{{ route('login.logout') }}" method="POST">
                @csrf
                <button class="hover:text-gray-300"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
            </form>
        </div>
        @endrole
        <div class="flex flex-col w-full h-screen overflow-scroll bg-zinc-200">
            {{ $slot }}
        </div>
    </div>
</x-layout.app>