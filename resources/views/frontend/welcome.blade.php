@extends('frontend.layouts.app')

@section('title', 'SusthoCare - Healthcare Solutions')
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@section('content')
    {{-- Header --}}
    @include('frontend.custom_layout.header')

    {{-- Hero Banner --}}
    @include('frontend.welcome_page.banner')

    @include('frontend.welcome_page.trust')
    {{-- Footer --}}
    @include('frontend.custom_layout.footer')
@endsection
