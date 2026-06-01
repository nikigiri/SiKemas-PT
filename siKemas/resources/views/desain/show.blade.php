<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Desain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 px-4 py-2 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-6">

                <div class="flex gap-6 mb-6 pb-6 border-b border-gray-200">
                    @if ($desain->produk->gambar_logo)
                        <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}"
                             alt="{{ $desain->produk->nama_produk }}"
                             class="w-24 h-24 object-contain rounded-lg border border-gray-200">
                    @else
                        <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 text-xs">No Logo</span>
                        </div>
                    @endif

                    <div>
                        <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">
                            {{ $desain->produk->kategori_produk }}
                        </span>
                        <h3 class="font-bold text-xl text-gray-800 mt-2">{{ $desain->produk->nama_produk }}</h3>
                        <p class="text-sm text-gray-500 italic">{{ $desain->produk->tagline }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $desain->produk->deskripsi_produk }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-700 mb-2">Jenis Kemasan</h4>
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($desain->jenisKemasan->ikon_kemasan) }}"
                                 alt="{{ $desain->jenisKemasan->nama_kemasan }}"
                                 class="w-12 h-12 object-contain">
                            <div>
                                <p class="font-medium text-gray-800">{{ $desain->jenisKemasan->nama_kemasan }}</p>
                                <p class="text-sm text-gray-500">{{ $desain->jenisKemasan->deskripsi_kemasan }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-700 mb-2">Palet Warna</h4>
                        <p class="text-sm text-gray-600 mb-2">{{ $desain->paletWarna->nama_palet }}</p>
                        <div class="flex rounded-md overflow-hidden h-10 shadow-sm">
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_utama }}"
                                 title="Utama: {{ $desain->paletWarna->warna_utama }}"></div>
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"
                                 title="Sekunder: {{ $desain->paletWarna->warna_sekunder }}"></div>
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_aksen }}"
                                 title="Aksen: {{ $desain->paletWarna->warna_aksen }}"></div>
                        </div>
                        <div class="flex gap-2 mt-1 text-xs text-gray-500">
                            <span>{{ $desain->paletWarna->warna_utama }}</span>
                            <span>{{ $desain->paletWarna->warna_sekunder }}</span>
                            <span>{{ $desain->paletWarna->warna_aksen }}</span>
                        </div>
                    </div>
                </div>

                <div class="mb-8 flex flex-col items-center bg-[#F5F5F7] p-8 rounded-lg border border-gray-200">
                    <h4 class="font-semibold text-gray-700 mb-6 self-start">Visualisasi Desain</h4>

                    <div id="area-export" class="relative w-full max-w-sm aspect-[4/5] flex items-center justify-center bg-white shadow-sm border border-gray-100 rounded-lg overflow-hidden p-6">
                        
                        <img src="{{ asset('images/mockup-pouch.png') }}" 
                             class="absolute inset-0 w-full h-full object-contain z-10 drop-shadow-xl" 
                             alt="Mockup Kemasan"
                             onerror="this.src='https://via.placeholder.com/400x500/ffffff/cccccc?text=Mockup+Pouch+Polos'"> <div class="relative z-20 flex flex-col items-center justify-center w-[60%] h-[50%] mt-8 rounded-xl p-4 shadow-lg backdrop-blur-sm"
                             style="background-color: {{ $desain->paletWarna->warna_utama }}; border-bottom: 8px solid {{ $desain->paletWarna->warna_sekunder }};">
                            
                            @if ($desain->produk->gambar_logo)
                                <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}" class="w-12 h-12 object-contain mb-2 bg-white rounded-full p-1 shadow-sm">
                            @else
                                <div class="w-10 h-10 rounded-full mb-2 flex items-center justify-center text-white font-bold text-lg shadow-sm" style="background-color: {{ $desain->paletWarna->warna_aksen }}">
                                    {{ substr($desain->produk->nama_produk, 0, 1) }}
                                </div>
                            @endif

                            <h2 class="text-white font-extrabold text-xl text-center leading-tight tracking-wide drop-shadow-md">
                                {{ $desain->produk->nama_produk }}
                            </h2>
                            <p class="text-white/90 text-[10px] text-center mt-2 font-medium">
                                {{ $desain->produk->tagline ?? 'Produk Premium' }}
                            </p>
                        </div>
                    </div>
                    
                    <p class="text-xs text-gray-400 mt-4 italic">Preview digenerate berdasarkan palet warna pilihanmu.</p>
                </div>
                <div class="border border-emerald-200 bg-emerald-50 rounded-lg p-6 mb-6">
                    <h4 class="font-semibold text-emerald-800 mb-4">✨ Rekomendasi Konsep AI</h4>
                    @if ($desain->hasil_ai)
                        <div class="prose prose-emerald max-w-none text-sm text-gray-800 leading-relaxed">
                            {!! Str::markdown($desain->hasil_ai) !!}
                        </div>
                    @else
                        <p class="text-sm text-gray-400 italic">Belum ada hasil generate AI. Fitur ini akan segera tersedia.</p>
                    @endif
                </div>

                <div class="flex justify-between mt-8 pt-4 border-t border-gray-100">
                    <a href="{{ route('produk.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                        &larr; Kembali ke Produk
                    </a>

                    <div class="flex gap-3">
                        <a href="{{ route('produk.pilih-kemasan', $desain->produk_id) }}"
                           class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 transition">
                            🔄 Ulangi
                        </a>

                        <button id="btn-export" onclick="downloadDesain()"
                                class="px-5 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 transition flex items-center gap-2 shadow-sm">
                            💾 Export / Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadDesain() {
            const btn = document.getElementById('btn-export');
            const originalText = btn.innerHTML;
            btn.innerHTML = '⏳ Memproses...';
            btn.disabled = true;

            const elemen = document.getElementById('area-export');

            html2canvas(elemen, {
                scale: 3, 
                useCORS: true, 
                backgroundColor: null 
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Mockup-SiKemas-{{ Str::slug($desain->produk->nama_produk) }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click(); 

                btn.innerHTML = originalText;
                btn.disabled = false;
            }).catch(err => {
                console.error("Gagal export:", err);
                alert("Terjadi kesalahan saat menyimpan gambar.");
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        }
    </script>
</x-app-layout>