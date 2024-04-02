<section class="testimonial-section mb-5">
    @include('section.heading')
    <div class="container-fluid testimonial-wrap mt-5">
        <div class="testimonial-slide container">
            @foreach ($testimonials as $testimonial)
            <div class="testimonial-item  rounded bg-white border">
                <img  src="{{asset('storage/'.$testimonial['image'])}}" >
                <p class="fw-bold">{{$testimonial['name']}}</p>
                <div class="star">
                    @for ($i = 0; $i < $testimonial['rating']; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p class="mb-2">{{$testimonial['position']}}</p>
                <p class="message">{{ $testimonial['message'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
