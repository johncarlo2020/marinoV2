<x-guest-layout>
    <div class="form-contaniner">
        <div class="form">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="input-text">
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="py-2 btn btn-primary w-100">  {{ __('Email Password Reset Link') }} <i
                            class="fa-solid fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
