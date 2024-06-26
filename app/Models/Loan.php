<?php

namespace App\Models;

use App\Models\Emi;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
      'end_date' => 'date', 
      'start_date' => 'date', 
  ];


    public function employee(){

       return $this->belongsTo(Employee::class);
    }
    public function emis(){

       return $this->hasMany(Emi::class);
    }

}
