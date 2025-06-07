<div class="w-56 bg-white border-r h-screen flex flex-col justify-between">
    <!-- Logo/Brand -->
    <div>
        <div class="p-4 border-b">
            <h2 class="font-bold text-xl text-gray-800">IdSpora</h2>
        </div>

        <!-- Navigation Links -->
        <nav class="p-2">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks') }}"
                        class="block px-4 py-2 rounded {{ request()->routeIs('tasks') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                        Tasks
                    </a>
                </li>
                <li>
                    <a href="{{ route('events') }}"
                        class="block px-4 py-2 rounded {{ request()->routeIs('events') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                        Events
                    </a>
                </li>
                <li>
                    <a href="{{ route('finance') }}"
                        class="block px-4 py-2 rounded {{ request()->routeIs('finance') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                        Finance
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ route('laporan') }}"
                        class="block px-4 py-2 rounded {{ request()->routeIs('laporan') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                        Laporan
                    </a>
                </li> -->
            </ul>
        </nav>
    </div>

    <!-- User Info & Logout -->
    <div class="p-4 border-t">
        <div class="flex items-center mb-2">
            <div class="w-8 h-8 bg-gray-300 rounded-full mr-3"></div>
            <div class="flex-1 flex items-center justify-between">
                <div>
                    @if(Auth::check())
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    @else
                        <p class="font-medium text-red-500">Belum Login</p>
                    @endif
                </div>
                <!-- Icon Settings -->
                <button type="button" class="ml-2">
                    <svg class="w-6 h-6 text-gray-500 hover:text-gray-700 cursor-pointer" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 3a.75.75 0 01.75.75v.518a7.494 7.494 0 012.5 0v-.518a.75.75 0 011.5 0v.832a7.51 7.51 0 012.25 1.299l.589-.588a.75.75 0 111.061 1.06l-.589.589a7.514 7.514 0 011.299 2.25h.832a.75.75 0 010 1.5h-.518a7.494 7.494 0 010 2.5h.518a.75.75 0 010 1.5h-.832a7.51 7.51 0 01-1.299 2.25l.589.589a.75.75 0 11-1.06 1.061l-.589-.589a7.514 7.514 0 01-2.25 1.299v.832a.75.75 0 01-1.5 0v-.518a7.494 7.494 0 01-2.5 0v.518a.75.75 0 01-1.5 0v-.832a7.51 7.51 0 01-2.25-1.299l-.589.589a.75.75 0 11-1.061-1.06l.589-.589a7.514 7.514 0 01-1.299-2.25h-.832a.75.75 0 010-1.5h.518a7.494 7.494 0 010-2.5h-.518a.75.75 0 010-1.5h.832a7.51 7.51 0 011.299-2.25l-.589-.589a.75.75 0 111.06-1.061l.589.589A7.514 7.514 0 018.25 5.1V4.75A.75.75 0 019 4z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center px-4 py-2 rounded bg-red-50 text-red-600 hover:bg-red-100 transition mt-2">
                Logout
            </button>
        </form>
    </div>
</div>