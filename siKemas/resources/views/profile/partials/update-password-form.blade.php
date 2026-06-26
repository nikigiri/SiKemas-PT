<section>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <label for="update_password_current_password"
                   class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                {{ __('Password Saat Ini') }}
            </label>
            <input id="update_password_current_password"
                   name="current_password" type="password"
                   autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                          text-sm text-slate-800
                          focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500
                          focus:bg-white transition duration-150">
            @if ($errors->updatePassword->get('current_password'))
                <p class="mt-1 text-xs text-red-500">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- New Password --}}
            <div>
                <label for="update_password_password"
                       class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                    {{ __('Password Baru') }}
                </label>
                <input id="update_password_password"
                       name="password" type="password"
                       autocomplete="new-password"
                       placeholder="••••••••"
                       class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                              text-sm text-slate-800
                              focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500
                              focus:bg-white transition duration-150">
                @if ($errors->updatePassword->get('password'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->updatePassword->first('password') }}</p>
                @endif
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="update_password_password_confirmation"
                       class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">
                    {{ __('Konfirmasi Password Baru') }}
                </label>
                <input id="update_password_password_confirmation"
                       name="password_confirmation" type="password"
                       autocomplete="new-password"
                       placeholder="••••••••"
                       class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200
                              text-sm text-slate-800
                              focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500
                              focus:bg-white transition duration-150">
                @if ($errors->updatePassword->get('password_confirmation'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                @endif
            </div>

        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5
                           bg-blue-600 hover:bg-blue-700 text-white
                           text-sm font-bold rounded-xl shadow-sm
                           hover:shadow-md transition duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                </svg>
                {{ __('Perbarui Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 2500)"
                      class="inline-flex items-center gap-1.5 text-xs text-blue-700 font-semibold
                             bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Password diperbarui!
                </span>
            @endif
        </div>

    </form>

</section>