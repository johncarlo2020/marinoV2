<div class="footer">
    <div class="footer-content container py-5" style="background-image: url('{{ asset('images/footer-bg.png') }}');">
        <div class="row gap-0">
            <div class="col-12 col-lg-3 map-col logo-info">
                <div class="icon-nav">
                    <a class="" href="#">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" height="50">
                    </a>
                    <p> {{$companyName}}</p>
                </div>
                <p>
                   {{$missionText}}
                </p>

            </div>
            <div class="col-12 col-lg-3 links">
                        <div class="quick-links">
                            <h2>Quick links</h2>
                            <ul class="row">
                                @foreach ($footerNavLinks as $link)
                                    <li class="col-12 col-md-3 col-lg-6">
                                        <a href="{{ $link['linkUrl'] }}">{{ $link['page'] }}</a>
                                        @if ($link['child'] && isset($link['children']) && count($link['children']) > 0)
                                            <ul>
                                         @foreach ($link['children'] as $childLink)
                                    <li><a href="{{ $childLink['linkUrl'] }}">{{ $childLink['page'] }}</a></li>
                                @endforeach
                            </ul>
                           @endif
                        </li>
                    @endforeach
                 </ul>
                </div>
            </div>
            <div class="col links">
                <div class="first">
                    <h2>Contacts</h2>
                    <div class="footer-icons row">
                        @foreach ($iconDataFooter as $item)
                            <div class="footer-icons-item col-12 col-md-6 col-lg-6">
                                <div class="icon">
                                    <img src="{{ $item['iconUrl'] }}" alt="{{ $item['value'] }}" >
                                </div>
                                <p>{{ $item['value'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map">
        <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=194&amp;hl=en&amp;q=12 Floor Room 1222 Times Plaza Building UN Ave. Ermita Manila&amp;t=p&amp;z=19&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://gachanymph.com/">Gacha Nymph APK</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:194px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:194px;}.gmap_iframe {height:194px!important;}</style></div>
    </div>
    <div class="rights py-2">
        <p>@2024 Marino Data Top Up PH Corp.</p>
    </div>
</div>
