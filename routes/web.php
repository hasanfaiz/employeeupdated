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


/*Route::middleware(['auth:sanctum', 'verified'])->get('/employee', function () {
    return view('employee');
})->name('employee');*/


/*Route::middleware(['auth:sanctum', 'verified'])->get('/project', function () {
    return view('project.index');
})->name('project');*/



Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

Route::resource('/project',ProjectController::class);
Route::resource('/employee',EmployeeController::class);

});





//Route::get('/employee}', [EmployeeController::class, 'employee.index']);
//Route::get('/employee/{id}', [EmployeeController::class, 'edit']);



         /*   Route::resource('/employee', 'EmployeeController', ['except' => ['show'], 'names' => ['index' => 'employee.index', 'create' => 'employee.create', 'store' => 'employee.index', 'edit' => 'employee.edit', 'update' => 'employee.edit', 'destroy' => 'employee.destroy']]);
*/

//Route::get('/project', [ProjectController::class, 'project.index']);