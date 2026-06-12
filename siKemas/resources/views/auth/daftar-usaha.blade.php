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
                                Daftar Usaha Anda!
                            </h2>

                            <p class="text-gray-500 mt-2">
                                Lengkapi data untuk membuat akun
                            </p>

                        </div>

                        {{-- FORM --}}
                        <form method="POST" action="{{ route('register.business.store') }}" class="space-y-5">
                            @csrf
                            {{-- NAMA USAHA --}}
                            <div>
                                <x-input-label for="nama_usaha" :value="__('Nama Usaha')"/>
                                <x-text-input
                                    id="nama_usaha"
                                    class="block mt-2 w-full rounded-2xl border-0 bg-gray-100 px-5 py-3.5 focus:ring-2 focus:ring-[#2f6d46]"
                                    type="text"
                                    name="nama_usaha"
                                    :value="old('nama_usaha')"
                                    required
                                    placeholder="Masukkan nama usaha"
                                />

                                <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />

                            </div>
                            <div class="mt-4">
                                <x-input-label for="kwt_id" :value="__('KWT')" />
                                <select id="kwt_id" name="kwt_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Pilih KWT</option>
                                    @foreach ($kwts as $kwt)
                                        <option value="{{ $kwt->id }}" {{ old('kwt_id') == $kwt->id ? 'selected' : '' }}>
                                            {{ $kwt->nama_kwt }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kwt_id')" class="mt-2" />
                            </div>

                            {{-- ALAMAT --}}
                            <div>

                                <x-input-label
                                    for="alamat_usaha"
                                    :value="__('Alamat Usaha')"
                                />

                                <textarea
                                    id="alamat_usaha"
                                    name="alamat_usaha"
                                    rows="3"
                                    required
                                    placeholder="Masukkan alamat usaha"
                                    class="block mt-2 w-full rounded-2xl border-0 bg-gray-100 px-5 py-3.5 focus:ring-2 focus:ring-[#2f6d46]"
                                >{{ old('alamat_usaha') }}</textarea>

                                <x-input-error :messages="$errors->get('alamat_usaha')" class="mt-2" />

                            </div>

                            {{-- BUTTON --}}
                            <button
                                type="submit"
                                class="w-full bg-gradient-to-r from-[#2f6d46] to-[#7ab46a]
                                       text-white font-semibold py-3.5 rounded-2xl
                                       hover:opacity-90 transition shadow-lg shadow-green-200"
                            >

                                Daftar

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