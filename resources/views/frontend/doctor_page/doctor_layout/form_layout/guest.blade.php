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
