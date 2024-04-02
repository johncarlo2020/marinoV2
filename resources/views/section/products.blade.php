<section class="container product-container py-5">
    @include('section.heading')
    <p class="product-information">
        {{$description}}
    </p>
    <p class="hook-text">
        LOAD NOW, PAY LATER!
    </p>
      <div class="product-slide pb-4">
        @foreach ($products as $product)
        <div class="card border ">
            <img src="{{asset('storage/'.$product['image'])}}" width="80">
            <div class="details">
                <p class="product-type">{{ $product['type'] }}</p>
                <p class="product-name">{{ $product['name'] }}</p>
                <div class="product-description">
                    {!! $product['details'] !!}

                </div>
                <div class="bottom">
                    <p class="price">&#x20B1;{{ $product['price'] }} only</p>
                    <p class="reloadable">
                        @if($product['isReaload'] == 1)
                        RE-LOADABLE
                        @endif
                    </p>
                    <a href="{{ $product['shopUrl'] }}" class="btn custom-btn dark-blue w-100">
                        {{ $buyNowText }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="top-up-loads mb-5">
        <div class="row">
            <div class="row ">
                @include('components.image',['image' => $topUP ])
                @include('components.titleWithParagraph', [
                    'title' => $topUPcontent['title'],
                    'content' => $topUPcontent['content']
                ])
                 <a href="{{ $fbLink }}" class="btn custom-btn outline-gold ">
                    {{ $buyNowText }}
                </a>
            </div>
        </div>
    </div>
</section>

