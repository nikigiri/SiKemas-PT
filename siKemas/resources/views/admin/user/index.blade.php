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
                        Manage User 👥
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
                        ✅
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

                        <div class="bg-white/20 p-4 rounded-2xl text-3xl">
                            👥
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

                        <div class="bg-white/20 p-4 rounded-2xl text-3xl">
                            ⏳
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

                        <div class="bg-white/20 p-4 rounded-2xl text-3xl">
                            ✅
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
                                        <div class="flex flex-wrap gap-2">

                                            @if ($user->status == 'pending')

                                                <form method="POST"
                                                    action="{{ route('admin.user.approve', $user->id) }}">
                                                    @csrf

                                                    <button type="submit"
                                                        class="px-4 py-2 bg-green-500 text-white rounded-xl text-xs font-medium hover:bg-green-600 transition shadow">
                                                        Approve
                                                    </button>
                                                </form>

                                                <form method="POST"
                                                    action="{{ route('admin.user.reject', $user->id) }}">
                                                    @csrf

                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-500 text-white rounded-xl text-xs font-medium hover:bg-red-600 transition shadow">
                                                        Tolak
                                                    </button>
                                                </form>

                                            @endif

                                            <form method="POST"
                                                action="{{ route('admin.user.destroy', $user->id) }}"
                                                onsubmit="return confirm('Yakin hapus user ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-xs font-medium hover:bg-gray-200 transition">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center text-5xl mb-4">
                                                📭
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