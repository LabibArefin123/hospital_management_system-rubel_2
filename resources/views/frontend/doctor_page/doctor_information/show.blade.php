@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_stat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_right.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/about_doctor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking-time-section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking-patient-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking-summary-payment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/responsive.css') }}">

    @include('frontend.custom_layout.header')
    @include('frontend.doctor_page.doctor_layout.profile_section')
    @include('frontend.doctor_page.doctor_layout.booking_section')
    @include('frontend.custom_layout.footer')
    <script src="{{ asset('js/custom_frontend/doctor_show/booking-form.js') }}"></script>
@endsection
