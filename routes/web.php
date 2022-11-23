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


//Frontpage
Route::get('/',[
    'uses' => 'FrontpageController@index',
    'as' => 'frontpage.index'
]);

// Route::get('firebase', [FirebaseController::class, 'index']);

Route::get('firebase',[
    'uses' => 'FirebaseController@index',
    'as' => 'firebase.index'
]);


         //Reset Password
         Route::get('reset-password',[
            'uses' => 'Api\AuthController@resetPasswordLoad',
        ]);

        Route::post('reset-password',[
            'uses' => 'Api\AuthController@resetPassword',
        ]);






Route::group(['prefix' => 'user'], function(){

    Route::group(['middleware' => 'guest'], function() {

        Route::get('signup', [
        'uses' => 'UserController@getSignup',
        'as' => 'user.signup',
            ]);

        Route::post('signup', [
                'uses' => 'UserController@postSignup',
                'as' => 'user.signup',
           ]);

        Route::get('login', [
                'uses' => 'UserController@getSignin',
                'as' => 'user.signin',
            ]);

        Route::post('login', [
                'uses' => 'LoginController@postSignin',
                'as' => 'users.signin',
         ]);





    });

    Route::group(['middleware' => 'auth:web'], function() {

        // Route::get('profile', [
        //     'uses' => 'UserController@getProfile',
        //     'as' => 'user.profile',
        // ]);

        Route::get('logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout',
            ]);
        });

    // Route::group(['middleware' => 'role:unverified_user'], function() {

    //     Route::get('profile', [
    //         'uses' => 'UserController@getProfile',
    //         'as' => 'user.profile',
    //     ]);
    // });

    // Route::group(['middleware' =>  'role:verified_user'], function() {

    //     Route::get('profile', [
    //         'uses' => 'UserController@getProfile',
    //         'as' => 'user.profile',
    //     ]);
    // });

});

 Route::group(['middleware' => 'normaluser'], function() {

        Route::get('profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile',
        ]);
    });



//SuperAdmin User
Route::group(['middleware' => 'role:superadmin'], function() {

    //BARANGAY CRUD
    Route::resource('barangay', BarangayController::class);
    Route::get('/get-barangay',[ 'uses'=>'BarangayController@getBarangay','as' => 'barangays.getBarangay']);

    //HOSPITALS CRUD
    Route::resource('hospital', HospitalController::class);
    Route::get('/get-hospital',[ 'uses'=>'HospitalController@getHospital','as' => 'hospitals.getHospital']);

    //POLICESTATION CRUD
    Route::resource('policestation', PoliceStationController::class);
    Route::get('/get-policestation',[ 'uses'=>'PoliceStationController@getPoliceStation','as' => 'policestations.getPoliceStation']);

    Route::resource('unverifieduser', UnverifiedUserController::class);
    Route::get('/get-unverifieduser',[ 'uses'=>'UnverifiedUserController@getUnverifiedUser','as' => 'unverifiedusers.getUnverifiedUser']);
    Route::put('/reject/{id}',[ 'uses'=>'UnverifiedUserController@reject','as' => 'unverifieduser.reject']);

    Route::resource('verifieduser', VerifiedUserController::class);
    Route::get('/get-verifieduser',[ 'uses'=>'VerifiedUserController@getVerifiedUser','as' => 'verifiedusers.getVerifiedUser']);

    Route::resource('user', UserController::class);
    Route::get('/get-user',[ 'uses'=>'UserController@getUser','as' => 'users.getUser']);

    //Barangay Report
    Route::resource('barangay_user', UserBarangayController::class);

    //show all reports
    Route::get('/get-barangay_reports',[
        'uses'=>'UserBarangayController@getBarangayReports',
        'as' => 'barangay_user.getBarangayReports']);

    //show specific report
    Route::get('/get-barangay_reports{id}',[
        'uses'=>'UserBarangayController@show',
        'as' => 'barangay_user.report_details']);


    //Police Report
    Route::resource('policestation_user', UserPoliceStationController::class);

    //show all reports
    Route::get('/get-police_reports',[
        'uses'=>'UserPoliceStationController@getPoliceStationReports',
        'as' => 'policestation_user.getPoliceStationReports']);

    //show specific report
    Route::get('/get-police_reports{id}',[
        'uses'=>'UserPoliceStationController@show',
        'as' => 'policestation_user.report_details']);


  });

//Admin User
Route::group(['middleware' => 'role:admin'], function() {

  //BARANGAY CRUD
  Route::resource('barangay', BarangayController::class);
  Route::get('/get-barangay',[ 'uses'=>'BarangayController@getBarangay','as' => 'barangays.getBarangay']);

  //HOSPITALS CRUD
  Route::resource('hospital', HospitalController::class);
  Route::get('/get-hospital',[ 'uses'=>'HospitalController@getHospital','as' => 'hospitals.getHospital']);

  //POLICESTATION CRUD
  Route::resource('policestation', PoliceStationController::class);
  Route::get('/get-policestation',[ 'uses'=>'PoliceStationController@getPoliceStation','as' => 'policestations.getPoliceStation']);

  Route::resource('unverifieduser', UnverifiedUserController::class);
  Route::get('/get-unverifieduser',[ 'uses'=>'UnverifiedUserController@getUnverifiedUser','as' => 'unverifiedusers.getUnverifiedUser']);
  Route::put('/reject/{id}',[ 'uses'=>'UnverifiedUserController@reject','as' => 'unverifieduser.reject']);

  Route::resource('verifieduser', VerifiedUserController::class);
  Route::get('/get-verifieduser',[ 'uses'=>'VerifiedUserController@getVerifiedUser','as' => 'verifiedusers.getVerifiedUser']);

//   Route::resource('user', UserController::class);
//   Route::get('/get-user',[ 'uses'=>'UserController@getUser','as' => 'users.getUser']);

});




//Barangay User
Route::group(['middleware' => 'role:barangay'], function() {

    Route::resource('barangay_user', UserBarangayController::class);

    //show all reports
    Route::get('/get-barangay_reports',[
        'uses'=>'UserBarangayController@getBarangayReports',
        'as' => 'barangay_user.getBarangayReports']);

    //show specific report
    Route::get('/get-barangay_reports{id}',[
        'uses'=>'UserBarangayController@show',
        'as' => 'barangay_user.report_details']);

});



//Police Station User
Route::group(['middleware' => 'role:police_station'], function() {

  //Police Report
  Route::resource('policestation_user', UserPoliceStationController::class);

  //show all reports
  Route::get('/get-police_reports',[
    'uses'=>'UserPoliceStationController@getPoliceStationReports',
    'as' => 'policestation_user.getPoliceStationReports']);

  //show specific report
  Route::get('/get-police_reports{id}',[
    'uses'=>'UserPoliceStationController@show',
    'as' => 'policestation_user.report_details']);

});


//Back
Route::fallback(function(){
    return redirect()->back();
});
