<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient'])
            ->latest()
            ->paginate(10);

        return view('backend.appointment.index', compact('appointments'));
    }

    public function create()
    {
        $doctors  = Doctor::where('is_available', 1)->get();
        $patients = Patient::all();

        return view('backend.appointment.create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:doctors,id',
            'patient_id'       => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status'           => 'required|in:Pending,Approved,Completed',
        ]);

        Appointment::create($request->only([
            'doctor_id',
            'patient_id',
            'appointment_date',
            'appointment_time',
            'status',
        ]));

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('backend.appointment.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $doctors  = Doctor::where('is_available', 1)->get();
        $patients = Patient::all();

        return view('backend.appointment.edit', compact('appointment', 'doctors', 'patients'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:doctors,id',
            'patient_id'       => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status'           => 'required|in:Pending,Approved,Completed',
        ]);

        $appointment->update($request->only([
            'doctor_id',
            'patient_id',
            'appointment_date',
            'appointment_time',
            'status',
        ]));

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
