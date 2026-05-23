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
                {{ __('Edit KWT') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-6">

                <form method="POST" action="{{ route('admin.kwt.update', $kwt->id) }}">
                    @csrf
                    @method('PATCH')

                    <!-- Nama KWT -->
                    <div>
                        <x-input-label for="nama_kwt" :value="__('Nama KWT')" />
                        <x-text-input id="nama_kwt" class="block mt-1 w-full" type="text" name="nama_kwt" :value="old('nama_kwt', $kwt->nama_kwt)" required autofocus />
                        <x-input-error :messages="$errors->get('nama_kwt')" class="mt-2" />
                    </div>

                    <!-- No KWT -->
                    <div class="mt-4">
                        <x-input-label for="no_kwt" :value="__('No KWT')" />
                        <x-text-input id="no_kwt" class="block mt-1 w-full" type="text" name="no_kwt" :value="old('no_kwt', $kwt->no_kwt)" />
                        <x-input-error :messages="$errors->get('no_kwt')" class="mt-2" />
                    </div>

                    <!-- Desa -->
                    <div class="mt-4">
                        <x-input-label for="desa" :value="__('Desa')" />
                        <x-text-input id="desa" class="block mt-1 w-full" type="text" name="desa" :value="old('desa', $kwt->desa)" />
                        <x-input-error :messages="$errors->get('desa')" class="mt-2" />
                    </div>

                    <!-- Alamat -->
                    <div class="mt-4">
                        <x-input-label for="alamat_kwt" :value="__('Alamat')" />
                        <textarea id="alamat_kwt" name="alamat_kwt" rows="3"
                                  class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat_kwt', $kwt->alamat_kwt) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat_kwt')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('admin.kwt.index') }}"
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