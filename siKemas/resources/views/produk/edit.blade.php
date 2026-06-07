<x-app-layout>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
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
<<<<<<< HEAD
=======
=======

    <div class="min-h-screen bg-[#f5f4fb] py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD --}}
            <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8 lg:p-10">

                {{-- HEADER --}}
                <div class="flex items-start gap-5 mb-10">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2d8722" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/><path d="M10 12h4"/></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Produk</h1>
                        <p class="text-gray-500 mt-1">Perbarui informasi produk kamu</p>
                    </div>
                </div>

                {{-- FORM --}}
                <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                        {{-- LEFT --}}
                        <div class="lg:col-span-2 space-y-6">

                            {{-- NAMA PRODUK --}}
                            <div>
                                <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-3">Nama Produk</label>
                                <input id="nama_produk" type="text" name="nama_produk"
                                    value="{{ old('nama_produk', $produk->nama_produk) }}"
                                    placeholder="Contoh: Kopi Gayo Premium" required
                                    class="w-full h-14 px-5 rounded-2xl border-0 bg-[#f3f7f7] text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-green-500">
                                <x-input-error :messages="$errors->get('nama_produk')" class="mt-2" />
                            </div>

                            {{-- TAGLINE --}}
                            <div>
                                <label for="tagline" class="block text-sm font-semibold text-gray-700 mb-3">Tagline / Slogan</label>
                                <input id="tagline" type="text" name="tagline"
                                    value="{{ old('tagline', $produk->tagline) }}"
                                    placeholder="Contoh: Cita Rasa Asli Tanah Gayo"
                                    class="w-full h-14 px-5 rounded-2xl border-0 bg-[#f3f7f7] text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-green-500">
                                <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                            </div>

                            {{-- DESKRIPSI --}}
                            <div>
                                <label for="deskripsi_produk" class="block text-sm font-semibold text-gray-700 mb-3">Deskripsi Produk</label>
                                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="6"
                                    placeholder="Jelaskan keunggulan produk Anda..."
                                    class="w-full px-5 py-4 rounded-2xl border-0 bg-[#f3f7f7] text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-green-500 resize-none">{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi_produk')" class="mt-2" />
                            </div>

                            {{-- KATEGORI --}}
                            <div>
                                <label for="kategori_produk" class="block text-sm font-semibold text-gray-700 mb-3">Kategori Produk</label>

                                <div class="relative" x-data="{ open: false, selectedName: '{{ old('kategori_produk') ? '' : $produk->kategori_produk }}', selectedValue: '{{ old('kategori_produk', $produk->kategori_produk) }}' }">

                                    <input type="hidden" name="kategori_produk" :value="selectedValue" required>

                                    <button type="button" @click="open = !open"
                                        class="w-full h-14 px-5 rounded-2xl bg-[#f3f7f7] text-gray-800 text-left flex items-center justify-between border-0 focus:ring-2 focus:ring-green-500 outline-none">
                                        <span x-text="selectedName || 'Pilih Kategori'"></span>
                                        <svg class="w-5 h-5 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>

                                    <div x-show="open" @click.away="open = false"
                                         class="absolute z-10 w-full mt-2 bg-white border border-gray-100 rounded-2xl shadow-xl max-h-60 overflow-y-auto p-2"
                                         x-transition>
                                        @foreach ($kategoris as $kategori)
                                            <div @click="selectedValue = '{{ $kategori->nama_kategori }}'; selectedName = '{{ $kategori->nama_kategori }}'; open = false"
                                                 class="px-5 py-3 rounded-xl cursor-pointer text-gray-800 hover:bg-green-600 hover:text-white transition duration-150">
                                                {{ $kategori->nama_kategori }}
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                                <x-input-error :messages="$errors->get('kategori_produk')" class="mt-2" />
                            </div>

                        </div>

                        {{-- RIGHT UPLOAD --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Logo / Gambar Produk</label>

                            <div onclick="document.getElementById('gambar_logo').click()"
                                class="relative h-[345px] border-2 border-dashed border-green-100 rounded-[28px] bg-[#B6E9BF] bg-opacity-30 hover:border-green-400 transition duration-200 cursor-pointer flex flex-col items-center justify-center text-center p-6">

                                @if ($produk->gambar_logo)
                                    <img id="preview"
                                         src="{{ asset('storage/' . $produk->gambar_logo) }}"
                                         class="absolute inset-0 w-full h-full object-cover rounded-[28px]"
                                         alt="Preview">
                                    <div id="upload-content" class="hidden">
                                @else
                                    <img id="preview" src="#" class="hidden absolute inset-0 w-full h-full object-cover rounded-[28px]" alt="Preview">
                                    <div id="upload-content">
                                @endif
                                        <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mx-auto mb-5">
                                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="green">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800">Klik untuk Ganti</h3>
                                        <p class="text-sm text-gray-400 mt-2">Format PNG, JPG atau SVG (Maks. 5MB)</p>
                                    </div>

                                <input id="gambar_logo" type="file" name="gambar_logo" class="hidden" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <x-input-error :messages="$errors->get('gambar_logo')" class="mt-2" />
                        </div>

                    </div>

                    {{-- DIVIDER --}}
                    <div class="border-t border-gray-200 my-10"></div>

                    {{-- BUTTONS --}}
                    <div class="flex items-center justify-between gap-4">
                        <a href="{{ route('produk.show', $produk->id) }}"
                           class="h-14 px-10 inline-flex items-center justify-center rounded-full border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition duration-200">
                            ← Kembali
                        </a>
                        <button type="submit"
                            class="h-14 px-10 inline-flex items-center justify-center rounded-full bg-green-600 hover:bg-green-700 text-white font-semibold shadow-lg shadow-green-500/30 transition duration-200">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
            const placeholder = document.getElementById('upload-placeholder');
            
            if(event.target.files.length > 0) {
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
<<<<<<< HEAD
=======
=======
            const uploadContent = document.getElementById('upload-content');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.classList.remove('hidden');
            uploadContent.classList.add('hidden');
>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
        }
    </script>

</x-app-layout>