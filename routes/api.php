<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\Auth\AuthController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//Route::post('/send-reset-link', [AuthController::class, 'resetPasswordRequest'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

//protected routes
Route::post('/create-task', [TaskController::class, 'createTask'])->name('create.task');
Route::post('/update-task/{id}', [TaskController::class, 'updateTask'])->name('update.task');
Route::get('/show-all-task', [TaskController::class, 'showAll'])->name('show.all');
Route::get('/show-task/{id}', [TaskController::class, 'show'])->name('show.task');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});