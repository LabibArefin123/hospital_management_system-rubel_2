{{-- ================= AUTH REAL FORM ================= --}}
@auth
    <div class="col-md-6">
        <div class="booking-left">

            <h3>Book Your Appointment</h3>

            <div class="date-grid">
                @foreach ($groupedSchedules as $date => $schedules)
                    @php $first = $schedules->first(); @endphp
                    <div class="date-card" data-date="{{ $date }} {{ $first->time }}">
                        <span>
                            {{ \Carbon\Carbon::parse($date)->format('l, F j Y') }}
                        </span>
                        <h4>{{ \Carbon\Carbon::parse($first->time)->format('h') }}</h4>
                        <small>{{ \Carbon\Carbon::parse($first->time)->format('A') }}</small>
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf

                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                <input type="hidden" name="type" value="doctor">
                <input type="hidden" name="appointment_date" id="formDate">
                <input type="hidden" name="appointment_time" id="formTime">
                <input type="hidden" name="payment_method" id="paymentMethod">

                <div class="patient-form">

                    <div>
                        <label>Full Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>Age *</label>
                        <input type="number" name="age" id="age" value="{{ old('age') }}">
                        @error('age')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>Mobile Number *</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>Gender *</label>
                        <select name="gender" id="gender">
                            <option value="">Select</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                            </option>
                        </select>
                        @error('gender')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="full-width">
                        <label>Email (optional)</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="booking-right">

            <h4>Available Time Slots</h4>
            <p class="no-slot" id="noSlotText">No time slots selected</p>

            <div class="summary-card">

                <p><strong>Doctor:</strong> <span>{{ $doctor->name }}</span></p>
                <p><strong>Speciality:</strong> <span>{{ $doctor->speciality }}</span></p>

                <p><strong>Date:</strong> <span id="selectedDate">Not Selected</span></p>
                <p><strong>Time:</strong> <span id="selectedTime">Not Selected</span></p>

                <p><strong>Fee:</strong> <span>{{ $doctor->consultation_fee }} BDT</span></p>

                <div class="payment">
                    <button type="button" class="pay-btn" data-value="Cash">Cash</button>
                    <button type="button" class="pay-btn" data-value="Online">Online</button>
                </div>

                <button type="submit" id="confirmBtn" disabled>
                    📞 Confirm Booking
                </button>

            </div>

        </div>
    </div>
    </form>
@endauth
