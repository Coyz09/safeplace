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

// Route::get('/downloadapk', function () {
//     return Storage::download('safeplace.apk');
// });
Route::get('/downloadapk','FrontpageController@downloadapk');
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

        Route::get('editprofile/{user}', [
            'uses' => 'UserController@EditProfile',
            'as' => 'user.editprofile',
        ]);

        Route::put('updateprofile/{user}/update', [
            'uses' => 'UserController@UpdateProfile',
            'as' => 'user.updateprofile',
        ]);


    });

    Route::post('/import',[ 'uses'=>'UserPoliceStationController@import','as' => 'import']);

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

        Route::get('/barangayarchives', 'AdminController@barangayindex')->name('barangayarchives');
        Route::get('/barangayedit/{id}',[ 'uses'=>'AdminController@barangayedit','as' => 'admin.barangayedit']);
        Route::get('/get-barangay_archives',[
               'uses'=>'AdminController@getBarangayArchives',
               'as' => 'admin.getBarangayArchives']);
   
        Route::get('/policearchives', 'AdminController@policeindex')->name('policearchives');
        Route::get('/policeedit/{id}',[ 'uses'=>'AdminController@policeedit','as' => 'admin.policeedit']);
        Route::get('/get-police_archives',[
               'uses'=>'AdminController@getPoliceArchives',
               'as' => 'admin.getPoliceArchives']);


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
  

    Route::get('/admin_dashboard', 'DashboardController@getCountandLocation')->name('admin_dashboard');
    
    Route::get('/hospitals/{hospitals}', 'DashboardController@showHospital')->name('hospital');
    Route::get('/barangays/{barangays}', 'DashboardController@showBarangay')->name('barangay');
    Route::get('/polices/{polices}', 'DashboardController@showPolice')->name('police');

      
  

     Route::get('/barangayarchives', 'AdminController@barangayindex')->name('barangayarchives');
     Route::get('/barangayedit/{id}',[ 'uses'=>'AdminController@barangayedit','as' => 'admin.barangayedit']);
     Route::get('/get-barangay_archives',[
            'uses'=>'AdminController@getBarangayArchives',
            'as' => 'admin.getBarangayArchives']);

     Route::get('/policearchives', 'AdminController@policeindex')->name('policearchives');
     Route::get('/policeedit/{id}',[ 'uses'=>'AdminController@policeedit','as' => 'admin.policeedit']);
     Route::get('/get-police_archives',[
            'uses'=>'AdminController@getPoliceArchives',
            'as' => 'admin.getPoliceArchives']);

  //   Route::resource('user', UserController::class);
  //   Route::get('/get-user',[ 'uses'=>'UserController@getUser','as' => 'users.getUser']);
  
  });

Route::group(['middleware' => 'role:barangay_admin'], function() {

    //BARANGAY CRUD
    Route::resource('barangay', BarangayController::class);
    Route::get('/get-barangay',[ 'uses'=>'BarangayController@getBarangay','as' => 'barangays.getBarangay']);
  
    Route::resource('barangayadmin', BarangayAdminController::class);
    Route::get('/get-barangayaccounts',[ 'uses'=>'BarangayAdminController@getBarangayAccounts','as' => 'barangayaccounts.getBarangayAccounts']);
  
});

Route::group(['middleware' => 'role:policestation_admin'], function() {

    //POLICESTATION CRUD
    Route::resource('policestation', PoliceStationController::class);
    Route::get('/get-policestation',[ 'uses'=>'PoliceStationController@getPoliceStation','as' => 'policestations.getPoliceStation']);
  
    Route::resource('policestationadmin', PoliceStationAdminController::class);
    Route::get('/get-policestationaccounts',[ 'uses'=>'PoliceStationAdminController@getPoliceStationAccounts','as' => 'policestationaccounts.getPoliceStationAccounts']);
  
});

