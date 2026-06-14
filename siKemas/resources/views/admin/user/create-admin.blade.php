<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- Left -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>

                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        Create Admin 
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Tambahkan akun admin baru ke sistem
                    </p>
                </div>

            </div>

        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Card -->
            <div
                class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                <!-- Top -->
                <div
                    class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-8 text-white">

                    <h3 class="text-3xl font-bold">
                        Tambah Admin Baru
                    </h3>

                    <p class="text-green-100 mt-2 text-sm">
                        Isi data admin dengan lengkap dan benar
                    </p>

                </div>

                <!-- Form -->
                <div class="p-8">
                   <form method="POST" action="{{ route('admin.user.store-admin') }}" class="space-y-6">
                        @csrf
                        <!-- Nama -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Admin')" class="text-gray-700 font-semibold mb-2" />
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </span>
                                <x-text-input id="name" class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="text" name="name" :value="old('name')" required autofocus placeholder="Masukkan nama admin" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold mb-2" />
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                </span>
                                <x-text-input id="email" class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="email" name="email" :value="old('email')" required placeholder="Masukkan email admin" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- No. Telepon -->
                        <div>
                            <x-input-label for="no_tlp" :value="__('No. Telepon')" class="text-gray-700 font-semibold mb-2" />
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                </span>
                                <x-text-input id="no_tlp" class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="text" name="no_tlp" :value="old('no_tlp')" required placeholder="Masukkan no. telepon" />
                            </div>
                            <x-input-error :messages="$errors->get('no_tlp')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div>
                            <x-input-label for="alamat_usaha" :value="__('Alamat')" class="text-gray-700 font-semibold mb-2" />
                            <textarea id="alamat_usaha" name="alamat_usaha" rows="2"
                                class="block w-full px-4 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400 border"
                                placeholder="Masukkan alamat">{{ old('alamat_usaha') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_usaha')" class="mt-2" />
                        </div>

                        <!-- KWT -->
                        <div>
                            <x-input-label for="kwt_id" :value="__('KWT yang Dikelola')" class="text-gray-700 font-semibold mb-2" />
                            <select id="kwt_id" name="kwt_id"
                                class="block w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-green-400 focus:ring-green-400" required>
                                <option value=""> Pilih KWT</option>
                                @foreach ($kwts as $kwt)
                                    <option value="{{ $kwt->id }}" {{ old('kwt_id') == $kwt->id ? 'selected' : '' }}>
                                        {{ $kwt->nama_kwt }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kwt_id')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold mb-2" />
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </span>
                                <x-text-input id="password" class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="password" name="password" required placeholder="Masukkan password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold mb-2" />
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                    </svg>
                                </span>
                                <x-text-input id="password_confirmation" class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="password" name="password_confirmation" required placeholder="Ulangi password" />
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl border border-gray-200 text-gray-700 hover:bg-gray-100 transition text-center font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                                Kembali
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold shadow-lg hover:shadow-2xl hover:scale-[1.02] transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                Tambah Admin
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>