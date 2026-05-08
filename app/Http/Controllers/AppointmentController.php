<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Appointment List
     */
    public function index()
    {
        $appointments = Appointment::with([
            'doctor',
            'service',
            'user'
        ])
            ->latest()
            ->get();

        return view(
            'backend.doctor_management.appointment_section.index',
            compact('appointments')
        );
    }

    public function show($id)
    {
        $appointment = Appointment::with([
            'doctor',
            'service',
            'user'
        ])
            ->findOrFail($id);

        return view(
            'backend.doctor_management.appointment_section.show',
            compact('appointment')
        );
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment Deleted Successfully');
    }

    /**
     * Cancel Appointment
     */
    public function appointment_cancel($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 'Cancelled';

        $appointment->save();

        return redirect()
            ->back()
            ->with('success', 'Appointment Cancelled Successfully');
    }
}
