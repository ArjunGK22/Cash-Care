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
        $employee = Employee::where('status', 'active')->get();

        return view('view-emp')->with('userdata', $employee);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPostRequest $request)
    {


        $emp_data = $request->validated();


        $user = Employee::firstOrcreate($emp_data);

        if (!$user)
            return "Error";

        return redirect()->route('employees.index')->with('message', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('emp-details')->with('empData', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UserPostRequest $request, Employee $employee)
    {

        try {

            $data = $request->validated();
            $employee->update($data);
            return redirect()->route('employees.index')->with('message', 'Employee Details Updated Successfully!');
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {

        $loans = $employee->loans;

        if ($loans->isEmpty()) {

            $employee->update(['status' => 'archieved']);
            return redirect()->route('employees.index')->with('message', 'Employee archieved Successfully!');
        } else {
            return redirect()->route('employees.index')->with('message', 'Employee cannot be archieved! As he has existing loan');
        }


        // dd($loans);

        // foreach ($loans as $loan) {
        //     $loanStatus = $loan->status;


        //     if ($loanStatus == 'disbursed') {
        //         return redirect()->route('employees.index')->with('message', 'Employee cannot be archieved! As he has existing loan');
        //     } else {
        //         $employee->update(['status' => 'archieved']);
        //         return redirect()->route('employees.index')->with('message', 'Employee archieved Successfully!');

        //     }
        // }
    }
}
