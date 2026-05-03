<div class="row">

    <!-- Doctors Box -->
    <div class="col-md-6">
        <div class="trust-box">

            <h4 class="trust-group-title">👩‍⚕️ Medical Professionals</h4>

            <div class="trust-slider" id="doctorSlider">
                <div class="trust-slide active">
                    <div class="trust-card">Dr. Farhana Rahman <small>Cardiologist, Dhaka</small>
                        <p>"This system helps me manage appointments efficiently."</p>
                    </div>
                    <div class="trust-card">Dr. Tanvir Ahmed <small>Pediatrician, Chattogram</small>
                        <p>"Clinic workflow is now much more organized."</p>
                    </div>
                </div>

                <div class="trust-slide">
                    <div class="trust-card">Dr. Nusrat Jahan <small>Dermatologist, Khulna</small>
                        <p>"Automated reminders reduced no-shows."</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Patients Box -->
    <div class="col-md-6">
        <div class="trust-box">

            <h4 class="trust-group-title">🧑‍💼 Patients</h4>

            <div class="trust-slider" id="patientSlider">
                <div class="trust-slide active">
                    <div class="trust-card">Md. Rakib Hasan <small>Patient</small>
                        <p>"Booking is very easy now."</p>
                    </div>
                    <div class="trust-card">Sharmeen Akter <small>Patient</small>
                        <p>"Reminders help me stay organized."</p>
                    </div>
                </div>

                <div class="trust-slide">
                    <div class="trust-card">Imran Hossain <small>Patient</small>
                        <p>"No more long hospital lines."</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<script>
    function initSlider(id) {
        const slider = document.getElementById(id);
        const slides = slider.querySelectorAll('.trust-slide');
        let index = 0;

        setInterval(() => {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }, 3500);
    }

    initSlider('doctorSlider');
    initSlider('patientSlider');
</script>
