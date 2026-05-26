<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- Left -->
            <div class="flex items-center gap-3">

                <a href="{{ route('admin.dashboard') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">

                    <svg class="w-5 h-5 text-gray-600"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>

                </a>

                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        Create Admin 👨‍💼
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

                    <form method="POST"
                        action="{{ route('admin.user.store-admin') }}"
                        class="space-y-6">

                        @csrf

                        <!-- Nama -->
                        <div>

                            <x-input-label for="name"
                                :value="__('Nama Admin')"
                                class="text-gray-700 font-semibold mb-2" />

                            <div class="relative">

                                <span
                                    class="absolute left-4 top-3.5 text-gray-400 text-lg">
                                    👤
                                </span>

                                <x-text-input id="name"
                                    class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required
                                    autofocus
                                    placeholder="Masukkan nama admin" />

                            </div>

                            <x-input-error :messages="$errors->get('name')"
                                class="mt-2" />

                        </div>

                        <!-- Email -->
                        <div>

                            <x-input-label for="email"
                                :value="__('Email')"
                                class="text-gray-700 font-semibold mb-2" />

                            <div class="relative">

                                <span
                                    class="absolute left-4 top-3.5 text-gray-400 text-lg">
                                    📧
                                </span>

                                <x-text-input id="email"
                                    class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    placeholder="Masukkan email admin" />

                            </div>

                            <x-input-error :messages="$errors->get('email')"
                                class="mt-2" />

                        </div>

                        <!-- Password -->
                        <div>

                            <x-input-label for="password"
                                :value="__('Password')"
                                class="text-gray-700 font-semibold mb-2" />

                            <div class="relative">

                                <span
                                    class="absolute left-4 top-3.5 text-gray-400 text-lg">
                                    🔒
                                </span>

                                <x-text-input id="password"
                                    class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="password"
                                    name="password"
                                    required
                                    placeholder="Masukkan password" />

                            </div>

                            <x-input-error :messages="$errors->get('password')"
                                class="mt-2" />

                        </div>

                        <!-- Confirm Password -->
                        <div>

                            <x-input-label for="password_confirmation"
                                :value="__('Konfirmasi Password')"
                                class="text-gray-700 font-semibold mb-2" />

                            <div class="relative">

                                <span
                                    class="absolute left-4 top-3.5 text-gray-400 text-lg">
                                    🔐
                                </span>

                                <x-text-input id="password_confirmation"
                                    class="block w-full pl-12 py-3 rounded-2xl border-gray-200 focus:border-green-400 focus:ring-green-400"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    placeholder="Ulangi password" />

                            </div>

                        </div>

                        <!-- Buttons -->
                        <div
                            class="flex flex-col sm:flex-row gap-3 justify-end pt-4">

                            <!-- Back -->
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-6 py-3 rounded-2xl border border-gray-200 text-gray-700 hover:bg-gray-100 transition text-center font-medium">

                                ← Kembali
                            </a>

                            <!-- Submit -->
                            <button type="submit"
                                class="px-6 py-3 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold shadow-lg hover:shadow-2xl hover:scale-[1.02] transition">

                                + Tambah Admin
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>