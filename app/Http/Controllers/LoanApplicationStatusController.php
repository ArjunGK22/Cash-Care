<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Emi;
use App\Models\Loan;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class LoanApplicationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loan_applications = Loan::with('employee')->get();
        return view('loan-applications')->with('loanApplications', $loan_applications);
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
        //update status
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        //
        $loan = Loan::findorfail($id);
        // dd($request->status);
        if ($request->status == "cancel") {
            $loan->update([
                'status' => 'rejected'
            ]);
            $emi = Emi::with('loan')->where('loan_id', $loan->id)->first();
            $emi->delete();
            return redirect()->route('loans.index');
        } else {

            $loan->update([
                'status' => $request->status
            ]);
            return redirect()->route('status.index');
        }

        
    }

    public function disburse(StatusRequest $request)
    {
        try {
            $loan = Loan::findOrFail($request->loan_id);
            $loan->update([
                'status' => 'disbursed',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'disbursed_at' => date('Y-m-d'),
                'total_payable' => $request->total_payable,
                'emi' => $request->emi,
            ]);

            // Create the EMI
            $highest_emi_number = Emi::where('loan_id', $request->loan_id)->max('emi_number');
            Emi::create([
                'loan_id' => $request->loan_id,
                'emi_number' => $highest_emi_number ? $highest_emi_number + 1 : 1,
                'emi_amount' => $request->emi,
                'remaining_emi_balance' => $request->emi,
                'remaining_emi' => $request->loan_duration,
                'billing_date' => $request->start_date,
                'due_date' => date('Y-m-d', strtotime($request->start_date . "+10 day")),
                'payment_status' => 'unpaid',
            ]);


            return redirect()->route('loans.index');

        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
