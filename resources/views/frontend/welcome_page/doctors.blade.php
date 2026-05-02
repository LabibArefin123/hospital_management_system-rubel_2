<section id="doctors" class="py-5 bg-light">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">Our Doctors</h2>
            <p class="text-muted">Meet our experienced and caring medical team.</p>
        </div>

        @php
            $doctors = [
                ['image' => 'default.jpg', 'name' => 'Doctor 1', 'specialist' => 'General Physician'],
                ['image' => 'default.jpg', 'name' => 'Doctor 2', 'specialist' => 'Cardiologist'],
                ['image' => 'default.jpg', 'name' => 'Doctor 3', 'specialist' => 'Neurologist'],
            ];
        @endphp

        <div class="row align-items-center">

            <!-- LEFT: IMAGE -->
            <div class="col-md-5 text-center">
                <img id="doctorImage" src="{{ asset('uploads/images/' . $doctors[0]['image']) }}"
                    class="img-fluid rounded shadow" style="max-height: 350px;">
            </div>

            <!-- RIGHT: INFO -->
            <div class="col-md-7 mt-4 mt-md-0">
                <h3 id="doctorName" class="fw-bold">{{ $doctors[0]['name'] }}</h3>
                <p id="doctorSpecialist" class="text-success fw-semibold">
                    {{ $doctors[0]['specialist'] }}
                </p>

                <p class="mb-2">
                    Phone: <strong>+880 1700-000000</strong>
                </p>

                <button class="btn btn-success mt-2">
                    Book Appointment
                </button>

                <!-- SIMPLE DOT BUTTONS -->
                <div class="mt-4">
                    @foreach ($doctors as $index => $doc)
                        <button class="btn btn-sm btn-outline-secondary me-2 doctor-btn"
                            data-index="{{ $index }}">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <script>
        const doctors = @json($doctors);
        let current = 0;

        const img = document.getElementById('doctorImage');
        const name = document.getElementById('doctorName');
        const specialist = document.getElementById('doctorSpecialist');
        const buttons = document.querySelectorAll('.doctor-btn');

        function updateDoctor(index) {
            img.src = "{{ asset('uploads/images/') }}/" + doctors[index].image;
            name.innerText = doctors[index].name;
            specialist.innerText = doctors[index].specialist;

            current = index;
        }

        // Button Click
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                updateDoctor(btn.dataset.index);
            });
        });

        // Auto Slide Every 5 Seconds
        setInterval(() => {
            current = (current + 1) % doctors.length;
            updateDoctor(current);
        }, 5000);
    </script>
</section>
