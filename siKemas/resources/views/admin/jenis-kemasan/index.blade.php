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
                        Jenis Kemasan 📦
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola semua jenis kemasan produk
                    </p>
                </div>

            </div>

            <!-- Search -->
            <div class="relative w-full md:w-80">

                <input type="text"
                    placeholder="Cari kemasan..."
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
                            Daftar Jenis Kemasan
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Semua jenis kemasan yang tersedia di sistem
                        </p>
                    </div>

                    <a href="{{ route('admin.jenis-kemasan.create') }}"
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

                        Tambah Kemasan
                    </a>

                </div>

            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($jenisKemasans as $kemasan)

                    <div
                        class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                        <!-- Content -->
                        <div class="p-6">

                            <div class="flex items-start justify-between">

                                <!-- Icon -->
                                <div
                                    class="w-16 h-16 rounded-2xl bg-gradient-to-r from-orange-400 to-amber-500 flex items-center justify-center shadow-lg overflow-hidden">

                                    @if ($kemasan->ikon_kemasan)

                                        <img src="{{ asset($kemasan->ikon_kemasan) }}"
                                            alt="{{ $kemasan->nama_kemasan }}"
                                            class="w-10 h-10 object-contain">

                                    @else

                                        <span class="text-3xl text-white">
                                            📦
                                        </span>

                                    @endif

                                </div>

                                <!-- Badge -->
                                <span
                                    class="bg-orange-100 text-orange-700 text-xs px-4 py-2 rounded-2xl font-semibold">

                                    Kemasan
                                </span>

                            </div>

                            <!-- Text -->
                            <div class="mt-5">

                                <h3 class="text-xl font-bold text-gray-800">
                                    {{ $kemasan->nama_kemasan }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-3 leading-relaxed min-h-[70px]">
                                    {{ $kemasan->deskripsi_kemasan ?? 'Tidak ada deskripsi kemasan.' }}
                                </p>

                            </div>

                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100"></div>

                        <!-- Action -->
                        <div class="p-5 flex items-center gap-3">

                            <!-- Edit -->
                            <a href="{{ route('admin.jenis-kemasan.edit', $kemasan->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-indigo-100 text-indigo-700 rounded-2xl hover:bg-indigo-200 transition text-sm font-medium">

                                ✏️ Edit
                            </a>

                            <!-- Delete -->
                            <form method="POST"
                                action="{{ route('admin.jenis-kemasan.destroy', $kemasan->id) }}"
                                onsubmit="return confirm('Yakin hapus kemasan ini?')">

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

                                📦
                            </div>

                            <h3 class="text-2xl font-bold text-gray-700">
                                Belum Ada Jenis Kemasan
                            </h3>

                            <p class="text-gray-400 mt-2">
                                Data jenis kemasan akan muncul di sini
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>
</x-app-layout>