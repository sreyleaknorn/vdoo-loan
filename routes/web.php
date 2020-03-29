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

Route::get('/','HomeController@index');
Route::get('home','HomeController@index');
Route::get('logout', 'UserController@logout');
Auth::routes();

// search
Route::get('search', 'HomeController@search');
Route::get('search-all', 'HomeController@search_all');

Route::get('role', 'RoleController@index');
Route::get('role/create', 'RoleController@create');
Route::get('role/edit/{id}', 'RoleController@edit');
Route::get('role/delete/{id}', 'RoleController@delete');
Route::post('role/save', 'RoleController@save');
Route::post('role/update', 'RoleController@update');
Route::get('role/permission/{id}', "PermissionController@index");
Route::post('rolepermission/save', "PermissionController@save");

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

//// loan schedule
Route::get('loanschedule', 'LoanScheduleController@index');
Route::get('loanschedule/today', 'LoanScheduleController@today');
Route::get('loanschedule/late', 'LoanScheduleController@late');
//// loan schedule
Route::get('loanpayment', 'LoanPaymentController@index');
Route::get('loanpayment/print/{id}', 'LoanPaymentController@print');

// report
Route::get('report/onhand', 'ReportController@onhand');
Route::get('report/onhand/print', 'ReportController@onhand_print');
Route::get('report/sale', 'ReportController@sale');
Route::get('report/sale/search', 'ReportController@search_sale');
Route::get('report/sale/print', 'ReportController@print_sale');
Route::get('report/sale/summary', 'ReportController@sale_summary');
Route::get('report/sale/summary/search', 'ReportController@search_sale_summary');
Route::get('report/sale/summary/print', 'ReportController@print_sale_summary');
Route::get('report/in', 'ReportController@in');
Route::get('report/in/search', 'ReportController@search_in');
Route::get('report/in/print', 'ReportController@print_in');
Route::get('report/in/summary', 'ReportController@in_summary');
Route::get('report/in/summary/search', 'ReportController@search_in_summary');
Route::get('report/in/summary/print', 'ReportController@print_in_summary');

Route::get('report/out', 'ReportController@out');
Route::get('report/out/search', 'ReportController@search_out');
Route::get('report/out/print', 'ReportController@print_out');
Route::get('report/out/summary', 'ReportController@out_summary');
Route::get('report/out/summary/search', 'ReportController@search_out_summary');
Route::get('report/out/summary/print', 'ReportController@print_out_summary');

Route::get('report/customer', 'ReportController@customer');
Route::get('report/customer/search', 'ReportController@search_customer');
Route::get('report/customer/print', 'ReportController@print_customer');
