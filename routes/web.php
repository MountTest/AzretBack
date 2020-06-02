<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'CompanyController@index');
Route::get('show/{company}', 'CompanyController@show')->name('show.company');
Route::post('/ajax_income', 'FinancialController@store_income')->name('ajax.income');
Route::post('/ajax_consumption', 'FinancialController@store_consumption')->name('ajax.consumption');
Route::post('/ajax_delete', 'FinancialController@ajax_delete')->name('ajax.delete');
Route::post('/ajax_edit', 'FinancialController@ajax_edit')->name('ajax.edit');
Route::get('/employee', 'EmployeeController@index')->name('employee.index');
Route::post('/employee_add', 'EmployeeController@ajax_add')->name('add.employee');
Route::post('/change_tab', 'EmployeeController@change_tab')->name('tab.employee');
Route::post('/change_option', 'EmployeeController@change_option')->name('change.option');


