<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\SystemProblem;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.welcome');
    }

    public function doctor(Request $request)
    {
        $search = $request->query('search');

        $doctors = Doctor::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('speciality', 'like', "%$search%");
        })->get();

        return view('frontend.doctor_page.doctor', compact('doctors', 'search'));
    }

    public function doctor_show($id)
    {
        $doctor = \App\Models\Doctor::with('schedules')->findOrFail($id);

        // group by date
        $groupedSchedules = $doctor->schedules
            ->where('is_booked', false)
            ->groupBy('date');

        return view('frontend.doctor_page.doctor_information.show', compact('doctor', 'groupedSchedules'));
    }

    public function service_show($id)
    {
        $service = Service::findOrFail($id);

        return view('frontend.service_page.service_show', compact('service'));
    }

    public function contact()
    {
        return view('frontend.contact_page.contact');
    }

    public function service()
    {
        $services = Service::all();

        return view('frontend.service_page.service', compact('services'));
    }

    public function appointment()
    {
        $doctorAppointments = Appointment::with('doctor')
            ->where('user_id', auth()->id())
            ->whereNotNull('doctor_id')
            ->latest()
            ->get();

        $serviceAppointments = Appointment::with('service')
            ->where('user_id', auth()->id())
            ->whereNotNull('service_id')
            ->latest()
            ->get();

        return view('frontend.appointment_page.appointment', compact(
            'doctorAppointments',
            'serviceAppointments'
        ));
    }

    public function appointment_store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:doctor,service',
            'name' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'gender' => 'required',
            'payment_method' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'email' => 'nullable|email',
        ]);

        $status = $request->payment_method === 'Online' ? 'confirmed' : 'pending';

        /* ================= DOCTOR ================= */
        if ($request->type === 'doctor') {

            $doctor = Doctor::findOrFail($request->doctor_id);

            // Slot check
            $slotBooked = Appointment::where('doctor_id', $doctor->id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->exists();

            if ($slotBooked) {
                return back()->withErrors(['This time slot is already booked.']);
            }

            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'type' => 'doctor',
                'doctor_id' => $doctor->id,
                'name' => $request->name,
                'age' => $request->age,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'email' => $request->email,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'payment_method' => $request->payment_method,
                'amount' => $doctor->consultation_fee,
                'status' => $status,
            ]);
        }

        /* ================= SERVICE ================= */ elseif ($request->type === 'service') {

            $service = Service::findOrFail($request->service_id);

            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'type' => 'service',
                'service_id' => $service->id,
                'name' => $request->name,
                'age' => $request->age,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'email' => $request->email,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'payment_method' => $request->payment_method,
                'amount' => $service->price,
                'status' => $status,
            ]);
        }

        /* ================= PAYMENT ================= */
        if ($request->payment_method === 'Online') {
            return redirect()->route('payment.page', $appointment->id);
        }

        return back()->with('success', 'Appointment booked successfully');
    }

    public function payment_store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:1',
            'card_number' => 'required|min:12|max:19',
            'expiry' => 'required',
            'cvv' => 'required|min:3|max:4',
        ]);

        /* ================= FETCH APPOINTMENT ================= */
        $appointment = Appointment::where('id', $request->appointment_id)
            ->where('user_id', auth()->id()) 
            ->firstOrFail();

        /* ================= ALREADY PAID ================= */
        // if ($appointment->status === 'confirmed') {
        //     return back()->with('error', '⚠️ This appointment is already paid.');
        // }

        /* ================= STRICT AMOUNT CHECK ================= */
        if ((float)$request->amount !== (float)$appointment->amount) {
            return back()->with('error', '❌ Please pay the full amount!');
        }

        /* ================= BASIC CARD VALIDATION ================= */
        if (strlen(preg_replace('/\s+/', '', $request->card_number)) < 12) {
            return back()->with('error', '❌ Invalid Card Number');
        }

        /* ================= DETERMINE SOURCE ================= */
        $paymentFor = $appointment->type === 'doctor'
            ? 'Doctor: ' . optional($appointment->doctor)->name
            : 'Service: ' . optional($appointment->service)->name;

        /* ================= CREATE PAYMENT ================= */
        Payment::create([
            'user_id' => auth()->id(),
            'appointment_id' => $appointment->id,
            'payment_method' => 'Card',
            'transaction_id' => 'TXN_' . strtoupper(Str::random(10)),
            'amount' => $appointment->amount,
            'card_number' => substr($request->card_number, -4),
            'expiry' => $request->expiry,
            'cvv' => null, // never store
            'status' => 'paid',
        ]);

        /* ================= UPDATE APPOINTMENT ================= */
        $appointment->update([
            'status' => 'confirmed'
        ]);

        /* ================= REDIRECT BASED ON TYPE ================= */
        if ($appointment->type === 'doctor') {
            return redirect()->route('doctor.show', $appointment->doctor_id)
                ->with('success', '✅ Payment successful! Doctor appointment confirmed.');
        } else {
            return redirect()->route('service.show', $appointment->service_id)
                ->with('success', '✅ Payment successful! Service booked successfully.');
        }
    }

    public function payment_page($id)
    {
        $appointment = Appointment::with(['doctor', 'service'])
            ->where('id', $id)
            ->firstOrFail();

        // ❌ already paid
        return view('frontend.payment_page.index', compact('appointment'));
    }
}
