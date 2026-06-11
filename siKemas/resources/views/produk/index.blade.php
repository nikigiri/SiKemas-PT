<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');
        .produk-root * { font-family: 'DM Sans', sans-serif; }
        .produk-root h1, .produk-root h2, .produk-root h3 { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fu  { animation: fadeUp 0.45s ease both; }
        .fu1 { animation-delay: 0.04s; }
        .fu2 { animation-delay: 0.10s; }
        .fu3 { animation-delay: 0.16s; }

        .card-produk {
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }
        .card-produk:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 48px -10px rgba(79, 70, 229, 0.14);
        }
    </style>

    <div class="produk-root bg-[#f7f8fa] min-h-screen">
        <div class="max-w-7xl mx-auto px-5 md:px-8 py-8">

            {{-- ── HEADER ── --}}
            <div class="fu fu1 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 -ml-1">

                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="group w-10 h-10 flex items-center justify-center shrink-0
                              rounded-xl bg-white border border-gray-200 shadow-sm
                              hover:bg-green-50 hover:border-green-300
                              transition duration-200">
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-green-700 transition"
                             fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">Produk Saya</h1>
                </div>

                <a href="{{ route('produk.create') }}"
                   class="inline-flex items-center gap-2.5 px-7 py-3.5
                          bg-green-700 hover:bg-green-800 text-white
                          text-base font-bold rounded-full
                          shadow-lg hover:shadow-xl hover:scale-[1.02]
                          transition duration-200 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Produk Baru
                </a>

            </div>

            {{-- ── ALERT ── --}}
            @if (session('success'))
                <div class="fu fu1 mb-6 flex items-center gap-3
                            bg-green-50 border border-green-200
                            text-green-700 px-5 py-4 rounded-2xl shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- ── EMPTY STATE ── --}}
            @if ($produks->isEmpty())

                <div class="fu fu2 bg-white rounded-[24px] border-2 border-dashed border-gray-200
                            p-16 text-center flex flex-col items-center justify-center gap-4 shadow-sm">

                    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center shadow-inner">
                        <svg class="w-8 h-8 text-indigo-300" fill="none" stroke="currentColor"
                             stroke-width="1.4" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-gray-700">Belum ada produk</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Klik <span class="text-green-700 font-semibold">"Buat Produk Baru"</span> untuk memulai!
                        </p>
                    </div>

                    <a href="{{ route('produk.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5
                              bg-green-700 text-white text-sm font-semibold
                              rounded-full hover:bg-green-800 transition shadow">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Mulai Sekarang
                    </a>

                </div>

            @else

                {{-- ── GRID ── --}}
                <div class="fu fu2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    @foreach ($produks as $index => $produk)

                        <div class="card-produk bg-white rounded-[22px] border border-gray-100
                                    overflow-hidden shadow-sm"
                             style="animation-delay: {{ 0.10 + ($index * 0.06) }}s">

                            {{-- Thumbnail --}}
                            @if ($produk->gambar_logo)
                                <div class="h-44 overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $produk->gambar_logo) }}"
                                         alt="{{ $produk->nama_produk }}"
                                         class="w-full h-full object-cover transition duration-500">
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

                            {{-- Info --}}
                            <div class="p-5">

                                <span class="inline-block text-[10px] uppercase tracking-widest font-bold
                                             bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full">
                                    {{ $produk->kategori_produk }}
                                </span>

                                <h3 class="font-bold text-gray-800 text-base mt-2 truncate">
                                    {{ $produk->nama_produk }}
                                </h3>

                                <p class="text-sm text-gray-400 mt-1 line-clamp-2 leading-relaxed">
                                    {{ $produk->deskripsi_produk }}
                                </p>

                                {{-- Divider --}}
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                                <div class="flex gap-2.5 mt-5">
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('produk.show', $produk->id) }}"
                                       class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-700 text-sm font-semibold hover:bg-gray-100 hover:border-gray-300 transition group">
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        Detail
                                    </a>

                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                       class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-[#E8F3ED] text-[#108A56] text-sm font-semibold hover:bg-[#D1E8DB] hover:text-[#0C6B43] transition group">
                                        <svg class="w-4 h-4 text-[#108A56] group-hover:text-[#0C6B43]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                        Edit
                                    </a>

                                    {{-- Tombol Hapus (Icon Saja) --}}
                                    <form method="POST" action="{{ route('produk.destroy', $produk->id) }}"
                                          onsubmit="return confirm('Yakin hapus produk ini? Semua data terkait akan ikut terhapus.')"
                                          class="shrink-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center justify-center w-[42px] h-[42px] rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition group"
                                                title="Hapus Produk">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
<<<<<<< HEAD
=======
=======
                                <div class="border-t border-gray-100 mt-4 pt-4 flex items-center gap-2">
                                    <a href="{{ route('produk.show', $produk->id) }}"
                                       class="flex-1 text-center py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                       class="flex-1 text-center py-2 rounded-xl bg-[#2f6d46] text-white text-sm font-medium hover:bg-[#245538] transition">
                                        Edit
                                    </a>
>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>