<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 px-4 py-2 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tombol Buat Kemasan Baru -->
            <div class="mb-6">
                <a href="{{ route('produk.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    + Buat produk Baru
                </a>
            </div>

            <!-- Grid Produk -->
            @if ($produks->isEmpty())
                <div class="bg-white rounded-lg shadow-sm p-12 text-center text-gray-500">
                    Belum ada produk. Klik "Buat produk Baru" untuk memulai!
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($produks as $produk)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <!-- Gambar Produk -->
                            @if ($produk->gambar_logo)
                                <img src="{{ asset('storage/' . $produk->gambar_logo) }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400 text-sm">Tidak ada gambar</span>
                                </div>
                            @endif

                            <!-- Info Produk -->
                            <div class="p-4">
                                <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">{{ $produk->kategori_produk }}</span>
                                <h3 class="font-semibold text-gray-800 mt-2">{{ $produk->nama_produk }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $produk->deskripsi_produk }}</p>

                                <!-- Tombol Aksi -->
                                <div class="flex justify-between mt-4">
                                    @if ($produk->desains->isNotEmpty())
                                        <a href="{{ route('desain.show', $produk->desains->last()->id) }}" class="text-sm text-indigo-600 hover:underline">Edit</a>
                                    @endif

                                    <form method="POST" action="{{ route('produk.destroy', $produk->id) }}" onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 hover:underline">Hapus</button>
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