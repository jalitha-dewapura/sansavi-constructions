<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\MaterialRequestNoteController;
use App\Http\Controllers\ApproveNoteController;
use App\Http\Controllers\GoodReceiveNoteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RequestMaterialsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Reports\GeneratePO;
use App\Http\Controllers\ReportSiteAnnualCostController;
use App\Http\Controllers\ReportAnnualCostController;

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
Route::group(['middleware' => 'AuthUser', 'CORS'], function(){


//Dashboard
Route::get('/',[DashboardController::class, 'index'])->name('dashboard.index');


//Users
Route::get('/users',[UserController::class, 'index'])->name('user.index')->middleware(['CheckRole:1,6']);

Route::get('/user/create',[UserController::class, 'create'])->name('user.create')->middleware(['CheckRole:1,6']);
Route::post('/user/create',[UserController::class, 'store'])->name('user.store')->middleware(['CheckRole:1,6']);

Route::get('/user/{id}',[UserController::class, 'show'])->name('user.show');

Route::get('/user/update',[UserController::class, 'update'])->name('user.update')->middleware(['CheckRole:1,6']);

Route::get('/user/destroy/{id}',[UserController::class, 'destroy'])->name('user.destroy')->middleware(['CheckRole:1,6']);

//Items
Route::get('/items',[ItemsController::class, 'index'])->name('items.index');

Route::get('/item/create',[ItemsController::class, 'create'])->name('items.create')->middleware(['CheckRole:1,2,4']);
Route::post('/item/create',[ItemsController::class, 'store'])->name('items.store')->middleware(['CheckRole:1,2,4']);

Route::get('/item/update',[ItemsController::class, 'update'])->name('item.update')->middleware(['CheckRole:1,2,4']);

Route::get('/item/destroy/{id}',[ItemsController::class, 'destroy'])->name('item.destroy')->middleware(['CheckRole:1,2,4']);

//Site
Route::get('/sites',[SiteController::class, 'index'])->name('site.index');

Route::get('/site/create',[SiteController::class, 'create'])->name('site.create')->middleware(['CheckRole:1,6']);
Route::post('/site/create',[SiteController::class, 'store'])->name('site.store')->middleware(['CheckRole:1,6']);

Route::post('/site/update',[SiteController::class, 'update'])->name('site.update')->middleware(['CheckRole:1,6']);

Route::get('/site/distroy/{id}',[SiteController::class, 'destroy'])->name('site.destroy')->middleware(['CheckRole:1,6']);

Route::get('/districts',[SiteController::class, 'district'])->name('site.district');

//Material Reuest Note
Route::get('/material_request_notes/sk',[MaterialRequestNoteController::class, 'index_sk'])->name('material_request_note.index_sk')->middleware(['CheckRole:1,5']);
Route::get('/material_request_notes/qs',[MaterialRequestNoteController::class, 'index_qs'])->name('material_request_note.index_qs')->middleware(['CheckRole:1,4']);
Route::get('/material_request_notes/pm',[MaterialRequestNoteController::class, 'index_pm'])->name('material_request_note.index_pm')->middleware(['CheckRole:1,3']);
Route::get('/material_request_notes/po',[MaterialRequestNoteController::class, 'index_po'])->name('material_request_note.index_po')->middleware(['CheckRole:1,2']);
Route::get('/material_request_notes/hr',[MaterialRequestNoteController::class, 'index_hr'])->name('material_request_note.index_hr')->middleware(['CheckRole:1,6']);

Route::get('/material_request_note/create',[MaterialRequestNoteController::class, 'create'])->name('material_request_note.create')->middleware(['CheckRole:1,5']);
Route::post('/material_request_note/create',[MaterialRequestNoteController::class, 'store'])->name('material_request_note.store')->middleware(['CheckRole:1,5']);

Route::get('/material_request_note/edit',[MaterialRequestNoteController::class, 'edit'])->name('material_request_note.edit')->middleware(['CheckRole:1,5']);
Route::post('/material_request_note/update',[MaterialRequestNoteController::class, 'update'])->name('material_request_note.update')->middleware(['CheckRole:1,5']);

Route::get('/material_request_note',[MaterialRequestNoteController::class, 'show'])->name('material_request_note.show');

Route::get('/material_request_note/destroy/{id}',[MaterialRequestNoteController::class, 'destroy'])->name('material_request_note.destroy')->middleware(['CheckRole:1,5']);

//Request Materials
Route::get('/request_materials/update',[RequestMaterialsController::class, 'update'])->name('request_materials.update')->middleware(['CheckRole:1,5']);
Route::get('/request_materials/destroy/{id}',[RequestMaterialsController::class, 'destroy'])->name('request_materials.destroy')->middleware(['CheckRole:1,5']);

//Approve Note
Route::get('/approve_notes',[ApproveNoteController::class, 'index'])->name('approve_note.index')->middleware(['CheckRole:1,2,4']);

Route::post('/material_request_notes/approve',[ApproveNoteController::class, 'approve'])->name('approve_note.approve')->middleware(['CheckRole:1,2,4']);

Route::post('/material_request_notes/decline',[ApproveNoteController::class, 'decline'])->name('approve_note.decline')->middleware(['CheckRole:1,2,4']);

//Good Receive Note
Route::post('/good_receive_notes/store',[GoodReceiveNoteController::class, 'store'])->name('good_receive_note.store')->middleware(['CheckRole:1,5']);


//Report Generation
Route::get('/generate_po',[GeneratePO::class, 'generate'])->name('generate_po.generate');

Route::get('/report_site_annual_cost',[ReportSiteAnnualCostController::class, 'index'])->name('report_site_annual_cost.index');
Route::post('/report_site_annual_cost/generate',[ReportSiteAnnualCostController::class, 'generate'])->name('report_site_annual_cost.generate');

Route::get('/report_annual_cost',[ReportAnnualCostController::class, 'index'])->name('report_annual_cost.index');
Route::post('/report_annual_cost/generate',[ReportAnnualCostController::class, 'generate'])->name('report_annual_cost.generate');

});


//Login
Route::get('/login',[LoginController::class, 'index'])->name('login.index');

Route::post('/login',[LoginController::class, 'login'])->name('login.login');
Route::get('/logout',[LoginController::class, 'logout'])->name('login.logout');

//ForgetPassword
Route::get('/forgot_password',[ForgotPasswordController::class, 'index'])->middleware('guest')->name('forgot_password.index');
Route::post('/forgot_password',[ForgotPasswordController::class, 'forgot'])->middleware('guest')->name('forgot_password.forgot');

//ResetPassword
Route::get('/reset_password/{token}',[ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.reset');
Route::post('/reset-password',[ResetPasswordController::class, 'update'])->middleware('guest')->name('password.update');

