@extends('layouts.app')

@section('title', 'home')

@section('content')

@include('section.hero')

@include('section.servicess')

@include('section.banner')

@include('section.products', ['heading' => $pruductsHeading,'description' => $productSectionDescription])

@include('section.requestLoad',['heading' => 'Request Load'],['description' => 'To complete your request, please ensure that all fields are filled out. Your cooperation in providing all necessary information is greatly appreciated and will help expedite the process. Thank you.'])

@include('section.testimonial',['heading' => $testimonialHeading])

@endsection
