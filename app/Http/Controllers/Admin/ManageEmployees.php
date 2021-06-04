<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeReques;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageEmployees extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin', $request->user());

        //get the employees with eager loading
        $employees = Employee::with('company')->paginate(10);

        return view('admin.Employee.manage', [
            'employees'=> $employees,
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('admin', $request->user());
        $companies = Company::get();
        return view('admin.Employee.add',[
            'companies'=>$companies
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        //authorize and validate the request
        $request->authorize();
        $request->validated();

        Employee::create([
           'firstname'=> $request->firstname,
           'lastname'=>$request->lastname,
            'company_id' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        User::create([
           'name'=> $request->firstname . ' ' . $request->lastname,
           'email'=> $request->email,
           'password'=> Hash::make('password')
        ]);

        return redirect()->route('employees.create')->with('status', 'Employee added successfully');
    }

    public function edit(Employee $employee, Request $request)
    {
        $this->authorize('admin', $request->user());
        $companies = Company::get();
        return view('admin.Employee.edit',[
            'companies'=>$companies,
            'employee' => $employee
        ]);
    }

    public function update(UpdateEmployeeReques $request, Employee $employee)
    {
        //authorize and validate the request
        $request->authorize();
        $request->validated();

        //update the user
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->company_id = $request->company;
        $employee->phone = $request->phone;

        $employee->save();

        return redirect()->route('employees.edit', $employee)->with('status', 'Employee updated successfully');


    }

    public function destroy(Employee $employee, Request $request)
    {
        $this->authorize('admin', $request->user());

        //delete the employee from the users table and then from the employees table
        User::where('email', $employee->email)->delete();
        $employee->delete();

        return redirect()->route('employees.index');

    }
}
