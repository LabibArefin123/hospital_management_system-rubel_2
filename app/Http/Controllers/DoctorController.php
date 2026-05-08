<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    /**
     * Display all doctors
     */
    public function index()
    {
        $doctors = Doctor::latest()->get();

        return view(
            'backend.doctor_management.doctor_section.index',
            compact('doctors')
        );
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view(
            'backend.doctor_management.doctor_section.create'
        );
    }

    /**
     * Store new doctor
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'speciality'         => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'success_rate'       => 'nullable|numeric',
            'experience_years'   => 'nullable|numeric',
            'total_patients'     => 'nullable|string',
            'qualification'      => 'nullable|string|max:255',
            'location'           => 'nullable|string|max:255',
            'consultation_fee'   => 'nullable|numeric',
            'availability'       => 'nullable|string|max:255',
            'about'              => 'nullable|string',
        ]);

        $doctor = new Doctor();

        $doctor->name               = $request->name;
        $doctor->speciality         = $request->speciality;
        $doctor->success_rate       = $request->success_rate;
        $doctor->experience_years   = $request->experience_years;
        $doctor->total_patients     = $request->total_patients;
        $doctor->qualification      = $request->qualification;
        $doctor->location           = $request->location;
        $doctor->consultation_fee   = $request->consultation_fee;
        $doctor->availability       = $request->availability;
        $doctor->about              = $request->about;

        /*
        |--------------------------------------------------------------------------
        | Upload Image to public/uploads/images/doctor
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Create folder if not exists
            $destinationPath = public_path('uploads/images/doctor');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // Generate image name
            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            // Move image
            $image->move($destinationPath, $imageName);

            // Save image path
            $doctor->image = 'uploads/images/doctor/' . $imageName;
        }

        $doctor->save();

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor Added Successfully');
    }

    /**
     * Show doctor details
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view(
            'backend.doctor_management.doctor_section.show',
            compact('doctor')
        );
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view(
            'backend.doctor_management.doctor_section.edit',
            compact('doctor')
        );
    }

    /**
     * Update doctor
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'name'               => 'required|string|max:255',
            'speciality'         => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'success_rate'       => 'nullable|numeric',
            'experience_years'   => 'nullable|numeric',
            'total_patients'     => 'nullable|string',
            'qualification'      => 'nullable|string|max:255',
            'location'           => 'nullable|string|max:255',
            'consultation_fee'   => 'nullable|numeric',
            'availability'       => 'nullable|string|max:255',
            'about'              => 'nullable|string',
        ]);

        $doctor->name               = $request->name;
        $doctor->speciality         = $request->speciality;
        $doctor->success_rate       = $request->success_rate;
        $doctor->experience_years   = $request->experience_years;
        $doctor->total_patients     = $request->total_patients;
        $doctor->qualification      = $request->qualification;
        $doctor->location           = $request->location;
        $doctor->consultation_fee   = $request->consultation_fee;
        $doctor->availability       = $request->availability;
        $doctor->about              = $request->about;

        /*
        |--------------------------------------------------------------------------
        | Update Image
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {

            // Delete old image
            if (
                $doctor->image &&
                File::exists(public_path($doctor->image))
            ) {

                File::delete(public_path($doctor->image));
            }

            $image = $request->file('image');

            // Create folder if not exists
            $destinationPath = public_path('uploads/images/doctor');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // Generate image name
            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            // Move image
            $image->move($destinationPath, $imageName);

            // Save image path
            $doctor->image = 'uploads/images/doctor/' . $imageName;
        }

        $doctor->save();

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor Updated Successfully');
    }

    /**
     * Delete doctor
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        // Delete image
        if (
            $doctor->image &&
            File::exists(public_path($doctor->image))
        ) {

            File::delete(public_path($doctor->image));
        }

        $doctor->delete();

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor Deleted Successfully');
    }
}
