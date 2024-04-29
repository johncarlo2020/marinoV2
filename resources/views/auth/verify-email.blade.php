<x-guest-layout>
    <div class="form-contaniner">
        <div class="form">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on
                the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>

                    <button type="submit" class="py-2 btn btn-primary w-100">{{ __('Resend Verification Email')
                        }} <i class="fa-solid fa-paper-plane"></i></i></button>
                </div>
            </form>
            <div class="mt-4 text-center col-12">
                <p class="text-gray">Need more details go back to <a href="{{route('home')}}">Home page</a></p>
            </div>
        </div>
    </div>

    </div>
</x-guest-layout>
