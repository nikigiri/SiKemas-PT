<x-guest-layout>
    <form method="POST" action="{{ route('complete.profile.store') }}">
        @csrf

        <div class="mb-4 text-sm text-gray-600">
            Lengkapi data usaha kamu sebelum melanjutkan.
        </div>

        <!-- Nama Usaha -->
        <div>
            <x-input-label for="nama_usaha" :value="__('Nama Usaha')" />
            <x-text-input id="nama_usaha" class="block mt-1 w-full" type="text" name="nama_usaha" :value="old('nama_usaha')" required autofocus />
            <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
        </div>

        <!-- No. Telepon -->
        <div class="mt-4">
            <x-input-label for="no_tlp" :value="__('No. Telepon')" />
            <x-text-input id="no_tlp" class="block mt-1 w-full" type="text" name="no_tlp" :value="old('no_tlp')" required />
            <x-input-error :messages="$errors->get('no_tlp')" class="mt-2" />
        </div>

        <!-- Alamat Usaha -->
        <div class="mt-4">
            <x-input-label for="alamat_usaha" :value="__('Alamat Usaha')" />
            <textarea id="alamat_usaha" name="alamat_usaha" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="3" required>{{ old('alamat_usaha') }}</textarea>
            <x-input-error :messages="$errors->get('alamat_usaha')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Simpan & Lanjutkan') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>