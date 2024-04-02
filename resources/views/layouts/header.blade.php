<div class="main-navbar fixed-top bg-white">
    <div class=" top-links justify-content-end container p-3 d-none d-md-none d-lg-flex">
        <ul>
            @foreach ($iconData as $item)
                <li>
                    <img src="{{ $item['iconUrl'] }}" alt="Icon">
                    <span>{{ $item['value'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-md-none d-lg-block">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{route('home')}}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="33" >
                <span class="ml-2 d-block">{{$companyName}}</span>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @foreach ($navLinks as $navLink)
                    <li class="nav-item {{ $navLink['child'] ? 'dropdown' : '' }}">
                        <a class="nav-link {{ $navLink['child'] ? 'dropdown-toggle' : '' }}"
                           href="{{ $navLink['linkUrl'] }}"
                           @if ($navLink['child'])
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false"
                           @endif
                        >
                            {{ $navLink['page'] }}
                        </a>
                        @if ($navLink['child'])
                            <ul class="dropdown-menu">
                                @foreach ($navLink['children'] as $childLink)
                                    <li><a class="dropdown-item" href="{{ $childLink['linkUrl'] }}">{{ $childLink['page'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
          </div>
        </div>
      </nav>

      <nav class="navbar navbar-dark d-block d-md-block d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{route('home')}}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="33" >
                <span class="ml-2 d-block">{{$companyName}}</span>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
              <button type="button" style="background-image: url('{{ asset('images/icons/close.svg') }}');" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 navbar-dark">
                @foreach ($navLinks as $navLink)
                    <li class="nav-item {{ $navLink['child'] ? 'dropdown' : '' }}">
                        <a class="nav-link {{ $navLink['child'] ? 'dropdown-toggle' : '' }}"
                        href="{{ $navLink['linkUrl'] }}"
                        @if ($navLink['child'])
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        @endif
                        >
                            {{ $navLink['page'] }}
                        </a>
                        @if ($navLink['child'])
                            <ul class="dropdown-menu">
                                @foreach ($navLink['children'] as $childLink)
                                    <li><a class="dropdown-item" href="{{ $childLink['linkUrl'] }}">{{ $childLink['page'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </nav>

</div>
