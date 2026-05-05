@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('css/frontend/service_page/service_information/information.css') }}">
@section('content')
    @include('frontend.custom_layout.header')

    <section class="service-details">
        <div class="container">
            <div class="row g-4">

                <!-- IMAGE -->
                <div class="col-md-6">
                    <div class="service-image-box">
                        <img src="{{ asset($service->image) }}">
                    </div>
                </div>

                <!-- INFO -->
                <div class="col-md-6">

                    <div class="service-info-card">
                        <h3>{{ $service->title }}</h3>

                        <div class="service-desc">
                            {{ $service->description }}
                        </div>
                    </div>

                    <div class="service-price">
                        ৳ {{ $service->price }}
                    </div>

                    <div class="pre-test-box">
                        <h5>Pre Test Instructions</h5>

                        <ul>
                            @foreach ($service->instructions as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

                <!-- BOOKING FORM -->
                {{-- ================= GUEST VIEW (FAKE) ================= --}}
                @guest

                    <!-- FORM (FAKE) -->
                    <div class="col-md-6">
                        <div class="booking-card">

                            <h5>Your Details</h5>

                            <div class="form-row">
                                <input type="text" placeholder="Full Name" disabled>
                                <input type="text" placeholder="Mobile" disabled>
                            </div>

                            <div class="form-row">
                                <input type="number" placeholder="Age" disabled>
                                <select disabled>
                                    <option>Gender</option>
                                </select>
                            </div>

                            <input type="email" placeholder="Email (optional)" disabled>

                            <div class="select-group">
                                <label>Payment Method</label>
                                <div class="btn-group">
                                    <button disabled>Cash</button>
                                    <button disabled>Online</button>
                                </div>
                            </div>

                            <div class="select-group">
                                <label>Select Date</label>
                                <div class="btn-group">
                                    <button disabled>5 May 2026</button>
                                    <button disabled>10 May 2026</button>
                                </div>
                            </div>

                            <div class="select-group">
                                <label>Select Time</label>
                                <div class="btn-group">
                                    <button disabled>12 PM</button>
                                    <button disabled>2 PM</button>
                                </div>
                            </div>

                            <button class="btn btn-danger w-100 mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                                🔐 Login to Book (৳{{ $service->price }})
                            </button>

                        </div>
                    </div>

                    <!-- SUMMARY (FAKE) -->
                    <div class="col-md-6">
                        <div class="summary-card">

                            <h5>Booking Summary</h5>

                            <div class="summary-row"><span>Name</span><span>Not Filled</span></div>
                            <div class="summary-row"><span>Mobile</span><span>Not Filled</span></div>
                            <div class="summary-row"><span>Age</span><span>Not Filled</span></div>
                            <div class="summary-row"><span>Gender</span><span>Not Filled</span></div>
                            <div class="summary-row"><span>Date</span><span>Not Selected</span></div>
                            <div class="summary-row"><span>Time</span><span>Not Selected</span></div>
                            <div class="summary-row"><span>Payment</span><span>Not Selected</span></div>

                            <hr>

                            <div class="summary-row total">
                                <span>Total</span><span>৳{{ $service->price }}</span>
                            </div>

                        </div>
                    </div>

                @endguest


                {{-- ================= AUTH VIEW (REAL) ================= --}}
                @auth
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <input type="hidden" name="type" value="service">
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <input type="hidden" name="appointment_date" id="formDate">
                        <input type="hidden" name="appointment_time" id="formTime">
                        <input type="hidden" name="payment_method" id="paymentMethod">

                        <div class="row g-4">

                            <!-- LEFT: FORM -->
                            <div class="col-md-6">
                                <div class="booking-card">

                                    <h5>Your Details</h5>

                                    <div class="form-row">
                                        <div class="w-100">
                                            <label>Full Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                placeholder="Full Name">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="w-100">
                                            <label>Mobile</label>
                                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                                placeholder="Mobile">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="w-100">
                                            <label>Age</label>
                                            <input type="number" name="age" id="age" value="{{ old('age') }}"
                                                placeholder="Age">
                                            @error('age')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="w-100">
                                            <label>Gender</label>
                                            <select name="gender" id="gender">
                                                <option value="">Gender</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="w-100">
                                        <label>Email (optional)</label>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- PAYMENT -->
                                    <div class="select-group">
                                        <label>Payment Method</label>
                                        <div class="btn-group">
                                            <button type="button" class="select-btn" data-type="payment"
                                                data-value="Cash">Cash</button>
                                            <button type="button" class="select-btn" data-type="payment"
                                                data-value="Online">Online</button>
                                        </div>
                                        @error('payment_method')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <!-- DATE -->
                                    <div class="select-group">
                                        <label>Select Date</label>
                                        <div class="btn-group">
                                            <button type="button" class="select-btn" data-type="date"
                                                data-value="2026-05-05">5
                                                May 2026</button>
                                            <button type="button" class="select-btn" data-type="date"
                                                data-value="2026-05-10">10 May 2026</button>
                                        </div>
                                    </div>

                                    <!-- TIME -->
                                    <div class="select-group">
                                        <label>Select Time</label>
                                        <div class="btn-group">
                                            <button type="button" class="select-btn" data-type="time"
                                                data-value="12:00:00">12 PM</button>
                                            <button type="button" class="select-btn" data-type="time"
                                                data-value="14:00:00">2 PM</button>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn-confirm" id="confirmBtn" disabled>
                                        Confirm Booking (৳{{ $service->price }})
                                    </button>

                                </div>
                            </div>

                            <!-- RIGHT: SUMMARY -->
                            <div class="col-md-6">
                                <div class="summary-card">

                                    <h5>Booking Summary</h5>

                                    <div class="summary-row"><span>Name</span><span id="s_name">Not Filled</span></div>
                                    <div class="summary-row"><span>Mobile</span><span id="s_mobile">Not Filled</span></div>
                                    <div class="summary-row"><span>Age</span><span id="s_age">Not Filled</span></div>
                                    <div class="summary-row"><span>Gender</span><span id="s_gender">Not Filled</span></div>
                                    <div class="summary-row"><span>Date</span><span id="s_date">Not Selected</span></div>
                                    <div class="summary-row"><span>Time</span><span id="s_time">Not Selected</span></div>
                                    <div class="summary-row"><span>Payment</span><span id="s_payment">Not Selected</span>
                                    </div>

                                    <hr>

                                    <div class="summary-row total">
                                        <span>Total</span>
                                        <span>৳{{ $service->price }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </form>
                @endauth

            </div>
        </div>
    </section>

    @include('frontend.custom_layout.footer')

    {{-- SIMPLE JS --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const el = (id) => document.getElementById(id);

            let state = {
                payment: "",
                date: "",
                time: ""
            };

            function updateHiddenInputs() {
                if (el("formDate")) el("formDate").value = state.date || "";
                if (el("formTime")) el("formTime").value = state.time || "";
                if (el("paymentMethod")) el("paymentMethod").value = state.payment || "";
            }

            function updateSummary() {

                const name = el("name")?.value?.trim() || "Not Filled";
                const phone = el("phone")?.value?.trim() || "Not Filled";
                const age = el("age")?.value?.trim() || "Not Filled";
                const gender = el("gender")?.value?.trim() || "Not Filled";

                if (el("s_name")) el("s_name").innerText = name;
                if (el("s_mobile")) el("s_mobile").innerText = phone;
                if (el("s_age")) el("s_age").innerText = age;
                if (el("s_gender")) el("s_gender").innerText = gender;

                if (el("s_date")) el("s_date").innerText = state.date || "Not Selected";
                if (el("s_time")) el("s_time").innerText = state.time || "Not Selected";
                if (el("s_payment")) el("s_payment").innerText = state.payment || "Not Selected";
            }

            function checkForm() {

                const requiredInputs = ["name", "phone", "age", "gender"];

                let valid = requiredInputs.every(id => {
                    const input = el(id);
                    return input && input.value.trim() !== "";
                });

                valid = valid && state.payment && state.date && state.time;

                const btn = el("confirmBtn");

                if (btn) {
                    btn.disabled = !valid;
                    btn.style.opacity = valid ? "1" : "0.5";
                    btn.style.cursor = valid ? "pointer" : "not-allowed";
                }
            }

            // 🔥 INPUT LISTENERS (FIXED)
            ["name", "phone", "age", "gender"].forEach(id => {
                const input = el(id);

                if (!input) return;

                input.addEventListener("input", function() {
                    updateSummary();
                    checkForm();
                });
            });

            // 🔥 BUTTON SELECTION FIX
            document.querySelectorAll(".select-btn").forEach(btn => {
                btn.addEventListener("click", function() {

                    const type = this.dataset.type;
                    const value = this.dataset.value;

                    if (!type || !value) return;

                    document.querySelectorAll(`[data-type="${type}"]`)
                        .forEach(b => b.classList.remove("active"));

                    this.classList.add("active");

                    state[type] = value;

                    updateHiddenInputs();
                    updateSummary();
                    checkForm();
                });
            });

            // 🔥 SAFETY SUBMIT CHECK
            const form = document.querySelector("form[action*='appointments.store']");

            if (form) {
                form.addEventListener("submit", function(e) {

                    updateHiddenInputs();

                    if (!state.payment || !state.date || !state.time) {
                        e.preventDefault();
                        alert("Please select Payment, Date and Time");
                    }
                });
            }

            // INIT
            updateSummary();
            checkForm();

        });
    </script>
@endsection
