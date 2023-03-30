<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayorController;

//Member routes before login 
Route::middleware(['IsAdminOrUserLogin'])->prefix('payor')->name('payor.')->group(function () {

	Route::get('/login', [PayorController::class, 'Login'])->name('login');
	Route::post('/checklogin', [PayorController::class, 'CheckLogin'])->name('checklogin');
    
});

Route::middleware(['CheckLoginForAllUsers:payor'])->prefix('payor')->name('payor.')->group(function () {

	Route::get('/dashboard', [PayorController::class, 'Dashboard'])->name('dashboard');
    Route::get('/logout', [PayorController::class, 'Logout'])->name('logout');
    Route::get('/changepassword', [PayorController::class, 'ChangePassword'])->name('changepassword');
	Route::get('/invoice', [PayorController::class, 'AllInvoice'])->name('invoice');
	Route::get('/invoice/view/{id}', [PayorController::class, 'ViewInvoice'])->name('invoice.view');
	Route::get('/membereligibility', [PayorController::class, 'MemberEligibility'])->name('membereligibility');
	Route::post('/getmembereligibility', [PayorController::class, 'GetMemberEligibility'])->name('getmembereligibility');
	Route::get('/add_dependent', [PayorController::class, 'AddDependent'])->name('add_dependent');
	Route::post('/save-family-member', [PayorController::class, 'SaveFamilyMember'])->name('savefamilymember');
	Route::get('/viewfamilymember', [PayorController::class, 'ViewFamilyMember'])->name('viewfamilymember');
	Route::get('/familymember/edit/{id}', [PayorController::class, 'EditFamilyMember'])->name('familymember.edit');
	Route::post('/familymember/update', [PayorController::class, 'UpdateFamilyMember'])->name('familymember.update');
	Route::get('/addmember', [PayorController::class, 'Add_Member'])->name('addmember');
	Route::post('/enroll/save', [PayorController::class, 'Store_Member'])->name('enroll.save');
	Route::get('/confirmation', [PayorController::class, 'Confirmation'])->name('confirmation');
	Route::get('/download-member', [PayorController::class, 'Downloadmember'])->name('downloadmember');
});    

