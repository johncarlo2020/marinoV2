<div class="dashboard-nav">
    <div class="container p-3 d-flex justify-content-between align-items-center">
        <div class="logo">
            <a class="gap-2 navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="33">
                <span class="ml-2 text-white d-block">Marino</span>
            </a>
        </div>
        <div class="nav-contanainer">
            <div id="dashboardDropdown" class="dropdown">
                <button class="" type="button" id="links" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="mr-1 avatar d-inline-block">
                        <span>
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                    <span class="text-white">
                        {{ Auth::user()->name }}
                    </span>
                </button>
                <ul class="shadow-sm dropdown-menu dashboard-menus" aria-labelledby="links">
                  <li><a class="dropdown-item" href="{{route('profile.edit')}}"> {{ __('Profile') }}</a></li>
                  <li><a class="dropdown-item" href="{{route('logout')}}"  onclick="event.preventDefault();
                    this.closest('form').submit();"> {{ __('Log Out') }}</a></li>
                </ul>
              </div>
        </div>
    </div>
</div>
