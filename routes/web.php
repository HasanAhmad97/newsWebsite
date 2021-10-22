<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController,roleController2,userController};
//use App\Http\Controllers\UserManagement\RoleController;
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




Auth::routes();
Route::get('/', [App\Http\Controllers\homePageController::class, 'home']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [App\Http\Controllers\homePageController::class, 'home'])->name('home');
Route::get('/home/section/{name}', [App\Http\Controllers\homePageController::class, 'newsType'])->name('section');

//Route::resource('roles','RoleController');
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    ################## strat-users-routes #############################
    Route::get('/users', [userController::class,'usersShow'])->name('users');
    Route::get('/user-create', [userController::class,'usersCreate'])->name('userCreate');
    Route::post('/user-store', [userController::class,'create'])->name('userStore');
    Route::get('/user-create', [userController::class,'usersCreate'])->name('userCreate');
    Route::get('/user-edit/{id}', [userController::class,'edit'])->name('userEdit');
    Route::get('/user-delete/{id}', [userController::class,'delete'])->name('delete');
    Route::post('/user-update/{id}', [userController::class,'userUpdate'])->name('userUpdate');
    ################## end-users-routes #############################################
    ################## strat-posts-routes ##########################################
    Route::get('/Create-Post', [PostController::class,'postShow'])->name('postShow');
    Route::post('/post-store', [PostController::class,'postStore'])->name('post.store');
    Route::get('/show-Posts', [PostController::class,'postTable'])->name('postTable');
    Route::post('/update-Post/{id}', [PostController::class,'postUpdate'])->name('post.update');
    Route::get('/delete-Post/{id}', [PostController::class,'postDelete'])->name('post.delete');
    Route::get('/edit-Post/{id}', [PostController::class,'editPost'])->name('post.edit');
    ################## end-posts-routes #############################################
    Route::post('/category-store', [PostController::class,'categoryStore'])->name('category.store');
    Route::get('/add-category', [PostController::class,'categoryAdd'])->name('category.add');

    Route::post('/urgent-store', [PostController::class,'urgentStore'])->name('urgent.store');
    Route::get('/add-urgent', [PostController::class,'urgentAdd'])->name('urgent');

    Route::get('/show-role', [roleController2::class,'index'])->name('roles.index');
    Route::get('/add-role', [roleController2::class,'create'])->name('roles.create');
    Route::get('/show-role/{id}', [roleController2::class,'show'])->name('roles.show');
    Route::get('/edit-role/{id}', [roleController2::class,'edit'])->name('roles.edit');
    Route::PATCH('/update-role/{id}', [roleController2::class,'update'])->name('roles.update');
    Route::post('/store-role', [roleController2::class,'store'])->name('role.store');
    Route::delete('/delete-role/{id}', [roleController2::class,'destroy'])->name('roles.destroy');
    Route::get('/add-permission', [roleController2::class,'addPermission'])->name('add.permission');
    Route::post('/store-permission', [roleController2::class,'storePermission'])->name('store.permission');

    Route::post('/update-fcm-token', [App\Http\Controllers\AdminController::class, 'updateFcmToken'])->name('update.fcm.token');


    Route::group(['prefix'=>'notifications'], function (){
        Route::get('/',[\App\Http\Controllers\NotificationController::class,'index'])->name('notification.form');
        Route::post('/send',[\App\Http\Controllers\NotificationController::class,'sendNotification'])->name('notification.send');
    });
});
