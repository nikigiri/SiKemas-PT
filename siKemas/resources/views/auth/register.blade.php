<x-guest-layout>

    <div class="min-h-screen w-full bg-[#f5f7fb] flex items-center justify-center px-6 py-10">

        {{-- CARD CONTAINER --}}
        <div class="w-full max-w-7xl bg-white rounded-[40px] shadow-2xl overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[850px]">

                {{-- LEFT SIDE --}}
                <div class="hidden lg:flex relative bg-gradient-to-br from-[#1f5c38] to-[#78b067] p-14 items-center overflow-hidden">

                    {{-- DECORATION --}}
                    <div class="absolute -bottom-20 -right-20 w-72 h-72 border-[20px] border-white/20 rounded-full"></div>

                    <div class="absolute bottom-10 right-10 w-40 h-40 bg-white/10 rounded-full"></div>

                    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full"></div>

                    <div class="absolute top-20 left-28 w-3 h-3 bg-white rounded-full"></div>

                    <div class="absolute bottom-14 left-14 grid grid-cols-4 gap-2">
                        @for ($i = 0; $i < 16; $i++)
                            <div class="w-1.5 h-1.5 bg-white/60 rounded-full"></div>
                        @endfor
                    </div>

                    {{-- CONTENT --}}
                    <div class="relative z-10 text-white max-w-md">

                        <h1 class="text-6xl font-extrabold leading-tight">
                            Mulai <br>
                            Perjalanan Kemasanmu!
                        </h1>

                        <p class="mt-6 text-lg leading-relaxed text-green-50">
                            Daftarkan usaha Anda dan mulai kelola bisnis dengan sistem yang lebih modern, praktis, dan efisien.
                        </p>

                    </div>

                </div>

                {{-- RIGHT SIDE --}}
                <div class="bg-white px-8 md:px-14 py-10 flex items-center justify-center overflow-y-auto">

                    <div class="w-full max-w-lg">

                        {{-- LOGO --}}
                        <div class="flex justify-center mb-6">

                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="Logo"
                                class="w-24 h-24 object-contain"
                            >

                        </div>

                        {{-- HEADER --}}
                        <div class="text-center mb-8">

                            <h2 class="text-3xl font-bold text-gray-800">
                                Daftar Akun Baru
                            </h2>

                            <p class="text-gray-500 mt-2">
                                Lengkapi data untuk membuat akun
                            </p>

                        </div>

                        {{-- FORM --}}
                        <form method="POST"
                              action="{{ route('register.store') }}"
                              class="space-y-5">

                            @csrf

                            {{-- NAMA --}}
                            <div>

                                <x-input-label
                                    for="name"
                                    :value="__('Nama')"
                                />

                                <x-text-input
                                    id="name"
                                    class="block mt-2 w-full rounded-2xl border-0 bg-gray-100 px-5 py-3.5 focus:ring-2 focus:ring-[#2f6d46]"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required
                                    autofocus
                                    placeholder="Masukkan nama lengkap"
                                />

                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            </div>

                            {{-- EMAIL --}}
                            <div>

                                <x-input-label
                                    for="email"
                                    :value="__('Email')"
                                />

                                <x-text-input
                                    id="email"
                                    class="block mt-2 w-full rounded-2xl border-0 bg-gray-100 px-5 py-3.5 focus:ring-2 focus:ring-[#2f6d46]"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    placeholder="Masukkan email"
                                />

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            </div>

                            {{-- NO TELP --}}
                            <div>

                                <x-input-label
                                    for="no_tlp"
                                    :value="__('No. Telepon')"
                                />

                                <x-text-input
                                    id="no_tlp"
                                    class="block mt-2 w-full rounded-2xl border-0 bg-gray-100 px-5 py-3.5 focus:ring-2 focus:ring-[#2f6d46]"
                                    type="text"
                                    name="no_tlp"
                                    :value="old('no_tlp')"
                                    required
                                    placeholder="08xxxxxxxxxx"
                                />

                                <x-input-error :messages="$errors->get('no_tlp')" class="mt-2" />

                            </div>

                            {{-- PASSWORD --}}
                            <div>

                                <x-input-label
                                    for="password"
                                    :value="__('Password')"
                                />

                                <x-text-input
                                    id="password"
                                    class="block mt-2 w-full rounded-2xl border-0 bg-gray-100 px-5 py-3.5 focus:ring-2 focus:ring-[#2f6d46]"
                                    type="password"
                                    name="password"
                                    required
                                    placeholder="Masukkan password"
                                />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div>

                                <x-input-label
                                    for="password_confirmation"
                                    :value="__('Confirm Password')"
                                />

                                <x-text-input
                                    id="password_confirmation"
                                    class="block mt-2 w-full rounded-2xl border-0 bg-gray-100 px-5 py-3.5 focus:ring-2 focus:ring-[#2f6d46]"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    placeholder="Konfirmasi password"
                                />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                            </div>

                            {{-- GOOGLE --}}
                            <a href="{{ route('auth.google') ?? '#' }}"
                               class="flex items-center justify-center w-full rounded-2xl border border-gray-200 bg-white py-3.5 text-gray-700 font-medium hover:bg-gray-50 transition">

                                <svg class="w-5 h-5 me-3" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>

                                Daftar dengan Google

                            </a>

                            {{-- BUTTON --}}
                            <button
                                type="submit"
                                class="w-full bg-gradient-to-r from-[#2f6d46] to-[#7ab46a]
                                       text-white font-semibold py-3.5 rounded-2xl
                                       hover:opacity-90 transition shadow-lg shadow-green-200"
                            >

                                Lanjutkan

                            </button>

                            {{-- LOGIN --}}
                            <div class="text-center text-sm text-gray-500 pt-2">

                                Sudah punya akun?

                                <a href="{{ route('login') }}"
                                   class="text-[#2f6d46] font-semibold hover:underline">

                                    Masuk

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>