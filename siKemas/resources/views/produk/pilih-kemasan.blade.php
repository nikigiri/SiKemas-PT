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

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-medium flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            {{-- Form sekarang langsung diarahkan ke desain.store --}}
            <form id="formGenerate" method="POST" action="{{ route('desain.store') }}" onsubmit="tampilkanLoading()">
            <form id="formGenerate" method="POST" action="{{ route('desain.store') }}"
                onsubmit="document.getElementById('loadingIndicator').classList.remove('hidden');
                document.getElementById('btnSubmit').disabled = true;
                document.getElementById('btnSubmit').innerHTML = 'Memproses...';">


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

                                <input type="radio" name="jenis_kemasan_id" value="{{ $kemasan->id }}" required class="hidden peer">

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
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5" x-data="paletWarna()">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white text-sm font-bold shrink-0">2</div>
                        <div>
                            <h2 class="font-bold text-gray-800 text-base">Palet Warna Brand</h2>
                            <p class="text-xs text-gray-400">Pilih preset atau buat kombinasi warnamu sendiri</p>
                        </div>
                    </div>

                    {{-- Hidden inputs untuk dikirim ke controller --}}
                    <input type="hidden" name="palet_warna_id" :value="selectedPresetId">

                    {{-- Tab toggle --}}
                    <div class="flex gap-2 mb-5">
                        <button type="button" @click="mode='preset'"
                            :class="mode==='preset' ? 'bg-emerald-500 text-white shadow-sm' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                            class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                            🎨 Pilih Preset
                        </button>
                        <button type="button" @click="mode='custom'"
                            :class="mode==='custom' ? 'bg-emerald-500 text-white shadow-sm' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                            class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                            ✏️ Buat Sendiri
                        </button>
                    </div>

                    {{-- Mode Preset --}}
                    <div x-show="mode==='preset'" x-transition>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($paletWarnas as $palet)
                            <button type="button"
                                @click="selectPreset({{ $palet->id }})"
                                :class="selectedPresetId == {{ $palet->id }} ? 'ring-2 ring-emerald-500 ring-offset-2' : 'ring-1 ring-gray-200'"
                                class="rounded-xl p-1.5 transition-all hover:scale-105 focus:outline-none">
                                <div class="flex rounded-lg overflow-hidden w-20 h-10 shadow-sm" title="{{ $palet->nama_palet }}">
                                    <div class="flex-1" style="background-color: {{ $palet->warna_utama }}"></div>
                                    <div class="flex-1" style="background-color: {{ $palet->warna_sekunder }}"></div>
                                    <div class="flex-1" style="background-color: {{ $palet->warna_aksen }}"></div>
                                </div>
                                <p class="text-[10px] text-center mt-1.5 text-gray-500 font-medium">{{ $palet->nama_palet }}</p>
                            </button>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-400 mt-3" x-show="!selectedPresetId">⚠️ Pilih salah satu preset warna</p>
                    </div>

                    {{-- Mode Custom --}}
                    <div x-show="mode==='custom'" x-transition>
                        <p class="text-xs text-gray-500 mb-4">Pilih minimal 3 warna untuk membentuk palet brandmu:</p>

                        <div class="grid grid-cols-3 gap-4 mb-5">
                            {{-- Warna Utama --}}
                            <div class="flex flex-col items-center gap-2">
                                <div class="relative w-full h-16 rounded-xl overflow-hidden border-2 border-gray-200 cursor-pointer hover:border-emerald-400 transition"
                                    :style="'background:' + customColors[0]"
                                    @click="$refs.color1.click()">
                                    <input x-ref="color1" type="color" x-model="customColors[0]"
                                        class="absolute inset-0 opacity-0 w-full h-full cursor-pointer">
                                    <div class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-white/80 flex items-center justify-center">
                                        <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500 font-medium">Utama</span>
                                <span class="text-[10px] text-gray-400 font-mono" x-text="customColors[0]"></span>
                            </div>

                            {{-- Warna Sekunder --}}
                            <div class="flex flex-col items-center gap-2">
                                <div class="relative w-full h-16 rounded-xl overflow-hidden border-2 border-gray-200 cursor-pointer hover:border-emerald-400 transition"
                                    :style="'background:' + customColors[1]"
                                    @click="$refs.color2.click()">
                                    <input x-ref="color2" type="color" x-model="customColors[1]"
                                        class="absolute inset-0 opacity-0 w-full h-full cursor-pointer">
                                    <div class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-white/80 flex items-center justify-center">
                                        <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500 font-medium">Sekunder</span>
                                <span class="text-[10px] text-gray-400 font-mono" x-text="customColors[1]"></span>
                            </div>

                            {{-- Warna Aksen --}}
                            <div class="flex flex-col items-center gap-2">
                                <div class="relative w-full h-16 rounded-xl overflow-hidden border-2 border-gray-200 cursor-pointer hover:border-emerald-400 transition"
                                    :style="'background:' + customColors[2]"
                                    @click="$refs.color3.click()">
                                    <input x-ref="color3" type="color" x-model="customColors[2]"
                                        class="absolute inset-0 opacity-0 w-full h-full cursor-pointer">
                                    <div class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-white/80 flex items-center justify-center">
                                        <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500 font-medium">Aksen</span>
                                <span class="text-[10px] text-gray-400 font-mono" x-text="customColors[2]"></span>
                            </div>
                        </div>

                        {{-- Preview palet custom --}}
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="flex rounded-lg overflow-hidden w-24 h-10 shadow-sm flex-shrink-0">
                                <div class="flex-1" :style="'background:' + customColors[0]"></div>
                                <div class="flex-1" :style="'background:' + customColors[1]"></div>
                                <div class="flex-1" :style="'background:' + customColors[2]"></div>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">Preview Palet Kamu</p>
                                <p class="text-[10px] text-gray-400 mt-0.5" x-text="customColors[0] + ' · ' + customColors[1] + ' · ' + customColors[2]"></p>
                            </div>
                        </div>

                        {{-- Saran warna berdasarkan kategori --}}
                        <div class="mt-4">
                            <p class="text-xs font-semibold text-gray-600 mb-2">💡 Saran palet populer:</p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" @click="applySuggestion('#1a0a00','#c9a84c','#8b4513')"
                                    class="flex rounded-lg overflow-hidden w-16 h-8 shadow-sm hover:scale-105 transition ring-1 ring-gray-200">
                                    <div class="flex-1" style="background:#1a0a00"></div>
                                    <div class="flex-1" style="background:#c9a84c"></div>
                                    <div class="flex-1" style="background:#8b4513"></div>
                                </button>
                                <button type="button" @click="applySuggestion('#1b4332','#52b788','#95d5b2')"
                                    class="flex rounded-lg overflow-hidden w-16 h-8 shadow-sm hover:scale-105 transition ring-1 ring-gray-200">
                                    <div class="flex-1" style="background:#1b4332"></div>
                                    <div class="flex-1" style="background:#52b788"></div>
                                    <div class="flex-1" style="background:#95d5b2"></div>
                                </button>
                                <button type="button" @click="applySuggestion('#7b2d8b','#f5c518','#e040fb')"
                                    class="flex rounded-lg overflow-hidden w-16 h-8 shadow-sm hover:scale-105 transition ring-1 ring-gray-200">
                                    <div class="flex-1" style="background:#7b2d8b"></div>
                                    <div class="flex-1" style="background:#f5c518"></div>
                                    <div class="flex-1" style="background:#e040fb"></div>
                                </button>
                                <button type="button" @click="applySuggestion('#7f1d1d','#ef4444','#fca5a5')"
                                    class="flex rounded-lg overflow-hidden w-16 h-8 shadow-sm hover:scale-105 transition ring-1 ring-gray-200">
                                    <div class="flex-1" style="background:#7f1d1d"></div>
                                    <div class="flex-1" style="background:#ef4444"></div>
                                    <div class="flex-1" style="background:#fca5a5"></div>
                                </button>
                                <button type="button" @click="applySuggestion('#03045e','#0096c7','#90e0ef')"
                                    class="flex rounded-lg overflow-hidden w-16 h-8 shadow-sm hover:scale-105 transition ring-1 ring-gray-200">
                                    <div class="flex-1" style="background:#03045e"></div>
                                    <div class="flex-1" style="background:#0096c7"></div>
                                    <div class="flex-1" style="background:#90e0ef"></div>
                                </button>
                                <button type="button" @click="applySuggestion('#3d2b1f','#a0785a','#e8d5c4')"
                                    class="flex rounded-lg overflow-hidden w-16 h-8 shadow-sm hover:scale-105 transition ring-1 ring-gray-200">
                                    <div class="flex-1" style="background:#3d2b1f"></div>
                                    <div class="flex-1" style="background:#a0785a"></div>
                                    <div class="flex-1" style="background:#e8d5c4"></div>
                                </button>
                            </div>
                        </div>

                        {{-- Hidden inputs custom --}}
                        <input type="hidden" name="custom_warna_utama" :value="customColors[0]">
                        <input type="hidden" name="custom_warna_sekunder" :value="customColors[1]">
                        <input type="hidden" name="custom_warna_aksen" :value="customColors[2]">
                        <input type="hidden" name="use_custom_color" value="1">
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

                    <a href="{{ route('produk.create') }}"

                    <a href="{{ route('produk.show', $produk->id) }}"
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

                        <span id="btnText" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                            </svg>
                            Generate dengan AI
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>


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

        function paletWarna() {
            return {
                mode: 'preset',
                selectedPresetId: null,
                customColors: ['#1a0a00', '#c9a84c', '#8b4513'],
                selectPreset(id) {
                    this.selectedPresetId = id;
                },
                applySuggestion(c1, c2, c3) {
                    this.customColors = [c1, c2, c3];
                }
            }
        }
    </script>
</x-app-layout>