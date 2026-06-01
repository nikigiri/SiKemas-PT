{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>

    {{-- Main Content --}}
    <div class="relative z-10 p-6 md:p-8 max-w-7xl mx-auto mt-4">

        {{-- BANNER --}}
        <div class="relative overflow-hidden bg-white rounded-[32px] mb-10 shadow-xl border border-gray-100 p-8 lg:p-12">
            
            {{-- DECORATION --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-100 rounded-full blur-3xl opacity-40 pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12 lg:gap-16 relative z-10">

                {{-- LEFT --}}
                <div>

                    <div class="inline-flex items-center gap-2 bg-green-50 border border-green-100 text-[#2f6d46] px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        AI Powered Packaging Design
                    </div>

                    {{-- SAPAAN USER --}}
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-700 mb-2">
                        Hallo, {{ Auth::user()->name }} 👋
                    </h2>

                    <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900">
                        Buat Desain
                        <span class="text-[#2f6d46]">
                            Kemasan Produk
                        </span><br>
                        Lebih Menarik dengan AI
                    </h1>

                    <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl">
                        SiKemas membantu UMKM menciptakan ide desain kemasan yang modern,
                        menarik, dan sesuai branding bisnis hanya dalam hitungan detik.
                    </p>

                    {{-- BUTTON --}}
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="{{ route('produk.create') }}"
                           class="bg-gradient-to-r from-[#2f6d46] to-[#78b067]
                                  text-white px-8 py-4 rounded-2xl
                                  font-semibold shadow-xl shadow-green-200
                                  hover:scale-105 transition duration-300">
                            Mulai Sekarang
                        </a>

                        <a href="#produk-saya"
                           class="border border-gray-300 px-8 py-4 rounded-2xl
                                  font-semibold text-gray-700 hover:bg-gray-50 transition">
                            Lihat Produk Saya
                        </a>
                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="relative flex justify-center lg:justify-end mt-10 lg:mt-0">

                    {{-- FLOATING CARD --}}
                    <div class="relative w-full max-w-md mx-auto lg:mr-4">
                        
                        <img 
                            src="{{ asset('images/mockup.png') }}" 
                            alt="Gambar Kemasan" 
                            class="w-full h-auto rounded-3xl shadow-lg relative z-10"
                        />

                        <div class="absolute -bottom-6 -left-6 bg-white rounded-3xl shadow-xl p-5 w-60 border border-gray-100 z-20">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center text-xl">
                                    ✨
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 text-sm">
                                        AI Recommendation
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Warna & desain otomatis
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

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

        <div class="mt-12" id="produk-saya">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        Produk Saya
                    </h2>
                    <p class="text-sm text-gray-500">
                        Kelola produk dan desain kemasan Anda
                    </p>
                </div>

                <a href="{{ route('produk.index') }}"
                   class="px-5 py-2.5 rounded-xl bg-green-700 text-white font-medium hover:bg-green-800 transition">
                    Lihat Semua
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($produks as $produk)

                    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">

                        <div class="h-48 bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">

                            @if($produk->gambar_logo)

                                <img
                                    src="{{ asset('storage/'.$produk->gambar_logo) }}"
                                    class="w-28 h-28 object-contain"
                                >

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-16 h-16 text-green-300"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.5"
                                          d="M20 13V7a2 2 0 00-1-1.732l-6-3.333a2 2 0 00-2 0L5 5.268A2 2 0 004 7v6m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4"/>

                                </svg>

                            @endif

                        </div>

                        <div class="p-6">

                            <div class="flex items-start justify-between">

                                <div>
                                    <h3 class="font-bold text-lg text-gray-900">
                                        {{ $produk->nama_produk }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $produk->kategori_produk }}
                                    </p>
                                </div>

                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                    {{ $produk->desains->count() }} Desain
                                </span>

                            </div>

                            @if($produk->tagline)
                                <p class="text-sm text-gray-600 mt-4 line-clamp-2">
                                    {{ $produk->tagline }}
                                </p>
                            @endif

                            <div class="flex gap-3 mt-6">

                                <a href="{{ route('produk.show',$produk->id) }}"
                                   class="flex-1 text-center py-2.5 rounded-xl bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition">
                                    Detail
                                </a>

                                <a href="{{ route('produk.edit',$produk->id) }}"
                                   class="flex-1 text-center py-2.5 rounded-xl bg-green-700 text-white font-medium hover:bg-green-800 transition">
                                    Edit
                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full">

                        <div class="bg-white rounded-3xl border-2 border-dashed border-gray-200 p-12 text-center">

                            <h3 class="text-xl font-semibold text-gray-800">
                                Belum Ada Produk
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Tambahkan produk pertama untuk mulai membuat desain kemasan.
                            </p>

                            <a href="{{ route('produk.create') }}"
                               class="inline-flex mt-6 px-6 py-3 rounded-xl bg-green-700 text-white font-medium">
                                Buat Produk
                            </a>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>