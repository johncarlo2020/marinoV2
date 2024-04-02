<section class="container servises-section py-5">
    <div class="row">
        @foreach ($servicess as $service)
            <div class="col-lg-4 col-md-6 col-12 service-item py-4">
                <img src="{{ $service['image'] }}" alt="">
                <p class="title-text ">{{ $service['title'] }}</p>
                <p class="description">{{ $service['description'] }}</p>
            </div>
        @endforeach
    </div>
</section>
