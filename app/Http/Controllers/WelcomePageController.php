<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\SystemProblem;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WelcomePageController extends Controller
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

    public function service_page_1()
    {
        return view('frontend.service_page.page_1.service_1');
    }

    public function service_page_2()
    {
        return view('frontend.service_page.page_2.service_2');
    }

    public function service_page_3()
    {
        return view('frontend.service_page.page_3.service_3');
    }

    public function service_page_4()
    {
        return view('frontend.service_page.page_4.service_4');
    }

    public function service_page_5()
    {
        return view('frontend.service_page.page_5.service_5');
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
        // 🔹 BASE VALIDATION (common for both)
        $request->validate([
            'type' => 'required|in:doctor,service',
            'name' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'gender' => 'required',
            'payment_method' => 'required',
            'email' => 'nullable|email',
        ]);

        $appointment = null;

        /* ================= DOCTOR BOOKING ================= */
        if ($request->type === 'doctor') {

            $request->validate([
                'doctor_id' => 'required',
                'appointment_date' => 'required|date',
                'appointment_time' => 'required',
            ]);

            // 🚫 Slot already booked
            $slotBooked = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->exists();

            if ($slotBooked) {
                return back()->withErrors(['This time slot is already booked.']);
            }

            // 🚫 One booking per user per doctor
            $userBooked = Appointment::where('user_id', Auth::id())
                ->where('doctor_id', $request->doctor_id)
                ->exists();

            if ($userBooked) {
                return back()->withErrors(['You already booked this doctor once.']);
            }

            $status = $request->payment_method === 'Online' ? 'confirmed' : 'pending';

            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'type' => 'doctor',
                'doctor_id' => $request->doctor_id,
                'name' => $request->name,
                'age' => $request->age,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'email' => $request->email,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'payment_method' => $request->payment_method,
                'amount' => 0,
                'status' => $status,
            ]);

            DoctorSchedule::where('doctor_id', $request->doctor_id)
                ->where('date', $request->appointment_date)
                ->where('time', $request->appointment_time)
                ->update(['is_booked' => 1]);
        }

        /* ================= SERVICE BOOKING ================= */
        if ($request->type === 'service') {

            $request->validate([
                'service_id' => 'required',
                // ❌ NO date/time validation here
            ]);

            // 🚫 Prevent duplicate service booking per user
            $alreadyBooked = Appointment::where('user_id', Auth::id())
                ->where('service_id', $request->service_id)
                ->exists();

            if ($alreadyBooked) {
                return back()->withErrors(['You already booked this service.']);
            }

            // 🚫 Unique phone (optional rule you already use)

            $status = $request->payment_method === 'Online' ? 'confirmed' : 'pending';

            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'type' => 'service',
                'service_id' => $request->service_id,
                'name' => $request->name,
                'age' => $request->age,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'email' => $request->email,
                'appointment_date' => null,
                'appointment_time' => null,
                'payment_method' => $request->payment_method,
                'amount' => 0,
                'status' => $status,
            ]);
        }

        /* ================= PAYMENT REDIRECT ================= */
        if ($request->payment_method === 'Online') {
            return redirect()->route('payment.page', $appointment->id);
        }

        return back()->with('success', 'Appointment booked successfully');
    }

    public function payment_page($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('frontend.payment_page.index', compact('appointment'));
    }
}
