 <!-- ================= BOOKING ================= -->
 <section class="booking-section">
     <div class="container">

         <div class="row g-4">

             <!-- LEFT (FORM) -->
             <div class="col-md-6">
                 <div class="booking-left">

                     <h3>Book Your Appointment</h3>

                     <!-- DATE SELECT -->
                     <div class="date-grid">

                         @foreach ($groupedSchedules as $date => $schedules)
                             @php $first = $schedules->first(); @endphp <div class="date-card" data-date="{{ $date }} {{ $first->time }}">
                                 <span>
                                     {{ \Carbon\Carbon::parse($date)->format('l, F j Y') }} </span>
                                 <h4> {{ \Carbon\Carbon::parse($first->time)->format('h') }} </h4> <small>
                                     {{ \Carbon\Carbon::parse($first->time)->format('A') }} </small>
                             </div>
                         @endforeach
                     </div>

                     <!-- FORM -->
                     <div class="patient-form">

                         <div>
                             <label>Full Name <span class="req">*</span></label>
                             <input type="text" id="name">
                         </div>

                         <div>
                             <label>Age <span class="req">*</span></label>
                             <input type="number" id="age">
                         </div>

                         <div>
                             <label>Mobile Number <span class="req">*</span></label>
                             <input type="text" id="phone">
                         </div>

                         <div>
                             <label>Gender <span class="req">*</span></label>
                             <select id="gender">
                                 <option value="">Select</option>
                                 <option>Male</option>
                                 <option>Female</option>
                             </select>
                         </div>

                         <div class="full-width">
                             <label>Email (optional)</label>
                             <input type="email">
                         </div>

                     </div>

                 </div>
             </div>

             <!-- RIGHT (SUMMARY) -->
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

                         <!-- PAYMENT (RESTORED) -->
                         <div class="payment">
                             <button type="button">Cash</button>
                             <button type="button">Online</button>
                         </div>

                         <button id="confirmBtn" disabled>📞 Confirm Booking</button>

                     </div>

                 </div>
             </div>

         </div>

     </div>
 </section>
