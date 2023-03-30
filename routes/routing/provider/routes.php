<?php

use Illuminate\Support\Facades\Route;

//Provider routes before login 
Route::middleware(['IsAdminOrUserLogin'])->prefix('provider')->name('provider.')->group(function () {

	Route::get('/enroll/step1', [App\Http\Controllers\Provider\ProviderController::class, 'Enroll_Step1'])->name('enroll.step1');
	Route::match(['GET', 'POST'], '/enroll/step2', [App\Http\Controllers\Provider\ProviderController::class, 'Enroll_Step2'])->name('enroll.step2');
	Route::get('/confirmation', [App\Http\Controllers\Provider\ProviderController::class, 'Confirmation'])->name('confirmation');

	Route::post('/case/search', [App\Http\Controllers\Provider\ProviderController::class, 'Case_Search'])->name('case.search');

	/* ==============Case1 routes================*/
	Route::get('/provider-exist-office-exist/{license_num}/{location_num?}/{postal_code?}', [App\Http\Controllers\Provider\ProviderController::class, 'ProviderExist_OfficeExist'])->name('provider_exist.office_exist');
	Route::post('/provider-exist-office-exist', [App\Http\Controllers\Provider\ProviderController::class, 'Save_ProviderExist_OfficeExist'])->name('save.provider_exist.postal_exist_health');

	/* ==============Case2 routes================*/
	Route::get('/provider-exist-office-notexist/{license_num}/{location_num?}/{postal_code?}', [App\Http\Controllers\Provider\ProviderController::class, 'ProviderExistOfficeNotExist'])->name('provider_exist.office_notexist');
	Route::post('/provider-exist-office-notexist', [App\Http\Controllers\Provider\ProviderController::class, 'Save_ProviderExistOfficeNotExist'])->name('save.provider_exist.office_notexist');

	Route::get('/provider-exist-office-exist-clinic-not-found/{license_num}/{location_num?}/{postal_code?}', [App\Http\Controllers\Provider\ProviderController::class, 'ProviderExistOfficeExist'])->name('provider_exist.office_exist_clinic_not_found');
	Route::post('/provider-exist-office-exist-clinic-not-found', [App\Http\Controllers\Provider\ProviderController::class, 'Save_ProviderExistOfficeExist_ClinicNotFound'])->name('save.provider_exist.office_exist_clinic_not_found');

	/* ==============Case3 routes================*/
	Route::get('/provider-notexist-office-notexist/{provider_type}/{license_num}/{location_num?}/{postal_code?}/{fname}/{lname}/{dental_speciality?}', [App\Http\Controllers\Provider\ProviderController::class, 'ProviderNotExist_OfficeNotExist'])->name('provider_notexist.office_notexist');
	Route::post('/provider-notexist-office-notexist', [App\Http\Controllers\Provider\ProviderController::class, 'Save_ProviderNotExistOfficeNotExist'])->name('save.provider_notexist.office_notexist');

	/* ==============Case4 routes================*/
	Route::get('/provider-notexist-office-exist/{provider_type}/{license_num}/{location_num?}/{postal_code?}/{fname}/{lname}/{dental_speciality?}', [App\Http\Controllers\Provider\ProviderController::class, 'ProviderNotExist_OfficeExist'])->name('provider_notexist.office_exist');
	Route::post('/provider-notexist-office-exist', [App\Http\Controllers\Provider\ProviderController::class, 'Save_ProviderNotExistOfficeExist'])->name('save.provider_notexist.office_exist');

	//case4 route for health provider 
	Route::post('/provider-notexist-office-exist-health', [App\Http\Controllers\Provider\ProviderController::class, 'Save_ProviderNotExistOfficeExistHealth'])->name('save.provider_notexist.office_exist_health');
	Route::get('/clinic-not-found/{provider_type}/{license_num}/{location_num?}/{postal_code?}/{fname}/{lname}', [App\Http\Controllers\Provider\ProviderController::class, 'Health_Clinic_NotFound'])->name('healthclinicnotfound');

	Route::post('/provider-notexist-office-exist-health', [App\Http\Controllers\Provider\ProviderController::class, 'Save_ProviderNotExistOfficeExistHealth'])->name('save.provider_notexist.office_exist_health');
	Route::get('/provider-found-clinic-not-found/{provider_type}/{license_num}/{location_num?}/{postal_code?}/{fname}/{lname}', [App\Http\Controllers\Provider\ProviderController::class, 'Health_ProviderFound_Clinic_NotFound'])->name('providerfoundhealthclinicnotfound');



	Route::get('/login', [App\Http\Controllers\Provider\ProviderController::class, 'Login'])->name('login');
	Route::post('/checklogin', [App\Http\Controllers\Provider\ProviderController::class, 'CheckLogin'])->name('checklogin');
	Route::get('/forgot-password', [App\Http\Controllers\Provider\ProviderController::class, 'ShowForgotPassword'])->name('showforgotpassword');
	//Route::post('/getoffices', [App\Http\Controllers\Provider\ProviderController::class, 'Getoffices'])->name('getoffices');
});


