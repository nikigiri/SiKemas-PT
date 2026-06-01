<x-app-layout>

    {{-- Header --}}
    <div class="bg-gradient-to-r from-green-500 via-emerald-500 to-green-600">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-8 h-8 text-white"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                </div>

                <div>
                    <h1 class="text-3xl font-bold text-white">
                        Profile Settings
                    </h1>

                    <p class="text-green-100 mt-1">
                        Kelola informasi akun dan keamanan akun Anda
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen py-10">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Sidebar --}}
                <div class="lg:col-span-1">

                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">

                        <div class="flex flex-col items-center">

                            <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center">

                                <span class="text-3xl font-bold text-green-600">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>

                            </div>

                            <h3 class="mt-4 text-xl font-bold text-gray-800">
                                {{ Auth::user()->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                        <div class="mt-8 space-y-3">

                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-green-50 text-green-700">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>

                                <span class="font-medium">
                                    Informasi Profil
                                </span>

                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-blue-50 text-blue-700">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-1.5 0h12a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 4.5 19.5V12a1.5 1.5 0 0 1 1.5-1.5Z" />
                                </svg>

                                <span class="font-medium">
                                    Keamanan Akun
                                </span>

                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-red-50 text-red-700">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M6 7.5V6A6 6 0 0 1 18 6v1.5m-13.5 0h15m-13.5 0v10.125c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V7.5" />
                                </svg>

                                <span class="font-medium">
                                    Hapus Akun
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Update Profile --}}
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

                        <div class="px-8 py-5 border-b bg-gray-50">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 text-green-600"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="1.8">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>

                                </div>

                                <h3 class="text-lg font-bold text-gray-800">
                                    Informasi Profil
                                </h3>

                            </div>

                        </div>

                        <div class="p-8">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                    </div>

                    {{-- Update Password --}}
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

                        <div class="px-8 py-5 border-b bg-gray-50">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 text-blue-600"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="1.8">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-1.5 0h12a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 4.5 19.5V12a1.5 1.5 0 0 1 1.5-1.5Z" />
                                    </svg>

                                </div>

                                <h3 class="text-lg font-bold text-gray-800">
                                    Ubah Password
                                </h3>

                            </div>

                        </div>

                        <div class="p-8">
                            @include('profile.partials.update-password-form')
                        </div>

                    </div>

                    {{-- Delete Account --}}
                    <div class="bg-white rounded-3xl shadow-lg border border-red-100 overflow-hidden">

                        <div class="px-8 py-5 border-b bg-red-50">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 text-red-600"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="1.8">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M6 7.5V6A6 6 0 0 1 18 6v1.5m-13.5 0h15m-13.5 0v10.125c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V7.5" />
                                    </svg>

                                </div>

                                <h3 class="text-lg font-bold text-red-700">
                                    Hapus Akun
                                </h3>

                            </div>

                        </div>

                        <div class="p-8">
                            @include('profile.partials.delete-user-form')
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>