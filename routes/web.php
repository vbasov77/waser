<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware;
use Illuminate\Support\Facades\Artisan;

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

//Route::get('001/{id}', function ($id) {
//    return action('CalendarController@test');
//})->name('001');

Auth::routes();


Route::post('/booking', 'CalendarController@Booking')->name('booking');
Route::post('/get_time', 'CalendarController@CalendarPost')->name('get.time');
Route::get('/get_time', 'CalendarController@CalendarPost');
Route::post('/set', 'CalendarController@view')->name('set');
Route::get('/test', 'CalendarController@test');
Route::get('/', 'TypeCarController@view');
Route::get('/id{id}', 'ObjectController@view')->name('object');
Route::get('/front', 'FrontController@view');
Route::get('/profile', 'ProfileController@view');
Route::get('/home', 'HomeController@index');
Route::get('/danke', 'DankeController@view');
Route::get('/my_orders', 'OrdersController@myOrders');


//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/order/{id}/delete', 'OrdersController@delete')->name('order.delete')->middleware('role: company, admin');;

Route::get('/settings', 'SettingsController@view')->middleware('admin');
Route::get('/search', 'SearchController@view')->middleware('admin');
Route::post('/search_phone', 'SearchController@searchPhone')->name('search.phone')->middleware('admin');
Route::post('/user_phone', 'SearchController@updateUser')->name('user.phone')->middleware('admin');

Route::post('/add_settings', 'SettingsController@updateSettings')->name('add.settings')->middleware('admin');
Route::post('/time_cost', 'TimeCost@TimeCost')->name('time_cost')->middleware('admin');

Route::get('/view_category/obj_id{id}', 'TypeCarController@viewCategoryObj')->name('view_category')->middleware('role: company, admin');
Route::post('/update_auto', 'TypeCarController@update')->name('update_auto')->middleware('role: company, admin');

Route::get('/view_wash/obj_id{id}', 'TypeWashController@viewWashObj')->name('view_wash')->middleware('role: company, admin');
Route::post('/update_wash', 'TypeWashController@update')->name('update_wash')->middleware('role: company, admin');

Route::get('/table_cost/obj_id{id}', 'CostController@view')->name('table_cost')->middleware('role: company, admin');
Route::post('/update_cost', 'CostController@update')->name('update_cost')->middleware('role: company, admin');

Route::get('/view_more/obj_id{id}', 'MoreObjController@view')->name('view_more')->middleware('role: company, admin');
Route::get('/delete/more_id{id}', 'MoreObjController@delete')->name('delete.more')->middleware('role: company, admin');
Route::get('/add_more/obj_id{id}', 'MoreObjController@moreAdd')->name('add_more')->middleware('role: company, admin');
Route::post('/add_more', 'MoreObjController@add')->name('add_more')->middleware('role: company, admin');
Route::get('/upload/more_id{id}', 'MoreObjController@moreUpload')->name('upload.more')->middleware('role: company, admin');
Route::post('/upload_more', 'MoreObjController@upload')->name('upload_more')->middleware('role: company, admin');

Route::get('/admin_book/obj_id{id}', 'AdminBookController@viewAdd')->name('view_admin_book')/*->middleware('role: company, admin')*/;
Route::post('/admin_book', 'AdminBookController@add')->name('admin_book')->middleware('role: company, admin');

Route::post('/get_date', 'OrdersController@view')->middleware('role: company, admin');
Route::post('/in_archive', 'OrdersController@inArchive')->name('in.archive')->middleware('role: company, admin');
Route::get('/get_date', 'OrdersController@view')->name('get.date')->middleware('role: company, admin');
Route::get('/delete/{id}/order', 'OrdersController@deleteDat')->name('delete.order')->middleware('role: company, admin');
Route::get('/orders', 'OrdersController@viewObj')->middleware('role: company, admin');
Route::get('/object/{id}/cal', 'OrdersController@viewCal')->name('object.cal')->middleware('role: company, admin');
Route::get('/object/{id}/today', 'OrdersController@today')->name('object.today')->middleware('role: company, admin');
Route::get('/object/{id}/update', 'ObjectController@viewUpdateObj')->name('object.update')->middleware('role: company, admin');
Route::get('/object/{id}/delete', 'ObjectController@deleteObj')->name('object.delete')->middleware('role: company, admin');

Route::get('/cabinet', 'CompanyController@cabinet')->name('cabinet')->middleware('role: company, admin');
Route::get('/add_object', 'CompanyController@addView')->name('add_object')->middleware('role: company, admin');

Route::post('/add_object', 'ObjectController@addObject')->middleware('role: company, admin');
Route::post('/update_object', 'ObjectController@updateObj')->name('update.object')->middleware('role: company, admin');

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
});