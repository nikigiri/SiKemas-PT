<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('kwt-admin.jenis-kemasan.index') }}"
                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Edit Jenis Kemasan</h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui data kemasan KWT kamu</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">

                <form method="POST" action="{{ route('kwt-admin.jenis-kemasan.update', $jenisKemasan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kemasan</label>
                            <input type="text" name="nama_kemasan" value="{{ old('nama_kemasan', $jenisKemasan->nama_kemasan) }}"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-green-400 focus:outline-none"
                                required>
                            <x-input-error :messages="$errors->get('nama_kemasan')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi_kemasan" rows="4"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-green-400 focus:outline-none resize-none">{{ old('deskripsi_kemasan', $jenisKemasan->deskripsi_kemasan) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi_kemasan')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ikon Kemasan</label>
                            @if ($jenisKemasan->ikon_kemasan)
                                <img src="{{ asset($jenisKemasan->ikon_kemasan) }}" class="w-16 h-16 object-contain mb-3 rounded-xl border border-gray-100">
                            @endif
                            <input type="file" name="ikon_kemasan" accept="image/*"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-green-400 focus:outline-none">
                            <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti ikon</p>
                            <x-input-error :messages="$errors->get('ikon_kemasan')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('kwt-admin.jenis-kemasan.index') }}"
                            class="px-6 py-3 rounded-2xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow hover:shadow-xl hover:scale-105 transition font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>