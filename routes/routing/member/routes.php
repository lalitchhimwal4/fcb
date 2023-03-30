<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberController;

Route::get('/find-providers', [MemberController::class, 'FindProviders'])->prefix('member')->name('member.findproviders');

//Member routes before login 
Route::middleware(['IsAdminOrUserLogin'])->prefix('member')->name('member.')->group(function () {

	Route::get('/enroll/step1', [MemberController::class, 'Enroll_Step1'])->name('enroll.step1');
	Route::match(['GET', 'POST'], '/enroll/step2', [MemberController::class, 'Enroll_Step2'])->name('enroll.step2');
	Route::post('/enroll/save-step2', [MemberController::class, 'Enroll_SaveStep2'])->name('enroll.savestep2');
	Route::get('/enrolled/step2', [MemberController::class, 'Enrolled_Step2'])->name('enrolled.step2');
	Route::match(['GET', 'POST'], '/enrolled/check-step2', [MemberController::class, 'Enrolled_CheckStep2'])->name('enrolled.checkstep2');
	Route::post('/enrolled/checklogin', [MemberController::class, 'Enrolled_CheckLogin'])->name('enrolled.checklogin');
	Route::get('/confirmation', [MemberController::class, 'Confirmation'])->name('confirmation');
	Route::post('/afterconfirmation', [MemberController::class, 'AfterConfirmation'])->name('afterconfirmation');
	Route::get('/login', [MemberController::class, 'Login'])->name('login');
	Route::post('/checklogin', [MemberController::class, 'CheckLogin'])->name('checklogin');
	Route::get('/forgot-password', [MemberController::class, 'ShowForgotPassword'])->name('showforgotpassword');
	Route::post('/submit-forgot-password', [MemberController::class, 'SubmitForgotPassword'])->name('submitforgotpassword');
	Route::get('/reset-password/{token}/{fcbid}', [MemberController::class, 'ShowResetPassword'])->name('showresetpassword');
	Route::post('/submit-reset-password', [MemberController::class, 'SubmitResetPassword'])->name('submitresetpassword');
	Route::get('/subscription/success', [MemberController::class, 'MemberSubscriptionSuccess'])->name('subscription.success');
	Route::get('/subscription/cancel', [MemberController::class, 'MemberSubscriptionCancel'])->name('subscription.cancel');
});


//Member routes after login 
Route::middleware(['CheckLoginForAllUsers:member'])->prefix('member')->name('member.')->group(function () {

	Route::get('/dashboard', [MemberController::class, 'Dashboard'])->name('dashboard');
	Route::post('/paypalpayment', [MemberController::class, 'Paypalpayment'])->name('paypalpayment');
	Route::get('/payment/success', [MemberController::class, 'PaymentSuccess'])->name('payment.success');
	Route::get('/payment/cancel', [MemberController::class, 'PaymentCancel'])->name('payment.cancel');
	Route::get('/enroll-family-member', [MemberController::class, 'EnrollFamilyMember'])->name('enrollfamilymember');
	Route::post('/save-family-member', [MemberController::class, 'SaveFamilyMember'])->name('savefamilymember');
	Route::get('/family', [MemberController::class, 'Family'])->name('family');
	Route::get('/familymember/delete/{id}', [MemberController::class, 'DeleteFamilyMember'])->name('familymember.delete');
	Route::get('/familymember/edit/{id}', [MemberController::class, 'EditFamilyMember'])->name('familymember.edit');
	Route::post('/familymember/update/', [MemberController::class, 'UpdateFamilyMember'])->name('familymember.update');
	Route::get('/contact', [MemberController::class, 'Contact'])->name('contact');
	Route::get('/edit-contact', [MemberController::class, 'EditContact'])->name('editcontact');
	Route::post('/update-contact', [MemberController::class, 'UpdateContact'])->name('updatecontact');
	Route::get('/logout', [MemberController::class, 'Logout'])->name('logout');
	Route::get('/changepassword', [MemberController::class, 'ChangePassword'])->name('changepassword');
	Route::post('/updatepassword', [MemberController::class, 'UpdatePassword'])->name('updatepassword');
	Route::post('/update-password-alert', [MemberController::class, 'UpdatePasswordAlert'])->name('update.password.alert');
	Route::get('/upgrade-family-plan', [MemberController::class, 'PaypalpaymentUpgrade'])->name('upgradeplan');
	Route::get('/downgrade-single-plan', [MemberController::class, 'PaypalpaymentUpgrade'])->name('downgradeplan');
	Route::get('/view-claims', [MemberController::class, 'viewClaims'])->name('view_claims');
	
});


