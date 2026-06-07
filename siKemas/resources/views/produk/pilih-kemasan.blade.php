<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10 px-4">
        <div class="max-w-4xl mx-auto">

            {{-- Header --}}
            <div class="mb-8">
<<<<<<< HEAD
                <a href="{{ route('produk.create') }}"
                   class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-700 transition mb-4">
                </a>
=======
>>>>>>> b099451 (revisi admin & super admin)
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pilih Kemasan & Desain</h1>
                <p class="text-gray-400 mt-1 text-sm">Sesuaikan jenis kemasan, palet warna, dan instruksi AI untuk produk kamu.</p>
            </div>

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-medium flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

<<<<<<< HEAD
            {{-- Form sekarang langsung diarahkan ke desain.store --}}
            <form id="formGenerate" method="POST" action="{{ route('desain.store') }}" onsubmit="tampilkanLoading()">
=======
<<<<<<< HEAD
            {{-- Form sekarang langsung diarahkan ke desain.store --}}
            <form id="formGenerate" method="POST" action="{{ route('desain.store') }}" onsubmit="tampilkanLoading()">
=======
            <form id="formGenerate" method="POST" action="{{ route('desain.store') }}"
                onsubmit="document.getElementById('loadingIndicator').classList.remove('hidden');
                document.getElementById('btnSubmit').disabled = true;
                document.getElementById('btnSubmit').innerHTML = 'Memproses...';">

