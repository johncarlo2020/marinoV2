<div class="dashboard-nav">
    <div class="container p-2 p-md-0 d-flex justify-content-between align-items-center">
        <div class="logo">
            <a class="gap-2 navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="33">
                <span class="ml-2 text-white d-block">Marino</span>
            </a>
        </div>
        <div class="gap-3 nav-contanainer d-flex align-items-center">
            <div class="notification">
                <span class="notif-icon"><i class="fa-solid fa-bell"></i></span>
            </div>
            <div id="dashboardDropdown" class="dropdown">
                <button class="d-none desktop-btn d-md-flex " type="button" onclick="openNav(this)">
                    <div class="mr-1 avatar d-inline-block">
                        <span>
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                    <span class="user-name">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="caret"><i class="fa-solid fa-angle-down"></i></span>
                </button>
                <button class="mobile-menu d-block d-sm-block d-md-none" onclick="openNav(this)">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div id="navContainer" class="dropdown-container">
                    <div class="px-3 py-2 border-bottom profile-details d-flex align-items-center">
                        <div class="mr-1 avatar d-inline-block">
                            <span>
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>
                        <div class="details">
                            <span class="d-block">
                                {{ Auth::user()->name }}
                            </span>
                            <span class="d-block">
                                {{ Auth::user()->email }}
                            </span>
                        </div>
                    </div>
                    <ul class="px-3 py-2 m-0 links">
                        <li><i class="fa-regular fa-user"></i><a class="ml-2 dropdown-item"
                                href="{{route('profile.edit')}}"> {{ __('Profile') }}</a></li>
                                <li><i class="fa-regular fa-user"></i><a class="ml-2 dropdown-item"
                                    href="{{route('profile.edit')}}"> History</a></li>
                    </ul>
                    <div class="px-3 py-2 log-out border-top">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
