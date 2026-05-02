<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Patient;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('patient')->latest()->paginate(10);
        return view('backend.bill.index', compact('bills'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('backend.bill.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
        ]);

        $total =
            ($request->consultation_fee ?? 0) +
            ($request->medicine_charge ?? 0) +
            ($request->test_charge ?? 0);

        Bill::create([
            'patient_id'        => $request->patient_id,
            'consultation_fee'  => $request->consultation_fee,
            'medicine_charge'   => $request->medicine_charge,
            'test_charge'       => $request->test_charge,
            'total_amount'      => $total,
        ]);

        return redirect()->route('bills.index')
            ->with('success', 'Bill generated successfully.');
    }

    public function show(Bill $bill)
    {
        return view('backend.bill.show', compact('bill'));
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();

        return redirect()->route('bills.index')
            ->with('success', 'Bill deleted successfully.');
    }
}
