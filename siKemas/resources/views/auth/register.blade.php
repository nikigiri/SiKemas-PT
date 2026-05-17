<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Nama Pemilik')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="nama_usaha" :value="__('Nama Usaha')" />
            <x-text-input id="nama_usaha" class="block mt-1 w-full" type="text" name="nama_usaha" :value="old('nama_usaha')" required />
            <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="no_tlp" :value="__('No. Telepon')" />
            <x-text-input id="no_tlp" class="block mt-1 w-full" type="text" name="no_tlp" :value="old('no_tlp')" required />
            <x-input-error :messages="$errors->get('no_tlp')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="alamat_usaha" :value="__('Alamat Usaha')" />
            <textarea id="alamat_usaha" name="alamat_usaha" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="3" required>{{ old('alamat_usaha') }}</textarea>
            <x-input-error :messages="$errors->get('alamat_usaha')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <div class="mt-4 text-center text-sm text-gray-600">
            {{ __('Already registered?') }}
            <a href="{{ route('login') }}" class="underline text-indigo-600 hover:text-indigo-900">
                {{ __('Login') }}
            </a>
        </div>
        <div class="flex items-center my-4">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="mx-4 text-sm text-gray-500">atau</span>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>
        <a href="{{ route('auth.google') }}" class="flex items-center justify-center w-full border border-gray-300 rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
            <svg class="w-5 h-5 me-2" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Daftar dengan Google
        </a>
    </form>
</x-guest-layout>