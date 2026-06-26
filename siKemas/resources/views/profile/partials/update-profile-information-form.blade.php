<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- Name --}}
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                    {{ __('Nama Lengkap') }}
                </label>
                <input id="name" name="name" type="text"
                       value="{{ old('name', $user->name) }}"
                       required autofocus autocomplete="name"
                       placeholder="Nama lengkap Anda"
                       class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                              text-sm text-slate-800 placeholder-slate-400
                              focus:outline-none focus:ring-2 focus:ring-green-500/40 focus:border-green-500
                              focus:bg-white transition duration-150">
                @if ($errors->get('name'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('name') }}</p>
                @endif
            </div>

            {{-- Nama Usaha --}}
            <div>
                <label for="nama_usaha" class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                    {{ __('Nama Usaha') }}
                </label>
                <input id="nama_usaha" name="nama_usaha" type="text"
                       value="{{ old('nama_usaha', $user->nama_usaha) }}"
                       required
                       placeholder="Nama usaha Anda"
                       class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                              text-sm text-slate-800 placeholder-slate-400
                              focus:outline-none focus:ring-2 focus:ring-green-500/40 focus:border-green-500
                              focus:bg-white transition duration-150">
                @if ($errors->get('nama_usaha'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('nama_usaha') }}</p>
                @endif
            </div>

        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                {{ __('Alamat Email') }}
            </label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   required autocomplete="username"
                   placeholder="email@domain.com"
                   class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                          text-sm text-slate-800 placeholder-slate-400
                          focus:outline-none focus:ring-2 focus:ring-green-500/40 focus:border-green-500
                          focus:bg-white transition duration-150">
            @if ($errors->get('email'))
                <p class="mt-1 text-xs text-red-500">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 flex items-start gap-2 px-3.5 py-2.5
                            bg-amber-50 border border-amber-200 rounded-xl">
                    <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                    <p class="text-xs text-amber-700 leading-relaxed">
                        {{ __('Email belum terverifikasi.') }}
                        <button form="send-verification"
                                class="underline font-semibold hover:text-amber-900 transition ml-1">
                            {{ __('Kirim ulang verifikasi') }}
                        </button>
                    </p>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-1.5 text-xs text-green-600 font-medium flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        {{ __('Link verifikasi telah dikirim.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- No. Telepon --}}
            <div>
                <label for="no_tlp" class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                    {{ __('No. Telepon') }}
                </label>
                <input id="no_tlp" name="no_tlp" type="text"
                       value="{{ old('no_tlp', $user->no_tlp) }}"
                       required
                       placeholder="08xxxxxxxxxx"
                       class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                              text-sm text-slate-800 placeholder-slate-400
                              focus:outline-none focus:ring-2 focus:ring-green-500/40 focus:border-green-500
                              focus:bg-white transition duration-150">
                @if ($errors->get('no_tlp'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('no_tlp') }}</p>
                @endif
            </div>

        </div>

        {{-- Alamat Usaha --}}
        <div>
            <label for="alamat_usaha" class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                {{ __('Alamat Usaha') }}
            </label>
            <textarea id="alamat_usaha" name="alamat_usaha" rows="3" required
                      placeholder="Jl. Contoh No. 1, Kota, Provinsi"
                      class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                             text-sm text-slate-800 placeholder-slate-400
                             focus:outline-none focus:ring-2 focus:ring-green-500/40 focus:border-green-500
                             focus:bg-white transition duration-150 resize-none">{{ old('alamat_usaha', $user->alamat_usaha) }}</textarea>
            @if ($errors->get('alamat_usaha'))
                <p class="mt-1 text-xs text-red-500">{{ $errors->first('alamat_usaha') }}</p>
            @endif
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5
                           bg-[#0f4c2a] hover:bg-[#0a3a1f] text-white
                           text-sm font-bold rounded-xl shadow-sm
                           hover:shadow-md transition duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 2500)"
                      class="inline-flex items-center gap-1.5 text-xs text-green-700 font-semibold
                             bg-green-50 border border-green-200 px-3 py-1.5 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Tersimpan!
                </span>
            @endif
        </div>

    </form>

</section>