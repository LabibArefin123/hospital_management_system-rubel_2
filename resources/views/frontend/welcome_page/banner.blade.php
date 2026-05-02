<section id="banner" class="w-100">
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_banner.css') }}">

    <div id="slider" class="position-relative w-100 d-flex align-items-center justify-content-center text-center"
        style="height:70vh; overflow:hidden;">

        @php
            $slides = [
                [
                    'title' => 'Welcome to Lifetime City Hospital',
                    'subtitle' => 'Providing trusted, affordable, and quality healthcare services for everyone.',
                ],
                [
                    'title' => 'Experienced Doctors & Modern Care',
                    'subtitle' => 'Expert medical professionals dedicated to your health and recovery.',
                ],
                [
                    'title' => 'Easy Appointments & Patient Management',
                    'subtitle' => 'Smart hospital management system for faster service and better care.',
                ],
            ];
        @endphp

        {{-- Slides --}}
        @foreach ($slides as $index => $slide)
            <div
                class="slide {{ $index === 0 ? 'active' : '' }} position-absolute w-100 h-100 d-flex align-items-center justify-content-center">

                <div class="text-white px-3">
                    <h1 class="fw-bold mb-3" style="font-size: 2.8rem;">
                        {{ $slide['title'] }}
                    </h1>
                    <p class="fs-5 opacity-90">
                        {{ $slide['subtitle'] }}
                    </p>
                </div>

            </div>
        @endforeach

        {{-- Dots --}}
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 d-flex gap-2">
            @foreach ($slides as $i => $slide)
                <span class="dot" onclick="goToSlide({{ $i }})"></span>
            @endforeach
        </div>

    </div>
</section>
