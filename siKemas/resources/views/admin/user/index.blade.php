<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}"
            class="text-gray-500 hover:text-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 px-4 py-2 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- <div class="mb-4 flex justify-between items-center">
                <h3 class="text-gray-700 font-semibold">Daftar User KWT</h3>
                <a href="{{ route('admin.user.create-admin') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                    + Tambah Admin
                </a>
            </div> -->

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">KWT</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->nama_usaha }}</p>
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $user->kwt ? $user->kwt->nama_kwt : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs
                                        {{ $user->status == 'approved' ? 'bg-green-100 text-green-600' :
                                           ($user->status == 'rejected' ? 'bg-red-100 text-red-600' :
                                           'bg-yellow-100 text-yellow-600') }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        @if ($user->status == 'pending')
                                            <form method="POST" action="{{ route('admin.user.approve', $user->id) }}">
                                                @csrf
                                                <button type="submit"
                                                        class="px-3 py-1 bg-green-600 text-white rounded text-xs hover:bg-green-700">
                                                    Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.user.reject', $user->id) }}">
                                                @csrf
                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}"
                                              onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-xs hover:bg-gray-300">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                                    Belum ada user terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>