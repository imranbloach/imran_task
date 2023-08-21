<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\TaskController;

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
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);
    Route::group(['middleware'=>['admin']], function(){
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get', 'post'], '/change-password', [AdminController::class, 'changePassword']);
        Route::post('check-password', [AdminController::class, 'checkPassword']);
        Route::match(['get', 'post'], 'update-detail', [AdminController::class, 'updateDetail']);
        Route::get('/sub-admins', [AdminController::class, 'subAdmins']);
        Route::get('/logout', [AdminController::class, 'logout']);
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', [CmsController::class, 'edit']);
        Route::get('tasks', [TaskController::class, 'index']);
        Route::match(['get', 'post'], 'add-edit-sub-admin/{id?}', [AdminController::class, 'addEditSubAdmin']);
        Route::post('update-sub-admin-status', [AdminController::class, 'updateSubAdminStatus']);
        Route::get('delete-sub-admin/{id?}', [AdminController::class, 'destroy']);
        //Perform CRUD Operations for  CMS pages
        Route::get('cms-pages', [CmsController::class, 'index']);
        Route::post('update-page-status', [CmsController::class, 'update']);
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', [CmsController::class, 'edit']);
        Route::get('delete-cms-page/{id?}', [CmsController::class, 'destroy']);
    });
});
