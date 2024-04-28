<x-app-layout>
    <div class="container py-3">
        <div class="profile-edit">
            <div class="row">
                <div class="mb-2 col-12">
                    <div class="p-4 bg-white rounded shadow">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="mb-2 col-12">
                    <div class="p-4 bg-white rounded shadow">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="mb-2 col-12">
                    <div class="p-4 bg-white rounded shadow">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
