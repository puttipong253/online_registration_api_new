<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});

Route::resource('customers','App\Http\Controllers\CustomersController');
Route::resource('hotel','App\Http\Controllers\HotelController');
Route::resource('room','App\Http\Controllers\RoomController');

Route::put('room-update-1', 'App\Http\Controllers\HotelController@RoomUpdate1');
Route::put('room-update-2', 'App\Http\Controllers\HotelController@RoomUpdate2');

Route::get('export-customers', 'App\Http\Controllers\CustomersController@exportCustomer');
Route::get('export-ListCustomers', 'App\Http\Controllers\CustomersController@exportListCustomer');
Route::get('export-room', 'App\Http\Controllers\RoomController@exportRoom');

Route::get('customers-hotel', 'App\Http\Controllers\CustomersController@customersHotel');
Route::get('customers-room', 'App\Http\Controllers\CustomersController@customersRoom');
Route::post('partner','App\Http\Controllers\HotelController@partnerProvince');
Route::get('matching','App\Http\Controllers\CustomersController@matching');
Route::post('tracking','App\Http\Controllers\CustomersController@tracking');
Route::post('check-phone','App\Http\Controllers\CustomersController@checkPhone');
Route::post('provinceCustomerRoom1','App\Http\Controllers\CustomersController@provinceCustomerRoom1');
Route::post('provinceCustomerRoom2','App\Http\Controllers\CustomersController@provinceCustomerRoom2');

Route::get('countAllCustomer','App\Http\Controllers\CustomersController@countAllCustomer');
Route::get('countCustomerMatch','App\Http\Controllers\CustomersController@countCustomerMatch');
Route::get('countCustomerNotMatch','App\Http\Controllers\CustomersController@countCustomerNotMatch');
Route::get('countCustomerRoom','App\Http\Controllers\RoomController@countCustomerRoom');
