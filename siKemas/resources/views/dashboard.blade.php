{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>

    {{-- Topbar --}}
    <div class="sticky top-0 z-20 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="px-6 py-4 flex items-center justify-between gap-4">

            {{-- Search --}}
            <div class="relative flex-1 max-w-md">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>

                <input
                    type="text"
                    placeholder="Cari desain atau produk..."
                    class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-2xl text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500
                           focus:bg-white transition-all"
                >
            </div>

            {{-- User --}}
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-indigo-500 font-medium uppercase tracking-wider">
                        {{ Auth::user()->kwt->nama_kwt ?? 'Member' }}
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm uppercase shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="relative z-10 p-6 md:p-8 max-w-7xl mx-auto mt-4"> 
    
    <div class="mb-10 animate-fade-in"> 
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
            Hallo, selamat datang di SiKemas 👋
        </h1>

        <p class="text-gray-600 mt-3 max-w-2xl text-base md:text-lg leading-relaxed">
            Buat desain kemasan produk UMKM-mu lebih menarik dan profesional
            dengan bantuan AI dan template desain modern.
        </p>
    </div>
        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Create Product Card --}}
            <a href="{{ route('produk.index') }}"
               class="group relative overflow-hidden rounded-3xl bg-indigo-600 p-6 min-h-[190px]
                      flex flex-col justify-between shadow-lg shadow-indigo-200
                      hover:scale-[1.02] transition duration-300">

                {{-- Decorative --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-12 -left-12 w-44 h-44 bg-white/5 rounded-full"></div>

                {{-- Icon --}}
                <div class="relative z-10 w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2.5"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

                {{-- Text --}}
                <div class="relative z-10">
                    <h2 class="text-xl font-bold text-white">
                        Buat Produk Baru
                    </h2>

                    <p class="text-indigo-100 text-sm mt-1">
                        Mulai desain kemasan produk baru
                    </p>
                </div>
            </a>

            {{-- Recent Design --}}
            @forelse (Auth::user()->desains()->latest()->take(5)->get() as $desain)

                <a href="{{ route('desain.show', $desain->id) }}"
                   class="group bg-white border border-gray-100 rounded-3xl overflow-hidden
                          shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    {{-- Thumbnail --}}
                    <div class="h-44 bg-gray-100 overflow-hidden relative">

                        @if ($desain->thumbnail_url)

                            <img src="{{ $desain->thumbnail_url }}"
                                 alt="{{ $desain->nama }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                        @else

                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50">
                                <svg class="w-12 h-12 text-indigo-200"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.5"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                                </svg>
                            </div>

                        @endif

                        {{-- Badge --}}
                        @if ($desain->jenisKemasan)
                            <span class="absolute top-3 right-3 text-[10px] uppercase tracking-wider font-bold bg-white/90 px-3 py-1 rounded-full shadow">
                                {{ $desain->jenisKemasan->nama }}
                            </span>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 text-base truncate">
                            {{ $desain->nama ?? 'Desain Tanpa Nama' }}
                        </h3>

                        <p class="text-sm text-gray-400 mt-1 line-clamp-2">
                            {{ $desain->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
                        </p>
                    </div>
                </a>

            @empty

                {{-- Empty --}}
                <div class="col-span-1 sm:col-span-2 lg:col-span-2">

                    <div class="border-2 border-dashed border-gray-200 rounded-3xl p-12 text-center bg-white">

                        <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-8 h-8 text-indigo-300"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                            </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-700">
                            Belum ada desain
                        </h3>

                        <p class="text-sm text-gray-400 mt-2">
                            Klik tombol "Buat Produk Baru" untuk memulai desain pertama Anda.
                        </p>
                    </div>
                </div>

            @endforelse

        </div>

        {{-- More --}}
        @if(Auth::user()->desains()->count() > 5)

            <div class="mt-8 text-center">

                <a href="{{ route('desain.index') }}"
                   class="inline-flex items-center gap-2 text-indigo-600 font-semibold hover:underline">

                    Lihat semua desain

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>

            </div>

        @endif

    </div>

</x-app-layout>