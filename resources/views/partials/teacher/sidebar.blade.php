      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
        <span class="pl-4">Classroom Management System</span>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
               @if (Str::is('dashboard', request()->path()))
                    <span
                    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"
                    ></span>
                @endif
            <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('dashboard') }}"
            >
            <i class="bi bi-house-door-fill"></i>
                <span class="ml-4">Dashboard</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
                @if (Str::is('students*', request()->path()))
                    <span
                    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"
                    ></span>
                @endif

              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('students') }}"
              >
              <i class="bi bi-people-fill"></i>
                <span class="ml-4">Students</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="cards.html"
              >
              <i class="bi bi-mortarboard-fill"></i>
                <span class="ml-4">Grades</span>
              </a>
            </li>

            <li class="relative px-6 py-3">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
              <button
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                type="submit"
              >
              <i class="bi bi-box-arrow-right"></i>
                <span class="ml-4">Logout</span>
            </button>
                </form>
            </li>

          </ul>
        </div>
      </aside>
