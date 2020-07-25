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

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('logout', 'UserController@logout');
Auth::routes();

//// sale land 
Route::get('project', 'ProjectController@index');
Route::get('project/create', 'ProjectController@create');
Route::get('land', 'LandController@index');
Route::get('land/create', 'LandController@create');
Route::get('sale', 'UserController@sale');
Route::get('invoice', 'HomeController@invoice');

// search
Route::get('search', 'HomeController@search');
Route::get('search-all', 'HomeController@search_all');
Route::get('payment/search', 'LoanPaymentController@search');

Route::get('role', 'RoleController@index');
Route::get('role/create', 'RoleController@create');
Route::get('role/edit/{id}', 'RoleController@edit');
Route::get('role/delete/{id}', 'RoleController@delete');
Route::post('role/save', 'RoleController@save');
Route::post('role/update', 'RoleController@update');
Route::get('role/permission/{id}', 'PermissionController@index');
Route::post('rolepermission/save', 'PermissionController@save');

Route::get('user', 'UserController@index');
Route::get('user/create', 'UserController@create');
Route::get('user/profile', 'UserController@profile');
Route::post('user/save', 'UserController@save');
Route::post('user/profile/update', 'UserController@save_profile');
Route::get('user/edit/{id}', 'UserController@edit');
Route::get('user/delete/{id}', 'UserController@delete');
Route::post('user/update', 'UserController@update');
Route::get('company', 'CompanyController@index');
Route::get('company/edit/{id}', 'CompanyController@edit');
Route::post('company/save', 'CompanyController@save');

Route::get('phoneshop', 'PhoneshopController@index');
Route::get('phoneshop/create', 'PhoneshopController@create');
Route::get('phoneshop/delete', 'PhoneshopController@delete');
Route::get('phoneshop/edit/{id}', 'PhoneshopController@edit');
Route::post('phoneshop/save', 'PhoneshopController@save');
Route::post('phoneshop/update', 'PhoneshopController@update');
Route::post('phoneshop/add_shop', 'PhoneshopController@add_shop');

Route::get('customer', 'CustomerController@index');
Route::get('customer/create', 'CustomerController@create');
Route::get('customer/delete', 'CustomerController@delete');
Route::get('customer/edit/{id}', 'CustomerController@edit');
Route::post('customer/save', 'CustomerController@save');
Route::post('customer/update', 'CustomerController@update');
Route::post('customer/add_customer', 'CustomerController@add_customer');

// loan
Route::get('loan', 'LoanController@index');
Route::get('loan/search', 'LoanController@search');
Route::get('loan/create', 'LoanController@create');
Route::get('loan/test', 'LoanController@test');
Route::post('loan/save', 'LoanController@save');
Route::get('loan/detail/{id}', 'LoanController@detail');
Route::get('loan/print/{id}', 'LoanController@print');
Route::get('loan/pay/{id}', 'LoanController@pay');
Route::get('loan/delete', 'LoanController@delete');
Route::post('loan/save_payment', 'LoanController@save_payment');
Route::get('loan/delete_payment', 'LoanController@delete_payment');
Route::post('loan/save_stopped', 'LoanController@save_stopped');
Route::get('loan/stopped', 'LoanController@stopped');
Route::get('loan/edit/{id}', 'LoanController@edit');
Route::post('loan/update', 'LoanController@update');

//// loan schedule
Route::get('loanschedule', 'LoanScheduleController@index');
Route::get('loanschedule/today', 'LoanScheduleController@today');
Route::get('loanschedule/late', 'LoanScheduleController@late');
Route::get('schedule/shop/{id}', 'LoanScheduleController@byshop');
Route::get('loanschedule/print', 'LoanScheduleController@print_schedule');

//// loan schedule
Route::get('loanpayment', 'LoanPaymentController@index');
Route::get('payment/fast/{id}', 'LoanPaymentController@fast');
Route::get('loanpayment/print/{id}', 'LoanPaymentController@print');

// report
Route::get('report/payment', 'ReportController@payment');
Route::get('report/payment/search', 'ReportController@search_payment');

Route::get('report/payment/print', 'ReportController@print_payment');

Route::get('report/expense', 'ReportController@expense');
Route::get('report/expense/search', 'ReportController@search_expense');
Route::get('report/expense/print', 'ReportController@print_expense');

Route::get('report/paid', 'ReportController@paid');
Route::get('report/paid/search', 'ReportController@search_paid');
Route::get('report/paid/print', 'ReportController@print_paid');
