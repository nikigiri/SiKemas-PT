<x-app-layout>

    <div class="min-h-screen bg-gray-50 py-10 px-4">
        <div class="max-w-4xl mx-auto">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('produk.create') }}"
                   class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-700 transition mb-4">
        
                </a>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pilih Kemasan & Desain</h1>
                <p class="text-gray-400 mt-1 text-sm">Sesuaikan jenis kemasan, palet warna, dan instruksi AI untuk produk kamu.</p>
            </div>

            {{-- Kotak Error --}}
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-medium flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <form id="formGenerate" method="POST" action="{{ route('desain.store') }}" 
                onsubmit="document.getElementById('loadingIndicator').classList.remove('hidden'); 
                document.getElementById('btnSubmit').disabled = true; 
                document.getElementById('btnSubmit').innerHTML = 'Memproses...';">

                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

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
                                <input type="radio" name="jenis_kemasan_id" value="{{ $kemasan->id }}" class="hidden peer">
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
                    <x-input-error :messages="$errors->get('jenis_kemasan_id')" class="mt-2"/>
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
                                <input type="radio" name="palet_warna_id" value="{{ $palet->id }}" class="hidden peer">
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
                    <x-input-error :messages="$errors->get('palet_warna_id')" class="mt-2"/>
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
                        placeholder="Contoh: Buatkan desain minimalis modern untuk keripik pisang, target market anak muda usia 18-25 tahun dengan nuansa earthy dan playful..."></textarea>

                    {{-- Quick Prompt Chips --}}
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

                {{-- Loading --}}
                <div id="loadingIndicator"
                     class="hidden mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-sm text-center font-medium">
                    <span class="animate-pulse">✨ Sedang meracik desain dengan AI... Mohon tunggu sebentar</span>
                </div>

                {{-- Result --}}
                <div id="resultArea" class="hidden mb-5"></div>

                {{-- Actions --}}
                <div class="flex items-center justify-between">
                    <a href="{{ route('produk.create') }}"
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
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                        </svg>
                        Generate dengan AI
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>