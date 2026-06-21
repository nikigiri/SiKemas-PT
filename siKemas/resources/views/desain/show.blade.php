<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('produk.show', $desain->produk_id) }}"
            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
                {{ __('Hasil Desain') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-5 flex items-center p-4 text-sm text-emerald-800 border border-emerald-200 rounded-xl bg-emerald-50 shadow-sm">
                    <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- THREE COLUMN LAYOUT --}}
            <div class="flex gap-5 items-start">

                {{-- KOLOM KIRI: Info Produk & Spesifikasi --}}
                <div class="w-72 flex-shrink-0 flex flex-col gap-4">

                    {{-- Card Produk --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        {{-- Logo --}}
                        <div class="flex flex-col items-center mb-4">
                            @if ($desain->produk->gambar_logo)
                                <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}"
                                     alt="{{ $desain->produk->nama_produk }}"
                                     class="w-20 h-20 object-contain rounded-xl border border-slate-200 bg-slate-50 p-2 shadow-sm">
                            @else
                                <div class="w-20 h-20 bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center shadow-sm">
                                    <svg class="w-7 h-7 text-slate-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-slate-400 text-xs font-medium">No Logo</span>
                                </div>
                            @endif
                        </div>

                        <h3 class="font-bold text-base text-slate-900 text-center tracking-tight">{{ $desain->produk->nama_produk }}</h3>
                        <p class="text-xs text-slate-500 text-center mt-0.5">{{ $desain->produk->tagline ?? 'Tanpa Tagline' }}</p>

                        @if ($desain->produk->deskripsi_produk)
                            <p class="text-xs text-slate-600 mt-3 leading-relaxed text-center">{{ $desain->produk->deskripsi_produk }}</p>
                        @endif
                    </div>

                    {{-- Card Spesifikasi Kemasan --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Spesifikasi Kemasan</p>
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-slate-50 rounded-lg border border-slate-100 flex-shrink-0">
                                <img src="{{ asset($desain->jenisKemasan->ikon_kemasan) }}"
                                     alt="{{ $desain->jenisKemasan->nama_kemasan }}"
                                     class="w-10 h-10 object-contain">
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900 text-sm">{{ $desain->jenisKemasan->nama_kemasan }}</p>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $desain->jenisKemasan->deskripsi_kemasan }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Card Skema Warna --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Skema Warna</p>
                        <p class="text-sm font-medium text-slate-700 mb-3">{{ $desain->paletWarna->nama_palet }}</p>
                        <div class="flex rounded-lg overflow-hidden h-10 shadow-sm border border-slate-200/50 mb-3">
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_utama }}"></div>
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"></div>
                            <div class="flex-1" style="background-color: {{ $desain->paletWarna->warna_aksen }}"></div>
                        </div>
                        <div class="flex flex-wrap gap-x-3 gap-y-2 text-xs font-mono text-slate-500">
                            <span class="flex items-center gap-1">
                                <span class="w-2.5 h-2.5 rounded-full border border-slate-200" style="background-color: {{ $desain->paletWarna->warna_utama }}"></span>
                                {{ $desain->paletWarna->warna_utama }}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="w-2.5 h-2.5 rounded-full border border-slate-200" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"></span>
                                {{ $desain->paletWarna->warna_sekunder }}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="w-2.5 h-2.5 rounded-full border border-slate-200" style="background-color: {{ $desain->paletWarna->warna_aksen }}"></span>
                                {{ $desain->paletWarna->warna_aksen }}
                            </span>
                        </div>
                    </div>

                </div>

                {{-- KOLOM TENGAH: Live Preview + Tombol Export --}}
                <div class="flex-1 flex flex-col gap-4">
                    <div class="bg-slate-900 rounded-2xl border border-slate-800 p-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-slate-800 via-slate-900 to-black opacity-80 z-0"></div>

                        <div id="area-export" class="relative z-10 w-full flex items-center justify-center" style="min-height: 420px;">
                            @if ($desain->mockup_url)
                                <img src="{{ $desain->mockup_url }}"
                                    class="max-w-full max-h-96 object-contain drop-shadow-2xl rounded-xl"
                                    alt="Mockup Kemasan {{ $desain->produk->nama_produk }}"
                                    crossorigin="anonymous"
                                    onerror="this.src='https://via.placeholder.com/400x500/1e293b/94a3b8?text=Gagal+Memuat+Mockup'">
                            @else
                                <div class="flex flex-col items-center justify-center text-white/60 text-sm">
                                    <svg class="animate-spin h-8 w-8 mb-3" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Mockup belum tersedia
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    

                        <div class="flex gap-2 justify-end">
                            <a href="{{ route('produk.pilih-kemasan', $desain->produk_id) }}"
                            class="px-6 py-2.5 border-2 border-slate-200 bg-white text-slate-700 font-medium rounded-xl hover:border-slate-300 hover:bg-slate-50 transition-all flex items-center justify-center text-sm shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Regenerasi AI
                            </a>

                           <button id="btn-export" onclick="downloadDesain()"
                                class="px-6 py-2.5 bg-[#005A1C] text-white font-medium rounded-xl hover:bg-[#004a17] transition-all flex items-center justify-center shadow-md text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Mockup
                        </button>
                    
                    </div>
                </div>

                {{-- KOLOM KANAN: Analisis AI (fixed height, scrollable) --}}
                <div class="w-72 flex-shrink-0">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sticky top-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="p-1.5 bg-emerald-100 rounded-lg text-emerald-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-slate-800 text-sm">Analisis Konsep AI</h4>
                        </div>

                        <div class="overflow-y-auto" style="max-height: 420px;">
                            @if ($desain->hasil_ai)
                                <div class="prose prose-slate prose-sm max-w-none text-slate-700 leading-relaxed">
                                    {!! Str::markdown($desain->hasil_ai) !!}
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-6 text-center">
                                    <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-slate-500 font-medium">Sistem sedang memproses wawasan desain.</p>
                                </div>
                            @endif
                        </div>
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

            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

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
                btn.classList.remove('opacity-75', 'cursor-not-allowed');
            }).catch(err => {
                console.error("Gagal export:", err);
                alert("Terjadi kesalahan saat menyimpan gambar.");
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');
            });
        }
    </script>
</x-app-layout>