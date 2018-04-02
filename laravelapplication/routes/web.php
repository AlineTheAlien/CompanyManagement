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
    return view('projects');
});

Route::get('employees', 'EmployeeManagementController@GetAllEmployees');

Route::get('departments', 'EmployeeManagementController@GetAllDepartments');

Route::get('projects', 'EmployeeManagementController@GetAllProjects');

Route::get('getEmployee', 'EmployeeManagementController@GetEmployeeBySIN');

Route::post('createEmployee', 'EmployeeManagementController@CreateEmployee')->name("createEmployee");

Route::get('employees-create', function () {
    return view('employees-create');
});

Route::get('createDepartment', 'EmployeeManagementController@CreateDepartment');

Route::get('createProject', 'EmployeeManagementController@CreateProject');

Route::get('updateEmployee', 'EmployeeManagementController@UpdateEmployee')->name("updateEmployee");

Route::get('searchEmployee', 'EmployeeManagementController@SearchEmployee')->name("searchEmployee");

Route::post('updateEmployeeInDatabase', 'EmployeeManagementController@UpdateEmployeeInDatabase')->name("updateEmployeeInDatabase");

Route::get('deleteEmployee', 'EmployeeManagementController@DeleteEmployee')->name("deleteEmployee");

Route::get('dashboard', function () {
    return view('home');
});
