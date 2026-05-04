@extends('frontend.layouts.app')

@section('title', 'Full Body Health Checkup - SusthoCare')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/frontend/service_page/page_1/service_page_1.css') }}">
    @include('frontend.custom_layout.header')

    <section class="service-details">
        <div class="container">

            <div class="row g-4">

                <!-- TOP LEFT IMAGE -->
                <div class="col-md-6">
                    <div class="service-image-box">
                        <img src="{{ asset('uploads/images/service-page/S3.png') }}">
                    </div>
                </div>

                <!-- TOP RIGHT INFO -->
                <div class="col-md-6">
                    <div class="service-info-card">
                        <h3>Full Body Health Checkup</h3>

                        <div class="service-desc">
                            A comprehensive diagnostic package covering essential health parameters
                            including blood tests, vital checks, and overall health evaluation
                            to ensure early detection and prevention.
                        </div>
                    </div>

                    <div class="service-price">
                        ৳ 1000
                    </div>

                    <div class="pre-test-box">
                        <h5>Pre Test Instructions</h5>

                        <ul>
                            <li>✔ Fasting required for 8–10 hours</li>
                            <li>✔ Avoid fatty food before test</li>
                            <li>✔ Drink normal water (allowed)</li>
                            <li>✔ Avoid alcohol & smoking 24 hours before</li>
                            <li>✔ Bring previous reports if available</li>
                        </ul>
                    </div>
                </div>

                <!-- BOTTOM LEFT FORM -->
                <div class="col-md-6">
                    <div class="booking-card">

                        <h5>Your Details</h5>

                        <div class="form-row">
                            <input type="text" id="name" placeholder="Full Name">
                            <input type="text" id="mobile" placeholder="Mobile">
                        </div>

                        <div class="form-row">
                            <input type="number" id="age" placeholder="Age">
                            <select id="gender">
                                <option value="">Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <input type="email" id="email" placeholder="Email (optional)">

                        <!-- PAYMENT -->
                        <div class="select-group">
                            <label>Payment Method</label>
                            <div class="btn-group">
                                <button type="button" class="select-btn" data-type="payment"
                                    data-value="Cash">Cash</button>
                                <button type="button" class="select-btn" data-type="payment"
                                    data-value="Online">Online</button>
                            </div>
                        </div>

                        <!-- DATE -->
                        <div class="select-group">
                            <label>Select Date</label>
                            <div class="btn-group">
                                <button type="button" class="select-btn" data-type="date" data-value="5 May 2026">5 May
                                    2026</button>
                                <button type="button" class="select-btn" data-type="date" data-value="10 May 2026">10 May
                                    2026</button>
                            </div>
                        </div>

                        <!-- TIME -->
                        <div class="select-group">
                            <label>Select Time</label>
                            <div class="btn-group">
                                <button type="button" class="select-btn" data-type="time" data-value="12 PM">12 PM</button>
                                <button type="button" class="select-btn" data-type="time" data-value="2 PM">2 PM</button>
                            </div>
                        </div>

                        <button class="btn-confirm" id="confirmBtn" disabled>
                            Confirm Booking (৳1000)
                        </button>

                    </div>
                </div>

                <!-- BOTTOM RIGHT SUMMARY -->
                <div class="col-md-6">
                    <div class="summary-card">

                        <h5>Booking Summary</h5>

                        <div class="summary-row">
                            <span>Name</span><span id="s_name">Not Filled</span>
                        </div>

                        <div class="summary-row">
                            <span>Mobile</span><span id="s_mobile">Not Filled</span>
                        </div>

                        <div class="summary-row">
                            <span>Age</span><span id="s_age">Not Filled</span>
                        </div>

                        <div class="summary-row">
                            <span>Gender</span><span id="s_gender">Not Filled</span>
                        </div>

                        <div class="summary-row">
                            <span>Date</span><span id="s_date">Not Filled</span>
                        </div>

                        <div class="summary-row">
                            <span>Time</span><span id="s_time">Not Filled</span>
                        </div>

                        <div class="summary-row">
                            <span>Payment</span><span id="s_payment">Not Filled</span>
                        </div>

                        <hr>

                        <div class="summary-row total">
                            <span>Total</span><span>৳1000</span>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
    <script>
        const inputs = ["name", "mobile", "age", "gender"];

        let state = {
            payment: "",
            date: "",
            time: ""
        };

        function updateSummary() {
            document.getElementById("s_name").innerText = document.getElementById("name").value || "Not Filled";
            document.getElementById("s_mobile").innerText = document.getElementById("mobile").value || "Not Filled";
            document.getElementById("s_age").innerText = document.getElementById("age").value || "Not Filled";
            document.getElementById("s_gender").innerText = document.getElementById("gender").value || "Not Filled";

            document.getElementById("s_date").innerText = state.date || "Not Filled";
            document.getElementById("s_time").innerText = state.time || "Not Filled";
            document.getElementById("s_payment").innerText = state.payment || "Not Filled";
        }

        function checkForm() {
            let valid = inputs.every(id => document.getElementById(id).value);
            valid = valid && state.payment && state.date && state.time;

            document.getElementById("confirmBtn").disabled = !valid;
        }

        // INPUT EVENTS
        inputs.forEach(id => {
            document.getElementById(id).addEventListener("input", () => {
                updateSummary();
                checkForm();
            });
        });

        // BUTTON SELECT
        document.querySelectorAll(".select-btn").forEach(btn => {
            btn.addEventListener("click", function() {

                let type = this.dataset.type;
                let value = this.dataset.value;

                document.querySelectorAll(`[data-type="${type}"]`).forEach(b => b.classList.remove(
                    "active"));
                this.classList.add("active");

                state[type] = value;

                updateSummary();
                checkForm();
            });
        });
    </script>
    @include('frontend.custom_layout.footer')

@endsection
