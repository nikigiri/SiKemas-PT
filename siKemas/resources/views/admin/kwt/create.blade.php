<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">

            <a href="{{ route('admin.kwt.index') }}"
                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>

            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Tambah KWT
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Daftarkan Kelompok Wanita Tani baru ke sistem
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                <!-- Card Header -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center shadow-inner">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Tambah KWT Baru</h3>
                        <p class="text-green-100 text-sm mt-0.5">Isi informasi kelompok wanita tani di bawah ini</p>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.kwt.store') }}">
                    @csrf

                    <div class="p-8 space-y-6">

                        <!-- Nama KWT -->
                        <div>
                            <label for="nama_kwt" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama KWT
                                <span class="text-red-500 ml-0.5">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                </div>
                                <x-text-input
                                    id="nama_kwt"
                                    class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition"
                                    type="text"
                                    name="nama_kwt"
                                    :value="old('nama_kwt')"
                                    required
                                    autofocus
                                    placeholder="Contoh: KWT Melati, KWT Seruni..." />
                            </div>
                            <x-input-error :messages="$errors->get('nama_kwt')" class="mt-2" />
                        </div>

                        <!-- No KWT -->
                        <div>
                            <label for="no_kwt" class="block text-sm font-semibold text-gray-700 mb-2">
                                No KWT
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                                    </svg>
                                </div>
                                <x-text-input
                                    id="no_kwt"
                                    class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition"
                                    type="text"
                                    name="no_kwt"
                                    :value="old('no_kwt')"
                                    placeholder="Contoh: 001/KWT/2024" />
                            </div>
                            <x-input-error :messages="$errors->get('no_kwt')" class="mt-2" />
                        </div>

                        <!-- Desa -->
                        <div>
                            <label for="desa" class="block text-sm font-semibold text-gray-700 mb-2">
                                Desa
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <x-text-input
                                    id="desa"
                                    class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition"
                                    type="text"
                                    name="desa"
                                    :value="old('desa')"
                                    placeholder="Nama desa..." />
                            </div>
                            <x-input-error :messages="$errors->get('desa')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat_kwt" class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat
                            </label>
                            <textarea
                                id="alamat_kwt"
                                name="alamat_kwt"
                                rows="4"
                                placeholder="Tulis alamat lengkap KWT..."
                                class="block w-full px-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition resize-none text-sm text-gray-700 placeholder-gray-400">{{ old('alamat_kwt') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_kwt')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Footer Tombol -->
                    <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between rounded-b-3xl">

                        <a href="{{ route('admin.kwt.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-200 bg-white text-gray-600 rounded-2xl hover:bg-gray-100 transition text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            Kembali
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow hover:shadow-xl hover:scale-105 transition text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Simpan KWT
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>