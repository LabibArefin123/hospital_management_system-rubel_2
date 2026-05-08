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

            /* =========================================
               VARIABLES
            ========================================== */
            let currentPage = 0;

            let selectedDate = null;
            let selectedTime = null;
            let selectedPayment = null;

            const pages = document.querySelectorAll('.schedule-page');

            const confirmBtn = document.getElementById("confirmBtn");

            const formDate = document.getElementById("formDate");
            const formTime = document.getElementById("formTime");
            const paymentInput = document.getElementById("paymentMethod");

            const selectedDateText = document.getElementById("selectedDate");
            const selectedTimeText = document.getElementById("selectedTime");

            const noSlotText = document.getElementById("noSlotText");

            const form = document.querySelector("form");

            /* =========================================
               PAGINATION
            ========================================== */
            function showPage(index) {

                pages.forEach(page => {
                    page.classList.remove('active');
                });

                if (pages[index]) {
                    pages[index].classList.add('active');
                }
            }

            document.getElementById('nextSchedule')?.addEventListener('click', function() {

                if (currentPage < pages.length - 1) {

                    currentPage++;

                    showPage(currentPage);
                }
            });

            document.getElementById('prevSchedule')?.addEventListener('click', function() {

                if (currentPage > 0) {

                    currentPage--;

                    showPage(currentPage);
                }
            });

            /* =========================================
               SLOT SELECT
            ========================================== */
            document.querySelectorAll('.date-card').forEach(card => {

                card.addEventListener('click', function() {

                    // remove active
                    document.querySelectorAll('.date-card')
                        .forEach(c => c.classList.remove('active'));

                    // add active
                    this.classList.add('active');

                    // get values
                    selectedDate = this.dataset.date;
                    selectedTime = this.dataset.time;

                    if (!selectedDate || !selectedTime) return;

                    // set hidden fields
                    formDate.value = selectedDate;
                    formTime.value = selectedTime;

                    // hide empty text
                    if (noSlotText) {
                        noSlotText.classList.add('hidden');
                    }

                    // formatted date
                    const fullDate = new Date(
                        `${selectedDate} ${selectedTime}`
                    );

                    // update UI
                    if (selectedDateText) {
                        selectedDateText.innerText =
                            fullDate.toLocaleDateString('en-GB', {
                                weekday: 'long',
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            });
                    }

                    if (selectedTimeText) {
                        selectedTimeText.innerText =
                            fullDate.toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                    }

                    checkForm();
                });
            });

            /* =========================================
               PAYMENT SELECT
            ========================================== */
            document.querySelectorAll('.pay-btn').forEach(btn => {

                btn.addEventListener('click', function() {

                    document.querySelectorAll('.pay-btn')
                        .forEach(b => b.classList.remove('active'));

                    this.classList.add('active');

                    selectedPayment = this.dataset.value;

                    paymentInput.value = selectedPayment;

                    checkForm();
                });
            });

            /* =========================================
               INPUT VALIDATION
            ========================================== */
            ['name', 'age', 'phone', 'gender'].forEach(id => {

                const input = document.getElementById(id);

                if (!input) return;

                input.addEventListener('input', checkForm);
                input.addEventListener('change', checkForm);
            });

            function checkForm() {

                const name = document.getElementById('name')?.value.trim();

                const age = document.getElementById('age')?.value.trim();

                const phone = document.getElementById('phone')?.value.trim();

                const gender = document.getElementById('gender')?.value;

                const valid =
                    name &&
                    age &&
                    phone &&
                    gender &&
                    selectedDate &&
                    selectedTime &&
                    selectedPayment;

                if (!confirmBtn) return;

                confirmBtn.disabled = !valid;

                confirmBtn.style.background =
                    valid ? "#22c55e" : "gray";

                confirmBtn.style.cursor =
                    valid ? "pointer" : "not-allowed";
            }

            /* =========================================
               FORM SUBMIT
            ========================================== */
            if (form) {

                form.addEventListener("submit", function(e) {

                    if (
                        !selectedDate ||
                        !selectedTime ||
                        !selectedPayment
                    ) {

                        e.preventDefault();

                        alert("Please select Date, Time & Payment");

                        return;
                    }

                    console.log("Submitting Appointment", {
                        date: formDate.value,
                        time: formTime.value,
                        payment: paymentInput.value
                    });
                });
            }

            /* =========================================
               INITIAL PAGE
            ========================================== */
            showPage(currentPage);

        });
    </script>
@endsection
