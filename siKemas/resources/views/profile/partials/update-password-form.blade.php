<section>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <label for="update_password_current_password"
                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Password Saat Ini') }}
            </label>
            <div class="relative">
                <input id="update_password_current_password"
                       name="current_password" type="password"
                       autocomplete="current-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                              text-sm text-gray-800 placeholder-gray-400
                              focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent
                              focus:bg-white transition duration-200"
                       placeholder="••••••••">
            </div>
            @if ($errors->updatePassword->get('current_password'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        {{-- New Password --}}
        <div>
            <label for="update_password_password"
                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Password Baru') }}
            </label>
            <input id="update_password_password"
                   name="password" type="password"
                   autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                          text-sm text-gray-800 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent
                          focus:bg-white transition duration-200"
                   placeholder="••••••••">
            @if ($errors->updatePassword->get('password'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="update_password_password_confirmation"
                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Konfirmasi Password Baru') }}
            </label>
            <input id="update_password_password_confirmation"
                   name="password_confirmation" type="password"
                   autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                          text-sm text-gray-800 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent
                          focus:bg-white transition duration-200"
                   placeholder="••••••••">
            @if ($errors->updatePassword->get('password_confirmation'))
                <p class="mt-1.5 text-xs text-red-500">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-4 pt-1">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5
                           bg-indigo-600 hover:bg-indigo-700 text-white
                           text-sm font-bold rounded-full shadow-md
                           hover:shadow-lg hover:scale-[1.02] transition duration-200">
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
                      class="inline-flex items-center gap-1.5 text-xs text-indigo-700 font-semibold
                             bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Password diperbarui!
                </span>
            @endif
        </div>

    </form>

</section>