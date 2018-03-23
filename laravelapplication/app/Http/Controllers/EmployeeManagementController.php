<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class EmployeeManagementController extends Controller
{

    public function GetAllDepartments()
    {
        $departments = DB::connection('management')->select("SELECT * FROM department;");
        return view('departments')->with('departments', $departments);
    }

    public function GetAllProjects()
    {
        $projects = DB::connection('management')->select("SELECT * FROM project;");
        return view('projects')->with('projects', $projects);
    }

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

    public function CreateEmployee()
    {
        return view('employees-create');
//        DB::connection('management')->select("INSERT INTO employee
//                (`SIN`,
//                `name`,
//                `birthDate`,
//                `phoneNumber`,
//                `address`,
//                `salary`,
//                `gender`)
//                VALUES
//                (123432432,
//                'Test',
//                '1990-12-14',
//                '911',
//                '1234',
//                '5',
//                'M');
//                ;");
//        $employees = DB::connection('management')->select("SELECT * FROM employee;");
//        return view('employees')->with('employees', $employees);
    }

    public function CreateDepartment()
    {
        return view('departments-create');
    }

    public function CreateProject()
    {
        return view('projects-create');
    }

    public function UpdateEmployee(Request $request) {
        return view('employees-update');
    }
}