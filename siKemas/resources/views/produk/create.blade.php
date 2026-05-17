<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Info Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="flex gap-6">
                        <!-- Kiri: Form -->
                        <div class="flex-1 space-y-4">

                            <!-- Nama Produk -->
                            <div>
                                <x-input-label for="nama_produk" :value="__('Nama Produk')" />
                                <x-text-input id="nama_produk" class="block mt-1 w-full" type="text" name="nama_produk" :value="old('nama_produk')" placeholder="Contoh: Kopi Gayo Premium" required />
                                <x-input-error :messages="$errors->get('nama_produk')" class="mt-2" />
                            </div>

                            <!-- Tagline -->
                            <div>
                                <x-input-label for="tagline" :value="__('Tagline / Slogan')" />
                                <x-text-input id="tagline" class="block mt-1 w-full" type="text" name="tagline" :value="old('tagline')" placeholder="Contoh: Cita Rasa Asli Tanah Gayo" />
                                <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                            </div>

                            <!-- Deskripsi Produk -->
                            <div>
                                <x-input-label for="deskripsi_produk" :value="__('Deskripsi Produk')" />
                                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="Jelaskan keunggulan produk Anda...">{{ old('deskripsi_produk') }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi_produk')" class="mt-2" />
                            </div>

                            <!-- Kategori Produk -->
                            <div>
                                <x-input-label for="kategori_produk" :value="__('Kategori Produk')" />
                                <select id="kategori_produk" name="kategori_produk" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Makanan & Minuman" {{ old('kategori_produk') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                    <option value="Kesehatan & Kecantikan" {{ old('kategori_produk') == 'Kesehatan & Kecantikan' ? 'selected' : '' }}>Kesehatan & Kecantikan</option>
                                    <option value="Fashion & Aksesoris" {{ old('kategori_produk') == 'Fashion & Aksesoris' ? 'selected' : '' }}>Fashion & Aksesoris</option>
                                    <option value="Elektronik" {{ old('kategori_produk') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option value="Lainnya" {{ old('kategori_produk') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <x-input-error :messages="$errors->get('kategori_produk')" class="mt-2" />
                            </div>

                        </div>

                        <!-- Kanan: Upload Logo -->
                        <div class="w-64">
                            <x-input-label :value="__('Logo / Gambar Produk')" />
                            <div class="mt-1 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-indigo-400" onclick="document.getElementById('gambar_logo').click()">
                                <img id="preview" src="#" alt="Preview" class="hidden mx-auto mb-2 max-h-32 object-contain">
                                <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">Klik untuk Unggah</p>
                                <p class="text-xs text-gray-400">PNG, JPG atau SVG (Maks. 5MB)</p>
                                <input id="gambar_logo" type="file" name="gambar_logo" class="hidden" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <x-input-error :messages="$errors->get('gambar_logo')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('produk.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>
                        <x-primary-button>
                            Lanjutkan →
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const icon = document.getElementById('upload-icon');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.classList.remove('hidden');
            icon.classList.add('hidden');
        }
    </script>
</x-app-layout>