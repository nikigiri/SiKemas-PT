<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');
            .detail-root * { font-family: 'DM Sans', sans-serif; }
            .detail-root h1,
            .detail-root h2,
            .detail-root h3,
            .detail-root h4 { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>

        <div class="detail-root flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('produk.index') }}"
                   class="group w-10 h-10 flex items-center justify-center rounded-xl
                          bg-white shadow-sm border border-gray-200
                          hover:bg-emerald-50 hover:border-emerald-300 transition duration-200">
                    <svg class="w-4 h-4 text-gray-500 group-hover:text-emerald-700 transition"
                         fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                    </svg>
                </a>
                <div>
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-widest leading-none mb-0.5">
                        Detail Produk
                    </p>
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        {{ $produk->nama_produk }}
                    </h2>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('produk.edit', $produk->id) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5
                          border border-emerald-600 text-emerald-700
                          rounded-xl hover:bg-emerald-50 hover:border-emerald-700
                          text-sm font-semibold transition duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                    </svg>
                    Edit Produk
                </a>

                <form method="POST" action="{{ route('produk.destroy', $produk->id) }}"
                      onsubmit="return confirm('Yakin hapus produk ini? Semua desainnya juga akan terhapus!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5
                                   bg-red-50 text-red-600 border border-red-200
                                   rounded-xl hover:bg-red-600 hover:text-white
                                   hover:border-red-600 text-sm font-semibold
                                   transition duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                        Hapus Produk
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fu  { animation: fadeUp 0.45s cubic-bezier(0.22, 1, 0.36, 1) both; }
        .fu1 { animation-delay: 0.04s; }
        .fu2 { animation-delay: 0.12s; }

        .detail-root * { font-family: 'DM Sans', sans-serif; }
        .detail-root h1,
        .detail-root h2,
        .detail-root h3,
        .detail-root h4 { font-family: 'Plus Jakarta Sans', sans-serif; }

        .desain-row {
            transition: border-color 0.18s ease, background 0.18s ease,
                        transform 0.18s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .desain-row:hover {
            transform: translateX(3px);
            border-color: #6EE7B7 !important;
            background: #F0FDF4;
        }

        .btn-hapus-desain {
            background: #FEF2F2; color: #DC2626;
            border: 1px solid #FECACA;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }
        .btn-hapus-desain:hover {
            background: #DC2626; color: #fff; border-color: #DC2626;
        }
    </style>

    <div class="detail-root py-10 min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ── ALERT ── --}}
            @if (session('success'))
                <div class="fu fu1 flex items-center gap-3
                            bg-emerald-50 border border-emerald-200
                            text-emerald-800 px-5 py-4 rounded-2xl shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                             stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            {{-- ── INFO PRODUK ── --}}
            <div class="fu fu1 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex gap-6">

                        @if ($produk->gambar_logo)
                            <div class="shrink-0 w-28 h-28 rounded-2xl overflow-hidden
                                        border border-gray-200 bg-gray-50 shadow-sm">
                                <img src="{{ asset('storage/' . $produk->gambar_logo) }}"
                                     alt="{{ $produk->nama_produk }}"
                                     class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="shrink-0 w-28 h-28 bg-emerald-50 rounded-2xl
                                        border border-emerald-100 flex flex-col
                                        items-center justify-center gap-1.5 shadow-sm">
                                <svg class="w-8 h-8 text-emerald-300" fill="none" stroke="currentColor"
                                     stroke-width="1.4" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V7"/>
                                </svg>
                                <span class="text-[10px] font-semibold text-emerald-400 uppercase tracking-wider">
                                    No Logo
                                </span>
                            </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <span class="inline-block text-[10px] uppercase tracking-widest font-bold
                                         bg-emerald-50 text-emerald-700 border border-emerald-200
                                         px-3 py-1 rounded-full">
                                {{ $produk->kategori_produk }}
                            </span>

                            <h3 class="font-bold text-xl text-gray-900 mt-2 leading-snug">
                                {{ $produk->nama_produk }}
                            </h3>

                            @if ($produk->tagline)
                                <p class="text-sm text-gray-400 italic mt-1">
                                    "{{ $produk->tagline }}"
                                </p>
                            @endif

                            @if ($produk->deskripsi_produk)
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                                    {{ $produk->deskripsi_produk }}
                                </p>
                            @endif

                            <div class="flex items-center gap-1.5 mt-3">
                                <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <p class="text-xs text-gray-400">
                                    Dibuat {{ $produk->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── RIWAYAT DESAIN ── --}}
            <div class="fu fu2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Riwayat Desain</h4>
                            <p class="text-sm text-gray-400 mt-0.5">
                                {{ $produk->desains->count() }} desain dibuat
                            </p>
                        </div>

                        <a href="{{ route('produk.pilih-kemasan', $produk->id) }}"
                           class="inline-flex items-center gap-2 px-4 py-2.5
                                  bg-emerald-700 text-white text-sm font-bold
                                  rounded-xl hover:bg-emerald-800
                                  shadow-md shadow-emerald-800/15
                                  transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                 stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                            Generate Baru
                        </a>
                    </div>

                    @if ($produk->desains->isEmpty())
                        <div class="border-2 border-dashed border-gray-200 rounded-2xl
                                    p-12 text-center flex flex-col items-center gap-4">
                            <div class="w-16 h-16 bg-emerald-50 rounded-2xl border border-emerald-100
                                        flex items-center justify-center">
                                <svg class="w-8 h-8 text-emerald-300" fill="none" stroke="currentColor"
                                     stroke-width="1.4" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-700">Belum ada desain</p>
                                <p class="text-sm text-gray-400 mt-1">
                                    Klik <span class="text-emerald-700 font-semibold">"Generate Baru"</span>
                                    untuk membuat desain pertama!
                                </p>
                            </div>
                        </div>

                    @else
                        <div class="space-y-2.5">
                            @foreach ($produk->desains->sortByDesc('created_at') as $desain)
                                <a href="{{ route('desain.show', $desain->id) }}"
                                   class="desain-row flex items-center gap-4 p-4
                                          border border-gray-100 rounded-xl group block">

                                    {{-- Swatch Warna --}}
                                    <div class="flex rounded-lg overflow-hidden h-11 w-20 shrink-0
                                                shadow-sm border border-gray-100">
                                        <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_utama }}"></div>
                                        <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"></div>
                                        <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_aksen }}"></div>
                                    </div>

                                    {{-- Info --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm truncate group-hover:text-emerald-700 transition">
                                            {{ $desain->jenisKemasan->nama_kemasan }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            {{ $desain->paletWarna->nama_palet }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            {{ $desain->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                    {{-- Arrow --}}
                                    <div class="shrink-0 w-8 h-8 rounded-lg bg-gray-50 group-hover:bg-emerald-50
                                                border border-gray-100 group-hover:border-emerald-200
                                                flex items-center justify-center transition">
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 transition"
                                             fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                        </svg>
                                    </div>

                                    {{-- Tombol Hapus --}}
                                    <form method="POST"
                                          action="{{ route('desain.destroy', $desain->id) }}"
                                          onclick="event.preventDefault(); event.stopPropagation();"
                                          onsubmit="event.stopPropagation(); return confirm('Yakin hapus desain ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="event.stopPropagation(); this.closest('form').dispatchEvent(new Event('submit'));"
                                                class="btn-hapus-desain inline-flex items-center gap-1.5
                                                       px-3 py-1.5 rounded-lg text-xs font-semibold shrink-0">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                 stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>