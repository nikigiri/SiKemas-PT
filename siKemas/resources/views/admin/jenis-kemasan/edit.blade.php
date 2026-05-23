<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}"
            class="text-gray-500 hover:text-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Jenis Kemasan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-6">

                <form method="POST" action="{{ route('admin.jenis-kemasan.update', $jenisKemasan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Nama Kemasan -->
                    <div>
                        <x-input-label for="nama_kemasan" :value="__('Nama Kemasan')" />
                        <x-text-input id="nama_kemasan" class="block mt-1 w-full" type="text" name="nama_kemasan" :value="old('nama_kemasan', $jenisKemasan->nama_kemasan)" required autofocus />
                        <x-input-error :messages="$errors->get('nama_kemasan')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-4">
                        <x-input-label for="deskripsi_kemasan" :value="__('Deskripsi')" />
                        <textarea id="deskripsi_kemasan" name="deskripsi_kemasan" rows="3"
                                  class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('deskripsi_kemasan', $jenisKemasan->deskripsi_kemasan) }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi_kemasan')" class="mt-2" />
                    </div>

                    <!-- Ikon -->
                    <div class="mt-4">
                        <x-input-label for="ikon_kemasan" :value="__('Ikon Kemasan')" />
                        @if ($jenisKemasan->ikon_kemasan)
                            <img src="{{ asset($jenisKemasan->ikon_kemasan) }}"
                                 alt="{{ $jenisKemasan->nama_kemasan }}"
                                 class="w-16 h-16 object-contain mb-2">
                        @endif
                        <input id="ikon_kemasan" type="file" name="ikon_kemasan" accept="image/*"
                               class="block mt-1 w-full text-sm text-gray-500" />
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti ikon</p>
                        <x-input-error :messages="$errors->get('ikon_kemasan')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('admin.jenis-kemasan.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            ← Kembali
                        </a>
                        <x-primary-button>
                            Simpan Perubahan
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>