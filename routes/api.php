<?php

use App\Http\Controllers\ComplainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/linkstorage', function () {
    return Artisan::call('storage:link');
});

Route::middleware('auth:sanctum')->group(
    function (){
        Route::get('/all_complaint', [ComplainController::class, 'getComplaints']);
        Route::get('/complaint', [ComplainController::class, 'getComplaint']);
        Route::post('/update_complaint_progress',[ComplainController::class, 'updateComplaintProgress']);
        Route::get('/summery', [ComplainController::class, 'getSummery']);
        Route::get('/get_report_between_date',[ComplainController::class, 'exportComplatintReportBetweenDate']);
        Route::get('/get_report',[ComplainController::class, 'exportComplatintReport']);
    }
);
Route::post('/login', [UserController::class, 'login']);
Route::post('/send_complaint', [ComplainController::class, 'createComplain']);
