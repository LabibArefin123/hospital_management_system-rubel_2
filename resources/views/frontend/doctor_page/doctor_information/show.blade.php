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

            let selectedDate = null;
            let selectedTime = null;
            let selectedPayment = null;

            const confirmBtn = document.getElementById("confirmBtn");

            const formDate = document.getElementById("formDate");
            const formTime = document.getElementById("formTime");
            const paymentInput = document.getElementById("paymentMethod");

            /* ================= DATE CLICK ================= */
            document.querySelectorAll('.date-card').forEach(card => {
                card.addEventListener('click', function() {

                    document.querySelectorAll('.date-card')
                        .forEach(c => c.classList.remove('active'));

                    this.classList.add('active');

                    let raw = this.dataset.date; // "2026-05-04 09:00:00"
                    if (!raw) return;

                    let [date, time] = raw.split(' ');

                    selectedDate = date;
                    selectedTime = time;

                    // set hidden
                    formDate.value = selectedDate;
                    formTime.value = selectedTime;

                    // UI update
                    let d = new Date(raw);

                    document.getElementById('selectedDate').innerText =
                        d.toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            weekday: 'long'
                        });

                    document.getElementById('selectedTime').innerText =
                        d.toLocaleTimeString('en-US', {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        });

                    checkForm();
                });
            });

            /* ================= PAYMENT CLICK ================= */
            document.querySelectorAll('.pay-btn').forEach(btn => {

                btn.addEventListener('click', function() {

                    document.querySelectorAll('.pay-btn')
                        .forEach(b => b.classList.remove('active'));

                    this.classList.add('active');

                    selectedPayment = this.dataset.value;

                    paymentInput.value = selectedPayment;

                    console.log("Payment:", selectedPayment);

                    checkForm();
                });
            });

            /* ================= INPUT LISTENER ================= */
            ['name', 'age', 'phone', 'gender'].forEach(id => {
                let input = document.getElementById(id);
                if (!input) return;

                input.addEventListener('input', checkForm);
                input.addEventListener('change', checkForm);
            });

            /* ================= VALIDATION ================= */
            function checkForm() {

                let name = document.getElementById('name')?.value.trim();
                let age = document.getElementById('age')?.value.trim();
                let phone = document.getElementById('phone')?.value.trim();
                let gender = document.getElementById('gender')?.value;

                let valid =
                    name &&
                    age &&
                    phone &&
                    gender &&
                    selectedDate &&
                    selectedTime &&
                    selectedPayment;

                confirmBtn.disabled = !valid;
                confirmBtn.style.background = valid ? "#22c55e" : "gray";
                confirmBtn.style.cursor = valid ? "pointer" : "not-allowed";
            }

            /* ================= SUBMIT CHECK ================= */
            const form = document.querySelector("form");

            form.addEventListener("submit", function(e) {

                if (!selectedPayment || !selectedDate || !selectedTime) {
                    e.preventDefault();
                    alert("Please select Date, Time & Payment");
                    return;
                }

                console.log("Submitting:", {
                    date: formDate.value,
                    time: formTime.value,
                    payment: paymentInput.value
                });
            });

        });
    </script>
@endsection
