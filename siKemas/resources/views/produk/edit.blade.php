<x-app-layout>
    <div class="min-h-screen bg-[#fafafa] py-8 px-4 sm:px-6 lg:px-8">
        {{-- max-w-6xl agar layout lebih lebar dan elemen otomatis lebih ke kiri --}}
        <div class="max-w-6xl mx-auto">

            {{-- Header --}}
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('produk.index') }}" 
                   class="flex items-center justify-center w-10 h-10 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition shadow-sm group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Info Produk</h1>
            </div>

            {{-- Card Form Utama --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="p-6 sm:p-8">
                    
                    {{-- Form Update (Diberi ID 'formUpdate' agar tombol di luar form bisa memanggilnya) --}}
                    <form id="formUpdate" method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="flex flex-col md:flex-row gap-8">
                            {{-- Kiri: Form Input --}}
                            <div class="flex-1 space-y-5">
                                
                                <div>
                                    <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                                    <input id="nama_produk" type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required
                                           class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200" />
                                    <x-input-error :messages="$errors->get('nama_produk')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="tagline" class="block text-sm font-semibold text-gray-700 mb-1.5">Tagline / Slogan</label>
                                    <input id="tagline" type="text" name="tagline" value="{{ old('tagline', $produk->tagline) }}"
                                           class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200" />
                                    <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="deskripsi_produk" class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Produk</label>
                                    <textarea id="deskripsi_produk" name="deskripsi_produk" rows="4"
                                              class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-800 focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 resize-none">{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
                                    <x-input-error :messages="$errors->get('deskripsi_produk')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="kategori_produk" class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori Produk <span class="text-red-500">*</span></label>
                                    <select id="kategori_produk" name="kategori_produk" required
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200">
                                        <option value="">Pilih Kategori</option>
                                        
                                        {{-- Looping data kategori dari Admin --}}
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->nama_kategori }}" 
                                                {{ old('kategori_produk', $produk->kategori_produk) == $kategori->nama_kategori ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                        
                                    </select>
                                    <x-input-error :messages="$errors->get('kategori_produk')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Kanan: Upload Logo --}}
                            <div class="w-full md:w-72 shrink-0">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Logo Produk</label>
                                <div class="mt-1 border border-dashed border-gray-300 bg-[#FFFaf0] rounded-2xl p-6 text-center cursor-pointer hover:border-green-500 transition-all duration-200 group relative overflow-hidden" 
                                     onclick="document.getElementById('gambar_logo').click()">
                                    
                                    @if ($produk->gambar_logo)
                                        <img id="preview" src="{{ asset('storage/' . $produk->gambar_logo) }}" alt="Preview" class="mx-auto h-36 w-full object-contain rounded-lg">
                                        <div class="absolute inset-0 bg-black/40 hidden group-hover:flex items-center justify-center transition-all">
                                            <span class="text-white text-xs font-bold px-3 py-1.5 border border-white rounded-full">Ganti Gambar</span>
                                        </div>
                                    @else
                                        <img id="preview" src="#" alt="Preview" class="hidden mx-auto h-36 w-full object-contain rounded-lg">
                                        <div id="upload-placeholder" class="py-6">
                                            <svg class="mx-auto h-12 w-12 text-green-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-sm font-bold text-gray-700">Upload Logo</p>
                                            <p class="text-[10px] text-gray-400 mt-1">PNG, JPG (Maks. 5MB)</p>
                                        </div>
                                    @endif
                                    
                                    <input id="gambar_logo" type="file" name="gambar_logo" class="hidden" accept="image/*" onchange="previewImage(event)">
                                </div>
                                <x-input-error :messages="$errors->get('gambar_logo')" class="mt-2" />
                            </div>
                        </div>
                    </form> 

                    {{-- Footer: Area Tombol Berjejer --}}
                    <div class="flex justify-end items-center gap-3 mt-10 pt-6 border-t border-gray-100">
                        
                        {{-- Tombol Hapus (Secondary Action - Merah Outline) --}}
                        <form method="POST" action="{{ route('produk.destroy', $produk->id) }}"
                              onsubmit="return confirm('Apakah kamu yakin ingin menghapus produk ini? Semua data dan desain terkait akan hilang permanen.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-full border border-red-200 bg-white text-red-600 text-sm font-semibold hover:bg-red-50 hover:border-red-300 active:scale-95 transition duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>

                        {{-- Tombol Simpan (Primary Action - Hijau Solid, memanggil formUpdate) --}}
                        <button type="submit" form="formUpdate"
                                class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-full bg-[#108A56] text-white text-sm font-semibold hover:bg-[#0c6b43] active:scale-95 transition duration-200 shadow-sm shadow-green-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                        
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('upload-placeholder');
            
            if(event.target.files.length > 0) {
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>