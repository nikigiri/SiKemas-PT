<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilihan Kemasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="text-gray-500 mb-6">Pilih jenis wadah, palet warna, dan deskripsikan desain yang diinginkan</p>

                <!-- Tambahkan ID formGenerate agar mudah ditarget oleh JavaScript -->
                <form id="formGenerate" method="POST" action="{{ route('desain.store') }}">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                    <!-- Pilih Jenis Kemasan -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-4">Jenis Kemasan</h3>
                        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                            @foreach ($jenisKemasans as $kemasan)
                                <label class="cursor-pointer">
                                    <input type="radio" name="jenis_kemasan_id" value="{{ $kemasan->id }}" class="hidden peer" required>
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:border-indigo-300">
                                        <img src="{{ asset($kemasan->ikon_kemasan) }}" alt="{{ $kemasan->nama_kemasan }}" class="w-16 h-16 object-contain mx-auto mb-2">
                                        <p class="text-xs font-medium text-gray-700">{{ strtoupper($kemasan->nama_kemasan) }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('jenis_kemasan_id')" class="mt-2" />
                    </div>

                    <!-- Pilih Palet Warna -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-4">Palet Warna Brand</h3>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex flex-wrap gap-3">
                                @foreach ($paletWarnas as $palet)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="palet_warna_id" value="{{ $palet->id }}" class="hidden peer" required>
                                        <div class="peer-checked:ring-2 peer-checked:ring-indigo-500 rounded-lg p-1">
                                            <div class="flex rounded-md overflow-hidden w-20 h-10 shadow-sm" title="{{ $palet->nama_palet }}">
                                                <div class="flex-1" style="background-color: {{ $palet->warna_utama }}"></div>
                                                <div class="flex-1" style="background-color: {{ $palet->warna_sekunder }}"></div>
                                                <div class="flex-1" style="background-color: {{ $palet->warna_aksen }}"></div>
                                            </div>
                                            <p class="text-xs text-center mt-1 text-gray-600">{{ $palet->nama_palet }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('palet_warna_id')" class="mt-2" />
                    </div>

                    <!-- KOTAK PROMPTING AI BARU -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Instruksi Desain (Prompt AI)</h3>
                        <p class="text-sm text-gray-500 mb-3">Ceritakan gaya visual yang diinginkan untuk kemasan ini.</p>
                        <textarea 
                            id="promptInput" 
                            name="prompt" 
                            rows="4" 
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                            placeholder="Contoh: Buatkan desain minimalis modern untuk keripik pisang, target market anak muda usia 18-25 tahun..."
                            required></textarea>
                    </div>

                    <!-- AREA NOTIFIKASI & HASIL -->
                    <div id="loadingIndicator" class="hidden mb-6 p-4 bg-indigo-50 text-indigo-700 rounded-md text-center animate-pulse">
                        Sedang meracik desain dengan AI... Mohon tunggu sebentar ✨
                    </div>
                    
                    <div id="resultArea" class="hidden mb-6 p-4 border rounded-md">
                        <!-- Hasil balasan AI akan muncul di sini -->
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('produk.create') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            ← Kembali
                        </a>
                        <!-- Tambahkan ID ke tombol submit -->
                        <x-primary-button id="btnSubmit">
                            ✨ Generate dengan AI
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT INTEGRASI AI -->
    <script>
    document.getElementById('formGenerate').addEventListener('submit', async function(e) {
        // Mencegah form langsung berpindah halaman ke route desain.store
        e.preventDefault(); 

        const btn = document.getElementById('btnSubmit');
        const loading = document.getElementById('loadingIndicator');
        const resultArea = document.getElementById('resultArea');
        const promptText = document.getElementById('promptInput').value;

        // Ambil data lain dari form (kemasan & warna) jika nanti backend memerlukannya
        const formData = new FormData(this);
        const kemasanId = formData.get('jenis_kemasan_id');
        const paletId = formData.get('palet_warna_id');

        // Ubah state UI ke mode Loading
        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
        loading.classList.remove('hidden');
        resultArea.classList.add('hidden');

        try {
            // Ambil CSRF token dari input hidden buatan Laravel (@csrf)
            const csrfToken = document.querySelector('input[name="_token"]').value;

            // Sesuaikan URL ini dengan endpoint API yang kamu buat di web.php / api.php
            const response = await fetch('/generate-ai', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ 
                    prompt: promptText,
                    jenis_kemasan_id: kemasanId,
                    palet_warna_id: paletId
                })
            });

            const result = await response.json();

            // Tampilkan hasil
            if (result.success) {
                // Formatting warna output jadi hijau
                resultArea.className = 'mb-6 p-4 border border-green-200 bg-green-50 rounded-md text-green-800';
                
                // Cek apakah outputnya berbentuk string teks biasa atau array JSON (dari kode sebelumnya)
                if (typeof result.data === 'string') {
                    resultArea.innerHTML = `<h4 class="font-bold mb-2">Hasil:</h4><p class="whitespace-pre-wrap">${result.data}</p>`;
                } else {
                    resultArea.innerHTML = `<h4 class="font-bold mb-2">Berhasil disimpan ke database!</h4>`;
                    console.log(result.data); // Cek console inspect element untuk melihat array JSON
                }
                
                resultArea.classList.remove('hidden');
            } else {
                throw new Error(result.message || 'Terjadi kesalahan pada server');
            }
        } catch (error) {
            // Formatting warna error jadi merah
            resultArea.className = 'mb-6 p-4 border border-red-200 bg-red-50 rounded-md text-red-800';
            resultArea.innerHTML = `<p><strong>Gagal:</strong> ${error.message}</p>`;
            resultArea.classList.remove('hidden');
        } finally {
            // Kembalikan tombol ke keadaan semula
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            loading.classList.add('hidden');
        }
    });
    </script>
</x-app-layout>