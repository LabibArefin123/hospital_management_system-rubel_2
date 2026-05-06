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

    public function payment_page($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('frontend.payment_page.index', compact('appointment'));
    }
}
