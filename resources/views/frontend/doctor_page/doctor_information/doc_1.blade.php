@extends('frontend.layouts.app')

@section('title', 'Book Appointment - Dr. Masud Khan')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- ================= FIRST SECTION (DOCTOR PROFILE) ================= -->
    <section class="doctor-profile">
        <div class="container profile-container">

            <!-- LEFT -->
            <div class="profile-left">
                <div class="profile-img">
                    <img src="{{ asset('uploads/images/doctor-page/D2.png') }}">
                </div>

                <div class="profile-stats">
                    <div class="stat-card">90% Success</div>
                    <div class="stat-card">7 Years Exp</div>
                    <div class="stat-card">2K+ Patients</div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="profile-right">
                <h2>Dr. Masud Khan</h2>
                <p class="speciality">Cardiologist</p>

                <!-- INFO GRID -->
                <div class="info-grid">
                    <div class="info-box">
                        <strong>Qualifications</strong>
                        <p>MBBS, MD (Cardiology)</p>
                    </div>

                    <div class="info-box">
                        <strong>Location</strong>
                        <p>Dhaka Medical College</p>
                    </div>

                    <div class="info-box">
                        <strong>Consultation Fee</strong>
                        <p>1000 BDT</p>
                    </div>

                    <div class="info-box">
                        <strong>Availability</strong>
                        <p>Tue, Thu, Sat</p>
                    </div>
                </div>

                <!-- ABOUT -->
                <div class="about-doctor">
                    <h4>About Doctor</h4>
                    <p>
                        Dr. Masud Khan is a highly experienced cardiologist in Bangladesh with a strong track record
                        of treating heart diseases. He has successfully treated thousands of patients and specializes
                        in modern cardiac care and diagnostics.
                    </p>
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
                            <div class="date-card" data-date="Tue 12 PM">
                                <span>Tue</span>
                                <h4>12</h4>
                                <small>PM</small>
                            </div>

                            <div class="date-card" data-date="Thu 10 AM">
                                <span>Thu</span>
                                <h4>10</h4>
                                <small>AM</small>
                            </div>

                            <div class="date-card" data-date="Sat 12 PM">
                                <span>Sat</span>
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

                            <p><strong>Doctor:</strong> <span>Dr. Masud Khan</span></p>
                            <p><strong>Speciality:</strong> <span>Cardiologist</span></p>
                            <p><strong>Date:</strong> <span id="selectedDate">Not Selected</span></p>
                            <p><strong>Time:</strong> <span id="selectedTime">Not Selected</span></p>
                            <p><strong>Fee:</strong> <span>1000 BDT</span></p>

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

        /* DATE CLICK */
        document.querySelectorAll('.date-card').forEach(card => {
            card.addEventListener('click', function() {

                document.querySelectorAll('.date-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                // FULL TEXT (e.g. Tue 12 PM)
                selectedDate = this.dataset.date;

                // SPLIT DATE & TIME
                let parts = selectedDate.split(" ");
                let day = parts[0];
                let time = parts[1];
                let meridian = parts[2];

                selectedTime = time + " " + meridian;

                // UPDATE UI
                document.getElementById('selectedDate').innerText = day;
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
