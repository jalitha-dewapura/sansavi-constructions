<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\MaterialRequestNoteController;
use App\Http\Controllers\ApproveNoteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequestMaterialsController;

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
    return view('dashboard');
})->name('dashboard');

//Users
Route::get('/users',[UserController::class, 'index'])->name('user.index');

Route::get('/user/create',[UserController::class, 'create'])->name('user.create');
Route::post('/user/create',[UserController::class, 'store'])->name('user.store');

//Items
Route::get('/items',[ItemsController::class, 'index'])->name('items.index');

Route::get('/item/create',[ItemsController::class, 'create'])->name('items.create');
Route::post('/item/create',[ItemsController::class, 'store'])->name('items.store');

Route::get('/item/update',[ItemsController::class, 'update'])->name('item.update');

Route::get('/item/destroy/{id}',[ItemsController::class, 'destroy'])->name('item.destroy');

//Site
Route::get('/sites',[SiteController::class, 'index'])->name('site.index');

Route::get('/site/create',[SiteController::class, 'create'])->name('site.create');
Route::post('/site/create',[SiteController::class, 'store'])->name('site.store');

Route::post('/site/update',[SiteController::class, 'update'])->name('site.update');

Route::get('/site/distroy/{id}',[SiteController::class, 'destroy'])->name('site.destroy');

Route::get('/districts',[SiteController::class, 'district'])->name('site.district');

//Material Reuest Note
Route::get('/material_request_notes',[MaterialRequestNoteController::class, 'index'])->name('material_request_note.index');

Route::get('/material_request_note/create',[MaterialRequestNoteController::class, 'create'])->name('material_request_note.create');
Route::post('/material_request_note/create',[MaterialRequestNoteController::class, 'store'])->name('material_request_note.store');

Route::get('/material_request_note/edit',[MaterialRequestNoteController::class, 'edit'])->name('material_request_note.edit');
Route::post('/material_request_note/update',[MaterialRequestNoteController::class, 'update'])->name('material_request_note.update');

Route::get('/material_request_note',[MaterialRequestNoteController::class, 'show'])->name('material_request_note.show');

Route::get('/material_request_note/destroy/{id}',[MaterialRequestNoteController::class, 'destroy'])->name('material_request_note.destroy');

//Request Materials
Route::get('/request_materials/update',[RequestMaterialsController::class, 'update'])->name('request_materials.update');
Route::get('/request_materials/destroy/{id}',[RequestMaterialsController::class, 'destroy'])->name('request_materials.destroy');

//Approve Note
Route::get('/approve_notes',[ApproveNoteController::class, 'index'])->name('approve_note.index');



//Login
Route::get('/login',[LoginController::class, 'index'])->name('login.index');

Route::post('/login',[LoginController::class, 'login'])->name('login.login');
Route::get('/logout',[LoginController::class, 'logout'])->name('login.logout');
