<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ auth()->user()->hasRole('superadmin') ? route('admin.user.index') : route('kwt-admin.user.index') }}"
               class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Produk milik {{ $user->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $user->nama_usaha }} — {{ $user->email }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ showModal: false, selected: null }">

            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Produk</h3>
                    <p class="text-sm text-gray-500 mt-1">Total {{ $produks->count() }} produk</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Produk</th>
                                <th class="px-6 py-4 text-left font-semibold">Kategori</th>
                                <th class="px-6 py-4 text-left font-semibold">Jumlah Desain</th>
                                <th class="px-6 py-4 text-left font-semibold">Dibuat</th>
                                <th class="px-6 py-4 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($produks as $produk)
                                @php
                                    $previewData = [
                                        'nama' => $produk->nama_produk,
                                        'tagline' => $produk->tagline ?? '-',
                                        'kategori' => $produk->kategori->nama_kategori ?? ($produk->kategori_produk ?? '-'),
                                        'deskripsi' => $produk->deskripsi_produk ?? '-',
                                        'logo' => $produk->gambar_logo ? asset('storage/' . $produk->gambar_logo) : '',
                                        'jumlahDesain' => $produk->desains->count(),
                                        'dibuat' => $produk->created_at->format('d M Y'),
                                    ];
                                @endphp
                                <tr class="hover:bg-green-50/40 transition">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            @if ($produk->gambar_logo)
                                                <img src="{{ asset('storage/' . $produk->gambar_logo) }}"
                                                     class="w-12 h-12 object-contain rounded-xl border border-gray-100 bg-gray-50 p-1">
                                            @else
                                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-green-400 to-emerald-500 text-white flex items-center justify-center font-bold text-lg shadow">
                                                    {{ strtoupper(substr($produk->nama_produk, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $produk->nama_produk }}</p>
                                                <p class="text-xs text-gray-400 mt-1">{{ $produk->tagline ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $produk->kategori->nama_kategori ?? ($produk->kategori_produk ?? '-') }}
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">{{ $produk->desains->count() }}</td>
                                    <td class="px-6 py-5 text-gray-600">{{ $produk->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-5">
                                        <button type="button"
                                            @click='selected = @json($previewData); showModal = true'
                                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl text-xs font-medium hover:bg-indigo-100 transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            Lihat
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <h3 class="text-lg font-semibold text-gray-700">Belum Ada Produk</h3>
                                        <p class="text-sm text-gray-400 mt-1">User ini belum membuat produk apapun.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Preview Produk --}}
            <div x-show="showModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4"
                style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);"
                @click.self="showModal = false">

                <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full relative overflow-hidden">

                    {{-- Tombol X pojok kanan atas, di luar area foto --}}
                    <button @click="showModal = false"
                        class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-white/80 hover:bg-white shadow flex items-center justify-center transition">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <template x-if="selected">
                        <div>
                            {{-- Header berwarna --}}
                            <div class="bg-gradient-to-r from-green-500 to-yellow-50 px-10 pt-8 pb-6">
                                <div class="flex items-center gap-4">
                                    <template x-if="selected.logo">
                                        <img :src="selected.logo"
                                            class="w-16 h-16 object-contain rounded-2xl bg-white p-1.5 shadow-lg flex-shrink-0">
                                    </template>
                                    <template x-if="!selected.logo">
                                        <div class="w-16 h-16 rounded-2xl bg-white/30 text-white flex items-center justify-center font-bold text-2xl flex-shrink-0"
                                            x-text="selected.nama.charAt(0).toUpperCase()"></div>
                                    </template>
                                    <div class="min-w-0">
                                        <h3 class="text-lg font-bold text-white leading-tight" x-text="selected.nama"></h3>
                                        <p class="text-sm text-white/80 mt-0.5" x-text="selected.tagline"></p>
                                    </div>
                                </div>
                            </div>

                            {{-- Body --}}
                            <div class="px-10 py-5 space-y-3 text-sm">
                                <div class="flex justify-between border-b border-gray-100 pb-3">
                                    <span class="text-gray-500">Kategori</span>
                                    <span class="font-medium text-gray-800" x-text="selected.kategori"></span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-3">
                                    <span class="text-gray-500">Jumlah Desain</span>
                                    <span class="font-medium text-gray-800" x-text="selected.jumlahDesain"></span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-3">
                                    <span class="text-gray-500">Dibuat</span>
                                    <span class="font-medium text-gray-800" x-text="selected.dibuat"></span>
                                </div>
                                <div>
                                    <span class="text-gray-500 block mb-1">Deskripsi</span>
                                    <p class="text-gray-700" x-text="selected.deskripsi"></p>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>