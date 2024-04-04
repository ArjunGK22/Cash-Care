<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model    
{
    use HasFactory;

    public $table = "employees";
    protected $guarded = [];

    
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function repayments()
    {
        return $this->hasManyThrough(Repayment::class, Loan::class);
    }


}
