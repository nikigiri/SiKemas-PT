<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">
                    Riwayat Desain
                </h2>

                <p class="text-gray-500 mt-1">
                    Kelola seluruh desain kemasan AI dalam satu dashboard modern.
                </p>
            </div>

            <a href="{{ route('produk.create') }}"
               class="group inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-semibold shadow-lg shadow-indigo-200 hover:scale-105 transition duration-300">

                {{-- Heroicon: plus --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 transition group-hover:rotate-90 duration-300"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Buat Kemasan
            </a>

        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 py-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if (session('success'))
                <div class="mb-8 backdrop-blur-xl bg-white/70 border border-green-100 shadow-lg rounded-3xl p-5 flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-md">

                        {{-- Heroicon: check --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-white"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4.5 12.75l6 6 9-13.5" />
                        </svg>

                    </div>

                    <div>
                        <p class="font-bold text-green-700">
                            Berhasil
                        </p>

                        <p class="text-sm text-green-600">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>
            @endif

            {{-- Empty State --}}
            @if ($desains->isEmpty())

                <div class="relative overflow-hidden bg-white/70 backdrop-blur-2xl border border-white rounded-[32px] shadow-2xl p-14 text-center">

                    {{-- Glow --}}
                    <div class="absolute -top-16 -right-16 w-52 h-52 bg-indigo-200 rounded-full blur-3xl opacity-40"></div>
                    <div class="absolute -bottom-16 -left-16 w-52 h-52 bg-violet-200 rounded-full blur-3xl opacity-40"></div>

                    <div class="relative z-10">

                        <div class="mx-auto w-28 h-28 rounded-[28px] bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center shadow-2xl shadow-indigo-300">

                            {{-- Heroicon: cube --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-14 h-14 text-white"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m21 7.5-9-4.5-9 4.5m18 0-9 4.5m9-4.5v9l-9 4.5m0-9L3 7.5m9 4.5v9" />
                            </svg>

                        </div>

                        <h3 class="mt-8 text-4xl font-black text-gray-900">
                            Belum Ada Desain
                        </h3>

                        <p class="mt-3 text-gray-500 max-w-xl mx-auto leading-relaxed">
                            Mulai generate desain kemasan berbasis AI dengan tampilan modern dan profesional.
                        </p>

                        <a href="{{ route('produk.create') }}"
                           class="mt-8 inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-semibold shadow-xl shadow-indigo-200 hover:scale-105 transition duration-300">

                            {{-- Heroicon: sparkles --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9.813 15.904L9 18l-.813-2.096a4.5 4.5 0 00-2.87-2.87L3 12l2.317-.813a4.5 4.5 0 002.87-2.87L9 6l.813 2.317a4.5 4.5 0 002.87 2.87L15 12l-2.317.813a4.5 4.5 0 00-2.87 2.87z" />
                            </svg>

                            Generate Sekarang
                        </a>

                    </div>

                </div>

            @else

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                    @foreach ($desains as $desain)

                        <div class="group relative overflow-hidden rounded-[32px] bg-white/70 backdrop-blur-xl border border-white shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-500">

                            {{-- Glow Effect --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/0 via-violet-500/0 to-pink-500/0 group-hover:from-indigo-500/10 group-hover:via-violet-500/10 group-hover:to-pink-500/10 transition duration-500"></div>

                            {{-- Image --}}
                            <div class="relative overflow-hidden">

                                @if ($desain->produk->gambar_logo)

                                    <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}"
                                         alt="{{ $desain->judul_desain }}"
                                         class="w-full h-60 object-cover group-hover:scale-110 transition duration-700">

                                @else

                                    <div class="w-full h-60 flex items-center justify-center"
                                         style="background: linear-gradient(135deg,
                                         {{ $desain->paletWarna->warna_utama }},
                                         {{ $desain->paletWarna->warna_sekunder }})">

                                        <h2 class="text-white text-2xl font-black text-center px-6">
                                            {{ $desain->judul_desain }}
                                        </h2>

                                    </div>

                                @endif

                                {{-- Floating Status --}}
                                <div class="absolute top-5 right-5">

                                    <div class="px-4 py-2 rounded-2xl backdrop-blur-xl bg-white/80 border border-white shadow-lg">

                                        <div class="flex items-center gap-2">

                                            <div class="w-2 h-2 rounded-full
                                                {{ $desain->status_desain == 'generated'
                                                    ? 'bg-green-500'
                                                    : ($desain->status_desain == 'exported'
                                                        ? 'bg-blue-500'
                                                        : 'bg-gray-400') }}">
                                            </div>

                                            <span class="text-xs font-bold text-gray-700 uppercase tracking-wide">
                                                {{ $desain->status_desain }}
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- Content --}}
                            <div class="relative p-7">

                                {{-- Title --}}
                                <h3 class="text-2xl font-black text-gray-900 leading-tight line-clamp-1">
                                    {{ $desain->judul_desain }}
                                </h3>

                                {{-- Meta --}}
                                <div class="mt-6 space-y-4">

                                    {{-- Jenis --}}
                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center">

                                            {{-- Heroicon: archive-box --}}
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-6 h-6 text-indigo-600"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="1.8">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M20.25 6.375c0 .621-.504 1.125-1.125 1.125H4.875A1.125 1.125 0 013.75 6.375v-1.5c0-.621.504-1.125 1.125-1.125h14.25c.621 0 1.125.504 1.125 1.125v1.5z" />

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M4.5 9.75h15v8.625A1.125 1.125 0 0118.375 19.5H5.625A1.125 1.125 0 014.5 18.375V9.75z" />
                                            </svg>

                                        </div>

                                        <div>
                                            <p class="text-xs font-semibold uppercase text-gray-400">
                                                Kemasan
                                            </p>

                                            <p class="font-bold text-gray-800">
                                                {{ $desain->jenisKemasan->nama_kemasan }}
                                            </p>
                                        </div>

                                    </div>

                                    {{-- Palette --}}
                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-2xl bg-pink-100 flex items-center justify-center">

                                            {{-- Heroicon: swatch --}}
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-6 h-6 text-pink-600"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="1.8">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M4.098 19.902a3.75 3.75 0 005.304 0l8.196-8.196a3.75 3.75 0 10-5.304-5.304L4.098 14.598a3.75 3.75 0 000 5.304z" />
                                            </svg>

                                        </div>

                                        <div class="flex-1">
                                            <p class="text-xs font-semibold uppercase text-gray-400">
                                                Palet Warna
                                            </p>

                                            <p class="font-bold text-gray-800">
                                                {{ $desain->paletWarna->nama_palet }}
                                            </p>

                                            <div class="flex overflow-hidden rounded-full h-2 mt-2 shadow-inner">

                                                <div class="flex-1"
                                                     style="background-color: {{ $desain->paletWarna->warna_utama }}">
                                                </div>

                                                <div class="flex-1"
                                                     style="background-color: {{ $desain->paletWarna->warna_sekunder }}">
                                                </div>

                                                <div class="flex-1"
                                                     style="background-color: {{ $desain->paletWarna->warna_aksen }}">
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- Time --}}
                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center">

                                            {{-- Heroicon: clock --}}
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-6 h-6 text-slate-600"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="1.8">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>

                                        </div>

                                        <div>
                                            <p class="text-xs font-semibold uppercase text-gray-400">
                                                Dibuat
                                            </p>

                                            <p class="font-bold text-gray-800">
                                                {{ $desain->created_at->diffForHumans() }}
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-4 mt-8">

                                    {{-- Detail --}}
                                    <a href="{{ route('desain.show', $desain->id) }}"
                                       class="flex-1 inline-flex items-center justify-center gap-2 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">

                                        {{-- Heroicon: eye --}}
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z" />

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        Detail
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('desain.destroy', $desain->id) }}"
                                          onsubmit="return confirm('Yakin hapus desain ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="w-14 h-14 rounded-2xl bg-red-50 hover:bg-red-500 border border-red-100 hover:border-red-500 flex items-center justify-center group transition">

                                            {{-- Heroicon: trash --}}
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-5 h-5 text-red-500 group-hover:text-white transition"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="2">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M6 7.5h12m-10.5 0V6a1.5 1.5 0 011.5-1.5h3A1.5 1.5 0 0113.5 6v1.5m-7.5 0v10.125A1.875 1.875 0 007.875 19.5h8.25A1.875 1.875 0 0018 17.625V7.5M9.75 10.5v4.5m4.5-4.5v4.5" />
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>
    </div>
</x-app-layout>