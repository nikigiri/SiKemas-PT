<x-app-layout>

    {{-- ===== TOP HERO STRIP ===== --}}
    <div class="relative overflow-hidden bg-[#0f4c2a]">

        {{-- subtle dot grid background --}}
        <div class="absolute inset-0 opacity-10"
             style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px);
                    background-size: 24px 24px;"></div>

        {{-- accent blob --}}
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-green-400/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-10 flex items-end gap-6">

            {{-- avatar initial --}}
            <div class="shrink-0 w-20 h-20 rounded-2xl bg-green-500/30 border border-green-400/40
                        flex items-center justify-center">
                <span class="text-3xl font-black text-white tracking-tight select-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
            </div>

            <div class="pb-0.5">
                <p class="text-green-300 text-xs font-semibold uppercase tracking-widest mb-1">
                    Pengaturan Akun
                </p>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                    {{ Auth::user()->name }}
                </h1>
                <p class="text-green-200/70 text-sm mt-0.5">
                    {{ Auth::user()->email }}
                </p>
            </div>

        </div>

        {{-- thin colored bar at bottom --}}
        <div class="h-1 w-full bg-gradient-to-r from-green-400 via-emerald-300 to-teal-400"></div>
    </div>

    {{-- ===== BODY ===== --}}
    <div class="bg-slate-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

            {{-- ---- SECTION 1: INFO PROFIL ---- --}}
            <div class="group flex flex-col lg:flex-row rounded-2xl overflow-hidden
                        border border-slate-200 bg-white shadow-sm
                        hover:shadow-md transition-shadow duration-300">

                {{-- left label strip --}}
                <div class="lg:w-56 shrink-0 bg-slate-50 border-b lg:border-b-0 lg:border-r border-slate-200
                            flex lg:flex-col gap-4 items-start p-6">
                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-sm text-slate-800">Informasi Profil</p>
                        <p class="text-xs text-slate-400 mt-0.5 leading-snug hidden lg:block">
                            Nama, usaha, kontak, dan alamat Anda.
                        </p>
                    </div>
                </div>

                {{-- right form --}}
                <div class="flex-1 p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </div>

            {{-- ---- SECTION 2: UBAH PASSWORD ---- --}}
            <div class="flex flex-col lg:flex-row rounded-2xl overflow-hidden
                        border border-slate-200 bg-white shadow-sm
                        hover:shadow-md transition-shadow duration-300">

                {{-- left label strip --}}
                <div class="lg:w-56 shrink-0 bg-slate-50 border-b lg:border-b-0 lg:border-r border-slate-200
                            flex lg:flex-col gap-4 items-start p-6">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-sm text-slate-800">Ubah Password</p>
                        <p class="text-xs text-slate-400 mt-0.5 leading-snug hidden lg:block">
                            Perbarui kata sandi akun Anda secara berkala.
                        </p>
                    </div>
                </div>

                {{-- right form --}}
                <div class="flex-1 p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>

            </div>

            {{-- ---- SECTION 3: HAPUS AKUN ---- --}}
            <div class="flex flex-col lg:flex-row rounded-2xl overflow-hidden
                        border border-red-200 bg-white shadow-sm
                        hover:shadow-md transition-shadow duration-300">

                {{-- left label strip --}}
                <div class="lg:w-56 shrink-0 bg-red-50 border-b lg:border-b-0 lg:border-r border-red-200
                            flex lg:flex-col gap-4 items-start p-6">
                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-sm text-red-700">Hapus Akun</p>
                        <p class="text-xs text-red-400 mt-0.5 leading-snug hidden lg:block">
                            Tindakan permanen — tidak bisa dibatalkan.
                        </p>
                    </div>
                </div>

                {{-- right form --}}
                <div class="flex-1 p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>

        </div>
    </div>

</x-app-layout>