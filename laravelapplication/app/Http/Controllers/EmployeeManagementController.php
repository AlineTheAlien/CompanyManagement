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

    public function DeleteEmployee(Request $request)
    {
        $SIN = $request->input('SIN');
        DB::connection('management')->delete("DELETE FROM employee WHERE SIN = $SIN;");
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
        $SIN = $request->input('SIN');
        $employees = DB::connection('management')->select("SELECT * FROM employee WHERE SIN = $SIN;");
        return view('employees-update')->with('employee', $employees[0]);
    }
}