//Provider routes after login 
Route::middleware(['CheckLoginForAllUsers:provider'])->prefix('provider')->name('provider.')->group(function () {

	Route::get('/dashboard', [App\Http\Controllers\Provider\ProviderController::class, 'Dashboard'])->name('dashboard');
	Route::get('/edit-provider-details', [App\Http\Controllers\Provider\ProviderController::class, 'EditProviderDetails'])->name('editdetails');
	Route::post('/save-provider-details', [App\Http\Controllers\Provider\ProviderController::class, 'SaveProviderDetails'])->name('savedetails');
	Route::post('/save-provider-details-popups', [App\Http\Controllers\Provider\ProviderController::class, 'SaveProviderDetailsPopup'])->name('savedetailsPopups');
	Route::get('/logout', [App\Http\Controllers\Provider\ProviderController::class, 'Logout'])->name('logout');
	Route::get('/view-offices', [App\Http\Controllers\Provider\ProviderController::class, 'ViewOffices'])->name('viewoffices');
	Route::get('/edit-office/{officeid}', [App\Http\Controllers\Provider\ProviderController::class, 'EditOffice'])->name('editoffice');
	Route::post('/update-office/', [App\Http\Controllers\Provider\ProviderController::class, 'UpdateOffice'])->name('updateoffice');
	Route::get('/registered-providers/{officeid}', [App\Http\Controllers\Provider\ProviderController::class, 'RegisteredProviders'])->name('registeredproviders');

	Route::get('/changepassword', [App\Http\Controllers\Provider\ProviderController::class, 'ChangePassword'])->name('changepassword');
	Route::post('/updatepassword', [App\Http\Controllers\Provider\ProviderController::class, 'UpdatePassword'])->name('updatepassword');
	Route::post('/update-password-alert', [App\Http\Controllers\Provider\ProviderController::class, 'UpdatePasswordAlert'])->name('update.password.alert');

	/* ==============Claim Routes================*/
	Route::get('/claim/step1/{request_type?}', [App\Http\Controllers\Provider\ProviderClaimController::class, 'index'])->name('claim_step1');
	Route::post('/claim/step1', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep1'])->name('submit_claim_step1');
	Route::get('/claim/step2', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimStep2'])->name('claim_step2');
	Route::post('/claim/step2', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep2'])->name('submit_claim_step2');
	Route::get('/claim/step3', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimStep3'])->name('claim_step3');
	Route::post('/claim/step3', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep3'])->name('submit_claim_step3');
	Route::get('/claim/step4', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimStep4'])->name('claim_step4');
	Route::post('/claim/step4', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep4'])->name('submit_claim_step4');
	Route::get('/claim/step5', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimStep5'])->name('claim_step5');
	Route::post('/claim/step5', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep5'])->name('submit_claim_step5');
	Route::post('/claim/step5/add-service', [App\Http\Controllers\Provider\ProviderClaimController::class, 'addServiceClaimStep5'])->name('add_service_claim_step5');
	Route::post('/claim/step5/remove-service', [App\Http\Controllers\Provider\ProviderClaimController::class, 'removeServiceClaimStep5'])->name('remove_service_claim_step5');
	Route::get('/claim/step6', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimStep6'])->name('claim_step6');
	Route::post('/claim/step6', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep6'])->name('submit_claim_step6');
	Route::get('/claim/step7', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimStep7'])->name('claim_step7');
	Route::post('/claim/step7', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep7'])->name('submit_claim_step7');
	Route::get('/claim/step8/{claim?}', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimStep8'])->name('claim_step8');
	Route::post('/claim/step8/{claim?}', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimStep8'])->name('submit_claim_step8');
	Route::get('/claim/eob/{claim?}', [App\Http\Controllers\Provider\ProviderClaimController::class, 'claimEob'])->name('claim_eob');
	Route::get('/claim/cancel', [App\Http\Controllers\Provider\ProviderClaimController::class, 'submitClaimCancellation'])->name('submit_claim_cancellation');
	Route::get('/start_over/{claimCode?}', [App\Http\Controllers\Provider\ProviderClaimController::class, 'ReverseClaim'])->name('start_over');
	Route::get('/view-claims', [App\Http\Controllers\Provider\ProviderClaimController::class, 'viewClaims'])->name('view_claims');
	Route::post('/claim/validate-json-service', [App\Http\Controllers\Provider\ProviderClaimController::class, 'mockJsonValidation'])->name('validate-json-service');
	Route::get('/procedurecodefinder', [App\Http\Controllers\Provider\ProviderController::class, 'ProcedureCodeFinder'])->name('procedurecodefinder');
	Route::get('/searchprocedurecodebyid', [App\Http\Controllers\Provider\ProviderController::class, 'SearchProcedureCodeById'])->name('searchprocedurecodebyid');
});
