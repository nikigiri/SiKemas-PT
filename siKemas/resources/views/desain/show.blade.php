<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Desain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 px-4 py-2 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-6">

                <!-- Info Produk -->
                <div class="flex gap-6 mb-6 pb-6 border-b border-gray-200">
                    @if ($desain->produk->gambar_logo)
                        <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}"
                             alt="{{ $desain->produk->nama_produk }}"
                             class="w-24 h-24 object-contain rounded-lg border border-gray-200">
                    @else
                        <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 text-xs">No Logo</span>
                        </div>
                    @endif

                    <div>
                        <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">
                            {{ $desain->produk->kategori_produk }}
                        </span>
                        <h3 class="font-bold text-xl text-gray-800 mt-2">{{ $desain->produk->nama_produk }}</h3>
                        <p class="text-sm text-gray-500 italic">{{ $desain->produk->tagline }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $desain->produk->deskripsi_produk }}</p>
                    </div>
                </div>

                <!-- Detail Kemasan & Warna -->
                <div class="grid grid-cols-2 gap-6 mb-6">

                    <!-- Jenis Kemasan -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-700 mb-2">Jenis Kemasan</h4>
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($desain->jenisKemasan->ikon_kemasan) }}"
                                 alt="{{ $desain->jenisKemasan->nama_kemasan }}"
                                 class="w-12 h-12 object-contain">
                            <div>
                                <p class="font-medium text-gray-800">{{ $desain->jenisKemasan->nama_kemasan }}</p>
                                <p class="text-sm text-gray-500">{{ $desain->jenisKemasan->deskripsi_kemasan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Palet Warna -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-700 mb-2">Palet Warna</h4>
                        <p class="text-sm text-gray-600 mb-2">{{ $desain->paletWarna->nama_palet }}</p>
                        <div class="flex rounded-md overflow-hidden h-10 shadow-sm">
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_utama }}"
                                 title="Utama: {{ $desain->paletWarna->warna_utama }}"></div>
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"
                                 title="Sekunder: {{ $desain->paletWarna->warna_sekunder }}"></div>
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_aksen }}"
                                 title="Aksen: {{ $desain->paletWarna->warna_aksen }}"></div>
                        </div>
                        <div class="flex gap-2 mt-1 text-xs text-gray-500">
                            <span>{{ $desain->paletWarna->warna_utama }}</span>
                            <span>{{ $desain->paletWarna->warna_sekunder }}</span>
                            <span>{{ $desain->paletWarna->warna_aksen }}</span>
                        </div>
                    </div>
                </div>

                <!-- Hasil AI (placeholder dulu) -->
                <div class="border border-gray-200 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-gray-700 mb-2">✨ Rekomendasi Desain AI</h4>
                    @if ($desain->teks_ai)
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $desain->teks_ai }}</p>
                    @else
                        <p class="text-sm text-gray-400 italic">Belum ada hasil generate AI. Fitur ini akan segera tersedia.</p>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between">
                    <a href="{{ route('produk.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        ← Kembali ke Produk
                    </a>

                    <form method="POST" action="{{ route('desain.destroy', $desain->id) }}"
                          onsubmit="return confirm('Yakin hapus desain ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Hapus Desain
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>