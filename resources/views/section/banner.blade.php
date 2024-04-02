<section class="banner-section" style="background-image: url('{{ asset('images/banner-bg.svg') }}');">
    <div class="content container">
        <div class="row">
            <div class="col-12 col-lg-6 col-md-12">
                <div class="banner-info">
                    <h2>{{ $bannerText }}</h2>
                    <div class="icon-nav mt-2">
                        <a class="" href="#">
                            <img src="{{ asset('images/icons/logo-gold.svg') }}" alt="Logo" width="40" height="40">
                        </a>
                        <p> {{$companyName}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-12">
                <div class="button-wrap">
                    <a href="{{route('products')}}" class="btn custom-btn gold">
                        {{ $learnMoreText }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
