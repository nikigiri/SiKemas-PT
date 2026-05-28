<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">

            <a href="{{ route('admin.kategori.index') }}"
                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>

            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Tambah Kategori
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan kategori produk baru ke sistem
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Tambah Kategori Baru</h3>
                        <p class="text-green-100 text-sm mt-0.5">Isi detail kategori produk di bawah ini</p>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.kategori.store') }}">
                    @csrf

                    <div class="p-8 space-y-6">

                        <!-- Nama Kategori -->
                        <div>
                            <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Kategori
                                <span class="text-red-500 ml-0.5">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                </div>
                                <x-text-input
                                    id="nama_kategori"
                                    class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition"
                                    type="text"
                                    name="nama_kategori"
                                    :value="old('nama_kategori')"
                                    required
                                    autofocus
                                    placeholder="Contoh: Sayuran, Buah, Olahan..." />
                            </div>
                            <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="4"
                                placeholder="Tulis deskripsi singkat tentang kategori ini..."
                                class="block w-full px-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition resize-none text-sm text-gray-700 placeholder-gray-400">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Footer Tombol -->
                    <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between rounded-b-3xl">

                        <a href="{{ route('admin.kategori.index') }}"
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
                            Simpan Kategori
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>