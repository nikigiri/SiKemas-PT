<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-6">

                <div class="flex gap-6 mb-6 pb-6 border-b border-gray-200">
                    @if ($produk->gambar_logo)
                        <img src="{{ asset('storage/' . $produk->gambar_logo) }}"
                             alt="{{ $produk->nama_produk }}"
                             class="w-32 h-32 object-contain rounded-lg border border-gray-200">
                    @else
                        <div class="w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 text-sm">No Logo</span>
                        </div>
                    @endif

                    <div class="flex-1">
                        <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">
                            {{ $produk->kategori_produk }}
                        </span>
                        <h3 class="font-bold text-2xl text-gray-800 mt-2">{{ $produk->nama_produk }}</h3>
                        @if ($produk->tagline)
                            <p class="text-sm text-gray-500 italic mt-1">"{{ $produk->tagline }}"</p>
                        @endif
                        @if ($produk->deskripsi_produk)
                            <p class="text-sm text-gray-600 mt-2">{{ $produk->deskripsi_produk }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-2">
                            Dibuat {{ $produk->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <div>
                        <a href="{{ route('produk.edit', $produk->id) }}"
                           class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 text-sm">
                            Edit Produk
                        </a>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-semibold text-gray-700">Desain Kemasan</h4>
                        <a href="{{ route('produk.pilih-kemasan', $produk->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">
                            + Generate Desain Baru
                        </a>
                    </div>

                    @if ($produk->desains->isEmpty())
                        <div class="border border-dashed border-gray-300 rounded-lg p-8 text-center text-gray-400">
                            Belum ada desain untuk produk ini. Klik "Generate Desain Baru" untuk mulai!
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($produk->desains as $desain)
                                <a href="{{ route('desain.show', $desain->id) }}"
                                   class="block border border-gray-200 rounded-lg p-4 hover:border-indigo-400 hover:shadow-sm transition">
                                    <div class="flex rounded overflow-hidden h-4 mb-3">
                                        <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_utama }}"></div>
                                        <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"></div>
                                        <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_aksen }}"></div>
                                    </div>

                                    <p class="font-medium text-gray-800 text-sm">{{ $desain->jenisKemasan->nama_kemasan }}</p>
                                    <p class="text-xs text-gray-500">{{ $desain->paletWarna->nama_palet }}</p>

                                    <span class="mt-2 inline-block text-xs px-2 py-1 rounded-full
                                        {{ $desain->status_desain == 'generated' ? 'bg-green-100 text-green-600' :
                                           ($desain->status_desain == 'exported' ? 'bg-blue-100 text-blue-600' :
                                           'bg-gray-100 text-gray-600') }}">
                                        {{ ucfirst($desain->status_desain) }}
                                    </span>

                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $desain->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="flex justify-between mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('produk.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        &larr; Kembali
                    </a>

                    <form method="POST" action="{{ route('produk.destroy', $produk->id) }}"
                          onsubmit="return confirm('Yakin hapus produk ini? Semua desainnya juga akan terhapus!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Hapus Produk
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>