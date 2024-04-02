@extends('layouts.app')

@section('title', 'Products')

@section('content')

<div class="container product-page-title page-title-container">
    @include('section.heading',['heading' => $pruductsHeading])
    <p class="product-information">
        {{$productSectionDescription}}
    </p>
</div>
<div class="container product-list-details my-5">
    @foreach ($products as $set => $product)
    <div class="item border p-3 p-lg-5 rounded">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="  mb-4 mb-md-4 mb-lg-0">
                    <img  src="{{asset('storage/'.$product['image'])}}" alt="">
                   
                </div>
            </div>
            <div class="col-12 col-md- col-lg-7">
                <h2 class="fw-bold product-name">{{ $product['name'] }} <span class="bg-primary rounded-pill fw-normal px-3 py-1 fs-6 text-white">{{ $product['type'] }}</span></h2>
                <div class="d-lg-flex d-block gap-3 align-items-center my-3">
                    <h3 class="fw-bold mb-3 mb-md-0">&#8369; {{ $product['price'] }} only</h3>
                    <a href="{{ $product['shopUrl'] }}" class="btn custom-btn outline-gold rounded-pill">
                        {{ $buyNowText }}
                    </a>
                </div>
                <p class="mb-2 fw-bold">Supported Countries :</p>
                <p class="mb-3">{{ $product['countries'] }}</p>
                <p class="mb-2 fw-bold">Notes:</p>
                <p>{{ $product['notes'] }}</p>
                <div class="accordion mt-4" id="accordion{{$set}}">
                   
                            <div class="accordion-item" id="heading1">
                                <h2 class="accordion-header" >
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$product['id']}}1" aria-expanded="true" aria-controls="collapse{{$product['id']}}1">
                                        Packages
                                    </button>
                                </h2>
                                <div id="collapse{{$product['id']}}1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordion{{$set}}">
                                    <div class="accordion-body">
                                        {!! $product['packages'] !!}
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item" id="heading2">
                                <h2 class="accordion-header" >
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$product['id']}}2" aria-expanded="true" aria-controls="collapse{{$product['id']}}2">
                                        How to Top top_up
                                    </button>
                                </h2>
                                <div id="collapse{{$product['id']}}2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordion{{$set}}">
                                    <div class="accordion-body">
                                        {!! $product['top_up'] !!}
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item" id="heading3">
                                <h2 class="accordion-header" >
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$product['id']}}3" aria-expanded="true" aria-controls="collapse{{$product['id']}}3">
                                        Mode of Payment
                                    </button>
                                </h2>
                                <div id="collapse{{$product['id']}}3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordion{{$set}}">
                                    <div class="accordion-body">
                                        {!! $product['mop'] !!}
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection


