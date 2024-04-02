@extends('layouts.app')

@section('title', 'home')

@section('content')

@include('section.hero')

@include('section.servicess')

@include('section.banner')

@include('section.products', ['heading' => $pruductsHeading,'description' => $productSectionDescription])

@include('section.testimonial',['heading' => $testimonialHeading])

@endsection
