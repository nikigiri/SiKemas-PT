{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>

    {{-- Main Content --}}
    <div class="relative z-10 p-6 md:p-8 max-w-7xl mx-auto mt-4">

        {{-- BANNER --}}
        <div class="relative overflow-hidden rounded-[32px] mb-10 shadow-xl">

            {{-- IMAGE --}}
            <img
                src="{{ asset('images/banner-fix.png') }}"
                alt="Banner Dashboard"
                class="w-full h-[260px] md:h-[340px] object-cover"
            >

            {{-- CONTENT --}}
            <div class="absolute inset-0 flex items-center">

                <div class="px-6 md:px-12 max-w-2xl text-green">

                    <div class="inline-flex items-center gap-2
                                bg-white/10 backdrop-blur-md
                                border border-white/20
                                px-4 py-2 rounded-full mb-5">

                        <span class="w-2 h-2 bg-green-300 rounded-full"></span>

                        AI Packaging Generator

                    </div>

                    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">

                        Hallo, {{ Auth::user()->name }} 👋

                    </h1>

                    <p class="mt-4 text-green/90 text-base md:text-lg leading-relaxed">

                        Buat desain kemasan produk UMKM lebih menarik,
                        modern, dan profesional bersama SiKemas AI.

                    </p>

                </div>

            </div>

        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Create Product Card --}}
            <a href="{{ route('produk.create') }}"
               class="group relative overflow-hidden rounded-3xl bg-green-800 p-6 min-h-[190px]
                      flex flex-col justify-between shadow-lg shadow-green-200
                      hover:scale-[1.02] transition duration-300">

                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-12 -left-12 w-44 h-44 bg-white/5 rounded-full"></div>

                <div class="relative z-10 w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                         stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

                <div class="relative z-10">
                    <h2 class="text-xl font-bold text-white">Buat Produk Baru</h2>
                    <p class="text-indigo-100 text-sm mt-1">Mulai desain kemasan produk baru</p>
                </div>
            </a>

            {{-- Recent Designs --}}
            @forelse (
                \App\Models\Desain::whereHas('produk', fn($q) => $q->where('user_id', Auth::id()))
                    ->latest()->take(5)->get()
                as $desain
            )
                <a href="{{ route('desain.show', $desain->id) }}"
                   class="group bg-white border border-gray-100 rounded-3xl overflow-hidden
                          shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div class="h-44 bg-gray-100 overflow-hidden relative">
                        @if ($desain->thumbnail_url)
                            <img src="{{ $desain->thumbnail_url }}"
                                 alt="{{ $desain->nama }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50">
                                <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                                </svg>
                            </div>
                        @endif

                        @if ($desain->jenisKemasan)
                            <span class="absolute top-3 right-3 text-[10px] uppercase tracking-wider
                                         font-bold bg-white/90 px-3 py-1 rounded-full shadow">
                                {{ $desain->jenisKemasan->nama }}
                            </span>
                        @endif
                    </div>

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
                <div class="col-span-1 sm:col-span-1 lg:col-span-2">
                    <div class="border-2 border-dashed border-gray-200 rounded-3xl p-12 text-center bg-white h-full flex flex-col items-center justify-center">
                        <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-8 h-8 text-indigo-300" fill="none" stroke="green"
                                 stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Belum ada desain</h3>
                        <p class="text-sm text-gray-400 mt-2">
                            Klik tombol "Buat Produk Baru" untuk memulai desain pertama Anda.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>

        {{-- See All --}}
        @if(\App\Models\Desain::whereHas('produk', fn($q) => $q->where('user_id', Auth::id()))->count() > 5)
            <div class="mt-8 text-center">
                <a href="{{ route('desain.index') }}"
                   class="inline-flex items-center gap-2 text-indigo-600 font-semibold hover:underline">
                    Lihat semua desain
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        @endif

    </div>

</x-app-layout>