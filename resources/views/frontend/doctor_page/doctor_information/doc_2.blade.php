@extends('frontend.layouts.app')

@section('title', 'Book Appointment - Dr. Farhana Rahman')
<link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_section.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_stat.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/profile_right.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/about_doctor.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking_section.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/booking_form.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/doctor_page/doctor_information/responsive.css') }}">
@section('content')

    @include('frontend.custom_layout.header')

    <!-- ================= FIRST SECTION (DOCTOR PROFILE) ================= -->
    <section class="doctor-profile">
        <div class="container">

            <div class="row align-items-center g-4">

                <!-- LEFT -->
                <div class="col-md-6">
                    <div class="profile-left">

                        <div class="profile-img">
                            <img src="{{ asset('uploads/images/doctor-page/D1.png') }}">
                        </div>

                        <!-- NEW STATS DESIGN -->
                        <div class="profile-stats">

                            <div class="stat-card success">
                                <div class="icon">✔</div>
                                <h4>95%</h4>
                                <p>Success Rate</p>
                            </div>

                            <div class="stat-card experience">
                                <div class="icon">⏳</div>
                                <h4>8 Years</h4>
                                <p>Experience</p>
                            </div>

                            <div class="stat-card patients">
                                <div class="icon">👨‍⚕️</div>
                                <h4>3K+</h4>
                                <p>Patients</p>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-md-6">
                    <div class="profile-right">

                        <h2>Dr. Farhana Rahman</h2>
                        <p class="speciality">Dermatologist</p>

                        <!-- FIXED INFO CARDS -->
                        <div class="info-grid">

                            <div class="info-box">
                                <h5>Qualifications</h5>
                                <p>MBBS, DDV</p>
                            </div>

                            <div class="info-box">
                                <h5>Location</h5>
                                <p>Square Hospital</p>
                            </div>

                            <div class="info-box">
                                <h5>Consultation Fee</h5>
                                <p>800 BDT</p>
                            </div>

                            <div class="info-box">
                                <h5>Availability</h5>
                                <p>Available</p>
                            </div>

                        </div>

                        <!-- ABOUT -->
                        <div class="about-doctor">
                            <h4>About Doctor</h4>
                            <p>
                                Dr. Farhana Rahman is a skilled dermatologist in Bangladesh with extensive experience in
                                treating skin, hair,
                                and nail conditions. She is known for her patient-friendly approach and expertise in
                                advanced dermatological
                                procedures, including acne treatment, laser therapy, and cosmetic skin care.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= SECOND SECTION (BOOKING) ================= -->
    <section class="booking-section">
        <div class="container">

            <div class="row g-4">

                <!-- LEFT (FORM) -->
                <div class="col-md-6">
                    <div class="booking-left">

                        <h3>Book Your Appointment</h3>

                        <!-- DATE SELECT -->
                        <div class="date-grid">
                            <div class="date-card" data-date="2026-05-04 12:00:00">
                                <span>Monday, May 4 2026</span>
                                <h4>12</h4>
                                <small>PM</small>
                            </div>

                            <div class="date-card" data-date="2026-05-05 10:00:00">
                                <span>Tuesday, May 5 2026</span>
                                <h4>10</h4>
                                <small>AM</small>
                            </div>

                            <div class="date-card" data-date="2026-05-06 12:00:00">
                                <span>Wednesday, May 6 2026</span>
                                <h4>12</h4>
                                <small>PM</small>
                            </div>

                            <div class="date-card" data-date="2026-05-07 12:00:00">
                                <span>Thursday, May 7 2026</span>
                                <h4>12</h4>
                                <small>PM</small>
                            </div>
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

                        <!-- SUMMARY CARD -->
                        <div class="summary-card">

                            <p><strong>Doctor:</strong> <span>Dr. Farhana Rahman</span></p>
                            <p><strong>Speciality:</strong> <span>Dermatologist</span></p>
                            <p><strong>Date:</strong> <span id="selectedDate">Not Selected</span></p>
                            <p><strong>Time:</strong> <span id="selectedTime">Not Selected</span></p>
                            <p><strong>Fee:</strong> <span>800 BDT</span></p>

                            <div class="payment">
                                <button>Cash</button>
                                <button>Online</button>
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
