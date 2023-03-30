<?php

use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\PayorController;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('verify_member_subscription_payment', function(MemberController $controller) {
    $date = Carbon::today();
    $controller->verify_member_subscription_payment($date);
})->purpose('Verify annual member subscription payment in PayPal');

Artisan::command('process_member_claims', function (MemberController $controller) {
    $date = Carbon::today();
    $controller->process_member_claims($date);
})->purpose('Daily process the member claims');

Artisan::command('showSubscriptionDetails', function (MemberController $controller) {
    $date = Carbon::today();
    $controller->showSubscriptionDetails($date);
})->purpose('Every Minute process the member Plan Upgrade');

Artisan::command('InvoicesGenerate', function (PayorController $controller) {
    $date = Carbon::today();
    $controller->InvoicesGenerate($date);
})->purpose('Every Minute process To generate Invoice');