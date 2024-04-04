<?php

namespace App\Models;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emi extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function loan()
    {

        return $this->belongsTo(Loan::class);
    }

    public function employees()
    {

        $this->belongsTo(Employee::class);
    }

    public function emis()
    {

        $this->hasMany(Payment::class);
    }

    public function calculatePrincipalAndInterest($loanAmount, $annualInterestRate, $currentPaymentNumber, $emiAmount)
    {
        // Calculate monthly interest rate
        $monthlyInterestRate = ($annualInterestRate / 12) / 100;

        // Calculate remaining outstanding balance
        $outstandingBalance = $loanAmount;
        for ($i = 1; $i < $currentPaymentNumber; $i++) {
            $outstandingBalance -= $emiAmount - ($outstandingBalance * $monthlyInterestRate);
        }

        // Calculate interest component for the current month
        $interestComponent = $outstandingBalance * $monthlyInterestRate;

        // Calculate principal component for the current month
        $principalComponent = $emiAmount - $interestComponent;

        return [
            'principal' => $principalComponent,
            'interest' => $interestComponent,
        ];
    }


    protected $appends = ['principal_amount','interest_amount','current_status','fine_amount'];

    public function getPrincipalAmountAttribute()
    {

        $principal = $this->loan->total_payable;
        $interest_rate = $this->loan->interest_rate;
        // $remainingPayments = $this->loan->repayment_period;
        $emiAmount = $this->loan->emi;
        $currentPaymentNumber = $this->emi_number;
        $result = $this->calculatePrincipalAndInterest($principal, $interest_rate, $currentPaymentNumber,$emiAmount);
        return $result['principal'];
    }

    public function getInterestAmountAttribute()
    {

        $principal = $this->loan->total_payable;
        $interest_rate = $this->loan->interest_rate;
        // $remainingPayments = $this->loan->repayment_period;
        $emiAmount = $this->loan->emi;
        $currentPaymentNumber = $this->emi_number;
        $result = $this->calculatePrincipalAndInterest($principal, $interest_rate, $currentPaymentNumber,$emiAmount);
        return $result['interest'];
    }

    public function getCurrentStatusAttribute(){

        if($this->due_date < date('Y-m-d') && date('Y-m-d') > $this->billing_date){
            return "Unpaid";
        }
        else if (date('Y-m-d') > $this->due_date) {

            return "Over due";

        }

        else{

            return "In Progress";
        }
    }

    public function getFineAmountAttribute(){

        $current_date = now();
        $due_date = \Illuminate\Support\Carbon::createFromFormat('Y-m-d', $this->due_date);

        if ($current_date->greaterThan($due_date)) {

            $interval = $due_date->diff($current_date->format('Y-m-d'));


            $fine_amount = 20 * $interval->days;

            return $fine_amount;


            // return $due_date;

        }

        else{

            return 0;
        }

        
    }


}
