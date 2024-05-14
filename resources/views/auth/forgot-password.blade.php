<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{--  <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>  --}}
        </x-slot>
        <center>
            <div class="mt-2">
                <img src="{{asset ('blackend/img_sk/surat1.jpg') }}" width="150px" height="150px" alt="Image">
            </div>
            <div class="mt-4 mb-4">
                {{--  <a href="#"> <b>SISTEM INFORMASI AGENDA PIMPINAN</b></a>  --}}
            </div>
        </center>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan email kepada Anda tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
