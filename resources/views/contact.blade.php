@extends('layouts.app')

@section('title', 'home')

@section('content')

    <div class="container  page-title-container">
    </div>

    <section class="contact-second ">
        <div class="container p-2">
            <div class="row ">
                @include('components.image', ['image' => $contactUsImg])
                @include('components.titleWithParagraph', [
                    'title' => $contactContent1['title'],
                    'content' => $contactContent1['content'],
                ])
            </div>
            <div class="container my-5">
                <div class="map mb-4">
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=194&amp;hl=en&amp;q=12 Floor Room 1222 Times Plaza Building UN Ave. Ermita Manila&amp;t=p&amp;z=19&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://gachanymph.com/">Gacha Nymph APK</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:194px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:194px;}.gmap_iframe {height:194px!important;}</style></div>
                </div>
                <div class="contact-details mb-5">
                    <h3 class="fw-bold text-center mb-4">Contact Details</h3>
                    <div class="contact-icons row border px-3 py-4 rounded">
                        @foreach ($iconDataFooter as $item)
                            <div class="contact-icons-item d-flex align-items-center gap-3 col-lg-4 mb-3">
                                <div class="icon">
                                    <img src="{{ $item['iconUrl'] }}" alt="{{ $item['value'] }}">
                                </div>
                                <p>{{ $item['value'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
@endsection
