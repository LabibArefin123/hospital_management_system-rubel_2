@extends('frontend.layouts.app')
@section('title', 'Contact Us - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- INTRO -->
    <section class="contact-intro">
        <div class="container text-center">
            <h2>Contact Our Clinic</h2>
            <p>Fill the form — we'll connect you instantly via WhatsApp</p>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact-section">
        <div class="container">

            <div class="contact-wrapper">

                <!-- LEFT FORM -->
                <div class="contact-form-box">
                    <h4>Send Message</h4>

                    <form id="whatsappForm">

                        <!-- Row 1 -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" id="name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" id="email">
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="text" id="phone" placeholder="01XXXXXXXXX" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <select id="department">
                                    <option value="">Select</option>
                                    <option>Cardiology</option>
                                    <option>Dermatology</option>
                                    <option>Neurology</option>
                                    <option>Gynecology</option>
                                </select>
                            </div>
                        </div>

                        <!-- Service -->
                        <div class="form-group">
                            <label>Service</label>
                            <select id="service">
                                <option value="">Select Service</option>
                                <option>Consultation</option>
                                <option>Checkup</option>
                                <option>Emergency</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="form-group">
                            <label>Message</label>
                            <textarea id="message" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn-whatsapp">
                            Send via WhatsApp
                        </button>

                    </form>
                </div>

                <!-- RIGHT SIDE -->
                <div class="contact-right">

                    <!-- Visit -->
                    <div class="info-card">
                        <h5>Visit Our Clinic</h5>
                        <p>📍 Mirpur DOHS, Dhaka</p>
                        <p>📞 017XXXXXXXX</p>
                        <p>✉ info@susthocare.com</p>
                    </div>

                    <!-- Map -->
                    <div class="info-card map-card">
                        <iframe
                            src="https://maps.google.com/maps?q=mirpur%20dohs%20dhaka&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Hours -->
                    <div class="info-card">
                        <h5>Clinic Hours</h5>
                        <p>Mon - Sat</p>
                        <strong>9:00 AM - 6:00 PM</strong>
                    </div>

                </div>

            </div>

        </div>
    </section>

    @include('frontend.custom_layout.footer')
    <script src="{{ asset('uploads/js/custom_frontend/contact_page/contact.js') }}"></script>
@endsection
