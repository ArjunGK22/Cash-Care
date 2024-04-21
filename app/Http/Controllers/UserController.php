<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\Employee;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employee = Employee::all();

        return view('view-emp')->with('userdata', $employee);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPostRequest $request)
    {
        //create a new employee
        // $emp_data = $request->validate([
        //     'name' => 'required|string',
        //     'phone' => 'required|numeric|min:10|unique:employees,phone',
        //     'email' => 'required|email|unique:employees,email',
        //     'dob' => 'required', 
        //     'aadhar_no' => 'required|numeric|min:12|unique:employees,aadhar_no',
        //     'pan_no' => 'required|unique:employees,pan_no'
        // ]);

        $emp_data = $request->validated();

 
        $user = Employee::firstOrcreate($emp_data);
 
        if(!$user)
            return "Error";
        
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    { 
        return view('emp-details')->with('empData',$employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)

    {
        echo "heloo";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPostRequest $request, Employee $employee)
    {

        
        try{

            $data = $request->validated();
            
            $employee->update($data);
    
            return redirect()->route('employees.index');
        }
        catch (Exception $e){
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
    
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
