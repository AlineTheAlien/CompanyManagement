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

}