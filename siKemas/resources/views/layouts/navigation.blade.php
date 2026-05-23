<nav x-data="{ open: false }"
     class="bg-white/80 backdrop-blur-xl border-b border-gray-100 sticky top-0 z-50">

    <div class="w-full px-4 sm:px-6 lg:px-8">

        <div class="flex items-center h-20">

            {{-- LEFT SIDE --}}
            <div class="flex items-center gap-10">

                {{-- LOGO --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center shrink-0">

                    <img src="{{ asset('images/logo.png') }}"
                         alt="SiKemas Logo"
                         class="h-14 w-auto object-contain">

                </a>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="hidden sm:flex items-center gap-4 ml-auto">

                {{-- SEARCH --}}
                <div class="w-[380px]">

                    <div class="relative w-full">

                        {{-- ICON --}}
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">

                            <svg class="h-4 w-4 text-gray-400"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>

                            </svg>

                        </div>

                        {{-- INPUT --}}
                        <input
                            type="text"
                            placeholder="Cari desain atau produk..."
                            class="w-full h-11 pl-10 pr-4
                                   bg-gray-100 border border-transparent
                                   rounded-2xl text-sm text-gray-800
                                   placeholder-gray-400
                                   focus:outline-none
                                   focus:bg-white
                                   focus:border-indigo-500
                                   focus:ring-4
                                   focus:ring-indigo-500/10
                                   transition duration-200"
                        />

                    </div>

                </div>

                {{-- USER DROPDOWN --}}
                <div class="relative"
                     x-data="{ dropdownOpen: false }"
                     @click.outside="dropdownOpen = false">

                    {{-- BUTTON --}}
                    <button
                        @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center gap-3
                               pl-3 pr-2 py-2
                               rounded-2xl border border-gray-200
                               hover:border-indigo-300
                               hover:shadow-md
                               transition duration-200 bg-white"
                    >

                        {{-- TEXT --}}
                        <div class="flex flex-col items-end leading-tight">

                            <span class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </span>

                        </div>

                        {{-- AVATAR --}}
                        <div class="w-10 h-10 rounded-full bg-indigo-100
                                    flex items-center justify-center overflow-hidden shrink-0">

                            @if(Auth::user()->profile_photo_url)

                                <img src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="w-full h-full object-cover">

                            @else

                                <span class="text-sm font-bold text-indigo-600">

                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                                </span>

                            @endif

                        </div>

                        {{-- ARROW --}}
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': dropdownOpen }"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2.5"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M19 9l-7 7-7-7"/>

                        </svg>

                    </button>

                    {{-- DROPDOWN --}}
                    <div
                        x-show="dropdownOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                        style="display: none;"
                        class="absolute right-0 mt-3 w-56
                               bg-white border border-gray-100
                               rounded-3xl shadow-2xl
                               shadow-gray-200/50
                               overflow-hidden z-50"
                    >

                        {{-- HEADER --}}
                        <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">

                            <p class="text-sm font-semibold text-gray-900 truncate">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500 truncate mt-1">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                        {{-- MENU --}}
                        <div class="p-2">

                            {{-- PROFILE --}}
                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3
                                      px-4 py-3 rounded-2xl
                                      text-sm font-medium text-gray-700
                                      hover:bg-gray-100
                                      transition duration-150">

                                <svg class="w-5 h-5 text-gray-400"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="2"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>

                                </svg>

                                Profil Saya

                            </a>

                            {{-- ADMIN --}}
                            @if(Auth::user()->hasRole('admin'))

                                <a href="{{ route('admin.dashboard') }}"
                                   class="flex items-center gap-3
                                          px-4 py-3 rounded-2xl
                                          text-sm font-medium text-gray-700
                                          hover:bg-gray-100
                                          transition duration-150">

                                    <svg class="w-5 h-5 text-gray-400"
                                         xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6z"/>

                                    </svg>

                                    Admin Panel

                                </a>

                            @endif

                            {{-- DIVIDER --}}
                            <div class="my-2 border-t border-gray-100"></div>

                            {{-- LOGOUT --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="flex items-center gap-3
                                               w-full px-4 py-3
                                               rounded-2xl text-sm
                                               font-medium text-red-500
                                               hover:bg-red-50
                                               transition duration-150">

                                    <svg class="w-5 h-5"
                                         xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15"/>

                                    </svg>

                                    Keluar

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            {{-- MOBILE BUTTON --}}
            <div class="flex sm:hidden ml-auto">

                <button
                    @click="open = !open"
                    class="p-2 rounded-2xl border border-gray-200
                           text-gray-500 hover:text-indigo-600
                           hover:border-indigo-300 transition duration-200"
                >

                    <svg x-show="!open"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>

                    </svg>

                    <svg x-show="open"
                         style="display:none"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>

                    </svg>

                </button>

            </div>

        </div>

    </div>

</nav>