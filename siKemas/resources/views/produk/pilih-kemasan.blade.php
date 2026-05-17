<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilihan Kemasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="text-gray-500 mb-6">Pilih jenis wadah dan palet warna yang diinginkan</p>

                <form method="POST" action="{{ route('desain.store') }}">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                    <!-- Pilih Jenis Kemasan -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-4">Jenis Kemasan</h3>
                        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                            @foreach ($jenisKemasans as $kemasan)
                                <label class="cursor-pointer">
                                    <input type="radio" name="jenis_kemasan_id" value="{{ $kemasan->id }}" class="hidden peer" required>
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:border-indigo-300">
                                        <img src="{{ asset($kemasan->ikon_kemasan) }}" alt="{{ $kemasan->nama_kemasan }}" class="w-16 h-16 object-contain mx-auto mb-2">
                                        <p class="text-xs font-medium text-gray-700">{{ strtoupper($kemasan->nama_kemasan) }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('jenis_kemasan_id')" class="mt-2" />
                    </div>

                    <!-- Pilih Palet Warna -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-4">Palet Warna Brand</h3>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex flex-wrap gap-3">
                                @foreach ($paletWarnas as $palet)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="palet_warna_id" value="{{ $palet->id }}" class="hidden peer" required>
                                        <div class="peer-checked:ring-2 peer-checked:ring-indigo-500 rounded-lg p-1">
                                            <div class="flex rounded-md overflow-hidden w-20 h-10 shadow-sm" title="{{ $palet->nama_palet }}">
                                                <div class="flex-1" style="background-color: {{ $palet->warna_utama }}"></div>
                                                <div class="flex-1" style="background-color: {{ $palet->warna_sekunder }}"></div>
                                                <div class="flex-1" style="background-color: {{ $palet->warna_aksen }}"></div>
                                            </div>
                                            <p class="text-xs text-center mt-1 text-gray-600">{{ $palet->nama_palet }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('palet_warna_id')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('produk.create') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            ← Kembali
                        </a>
                        <x-primary-button>
                            ✨ Generate dengan AI
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>