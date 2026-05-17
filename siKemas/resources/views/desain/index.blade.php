<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Desain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 px-4 py-2 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if ($desains->isEmpty())
                <div class="bg-white rounded-lg shadow-sm p-12 text-center text-gray-500">
                    Belum ada desain. Buat produk dulu lalu generate desainnya!
                    <div class="mt-4">
                        <a href="{{ route('produk.create') }}"
                           class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            + Buat Kemasan Baru
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($desains as $desain)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                            <!-- Preview / Logo -->
                            @if ($desain->produk->gambar_logo)
                                <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}"
                                     alt="{{ $desain->judul_desain }}"
                                     class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 flex items-center justify-center"
                                     style="background-color: {{ $desain->paletWarna->warna_utama }}">
                                    <span class="text-white font-bold text-lg">{{ $desain->judul_desain }}</span>
                                </div>
                            @endif

                            <div class="p-4">
                                <!-- Status -->
                                <span class="text-xs px-2 py-1 rounded-full
                                    {{ $desain->status_desain == 'generated' ? 'bg-green-100 text-green-600' :
                                       ($desain->status_desain == 'exported' ? 'bg-blue-100 text-blue-600' :
                                       'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($desain->status_desain) }}
                                </span>

                                <h3 class="font-semibold text-gray-800 mt-2">{{ $desain->judul_desain }}</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $desain->jenisKemasan->nama_kemasan }} ·
                                    {{ $desain->paletWarna->nama_palet }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $desain->created_at->diffForHumans() }}
                                </p>

                                <!-- Palet Warna Mini -->
                                <div class="flex rounded overflow-hidden h-3 mt-2">
                                    <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_utama }}"></div>
                                    <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"></div>
                                    <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_aksen }}"></div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex justify-between mt-4">
                                    <a href="{{ route('desain.show', $desain->id) }}"
                                       class="text-sm text-indigo-600 hover:underline">
                                        Lihat Detail
                                    </a>
                                    <form method="POST" action="{{ route('desain.destroy', $desain->id) }}"
                                          onsubmit="return confirm('Yakin hapus desain ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 hover:underline">
                                            Hapus
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