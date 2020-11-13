<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

//Route::resource('/project',ProjectController::class);
Route::post('/project', [ProjectController::class, 'store']);
Route::post('/projectvalidation', [ProjectController::class, 'uniqueValidation']);
Route::get('/project', [ProjectController::class, 'index']);
Route::get('/project/create', [ProjectController::class, 'create']);
Route::put('/project/{project}', [ProjectController::class, 'update']);
Route::get('/project/{project}/edit', [ProjectController::class, 'edit']);
Route::delete('/project/{project}/delete', [ProjectController::class, 'destroy']);

//Route::resource('/employee',EmployeeController::class);

Route::get('/employee/{employee_id}/imagedelete/{filename}', [EmployeeController::class, 'imagedelete']);
Route::post('/employee', [EmployeeController::class, 'store']);
Route::post('/employeevalidation', [EmployeeController::class, 'uniqueValidation']);
Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/employee/create', [EmployeeController::class, 'create']);
Route::put('/employee/{employee_id}', [EmployeeController::class, 'update']);
Route::get('/employee/{employee_id}/edit', [EmployeeController::class, 'edit']);
Route::delete('/employee/{employee_id}/delete', [EmployeeController::class, 'destroy']);



});
