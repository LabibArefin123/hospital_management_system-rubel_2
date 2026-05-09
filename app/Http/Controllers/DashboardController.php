<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function default_dashboard()
    {
        $doctor = Auth::user();

        // TOTAL APPOINTMENTS
        $totalAppointments = Appointment::count();

        // TOTAL EARNINGS (ONLY CONFIRMED)
        $totalEarnings = Appointment::where('status', 'confirmed')
            ->sum('amount');

        // COMPLETED
        $completedAppointments = Appointment::where('status', 'confirmed')
            ->count();

        // CANCELLED
        $cancelledAppointments = Appointment::where('status', 'cancelled')
            ->count();

        // LATEST APPOINTMENTS
        $latestAppointments = Appointment::with(['doctor'])
            ->latest()
            ->take(5)
            ->get();

        // ALL APPOINTMENTS GRID
        $appointments = Appointment::with(['doctor'])
            ->latest()
            ->paginate(8);

        return view('backend.dashboard', compact(
            'doctor',
            'totalAppointments',
            'totalEarnings',
            'completedAppointments',
            'cancelledAppointments',
            'latestAppointments',
            'appointments'
        ));
    }

    public function doctor_dashboard()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | FIND DOCTOR USING USER ID
        |--------------------------------------------------------------------------
        */

        $doctor = Doctor::where('user_id', $user->id)->first();

        if (!$doctor) {

            abort(403, 'Doctor profile not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL APPOINTMENTS
        |--------------------------------------------------------------------------
        */

        $totalAppointments = Appointment::where('doctor_id', $doctor->id)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | TOTAL EARNINGS
        |--------------------------------------------------------------------------
        */

        $totalEarnings = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'confirmed')
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | COMPLETED
        |--------------------------------------------------------------------------
        */

        $completedAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'confirmed')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | CANCELLED
        |--------------------------------------------------------------------------
        */

        $cancelledAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'cancelled')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | LATEST APPOINTMENTS
        |--------------------------------------------------------------------------
        */

        $latestAppointments = Appointment::with('doctor')
            ->where('doctor_id', $doctor->id)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | APPOINTMENTS
        |--------------------------------------------------------------------------
        */

        $appointments = Appointment::with('doctor')
            ->where('doctor_id', $doctor->id)
            ->latest()
            ->paginate(8);

        return view('backend.dashboard_doctor', compact(
            'doctor',
            'totalAppointments',
            'totalEarnings',
            'completedAppointments',
            'cancelledAppointments',
            'latestAppointments',
            'appointments'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
