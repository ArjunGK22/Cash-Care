<?php

namespace App\Http\Controllers;

use App\Models\Emi;
use App\Models\Loan;
use App\Models\Employee;
use App\Models\Repayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LoanApplicationController extends Controller
{

    public function test()
    {

        $loan_data = Emi::find(1);


        return $loan_data;
    }
    //view active loans
    public function viewActiveApplications()
    {

        if (request()->has('filter')) {

            $employeeId = request()->filter;
            $loans = Employee::with(['loans' => function ($query) use ($employeeId) {
                $query->where('status', 'disbursed')
                      ->where('employee_id', $employeeId);
            }])->get();

            $employeeData = Employee::all();

            // return $loans;


            return view('/active-loans', ['empData' => $employeeData, 'loanData' => $loans],compact('employeeId'));







        } else {
            $employeeId = 0;
            $loan = Employee::with(['loans' => function ($query) {
                $query->where('status', 'disbursed');
            }])->get();


            $employeeData = Employee::all();
        }



        // return $loan;


        return view('/active-loans', ['empData' => $employeeData, 'loanData' => $loan],compact('employeeId'));
    }
    public function viewActiveApplication($id)
    {



        // return "echo";

        $loan = Loan::with('employee', 'emis')->find($id);

        // return $loan;
        // $loan = Employee::with(['loans' => function ($query) {
        //     $query->where('id', 'disbursed');
        // }])->find($id);


        // $loan =  Employee::whereHas('loans', function ($query) {
        //     $query->where('status', 'disbursed');
        // })
        //     ->with('loans')
        //     ->get();

        $employeeData = Employee::all();

        // return $loan;


        return view('/loanDetails', ['empData' => $employeeData, 'loan' => $loan]);
    }

    //view loan application
    public function viewApplications()
    {

        $loan_applications = Employee::with('loans')->get();

        // return $loan_applications;

        return view('/loan-applications', ['loanApplications' => $loan_applications]);
    }

    public function saveApplication(Request $request)
    {

        $loanData = $request->validate([
            'employee_id' => 'required',
            'loan_amount' => 'required',
            'repayment_period' => 'required',
            'interest_rate' => 'required',
            'loan_type' => 'required',

        ]);

        Loan::create($loanData);

        return redirect('/loans/applications');
    }

    public function updateApplication(Request $request)
    {

        $loan = Loan::find($request->loan_id);

        $loan->update([
            'status' => 'disbursed',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'disbursed_at' => date('Y-m-d'),
            'total_payable' => $request->total_payable,
            'emi' => $request->emi,

        ]);

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

        return redirect('/loans');
    }

    public function accept($id)
    {

        $loan = Loan::find($id);

        $loan->update([
            'status' => 'accepted'
        ]);

        return redirect('loans/applications');
    }


    public function reject($id)
    {

        $loan = Loan::find($id);

        $loan->update([
            'status' => 'rejected'
        ]);

        return redirect('loans/applications');
    }

    public function cancel($id)
    {

        $loan = Loan::find($id);

        $loan->update([
            'status' => 'cancelled'
        ]);

        $emi = Emi::with('loan')->where('loan_id',$id)->first();

        // dd($emi);

        $emi->delete();

        return redirect('loans/applications');
    }
}
