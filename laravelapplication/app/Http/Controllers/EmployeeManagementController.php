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
        $departments = DB::connection('management')->select("SELECT * FROM department;");
        return view('employees')->with('employees', $employees)
                                     ->with('departments', $departments);
    }

    public function GetEmployeeBySIN(Request $request)
    {
        $SIN = $request->input('SIN');
        $employees = DB::connection('management')->select("SELECT * FROM employee WHERE SIN = $SIN;");
        return response()->json($employees);
    }

    public function GetManager(Request $request)
    {
        $id = $request->input('id');
        $query = "SELECT * FROM employee LEFT JOIN manages ON employee.SIN = manages.employeeSIN WHERE manages.departmentID = $id;";
        $employees = DB::connection('management')->select($query);
        return response()->json($employees);
    }

    public function GetDependents(Request $request)
    {
        $SIN = $request->input('SIN');
        $query = "SELECT dependent.name, dependent.gender, dependent.birthDate, dependent.dependentSIN
                  FROM dependent LEFT JOIN employee ON employee.SIN = dependent.employeeSIN WHERE dependent.employeeSIN = $SIN;";
        $dependents = DB::connection('management')->select($query);
        return response()->json($dependents);
    }

    public function GetProjects(Request $request)
    {
        $SIN = $request->input('SIN');
        $query = "SELECT project.id, project.name, project.location, works_on.hours
                  FROM project LEFT JOIN works_on ON project.id = works_on.projectID WHERE works_on.employeeSIN = $SIN;";
        $projects = DB::connection('management')->select($query);
        return response()->json($projects);
    }

    public function GetEmployeesAssignedOnProject(Request $request)
    {
        $id = $request->input('id');
        $query = "SELECT * FROM employee 
                  LEFT JOIN works_on ON employee.SIN = works_on.employeeSIN WHERE works_on.projectID = $id;";
        $employees = DB::connection('management')->select($query);
        return response()->json($employees);
    }

    public function SearchEmployee(Request $request)
    {
        $SIN = $request->input('sin');
        $name= $request->input('name');
        $salary= $request->input('salary');
        $departmentID = $request->input('department_id');
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

        if ($departmentID != -1)
            if(strpos($query, 'AND') !== false)
                $query = $query . "AND departmentID = '$departmentID' ";
            else
                $query = $query . "departmentID = '$departmentID' ";

        if ($gender != -1)
            if (strpos($query, 'AND') !== false)
                $query = $query . "AND gender = '$gender' ";
            else
                $query = $query . "gender = '$gender' ";

        $query = $query . ";";

        $departments = DB::connection('management')->select("SELECT * FROM department;");


        if (strpos($query, '=')){
            $employees = DB::connection('management')->select($query);
            return view('employees')->with('employees', $employees)
                                         ->with('departments', $departments);
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
        $departmentID = $request->input ('department_id');
        $address = $request->input('address');
        $salary= $request->input('salary');
        $gender= $request->input('gender');

        DB::connection('management')->insert("INSERT INTO employee
                (`SIN`,
                `name`,
                `birthDate`,
                `phoneNumber`,
                `departmentID`,
                `address`,
                `salary`,
                `gender`)
                VALUES
                ($SIN,
                '$name',
                '$birthDate',
                '$phoneNumber',
                '$departmentID',
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

    public function DeleteProject(Request $request)
    {
        $id = $request->input('id');
        DB::connection('management')->delete("DELETE FROM project WHERE id = $id;");
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

    public function CreateDepartmentManager(Request $request) {
        $id = $request->input('id');
        $departments = DB::connection('management')->select("SELECT * FROM department WHERE id = $id;");
        return view('departments-create-manager')->with('department', $departments[0]);
    }

    public function CreateDepartmentManagerInDatabase(Request $request)
    {
        $id = $request->input('id');
        $employeeSIN = $request->input('employeesin');
        $startDate = $request->input('startdate');

        DB::connection('management')->insert("INSERT INTO manages
                (`employeeSIN`,`departmentID`,`startDate`)
                VALUES
                ('$employeeSIN','$id','$startDate');");

        return redirect('departments');
    }

    public function SearchDepartment(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $managerSIN = $request->input('employeesin');

        $query = "SELECT department.id, department.name FROM department ";

        if ($managerSIN != null && $id != null && $name != null) {
            $query = $query . "LEFT JOIN manages ON department.id = manages.departmentID ";
            $query = $query . "WHERE department.id = '$id' AND department.name = '$name' AND manages.employeeSIN = '$managerSIN'";
        }
        else if ($managerSIN != null && $name != null) {
            $query = $query . "LEFT JOIN manages ON department.id = manages.departmentID ";
            $query = $query . "WHERE manages.employeeSIN = '$managerSIN' AND department.name = '$name'";
        }
        else if ($managerSIN != null && $id != null) {
            $query = $query . "LEFT JOIN manages ON department.id = manages.departmentID ";
            $query = $query . "WHERE manages.employeeSIN = '$managerSIN' AND department.id = '$id' ";
        }
        else if ($name != null && $id != null) {
            $query = $query . "WHERE department.name = '$name' AND department.id = '$id' ";
        }
        else if ($name != null)
            $query = $query . "WHERE name = '$name'";
        else if ($id != null)
            $query = $query . "WHERE department.id = '$id'";
        else if ($managerSIN != null) {
            $query = $query . "LEFT JOIN manages ON department.id = manages.departmentID ";
            $query = $query . "WHERE manages.employeeSIN = '$managerSIN'";
        }


        $query = $query . ";";

        if (strpos($query, '=')){
            $departments = DB::connection('management')->select($query);
            return view('departments')->with('departments', $departments);
        }
        else
            return view('employees');
    }

    public function CreateProject(Request $request)
    {
        $id = $request->input('id');
        $location = $request->input('location');
        $name= $request->input('name');

        DB::connection('management')->insert("INSERT INTO project
                (`id`, 
                `location`,
                `name`)
                VALUES
                ($id,
                '$location',
                '$name');");
        return redirect('projects');
    }

    public function UpdateDepartment(Request $request) {
        $id = $request->input('id');
        $departments = DB::connection('management')->select("SELECT * FROM department WHERE id = $id;");
        return view('departments-update')->with('department', $departments[0]);
    }

    public function UpdateDepartmentInDatabase(Request $request) {
        $id = $request->input('id');
        $name= $request->input('name');
        $managerSIN= $request->input('employeeSIN');

        DB::connection('management')->update("UPDATE department SET 
                                              name = '$name'
                                              WHERE id = '$id';");

        return redirect('departments');
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

    public function UpdateDepartmentManager(Request $request) {
        $id = $request->input('id');
        $manages = DB::connection('management')->select("SELECT * FROM manages WHERE departmentID = $id;");
        if ($manages != null) {
            return view('departments-update-manager')->with('manages', $manages[0]);
        }
    }

    public function UpdateDepartmentManagerInDatabase(Request $request) {
        $id = $request->input('id');
        $managerSIN= $request->input('employeeSIN');
        $startDate= $request->input('startDate');

        DB::connection('management')->update("UPDATE manages SET 
                                              employeeSIN = $managerSIN,
                                              startDate = $startDate
                                              WHERE id = '$id';");

        return redirect('departments');
    }

    public function UpdateProject(Request $request) {
        $id = $request->input('id');
        $projects = DB::connection('management')->select("SELECT * FROM project WHERE id = $id;");
        return view('projects-update')->with('project', $projects[0]);
    }

    public function UpdateProjectInDatabase(Request $request) {

        return redirect('projects');
    }

    // Dependents
    public function DeleteDependent(Request $request)
    {
        $SIN = $request->input('dependentSIN');
        DB::connection('management')->delete("DELETE FROM dependent WHERE dependentSIN = $SIN;");
    }

    public function UpdateDependent(Request $request) {
        $SIN = $request->input('dependentSIN');
        $dependents = DB::connection('management')->select("SELECT * FROM dependent WHERE dependentSIN = $SIN;");
        return view('dependents-update')->with('dependent', $dependents[0]);
    }

    public function GetAllDependents()
    {
        $projects = DB::connection('management')->select("SELECT * FROM dependent;");
        return view('dependents')->with('dependents', $projects);
    }

    public function CreateDependent(Request $request)
    {
        $dependentSIN = $request->input('dependentsin');
        $employeeSIN = $request->input('employeesin');
        $name= $request->input('name');
        $birthDate= $request->input('birthdate');
        $phoneNumber = $request->input('phonenumber');
        $address = $request->input('address');
        $gender= $request->input('gender');

        DB::connection('management')->insert("INSERT INTO dependent
                (`dependentSIN`,
                `employeeSIN`,
                `name`,
                `gender`,
                `birthDate`,
                `phoneNumber`,
                `address`)
                VALUES
                ('$dependentSIN',
                '$employeeSIN',
                '$name',
                '$gender',
                '$birthDate');");
        return redirect('dependents');
    }

    public function UpdateDependentInDatabase(Request $request) {
        $dependentSIN = $request->input('dependentsin');
        $employeeSIN = $request->input('employeesin');
        $name= $request->input('name');
        $gender= $request->input('gender');
        $birthDate= $request->input('birthdate');

        DB::connection('management')->update("UPDATE dependent SET 
                                              dependentSIN = '$dependentSIN',
                                              employeeSIN = '$employeeSIN',
                                              name = '$name',
                                              gender = '$gender',
                                              birthDate = '$birthDate'
                                              WHERE dependentSIN = '$dependentSIN';");
        return redirect('dependents');
    }

    public function SearchDependent(Request $request)
    {
        $dependentSIN = $request->input('dependentsin');
        $employeeSIN = $request->input('employeesin');
        $name= $request->input('name');
        $gender= $request->input('gender');
        $birthDate= $request->input('birthdate');

        $query = "SELECT * FROM dependent WHERE ";

        if ($dependentSIN != null)
            $query = $query . "dependentSIN = '$dependentSIN' ";

        if ($employeeSIN != null)
            if (strpos($query, 'dependentSIN') !== false)
                $query = $query . "AND employeeSIN = '$employeeSIN' ";
            else
                $query = $query . "employeeSIN = '$employeeSIN' ";

        if ($name != null)
            if (strpos($query, 'AND') !== false)
                $query = $query . "AND name = '$name' ";
            else
                $query = $query . "name = '$name' ";

        if ($gender != -1)
            if (strpos($query, 'AND') !== false)
                $query = $query . "AND gender = '$gender' ";
            else
                $query = $query . "gender = '$gender' ";

        if ($birthDate != null)
            if(strpos($query, 'AND') !== false)
                $query = $query . "AND birthDate = '$birthDate' ";
            else
                $query = $query . "birthDate = '$birthDate' ";

        $query = $query . ";";

        if (strpos($query, '=')){
            $dependents = DB::connection('management')->select($query);
            return view('dependents')->with('dependents', $dependents);
        }
        else
            return view('dependents');
    }
}