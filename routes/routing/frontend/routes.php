<?php

use Illuminate\Support\Facades\Route;

//===================================Cms pages frontend=========================================//

Route::get('/pages/{slug}', [App\Http\Controllers\Frontend\CMS\CommonCmsController::class, 'index'])->name('CommonCmsController');

//other pages
Route::get('/contact-us', [App\Http\Controllers\Frontend\ContactUsController::class, 'index'])->name('ContactUs');
Route::post('/save-contact-details', [App\Http\Controllers\Frontend\ContactUsController::class, 'SaveContactDetails'])->name('SaveContactDetails');
Route::get('/payors', [App\Http\Controllers\Frontend\PayorController::class, 'index'])->name('Payors');
Route::get('/vendors', [App\Http\Controllers\Frontend\VendorController::class, 'index'])->name('Vendors');
Route::get('/partners', [App\Http\Controllers\Frontend\PartnerController::class, 'index'])->name('Partners');
Route::get('/prescriptions', [App\Http\Controllers\Frontend\PrescriptionsController::class, 'index'])->name('Prescriptions');
Route::get('/providers', [App\Http\Controllers\Frontend\ProvidersController::class, 'index'])->name('Providers');
Route::get('/plan-members', [App\Http\Controllers\Frontend\PlanMembersController::class, 'index'])->name('PlanMembers');
Route::get('/services', [App\Http\Controllers\Frontend\ServicesController::class, 'index'])->name('Services');
Route::get('/vision', [App\Http\Controllers\Frontend\VisionController::class, 'index'])->name('Vision');
Route::get('/news', [App\Http\Controllers\Frontend\NewsController::class, 'NewsListing'])->name('News');
Route::get('/publications', [App\Http\Controllers\Frontend\PublicationsController::class, 'PublicationsListing'])->name('Publications');
Route::get('/news/{slug}', [App\Http\Controllers\Frontend\NewsController::class, 'NewsDetail'])->name('NewsDetail');
Route::get('/publications/{slug}', [App\Http\Controllers\Frontend\PublicationsController::class, 'PublicationsDetail'])->name('PublicationsDetail');
Route::get('/fcb/login', [App\Http\Controllers\Frontend\Homepage\HomeController::class, 'fcblogin'])->name('fcbusers.login');
Route::get('/fcb/enroll', [App\Http\Controllers\Frontend\Homepage\HomeController::class, 'fcbenroll'])->name('fcbusers.enroll');

Route::post('/save-member-details', [App\Http\Controllers\Frontend\SaveMemberController::class, 'SaveMemberDetails'])->name('SaveMemberDetails');
Route::post('/save-payor-details', [App\Http\Controllers\Frontend\SaveMemberController::class, 'SavePayorDetails'])->name('SavePayorDetails');
Route::get('/getFeeData', [App\Http\Controllers\Provider\ProviderClaimController::class, 'getFeeData'])->name('getFeeData');
Route::post('/getoffices', [App\Http\Controllers\Provider\ProviderController::class, 'Getoffices'])->name('getoffices');
Route::post('/getmember', [App\Http\Controllers\Member\MemberController::class, 'Getmember'])->name('getmember');
Route::post('/getpayor', [App\Http\Controllers\PayorController::class, 'Getpayor'])->name('getpayor');
Route::post('/resetpassword', [App\Http\Controllers\Member\MemberController::class, 'Resetpassword'])->name('resetpassword');
Route::post('/resetpayorpassword', [App\Http\Controllers\PayorController::class, 'ResetPayorpassword'])->name('resetpayorpassword');
Route::post('/getproviderofficepassword', [App\Http\Controllers\Provider\ProviderController::class, 'Getproviderofficepassword'])->name('getproviderofficepassword');
Route::post('/getprovider', [App\Http\Controllers\Provider\ProviderController::class, 'Getprovider'])->name('getprovider');
Route::post('/getofficedetails', [App\Http\Controllers\Provider\ProviderController::class, 'Getofficedetails'])->name('getofficedetails');
Route::get('/providerotp', [App\Http\Controllers\Provider\ProviderController::class, 'SendProviderOTP'])->name('providerotp');
Route::post('/resetpasswordprovider', [App\Http\Controllers\Provider\ProviderController::class, 'Resetpasswordprovider'])->name('resetpasswordprovider');
Route::post('/checkmember', [App\Http\Controllers\Member\MemberController::class, 'Checkmember'])->name('checkmember');
Route::post('/checkpayor', [App\Http\Controllers\PayorController::class, 'checkpayor'])->name('checkpayor');
Route::get('/getdistance', [App\Http\Controllers\Member\MemberController::class, 'GetDistance'])->name('getdistance');

Route::get('/subscribe', [App\Http\Controllers\Member\MemberController::class, 'WebHookZapier'])->name('subscribe');
Route::get('/invoices-generate', [App\Http\Controllers\PayorController::class, 'InvoicesGenerate'])->name('invoicesgenerate');