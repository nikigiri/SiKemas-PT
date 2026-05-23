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
                {{ __('Jenis Kemasan') }}
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

            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-gray-700 font-semibold">Daftar Jenis Kemasan</h3>
                <a href="{{ route('admin.jenis-kemasan.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                    + Tambah Kemasan
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">Ikon</th>
                            <th class="px-4 py-3 text-left">Nama Kemasan</th>
                            <th class="px-4 py-3 text-left">Deskripsi</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($jenisKemasans as $kemasan)
                            <tr>
                                <td class="px-4 py-3">
                                    @if ($kemasan->ikon_kemasan)
                                        <img src="{{ asset($kemasan->ikon_kemasan) }}"
                                             alt="{{ $kemasan->nama_kemasan }}"
                                             class="w-10 h-10 object-contain">
                                    @else
                                        <span class="text-gray-400 text-xs">No Ikon</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $kemasan->nama_kemasan }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $kemasan->deskripsi_kemasan ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.jenis-kemasan.edit', $kemasan->id) }}"
                                           class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded text-xs hover:bg-indigo-200">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.jenis-kemasan.destroy', $kemasan->id) }}"
                                              onsubmit="return confirm('Yakin hapus kemasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-100 text-red-700 rounded text-xs hover:bg-red-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                                    Belum ada jenis kemasan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>