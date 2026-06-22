<nav x-data="{ open: false }"
     class="bg-white/80 backdrop-blur-xl border-b border-gray-100 sticky top-0 z-50">

    <div class="w-full px-4 sm:px-6 lg:px-8">

        <div class="flex items-center h-20">

            {{-- LEFT SIDE --}}
            <div class="flex items-center gap-10">

            {{-- LOGO --}}
            <a href="{{ Auth::user()->hasRole('admin') ? route('admin.dashboard') : route('dashboard') }}"
            class="flex items-center shrink-0">
            <img 
                src="{{ asset('images/logo_siKemas_PT.png') }}" 
                alt="Si Kemas" 
                class="h-12 w-auto"
            />
            </a>

                {{-- ADMIN BADGE (hanya muncul di navbar admin) --}}
                @if(Auth::user()->hasRole('admin'))
                    <span class="hidden sm:inline-flex items-center gap-1.5
                                 px-3 py-1 rounded-full text-xs font-semibold
                                 bg-slate-800 text-white">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                        </svg>
                        Admin Panel
                    </span>
                @endif

            </div>

            {{-- RIGHT SIDE --}}
            <div class="hidden sm:flex items-center gap-4 ml-auto">

                {{-- SEARCH — hanya untuk user biasa --}}
                @unless(Auth::user()->hasRole('admin'))
                <div class="w-[380px]">
                    <form method="GET" action="{{ route('dashboard') }}" id="searchForm">
                        <div class="relative w-full">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="search"
                                id="navSearch"
                                value="{{ request('search') }}"
                                placeholder="Cari desain atau produk..."
                                class="w-full h-11 pl-10 pr-4 bg-gray-100 border border-transparent rounded-2xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition duration-200"
                            />
                        </div>
                    </form>
                </div>
                @endunless

                {{-- USER DROPDOWN --}}
                <div class="relative"
                     x-data="{ dropdownOpen: false }"
                     @click.outside="dropdownOpen = false">

                    {{-- BUTTON --}}
                    <button
                        @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center gap-3
                               pl-3 pr-2 py-2
                               rounded-2xl border
                               {{ Auth::user()->hasRole('admin') ? 'border-slate-200 hover:border-slate-400 hover:shadow-md' : 'border-gray-200 hover:border-indigo-300 hover:shadow-md' }}
                               transition duration-200 bg-white"
                    >

                        {{-- TEXT --}}
                        <div class="flex flex-col items-end leading-tight">
                            <span class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </span>
                            @if(Auth::user()->hasRole('admin'))
                                <span class="text-[10px] text-slate-400 font-medium">Administrator</span>
                            @endif
                        </div>

                        {{-- AVATAR --}}
                        <div class="w-10 h-10 rounded-full
                                    {{ Auth::user()->hasRole('admin') ? 'bg-slate-800' : 'bg-indigo-100' }}
                                    flex items-center justify-center overflow-hidden shrink-0">

                            @if(Auth::user()->profile_photo_url)
                                <img src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <span class="text-sm font-bold
                                             {{ Auth::user()->hasRole('admin') ? 'text-white' : 'text-indigo-600' }}">
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
                               rounded-3xl shadow-2xl shadow-gray-200/50
                               overflow-hidden z-50"
                    >

                        {{-- HEADER --}}
                        <div class="px-5 py-4 border-b border-gray-100
                                    {{ Auth::user()->hasRole('admin') ? 'bg-slate-800' : 'bg-gray-50' }}">

                            <p class="text-sm font-semibold truncate
                                      {{ Auth::user()->hasRole('admin') ? 'text-white' : 'text-gray-900' }}">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs truncate mt-1
                                      {{ Auth::user()->hasRole('admin') ? 'text-slate-300' : 'text-gray-500' }}">
                                {{ Auth::user()->email }}
                            </p>

                            @if(Auth::user()->hasRole('admin'))
                                <span class="inline-flex items-center gap-1 mt-2
                                             px-2 py-0.5 rounded-full
                                             bg-white/20 text-white text-[10px] font-semibold">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                                    </svg>
                                    Administrator
                                </span>
                            @endif

                        </div>

                        {{-- MENU --}}
                        <div class="p-2">

                            @if(Auth::user()->hasRole('admin'))

                                {{-- MENU KHUSUS ADMIN --}}
                                <a href="{{ route('admin.dashboard') }}"
                                   class="flex items-center gap-3
                                          px-4 py-3 rounded-2xl
                                          text-sm font-medium text-gray-700
                                          hover:bg-slate-50 transition duration-150">
                                    <svg class="w-5 h-5 text-slate-500"
                                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25zM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25z"/>
                                    </svg>
                                    Dashboard Admin
                                </a>
                            @else

                                {{-- MENU KHUSUS USER --}}
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-3
                                          px-4 py-3 rounded-2xl
                                          text-sm font-medium text-gray-700
                                          hover:bg-gray-100 transition duration-150">
                                    <svg class="w-5 h-5 text-gray-400"
                                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                    </svg>
                                    Profil Saya
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
                                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
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
                    class="p-2 rounded-2xl border
                           {{ Auth::user()->hasRole('admin') ? 'border-slate-200 text-slate-500 hover:text-slate-800 hover:border-slate-400' : 'border-gray-200 text-gray-500 hover:text-indigo-600 hover:border-indigo-300' }}
                           transition duration-200"
                >
                    <svg x-show="!open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" style="display:none" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>

    </div>
<script>
const navSearch = document.getElementById('navSearch');
if (navSearch) {
    navSearch.addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.card-produk').forEach(card => {
            const nama = card.querySelector('h3')?.textContent.toLowerCase() ?? '';
            const kategori = card.querySelector('.text-xs')?.textContent.toLowerCase() ?? '';
            card.style.display = (nama.includes(keyword) || kategori.includes(keyword)) ? '' : 'none';
        });
    });

    navSearch.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('searchForm').submit();
        }
    });
}
</script>
</nav>

