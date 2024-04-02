@extends('layouts.app')

@section('title', 'Our clients')

@section('content')

<div class="container clients-page-title page-title-container">
    @include('section.heading',['heading' => $ourClientHeading])
    <p class="product-information">
        {{$ourClientHeadingDescription}}
    </p>
</div>

<div class="clients-container container">
    @foreach ($testimonials as $testimonial)
    <div class="item">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-5">
                <img  src="{{asset('storage/'.$testimonial['image'])}}" alt="">
               
            </div>
            <div class="col-12 col-md-12 col-lg-6 mt-3 mt-lg-0">
                <p class="clients-name">{{ $testimonial['name'] }}</p>
                <p class="position">{{ $testimonial['position'] }}</p>
                <div class="rating">
                    @for ($i = 0; $i < $testimonial['rating']; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p class="message">{{ $testimonial['message'] }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection
