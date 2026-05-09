<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
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
