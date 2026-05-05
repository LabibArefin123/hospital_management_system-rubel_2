@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_stat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_right.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/about_doctor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/responsive.css') }}">

    @include('frontend.custom_layout.header')

    <!-- ================= DOCTOR PROFILE ================= -->
    <section class="doctor-profile">
        <div class="container">

            <div class="row align-items-center g-4">

                <!-- LEFT -->
                <div class="col-md-6">
                    <div class="profile-left">

                        <div class="profile-img">
                            <img src="{{ asset($doctor->image) }}">
                        </div>

                        <div class="profile-stats">

                            <div class="stat-card success">
                                <div class="icon">✔</div>
                                <h4>{{ $doctor->success_rate }}%</h4>
                                <p>Success Rate</p>
                            </div>

                            <div class="stat-card experience">
                                <div class="icon">⏳</div>
                                <h4>{{ $doctor->experience_years }} Years</h4>
                                <p>Experience</p>
                            </div>

                            <div class="stat-card patients">
                                <div class="icon">👨‍⚕️</div>
                                <h4>{{ $doctor->total_patients }}</h4>
                                <p>Patients</p>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-md-6">
                    <div class="profile-right">

                        <h2>{{ $doctor->name }}</h2>
                        <p class="speciality">{{ $doctor->speciality }}</p>

                        <div class="info-grid">

                            <div class="info-box">
                                <h5>Qualifications</h5>
                                <p>{{ $doctor->qualification }}</p>
                            </div>

                            <div class="info-box">
                                <h5>Location</h5>
                                <p>{{ $doctor->location }}</p>
                            </div>

                            <div class="info-box">
                                <h5>Consultation Fee</h5>
                                <p>{{ $doctor->consultation_fee }} BDT</p>
                            </div>

                            <div class="info-box">
                                <h5>Availability</h5>
                                <p>Available</p>
                            </div>

                        </div>

                        <div class="about-doctor">
                            <h4>About Doctor</h4>
                            <p>{{ $doctor->about }}</p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= BOOKING ================= -->
    <section class="booking-section">
        <div class="container">

            <div class="row g-4">

                <!-- LEFT (FORM) -->
                <div class="col-md-6">
                    <div class="booking-left">

                        <h3>Book Your Appointment</h3>

                        <!-- DATE SELECT -->
                        <div class="date-grid">

                            @foreach ($groupedSchedules as $date => $schedules)
                                @php $first = $schedules->first(); @endphp <div class="date-card"
                                    data-date="{{ $date }} {{ $first->time }}"> <span>
                                        {{ \Carbon\Carbon::parse($date)->format('l, F j Y') }} </span>
                                    <h4> {{ \Carbon\Carbon::parse($first->time)->format('h') }} </h4> <small>
                                        {{ \Carbon\Carbon::parse($first->time)->format('A') }} </small>
                                </div>
                            @endforeach
                        </div>

                        <!-- FORM -->
                        <div class="patient-form">

                            <div>
                                <label>Full Name <span class="req">*</span></label>
                                <input type="text" id="name">
                            </div>

                            <div>
                                <label>Age <span class="req">*</span></label>
                                <input type="number" id="age">
                            </div>

                            <div>
                                <label>Mobile Number <span class="req">*</span></label>
                                <input type="text" id="phone">
                            </div>

                            <div>
                                <label>Gender <span class="req">*</span></label>
                                <select id="gender">
                                    <option value="">Select</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div class="full-width">
                                <label>Email (optional)</label>
                                <input type="email">
                            </div>

                        </div>

                    </div>
                </div>

                <!-- RIGHT (SUMMARY) -->
                <div class="col-md-6">
                    <div class="booking-right">

                        <h4>Available Time Slots</h4>
                        <p class="no-slot">No time slots selected</p>

                        <div class="summary-card">

                            <p><strong>Doctor:</strong> <span>{{ $doctor->name }}</span></p>
                            <p><strong>Speciality:</strong> <span>{{ $doctor->speciality }}</span></p>

                            <p><strong>Date:</strong> <span id="selectedDate">Not Selected</span></p>
                            <p><strong>Time:</strong> <span id="selectedTime">Not Selected</span></p>

                            <p><strong>Fee:</strong> <span>{{ $doctor->consultation_fee }} BDT</span></p>

                            <!-- PAYMENT (RESTORED) -->
                            <div class="payment">
                                <button type="button">Cash</button>
                                <button type="button">Online</button>
                            </div>

                            <button id="confirmBtn" disabled>📞 Confirm Booking</button>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    @include('frontend.custom_layout.footer')

    <script>
        let selectedDate = "";
        let selectedTime = "";
        let confirmBtn = document.getElementById("confirmBtn");

        /* CLICK DATE */
        document.querySelectorAll('.date-card').forEach(card => {
            card.addEventListener('click', function() {

                document.querySelectorAll('.date-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                let raw = this.dataset.date; // 2026-05-04 09:00:00

                let dateObj = new Date(raw);

                if (isNaN(dateObj)) {
                    console.log("Invalid date format:", raw);
                    return;
                }

                // FORMAT DATE
                let optionsDate = {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    weekday: 'long'
                };
                selectedDate = dateObj.toLocaleDateString('en-GB', optionsDate);

                // FORMAT TIME
                let optionsTime = {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                };
                selectedTime = dateObj.toLocaleTimeString('en-US', optionsTime);

                // UPDATE UI
                document.getElementById('selectedDate').innerText = selectedDate;
                document.getElementById('selectedTime').innerText = selectedTime;

                checkForm();
            });
        });

        /* INPUT LISTENER */
        document.querySelectorAll('#name, #age, #phone, #gender').forEach(input => {
            input.addEventListener('input', checkForm);
        });

        /* FORM CHECK */
        function checkForm() {

            let name = document.getElementById('name').value.trim();
            let age = document.getElementById('age').value.trim();
            let phone = document.getElementById('phone').value.trim();
            let gender = document.getElementById('gender').value;

            if (name && age && phone && gender && selectedDate && selectedTime) {
                confirmBtn.disabled = false;
                confirmBtn.style.background = "#22c55e";
                confirmBtn.style.cursor = "pointer";
            } else {
                confirmBtn.disabled = true;
                confirmBtn.style.background = "gray";
                confirmBtn.style.cursor = "not-allowed";
            }
        }
    </script>
@endsection
