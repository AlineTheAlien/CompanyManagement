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

Route::get('createEmployee', 'EmployeeManagementController@CreateEmployee');

Route::get('createDepartment', 'EmployeeManagementController@CreateDepartment');

Route::get('createProject', 'EmployeeManagementController@CreateProject');

Route::get('updateEmployee', 'EmployeeManagementController@UpdateEmployee');

Route::POST('destroyEmployee', 'EmployeeManagementController@DestroyEmployee');

Route::get('dashboard', function () {
    return view('home');
});
