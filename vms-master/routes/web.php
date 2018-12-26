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

Route::get('/', function () {
    if(Auth::user()){
        return redirect('home');
    }
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('gcalendar', 'GoogleCalenderApiClientController');
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'GoogleCalenderApiClientController@oauth']);
Route::get('/google/calender/{id}/events', 'GoogleCalenderApiClientController@eventsById');
Route::get('/google/calenders', 'GoogleCalenderApiClientController@getCalenders');

Route::get('login/google', 'UserController@redirectToProvider')->name('google.login');
Route::get('login/google/callback', 'UserController@handleProviderCallback');


Route::group(['middleware'=>['authenticate','active']],function (){

    /*
  * Vehicle CRUD
  * */
    Route::get('/vehicle/','VehicleController@index');
    Route::get('/vehicle/create','VehicleController@create');
    Route::post('/vehicle/store','VehicleController@store');
    Route::get('/vehicle/{id}/edit','VehicleController@edit');
    Route::patch('/vehicle/update/{id}','VehicleController@update');

    /*
     * Vehicle Document delete
     * */
    Route::get('/vehicle/document/{id}/delete','VehicleController@deleteDocumentById');


    /*
     * Driver CRUD
     * */
    Route::get('/driver/','DriverController@index');
    Route::get('/driver/create','DriverController@create');
    Route::post('/driver/store','DriverController@store');
    Route::get('/driver/{id}/edit','DriverController@edit');
    Route::patch('/driver/update/{id}','DriverController@update');
    Route::delete('/driver/delete/{id}','DriverController@destroy');

    /*
     * Journey CRUD
     * */
    Route::get('/journey/','JourneyController@index');
    Route::get('/journey/create','JourneyController@create');
    Route::post('/journey/store','JourneyController@store');
    Route::get('/journey/{id}/edit','JourneyController@edit');
    Route::patch('/journey/update/{id}','JourneyController@update');
 
    Route::get('/journey/myjourneys','JourneyHistoryController@index');  

    /*
     * Show Journey Requests
     * */
    Route::get('/journey/requests','JourneyController@requests');

    Route::get('/journey/map','MapController@map');

    /*
     * Show Cancelled Journey 
     * */
    Route::get('/journey/cancelled','JourneyController@cancelledJourney');

    /*
     * Journey Request Approval
     * */
    Route::post('/journey/request/{id}/approve','JourneyRequestController@approval');
    /*Show Approved Requests*/
    Route::get('/journey/requests/notconfirmed','JourneyController@notConfirmedJourneys');
    /*
     * Journey Request Confirmation
     * */
    Route::post('/journey/request/{id}/confirm','JourneyConfirmController@confirm');

    Route::post('/journey/request/confirmAjax','JourneyConfirmController@confirmAjax');

            /* Journey Denied from Confirmation View */ 
     Route::post('/journey/request/denied','JourneyConfirmController@deny');

            /* Journey Cancel from Ongoing View and Confirmation View */ 
    Route::post('/journey/request/cancel','JourneyController@cancel');
                /* Journey Change Ongoing journey Details */
    Route::post('/journey/request/changeOngoing','JourneyController@changeOngoing');

    /*Show Confirmed Requests*/
    Route::get('/journey/requests/confirmed','JourneyController@confirmedJourneys');
    /*Show Confirmed Requests to complete*/
    Route::get('/journey/requests/complete','JourneyCompleteController@confirmedJourneys');
    Route::post('/journey/request/{id}/complete','JourneyCompleteController@complete');
    Route::get('/journey/requests/completed','JourneyController@completed'); 

                // For Calender views
    Route::get('/journey/read','JourneyController@readJourney'); 
    Route::get('/journey/readExternal','JourneyController@readExternal');
    Route::get('/journey/journeyStatus','JourneyController@journeyStatus');
    Route::get('/journey/journeyApplicant/','JourneyController@journeyApplicant');
    Route::get('/journey/confirmationJourneys','JourneyController@confirmationJourneys');
    Route::get('/journey/readCompleted','JourneyController@readcompletedJourney');

            // For Backlog Calender views 
    Route::get('/journey/createBacklog','BacklogJourneyController@createBacklog'); 
    Route::get('/journey/createAprrovedBacklog','BacklogJourneyController@createAprrovedBacklog');
    Route::get('/journey/readBcaklogJourney','BacklogJourneyController@readBcaklogJourney'); 
    Route::get('/journey/ForCreateBacklogByVehicle/{id}','BacklogJourneyController@ForCreateBacklogByVehicle');
    Route::get('/journey/readExternalBacklog','BacklogJourneyController@readExternalBacklog');
    Route::post('/journey/storeBacklog','BacklogJourneyController@storeBacklog');
    Route::post('/journey/request/{id}/approvalBacklog','BacklogJourneyController@approvalBacklog');


    Route::get('/journey/readExternalCompleted','JourneyController@readExternalCompleted');
    
    
    Route::get('/journey/ForCompletedByVehicle/{id}','JourneyController@ForCompletedByVehicle');
    Route::get('/journey/ForConfirmationByVehicle/{id}','JourneyController@ForConfirmationByVehicle');
    Route::get('/journey/readJourneyForCreate/{id}','JourneyController@readJourneyForCreate');
    Route::get('/journey/read/{id}','JourneyController@readJourneyForConfirmAjax');
    Route::get('/journey/readCompleted/{id}','JourneyController@readJourneyForCompletedAjax'); 
    Route::get('/journey/readConfirmed/{id}','JourneyController@ForOngingView');
    Route::get('/journey/readVehicleColor/','JourneyController@readVehicleColor'); 
    Route::get('/journey/ForCreateByVehicle/{id}','JourneyController@ForCreateByVehicle'); 
    
        /*
        * My Journeys
        * */
    Route::get('/journey/readMyJourney','JourneyHistoryController@readMyJourney');  
    Route::get('/journey/myJourneyByVehicle/{id}','JourneyHistoryController@myJourneyByVehicle');
    Route::get('/journey/myJourneyExternal','JourneyHistoryController@myJourneyExternal');
    Route::get('/journey/clickMyJourneys/{id}','JourneyHistoryController@clickMyJourneys');



    Route::get('/user/','UserController@index');
    Route::get('/user/{id}/edit','UserController@edit');
    Route::patch('/user/update','UserController@update');


        /*Role Crud*/
    Route::get('/user/roles','RoleController@index');

        /*Assign new Module To  Existing Role*/
    Route::get('/user/role/{id}/module/assign','RoleController@assignNewModule');
    Route::post('/user/role/module/store','RoleController@storeNewModule');

    Route::get('/user/role/module/{id}/permissions','RoleController@getPermissionsByModuleId');
    Route::get('/user/role/module/permissions','RoleController@getPermissionsByModule');

        /*Edit Module Assigned to Existing Role*/
    Route::get('/user/role/{rId}/module/{mId}/edit','RoleController@editPerimssionsByModule');
        /*Update Module Assigned to Existing Role*/
    Route::patch('/user/role/module/permissions/update','RoleController@updatePermissionsByModule');
        /*Delete Module Assigned to Existing Role*/
    Route::get('/user/role/privilege/{id}/delete','RoleController@deletePrivilege');
        /*Create new Role*/
    Route::get('/user/role/create','RoleController@create');
    Route::post('/user/role/store','RoleController@store');

    Route::get('/user/role/{id}/delete','RoleController@deleteRole');

        /*Vehicle Usage*/
    Route::get('/vehicle/usage','VehicleUsageController@index');

        /*Vehicle service*/
    Route::get('/vehicle/addservicing','VehicleUsageController@viewAddServicing'); 
    Route::post('/vehicle/storeServicing','VehicleUsageController@storeServicing');
    Route::get('/vehicle/readServicing/{id}','VehicleUsageController@readServicing');
    Route::post('/vehicle/service','VehicleUsageController@deleteService')->name('service.delete'); 
    Route::get('/vehicle/viewService/{id}','VehicleUsageController@viewService');  
    Route::post('/vehicle/service/update','VehicleUsageController@updateService');
    Route::get('/vehicle/serivceNotification/','VehicleUsageController@serivceNotification');

        /* Vehicle annual licence */
    Route::get('/vehicle/annualLicences','VehicleUsageController@viewAnnualLicences');
    Route::post('/vehicle/storeAnnualLicenc','VehicleUsageController@storeAnnualLicenc');
    Route::get('/vehicle/readAnnualLicenc/{id}','VehicleUsageController@readAnnualLicenc'); 
    Route::post('/vehicle/deleteAnnualLicenc','VehicleUsageController@deleteAnnualLicenc')->name('annLicence.delete');
    Route::get('/vehicle/viewAnnualLicenc/{id}','VehicleUsageController@viewAnnualLicenc'); 
    Route::post('/vehicle/annualLicence/update','VehicleUsageController@updateAnnualLicenc');
    Route::post('/vehicle/annualLicence/test','VehicleUsageController@postTest');

        /* Vehicle Accidents */ 
    Route::get('/vehicle/accidents','VehicleUsageController@viewVehicleAccidents'); 
    Route::post('/vehicle/storeAccidents','VehicleUsageController@storeAccidents'); 
    Route::get('/vehicle/readVehicleAccidents/{id}','VehicleUsageController@readVehicleAccidents'); 
    Route::get('/vehicle/viewAccident/{id}','VehicleUsageController@viewAccident'); 
    Route::post('/vehicle/deleteAccident','VehicleUsageController@deleteAccident')->name('accident.delete'); 
    Route::post('/vehicle/accident/update','VehicleUsageController@updateAccident'); 

        /* Vehicle Repairs */
    Route::get('/vehicle/repairs','VehicleUsageController@viewRepairsPage'); 
    Route::post('/vehicle/storeRepairs','VehicleUsageController@storeRepairs'); 
    Route::get('/vehicle/readVehicleRepairs/{id}','VehicleUsageController@readVehicleRepairs'); 
    Route::get('/vehicle/viewRepair/{id}','VehicleUsageController@viewRepair'); 
    Route::post('/vehicle/deleteRepaire','VehicleUsageController@deleteRepaire')->name('repaire.delete'); 
    Route::post('/vehicle/repair/update','VehicleUsageController@updateRepair');

        /* Vehicle Repairs */
    Route::get('/vehicle/tyres','VehicleUsageController@viewTyresPage'); 
    Route::post('/vehicle/storeTyreReplacement','VehicleUsageController@storeTyreReplacement');
    Route::post('/vehicle/storeTyrePositionChange','VehicleUsageController@storeTyrePositionChange');
    Route::get('/vehicle/readTyreReplacement/{id}','VehicleUsageController@readTyreReplacement');   
    Route::get('/vehicle/readTyrePositionChanges/{id}','VehicleUsageController@readTyrePositionChanges'); 
    Route::get('/vehicle/viewTyreReplacement/{id}','VehicleUsageController@viewTyreReplacement'); 
    Route::post('/vehicle/tyreReplacement/update','VehicleUsageController@updateTyreReplacement');
    Route::get('/vehicle/viewTyrePositionChange/{id}','VehicleUsageController@viewTyrePositionChange'); 
    Route::post('/vehicle/tyrePositionChange/update','VehicleUsageController@updateTyrePositionChange');
    Route::post('/vehicle/deleteTyreReplacement','VehicleUsageController@deleteTyreReplacement')->name('tyreReplacement.delete'); 
                                                                    
});

Route::get('/log/{type}','UserController@login');