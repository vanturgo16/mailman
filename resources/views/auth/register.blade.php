<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{--  <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>  --}}
        </x-slot>
        <center>
            <a href="/">
            <div class="mt-2">
                <img src="{{asset ('blackend/img_sk/logo.png') }}" width="90px" height="90px" alt="Image">
            </div>
            <div class="mt-4 mb-4">
                <a href="#"> <b>FORM REGISTER SISTEM INFORMASI AGENDA PIMPINAN</b></a>
            </div>
        </a>
        </center>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
                placeholder="Masukan Nama Anda" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required 
                placeholder="Masukan Email Anda"/>
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Nomer HP')" />

                <x-input id="email" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required
                placeholder="Masukan Nomer HP Anda"  />
            </div>
           
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" 
                                placeholder="Masukan Password Anda"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required
                                placeholder="Konfirmasi Password Anda" />
            </div>
            {{--  <label untuk = "captcha" > Captcha </ label > 
                {!! \NoCaptcha::renderJs() !!}
                {!! \Recaptcha::render() !!}
                @error('g-recaptcha-respons')
                    < div class = "alert alert-danger mt-1 mb-1" > {{ $message }} </ div > 
                @enderror
            <div class="mt-4">  --}}
                <x-label>Pejabat yang di Undang</x-label>
               
                <select class="form-control select2 select2-danger" name="id_opd"
                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                
                    @foreach ($opds as $opd)
                    <option value="{{ $opd->id  }}" selected> {{ $opd->nm_opd}}</option>
                    @endforeach
    
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
