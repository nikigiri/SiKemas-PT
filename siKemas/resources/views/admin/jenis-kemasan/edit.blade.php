<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">

            <a href="{{ route('admin.jenis-kemasan.index') }}"
                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>

            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Edit Jenis Kemasan
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi kemasan produk
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Edit Data Kemasan</h3>
                        <p class="text-green-100 text-sm mt-0.5">Ubah detail jenis kemasan di bawah ini</p>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.jenis-kemasan.update', $jenisKemasan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="p-8 space-y-6">

                        <!-- Nama Kemasan -->
                        <div>
                            <label for="nama_kemasan" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Kemasan
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
                                    id="nama_kemasan"
                                    class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition"
                                    type="text"
                                    name="nama_kemasan"
                                    :value="old('nama_kemasan', $jenisKemasan->nama_kemasan)"
                                    required
                                    autofocus
                                    placeholder="Contoh: Dus, Botol, Plastik..." />
                            </div>
                            <x-input-error :messages="$errors->get('nama_kemasan')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi_kemasan" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <div class="relative">
                                <textarea
                                    id="deskripsi_kemasan"
                                    name="deskripsi_kemasan"
                                    rows="4"
                                    placeholder="Tulis deskripsi singkat tentang kemasan ini..."
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-green-400 focus:border-transparent transition resize-none text-sm text-gray-700 placeholder-gray-400">{{ old('deskripsi_kemasan', $jenisKemasan->deskripsi_kemasan) }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('deskripsi_kemasan')" class="mt-2" />
                        </div>

                        <!-- Ikon Kemasan -->
                        <div>
                            <label for="ikon_kemasan" class="block text-sm font-semibold text-gray-700 mb-2">
                                Ikon Kemasan
                            </label>

                            @if ($jenisKemasan->ikon_kemasan)
                                <div class="flex items-center gap-4 mb-4 p-4 bg-green-50 border border-green-100 rounded-2xl">
                                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow overflow-hidden flex-shrink-0">
                                        <img src="{{ asset($jenisKemasan->ikon_kemasan) }}"
                                             alt="{{ $jenisKemasan->nama_kemasan }}"
                                             class="w-10 h-10 object-contain">
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-green-700">Ikon saat ini</p>
                                        <p class="text-xs text-green-500 mt-0.5">Upload file baru untuk mengganti ikon</p>
                                    </div>
                                </div>
                            @endif

                            <label for="ikon_kemasan"
                                class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-200 rounded-2xl py-8 px-4 cursor-pointer hover:border-green-400 hover:bg-green-50 transition group">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 group-hover:bg-green-100 flex items-center justify-center mb-3 transition">
                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-green-500 transition" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-600 group-hover:text-green-600 transition">
                                    Klik untuk upload ikon
                                </p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, SVG — maks. 2MB</p>
                                <input id="ikon_kemasan" type="file" name="ikon_kemasan" accept="image/*" class="hidden" />
                            </label>

                            <x-input-error :messages="$errors->get('ikon_kemasan')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Footer Tombol -->
                    <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between rounded-b-3xl">

                        <a href="{{ route('admin.jenis-kemasan.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-200 bg-white text-gray-600 rounded-2xl hover:bg-gray-100 transition text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            Kembali
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow hover:shadow-xl hover:scale-105 transition text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>