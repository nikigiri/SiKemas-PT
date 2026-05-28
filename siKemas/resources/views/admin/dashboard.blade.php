<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Admin Dashboard
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh data SiKemas dengan mudah dan cepat
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ===== STATISTIK ===== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">

                {{-- Total User --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl p-6 shadow-lg shadow-indigo-200 hover:-translate-y-1 hover:shadow-xl hover:shadow-indigo-200 transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold tracking-widest uppercase text-indigo-200">
                                Total User
                            </p>
                            <h2 class="text-4xl font-bold text-white mt-2 tracking-tight">
                                {{ $totalUser }}
                            </h2>
                        </div>
                        <div class="bg-white/15 p-3 rounded-xl">
                            {{-- Heroicon: users --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                    </div>
                    {{-- Decorative circle --}}
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full bg-white/5"></div>
                </div>

                {{-- Menunggu Approval --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl p-6 shadow-lg shadow-amber-200 hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-200 transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold tracking-widest uppercase text-amber-100">
                                Menunggu Approval
                            </p>
                            <h2 class="text-4xl font-bold text-white mt-2 tracking-tight">
                                {{ $totalPending }}
                            </h2>
                        </div>
                        <div class="bg-white/15 p-3 rounded-xl">
                            {{-- Heroicon: clock --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full bg-white/5"></div>
                </div>

                {{-- Total KWT --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-green-700 rounded-2xl p-6 shadow-lg shadow-emerald-200 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-200 transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold tracking-widest uppercase text-emerald-200">
                                Total KWT
                            </p>
                            <h2 class="text-4xl font-bold text-white mt-2 tracking-tight">
                                {{ $totalKwt }}
                            </h2>
                        </div>
                        <div class="bg-white/15 p-3 rounded-xl">
                            {{-- Heroicon: building-office-2 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full bg-white/5"></div>
                </div>

            </div>

            {{-- ===== QUICK ACCESS ===== --}}
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 whitespace-nowrap">
                        Quick Access
                    </h3>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- Manage User --}}
                    <a href="{{ route('admin.user.index') }}"
                        class="group relative bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg hover:border-indigo-100 transition-all duration-300">

                        <div class="flex items-start justify-between mb-5">
                            <div class="bg-indigo-50 p-3 rounded-xl">
                                {{-- Heroicon: user-group --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                            </div>

                            @if ($totalPending > 0)
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                    {{ $totalPending }} Pending
                                </span>
                            @endif
                        </div>

                        <h3 class="text-base font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors duration-200">
                            Manage User
                        </h3>
                        <p class="text-sm text-gray-400 mt-1.5 leading-relaxed">
                            Approve, tolak, dan kelola user KWT
                        </p>
                    </a>

                    {{-- Manage KWT --}}
                    <a href="{{ route('admin.kwt.index') }}"
                        class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg hover:border-emerald-100 transition-all duration-300">

                        <div class="bg-emerald-50 p-3 rounded-xl w-fit mb-5">
                            {{-- Heroicon: building-office-2 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>

                        <h3 class="text-base font-semibold text-gray-800 group-hover:text-emerald-600 transition-colors duration-200">
                            Manage KWT
                        </h3>
                        <p class="text-sm text-gray-400 mt-1.5 leading-relaxed">
                            Tambah dan kelola data KWT
                        </p>
                    </a>

                    {{-- Jenis Kemasan --}}
                    <a href="{{ route('admin.jenis-kemasan.index') }}"
                        class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg hover:border-amber-100 transition-all duration-300">

                        <div class="bg-amber-50 p-3 rounded-xl w-fit mb-5">
                            {{-- Heroicon: archive-box --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>

                        <h3 class="text-base font-semibold text-gray-800 group-hover:text-amber-600 transition-colors duration-200">
                            Jenis Kemasan
                        </h3>
                        <p class="text-sm text-gray-400 mt-1.5 leading-relaxed">
                            Kelola jenis kemasan yang tersedia
                        </p>
                    </a>

                    {{-- Kategori Produk --}}
                    <a href="{{ route('admin.kategori.index') }}"
                        class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg hover:border-pink-100 transition-all duration-300">

                        <div class="bg-pink-50 p-3 rounded-xl w-fit mb-5">
                            {{-- Heroicon: tag --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>

                        <h3 class="text-base font-semibold text-gray-800 group-hover:text-pink-500 transition-colors duration-200">
                            Kategori Produk
                        </h3>
                        <p class="text-sm text-gray-400 mt-1.5 leading-relaxed">
                            Kelola kategori produk
                        </p>
                    </a>

                    {{-- Tambah Admin --}}
                    <a href="{{ route('admin.user.create-admin') }}"
                        class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg hover:border-violet-100 transition-all duration-300">

                        <div class="bg-violet-50 p-3 rounded-xl w-fit mb-5">
                            {{-- Heroicon: user-plus --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                        </div>

                        <h3 class="text-base font-semibold text-gray-800 group-hover:text-violet-600 transition-colors duration-200">
                            Tambah Admin
                        </h3>
                        <p class="text-sm text-gray-400 mt-1.5 leading-relaxed">
                            Tambahkan admin baru
                        </p>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>