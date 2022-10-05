<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;


Route::get('/history', 'HistoryController@index')->name('history.index');



Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route:: post('/login/custom',[
    'uses'=>'LoginController@login',
    'as'=>'login.custom']);
Route:: group(['middleware'=>'auth'],function (){
    Route::get('/home_Utilisateur',function (){
        return view('home_Utilisateur');
    })->name('home_Utilisateur');

    Route::get('/home_Gestionnaire_parc',function (){
        return view('home_Gestionnaire_parc');
    })->name('home_Gestionnaire_parc');

    Route::get('/home_Gestionnaire_Sup',function (){
        return view('home_Gestionnaire_Sup');
    })->name('home_Gestionnaire_Sup');




});


Route::get('/home', 'HomeController@index')->name('home');


Route::get('markAllRead',function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()-> back();

})->name('markAllRead');



Route::get('markAsRead/{id}',function($id){
    Auth::user()->notifications->find($id);
    $id = auth()->user()-> Notifications[0]->id;
    $notification=auth()->user()->Notifications->where('id', $id);
    $notification->markAsRead();

return redirect()-> back();


})->name('markAsRead');



Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('ParkManager')->prefix('ParkManager')->name('ParkManager.')->group(function (){
    Route::resource('/users','UserController');
    Route::resource('/staffs','StaffController');
    Route::resource('/units','UnitController');
    Route::resource('/vehicules','VehiculeController');




    Route::get('/attendances/createAttendance/{id}', 'AttendanceController@createAttendance')->name('attendances.createAttendance');
    Route::get('/attendances/showAttendance/{id}', 'AttendanceController@showAttendance')->name('attendances.showAttendance');
    Route::delete('/attendances/destroyAttendance/{id}', 'AttendanceController@destroyAttendance')->name('attendances.destroyAttendance');
    Route::post('/attendances/storeAttendance', 'AttendanceController@storeAttendance')->name('attendances.storeAttendance');
    Route::put('/attendances/updateAttendance/{id}', 'AttendanceController@updateAttendance')->name('attendances.updateAttendance');
    Route::get('/attendances/{id}/editAttendance', 'AttendanceController@editAttendance')->name('attendances.editAttendance');
    Route::resource('/attendances','AttendanceController');


    Route::resource('/absences','AbsenceController');
    Route::resource('/missions','MissionController');
    Route::resource('/gasVehicules','GasVehiculesController');
    Route::resource('/gasPipes','GasPipeController');
    Route::resource('/insurances','InsuranceController');
    Route::resource('/accidents','AccidentController');
    Route::resource('/stickers','StickerController');
    Route::resource('/licences','DrivingLicenceController');
    Route::resource('/technicalcontrols','TechnicalControlController');
    Route::resource('/guarantis','GuarantiControlController');
    Route::resource('/dts','DtController');
    Route::resource('/liquids','LiquidsController');
    Route::put('/liquids/update/{id}', 'LiquidsController@update')->name('liquids.update');
    Route::get('/liquids/{id}/edit', 'LiquidsController@edit')->name('liquids.edit');


    Route::get('/repairs/createRepairs/{id}', 'RepairController@createRepairs')->name('repairs.createRepairs');
    Route::get('/repairs/showRepairs/{id}', 'RepairController@showRepairs')->name('repairs.showRepairs');
    Route::delete('/repairs/destroyRepairs/{id}', 'RepairController@destroyRepairs')->name('repairs.destroyRepairs');
    Route::post('/repairs/storeRepairs', 'RepairController@storeRepairs')->name('repairs.storeRepairs');
    Route::put('/repairs/updateRepairs/{id}', 'RepairController@updateRepairs')->name('repairs.updateRepairs');
    Route::get('/repairs/{id}/editRepairs', 'RepairController@editRepairs')->name('repairs.editRepairs');
    Route::get('/repairs', 'RepairController@index')->name('repairs.index');


    Route::get('/maintenances/createMaintenance/{id}', 'MaintenanceController@createMaintenance')->name('maintenances.createMaintenance');
    Route::get('/maintenances/showMaintenance/{id}', 'MaintenanceController@showMaintenance')->name('maintenances.showMaintenance');
    Route::delete('/maintenances/destroyMaintenance/{id}', 'MaintenanceController@destroyMaintenance')->name('maintenances.destroyMaintenance');
    Route::post('/maintenances/storeMaintenance', 'MaintenanceController@storeMaintenance')->name('maintenances.storeMaintenance');
    Route::put('/maintenances/updateMaintenance/{id}', 'MaintenanceController@updateMaintenance')->name('maintenances.updateMaintenance');
    Route::get('/maintenances/{id}/editMaintenance', 'MaintenanceController@editMaintenance')->name('maintenances.editMaintenance');
    Route::get('/maintenances', 'MaintenanceController@indexMaintenance')->name('maintenances.indexMaintenance');


    Route::get('/cps/createCps/{id}', 'ConsumedPiecesController@createCps')->name('cps.createCps');
    Route::get('/cps/showCps/{id}', 'ConsumedPiecesController@showCps')->name('cps.showCps');
    Route::delete('/cps/destroyCps/{id}', 'ConsumedPiecesController@destroyCps')->name('cps.destroyCps');
    Route::post('/cps/storeCps', 'ConsumedPiecesController@storeCps')->name('cps.storeCps');
    Route::put('/cps/updateCps/{id}', 'ConsumedPiecesController@updateCps')->name('cps.updateCps');
    Route::get('/cps/{id}/editCps', 'ConsumedPiecesController@editCps')->name('cps.editCps');
 Route::get('/cps', 'ConsumedPiecesController@index')->name('cps.index');



    Route::get('/externals/createExternal/{id}', 'ExternalController@createExternal')->name('externals.createExternal');
    Route::get('/externals/showExternal/{id}', 'ExternalController@showExternal')->name('externals.showExternal');
    Route::delete('/externals/destroyExternal/{id}', 'ExternalController@destroyExternal')->name('externals.destroyExternal');
    Route::post('/externals/storeExternal', 'ExternalController@storeExternal')->name('externals.storeExternal');
    Route::put('/externals/updateExternal/{id}', 'ExternalController@updateExternal')->name('externals.updateExternal');
    Route::get('/externals/{id}/editExternal', 'ExternalController@editExternal')->name('externals.editExternal');
    Route::get('/externals', 'ExternalController@index')->name('externals.index');
    Route::resource('/materialsmanager','MaterialManagerController');
    Route::resource('/dtsM','DtMController');

    Route::get('/piecesMaterial/createCps/{id}', 'PiecesMController@createCps')->name('piecesMaterial.createCps');
    Route::get('/piecesMaterial/showCps/{id}', 'PiecesMController@showCps')->name('piecesMaterial.showCps');
    Route::delete('/piecesMaterial/destroyCps/{id}', 'PiecesMController@destroyCps')->name('piecesMaterial.destroyCps');
    Route::post('/piecesMaterial/storeCps', 'PiecesMController@storeCps')->name('piecesMaterial.storeCps');
    Route::put('/piecesMaterial/updateCps/{id}', 'PiecesMController@updateCps')->name('piecesMaterial.updateCps');
    Route::get('/piecesMaterial/{id}/editCps', 'PiecesMController@editCps')->name('piecesMaterial.editCps');
    Route::get('/piecesMaterial', 'PiecesMController@index')->name('piecesMaterial.index');

    Route::get('/repairsM', 'RepairMController@index')->name('repairsM.index');
   Route::get('/repairsM/createRepairs/{id}', 'RepairMController@createRepairs')->name('repairsM.createRepairs');
   Route::get('/repairsM/showRepairs/{id}', 'RepairMController@showRepairs')->name('repairsM.showRepairs');
   Route::delete('/repairsM/destroyRepairs/{id}', 'RepairMController@destroyRepairs')->name('repairsM.destroyRepairs');
   Route::post('/repairsM/storeRepairs', 'RepairMController@storeRepairs')->name('repairsM.storeRepairs');
   Route::put('/repairsM/updateRepairs/{id}', 'RepairMController@updateRepairs')->name('repairsM.updateRepairs');
   Route::get('/repairsM/{id}/editRepairs', 'RepairMController@editRepairs')->name('repairsM.editRepairs');



   Route::get('/externalsM/createExternal/{id}', 'ExternalMController@createExternal')->name('externalsM.createExternal');
   Route::get('/externalsM/showExternal/{id}', 'ExternalMController@showExternal')->name('externalsM.showExternal');
   Route::delete('/externalsM/destroyExternal/{id}', 'ExternalMController@destroyExternal')->name('externalsM.destroyExternal');
   Route::post('/externalsM/storeExternal', 'ExternalMController@storeExternal')->name('externalsM.storeExternal');
   Route::put('/externalsM/updateExternal/{id}', 'ExternalMController@updateExternal')->name('externalsM.updateExternal');
   Route::get('/externalsM/{id}/editExternal', 'ExternalMController@editExternal')->name('externalsM.editExternal');
   Route::get('/externalsM', 'ExternalMController@index')->name('externalsM.index');

});

Route::namespace('Kpis')->prefix('Kpis')->name('Kpis.')->group(function (){
    Route::resource('/gas','GasController');
    Route::resource('/dts','DTController');
    Route::resource('/interventions','InterventionsController');
    Route::resource('/liquids','LiquidsController');
    Route::resource('/materials','MaterialsController');
    Route::resource('/pannes','PanneController');
    Route::resource('/pieces','PiecesController');
    Route::resource('/staff','StaffController');
    Route::resource('/vehicules','VehiculesController');
    Route::resource('/repairs','RepairsController');
});
