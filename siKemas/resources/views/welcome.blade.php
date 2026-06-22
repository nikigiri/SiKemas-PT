<x-guest-layout>

<div class="min-h-screen bg-[#f0f4f0] overflow-hidden">


    {{-- NAVBAR --}}
    <nav class="w-full px-6 lg:px-16 py-4 flex items-center justify-between bg-white border-b border-gray-100 fixed top-0 z-50">

        {{-- LOGO --}}
        <div class="flex items-center gap-2">
            <img 
                src="{{ asset('images/logo_siKemas_PT.png') }}" 
                alt="Si Kemas Logo" 
                class="h-12 w-auto"
            />
        </div>

        {{-- NAV LINKS --}}
        <div class="hidden lg:flex items-center gap-8 text-sm text-gray-600 font-medium">
            <a href="#Beranda" class="hover:text-gray-900 transition">Beranda</a>
            <a href="#" class="hover:text-gray-900 transition">Tentang</a>
            <a href="#fitur" class="hover:text-gray-900 transition">Fitur</a>
        </div>

        {{-- CTA BUTTON --}}
        <a href="{{ route('register') }}"
           class="bg-[#1a4731] text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-[#15803d] transition">
            Daftar Sekarang
        </a>

    </nav>

    {{-- HERO SECTION --}}
    <section class="relative pt-28 pb-0 px-6 lg:px-16 bg-gradient-to-br from-[#f0f4f0] via-white to-[#e8f5e9]">

        <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12 relative z-10 min-h-[580px]">

            {{-- LEFT --}}
            <div class="pb-16">

                <div class="inline-flex items-center gap-2 bg-green-50 border border-green-200 text-[#2f6d46] px-4 py-2 rounded-full text-sm font-medium mb-8">
                    ✦ AI Powered Packaging Design
                </div>

                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900">
                    Buat Desain <span class="text-[#2f6d46]">Kemasan<br>Produk</span> Lebih Menarik<br>dengan AI
                </h1>

                <p class="mt-6 text-base text-gray-500 leading-relaxed max-w-md">
                    Si Kemas membantu UMKM menciptakan ide desain kemasan yang modern, menarik, dan sesuai branding bisnis hanya dalam hitungan detik.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 bg-[#1a4731] text-white px-7 py-3.5 rounded-full font-semibold text-sm hover:bg-[#15803d] transition">
                        Mulai Sekarang
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 bg-[#1a4731] text-white px-7 py-3.5 rounded-full font-semibold text-sm hover:bg-[#15803d] transition">
                        Daftar Sekarang
                    </a>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="relative flex justify-center items-end h-full pt-8">

                {{-- HERO IMAGE --}}
                <img
                    src="{{ asset('images/gambar.png') }}"
                    alt="Contoh Kemasan Produk"
                    class="w-full max-w-md lg:max-w-lg h-auto object-contain relative z-10 drop-shadow-xl"
                />

            </div>

        </div>

    {{-- FEATURE BAR --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-xl flex-shrink-0">⚡</div>
                <div>
                    <h4 class="font-bold text-gray-800 text-sm">Cepat & Instan</h4>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Dapatkan ide desain kemasan dalam hitungan detik dengan bantuan AI.</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-xl flex-shrink-0">🎨</div>
                <div>
                    <h4 class="font-bold text-gray-800 text-sm">Desain Menarik</h4>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Desain modern, profesional, dan siap meningkatkan daya tarik produk Anda.</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-xl flex-shrink-0">🏷</div>
                <div>
                    <h4 class="font-bold text-gray-800 text-sm">Sesuai Branding</h4>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Hasil desain selaras dengan identitas dan nilai brand bisnis Anda.</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-xl flex-shrink-0">📥</div>
                <div>
                    <h4 class="font-bold text-gray-800 text-sm">Siap Cetak</h4>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">File desain berkualitas tinggi, siap digunakan untuk keperluan cetak.</p>
                </div>
            </div>

        </div>

        <section id="fitur" class="px-6 lg:px-16 py-24">

        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-xs font-bold tracking-widest text-[#2f6d46] uppercase mb-3">Fitur Unggulan</p>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900">
                Semua yang Anda Butuhkan untuk<br>
                <span class="text-[#2f6d46]">Desain Kemasan Sempurna</span>
            </h2>
            <p class="mt-5 text-base text-gray-500 leading-relaxed">
                Si Kemas hadir dengan fitur lengkap untuk membantu bisnis Anda tampil lebih profesional.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="bg-[#f8fafc] rounded-[24px] p-8 border border-gray-100 hover:shadow-xl transition">
                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">🎨</div>
                <h3 class="mt-5 text-xl font-bold text-gray-800">AI Design Generator</h3>
                <p class="mt-3 text-sm text-gray-500 leading-relaxed">Generate ide desain kemasan secara otomatis sesuai produk dan branding usaha Anda.</p>
            </div>

            <div class="bg-[#f8fafc] rounded-[24px] p-8 border border-gray-100 hover:shadow-xl transition">
                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">🎯</div>
                <h3 class="mt-5 text-xl font-bold text-gray-800">Smart Branding</h3>
                <p class="mt-3 text-sm text-gray-500 leading-relaxed">Rekomendasi warna dan konsep desain sesuai identitas usaha dan target pasar.</p>
            </div>

            <div class="bg-[#f8fafc] rounded-[24px] p-8 border border-gray-100 hover:shadow-xl transition">
                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">📦</div>
                <h3 class="mt-5 text-xl font-bold text-gray-800">Packaging Mockup</h3>
                <p class="mt-3 text-sm text-gray-500 leading-relaxed">Visualisasi kemasan produk dengan tampilan modern dan profesional.</p>
            </div>

        </div>

    </section>

    {{-- CTA --}}
    <section class="px-6 lg:px-16 py-24">

        <div class="bg-gradient-to-r from-[#1f5c38] to-[#3a9e6f]
                    rounded-[32px] p-12 lg:p-20 text-center text-white relative overflow-hidden">

            <div class="absolute -top-20 -right-20 w-72 h-72 border-[20px] border-white/10 rounded-full"></div>
            <div class="absolute -bottom-16 -left-16 w-56 h-56 border-[16px] border-white/5 rounded-full"></div>

            <div class="relative z-10">
                <h2 class="text-3xl lg:text-5xl font-extrabold leading-tight">
                    Tingkatkan Branding Produk<br>Anda Bersama Si Kemas
                </h2>
                <p class="mt-6 text-base text-green-100 max-w-xl mx-auto leading-relaxed">
                    Mulai perjalanan bisnis modern dengan desain kemasan berbasis AI yang lebih cepat, praktis, dan profesional.
                </p>
                <a href="{{ route('register') }}"
                   class="inline-block mt-8 bg-white text-[#1a4731] px-8 py-4 rounded-full font-bold text-sm hover:scale-105 transition">
                    Daftar Sekarang
                </a>
            </div>

        </div>

    </section>
    </section>

</div>

</x-guest-layout>