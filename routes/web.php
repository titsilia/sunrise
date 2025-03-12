<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MenuController;

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
    return view('index');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/auth', [AuthController::class, 'auth']);

Route::post('/auth_user', [AuthController::class, 'auth_user']);

Route::post('/auth_shop', [AuthController::class, 'auth_shop']);

Route::get('/reg', [AuthController::class, 'reg']);

Route::post('/reg_user', [AuthController::class, 'reg_user']);

Route::post('/auth_shop', [AuthController::class, 'auth_shop']);

Route::get('/exit', [AuthController::class, 'exit']);

Route::get('/menu/{id}', [MenuController::class, 'menu']);
Route::get('/menu_lunch', [MenuController::class, 'menu_lunch']);

Route::get('/application', [ApplicationController::class, 'application']);
Route::get('/personal_application/{id}', [ApplicationController::class, 'personal_application']);
Route::get('/app_dish_add/{id}', [ApplicationController::class, 'app_dish_add']);

Route::post('/application_create', [ApplicationController::class, 'application_create']);
Route::post('/guest_application_create', [ApplicationController::class, 'guest_application_create']);

Route::get('/sitemap', function () {
    return view('sitemap');
});

Route::get('/personal', [PersonalController::class, 'personal']);

Route::post('/personal_update', [PersonalController::class, 'personal_update']);

Route::get('/admin_applications/{id}/confirm', [AdminController::class, 'confirm']);
Route::get('/admin_applications/{id}/deny', [AdminController::class, 'deny']);

Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('/admin_control', [AdminController::class, 'admin_control']);

    Route::get('/admin_applications', [AdminController::class, 'admin_applications']);

    Route::get('/admin_edit_types_menu', [AdminController::class, 'admin_edit_types_menu']);
    Route::get('/admin_edit_types_dishes', [AdminController::class, 'admin_edit_types_dishes']);
    Route::get('/admin_edit_dishes', [AdminController::class, 'admin_edit_dishes']);
    Route::get('/admin_edit_lunches', [AdminController::class, 'admin_edit_lunches']);

    Route::get('/admin_add_menu', [AdminController::class, 'admin_add_menu']);
    Route::get('/admin_edit_menu', [AdminController::class, 'admin_edit_menu']);

    Route::post('/type_dish_create', [AdminController::class, 'type_dish_create']);
    Route::post('/type_menu_create', [AdminController::class, 'type_menu_create']);
    Route::post('/dish_create', [AdminController::class, 'dish_create']);
    Route::post('/lunch_create', [AdminController::class, 'lunch_create']);

    Route::post('/type_dish_update/{id}', [AdminController::class, 'type_dish_update']);
    Route::post('/type_menu_update/{id}', [AdminController::class, 'type_menu_update']);
    Route::post('/dish_update/{id}', [AdminController::class, 'dish_update']);
    Route::post('/lunch_update/{id}', [AdminController::class, 'lunch_update']);

    Route::get('/update-form-type-dish', [AdminController::class, 'updateFormTypeDish'])->name('updateFormTypeDish');
    Route::get('/update-form-dish', [AdminController::class, 'updateFormDish'])->name('updateFormDish');
    Route::get('/update-form-type-menu', [AdminController::class, 'updateFormTypeMenu'])->name('updateFormTypeMenu');
    Route::get('/update-form-lunch', [AdminController::class, 'updateFormLunch'])->name('updateFormLunch');

    Route::get('/dish_delete/{id}', [AdminController::class, 'dish_delete']);
    Route::get('/type_dish_delete/{id}', [AdminController::class, 'type_dish_delete']);
    Route::get('/type_menu_delete/{id}', [AdminController::class, 'type_menu_delete']);
    Route::get('/lunch_delete/{id}', [AdminController::class, 'lunch_delete']);

});
