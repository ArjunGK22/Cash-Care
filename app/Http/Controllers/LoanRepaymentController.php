<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Emi;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Employee;
use App\Models\Repayment;
use Illuminate\Http\Request;

class LoanRepaymentController extends Controller
{
    public function view()
    {

        // return "echo";

        $emi_data = Loan::with(['emis' => function ($query) {
            $query->where('payment_status', 'unpaid')
            // ->whereDate('billing_date', '>=', Carbon::now()->toDateString())
            // ->whereMonth('billing_date', '=', Carbon::now()->month)
;
        }])
        ->get();

        // return $emi_data;
        return view('/loan-repayment', ['emiData' => $emi_data]);
    }

    public function loanRepaymentView($id)
    {

        // $loan_data = Employee::with(['loans.emis' => function ($query) {
        //     $query->where('payment_status', 'unpaid')->select('id');
        // }])->find($id)->pluck('loans.emis.*.id')->flatten();

        $emi_data = Emi::with('loan.employee')->find($id);

        
        
        

        // return $emi_data;  

        return view('/repayment', ['user' => $emi_data]);
    }

    public function repayment(Request $request)
    {
        // return response()->json(['msg' => 'receiveed']);

        $emi = Emi::find($request->emi_id);

        // return $emi;



        switch ($request->input('action')) {

            case 'Repay':
                // dd('EMi paid: ' .$request->emi_paid .'Emi payable: ' .$request->emi_payable);
                $remaining_balance = $request->emi_payable - $request->emi_paid;

                if ($remaining_balance == 0) {

                    //check whether its a last emi

                    if ($emi['remaining_emi'] - 1 == 0) {
                        //close the loan
                        $emi->update([
                            'payment_status' => 'paid',
                            'remaining_emi_balance' => 0
    
                        ]);

                        Payment::create([
                            'emi_id' => $request->emi_id,
                            'payment_amount' => $request->emi_paid + $request->fine_amount,
                            'payment_date' => now(),
                        ]);

                        $loan = Loan::find($request->loan_id);
                        
                        $loan->update([
                           'status' => 'closed' 
                        ]);

                    }

                    

                    $emi->update([
                        'payment_status' => 'paid',
                        'remaining_emi_balance' => 0

                    ]);

                    $next_emi_date = Carbon::now()->addMonth()->startOfMonth()->addDays(4);
                    // return $next_emi_date;
                    $emi->create([
                        'loan_id' => $request->loan_id,
                        'emi_number' => $emi['emi_number'] + 1,
                        'emi_amount' => $emi['emi_amount'],
                        'billing_date' => $next_emi_date,
                        'due_date' => Carbon::now()->addMonth()->startOfMonth()->addDays(14),
                        'remaining_emi_balance' => $emi['emi_amount'],
                        'payment_status' => 'unpaid',
                        'remaining_emi' => $emi['remaining_emi'] - 1

                    ]);


                    //create a payment record
                    Payment::create([
                        'emi_id' => $request->emi_id,
                        'payment_amount' => $request->emi_paid + $request->fine_amount,
                        'payment_date' => now(),
                    ]);
                } else {

                    $emi->update([
                        'remaining_emi_balance' => $request->emi_payable - $request->emi_paid,

                    ]);

                    Payment::create([
                        'emi_id' => $request->emi_id,
                        'payment_amount' => $request->emi_paid + $request->fine_amount,
                        'payment_date' => now(),
                    ]);
                }




                return redirect('/loans');
                break;

            
        }
    }


    public function reschedule(Request $request){

        $emi = Emi::find($request->emiId);

        $restart_date = Carbon::createFromFormat('Y-m-d', $request->restart_date);
        $restart_date = $restart_date->day(5);
        $due_date = Carbon::createFromFormat('Y-m-d', $request->restart_date);

        $due_date = $due_date->day(15);

        // dd($restart_date . $due_date);

        $emi->update([
            'billing_date' => $restart_date,
            'due_date' => $due_date,
        ]);

        return redirect('loans/repayment');
        
        


    }
}
