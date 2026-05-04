@extends('frontend.layouts.app')

@section('title', 'Our Services - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- INTRO -->
    <section class="service-intro">
        <div class="container text-center">
            <h2>Our Diagnostic Services</h2>
            <p>Safe, accurate & reliable testing.</p>
        </div>
    </section>

    <!-- SERVICE GRID -->
    <section class="service-section">
        <div class="container">

            @php
                $services = [
                    [
                        'img' => 'S3.png',
                        'title' => 'Full Body Health Checkup',
                        'route' => route('service_1'), // ✅ only this has route
                    ],
                    [
                        'img' => 'S6.png',
                        'title' => 'X-Ray Scan',
                        'route' => '#',
                    ],
                    [
                        'img' => 'S4.png',
                        'title' => 'Blood Pressure Check',
                        'route' => '#',
                    ],
                    [
                        'img' => 'S1.png',
                        'title' => 'Blood Sugar Test',
                        'route' => '#',
                    ],
                    [
                        'img' => 'S2.png',
                        'title' => 'Full Blood Count (CBC)',
                        'route' => '#',
                    ],
                ];
            @endphp

            <div class="service-grid">

                @foreach ($services as $service)
                    <div class="service-card">

                        <div class="service-content">
                            <div class="service-icon">
                                <img src="{{ asset('uploads/images/service-page/' . $service['img']) }}">
                            </div>

                            <h5>{{ $service['title'] }}</h5>
                        </div>

                        <a href="{{ $service['route'] }}" class="btn-book">
                            Book Now
                        </a>

                    </div>
                @endforeach

            </div>

        </div>
    </section>

    @include('frontend.custom_layout.footer')

@endsection
