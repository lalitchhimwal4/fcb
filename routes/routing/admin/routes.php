<?php

use App\Http\Controllers\Admin\AccordianController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CustomBoxController;
use App\Http\Controllers\Admin\EmailManagementController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\NewsPublicationsController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminLoginController::class, 'Login'])->name('admin.login');
Route::post('/admin/checklogin', [AdminLoginController::class, 'CheckLogin'])->name('admin.checklogin');
Route::get('/logout', [AdminLoginController::class, 'Logout'])->name('AdminLogout');

//dashboard routes
Route::middleware(['checkrole', 'verified'])->prefix('admin')->name('admin.')->group(function () {

  Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
  Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
  Route::post('/saveprofile', [AdminController::class, 'saveprofile'])->name('saveprofile');

  //CMS Pages
  Route::get('/cms-pages', [CmsController::class, 'CmsPages'])->name('CmsPages');
  Route::get('/add-cms-page', [CmsController::class, 'AddCmsPage'])->name('AddCmsPage');
  Route::post('/save-cms-page', [CmsController::class, 'SaveCmsPage'])->name('SaveCmsPage');
  Route::get('/edit-cms-page/{id}', [CmsController::class, 'EditCmsPage'])->name('EditCmsPage');
  Route::post('/update-cms-page/{id}', [CmsController::class, 'UpdateCmsPage'])->name('UpdateCmsPage');
  Route::get('/delete-cms-page/{id}', [CmsController::class, 'DeleteCmsPage'])->name('DeleteCmsPage');

  //News Publications
  Route::get('/news-publications', [NewsPublicationsController::class, 'NewsPublications'])->name('NewsPublications');
  Route::get('/add-news-publications', [NewsPublicationsController::class, 'Add_News_Publications'])->name('AddNewsPublications');
  Route::post('/save-news-publications', [NewsPublicationsController::class, 'Save_News_Publications'])->name('SaveNewsPublications');
  Route::get('/edit-news-publications/{id}', [NewsPublicationsController::class, 'Edit_News_Publications'])->name('EditNewsPublications');
  Route::post('/update-news-publications/{id}', [NewsPublicationsController::class, 'Update_News_Publications'])->name('UpdateNewsPublications');
  Route::get('/delete-news-publications/{id}', [NewsPublicationsController::class, 'Delete_News_Publications'])->name('DeleteNewsPublications');

  //Settings
  Route::get('settings/{slug}', [AdminController::class, 'Settings'])->name('Settings');
  Route::post('settings/save/{slug}', [AdminController::class, 'SaveSettings'])->name('SaveSettings');

  //custombox
  Route::get('custom-boxes', [CustomBoxController::class, 'CustomBoxes'])->name('CustomBoxes');
  Route::get('Add-Custom-Box', [CustomBoxController::class, 'AddCustomBox'])->name('AddCustomBox');
  Route::post('Save-Custom-Box', [CustomBoxController::class, 'SaveCustomBox'])->name('SaveCustomBox');
  Route::get('Edit-Custom-Box/{id}', [CustomBoxController::class, 'EditCustomBox'])->name('EditCustomBox');
  Route::post('Update-Custom-Box/{id}', [CustomBoxController::class, 'UpdateCustomBox'])->name('UpdateCustomBox');
  Route::get('Delete-Custom-Box/{id}', [CustomBoxController::class, 'DeleteCustomBox'])->name('DeleteCustomBox');

  //Accordians
  Route::get('Accordians',  [AccordianController::class, 'Accordians'])->name('Accordians');
  Route::get('Add-Accordian',  [AccordianController::class, 'AddAccordian'])->name('AddAccordian');
  Route::post('Save-Accordian',  [AccordianController::class, 'SaveAccordian'])->name('SaveAccordian');
  Route::get('Edit-Accordian/{id}',  [AccordianController::class, 'EditAccordian'])->name('EditAccordian');
  Route::post('Update-Accordian/{id}',  [AccordianController::class, 'UpdateAccordian'])->name('UpdateAccordian');
  Route::get('Delete-Accordian/{id}',  [AccordianController::class, 'DeleteAccordian'])->name('DeleteAccordian');

  //Email Templates
  Route::get('/email-management', [EmailManagementController::class, 'index'])->name('emails.index');
  Route::post('/email-management', [EmailManagementController::class, 'create'])->name('emails.index');
  Route::get('/email-management/{slug}', [EmailManagementController::class, 'edit'])->name('emails.update');
  Route::post('/email-management/{slug}', [EmailManagementController::class, 'update'])->name('emails.update');

  //Members
  Route::get('/members', [MemberController::class, 'index'])->name('members.index');
  Route::post('/members', [MemberController::class, 'index'])->name('members.index');
  Route::get('/member/{id}', [MemberController::class, 'edit'])->name('member.edit');
  Route::get('/member/activate-member/{id}', [MemberController::class, 'activateMember'])->name('member.activate');
  Route::get('/member/email-activate-member/{id}', [MemberController::class, 'sendMemberActivationEmail'])->name('member.activate.email');

  //Import Providers and Provider Offices
  Route::get('/import-data', [ImportController::class, 'index'])->name('import');
  Route::post('/import-data', [ImportController::class, 'importFile'])->name('import');
});
