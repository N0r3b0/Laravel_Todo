<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\NoteController;

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
    return view('todo-home');
});


Route::resource('todos', TodoController::class)->middleware('auth');

Route::get('/todos', [TodoController::class, 'index'])->middleware('auth')->name('todos.index');
Route::get('todos/{todo}', [TodoController::class, 'destroy'])->middleware('auth')->name('todos.destroy');


Route::get('/notes/{todo}', [NoteController::class, 'show'])->name('notes.show');
Route::post('/notes/{todo}', [NoteController::class, 'store'])->name('notes.store');

Route::get('/editNote/{noteId}', [NoteController::class, 'edit'])->name('editNote');
Route::put('/notes/{noteId}', [NoteController::class, 'update'])->name('notes.update');

Route::get('/notes/{todoId}/{noteId}', [NoteController::class, 'destroy'])->name('notes.destroy');


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

