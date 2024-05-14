<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{--  <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>  --}}
        </x-slot>
        <center>
            <div class="mt-2">
                <img src="{{asset ('blackend/img_sk/logo.png') }}" width="150px" height="150px" alt="Image">
            </div>
            <div class="mt-4 mb-4">
                <a href="#"> <b>SISTEM INFORMASI AGENDA PIMPINAN</b></a>
            </div>
        </center>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, dapatkah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email yang lain kepada Anda.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
