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
        $emi_data = Loan::with(['emis' => function ($query) {
                $query->where('payment_status', 'unpaid')
                    ->whereYear('billing_date', Carbon::now()->year)
                    ->whereMonth('billing_date', Carbon::now()->month);
            }])
            ->get();
    
        return view('loan-repayment', ['emiData' => $emi_data]);
    }

    public function loanRepaymentView($id)
    {
        $emi_data = Emi::with('loan.employee')->find($id);

        return view('/repayment', ['user' => $emi_data]);
    }

    // split 
    public function repayment(Request $request)
    {

        $emi = Emi::find($request->emi_id);
        $remaining_balance = intval($request->emi_payable - $request->emi_paid);

        // dd($emi->billing_date);

        if ($remaining_balance == 0) {
            //check whether its a last emi
            if ($emi['remaining_emi'] - 1 == 0) {
                //close the loan
                $emi->update([
                    'payment_status' => 'paid',
                    'remaining_emi_balance' => 0
                ]);
                // dd("updated");
                Payment::create([
                    'emi_id' => $request->emi_id,
                    'payment_amount' => $request->emi_paid + $request->fine_amount,
                    'payment_date' => now(),
                ]);

                $loan = Loan::find($request->loan_id);
                $loan->update([
                    'status' => 'closed'
                ]);
            } else {
                $emi->update([
                    'payment_status' => 'paid',
                    'remaining_emi_balance' => 0
                ]);

                // $next_emi_date = Carbon::now()->addMonth()->startOfMonth()->addDays(4);
                $next_emi_date = Carbon::createFromFormat('Y-m-d', $emi->billing_date)->addMonth()->toDateString();

                // dd(Carbon::createFromFormat('Y-m-d', $next_emi_date)->addDays(10)->toDateString());

                $emi->create([
                    'loan_id' => $request->loan_id,
                    'emi_number' => $emi['emi_number'] + 1,
                    'emi_amount' => $emi['emi_amount'],
                    'billing_date' => $next_emi_date,
                    'due_date' => Carbon::createFromFormat('Y-m-d', $next_emi_date)->addDays(10)->toDateString(),
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
            }
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
        return redirect()->route('repayment.index')->with('message', 'Payment Done successfully!');
    }


    // public function reschedule(Request $request)
    // {
    //     // dd($request->all());
    //     $emi = Emi::find($request->emiId);
    //     // dd($emi);

    //     $restart_date = Carbon::createFromFormat('Y-m-d', $request->restart_date);
    //     $restart_date = $restart_date->day(5);
    //     $due_date = Carbon::createFromFormat('Y-m-d', $request->restart_date);
    //     $due_date = $due_date->day(15);

    //     $emi->update([
    //         'billing_date' => $restart_date,
    //         'due_date' => $due_date,
    //     ]);
    //     return redirect()->route('repayment.index')->with('message','Rescheduled successfully!');
    // }

    public function reschedule(Request $request)
    {
        $emi = Emi::find($request->emiId);

        // Calculate the number of months between the current month and the restart date
        $restartDate = Carbon::createFromFormat('Y-m-d', $request->restart_date);
        $numberOfMonths = Carbon::now()->diffInMonths($restartDate);

        // Update the end_date in the Loan table by adding the number of months
        $loan = $emi->loan;
        $loan->update([
            'end_date' => $loan->end_date->addMonths($numberOfMonths)->toDateString()
        ]);

        // Update the billing date and due date for the Emi
        $restart_date = $restartDate->day(5);
        $due_date = $restartDate->day(15);

        $emi->update([
            'billing_date' => $restart_date,
            'due_date' => $due_date,
        ]);

        return redirect()->route('repayment.index')->with('message', 'Rescheduled successfully!');
    }
}
