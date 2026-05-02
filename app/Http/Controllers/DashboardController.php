<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();
        $totalBills = Bill::count();
        return view('backend.dashboard', compact(
            'totalDoctors',
            'totalPatients',
            'totalAppointments',
            'totalBills'
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

    public function globalSearch(Request $request)
    {
        $term = trim($request->input('term'));
        Log::info('Global search term: ' . $term);

        if (!$term || strlen($term) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Try parse date (for appointments/bills)
        $parsedDate = null;
        try {
            $parsedDate = Carbon::parse($term)->format('Y-m-d');
        } catch (\Exception $e) {
            $parsedDate = null;
        }

        /* ==========================
       1️⃣ Patients
    ========================== */
        $patients = Patient::query()
            ->where(function ($q) use ($term, $parsedDate) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('patient_code', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%")
                    ->orWhere('address', 'like', "%{$term}%")
                    ->orWhere('blood_group', 'like', "%{$term}%");

                if ($parsedDate) {
                    $q->orWhereDate('created_at', $parsedDate);
                }
            })
            ->latest()
            ->limit(10)
            ->get();

        foreach ($patients as $p) {
            $results[] = [
                'label' => "[Patient] {$p->name} ({$p->patient_code}) | Phone: {$p->phone}",
                'url'   => route('patients.show', $p->id),
                'group' => 'Patients',
            ];
        }

        /* ==========================
       2️⃣ Doctors
    ========================== */
        $doctors = Doctor::query()
            ->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%")
                    ->orWhere('specialization', 'like', "%{$term}%");
            })
            ->latest()
            ->limit(10)
            ->get();

        foreach ($doctors as $d) {
            $results[] = [
                'label' => "[Doctor] {$d->name} | {$d->specialization} | Phone: {$d->phone}",
                'url'   => route('doctors.show', $d->id),
                'group' => 'Doctors',
            ];
        }

        /* ==========================
       3️⃣ Appointments
    ========================== */
        $appointments = Appointment::with(['doctor', 'patient'])
            ->where(function ($q) use ($term) {
                $q->whereHas('patient', fn($q2) => $q2->where('name', 'like', "%{$term}%"))
                    ->orWhereHas('doctor', fn($q2) => $q2->where('name', 'like', "%{$term}%"))
                    ->orWhere('status', 'like', "%{$term}%");
            })
            ->when($parsedDate, fn($q) => $q->whereDate('appointment_date', $parsedDate))
            ->latest()
            ->limit(10)
            ->get();

        foreach ($appointments as $a) {
            $results[] = [
                'label' => "[Appointment] {$a->patient->name} with Dr. {$a->doctor->name} on {$a->appointment_date} ({$a->status})",
                'url'   => route('appointments.show', $a->id),
                'group' => 'Appointments',
            ];
        }

        /* ==========================
       4️⃣ Bills
    ========================== */
        $bills = Bill::with('patient')
            ->whereHas('patient', fn($q) => $q->where('name', 'like', "%{$term}%"))
            ->orWhere('total_amount', 'like', "%{$term}%")
            ->latest()
            ->limit(10)
            ->get();

        foreach ($bills as $b) {
            $results[] = [
                'label' => "[Bill] {$b->patient->name} | Total: {$b->total_amount} BDT",
                'url'   => route('bills.show', $b->id),
                'group' => 'Bills',
            ];
        }

        return response()->json($results);
    }

    protected function highlightMatch(string $text, string $term): string
    {
        if (!$term) {
            return e($text);
        }

        return preg_replace(
            "/(" . preg_quote($term, '/') . ")/i",
            '<span style="color:#ff6b6b;">$1</span>',
            e($text)
        );
    }
}
