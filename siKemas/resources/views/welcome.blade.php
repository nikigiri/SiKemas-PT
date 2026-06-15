<x-guest-layout>

    <div class="min-h-screen bg-[#f5f7fb] overflow-hidden">

        {{-- NAVBAR --}}
        <nav class="w-full px-6 lg:px-16 py-5 flex items-center justify-between bg-white/80 backdrop-blur-md border-b border-gray-100 fixed top-0 z-50">
{{-- LOGO --}}
<div class="flex justify-center mb-6">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lora:wght@700&display=swap');
        .logo-sikemas {
            font-family: 'Lora', Georgia, serif;
            font-weight: 700;
            font-size: 2.2rem;
            letter-spacing: 1px;
            line-height: 1;
            user-select: none;
            background: linear-gradient(to bottom, #22c55e, #15803d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    <span class="logo-sikemas">SiKemas</span>

</div>

            {{-- BUTTON --}}
            <div class="flex items-center gap-4">

                <a href="{{ route('login') }}"
                   class="text-[#2f6d46] font-semibold hover:underline">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                   class="bg-gradient-to-r from-[#2f6d46] to-[#78b067]
                          text-white px-6 py-3 rounded-2xl
                          font-semibold shadow-lg shadow-green-200
                          hover:opacity-90 transition">

                    Mulai Gratis

                </a>

            </div>

        </nav>

        {{-- HERO SECTION --}}
        <section class="relative pt-40 pb-24 px-6 lg:px-16">

            {{-- DECORATION --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-100 rounded-full blur-3xl opacity-40"></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-16 relative z-10">

                {{-- LEFT --}}
                <div>

                    <div class="inline-flex items-center gap-2 bg-green-100 text-[#2f6d46] px-4 py-2 rounded-full text-sm font-semibold mb-6">

                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>

                        AI Powered Packaging Design

                    </div>

                    <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight text-gray-900">

                        Buat Desain
                        <span class="text-[#2f6d46]">
                            Kemasan Produk
                        </span>
                        Lebih Menarik dengan AI

                    </h1>

                    <p class="mt-8 text-lg text-gray-600 leading-relaxed max-w-xl">

                        Si Kemas membantu UMKM menciptakan ide desain kemasan yang modern,
                        menarik, dan sesuai branding bisnis hanya dalam hitungan detik.

                    </p>

                    {{-- BUTTON --}}
                    <div class="mt-10 flex flex-wrap gap-4">

                        <a href="{{ route('register') }}"
                           class="bg-gradient-to-r from-[#2f6d46] to-[#78b067]
                                  text-white px-8 py-4 rounded-2xl
                                  font-semibold shadow-xl shadow-green-200
                                  hover:scale-105 transition duration-300">

                            Mulai Sekarang

                        </a>

                        <a href="#fitur"
                           class="border border-gray-300 px-8 py-4 rounded-2xl
                                  font-semibold text-gray-700 hover:bg-gray-100 transition">

                            Pelajari Lebih Lanjut

                        </a>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="relative flex justify-center">

                        {{-- FLOATING CARD --}}
                        <div class="relative w-full max-w-lg mx-auto">
    
                            <img 
                                src="{{ asset('images/mockup.png') }}" 
                                alt="Gambar Kemasan" 
                                class="w-full h-auto rounded-3xl shadow-md"
                            />

                            <div class="absolute -bottom-6 -left-6 bg-white rounded-3xl shadow-xl p-5 w-60 border border-gray-100 z-10">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                                        ✨
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800">
                                            AI Recommendation
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Warna & desain otomatis
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- FITUR --}}
        <section id="fitur" class="px-6 lg:px-16 py-24 bg-white">

            <div class="text-center max-w-3xl mx-auto">

                <h2 class="text-4xl font-extrabold text-gray-900">
                    Fitur Unggulan Si Kemas
                </h2>

                <p class="mt-5 text-lg text-gray-500 leading-relaxed">
                    Semua yang dibutuhkan UMKM untuk menciptakan desain kemasan modern dan profesional.
                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">

                {{-- CARD --}}
                <div class="bg-[#f8fafc] rounded-[30px] p-8 border border-gray-100 hover:shadow-xl transition">

                    <div class="w-16 h-16 rounded-3xl bg-green-100 flex items-center justify-center text-3xl">
                        🎨
                    </div>

                    <h3 class="mt-6 text-2xl font-bold text-gray-800">
                        AI Design Generator
                    </h3>

                    <p class="mt-4 text-gray-500 leading-relaxed">
                        Generate ide desain kemasan secara otomatis sesuai produk dan branding usaha Anda.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-[#f8fafc] rounded-[30px] p-8 border border-gray-100 hover:shadow-xl transition">

                    <div class="w-16 h-16 rounded-3xl bg-green-100 flex items-center justify-center text-3xl">
                        🎯
                    </div>

                    <h3 class="mt-6 text-2xl font-bold text-gray-800">
                        Smart Branding
                    </h3>

                    <p class="mt-4 text-gray-500 leading-relaxed">
                        Rekomendasi warna dan konsep desain sesuai identitas usaha dan target pasar.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-[#f8fafc] rounded-[30px] p-8 border border-gray-100 hover:shadow-xl transition">

                    <div class="w-16 h-16 rounded-3xl bg-green-100 flex items-center justify-center text-3xl">
                        📦
                    </div>

                    <h3 class="mt-6 text-2xl font-bold text-gray-800">
                        Packaging Mockup
                    </h3>

                    <p class="mt-4 text-gray-500 leading-relaxed">
                        Visualisasi kemasan produk dengan tampilan modern dan profesional.
                    </p>

                </div>

            </div>

        </section>

        {{-- CTA --}}
        <section class="px-6 lg:px-16 py-24">

            <div class="bg-gradient-to-r from-[#1f5c38] to-[#78b067]
                        rounded-[40px] p-12 lg:p-20 text-center text-white relative overflow-hidden">

                <div class="absolute -top-20 -right-20 w-72 h-72 border-[20px] border-white/10 rounded-full"></div>

                <div class="relative z-10">

                    <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight">

                        Tingkatkan Branding Produk
                        Anda Bersama Si Kemas

                    </h2>

                    <p class="mt-6 text-lg text-green-50 max-w-2xl mx-auto leading-relaxed">

                        Mulai perjalanan bisnis modern dengan desain kemasan berbasis AI yang lebih cepat, praktis, dan profesional.

                    </p>

                    <a href="{{ route('register') }}"
                       class="inline-block mt-10 bg-white text-[#2f6d46]
                              px-8 py-4 rounded-2xl font-bold
                              hover:scale-105 transition">

                        Daftar Sekarang

                    </a>

                </div>

            </div>

        </section>

    </div>

</x-guest-layout>