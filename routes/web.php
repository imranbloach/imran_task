<?php

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
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get', 'post'], 'login', "AdminController@login");
    Route::group(['middleware'=>['admin']], function(){
        Route::get('/dashboard', 'AdminController@dashboard');
        Route::match(['get', 'post'], '/change-password', 'AdminController@changePassword');
        Route::post('check-password', 'AdminController@checkPassword');
        Route::match(['get', 'post'], 'update-detail', 'AdminController@updateDetail');
        Route::get('/sub-admins', 'AdminController@subAdmins');
        Route::get('/logout', 'AdminController@logout');
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', 'CmsController@edit');
        Route::get('tasks', 'TaskController@index');
        Route::match(['get', 'post'], 'add-edit-sub-admin/{id?}', 'AdminController@addEditSubAdmin');
        Route::post('update-sub-admin-status', "AdminController@updateSubAdminStatus");

        //Perform CRUD Operations for  CMS pages
        Route::get('cms-pages', 'CmsController@index');
        Route::post('update-page-status', "CmsController@update");
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', 'CmsController@edit');
        Route::get('delete-cms-page/{id?}', 'CmsController@destroy');
    });
});
