<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    use HasFactory;
    
    protected $guarded = [];


    public function loans(){

        $this->belongsTo(Loan::class);
    }

    public function employees(){

        $this->belongsTo(Employee::class);
    }
}
