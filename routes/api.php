<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HospitalAPIController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');
Route::post('save_user_info', 'Api\AuthController@save_user_info')->middleware('jwtAuth');
Route::get('get_user_info', 'Api\AuthController@get_user_info')->middleware('jwtAuth');
Route::post('change_password', 'Api\AuthController@change_password')->middleware('jwtAuth');
Route::post('update_profile_picture', 'Api\AuthController@update_profile_picture')->middleware('jwtAuth');

Route::post('qrcode', 'Api\AuthController@qrcode');

Route::post('forgot-password', 'Api\AuthController@forgot_password');


//Barangay, Police Station, and Hospital
Route::resource('hospitals', 'Api\HospitalAPIController');
Route::resource('police_stations', 'Api\PoliceStationAPIController');
Route::resource('barangays', 'Api\BarangayAPIController');


//Locations
Route::get('hospitals_location', 'Api\HospitalAPIController@location');
Route::get('barangays_location', 'Api\BarangayAPIController@location');
Route::get('policestations_location', 'Api\PoliceStationAPIController@location');


//Verifications
Route::post('verification_frontId', 'Api\VerificationController@verification_frontId')->middleware('jwtAuth');
Route::post('verification_backId', 'Api\VerificationController@verification_backId')->middleware('jwtAuth');
Route::post('verification_faceImage', 'Api\VerificationController@verification_faceImage')->middleware('jwtAuth');
Route::post('verification_idDetails', 'Api\VerificationController@verification_idDetails')->middleware('jwtAuth');

Route::post('update_information', 'Api\VerificationController@update_information')->middleware('jwtAuth');




//Notifications
Route::get('notification', 'Api\NotificationController@user_notification')->middleware('jwtAuth');

Route::post('notification_read', 'Api\NotificationController@notification_read')->middleware('jwtAuth');

Route::get('check_unread', 'Api\NotificationController@check_unread')->middleware('jwtAuth');


