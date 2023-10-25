<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class EmployeeController extends Controller
{
    public function create(Request $request)
    {
        
        $employee = Employee::create([
            "idRol" => $request->idRol,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            'password' => Hash::make($request->password),
            "email" => $request->email,
            "created_at" => now()
        ]);

    }

    public function update(Request $request)
    {
        $employee = Employee::find($request->id);

        $employee->idRol = $request->idRol;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->password = Hash::make($request->password);
        $employee->email = $request->email;
        
        $employee->save();
        return $employee;
    }

    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->delete();
        
    }

    public function getEmployee(Request $request) {
        $data = DB::table('employees')
                    ->join('roles', 'employees.idRol', '=', 'roles.id')
                    ->select('employees.id', 'employees.idRol','employees.first_name', 'employees.last_name', 'employees.email', 'employees.created_at', 'roles.name')
                    ->get();

        return $data;
    }

    public function getRole(Request $request) {
        $role = Role::all();

        return $role;
    }
}
