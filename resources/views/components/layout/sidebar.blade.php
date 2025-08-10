<x-layout.app>
    <style>
        #loading-screen {
            opacity: 0;
            transition: opacity 500ms ease;
        }
        #loading-screen.show {
            /* background: #546881 */
            opacity: 1;
        }
    </style>
    {{-- <div id="loading-screen" class="fixed inset-0 bg-[radial-gradient(circle_at_center,_#546881,_#445264)] z-50 flex items-center justify-center">
        <div class="text-center">
            <svg class="animate-spin h-12 w-12 text-gray-100 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
        </div>
    </div> --}}
    <div class="flex">
        @role(['admin', 'user'])
        <div class="flex flex-col items-center w-13 h-screen px-3 py-4 bg-gray-800 text-zinc-100">
            <ul class="flex flex-col gap-3">
                <li><a class="hover:text-gray-300" href="{{ route('dashboard.index', ['fakultas' => $fakultas]) }}"><i class="fa-solid fa-chart-line"></i></a></li>
                {{-- <li><a class="hover:text-gray-300" href=""><i class="fa-solid fa-user"></i></a></li> --}}
                <li><a class="hover:text-gray-300" href="{{ route('form.index', ['fakultas' => $fakultas]) }}"><i class="fa-solid fa-file-lines"></i></a></li>
                {{-- <li><a class="hover:text-gray-300" href=""><i class="fa-solid fa-print"></i></a></li> --}}
                @role(['admin'])
                    {{-- <li><a class="hover:text-gray-300" href="{{ route('setting.index') }}"><i class="fa-solid fa-gear"></i></a></li> --}}
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
    <script>
        const loading = document.getElementById('loading-screen');

        requestAnimationFrame(() => {
            loading.classList.add('show');
        });

        window.addEventListener('load', function () {
            setTimeout(() => {
                loading.classList.remove('show');
                setTimeout(() => {
                    loading.style.display = 'none';
                }, 1000);
            }, 1000);
        });
    </script>
</x-layout.app>