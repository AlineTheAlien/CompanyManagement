<?php

namespace App\Http\Controllers;
use DB;

class EmployeeManagementController extends Controller
{

    public function EmployeeManagement(){
        $employees = DB::connection('management')->select("SELECT * FROM employee;");
        return view('employees')->with('employees', $employees);
    }

}