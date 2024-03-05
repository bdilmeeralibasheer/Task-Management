<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
Route::get('tasks/list', [TaskController::class, 'listData'])->name('task.list-data');
Route::get('tasks/create', [TaskController::class, 'create'])->name('task.create');
Route::post('tasks/store', [TaskController::class, 'store'])->name('task.store');
Route::get('tasks/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
Route::get('tasks/show/{id}', [TaskController::class, 'show'])->name('task.show');
Route::post('tasks/update/{id}', [TaskController::class, 'update'])->name('task.update');
Route::get('tasks/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');


