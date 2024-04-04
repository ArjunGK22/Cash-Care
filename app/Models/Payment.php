<?php

namespace App\Models;

use App\Models\Emi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function emis(){

        $this->belongsTo(Emi::class);
    }

    
}
