<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('home');
});

Route::get('departments', function () {
    return view('departments');
});

Route::get('projects', function () {
    $employees = DB::connection('management')->select("SELECT * FROM employee;");
    return view('projects')->with('employees', $employees);
});

Route::get('dependents', function () {
    return view('dependents');
});

Route::get('employees', 'EmployeeManagementController@GetAllEmployees');

Route::get('departments', 'EmployeeManagementController@GetAllDepartments');

Route::get('dependents', 'EmployeeManagementController@GetAllDependents');

Route::get('projects', 'EmployeeManagementController@GetAllProjects');

Route::get('getEmployee', 'EmployeeManagementController@GetEmployeeBySIN');

Route::post('createDependent', 'EmployeeManagementController@CreateDependent')->name("createDependent");

Route::post('createEmployee', 'EmployeeManagementController@CreateEmployee')->name("createEmployee");

Route::get('dependents-create', function () {
    return view('dependents-create');
});

Route::get('employees-create', function () {
    $departments = DB::connection('management')->select("SELECT * FROM department;");
    return view('employees-create')->with('departments', $departments);
});

Route::get('departments-create', function () {
    return view('departments-create');
});

Route::get('departments-create', function () {
    return view('departments-create');
});


Route::get('projects-create', function () {
    return view('projects-create');
});

Route::post('createDepartment', 'EmployeeManagementController@CreateDepartment')->name("createDepartment");

Route::get('createDepartmentManager', 'EmployeeManagementController@CreateDepartmentManager')->name("createDepartmentManager");

Route::post('createDepartmentManagerInDatabase', 'EmployeeManagementController@CreateDepartmentManagerInDatabase')->name("createDepartmentManagerInDatabase");

Route::post('createProject', 'EmployeeManagementController@CreateProject')->name("createProject");

Route::get('updateDepartment', 'EmployeeManagementController@UpdateDepartment')->name("updateDepartment");

Route::get('updateDependent', 'EmployeeManagementController@UpdateDependent')->name("updateDependent");

Route::get('updateEmployee', 'EmployeeManagementController@UpdateEmployee')->name("updateEmployee");

Route::get('updateDepartmentManager', 'EmployeeManagementController@UpdateDepartmentManager')->name("updateDepartmentManager");

Route::get('updateProject', 'EmployeeManagementController@UpdateProject')->name("updateProject");

Route::get('searchEmployee', 'EmployeeManagementController@SearchEmployee')->name("searchEmployee");

Route::get('searchDepartment', 'EmployeeManagementController@SearchDepartment')->name("searchDepartment");

Route::get('searchDependent', 'EmployeeManagementController@SearchDependent')->name("searchDependent");

Route::get('getManager', 'EmployeeManagementController@GetManager')->name("getManager");

Route::get('getDependents', 'EmployeeManagementController@GetDependents')->name("getDependents");

Route::get('getProjects', 'EmployeeManagementController@GetProjects')->name("getProjects");

Route::get('getProjectTotalHours', 'EmployeeManagementController@GetProjectTotalHours')->name("getProjectTotalHours");

Route::get('getEmployeesAssignedOnProject', 'EmployeeManagementController@GetEmployeesAssignedOnProject')->name("getEmployeesAssignedOnProject");

Route::post('updateDepartmentInDatabase', 'EmployeeManagementController@UpdateDepartmentInDatabase')->name("updateDepartmentInDatabase");

Route::post('updateDependentInDatabase', 'EmployeeManagementController@UpdateDependentInDatabase')->name("updateDependentInDatabase");

Route::post('updateEmployeeInDatabase', 'EmployeeManagementController@UpdateEmployeeInDatabase')->name("updateEmployeeInDatabase");

Route::post('updateProjectInDatabase', 'EmployeeManagementController@UpdateProjectInDatabase')->name("updateProjectInDatabase");

Route::post('updateDepartmentManagerInDatabase', 'EmployeeManagementController@UpdateDepartmentManagerInDatabase')->name("updateDepartmentManagerInDatabase");

Route::post('deleteEmployee', 'EmployeeManagementController@DeleteEmployee')->name("deleteEmployee");

Route::post('deleteDepartment', 'EmployeeManagementController@DeleteDepartment')->name("deleteDepartment");

Route::post('deleteDependent', 'EmployeeManagementController@DeleteDependent')->name("deleteDependent");

Route::post('deleteProject', 'EmployeeManagementController@DeleteProject')->name("deleteProject");

Route::post('addEmployeeToProject', 'EmployeeManagementController@AddEmployeeToProject')->name("addEmployeeToProject");

Route::post('updateEmployeeHours', 'EmployeeManagementController@UpdateEmployeeHours')->name("updateEmployeeHours");

Route::post('removeEmployeeFromProject', 'EmployeeManagementController@RemoveEmployeeFromProject')->name("removeEmployeeFromProject");

Route::get('getDepartmentEmployees', 'EmployeeManagementController@GetDepartmentEmployees')->name("getDepartmentEmployees");

Route::get('getSupervisor', 'EmployeeManagementController@GetSupervisor')->name("getSupervisor");

Route::get('getSubordinates', 'EmployeeManagementController@GetSubordinates')->name("getSubordinates");

Route::post('removeSupervisor', 'EmployeeManagementController@RemoveSupervisor')->name("removeSupervisor");

Route::post('removeSubordinate', 'EmployeeManagementController@RemoveSubordinate')->name("removeSubordinate");

Route::post('addSubordinate', 'EmployeeManagementController@AddSubordinate')->name("addSubordinate");

Route::post('addSupervisor', 'EmployeeManagementController@AddSupervisor')->name("addSupervisor");


Route::get('dashboard', function () {
    return view('home');
});
