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
                        Jenis Kemasan
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
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
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

                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>

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

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                                </svg>
                                Edit
                            </a>

                            <!-- Delete -->
                            <form method="POST"
                                action="{{ route('admin.jenis-kemasan.destroy', $kemasan->id) }}"
                                onsubmit="return confirm('Yakin hapus kemasan ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-red-100 text-red-700 rounded-2xl hover:bg-red-200 transition text-sm font-medium">

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Hapus
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
                                class="w-28 h-28 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-6">

                                <svg class="w-14 h-14 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>

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