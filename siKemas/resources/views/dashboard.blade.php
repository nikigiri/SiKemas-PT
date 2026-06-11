{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

<<<<<<< HEAD
        <div class="relative overflow-hidden bg-white border-b border-gray-100">
=======
    .dash-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes floatY {
        0%,100% { transform: translateY(0); }
        50%     { transform: translateY(-6px); }
    }
    .anim-1 { animation: fadeInUp 0.55s ease both 0.05s; }
    .anim-2 { animation: fadeInUp 0.55s ease both 0.15s; }
    .anim-3 { animation: fadeInUp 0.55s ease both 0.25s; }
    .anim-4 { animation: fadeInUp 0.55s ease both 0.35s; }
    .anim-5 { animation: fadeInUp 0.55s ease both 0.45s; }

<<<<<<< HEAD
            <div class="relative z-10 max-w-8xl mx-auto px-6 md:px-8 lg:px-12 py-16 lg:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12">
=======
    .badge-float { animation: floatY 3s ease-in-out infinite; }
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b

    .card-produk {
        animation: fadeInUp 0.5s ease both;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .card-produk:hover {
        box-shadow: 0 10px 36px rgba(47,109,70,0.12);
        transform: translateY(-3px);
    }

    /* Filter Dropdown */
    .filter-dropdown { position: relative; }
    .filter-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        right: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.10);
        min-width: 170px;
        z-index: 50;
        overflow: hidden;
    }
    .filter-menu.open { display: block; }
    .filter-menu a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        text-decoration: none;
        transition: background 0.15s;
    }
    .filter-menu a:hover { background: #f0fdf4; color: #2f6d46; }
    .filter-menu a.active { color: #2f6d46; background: #f0fdf4; }

    /* Modal Hapus */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 100;
        align-items: center;
        justify-content: center;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
        background: #fff;
        border-radius: 20px;
        padding: 32px 28px;
        max-width: 380px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        animation: fadeInUp 0.25s ease both;
    }
</style>

<div class="dash-wrap min-h-screen bg-[#f8fafc]">

    {{-- ═══════════════════════════════
         HERO SECTION
    ═══════════════════════════════════ --}}
    <div class="relative overflow-hidden bg-white border-b border-gray-100">

        {{-- Blobs --}}
        <div class="absolute -top-32 -right-32 w-[520px] h-[520px] bg-green-100 rounded-full
                    blur-[80px] opacity-40 pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-[360px] h-[360px] bg-emerald-50 rounded-full
                    blur-[60px] opacity-50 pointer-events-none"></div>

        <div class="relative z-10 max-w-[1400px] mx-auto px-6 md:px-10 py-14 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12">

                {{-- ── LEFT ── --}}
                <div>

                    {{-- Badge --}}
                    <div class="anim-1 inline-flex items-center gap-2 bg-green-50 border border-green-200
                                text-green-700 px-4 py-2 rounded-full text-xs font-bold mb-5 tracking-wide">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                        </svg>
                        AI Powered Packaging Design
                    </div>

                    {{-- Headline --}}
                    <h1 class="anim-2 text-[38px] lg:text-[44px] font-extrabold leading-[1.2] text-gray-900
                               tracking-tight mb-4">
                        Buat Desain Kemasan Produk<br>
                        Lebih Menarik dengan
                        <span class="text-[#2f6d46]">AI</span>
                        <svg class="inline-block w-9 h-9 ml-1 text-[#2f6d46] -mt-1 align-middle"
                             fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                        </svg>
                    </h1>

                    {{-- Sub --}}
                    <p class="anim-3 text-[15px] text-gray-500 leading-[1.75] max-w-[440px] mb-7">
                        SiKemas membantu UMKM menciptakan ide desain kemasan yang modern,
                        menarik, dan sesuai branding bisnis hanya dalam hitungan detik.
                    </p>

                    {{-- Feature highlights — icon diubah jadi hijau --}}
                    <div class="anim-4 grid grid-cols-2 gap-x-6 gap-y-4 mb-8">

                        @php
                        $features = [
                            ['icon' => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z', 'title' => 'Desain Otomatis', 'sub' => 'Cepat & mudah'],
                            ['icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z', 'title' => 'Kualitas Premium', 'sub' => 'Siap cetak'],
                            ['icon' => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Hemat Waktu', 'sub' => 'Efisien untuk bisnis'],
                            ['icon' => 'M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z', 'title' => 'Warna & Branding', 'sub' => 'Rekomendasi AI'],
                        ];
                        @endphp

                        @foreach($features as $f)
                        <div class="flex items-center gap-3">
                            {{-- Icon container: background & border hijau, icon hijau --}}
                            <div class="w-10 h-10 rounded-xl border border-green-200 bg-green-50
                                        flex items-center justify-center shrink-0">
                                <svg class="w-[18px] h-[18px] text-[#2f6d46]" fill="none"
                                     stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[13.5px] font-bold text-gray-800 leading-tight">{{ $f['title'] }}</p>
                                <p class="text-[12px] text-gray-400 leading-tight">{{ $f['sub'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- CTA --}}
                    <div class="anim-5">
                        <a href="{{ route('produk.create') }}"
                           class="inline-flex items-center gap-3 bg-[#2f6d46] hover:bg-[#245538]
                                  text-white px-8 py-[15px] rounded-2xl font-bold text-[15px]
                                  shadow-[0_6px_24px_rgba(47,109,70,0.28)]
                                  hover:scale-[1.02] transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Desain Kemasan
                        </a>
                    </div>
                </div>

                {{-- ── RIGHT ── --}}
                <div class="relative flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-[420px]">

                        {{-- Circle bg --}}
                        <div class="absolute top-4 left-1/2 -translate-x-1/2
                                    w-[300px] h-[300px] rounded-full bg-gray-200/80 z-0"></div>

                        {{-- Mockup image --}}
                        <img src="{{ asset('images/mockup.png') }}"
                             alt="Kemasan Produk"
                             class="relative z-10 w-full h-auto drop-shadow-xl">

                        {{-- Floating badge --}}
                        <div class="badge-float absolute -bottom-4 -left-4 z-20
                                    bg-white border border-gray-100 rounded-2xl
                                    shadow-[0_8px_32px_rgba(0,0,0,0.10)]
                                    px-5 py-3.5 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 00-3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-[13.5px] font-bold text-gray-900 leading-tight">AI Rekomendasi</p>
                                <p class="text-[11.5px] text-gray-400 leading-tight">warna dan desain otomatis</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor"
                                 stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════
         PRODUK SAYA
    ═══════════════════════════════════ --}}
    <div class="max-w-[1400px] mx-auto px-6 md:px-10 py-10" id="produk-saya">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-7">
            <div>
                <h2 class="text-xl font-extrabold text-gray-900">Produk Saya</h2>
                <p class="text-[13px] text-gray-400 mt-0.5">Kelola produk dan desain kemasan Anda</p>
            </div>
            <div class="flex items-center gap-2.5">

                {{-- ── Filter Dropdown (clickable) ── --}}
                <div class="filter-dropdown" id="filterDropdown">
                    <button onclick="toggleFilter()"
                            class="flex items-center gap-2 pl-3.5 pr-3 py-2.5 rounded-xl
                                   border border-gray-200 bg-white cursor-pointer
                                   text-[13px] font-semibold text-gray-700 select-none
                                   hover:border-green-300 hover:text-[#2f6d46] transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M7 12h10M10 17h4"/>
                        </svg>
                        <span id="filterLabel">Terbaru</span>
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                             stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="filter-menu" id="filterMenu">
                        <a href="{{ route('dashboard') }}?sort=terbaru"
                           class="{{ request('sort','terbaru') === 'terbaru' ? 'active' : '' }}"
                           onclick="setFilter('Terbaru')">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Terbaru
                        </a>
                        <a href="{{ route('dashboard') }}?sort=terlama"
                           class="{{ request('sort') === 'terlama' ? 'active' : '' }}"
                           onclick="setFilter('Terlama')">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Terlama
                        </a>
                        <a href="{{ route('dashboard') }}?sort=nama_az"
                           class="{{ request('sort') === 'nama_az' ? 'active' : '' }}"
                           onclick="setFilter('Nama A–Z')">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 13.5M17.25 9v12"/>
                            </svg>
                            Nama A–Z
                        </a>
                        <a href="{{ route('dashboard') }}?sort=nama_za"
                           class="{{ request('sort') === 'nama_za' ? 'active' : '' }}"
                           onclick="setFilter('Nama Z–A')">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21l3.75-3.75"/>
                            </svg>
                            Nama Z–A
                        </a>
                    </div>
                </div>

                {{-- Lihat Semua --}}
                <a href="{{ route('produk.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl
                          bg-[#2f6d46] text-white text-[13px] font-bold
                          hover:bg-[#245538] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                    </svg>
                    Lihat Semua
                </a>
            </div>
        </div>

<<<<<<< HEAD
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
=======
        @php
            $sort = request('sort', 'terbaru');
            $query = Auth::user()->produks()->with('desains');

            match($sort) {
                'terlama' => $query->oldest(),
                'nama_az' => $query->orderBy('nama_produk', 'asc'),
                'nama_za' => $query->orderBy('nama_produk', 'desc'),
                default   => $query->latest(),
            };

            $produks = $query->take(6)->get();
        @endphp

        @if($produks->isEmpty())

            {{-- ── Empty State ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm py-20 text-center">
                <div class="flex justify-center mb-5">
                    <svg class="w-24 h-24" viewBox="0 0 96 96" fill="none"
                         xmlns="http://www.w3.org/2000/svg" style="color:#4ade80">
                        <circle cx="29" cy="13" r="2.5" fill="currentColor" opacity="0.5"/>
                        <circle cx="66" cy="9"  r="1.8" fill="currentColor" opacity="0.4"/>
                        <circle cx="72" cy="25" r="2"   fill="currentColor" opacity="0.35"/>
                        <line x1="29" y1="6"  x2="29" y2="2"  stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <line x1="29" y1="20" x2="29" y2="24" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <line x1="22" y1="13" x2="18" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <line x1="36" y1="13" x2="40" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <rect x="20" y="48" width="56" height="34" rx="5" stroke="currentColor" stroke-width="2.5"/>
                        <path d="M20 48 L12 34 L48 34" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round" fill="none"/>
                        <path d="M76 48 L84 34 L48 34" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round" fill="none"/>
                        <line x1="48" y1="34" x2="48" y2="48" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="34" y1="41" x2="48" y2="34" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" opacity="0.35"/>
                        <line x1="62" y1="41" x2="48" y2="34" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" opacity="0.35"/>
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                    </svg>
                </div>
                <h3 class="text-[17px] font-extrabold text-gray-800 mb-2">Belum ada produk</h3>
                <p class="text-[13.5px] text-gray-400 mb-8">Mulai buat desain kemasan pertama Anda sekarang!</p>
                <a href="{{ route('produk.create') }}"
                   class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl
                          bg-[#2f6d46] text-white font-bold text-[14.5px]
                          hover:bg-[#245538] transition shadow-[0_4px_18px_rgba(47,109,70,0.22)]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Desain Kemasan
                </a>
            </div>

        @else

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 items-start">
                @foreach($produks as $index => $produk)

                    <div class="card-produk bg-white rounded-2xl border border-gray-100 shadow-sm group w-full"
                         style="animation-delay: {{ 0.08 + ($index * 0.06) }}s">

<<<<<<< HEAD
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
=======
                        {{-- Thumbnail --}}
                        @if($produk->gambar_logo)
                            <div class="h-40 overflow-hidden rounded-t-2xl">
                                <img src="{{ asset('storage/' . $produk->gambar_logo) }}"
                                     alt="{{ $produk->nama_produk }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        @else
                            <div class="h-40 bg-[#f0f2f8] flex items-center justify-center rounded-t-2xl">
                                <svg class="w-12 h-12 text-[#c5cae0]" fill="none" stroke="currentColor"
                                     stroke-width="1.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="px-5 pt-4 pb-5">
                            <h3 class="font-extrabold text-[15px] text-gray-900 truncate leading-tight">
                                {{ $produk->nama_produk }}
                            </h3>
                            <p class="text-[12.5px] text-gray-400 mt-0.5 mb-4 truncate">
                                {{ $produk->tagline ?? $produk->kategori_produk }}
                            </p>
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b

                            {{-- Action buttons: Detail | Edit | [trash icon] --}}
                            <div class="flex gap-2">

                                {{-- Detail --}}
                                <a href="{{ route('produk.show', $produk->id) }}"
                                   class="flex-1 inline-flex items-center justify-center gap-1.5
                                          py-2.5 rounded-xl bg-gray-100 text-gray-600
                                          text-[13px] font-semibold hover:bg-gray-200 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                         stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Detail
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('produk.edit', $produk->id) }}"
                                   class="flex-1 inline-flex items-center justify-center gap-1.5
                                          py-2.5 rounded-xl bg-green-50 text-[#2f6d46]
                                          text-[13px] font-semibold hover:bg-green-100 transition border border-green-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                         stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
                                    </svg>
                                    Edit
                                </a>

                                {{-- Hapus — icon trash saja --}}
                                <button onclick="confirmHapus('{{ $produk->id }}', '{{ addslashes($produk->nama_produk) }}')"
                                        class="w-10 h-10 flex items-center justify-center rounded-xl
                                               bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600
                                               transition border border-red-100 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                         stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>

<<<<<<< HEAD
=======
                                <div class="flex gap-2.5 mt-5">
                                    <a href="{{ route('produk.show', $produk->id) }}"
                                       class="flex-1 text-center py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('produk.create', $produk->id) }}"
                                       class="flex-1 text-center py-2 rounded-xl bg-[#2f6d46] text-white text-sm font-medium hover:bg-[#245538] transition">
                                        Edit
                                    </a>
                                </div>
>>>>>>> b099451 (revisi admin & super admin)
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        @endif

    </div>

</div>

{{-- ═══════════════════════════════
     MODAL KONFIRMASI HAPUS
═══════════════════════════════════ --}}
<div class="modal-overlay" id="modalHapus" onclick="closeModal(event)">
    <div class="modal-box">

        {{-- Icon --}}
        <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
            </svg>
        </div>

        <h3 class="text-[17px] font-extrabold text-gray-900 mb-2">Hapus Produk?</h3>
        <p class="text-[13.5px] text-gray-500 mb-6">
            Produk <strong id="modalProdukNama" class="text-gray-800"></strong> beserta semua desainnya
            akan dihapus permanen dan tidak bisa dipulihkan.
        </p>

        <div class="flex gap-3">
            <button onclick="tutupModal()"
                    class="flex-1 py-3 rounded-xl border border-gray-200 text-gray-700
                           text-[14px] font-semibold hover:bg-gray-50 transition">
                Batal
            </button>

            <form id="formHapus" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full py-3 rounded-xl bg-red-500 text-white
                               text-[14px] font-semibold hover:bg-red-600 transition">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // ── Filter Dropdown ──────────────────────────────────────
    function toggleFilter() {
        document.getElementById('filterMenu').classList.toggle('open');
    }
    function setFilter(label) {
        document.getElementById('filterLabel').textContent = label;
        // menu akan hilang setelah navigasi; tutup dulu sebelum reload
        document.getElementById('filterMenu').classList.remove('open');
    }
    // Tutup jika klik di luar
    document.addEventListener('click', function(e) {
        const dd = document.getElementById('filterDropdown');
        if (!dd.contains(e.target)) {
            document.getElementById('filterMenu').classList.remove('open');
        }
    });

    // Set label filter sesuai query string saat halaman load
    (function() {
        const map = { terbaru: 'Terbaru', terlama: 'Terlama', nama_az: 'Nama A–Z', nama_za: 'Nama Z–A' };
        const params = new URLSearchParams(window.location.search);
        const sort = params.get('sort') || 'terbaru';
        if (map[sort]) document.getElementById('filterLabel').textContent = map[sort];
    })();

    // ── Modal Hapus ──────────────────────────────────────────
    function confirmHapus(id, nama) {
        document.getElementById('modalProdukNama').textContent = nama;
        document.getElementById('formHapus').action = '/produk/' + id;
        document.getElementById('modalHapus').classList.add('open');
    }
    function tutupModal() {
        document.getElementById('modalHapus').classList.remove('open');
    }
    function closeModal(e) {
        // Tutup jika klik overlay (bukan modal box)
        if (e.target === document.getElementById('modalHapus')) tutupModal();
    }
</script>

</x-app-layout>