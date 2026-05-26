<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- Left -->
            <div class="flex items-center gap-3">

                <a href="{{ route('admin.dashboard') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow hover:bg-gray-100 transition">

                    <svg class="w-5 h-5 text-gray-600"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>

                </a>

                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        Kategori Produk 🏷️
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola kategori produk SiKemas
                    </p>
                </div>

            </div>

            <!-- Search -->
            <div class="relative w-full md:w-80">

                <input type="text"
                    placeholder="Cari kategori..."
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-green-400 focus:outline-none">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-gray-400 absolute left-4 top-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35m1.85-5.65a7.5 7.5 0 11-15 0a7.5 7.5 0 0115 0z" />
                </svg>

            </div>

        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Alert -->
            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-2xl shadow-sm">

                    <div class="w-10 h-10 rounded-full bg-green-200 flex items-center justify-center">
                        ✅
                    </div>

                    <p class="font-medium">
                        {{ session('success') }}
                    </p>

                </div>
            @endif

            <!-- Header Card -->
            <div
                class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 mb-8">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            Daftar Kategori
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Semua kategori produk yang tersedia
                        </p>
                    </div>

                    <a href="{{ route('admin.kategori.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow hover:shadow-xl hover:scale-105 transition text-sm font-medium">

                        <svg class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                        Tambah Kategori
                    </a>

                </div>

            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($kategoris as $kategori)

                    <div
                        class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                        <!-- Content -->
                        <div class="p-6">

                            <div class="flex items-start justify-between">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-gradient-to-r from-pink-400 to-rose-500 flex items-center justify-center text-white shadow-lg">

                                    🏷️
                                </div>

                                <span
                                    class="bg-pink-100 text-pink-700 text-xs px-4 py-2 rounded-2xl font-semibold">
                                    Kategori
                                </span>

                            </div>

                            <div class="mt-5">

                                <h3 class="text-xl font-bold text-gray-800">
                                    {{ $kategori->nama_kategori }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-3 leading-relaxed min-h-[60px]">
                                    {{ $kategori->deskripsi ?? 'Tidak ada deskripsi kategori.' }}
                                </p>

                            </div>

                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100"></div>

                        <!-- Action -->
                        <div class="p-5 flex items-center gap-3">

                            <!-- Edit -->
                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-indigo-100 text-indigo-700 rounded-2xl hover:bg-indigo-200 transition text-sm font-medium">

                                ✏️ Edit
                            </a>

                            <!-- Delete -->
                            <form method="POST"
                                action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                                onsubmit="return confirm('Yakin hapus kategori ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-red-100 text-red-700 rounded-2xl hover:bg-red-200 transition text-sm font-medium">

                                    🗑️ Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <!-- Empty -->
                    <div class="col-span-full">

                        <div
                            class="bg-white rounded-3xl shadow-lg border border-gray-100 px-6 py-16 text-center">

                            <div
                                class="w-28 h-28 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-6xl mb-6">

                                🏷️
                            </div>

                            <h3 class="text-2xl font-bold text-gray-700">
                                Belum Ada Kategori
                            </h3>

                            <p class="text-gray-400 mt-2">
                                Data kategori akan muncul di sini
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>
</x-app-layout>