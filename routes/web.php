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

use App\User;
use App\Traits\HasRolesAndPermissions;

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/test', function () {
    // $user = User::find(3);
    // dd($user->hasRole('web-developer')); // вернёт true
    //  dd($user->hasRole('project-manager'));// вернёт false
    //   dd($user->givePermissionsTo('manage-users'));
    //  dd( $user->hasPermissionThroughRole('manage-users'));// вернёт true

    return view('test');

});
