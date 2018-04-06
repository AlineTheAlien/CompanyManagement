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

    public function SearchEmployee(Request $request)
    {
        $SIN = $request->input('sin');
        $name= $request->input('name');
        $salary= $request->input('salary');
        $gender= $request->input('gender');

        $query = "SELECT * FROM employee WHERE ";

        if ($SIN != null)
            $query = $query . "SIN = '$SIN' ";

        if ($name != null)
            if (strpos($query, 'SIN') !== false)
                $query = $query . "AND name = '$name' ";
            else
                $query = $query . "name = '$name' ";

        if ($salary != null)
            if(strpos($query, 'AND') !== false)
                $query = $query . "AND salary = '$salary' ";
            else
                $query = $query . "salary = '$salary' ";

        if ($gender != -1)
            if (strpos($query, 'AND') !== false)
                $query = $query . "AND gender = '$gender' ";
            else
                $query = $query . "gender = '$gender' ";

        $query = $query . ";";

        if (strpos($query, '=')){
            $employees = DB::connection('management')->select($query);
            return view('employees')->with('employees', $employees);
        }
        else
            return view('employees');
    }

    public function CreateEmployee(Request $request)
    {
        $SIN = $request->input('sin');
        $name= $request->input('name');
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

    public function DeleteDepartment(Request $request)
    {
        $id = $request->input('id');
        DB::connection('management')->delete("DELETE FROM department WHERE id = $id;");
    }

    public function CreateDepartment(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $manager = $request->input('manager');

        DB::connection('management')->insert("INSERT INTO department
                (`id`,`name`)
                VALUES
                ('$id','$name');");

        return redirect('departments');
    }

    public function SearchDepartment(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $managerSIN = $request->input('employeesin');

        $query = "SELECT department.id, department.name FROM department ";

        if ($managerSIN != null)
            $query = $query . "LEFT JOIN manages ON department.id = manages.departmentID";
        if ($id != null)
            $query = $query . "WHERE department.id = '$id' ";

        if ($name != null)
            if (strpos($query, 'WHERE department.id') !== false)
                $query = $query . "AND name = '$name' ";
            else
                $query = $query . "WHERE name = '$name' ";


        $query = $query . ";";

        if (strpos($query, '=')){
            $departments = DB::connection('management')->select($query);
            return view('departments')->with('departments', $departments);
        }
        else
            return view('employees');
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

    public function UpdateEmployeeInDatabase(Request $request) {
        $SIN = $request->input('sin');
        $name= $request->input('name');
        $birthDate= $request->input('birthdate');
        $phoneNumber = $request->input('phonenumber');
        $address = $request->input('address');
        $salary= $request->input('salary');
        $gender= $request->input('gender');

        DB::connection('management')->update("UPDATE employee SET 
                                              name = '$name',
                                              birthDate = '$birthDate',
                                              phoneNumber = '$phoneNumber',
                                              address = '$address',
                                              salary = '$salary',
                                              gender = '$gender'
                                              WHERE SIN = '$SIN';");
        return redirect('employees');
    }

    // Dependents
    public function DeleteDependent(Request $request)
    {
        $SIN = $request->input('dependentSIN');
        DB::connection('management')->delete("DELETE FROM employee WHERE dependentSIN = $SIN;");
    }

    public function UpdateDependent(Request $request) {
        $SIN = $request->input('dependentSIN');
        $dependents = DB::connection('management')->select("SELECT * FROM dependents WHERE dependentSIN = $SIN;");
        return view('dependents-update')->with('dependent', $dependents[0]);
    }

    public function GetAllDependents()
    {
        $projects = DB::connection('management')->select("SELECT * FROM dependents;");
        return view('dependents')->with('dependents', $projects);
    }
}