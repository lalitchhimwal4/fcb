<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//use Auth;

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

//Homepage Route
Route::get('/', [App\Http\Controllers\Frontend\Homepage\HomeController::class, 'index']);
Route::get('/showsubscriptiondetails', [App\Http\Controllers\Frontend\Homepage\HomeController::class, 'showSubscriptionDetails'])->name('showsubscriptiondetails');
//Auth routes added by laravel
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth routes added by laravel complete

//Ck editor
Route::post('ckeditor/image_upload', [App\Http\Controllers\CkEditor\CKEditorController::class, 'upload'])->name('CKeditorImageUpload');

//Clear Cache
Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    dd("Successfully, you have cleared all cache of application.");
});

// ********************************************************************************************
//*********************** Route Linking 
// ********************************************************************************************

require __DIR__ . '/routing/frontend/routes.php';
require __DIR__ . '/routing/member/routes.php';
require __DIR__ . '/routing/provider/routes.php';
require __DIR__ . '/routing/admin/routes.php';
require __DIR__ . '/routing/payor/routes.php';
// ********************************************************************************************
//*********************** Route Linking End
// ********************************************************************************************
