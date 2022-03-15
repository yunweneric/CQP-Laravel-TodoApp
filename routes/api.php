<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodosController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::resource('/', TodoController::class);
Route::get('/index', [TodosController::class, 'index'])->name('todos.index');
Route::post('/store', [TodosController::class, 'store'])->name('todos.store');
Route::get('/show/{id}', [TodosController::class, 'show'])->name('todos.show');
Route::post('/update/{id}', [TodosController::class, 'update'])->name('todos.update');
Route::post('/delete/{id}', [TodosController::class, 'delete'])->name('todos.delete');
