<section>

    {{-- Warning strip --}}
    <div class="flex items-start gap-3 p-4 bg-red-50 border border-red-200 rounded-xl mb-5">
        <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
             stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
        </svg>
        <p class="text-xs text-red-700 leading-relaxed">
            {{ __('Setelah akun dihapus, semua data dan sumber daya akan dihapus secara permanen. Pastikan Anda telah mengunduh semua data yang ingin disimpan sebelum melanjutkan.') }}
        </p>
    </div>

    {{-- Trigger button --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-5 py-2.5
               bg-white border border-red-300 text-red-600
               text-sm font-bold rounded-xl
               hover:bg-red-600 hover:text-white hover:border-red-600
               transition duration-150 shadow-sm hover:shadow-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
        </svg>
        {{ __('Hapus Akun Saya') }}
    </button>

    {{-- Modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-7">
            @csrf
            @method('delete')

            {{-- Modal header --}}
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800">
                        {{ __('Yakin ingin menghapus akun?') }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ __('Tindakan ini tidak dapat dibatalkan.') }}
                    </p>
                </div>
            </div>

            <p class="text-sm text-gray-500 mb-5 leading-relaxed">
                {{ __('Semua data Anda akan dihapus secara permanen. Masukkan password untuk konfirmasi.') }}
            </p>

            {{-- Password input --}}
            <div class="mb-5">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input id="password" name="password" type="password"
                       placeholder="{{ __('Masukkan password Anda') }}"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                              text-sm text-gray-800 placeholder-gray-400
                              focus:outline-none focus:ring-2 focus:ring-red-400/50 focus:border-red-400
                              focus:bg-white transition duration-150">
                @if ($errors->userDeletion->get('password'))
                    <p class="mt-1.5 text-xs text-red-500">{{ $errors->userDeletion->first('password') }}</p>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2.5 rounded-xl border border-gray-200
                               text-sm font-semibold text-gray-600
                               hover:bg-gray-100 transition duration-150">
                    {{ __('Batal') }}
                </button>

                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2.5
                               bg-red-600 hover:bg-red-700 text-white
                               text-sm font-bold rounded-xl
                               transition duration-150 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                    </svg>
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>

        </form>

    </x-modal>

</section>