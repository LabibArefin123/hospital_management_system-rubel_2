<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\SystemProblem;
use Illuminate\Http\Request;
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

    public function contact()
    {
        return view('frontend.contact_page.contact');
    }

    public function service()
    {
        return view('frontend.service_page.service');
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
        $request->validate([
            'doctor_id' => 'required',
            'name' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'gender' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'payment_method' => 'required',
        ]);

        // 🚫 Prevent same slot booking
        $slotBooked = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();

        if ($slotBooked) {
            return back()->withErrors([
                'This time slot is already booked.'
            ]);
        }

        // 🚫 Prevent duplicate booking by logged user
        $userBooked = Appointment::where('user_id', Auth::id())
            ->where('doctor_id', $request->doctor_id)
            ->exists();

        if ($userBooked) {
            return back()->withErrors([
                'You already booked this doctor once.'
            ]);
        }

        // 🚫 Prevent duplicate name
        $nameExists = Appointment::where('name', $request->name)->exists();

        if ($nameExists) {
            return back()->withErrors([
                'This name has already been used for booking.'
            ]);
        }

        // 🚫 Prevent duplicate phone
        $phoneExists = Appointment::where('phone', $request->phone)->exists();

        if ($phoneExists) {
            return back()->withErrors([
                'This phone number has already been used for booking.'
            ]);
        }

        // Status logic
        $status = $request->payment_method === 'Online'
            ? 'confirmed'
            : 'pending';

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

        // Mark slot booked
        DoctorSchedule::where('doctor_id', $request->doctor_id)
            ->where('date', $request->appointment_date)
            ->where('time', $request->appointment_time)
            ->update([
                'is_booked' => 1
            ]);

        // Online payment redirect
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
