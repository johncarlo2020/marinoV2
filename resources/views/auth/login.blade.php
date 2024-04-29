<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-contaniner">
        <div class="form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                  

                <div class="row">
                      {{-- <div class="w-full flex justify-center mx-2">
                        <a href="auth/google/redirect" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 me-2 mb-2">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                            <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                            </svg>
                            Sign in with Google
                        </a>
                    </div>
                     <div class="w-full flex justify-center mx-2">
                        <a href="auth/facebook/redirect" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 me-2 mb-2">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                            <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                            </svg>
                            Sign in with Facebook
                        </a>
                    </div> --}}
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
