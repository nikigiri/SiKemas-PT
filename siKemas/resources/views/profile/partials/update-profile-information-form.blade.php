<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Nama Lengkap') }}
            </label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $user->name) }}"
                   required autofocus autocomplete="name"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                          text-sm text-gray-800 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent
                          focus:bg-white transition duration-200">
            @if ($errors->get('name'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('name') }}</p>
            @endif
        </div>

        {{-- Nama Usaha --}}
        <div>
            <label for="nama_usaha" class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Nama Usaha') }}
            </label>
            <input id="nama_usaha" name="nama_usaha" type="text"
                   value="{{ old('nama_usaha', $user->nama_usaha) }}"
                   required
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                          text-sm text-gray-800 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent
                          focus:bg-white transition duration-200">
            @if ($errors->get('nama_usaha'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('nama_usaha') }}</p>
            @endif
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Email') }}
            </label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   required autocomplete="username"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                          text-sm text-gray-800 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent
                          focus:bg-white transition duration-200">
            @if ($errors->get('email'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-xl">
                    <p class="text-xs text-yellow-700">
                        {{ __('Email belum terverifikasi.') }}
                        <button form="send-verification"
                                class="underline font-semibold hover:text-yellow-900 transition">
                            {{ __('Kirim ulang email verifikasi.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-xs text-green-600 font-medium">
                            {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- No. Telepon --}}
        <div>
            <label for="no_tlp" class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('No. Telepon') }}
            </label>
            <input id="no_tlp" name="no_tlp" type="text"
                   value="{{ old('no_tlp', $user->no_tlp) }}"
                   required
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                          text-sm text-gray-800 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent
                          focus:bg-white transition duration-200">
            @if ($errors->get('no_tlp'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('no_tlp') }}</p>
            @endif
        </div>

        {{-- Alamat Usaha --}}
        <div>
            <label for="alamat_usaha" class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Alamat Usaha') }}
            </label>
            <textarea id="alamat_usaha" name="alamat_usaha" rows="3" required
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                             text-sm text-gray-800 placeholder-gray-400
                             focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent
                             focus:bg-white transition duration-200 resize-none">{{ old('alamat_usaha', $user->alamat_usaha) }}</textarea>
            @if ($errors->get('alamat_usaha'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('alamat_usaha') }}</p>
            @endif
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-4 pt-1">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5
                           bg-green-700 hover:bg-green-800 text-white
                           text-sm font-bold rounded-full shadow-md
                           hover:shadow-lg hover:scale-[1.02] transition duration-200">
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