<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Hasil Desain Kemasan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 flex items-center p-4 text-sm text-emerald-800 border border-emerald-200 rounded-xl bg-emerald-50 shadow-sm">
                    <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

                <div class="flex flex-col md:flex-row gap-6 mb-8 pb-8 border-b border-slate-100">
                    @if ($desain->produk->gambar_logo)
                        <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}"
                             alt="{{ $desain->produk->nama_produk }}"
                             class="w-28 h-28 object-contain rounded-xl border border-slate-200 bg-slate-50 p-2 shadow-sm">
                    @else
                        <div class="w-28 h-28 bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center shadow-sm">
                            <svg class="w-8 h-8 text-slate-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-slate-400 text-xs font-medium">No Logo</span>
                        </div>
                    @endif

                    <div class="flex-1 flex flex-col justify-center">
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                {{ $desain->produk->kategori_produk }}
                            </span>
                        </div>
                        <h3 class="font-bold text-2xl text-slate-900 mt-3 tracking-tight">{{ $desain->produk->nama_produk }}</h3>
                        <p class="text-sm text-slate-500 font-medium mt-1">{{ $desain->produk->tagline ?? 'Tanpa Tagline' }}</p>
                        <p class="text-sm text-slate-600 mt-3 leading-relaxed max-w-3xl">{{ $desain->produk->deskripsi_produk }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 hover:border-slate-300 transition-colors">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-slate-700 text-sm uppercase tracking-wider">Spesifikasi Kemasan</h4>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-white rounded-lg shadow-sm border border-slate-100">
                                <img src="{{ asset($desain->jenisKemasan->ikon_kemasan) }}"
                                     alt="{{ $desain->jenisKemasan->nama_kemasan }}"
                                     class="w-10 h-10 object-contain">
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">{{ $desain->jenisKemasan->nama_kemasan }}</p>
                                <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ $desain->jenisKemasan->deskripsi_kemasan }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 hover:border-slate-300 transition-colors">
                        <h4 class="font-semibold text-slate-700 text-sm uppercase tracking-wider mb-4">Skema Warna</h4>
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm font-medium text-slate-700">{{ $desain->paletWarna->nama_palet }}</p>
                        </div>
                        <div class="flex rounded-lg overflow-hidden h-12 shadow-sm border border-slate-200/50">
                            <div class="flex-1 transition-transform hover:scale-105" style="background-color: {{ $desain->paletWarna->warna_utama }}" title="Utama: {{ $desain->paletWarna->warna_utama }}"></div>
                            <div class="flex-1 transition-transform hover:scale-105" style="background-color: {{ $desain->paletWarna->warna_sekunder }}" title="Sekunder: {{ $desain->paletWarna->warna_sekunder }}"></div>
                            <div class="flex-1 transition-transform hover:scale-105" style="background-color: {{ $desain->paletWarna->warna_aksen }}" title="Aksen: {{ $desain->paletWarna->warna_aksen }}"></div>
                        </div>
                        <div class="flex gap-4 mt-3 text-xs font-mono text-slate-500 justify-between px-1">
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full" style="background-color: {{ $desain->paletWarna->warna_utama }}"></span>{{ $desain->paletWarna->warna_utama }}</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full" style="background-color: {{ $desain->paletWarna->warna_sekunder }}"></span>{{ $desain->paletWarna->warna_sekunder }}</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full" style="background-color: {{ $desain->paletWarna->warna_aksen }}"></span>{{ $desain->paletWarna->warna_aksen }}</span>
                        </div>
                    </div>
                </div>

                <div class="mb-10 flex flex-col items-center bg-slate-900 rounded-2xl border border-slate-800 p-10 relative overflow-hidden">
                    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-slate-800 via-slate-900 to-black opacity-80 z-0"></div>
                    
                    <div class="relative z-10 w-full flex justify-between items-center mb-8">
                        <h4 class="font-semibold text-white tracking-wide">Live Preview</h4>
                        <span class="px-3 py-1 bg-white/10 text-white/80 text-xs rounded-full backdrop-blur-sm border border-white/10">Rendering Engine</span>
                    </div>

                    <div id="area-export" class="relative z-10 w-full max-w-md aspect-[4/5] flex items-center justify-center bg-transparent rounded-xl p-6">
                        
                        <img src="{{ asset('images/mockup-pouch.png') }}" 
                             class="absolute inset-0 w-full h-full object-contain z-10 drop-shadow-2xl" 
                             alt="Mockup Kemasan"
                             onerror="this.src='https://via.placeholder.com/400x500/ffffff/cccccc?text=Mockup+Pouch+Polos'"> 
                             
<<<<<<< HEAD
                        <div class="relative z-20 flex flex-col items-center justify-center w-[60%] h-[50%] mt-8 rounded-xl p-4 shadow-lg backdrop-blur-sm"
                             style="background-color: {{ $desain->paletWarna->warna_utama }}; border-bottom: 8px solid {{ $desain->paletWarna->warna_sekunder }};">
