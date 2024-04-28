<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-contaniner">
        <div class="form">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <!-- Email Address -->
                        <div class="input-text">
                            <span>Email</span>
                            <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-text">
                            <span>Password</span>
                            <x-text-input id="password" class="block w-full mt-1" type="password" name="password"
                                required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <div class="form-check form-check-inline">
                            <input id="remember_me" type="checkbox"
                            class="form-check-input"
                            name="remember">
                            <label for="remember_me" class="form-check-label">
                                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me')
                                    }}</span>
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                        <a class=""
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif

                    </div>
                    <div class="mt-4 col-12">
                        <button type="submit" class="py-2 btn btn-primary w-100">Log in <i class="fa-solid fa-right-to-bracket"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
