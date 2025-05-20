<div class="w-56 bg-white border-r">
    <!-- Logo/Brand -->
    <div class="p-4 border-b">
        <h2 class="font-bold text-xl">idSpora</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="p-2">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-orange-400 text-white' : 'hover:bg-gray-100' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('tasks') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('tasks') ? 'bg-orange-400 text-white' : 'hover:bg-gray-100' }}">
                    Tasks
                </a>
            </li>
            <li>
                <a href="{{ route('events') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('events') ? 'bg-orange-400 text-white' : 'hover:bg-gray-100' }}">
                    Events
                </a>
            </li>
            <li>
                <a href="{{ route('finance') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('finance') ? 'bg-orange-400 text-white' : 'hover:bg-gray-100' }}">
                    Finance
                </a>
            </li>
            <!-- <li>
                <a href="{{ route('laporan') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('laporan') ? 'bg-orange-400 text-white' : 'hover:bg-gray-100' }}">
                    Laporan
                </a>
            </li> -->
        </ul>
    </nav>

    <!-- User Info -->
    <div class="absolute bottom-0 w-56 p-4 border-t">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-gray-300 rounded-full mr-3"></div>
            <div class="relative flex-1">
                <p class="font-medium">MarStePin</p>
                <p class="text-xs text-gray-500">hachi@gmail.com</p>

                <!-- Icon Settings -->
                <div class="absolute right-0 bottom-0 top-1/2 -translate-y-1/2">
                    <svg xmlns="https://drive.google.com/file/d/1_BseJWEnRwQnwTHM2cNj_lC2kOqJWi0K/view?usp=sharing"
                        class="w-6 h-6 text-gray-500 hover:text-gray-700 cursor-pointer" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 3a.75.75 0 01.75.75v.518a7.494 7.494 0 012.5 0v-.518a.75.75 0 011.5 0v.832a7.51 7.51 0 012.25 1.299l.589-.588a.75.75 0 111.061 1.06l-.589.589a7.514 7.514 0 011.299 2.25h.832a.75.75 0 010 1.5h-.518a7.494 7.494 0 010 2.5h.518a.75.75 0 010 1.5h-.832a7.51 7.51 0 01-1.299 2.25l.589.589a.75.75 0 11-1.06 1.061l-.589-.589a7.514 7.514 0 01-2.25 1.299v.832a.75.75 0 01-1.5 0v-.518a7.494 7.494 0 01-2.5 0v.518a.75.75 0 01-1.5 0v-.832a7.51 7.51 0 01-2.25-1.299l-.589.589a.75.75 0 11-1.061-1.06l.589-.589a7.514 7.514 0 01-1.299-2.25h-.832a.75.75 0 010-1.5h.518a7.494 7.494 0 010-2.5h-.518a.75.75 0 010-1.5h.832a7.51 7.51 0 011.299-2.25l-.589-.589a.75.75 0 111.06-1.061l.589.589A7.514 7.514 0 018.25 5.1V4.75A.75.75 0 019 4z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </div>
            </div>
        </div>
    </div>


</div>