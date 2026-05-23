<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.user.index') }}"
               class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-semibold text-gray-800">File History</h1>
                <p class="text-sm text-gray-500">{{ $user->name }} &middot; {{ $user->email }}</p>
            </div>
        </div>

        {{-- Timeline --}}
        @if($histories->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                <p class="text-sm">Belum ada aktivitas</p>
            </div>
        @else
            <div class="relative">
                {{-- Garis vertikal --}}
                <div class="absolute left-5 top-0 bottom-0 w-px bg-gray-200"></div>

                <div class="space-y-6">
                    @foreach($histories as $item)
                        <div class="relative flex gap-4">

                            {{-- Icon --}}
                            <div class="relative z-10 flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center
                                @if($item['type'] === 'produk') bg-blue-100 text-blue-600
                                @elseif($item['type'] === 'desain') bg-purple-100 text-purple-600
                                @else bg-green-100 text-green-600 @endif">

                                @if($item['type'] === 'produk')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                                    </svg>
                                @elseif($item['type'] === 'desain')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                    </svg>
                                @endif
                            </div>

                            {{-- Konten --}}
                            <div class="flex-1 bg-white border border-gray-100 rounded-lg px-4 py-3 shadow-sm">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <span class="text-xs font-medium
                                            @if($item['type'] === 'produk') text-blue-600
                                            @elseif($item['type'] === 'desain') text-purple-600
                                            @else text-green-600 @endif">
                                            {{ $item['action'] }}
                                        </span>
                                        <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $item['title'] }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $item['description'] }}</p>
                                    </div>
                                    <span class="text-xs text-gray-400 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item['date'])->diffForHumans() }}
                                    </span>
                                </div>

                                @if(isset($item['status']))
                                    <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full
                                        @if($item['status'] === 'selesai') bg-green-100 text-green-700
                                        @elseif($item['status'] === 'proses') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-500 @endif">
                                        {{ ucfirst($item['status']) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>