<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('produk.index') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $produk->nama_produk }}</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Detail & riwayat desain produk</p>
                </div>
            </div>
            <a href="{{ route('produk.edit', $produk->id) }}"
                class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-xl hover:bg-indigo-50 text-sm font-medium transition">
                Edit Produk
            </a>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-2xl shadow-sm">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Info Produk --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex gap-6">
                    @if ($produk->gambar_logo)
                        <img src="{{ asset('storage/' . $produk->gambar_logo) }}"
                             alt="{{ $produk->nama_produk }}"
                             class="w-28 h-28 object-contain rounded-xl border border-gray-200 bg-gray-50">
                    @else
                        <div class="w-28 h-28 bg-gray-100 rounded-xl flex items-center justify-center">
                            <span class="text-gray-400 text-sm">No Logo</span>
                        </div>
                    @endif

                    <div class="flex-1">
                        <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">
                            {{ $produk->kategori_produk }}
                        </span>
                        <h3 class="font-bold text-xl text-gray-800 mt-2">{{ $produk->nama_produk }}</h3>
                        @if ($produk->tagline)
                            <p class="text-sm text-gray-500 italic mt-1">"{{ $produk->tagline }}"</p>
                        @endif
                        @if ($produk->deskripsi_produk)
                            <p class="text-sm text-gray-600 mt-2">{{ $produk->deskripsi_produk }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-2">Dibuat {{ $produk->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            {{-- Riwayat Desain --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h4 class="font-bold text-gray-800 text-lg">Riwayat Desain</h4>
                        <p class="text-sm text-gray-400 mt-0.5">{{ $produk->desains->count() }} desain dibuat</p>
                    </div>
                    <a href="{{ route('produk.pilih-kemasan', $produk->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm rounded-xl hover:bg-indigo-700 transition font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Generate Baru
                    </a>
                </div>

                @if ($produk->desains->isEmpty())
                    <div class="border border-dashed border-gray-300 rounded-xl p-12 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
                        </svg>
                        <p class="font-medium">Belum ada desain</p>
                        <p class="text-sm mt-1">Klik "Generate Baru" untuk membuat desain pertama!</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($produk->desains->sortByDesc('created_at') as $desain)
                            <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl hover:border-indigo-100 hover:bg-indigo-50/30 transition group">

                                {{-- Preview Warna --}}
                                <div class="flex rounded-lg overflow-hidden h-12 w-20 shrink-0 shadow-sm">
                                    <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_utama }}"></div>
                                    <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"></div>
                                    <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_aksen }}"></div>
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-800 text-sm">{{ $desain->jenisKemasan->nama_kemasan }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $desain->paletWarna->nama_palet }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $desain->created_at->diffForHumans() }}</p>
                                </div>

                                {{-- Status --}}
                                <span class="text-xs px-2.5 py-1 rounded-full shrink-0
                                    {{ $desain->status_desain == 'generated' ? 'bg-green-100 text-green-600' :
                                       ($desain->status_desain == 'exported' ? 'bg-blue-100 text-blue-600' :
                                       'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($desain->status_desain) }}
                                </span>

                                {{-- Aksi --}}
                                <div class="flex gap-2 shrink-0">
                                    {{-- Edit / Lihat --}}
                                    <a href="{{ route('desain.show', $desain->id) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-medium hover:bg-indigo-100 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                        </svg>
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('desain.destroy', $desain->id) }}"
                                        onsubmit="return confirm('Yakin hapus desain ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100 transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Hapus Produk --}}
            <div class="mt-6 flex justify-end">
                <form method="POST" action="{{ route('produk.destroy', $produk->id) }}"
                    onsubmit="return confirm('Yakin hapus produk ini? Semua desainnya juga akan terhapus!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-50 text-red-600 border border-red-200 rounded-xl hover:bg-red-100 text-sm font-medium transition">
                        Hapus Produk
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>