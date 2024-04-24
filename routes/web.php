<?php

use App\Http\Controllers\Task\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks_index');
    Route::delete('/{id}', [TaskController::class, 'delete'])->name('tasks_delete');
    Route::get('/create_task', [TaskController::class, 'create'])->name('create_task');
    Route::post('/', [TaskController::class, 'store'])->name('store_task');
    Route::get('/edit', [TaskController::class, 'edit'])->name('edit_task');
    Route::post('/update', [TaskController::class, 'update'])->name('update_task');
});
