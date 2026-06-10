{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>

    <div class="min-h-screen bg-gray-50">

        <div class="relative overflow-hidden bg-white border-b border-gray-100">

            {{-- Decorative blobs --}}
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-green-100 rounded-full blur-3xl opacity-30 pointer-events-none -translate-y-1/4 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-emerald-50 rounded-full blur-3xl opacity-40 pointer-events-none"></div>

            <div class="relative z-10 max-w-8xl mx-auto px-6 md:px-8 lg:px-12 py-16 lg:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12">

                    {{-- LEFT --}}
                    <div class="text-left">
                        <div class="inline-flex items-center gap-2 bg-green-50 border border-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            AI Powered Packaging Design
                        </div>

                        <p class="text-xl font-semibold text-gray-500 mb-2">
                            Hallo, {{ Auth::user()->name }}
                        </p>

                        <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900 tracking-tight">
                            Buat Desain
                            <span class="text-[#2f6d46]">Kemasan Produk</span><br>
                            Lebih Menarik dengan AI
                        </h1>

                        <p class="mt-5 text-base text-gray-500 leading-relaxed max-w-lg">
                            SiKemas membantu UMKM menciptakan ide desain kemasan yang modern,
                            menarik, dan sesuai branding bisnis hanya dalam hitungan detik.
                        </p>

                        {{-- CTA --}}
                        <div class="mt-8">
                            <a href="{{ route('produk.create') }}"
                               class="inline-flex items-center gap-3 bg-[#2f6d46] hover:bg-[#245538]
                                      text-white px-10 py-5 rounded-2xl font-bold text-lg
                                      shadow-lg shadow-green-200 hover:scale-[1.02] transition duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Buat Produk
                            </a>
                        </div>
                    </div>

                    {{-- RIGHT --}}
                    <div class="relative flex justify-center lg:justify-end">
                        <div class="relative w-full max-w-md">
                            <img src="{{ asset('images/mockup.png') }}"
                                 alt="Kemasan Produk"
                                 class="w-full h-auto rounded-3xl shadow-xl relative z-10">

                            {{-- Floating badge --}}
                            <div class="absolute -bottom-5 -left-5 bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-20 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">AI Recommendation</p>
                                    <p class="text-xs text-gray-400">Warna & desain otomatis</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{--PRODUK SAYA--}}
        <div class="max-w-7xl mx-auto px-6 md:px-8 lg:px-12 py-10" id="produk-saya">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Produk Saya</h2>
                    <p class="text-sm text-gray-400 mt-0.5">Kelola produk dan desain kemasan Anda</p>
                </div>
                <a href="{{ route('produk.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#2f6d46] text-white text-sm font-semibold hover:bg-[#245538] transition">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            @php
                $produks = Auth::user()->produks()->with('desains')->latest()->take(6)->get();
            @endphp

            @if($produks->isEmpty())

                {{-- Empty state --}}
                <div class="bg-white rounded-2xl border border-dashed border-gray-200 py-20 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700">Belum ada produk</h3>
                    <p class="text-sm text-gray-400 mt-1 mb-6">Tambahkan produk pertama untuk mulai membuat desain kemasan.</p>
                    <a href="{{ route('produk.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#2f6d46] text-white font-semibold hover:bg-[#245538] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Produk
                    </a>
                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach($produks as $index => $produk)

                        <div class="card-produk bg-white rounded-[22px] border border-gray-100
                                    overflow-hidden shadow-sm"
                             style="animation-delay: {{ 0.10 + ($index * 0.06) }}s">

                            {{-- Thumbnail --}}
                            @if ($produk->gambar_logo)
                                <div class="h-44 overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $produk->gambar_logo) }}"
                                         alt="{{ $produk->nama_produk }}"
                                         class="w-full h-full object-cover
                                                group-hover:scale-105 transition duration-500">
                                </div>
                            @else
                                <div class="h-44 bg-gradient-to-br from-indigo-50 to-purple-50
                                            flex items-center justify-center">
                                    <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor"
                                         stroke-width="1.3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                                    </svg>
                                </div>
                            @endif
                            {{-- Content --}}
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-gray-900 truncate">{{ $produk->nama_produk }}</h3>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $produk->kategori_produk }}</p>
                                    </div>
                                    <span class="shrink-0 bg-green-100 text-green-700 text-[11px] font-semibold px-2.5 py-1 rounded-full">
                                        {{ $produk->desains->count() }} Desain
                                    </span>
                                </div>

                                @if($produk->tagline)
                                    <p class="text-sm text-gray-500 mt-3 line-clamp-2">{{ $produk->tagline }}</p>
                                @endif

                                <div class="flex gap-2.5 mt-5">
                                    <a href="{{ route('produk.show', $produk->id) }}"
                                       class="flex-1 text-center py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                       class="flex-1 text-center py-2 rounded-xl bg-[#2f6d46] text-white text-sm font-medium hover:bg-[#245538] transition">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif

        </div>

    </div>

</x-app-layout>