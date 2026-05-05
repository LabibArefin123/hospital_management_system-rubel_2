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
