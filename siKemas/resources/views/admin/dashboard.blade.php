<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalUser }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total User</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-500">{{ $totalPending }}</p>
                    <p class="text-sm text-gray-500 mt-1">Menunggu Approval</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $totalKwt }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total KWT</p>
                </div>
            </div>

            <hr class="border-t border-gray-300 my-4" />

            <!-- Menu Admin -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <a href="{{ route('admin.user.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-800 text-lg">👥 Manage User</h3>
                    <p class="text-sm text-gray-500 mt-1">Approve, tolak, dan kelola user KWT</p>
                    @if ($totalPending > 0)
                        <span class="mt-2 inline-block text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">
                            {{ $totalPending }} menunggu approval
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.kwt.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-800 text-lg">🏘️ Manage KWT</h3>
                    <p class="text-sm text-gray-500 mt-1">Tambah dan kelola data KWT</p>
                </a>

                <a href="{{ route('admin.jenis-kemasan.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-800 text-lg">📦 Jenis Kemasan</h3>
                    <p class="text-sm text-gray-500 mt-1">Kelola jenis kemasan yang tersedia</p>
                </a>

                <a href="{{ route('admin.kategori.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-800 text-lg">🏷️ Kategori Produk</h3>
                    <p class="text-sm text-gray-500 mt-1">Kelola kategori produk</p>
                </a>

                <a href="{{ route('admin.user.create-admin') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-800 text-lg">➕ Tambah Admin</h3>
                    <p class="text-sm text-gray-500 mt-1">Tambahkan admin baru</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>