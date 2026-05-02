@extends('frontend.layouts.app')

@section('title', 'Lifeline City Hospital')
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@section('content')
    {{-- Header --}}
    @include('frontend.welcome_page.header')

    {{-- Hero Banner --}}
    @include('frontend.welcome_page.banner')

    {{-- About Lifeline City Hospital --}}
    @include('frontend.welcome_page.about')

    {{-- Our Departments --}}
    @include('frontend.welcome_page.department')

    {{-- Hospital Services --}}
    @include('frontend.welcome_page.doctors')
    
    @include('frontend.welcome_page.services')

    {{-- Footer --}}
    @include('frontend.welcome_page.footer')
@endsection
