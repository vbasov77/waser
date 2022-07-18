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

Route::get('/001', function () {
    return "001";
});

Auth::routes();


Route::post('/booking', 'CalendarController@Booking');
Route::post('/get_time', 'CalendarController@CalendarPost');
Route::get('/get_time', 'CalendarController@CalendarPost');
Route::post('/set', 'CalendarController@view');
Route::get('/test', 'CalendarController@test');
Route::get('/', 'TypeCarController@view');
Route::get('/id{id}', 'ObjectController@view');
Route::get('/front', 'FrontController@view');
Route::get('/profile', 'ProfileController@view');
Route::get('/home', 'HomeController@index');
Route::get('/danke', 'DankeController@view');
Route::get('/my_orders', 'OrdersController@myOrders');


//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/order/{id}/delete', 'OrdersController@delete');

Route::get('/settings', 'SettingsController@view')->middleware('admin');
Route::get('/search', 'SearchController@view')->middleware('admin');
Route::post('/search_phone', 'SearchController@searchPhone')->middleware('admin');
Route::post('/user_phone', 'SearchController@updateUser')->middleware('admin');

Route::post('/add_settings', 'SettingsController@updateSettings')->middleware('admin');
Route::post('/time_cost', 'TimeCost@TimeCost')->middleware('admin');

Route::get('/view_category/obj_id{id}', 'TypeCarController@viewCategoryObj')->middleware('role: company, admin');
Route::post('/update_auto', 'TypeCarController@update')->middleware('role: company, admin');

Route::get('/view_wash/obj_id{id}', 'TypeWashController@viewWashObj')->middleware('role: company, admin');
Route::post('/update_wash', 'TypeWashController@update')->middleware('role: company, admin');

Route::get('/table_cost/obj_id{id}', 'CostController@view')->middleware('role: company, admin');
Route::post('/update_cost', 'CostController@update')->middleware('role: company, admin');

Route::get('/view_more/obj_id{id}', 'MoreObjController@view')->middleware('role: company, admin');
Route::get('/delete/more_id{id}', 'MoreObjController@delete')->middleware('role: company, admin');
Route::get('/add_more/obj_id{id}', 'MoreObjController@moreAdd')->middleware('role: company, admin');
Route::post('/add_more', 'MoreObjController@add')->middleware('role: company, admin');
Route::get('/upload/more_id{id}', 'MoreObjController@moreUpload')->middleware('role: company, admin');
Route::post('/upload_more', 'MoreObjController@upload')->middleware('role: company, admin');

Route::get('/admin_book/obj_id{id}', 'AdminBookController@viewAdd')->middleware('role: company, admin');
Route::post('/admin_book', 'AdminBookController@add')->middleware('role: company, admin');

Route::post('/get_date', 'OrdersController@view')->middleware('role: company, admin');
Route::post('/in_archive', 'OrdersController@inArchive')->middleware('role: company, admin');
Route::get('/get_date', 'OrdersController@view')->middleware('role: company, admin');
Route::get('/delete/{id}/order', 'OrdersController@deleteDat')->middleware('role: company, admin');
Route::get('/orders', 'OrdersController@viewObj')->middleware('role: company, admin');
Route::get('/object/{id}/cal', 'OrdersController@viewCal')->middleware('role: company, admin');
Route::get('/object/{id}/today', 'OrdersController@today')->middleware('role: company, admin');
Route::get('/object/{id}/update', 'ObjectController@viewUpdateObj')->middleware('role: company, admin');
Route::get('/object/{id}/delete', 'ObjectController@deleteObj')->middleware('role: company, admin');

Route::get('/cabinet', 'CompanyController@cabinet')->middleware('role: company, admin');
Route::get('/add_object', 'CompanyController@addView')->middleware('role: company, admin');

Route::post('/add_object', 'ObjectController@addObject')->middleware('role: company, admin');
Route::post('/update_object', 'ObjectController@updateObj')->middleware('role: company, admin');


Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
});