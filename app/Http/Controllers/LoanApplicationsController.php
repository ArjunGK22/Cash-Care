<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanPostRequest;
use App\Models\Loan;
use App\Models\Employee;
use Illuminate\Http\Request;

class LoanApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (request()->has('filter')) {

            $employeeId = request()->filter;
            $loans = Loan::where('status', 'disbursed')
                ->where('employee_id', $employeeId)
                ->with('employee')
                ->get();


            $employeeData = Employee::all();

            // return $loans;


            return view('/active-loans', ['empData' => $employeeData, 'loanData' => $loans], compact('employeeId'));
        } 
        
        
        else {
            $employeeId = 0;
            $loans = Loan::where('status', 'disbursed')
                ->with('employee')
                ->get();


            $employeeData = Employee::all();
            return view('/active-loans', ['empData' => $employeeData, 'loanData' => $loans], compact('employeeId'));
        }

    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoanPostRequest $request)
    {

        //create a new loan application
        // $loanData = $request->validate([
        //     'employee_id' => 'required',
        //     'loan_amount' => 'required',
        //     'repayment_period' => 'required',
        //     'interest_rate' => 'required',
        //     'loan_type' => 'required',

        // ]);

        $loanData = $request->validated();

        // dd($loanData);

        Loan::create($loanData);

        // echo "created success";
        return redirect()->route('status.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        // $loan = Loan::with('employee', 'emis')->find($id);

        // return $loan;
        return view('loanDetails', ['loan' => $loan]);
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

    public function closed(){

        $loans = Loan::where('status', 'closed')
        ->with('employee')
        ->get();

        // return $loans;


        return view('closed-applications')->with('loans',$loans);
    }

}
