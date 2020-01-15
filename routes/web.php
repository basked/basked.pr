<?php

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

use App\Permission;
use App\User;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/test', function () {



    $user = Auth::user();

    // dd($user->hasRole('web-developer')); // вернёт true
    //  dd($user->hasRole('project-manager'));// вернёт false
    //   dd($user->givePermissy
    //ionsTo('manage-users'));
    // return view('test');
    // foreach ($user->)

    dd($user->can('create-tasks'));
    dd($user->can('manage-users'));

});
