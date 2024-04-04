<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class UserCreateController extends Controller
{

    public function view(){

        $userdata = Employee::all();
        return view('view-emp',['userdata' => $userdata]);
    }
    
    public function saveEmployee(Request $request){

        //validate the request
        $emp_data = $request->validate([
           'name' => 'required|string',
           'phone' => 'required|numeric|min:10|unique:employees,phone',
           'email' => 'required|email|unique:employees,email',
           'dob' => 'required',
           'aadhar_no' => 'required|numeric|min:12|unique:employees,aadhar_no',
           'pan_no' => 'required|unique:employees,pan_no'
       ]);


       $user = Employee::firstOrcreate($emp_data);

       if(!$user)
           return "Error";
       
       return redirect('/employees');
   }

}
