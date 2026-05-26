<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Admin Dashboard 👋
                </h2>
                <p class="text-gray-500 mt-1">
                    Kelola seluruh data SiKemas dengan mudah dan cepat
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <!-- Total User -->
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-3xl p-6 shadow-lg hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm">
                                Total User
                            </p>

                            <h2 class="text-4xl font-bold text-white mt-2">
                                {{ $totalUser }}
                            </h2>
                        </div>

                        <div class="bg-white/20 p-4 rounded-2xl">
                            <span class="text-3xl">👥</span>
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-yellow-400 to-orange-400 rounded-3xl p-6 shadow-lg hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm">
                                Menunggu Approval
                            </p>

                            <h2 class="text-4xl font-bold text-white mt-2">
                                {{ $totalPending }}
                            </h2>
                        </div>

                        <div class="bg-white/20 p-4 rounded-2xl">
                            <span class="text-3xl">⏳</span>
                        </div>
                    </div>
                </div>

                <!-- KWT -->
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl p-6 shadow-lg hover:-translate-y-1 hover:shadow-2xl transition duration-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">
                                Total KWT
                            </p>

                            <h2 class="text-4xl font-bold text-white mt-2">
                                {{ $totalKwt }}
                            </h2>
                        </div>

                        <div class="bg-white/20 p-4 rounded-2xl">
                            <span class="text-3xl">🏘️</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Menu -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Quick Access
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Manage User -->
                    <a href="{{ route('admin.user.index') }}"
                        class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="flex items-center justify-between mb-5">
                            <div class="bg-indigo-100 p-4 rounded-2xl">
                                <span class="text-3xl">👥</span>
                            </div>

                            @if ($totalPending > 0)
                                <span
                                    class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-medium">
                                    {{ $totalPending }} Pending
                                </span>
                            @endif
                        </div>

                        <h3
                            class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition">
                            Manage User
                        </h3>

                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                            Approve, tolak, dan kelola user KWT
                        </p>
                    </a>

                    <!-- Manage KWT -->
                    <a href="{{ route('admin.kwt.index') }}"
                        class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="bg-green-100 p-4 rounded-2xl w-fit mb-5">
                            <span class="text-3xl">🏘️</span>
                        </div>

                        <h3
                            class="text-xl font-bold text-gray-800 group-hover:text-green-600 transition">
                            Manage KWT
                        </h3>

                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                            Tambah dan kelola data KWT
                        </p>
                    </a>

                    <!-- Jenis Kemasan -->
                    <a href="{{ route('admin.jenis-kemasan.index') }}"
                        class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="bg-orange-100 p-4 rounded-2xl w-fit mb-5">
                            <span class="text-3xl">📦</span>
                        </div>

                        <h3
                            class="text-xl font-bold text-gray-800 group-hover:text-orange-500 transition">
                            Jenis Kemasan
                        </h3>

                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                            Kelola jenis kemasan yang tersedia
                        </p>
                    </a>

                    <!-- Kategori -->
                    <a href="{{ route('admin.kategori.index') }}"
                        class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="bg-pink-100 p-4 rounded-2xl w-fit mb-5">
                            <span class="text-3xl">🏷️</span>
                        </div>

                        <h3
                            class="text-xl font-bold text-gray-800 group-hover:text-pink-500 transition">
                            Kategori Produk
                        </h3>

                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                            Kelola kategori produk
                        </p>
                    </a>

                    <!-- Tambah Admin -->
                    <a href="{{ route('admin.user.create-admin') }}"
                        class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="bg-purple-100 p-4 rounded-2xl w-fit mb-5">
                            <span class="text-3xl">➕</span>
                        </div>

                        <h3
                            class="text-xl font-bold text-gray-800 group-hover:text-purple-500 transition">
                            Tambah Admin
                        </h3>

                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                            Tambahkan admin baru
                        </p>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>