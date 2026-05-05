 <!-- ================= BOOKING ================= -->
 <section class="booking-section">
     <div class="container">

         <div class="row g-4">

             {{-- ================= GUEST COPY (FAKE UI) ================= --}}
             @guest
                 <div class="col-md-6">
                     <div class="booking-left">

                         <h3>Book Your Appointment</h3>

                         <div class="date-grid">
                             @foreach ($groupedSchedules as $date => $schedules)
                                 @php $first = $schedules->first(); @endphp
                                 <div class="date-card">
                                     <span>
                                         {{ \Carbon\Carbon::parse($date)->format('l, F j Y') }}
                                     </span>
                                     <h4>{{ \Carbon\Carbon::parse($first->time)->format('h') }}</h4>
                                     <small>{{ \Carbon\Carbon::parse($first->time)->format('A') }}</small>
                                 </div>
                             @endforeach
                         </div>

                         <div class="patient-form">

                             <div>
                                 <label>Full Name *</label>
                                 <input type="text" placeholder="Enter your name" disabled>
                             </div>

                             <div>
                                 <label>Age *</label>
                                 <input type="number" disabled>
                             </div>

                             <div>
                                 <label>Mobile Number *</label>
                                 <input type="text" disabled>
                             </div>

                             <div>
                                 <label>Gender *</label>
                                 <select disabled>
                                     <option>Select</option>
                                     <option>Male</option>
                                     <option>Female</option>
                                 </select>
                             </div>

                             <div class="full-width">
                                 <label>Email (optional)</label>
                                 <input type="email" disabled>
                             </div>

                         </div>

                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="booking-right">

                         <h4>Available Time Slots</h4>
                         <p class="no-slot">No time slots selected</p>

                         <div class="summary-card">

                             <p><strong>Doctor:</strong> <span>{{ $doctor->name }}</span></p>
                             <p><strong>Speciality:</strong> <span>{{ $doctor->speciality }}</span></p>

                             <p><strong>Date:</strong> <span>Not Selected</span></p>
                             <p><strong>Time:</strong> <span>Not Selected</span></p>

                             <p><strong>Fee:</strong> <span>{{ $doctor->consultation_fee }} BDT</span></p>

                             <div class="payment">
                                 <button disabled>Cash</button>
                                 <button disabled>Online</button>
                             </div>

                             <button class="btn btn-danger w-100 mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                                 🔐 Login to Book
                             </button>

                         </div>

                     </div>
                 </div>
             @endguest


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
                                     <input type="text" name="name" id="name">
                                 </div>

                                 <div>
                                     <label>Age *</label>
                                     <input type="number" name="age" id="age">
                                 </div>

                                 <div>
                                     <label>Mobile Number *</label>
                                     <input type="text" name="phone" id="phone">
                                 </div>

                                 <div>
                                     <label>Gender *</label>
                                     <select name="gender" id="gender">
                                         <option value="">Select</option>
                                         <option>Male</option>
                                         <option>Female</option>
                                     </select>
                                 </div>

                                 <div class="full-width">
                                     <label>Email (optional)</label>
                                     <input type="email" name="email">
                                 </div>

                             </div>

                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="booking-right">

                         <h4>Available Time Slots</h4>
                         <p class="no-slot">No time slots selected</p>

                         <div class="summary-card">

                             <p><strong>Doctor:</strong> <span>{{ $doctor->name }}</span></p>
                             <p><strong>Speciality:</strong> <span>{{ $doctor->speciality }}</span></p>

                             <p><strong>Date:</strong> <span id="selectedDate">Not Selected</span></p>
                             <p><strong>Time:</strong> <span id="selectedTime">Not Selected</span></p>

                             <p><strong>Fee:</strong> <span>{{ $doctor->consultation_fee }} BDT</span></p>

                             <div class="payment">
                                 <button type="button">Cash</button>
                                 <button type="button">Online</button>
                             </div>

                             <button type="submit" id="confirmBtn" disabled>
                                 📞 Confirm Booking
                             </button>

                         </div>

                     </div>
                 </div>
                 </form>
             @endauth

         </div>

     </div>
 </section>
