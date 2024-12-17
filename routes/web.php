<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// });
Route::get('api/users', [UserController::class, 'index']);

Route::post('api/addDummyUser', [UserController::class, 'insert']);
Route::post('api/deleteDummyUser', [UserController::class, 'deleteByEmail']);



Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