>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                @if ($desain)
                    <input type="hidden" name="desain_id" value="{{ $desain->id }}">
                @endif

                {{-- Step 1: Jenis Kemasan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white text-sm font-bold shrink-0">1</div>
                        <div>
                            <h2 class="font-bold text-gray-800 text-base">Jenis Kemasan</h2>
                            <p class="text-xs text-gray-400">Pilih wadah yang sesuai dengan produkmu</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                        @foreach ($jenisKemasans as $kemasan)
                            <label class="cursor-pointer group">
<<<<<<< HEAD
                                <input type="radio" name="jenis_kemasan_id" value="{{ $kemasan->id }}" required class="hidden peer">
=======
<<<<<<< HEAD
                                <input type="radio" name="jenis_kemasan_id" value="{{ $kemasan->id }}" required class="hidden peer">
=======
                                <input type="radio" name="jenis_kemasan_id" value="{{ $kemasan->id }}"
                                    class="hidden peer"
                                    {{ ($desain && $desain->jenis_kemasan_id == $kemasan->id) ? 'checked' : '' }}>
>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                                <div class="border-2 border-gray-100 bg-gray-50 rounded-xl p-3 text-center
                                            transition-all duration-200
                                            peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-md peer-checked:shadow-emerald-100
                                            hover:border-emerald-300 hover:bg-emerald-50/50 group-hover:scale-[1.03]">
                                    <img src="{{ asset($kemasan->ikon_kemasan) }}"
                                         alt="{{ $kemasan->nama_kemasan }}"
                                         class="w-12 h-12 object-contain mx-auto mb-2">
                                    <p class="text-[10px] font-semibold text-gray-600 leading-tight uppercase tracking-wide">
                                        {{ $kemasan->nama_kemasan }}
                                    </p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Step 2: Palet Warna --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white text-sm font-bold shrink-0">2</div>
                        <div>
                            <h2 class="font-bold text-gray-800 text-base">Palet Warna Brand</h2>
                            <p class="text-xs text-gray-400">Pilih kombinasi warna yang merepresentasikan produkmu</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @foreach ($paletWarnas as $palet)
                            <label class="cursor-pointer group">
<<<<<<< HEAD
                                <input type="radio" name="palet_warna_id" value="{{ $palet->id }}" required class="hidden peer">
=======
<<<<<<< HEAD
                                <input type="radio" name="palet_warna_id" value="{{ $palet->id }}" required class="hidden peer">
=======
                                <input type="radio" name="palet_warna_id" value="{{ $palet->id }}"
                                    class="hidden peer"
                                    {{ ($desain && $desain->palet_warna_id == $palet->id) ? 'checked' : '' }}>
>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                                <div class="border-2 border-transparent rounded-xl p-1.5 transition-all duration-200
                                            peer-checked:border-emerald-500 peer-checked:shadow-md peer-checked:shadow-emerald-100
                                            hover:border-emerald-300">
                                    <div class="flex rounded-lg overflow-hidden w-20 h-10 shadow-sm" title="{{ $palet->nama_palet }}">
                                        <div class="flex-1" style="background-color: {{ $palet->warna_utama }}"></div>
                                        <div class="flex-1" style="background-color: {{ $palet->warna_sekunder }}"></div>
                                        <div class="flex-1" style="background-color: {{ $palet->warna_aksen }}"></div>
                                    </div>
                                    <p class="text-[10px] text-center mt-1.5 text-gray-500 font-medium">{{ $palet->nama_palet }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Step 3: Prompt AI --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white text-sm font-bold shrink-0">3</div>
                        <div>
                            <h2 class="font-bold text-gray-800 text-base">Instruksi Desain AI</h2>
                            <p class="text-xs text-gray-400">Ceritakan gaya visual yang diinginkan untuk kemasan ini</p>
                        </div>
                    </div>

                    <textarea
                        id="promptInput"
                        name="instruksi_ai"
                        rows="4"
                        required
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700
                               placeholder-gray-400 resize-none
                               focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent focus:bg-white
                               transition duration-200"
                        placeholder="Contoh: Buatkan desain minimalis modern untuk keripik pisang, target market anak muda usia 18-25 tahun dengan nuansa earthy dan playful...">{{ $desain?->instruksi_ai }}</textarea>

                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="text-xs text-gray-400 self-center mr-1">Coba:</span>
                        @foreach ([
                            'Minimalis modern, target anak muda',
                            'Natural & organik, earthy tone',
                            'Premium & elegan, pasar ekspor',
                            'Playful & colorful, anak-anak',
                        ] as $chip)
                            <button type="button"
                                    onclick="document.getElementById('promptInput').value = '{{ $chip }}'"
                                    class="px-3 py-1 rounded-full text-xs bg-emerald-50 text-emerald-700 border border-emerald-200
                                           hover:bg-emerald-100 transition duration-150 font-medium">
                                {{ $chip }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Loading Indicator --}}
                <div id="loadingIndicator"
                     class="hidden mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-sm text-center font-medium transition-all">
                    <span class="animate-pulse">✨ Sedang meracik desain SiKemas dengan AI... Mohon tunggu sebentar</span>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between">
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                    <a href="{{ route('produk.create') }}"
=======
                    <a href="{{ route('produk.show', $produk->id) }}"
>>>>>>> b099451 (revisi admin & super admin)
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-600
                              hover:bg-gray-50 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali
                    </a>

                    <button id="btnSubmit" type="submit"
                            class="inline-flex items-center gap-2 px-7 py-2.5 rounded-xl bg-emerald-500 text-white text-sm font-semibold
                                   hover:bg-emerald-600 active:scale-95 transition duration-150 shadow-md shadow-emerald-200">
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
                        <span id="btnText" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                            </svg>
                            Generate dengan AI
                        </span>
<<<<<<< HEAD
                    </button>
                </div>
=======
                    </button>
                </div>
=======
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                        </svg>
                        {{ $desain ? 'Generate Ulang' : 'Generate dengan AI' }}
                    </button>
                </div>

>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
            </form>
        </div>
    </div>

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
    {{-- Script ringan hanya untuk menampilkan animasi loading saat form disubmit --}}
    <script>
        function tampilkanLoading() {
            // Tampilkan kotak loading
            document.getElementById('loadingIndicator').classList.remove('hidden');
            
            // Nonaktifkan tombol agar user tidak klik 2 kali
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            
            // Ubah teks tombol
            document.getElementById('btnText').innerHTML = 'Meracik Desain...';
        }
    </script>
<<<<<<< HEAD
=======
=======
>>>>>>> b099451 (revisi admin & super admin)
>>>>>>> b22d693d2710af424f889b3e37c1f08faf40432b
</x-app-layout>