=======
                        <div class="relative z-20 flex flex-col items-center justify-center w-[65%] h-[55%] mt-12 rounded-2xl p-5 shadow-2xl backdrop-blur-md bg-white/10"
                             style="border: 1px solid rgba(255,255,255,0.2); background-color: {{ $desain->paletWarna->warna_utama }}CC; border-bottom: 6px solid {{ $desain->paletWarna->warna_sekunder }};">
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                            
                            @if ($desain->produk->gambar_logo)
                                <div class="bg-white/90 p-2 rounded-full shadow-lg mb-3 backdrop-blur-sm">
                                    <img src="{{ asset('storage/' . $desain->produk->gambar_logo) }}" class="w-12 h-12 object-contain">
                                </div>
                            @else
                                <div class="w-14 h-14 rounded-full mb-3 flex items-center justify-center text-white font-bold text-xl shadow-lg border-2 border-white/30" 
                                     style="background-color: {{ $desain->paletWarna->warna_aksen }}">
                                    {{ substr($desain->produk->nama_produk, 0, 1) }}
                                </div>
                            @endif

                            <h2 class="text-white font-black text-2xl text-center leading-tight tracking-wider drop-shadow-md">
                                {{ strtoupper($desain->produk->nama_produk) }}
                            </h2>
                            
                            <div class="w-8 h-0.5 bg-white/50 my-2 rounded-full"></div>

                            <p class="text-white/90 text-xs text-center font-medium tracking-wide drop-shadow-sm">
                                {{ $desain->produk->tagline ?? 'PREMIUM QUALITY' }}
                            </p>
                        </div>
                    </div>
                    
                    <p class="text-xs text-slate-400 mt-6 font-medium relative z-10 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Generated dynamically based on selected palette
                    </p>
                </div>

<<<<<<< HEAD
                <div class="border border-emerald-200 bg-emerald-50 rounded-lg p-6 mb-6">
                    <h4 class="font-semibold text-emerald-800 mb-4">✨ Rekomendasi Konsep AI</h4>
=======
                <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-2xl p-6 mb-8 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="p-1.5 bg-emerald-100 rounded-lg text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-800">Analisis Konsep AI</h4>
                    </div>
                    
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                    @if ($desain->hasil_ai)
                        <div class="prose prose-slate prose-sm max-w-none text-slate-700 leading-relaxed">
                            {!! Str::markdown($desain->hasil_ai) !!}
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-6 text-center">
                            <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            <p class="text-sm text-slate-500 font-medium">Sistem sedang memproses wawasan desain.</p>
                        </div>
                    @endif
                </div>

<<<<<<< HEAD
                <div class="flex flex-col sm:flex-row justify-between items-center mt-8 pt-6 border-t border-slate-100 gap-4">
                    <a href="{{ route('produk.index') }}"
<<<<<<< HEAD
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition flex items-center h-10">
                        &larr; Kembali
                    </a>

                    <div class="flex gap-3">
                        <a href="{{ route('produk.pilih-kemasan', $desain->produk_id) }}"
                           class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 transition flex items-center h-10">
=======
                       class="w-full sm:w-auto px-5 py-2.5 border border-slate-300 rounded-xl text-slate-700 font-medium hover:bg-slate-50 transition-all flex items-center justify-center focus:ring-2 focus:ring-slate-200 focus:outline-none">
                        <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>

                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <a href="{{ route('produk.pilih-kemasan', $desain->produk_id) }}"
                           class="px-5 py-2.5 border-2 border-slate-200 text-slate-700 font-medium rounded-xl hover:border-slate-300 hover:bg-slate-50 transition-all flex items-center justify-center focus:ring-2 focus:ring-slate-200 focus:outline-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Ulangi Desain
=======
                <div class="flex justify-between mt-8 pt-4 border-t border-gray-100">
                    <a href="{{ route('produk.show', $desain->produk_id) }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                        &larr; Kembali ke Produk
                    </a>

                    <div class="flex gap-3">
                        <a href="{{ route('produk.pilih-kemasan', [$desain->produk_id, 'desain_id' => $desain->id]) }}" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 transition">
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                            🔄 Ulangi
>>>>>>> b099451 (revisi admin & super admin)
                        </a>

                        <button id="btn-export" onclick="downloadDesain()"
<<<<<<< HEAD
                                class="px-4 py-2 bg-emerald-600 text-white font-medium rounded-md hover:bg-emerald-700 transition flex items-center gap-2 shadow-sm h-10">
                            🖼️ Download Mockup
                        </button>

                        <a href="{{ route('desain.export', $desain->id) }}"
                           class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition flex items-center gap-2 shadow-sm h-10">
                            📄 Cetak Detail AI
=======
                                class="px-5 py-2.5 bg-slate-900 text-white font-medium rounded-xl hover:bg-slate-800 transition-all flex items-center justify-center shadow-md shadow-slate-900/10 focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 focus:outline-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Mockup
                        </button>

                        <a href="{{ route('desain.export', $desain->id) }}"
                           class="px-5 py-2.5 bg-emerald-600 text-white font-medium rounded-xl hover:bg-emerald-700 transition-all flex items-center justify-center shadow-md shadow-emerald-600/20 focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 focus:outline-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Cetak Laporan
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                        </a>
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