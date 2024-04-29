<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Emi;
use App\Models\Loan;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //list the pending emis
        // $emi_data = Emi::where('payment_status','unpaid')
        //     ->with('loan')
        //     ->get();

        // return view('loan-repayment')->with('emiData',$emi_data);

        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $emi_data = Emi::where('payment_status', 'unpaid')
            ->whereMonth('billing_date', $currentMonth)
            ->whereYear('billing_date', $currentYear)
            ->with('loan')
            ->get();

        return view('loan-repayment')->with('emiData', $emi_data);
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
        //display individual emi payment
        $emi_data = Emi::with('loan.employee')->find($id);

        return view('/repayment', ['user' => $emi_data]);
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
