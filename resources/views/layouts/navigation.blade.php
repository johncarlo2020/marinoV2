<div class="dashboard-nav">
    <div class="container p-3 d-flex justify-content-between align-items-center">
        <div class="logo">
            <a class="gap-2 navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="33">
                <span class="ml-2 text-white d-block">Marino</span>
            </a>
        </div>
        <div class="gap-3 nav-contanainer d-flex align-items-center">
            <div class="gap-1 balance-container d-flex align-items-center">
                <img src="{{ asset('images/icons/solar_wallet-bold.svg')}}" alt="">
                <span><span class=""><i class="fa-solid fa-peso-sign money-icon"></i></span> 231,234,42</span>
            </div>
            <div class="notification">
                <span class="notif-icon"><i class="fa-solid fa-bell"></i></span>
            </div>
            <div id="dashboardDropdown" class="dropdown">
                <button class="" type="button" id="links" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="mr-1 avatar d-inline-block">
                        <span>
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                    <span class="user-name">
                        {{ Auth::user()->name }}
                    </span>
                    <span><i class="fa-solid fa-caret-down"></i></span>
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
