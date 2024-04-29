<x-guest-layout>
    <div class="form-contaniner">
        <div class="form">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <div class="mb-6 header-content col-12">
                        <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo" width="50">
                        <h2 class="text-bold">Register to Marino</h2>
                        <p>Already have an account? <a href="{{route('login')}}">Sign in</a></p>
                    </div>
                    <div class="col-12">
                        <!-- Email Address -->
                        <div class="input-text">
                            <span>Name</span>
                            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- Email Address -->
                        <div class="input-text">
                            <span>Email</span>
                            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-12">
                        <!-- Email Address -->
                        <div class="input-text">
                            <span>Password</span>
                            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-12">
                        <!-- Email Address -->
                        <div class="input-text">
                            <span>Confirm Password</span>
                            <x-text-input id="password_confirmation" class="block w-full mt-1"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="py-2 btn btn-primary w-100">Register <i class="fa-solid fa-right-to-bracket"></i></button>
                    </div>
                    <div class="mt-4 text-center col-12">
                        <p class="text-gray">Need more details go back to <a href="{{route('home')}}">Home page</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
