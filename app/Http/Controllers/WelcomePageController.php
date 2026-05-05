<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\SystemProblem;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
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
}
