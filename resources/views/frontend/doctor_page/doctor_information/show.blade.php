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
    @include('frontend.doctor_page.doctor_layout.profile_section')
    @include('frontend.doctor_page.doctor_layout.booking_section')
    @include('frontend.custom_layout.footer')

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let selectedDate = "";
            let selectedTime = "";
            let selectedPayment = "";

            const confirmBtn = document.getElementById("confirmBtn");

            const formDate = document.getElementById("formDate");
            const formTime = document.getElementById("formTime");
            const paymentInput = document.getElementById("paymentMethod");

            /* ================= DATE CLICK ================= */
            document.querySelectorAll('.date-card').forEach(card => {
                card.addEventListener('click', function() {

                    document.querySelectorAll('.date-card').forEach(c => c.classList.remove(
                        'active'));
                    this.classList.add('active');

                    let raw = this.dataset.date; // "2026-05-04 09:00:00"

                    if (!raw) return;

                    let parts = raw.split(' ');
                    selectedDate = parts[0];
                    selectedTime = parts[1];

                    // Set hidden inputs (IMPORTANT)
                    if (formDate) formDate.value = selectedDate;
                    if (formTime) formTime.value = selectedTime;

                    let dateObj = new Date(raw);

                    if (!isNaN(dateObj)) {
                        document.getElementById('selectedDate').innerText =
                            dateObj.toLocaleDateString('en-GB', {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric',
                                weekday: 'long'
                            });

                        document.getElementById('selectedTime').innerText =
                            dateObj.toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                    }

                    checkForm();
                });
            });

            /* ================= PAYMENT CLICK ================= */
            /* ================= PAYMENT CLICK (FIXED) ================= */
            document.querySelectorAll('.payment button').forEach(btn => {

                btn.addEventListener('click', function(e) {
                    e.preventDefault(); // 🔥 VERY IMPORTANT

                    // remove active
                    document.querySelectorAll('.payment button').forEach(b => {
                        b.classList.remove('active');
                    });

                    // add active
                    this.classList.add('active');

                    // force exact values (no innerText issues)
                    selectedPayment = this.textContent.trim();

                    if (paymentInput) {
                        paymentInput.value = selectedPayment;
                    }

                    console.log("Selected Payment:", selectedPayment); // debug

                    checkForm();
                });

            });
            /* ================= INPUT LISTENER ================= */
            ['name', 'age', 'phone', 'gender'].forEach(id => {
                let el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', checkForm);
                    el.addEventListener('change', checkForm);
                }
            });

            /* ================= FORM CHECK ================= */
            function checkForm() {

                let name = document.getElementById('name')?.value.trim();
                let age = document.getElementById('age')?.value.trim();
                let phone = document.getElementById('phone')?.value.trim();
                let gender = document.getElementById('gender')?.value;

                if (name && age && phone && gender && selectedDate && selectedTime && selectedPayment) {

                    confirmBtn.disabled = false;
                    confirmBtn.style.background = "#22c55e";
                    confirmBtn.style.cursor = "pointer";

                } else {

                    confirmBtn.disabled = true;
                    confirmBtn.style.background = "gray";
                    confirmBtn.style.cursor = "not-allowed";
                }
            }

        });
    </script>
@endsection
