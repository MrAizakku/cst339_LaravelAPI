<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Household;
use App\Item;
use App\Http\Controllers\HouseholdApiController;
use App\Http\Controllers\ItemApiController;


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

/************************
 *      HOUSEHOLDS      *
 ************************/
Route::get('/households', [HouseholdApiController::class, 'index']);
Route::get('/households/{household}', [HouseholdApiController::class, 'isolate']);
Route::post('/households', [HouseholdApiController::class, 'store']);
Route::put('/households/{household}', [HouseholdApiController::class, 'update']);
Route::delete('/households/{household}', [HouseholdApiController::class, 'destroy']);

/************************
 *        ITEMS         *
 ************************/
Route::get('/items', [ItemApiController::class, 'index']);
Route::get('/items/{item}', [ItemApiController::class, 'isolateById']);
Route::get('/items/household/{hhid}', [ItemApiController::class, 'isolateByHhid']);
Route::post('/items', [ItemApiController::class, 'store']);
Route::put('/items/{item}', [ItemApiController::class, 'update']);
Route::delete('/items/{item}', [ItemApiController::class, 'destroy']);

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});