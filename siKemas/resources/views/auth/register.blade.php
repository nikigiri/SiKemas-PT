<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama Pemilik -->
        <div>
            <x-input-label for="name" :value="__('Nama Pemilik')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Nama Usaha -->
        <div class="mt-4">
            <x-input-label for="nama_usaha" :value="__('Nama Usaha')" />
            <x-text-input id="nama_usaha" class="block mt-1 w-full" type="text" name="nama_usaha" :value="old('nama_usaha')" required />
            <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>