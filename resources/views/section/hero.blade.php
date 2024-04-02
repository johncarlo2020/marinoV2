<div class="hero" style="background-image: url('{{ asset('images/heroimage.png') }}');">
    <div class="cover-text">
        <div class="content-here container ">
            <a class="navbar-brand" href="">
                <img src="{{ asset('images/icons/logowhite.svg') }}" alt="Logo" width="33" height="33">
                <span class="btn-text">{{$companyName}}</span>
            </a>

            <h3>{{$companyName}}</h3>
            <p>{{$missionText}}</p>

            <div class="button-wrap d-block d-sm-flex gap-4 mt-4">
                <a href="{{ route('about-us')}}" class="btn custom-btn bg-white">
                    {{ $learnMoreText }}
                </a>
                <a href="{{route('products')}}" class="btn custom-btn dark-blue">
                    {{ $buyNowText }}
                </a>
            </div>
        </div>
    </div>
</div>
