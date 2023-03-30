<?php

namespace App\Http\Controllers\Frontend\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Facades\PayPal;
use App\Models\InsuredProfile;
use App\Models\Member;
use App\Models\Provider\ProviderOffice;

class HomeController extends Controller
{
   public function index()
   {
      return view('frontend.homepage.index');
   }

   public function fcblogin()
   {
      if (Auth::check()) {
         return redirect('/');
      }
      return view('frontend.fcblogin');
   }

   public function fcbenroll()
   {
      if (Auth::check()) {
         return redirect('/');
      }
      return view('frontend.fcbenroll');
   }
   public function showSubscriptionDetails(){
      $plan_data = InsuredProfile::where('upgrade_plan','!=',NULL )->get()->toArray();
      if ($plan_data) {
        foreach($plan_data as $val){
          $upgrade_plan = $val['upgrade_plan'];
          $paypal_subscription_id = $val['paypal_subscription_id'];
          $provider = PayPal::setProvider();
          $provider->getAccessToken();
          $response = $provider->setReturnAndCancelUrl(route('member.payment.success'), route('member.payment.cancel'))
            ->showSubscriptionDetails($paypal_subscription_id);
        
          if($response) {
            if (strtoupper($response['status']) == 'ACTIVE') {
              if($response['plan_id'] == $upgrade_plan){
                $plan_id = InsuredProfile::where('upgrade_plan', $upgrade_plan)->pluck('plan_id')->first();
                if($plan_id == 1){
                  $MemberProfile = InsuredProfile::where('paypal_subscription_id', $paypal_subscription_id)->first();
                  $MemberProfile->plan_id = 2;
                  $MemberProfile->upgrade_plan = NULL;
                  $MemberProfile->save();
                }
                elseif($plan_id == 2){
                  $MemberProfile = InsuredProfile::where('paypal_subscription_id', $paypal_subscription_id)->first();
                  $MemberProfile->plan_id = 1;
                  $MemberProfile->upgrade_plan = NULL;
                  $MemberProfile->save();
                }
              }
            }
          }
        }  
      } 
      //return  Redirect::route('member.dashboard')->with('error', 'Something went wrong with paypal configuration settings. Contact website administrator for help.');
   }
  
}
