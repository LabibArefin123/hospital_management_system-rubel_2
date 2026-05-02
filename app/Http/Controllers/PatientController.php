<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('backend.patient.index', compact('patients'));
    }

    public function create()
    {
        return view('backend.patient.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'age'    => 'required|integer',
            'gender' => 'required',
        ]);

        Patient::create([
            'patient_code' => 'PAT-' . now()->year . '-' . rand(1000, 9999),
            'name'         => $request->name,
            'age'          => $request->age,
            'gender'       => $request->gender,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'blood_group'  => $request->blood_group,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        return view('backend.patient.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('backend.patient.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'age'    => 'required|integer',
            'gender' => 'required',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
