<?php

use App\Actions\SearchUser;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Actions\UpdatedUserPassword;


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
    return view('post');
});

Route::get('user/search', SearchUser::class);

Route::get('user/{user_id}', UpdatedUserPassword::class)->name('user-show');
//Route::patch('user/{user_id}/password-change', UpdatedUserPassword::class);


Route::resource('user', UserController::class);
//Route::patch('user/password-change', UpdatedUserPassword::class)->name('user-password-change');


