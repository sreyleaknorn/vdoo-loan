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
	

Route::get('unit', 'UnitController@index');
Route::get('unit/create', 'UnitController@create');
Route::post('unit/store', 'UnitController@store');
Route::get('unit/edit/{id}', 'UnitController@edit');
Route::post('unit/update', 'UnitController@update');
Route::get('unit/delete/{id}', 'UnitController@delete');
Route::get('exchange', 'ExchangeController@index');
Route::get('exchange/edit/{id}', 'ExchangeController@edit');
Route::post('exchange/save', 'ExchangeController@save');

// product
Route::get('product', 'ProductController@index');
Route::get('product/create', 'ProductController@create');
Route::post('product/import', 'ProductController@import');
Route::get('product/export', 'ProductController@export');
Route::get('product/search', 'ProductController@search');
Route::get('product/delete', 'ProductController@delete');
Route::get('product/detail/{id}', 'ProductController@detail');
Route::get('product/edit/{id}', 'ProductController@edit');
Route::post('product/save', 'ProductController@save');
Route::post('product/update', 'ProductController@update');
// Route::get('product/unit/{id}', 'ProductController@get_unit');
Route::get('product/category/save', 'ProductController@save_category');
Route::get('product/unit/save', 'ProductController@save_unit');

Route::get('customer', 'CustomerController@index');
Route::get('customer/create', 'CustomerController@create');
Route::get('customer/delete', 'CustomerController@delete');
Route::get('customer/edit/{id}', 'CustomerController@edit');
Route::post('customer/save', 'CustomerController@save');
Route::post('customer/update', 'CustomerController@update');


Route::get('invoice', 'InvoiceController@index');
Route::get('invoice/create', 'InvoiceController@create');
Route::get('invoice/payment', 'InvoiceController@payment');
Route::post('invoice/payment/save', 'InvoiceController@save_payment');
Route::get('invoice/delete/{id}', 'InvoiceController@delete');
Route::get('invoice/detail/{id}', 'InvoiceController@detail');
Route::get('invoice/print/{id}', 'InvoiceController@print');
Route::post('invoice/save', 'InvoiceController@save');
Route::post('product/save1', 'InvoiceController@save_product1');
Route::get('invoice/payment/delete/{id}', 'InvoiceController@delete_payment');
// product price
Route::get('product/price/{id}', 'InvoiceController@get_price');
Route::get('getvat/{id}', 'InvoiceController@get_vat');

    // stock in
Route::get('in', 'StockinController@index');
Route::get('in/create', 'StockinController@create');
Route::get('in/search', 'StockinController@search');
Route::get('in/detail/{id}', 'StockinController@detail');
Route::get('in/delete/{id}', 'StockinController@delete');
Route::get('in/master/{id}', 'StockinController@get_master');
Route::get('in/print/{id}', 'StockinController@in_print');
Route::post('in/save', 'StockinController@save');
Route::post('in/save/master', 'StockinController@save_master');
Route::post('in/item/save', 'StockinController@save_item');
Route::get('in/product/{id}', 'StockinController@get_product');
Route::get('in/detail/delete/{id}', 'StockinController@delete_detail');
Route::post('in/product/save', 'ProductController@save_product');

Route::get('out', 'StockoutController@index');
Route::get('out/create', 'StockoutController@create');
Route::get('out/search', 'StockoutController@search');
Route::get('out/detail/{id}', 'StockoutController@detail');
Route::get('out/delete/{id}', 'StockoutController@delete');
Route::get('out/print/{id}', 'StockoutController@print');
Route::get('out/approve/{id}', 'StockoutController@approve');
Route::get('out/reject/{id}', 'StockoutController@reject');
Route::post('out/save', 'StockoutController@save');
Route::post('out/save/master', 'StockoutController@save_master');
Route::post('out/item/save', 'StockoutController@save_item');
Route::get('out/detail/delete/{id}', 'StockoutController@delete_detail');
Route::post('out/product/save', 'ProductController@save_product');

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
