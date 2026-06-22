<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            
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
                        Manage User
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola approval dan data user KWT
                    </p>
                </div>
            </div>

            <!-- Search -->
            <div class="relative w-full md:w-80">
                <input type="text"
                    placeholder="Cari user..."
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    <p class="font-medium">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div
                    class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-3xl p-6 shadow-lg text-white">
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm">
                                Total User
                            </p>

                            <h2 class="text-4xl font-bold mt-2">
                                {{ $users->count() }}
                            </h2>
                        </div>

                        <div class="bg-white/20 p-4 rounded-2xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-3xl p-6 shadow-lg text-white">
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm">
                                Pending
                            </p>

                            <h2 class="text-4xl font-bold mt-2">
                                {{ $users->where('status', 'pending')->count() }}
                            </h2>
                        </div>

                        <div class="bg-white/20 p-4 rounded-2xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl p-6 shadow-lg text-white">
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">
                                Approved
                            </p>

                            <h2 class="text-4xl font-bold mt-2">
                                {{ $users->where('status', 'approved')->count() }}
                            </h2>
                        </div>

                        <div class="bg-white/20 p-4 rounded-2xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Table -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                <!-- Table Header -->
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            Daftar User
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Semua data user yang terdaftar di sistem
                        </p>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">
                                    User
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Email
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    KWT
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($users as $user)
                                <tr class="hover:bg-green-50/40 transition">

                                    <!-- User -->
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">

                                            <div
                                                class="w-12 h-12 rounded-2xl bg-gradient-to-r from-green-400 to-emerald-500 text-white flex items-center justify-center font-bold text-lg shadow">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $user->name }}
                                                </p>

                                                <p class="text-xs text-gray-400 mt-1">
                                                    {{ $user->nama_usaha }}
                                                </p>
                                            </div>

                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $user->email }}
                                    </td>

                                    <!-- KWT -->
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $user->kwt ? $user->kwt->nama_kwt : '-' }}
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-5">
                                        <span
                                            class="px-4 py-2 rounded-full text-xs font-semibold
                                            {{ $user->status == 'approved'
                                                ? 'bg-green-100 text-green-700'
                                                : ($user->status == 'rejected'
                                                    ? 'bg-red-100 text-red-700'
                                                    : 'bg-yellow-100 text-yellow-700') }}">

                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </td>

                                    <!-- Action -->
                                    <td class="px-6 py-5">
                                        <div class="flex flex-wrap gap-2 items-start">

                                            @if ($user->status == 'pending')

                                                <form method="POST" action="{{ auth()->user()->hasRole('superadmin') ? route('admin.user.approve', $user->id) : route('kwt-admin.user.approve', $user->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-500 text-white rounded-xl text-xs font-medium hover:bg-green-600 transition shadow">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                        Approve
                                                    </button>
                                                </form>

                                                <form method="POST"
                                                    action="{{ auth()->user()->hasRole('superadmin') ? route('admin.user.reject', $user->id) : route('kwt-admin.user.reject', $user->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-500 text-white rounded-xl text-xs font-medium hover:bg-red-600 transition shadow">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                        </svg>
                                                        Tolak
                                                    </button>
                                                </form>

                                            @endif

                                            {{-- Dropdown Aksi --}}
                                            <div class="relative inline-block text-left" x-data="{ open: false }">
                                                <button @click="open = !open" @click.away="open = false" type="button"
                                                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-xs font-medium hover:bg-gray-200 transition">
                                                    Aksi
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>

                                                <div x-show="open" x-cloak
                                                    class="absolute right-0 mt-2 w-44 bg-white border border-gray-100 rounded-2xl shadow-lg z-20 overflow-hidden">

                                                    <a href="{{ auth()->user()->hasRole('superadmin') ? route('admin.user.history', $user->id) : route('kwt-admin.user.history', $user->id) }}"
                                                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-indigo-700 hover:bg-indigo-50">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        Aktivitas
                                                    </a>

                                                    <a href="{{ auth()->user()->hasRole('superadmin') ? route('admin.user.produk', $user->id) : route('kwt-admin.user.produk', $user->id) }}"
                                                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-blue-700 hover:bg-blue-50">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375A1.125 1.125 0 0 0 2.25 4.875v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                        </svg>
                                                        Produk
                                                    </a>

                                                    @if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin'))
                                                    <form method="POST"
                                                        action="{{ auth()->user()->hasRole('superadmin') ? route('admin.user.destroy', $user->id) : route('kwt-admin.user.destroy', $user->id) }}"
                                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                </svg>
                                            </div>

                                            <h3 class="text-lg font-semibold text-gray-700">
                                                Belum Ada User
                                            </h3>

                                            <p class="text-sm text-gray-400 mt-1">
                                                Data user akan muncul di sini
                                            </p>
                                        </div>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>