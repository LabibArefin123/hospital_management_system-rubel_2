@extends('frontend.layouts.app')

@section('title', 'Our Doctors - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- TRANSPARENT INTRO -->
    <section class="doctor-intro ">
        <div class="container text-center">
            <h2>Our Medical Experts</h2>
            <p>Find your ideal doctor by name or specialization</p>

            <!-- SEARCH -->
            <input type="text" id="doctorSearch" placeholder="Search doctor or specialization...">
        </div>
    </section>

    <!-- DOCTOR GRID -->
    <section class="doctor-section py-5">
        <div class="container">
            <div class="doctor-grid" id="doctorGrid">

                {{-- Doctor Card 1 --}}
                <div class="doctor-card">
                    <div class="doctor-img">
                        <img src="{{ asset('uploads/images/doctor-page/D2.png') }}">
                    </div>
                    <h5>Dr. Masud Khan</h5>
                    <p>Cardiologist</p>
                    <span>10 Years Experience</span>
                    <a href="#" class="btn-book">Book Now</a>
                </div>

                {{-- Doctor 2 --}}
                <div class="doctor-card">
                    <div class="doctor-img">
                        <img src="{{ asset('uploads/images/doctor-page/D1.png') }}">
                    </div>
                    <h5>Dr. Farhana Rahman</h5>
                    <p>Dermatologist</p>
                    <span>8 Years Experience</span>
                    <a href="#" class="btn-book">Book Now</a>
                </div>

                {{-- Doctor 3 --}}
                <div class="doctor-card">
                    <div class="doctor-img">
                        <img src="{{ asset('uploads/images/doctor-page/D4.png') }}">
                    </div>
                    <h5>Dr. Tanvir Ahmed</h5>
                    <p>Neurologist</p>
                    <span>12 Years Experience</span>
                    <a href="#" class="btn-book">Book Now</a>
                </div>

                {{-- Doctor 4 --}}
                <div class="doctor-card">
                    <div class="doctor-img">
                        <img src="{{ asset('uploads/images/doctor-page/D3.png') }}">
                    </div>
                    <h5>Dr. Nusrat Jahan</h5>
                    <p>Gynecologist</p>
                    <span>9 Years Experience</span>
                    <a href="#" class="btn-book">Book Now</a>
                </div>

                {{-- Doctor 5 --}}
                <div class="doctor-card">
                    <div class="doctor-img">
                        <img src="{{ asset('uploads/images/doctor-page/D6.png') }}">
                    </div>
                    <h5>Dr. Shafiqur Rahman</h5>
                    <p>Orthopedic Surgeon</p>
                    <span>15 Years Experience</span>
                    <a href="#" class="btn-book">Book Now</a>
                </div>

                {{-- Doctor 6 --}}
                <div class="doctor-card">
                    <div class="doctor-img">
                        <img src="{{ asset('uploads/images/doctor-page/D5.png') }}">
                    </div>
                    <h5>Dr. Ayesha Sultana</h5>
                    <p>Pediatrician</p>
                    <span>7 Years Experience</span>
                    <a href="#" class="btn-book">Book Now</a>
                </div>

                {{-- Doctor 7 --}}
                <div class="doctor-card">
                    <div class="doctor-img">
                        <img src="{{ asset('uploads/images/doctor-page/D7.png') }}">
                    </div>
                    <h5>Dr. Imran Hossain</h5>
                    <p>ENT Specialist</p>
                    <span>11 Years Experience</span>
                    <a href="#" class="btn-book">Book Now</a>
                </div>

            </div>
        </div>
    </section>

    @include('frontend.custom_layout.footer')

    {{-- LIVE SEARCH SCRIPT --}}
    <script>
        document.getElementById('doctorSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let cards = document.querySelectorAll('.doctor-card');

            cards.forEach(card => {
                let text = card.innerText.toLowerCase();
                card.style.display = text.includes(value) ? 'block' : 'none';
            });
        });
    </script>
@endsection