Route::group(['middleware' => 'role:user_admin'], function() {

    Route::resource('unverifieduser', UnverifiedUserController::class);
    Route::get('/get-unverifieduser',[ 'uses'=>'UnverifiedUserController@getUnverifiedUser','as' => 'unverifiedusers.getUnverifiedUser']);
    Route::put('/reject/{id}',[ 'uses'=>'UnverifiedUserController@reject','as' => 'unverifieduser.reject']);

    Route::resource('verifieduser', VerifiedUserController::class);
    Route::get('/get-verifieduser',[ 'uses'=>'VerifiedUserController@getVerifiedUser','as' => 'verifiedusers.getVerifiedUser']);

    Route::resource('useradmin', UserAdminController::class);
    Route::get('/get-useraccounts',[ 'uses'=>'UserAdminController@getUserAccounts','as' => 'useraccounts.getUserAccounts']);
  
});

Route::group(['middleware' => 'role:hospital_admin'], function() {

     //HOSPITALS CRUD
    Route::resource('hospital', HospitalController::class);
    Route::get('/get-hospital',[ 'uses'=>'HospitalController@getHospital','as' => 'hospitals.getHospital']);

    // Route::get('/hospital/{hospitals}',[ 'uses'=>'DashboardController@show','as' => 'hospitals.show']);

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


     Route::get('/barangaydashboard',[
            'uses'=>'BarangayDashboardController@index',
            'as'=>'barangaydashboard',
            ]);
    
    Route::get('/barangay_notifications',[
            'uses'=>'UserBarangayController@notifications',
            'as' => 'barangay_user.notifications']);    
    
    
    Route::put('/police_transfer/{id}',[ 'uses'=>'UserBarangayController@transfer','as' => 'barangayreport.transfer']);
    

    
    Route::post('/barangay_mark-as-read',[ 'uses'=>'UserBarangayController@markNotification','as' => 'barangayreport.markNotification']);

});



//Police Station User
Route::group(['middleware' => 'role:police_station'], function() {

  //Police Report
  Route::resource('policestation_user', UserPoliceStationController::class);


  //show all reports 2023
  Route::get('/get-police_reports',[
    'uses'=>'UserPoliceStationController@getPoliceStationReports',
    'as' => 'policestation_user.getPoliceStationReports']);

 //show all reports2022
 Route::get('/get-police_report2022',[
        'uses'=>'UserPoliceStationController@getPoliceStationReports2022',
        'as' => 'policestation_user.getPoliceStationReports2022']);
        
 Route::get('/reports2022',[
    'uses'=>'UserPoliceStationController@reports2022',
    'as' => 'policestation_user.reports2022']);      
    
     //show all reports2021
 Route::get('/get-police_report2021',[
    'uses'=>'UserPoliceStationController@getPoliceStationReports2021',
    'as' => 'policestation_user.getPoliceStationReports2021']);

 Route::get('/reports2021',[
    'uses'=>'UserPoliceStationController@reports2021',
    'as' => 'policestation_user.reports2021']);     


    //show all reports2020
 Route::get('/get-police_report2020',[
    'uses'=>'UserPoliceStationController@getPoliceStationReports2020',
    'as' => 'policestation_user.getPoliceStationReports2020']);

 Route::get('/reports2020',[
    'uses'=>'UserPoliceStationController@reports2020',
    'as' => 'policestation_user.reports2020']);     


//   //show specific report
//   Route::get('/get-police_reports{id}',[
//     'uses'=>'UserPoliceStationController@show',
//     'as' => 'policestation_user.report_details']);

    Route::get('/get-police_reports_yearly/{id}',[
        'uses'=>'UserPoliceStationController@showyearly',
        'as' => 'policestation_user.report_details_yearly']);
    


    Route::get('/policedashboard',[
        'uses'=>'PoliceSubstationDashboardController@index',
        'as'=>'policedashboard',
        ]);

     Route::get('/police_notifications',[
        'uses'=>'UserPoliceStationController@notifications',
        'as' => 'policestation_user.notifications']);    


    Route::put('/barangay_transfer/{id}',[ 'uses'=>'UserPoliceStationController@transfer','as' => 'policereport.transfer']);

    // Route::post('/mark-as-read', 'UserPoliceStationController@markNotification')->name('markNotification');

    Route::post('/police_mark-as-read',[ 'uses'=>'UserPoliceStationController@markNotification','as' => 'policereport.markNotification']);

});


//Back
Route::fallback(function(){
    return redirect()->back();
});
