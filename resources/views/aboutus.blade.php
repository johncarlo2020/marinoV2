@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<section class="about-us-with-image">
    <div class="container  page-title-container">
    </div>
    <div class="container text-center">
        @include('components.titleWithParagraph', [
            'title' => $aboutUsContent1['title'],
            'content' => $aboutUsContent1['content']
        ])
        <div class="credited-logo mt-4 p-4">
            <h5 class="text-center fw-bold">Credited by</h5>
            <div class="images-credited d-flex justify-content-center ">
                @foreach ($creditedLogo as $logo)
                <div class="image-cred">
                    <img class="item" src="{{ asset($logo['imageUrl']) }}" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="container mission-vission mt-5">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
            @include('components.titleWithParagraph', [
                'title' => $mission['title'],
                'content' => $mission['content']
            ])
             @include('components.titleWithParagraph', [
                'title' => $vission['title'],
                'content' => $vission['content']
            ])
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-6 mt-lg-4">
            @include('components.image',['image' => $aboutUsImg ])
        </div>
    </div>
    <div class="map mb-4 mt-5">
        <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=194&amp;hl=en&amp;q=12 Floor Room 1222 Times Plaza Building UN Ave. Ermita Manila&amp;t=p&amp;z=19&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://gachanymph.com/">Gacha Nymph APK</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:194px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:194px;}.gmap_iframe {height:194px!important;}</style></div>
    </div>
</div>

<section class="brand-section py-5 mb-4">
    <div class="container">
        <div class="row ">
            @include('components.brands',['list' => $brands])
            @include('components.titleWithParagraph', [
                'title' => $aboutUsContent2['title'],
                'content' => $aboutUsContent2['content']
            ])
        </div>
    </div>
</section>

@endsection
