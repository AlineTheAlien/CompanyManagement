<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class EmployeeManagementController extends Controller
{

    public function GetAllEmployees()
    {
        $employees = DB::connection('management')->select("SELECT * FROM employee;");
        return view('employees')->with('employees', $employees);
    }

    public function GetEmployeeBySIN(Request $request)
    {
        $SIN = $request->input('SIN');
        $employees = DB::connection('management')->select("SELECT * FROM employee WHERE SIN = $SIN;");
        return response()->json($employees);
        //return View('employees')->with('employees', $employees);
    }

    public function CreateEmployee(Request $request)
    {
        $SIN = $request->input('sin');
        $name= $request->input('nname');
        $birthDate= $request->input('birthdate');
        $phoneNumber = $request->input('phonenumber');
        $address = $request->input('address');
        $salary= $request->input('salary');
        $gender= $request->input('gender');

        DB::connection('management')->insert("INSERT INTO employee
                (`SIN`,
                `name`,
                `birthDate`,
                `phoneNumber`,
                `address`,
                `salary`,
                `gender`)
                VALUES
                ($SIN,
                '$name',
                '$birthDate',
                '$phoneNumber',
                '$address',
                '$salary',
                '$gender');");
        return redirect('employees');
    }

    public function UpdateEmployee(Request $request) {
        return view('employees-update');
    }
}