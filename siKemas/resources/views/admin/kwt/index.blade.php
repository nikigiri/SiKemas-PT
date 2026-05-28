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
                        Manage KWT
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data Kelompok Wanita Tani
                    </p>
                </div>

            </div>

            <!-- Search -->
            <div class="relative w-full md:w-80">

                <input type="text"
                    placeholder="Cari KWT..."
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
                            Daftar KWT
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Semua data kelompok wanita tani yang terdaftar
                        </p>
                    </div>

                    <a href="{{ route('admin.kwt.create') }}"
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

                        Tambah KWT
                    </a>

                </div>

            </div>

            <!-- KWT List -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                @forelse ($kwts as $kwt)

                    <div
                        class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                        <!-- Top -->
                        <div class="p-6">

                            <div class="flex items-start justify-between gap-4">

                                <!-- Left -->
                                <div class="flex gap-4">

                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gradient-to-r from-green-400 to-emerald-500 flex items-center justify-center text-white shadow-lg flex-shrink-0">

                                        <svg class="w-7 h-7"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 3C8 3 4 7 4 11c0 5 8 10 8 10s8-5 8-10c0-4-4-8-8-8z" />

                                            <circle cx="12"
                                                cy="11"
                                                r="2.5"
                                                stroke-linecap="round" />
                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-xl font-bold text-gray-800">
                                            {{ $kwt->nama_kwt }}
                                        </h3>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Nomor KWT :
                                            {{ $kwt->no_kwt ?? '-' }}
                                        </p>

                                    </div>

                                </div>

                                <!-- User Count -->
                                <div
                                    class="bg-green-100 text-green-700 px-4 py-2 rounded-2xl text-sm font-semibold whitespace-nowrap">

                                    {{ $kwt->users_count }} User
                                </div>

                            </div>

                            <!-- Info -->
                            <div class="mt-6 space-y-4">

                                <!-- Desa -->
                                <div class="flex items-start gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-500">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-400">
                                            Desa
                                        </p>

                                        <p class="text-sm font-medium text-gray-700">
                                            {{ $kwt->desa ?? '-' }}
                                        </p>
                                    </div>

                                </div>

                                <!-- Alamat -->
                                <div class="flex items-start gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-500">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-400">
                                            Alamat
                                        </p>

                                        <p class="text-sm font-medium text-gray-700 leading-relaxed">
                                            {{ $kwt->alamat_kwt ?? '-' }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100"></div>

                        <!-- Actions -->
                        <div class="p-5 flex flex-wrap gap-3">

                            <!-- Aktivitas -->
                            <a href="{{ route('admin.kwt.user-list', $kwt->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition text-sm font-medium">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125z" />
                                </svg>

                                Lihat Aktivitas
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('admin.kwt.edit', $kwt->id) }}"
                                class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-indigo-100 text-indigo-700 rounded-2xl hover:bg-indigo-200 transition text-sm font-medium">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                                </svg>
                                Edit
                            </a>

                            <!-- Delete -->
                            <form method="POST"
                                action="{{ route('admin.kwt.destroy', $kwt->id) }}"
                                onsubmit="return confirm('Yakin hapus KWT ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-red-100 text-red-700 rounded-2xl hover:bg-red-200 transition text-sm font-medium">

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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                </svg>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-700">
                                Belum Ada KWT
                            </h3>

                            <p class="text-gray-400 mt-2">
                                Data kelompok wanita tani akan muncul di sini
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>
</x-app-layout>