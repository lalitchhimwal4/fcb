<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsuredProfile;
use App\Models\Member;
use App\Models\Provider\ProviderOffice;
use App\Models\Provider\Provider;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use Stripe;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\EmailTrait;
use App\Models\Provider\ProviderClaim;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Support\Facades\Http;

class MemberController extends Controller
{
  use EmailTrait;

  // Member Enrollment step1
  public function Enroll_Step1()
  {
    return view('member.enroll_step1');
  }

  // Member Enrollment step2
  public function Enroll_Step2(Request $request)
  {
    $choice = ($request->checkexist) ? $request->checkexist : 1;

    if ($choice == 1) {
      return view('member.enroll_step2');
    } else {
      return Redirect::route('member.enrolled.step2');
    }
  }

  // Member Enrollment step2
  public function Enroll_SaveStep2(Request $request)
  {
    
    // validations
    $request->validate(
      [
        'relationship' => 'required',
        'lname' => 'required|min:3|max:255',
        'fname' => 'required|min:3|max:255',
        'gender' => 'required',
        'dateofbirth' => 'required',
        // 'latitude' => 'required',
        // 'longitude' => 'required',
        // 'address1' => 'required|min:3|max:255',
        'city' => 'required',
        'province' => 'required',
        'postalcode' => 'required|regex:/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/',
        'email' => 'required|unique:insured_profiles|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        'telephone' => 'required|unique:insured_profiles,telephone|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',
        'terms_and_conditions' => 'required',
      ],
      [
        'relationship.required' => 'Please select a valid relationship.',
        'lname.required' => 'Please enter Last name.',
        'fname.required' => 'Please enter First name.',
        'gender.required' => 'Please select your Gender.',
        'dateofbirth.required' => 'Please select your date of birth.',
        'latitude.required' => 'Please select valid location.',
        'longitude.required' => 'Please select valid location.',
        'city.required' => 'Please enter city name.',
        'province.required' => 'Please enter Province.',
        'postalcode.required' => 'Please enter Postal Code.',
        'postalcode.regex' => 'Please enter valid Postal Code.',
        'email.required' => 'Please enter Email.',
        'email.unique' => 'Account already registered with this Email or Phone Number. Please use your FCB Registration Number to login, or call FCB support for assistance.',
        'email.regex' => 'Please enter valid Email.',
        'telephone.required' => 'Please enter Telephone.',
        'telephone.unique' => 'Account already registered with this Email or Phone Number. Please use your FCB Registration Number to login, or call FCB support for assistance.',
        'telephone.regex' => 'Please enter valid Telephone.',
        'terms_and_conditions.required' => 'Please Accept Terms and conditions.',
        
      ]
    );
    // check if email already exist
    $is_email_exist = InsuredProfile::where('email', '=', $request->email)
    ->orWhere('telephone', '=', $request->telephone)
    ->first();
    
    if ($is_email_exist) {
      return Redirect::back()->with('error', 'Account already exist, please use your FCB Registration Id to
      login');
    }
    $request->session()->put('memberdata', $request->all());
    $memberdata = $request->session()->get('memberdata');
    $request->session()->forget('memberdata');
    if($memberdata){ 
      $InsuredProfile = new InsuredProfile;
      $InsuredProfile->address1 = 'addres1';
      $InsuredProfile->address2 = ($memberdata['address2']) ? $memberdata['address2'] : '';
      $InsuredProfile->city = $memberdata['city'];
      $InsuredProfile->postal_code = $memberdata['postalcode'];
      $InsuredProfile->province = $memberdata['province'];
      $InsuredProfile->telephone = $memberdata['telephone'];
      $InsuredProfile->email = $memberdata['email'];
      $InsuredProfile->latitude = $memberdata['latitude'];
      $InsuredProfile->longitude = $memberdata['longitude'];
      $is_ins_save = $InsuredProfile->save();

      if ($is_ins_save) {
        // generating data for member table - password
        $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
        $encodedpassword = Hash::make($password);

        // generating family number to save (we geneeratet this only in primary insured case)
        $family_number = Member::where('registration_method','online')->max('family_number');
        if (is_null($family_number)) {
          $family_number = '100000001';
        } else {
          $family_number++;
        }
        
        // generating fcb registration number to save
        $registration_id = Member::max('registration_id');
        if (is_null($registration_id)) {
          $registration_id = 'F000001';
        } else {
          $registration_id++;
        }

        // $policy_number = Member::max('policy_number');
        // if (is_null($policy_number)) {
        //   $policy_number = '20200001';
        // } else {
        //   $policy_number++;
        // }
       // echo $policy_number; die();
        // saving data in member table
        $member = new Member;
        $member->insured_profile_id = $InsuredProfile->id;
        $member->member_number = $family_number . '00';     //primary insured member no. = family_no + 00
        $member->family_number = $family_number;
        //$member->policy_number = $policy_number;
        $member->registration_id = $registration_id;
        $member->password = $encodedpassword;
        $member->registration_date = date('Y-m-d');
        $member->first_name = $memberdata['fname'];
        $member->last_name = $memberdata['lname'];
        $member->dob = $memberdata['dateofbirth'];
        $member->gender = $memberdata['gender'];
        $member->relationship = 0;
        $is_member_save = $member->save();

        if ($is_member_save) {
          // Sending mail to user containing password and FCB Registration Number to login
          $send_data_in_mail = array('fname' => $memberdata['fname'], 'lname' => $memberdata['lname'], 'password' => $password, 'fcbid' => $registration_id);
          $emailtemplate =  $this->FindTemplate('member-enrollment-password');

          try {
            // Send mail to user
            Mail::send('emails/member/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($memberdata, $emailtemplate) {
              $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
              $message->to($memberdata['email'])->subject($emailtemplate->subject);
            });
          } catch (Exception $e) {
            return Redirect::back()->with('error', 'Something went wrong in sending the email.');
          }
          // Storing data in session to show on confirmation page and auto login on after confirmatioon page
          $primary_insured_member_data = array();
          $primary_insured_member_data['lname'] = $memberdata['lname'];
          $primary_insured_member_data['fname'] = $memberdata['fname'];
          $primary_insured_member_data['email'] = $memberdata['email'];
          $primary_insured_member_data['reg_date'] = date('Y-m-d');
          $primary_insured_member_data['reg_id'] = $registration_id;
          $primary_insured_member_data['password'] = $password;
          $request->session()->put('primary_insured_member_data', $primary_insured_member_data);
          $request->session()->put('member_data', $primary_insured_member_data);
          // $response = $this->WebHookZapier();
          return Redirect::route('member.confirmation');
        }
      }
    }
    $request->session()->forget('memberdata');
    return Redirect::route('member.enroll.step2')->with('error', 'Something went wrong in Enrolled Member.');
    //$plan = $request->plan;
    // Plan Id 1 = member , 2 = family member
    /*if($plan == 1){
      $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_plan_id') ?? '';
      $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_product_id') ?? '';
    }else{
      $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_plan_id') ?? '';
      $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_product_id') ?? '';
    }
    
    if (empty($plan_ID) || empty($product_ID)) {
      return  Redirect::back()->with('error', 'Something went wrong with paypal configuration settings. Contact website administrator for help.');
    }

    $provider = PayPal::setProvider();
    $provider->getAccessToken();

    $response = $provider->addProductById($product_ID)
      ->addBillingPlanById($plan_ID)
      ->setReturnAndCancelUrl(route('member.payment.success'), route('member.payment.cancel'))
      ->setupSubscription($request->fname . ' ' . $request->lname, $request->email, Carbon::now()->addMinutes(5));

    if ($response['links']) {
      foreach ($response['links'] as $link) {
        if (strtoupper($link['rel']) == 'APPROVE') {
          return redirect($link['href']);
        }
      }
    }
    return  Redirect::back()->with('error', 'Something went wrong with paypal configuration settings. Contact website administrator for help.');
    */
    //return Redirect::route('member.payment.success');
  }

  public function Paypalpayment(Request $request){
    $plan = $request->plan;
    print_r($request->all()); die();
    $request->session()->put('memberdata', $request->all());
    $memberdata = $request->session()->get('memberdata'); 
    //print_r($memberdata); die();
    // Plan Id 1 = member , 2 = family member
    if($plan == 1){
      $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_plan_id') ?? '';
      $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_product_id') ?? '';
    }else{
      $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_plan_id') ?? '';
      $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_product_id') ?? '';
    }
    
    if (empty($plan_ID) || empty($product_ID)) {
      return  Redirect::back()->with('error', 'Something went wrong with paypal configuration settings. Contact website administrator for help.');
    }
    
    $provider = PayPal::setProvider();
    $provider->getAccessToken();
    echo "<pre>";
    
    $response = $provider->addProductById($product_ID)
      ->addBillingPlanById($plan_ID)
      ->setReturnAndCancelUrl(route('member.payment.success'), route('member.payment.cancel'))
      ->setupSubscription($request->fname . ' ' . $request->lname, $request->email, Carbon::now()->addMinutes(5));
     
    if ($response['links']) {
      foreach ($response['links'] as $link) {
        if (strtoupper($link['rel']) == 'APPROVE') {
          return redirect($link['href']);
        }
      }
    }
    //return  Redirect::route('member.dashboard')->with('error', 'Something went wrong with paypal configuration settings. Contact website administrator for help.');
  }

  public function PaymentSuccess(Request $request)
  {
    
    //$memberdata = $request->session()->get('memberdata'); 
    $provider = PayPal::setProvider();
    $provider->getAccessToken();
    $response = $provider->showSubscriptionDetails($request['subscription_id']);
    // print_r($response);
    // print_r($response['error']['message']); die();
    if (strtoupper($response['status']) == 'ACTIVE' && isset($response['subscriber']['email_address'])) {
      // Payment successful - saving data in Insured profile table
      if($response['status'] == 'ACTIVE'){ 
        $paypal_sub_id = $response['id'];
        $member = Auth::guard('member')->user();
        $MemberProfiles = Member::where('insured_profile_id', $member->insured_profile_id)->get()->toArray();
        foreach($MemberProfiles as $MemberProfile){
          $MemberProfile = Member::where('id', $MemberProfile['id'])->first();
          $MemberProfile->account_status = '1';
          $MemberProfile->save();
        }
        // Update insured_profiles 
        $InsuredProfile = InsuredProfile::find($member->insured_profile_id);
        $InsuredProfile->paypal_email = $response['subscriber']['email_address'];
        $InsuredProfile->paypal_subscription_id = $paypal_sub_id;
        $InsuredProfile->plan_id = $request['plan'];
        $InsuredProfile->save();
        if ($InsuredProfile) {
            // Storing data in payments table
            $payment = new Payment;
            $payment->payment_token = $request['token'];
            $payment->insured_profile_id = $member->insured_profile_id;
            $payment->payment_method = 'Paypal';
            $payment->amount = $response['billing_info']['last_payment']['amount']['currency_code'] ?? '';
            $payment_time = date('Y-m-d h:i:s', strtotime($response['billing_info']['last_payment']['time']));
            $payment->payment_time = $payment_time;
            $payment->payment_data = json_encode($response);
            $payment->save();
            //$request->session()->forget('memberdata');
            // Storing data in session to show on confirmation page and auto login on after confirmatioon page
            //return Redirect::route('member.dashboard')->with('success', 'Payment Sucesfull.');
            echo 'Payment successful';
        }else{
          $request->session()->forget('memberdata');
          //return Redirect::route('member.dashboard')->with('error', 'Something went wrong.');
          echo 'Something went wrong';
        }
      }else{
        $request->session()->forget('memberdata');
        //return Redirect::route('member.dashboard')->with('error', 'Something went wrong in Enrolled Member.');
        echo 'Something went wrong in Enrolled Member';
      }
    }else{
       print_r($response['error']['message']);
      }
    // if($response){
      
    // }else{
    //      print_r($response['error']['message']);
    // }
    
  }

  public function PaymentCancel(Request $request)
  {
    $request->session()->forget('memberdata');
    Session::flash('error', 'Payment cancelled by user');
    return Redirect::route('member.enroll.step2');
  }

  // Member Enrollment Confirmation step
  public function Confirmation(Request $request)
  {
    $request->session()->forget('memberdata');

    $primary_insured_member_data = $request->session()->get('primary_insured_member_data');
    if (!empty($primary_insured_member_data)) {
      return view('member.confirmation', compact('primary_insured_member_data'));
    } else {
      $request->session()->forget('primary_insured_member_data');
      return redirect('/');
    }
  }

  // After Confirmation step of member enrolment
  public function AfterConfirmation(Request $request)
  {
    $request->validate(
      [
        'checkexist' => 'required',
      ],
      [
        'checkexist.required' => 'Please select a valid option to continue.',
      ]);

    $choice = ($request->checkexist) ? $request->checkexist : '';

    if (!empty($choice)) {
      if ($choice == 1) {
        $regid = $request->session()->get('primary_insured_member_data')['reg_id'];
        $password = $request->session()->get('primary_insured_member_data')['password'];

        Auth::guard('member')->attempt(['registration_id' => $regid, 'password' => $password]);
        return Redirect::route('member.enrollfamilymember');
      } else {
        $request->session()->forget('primary_insured_member_data');
        return redirect('/');
      }
    } else {
      return redirect('/');
    }
  }


  // Member enrolling additional family member
  public function EnrollFamilyMember(Request $request)
  {
    $insured_profile_id = Auth::guard('member')->user()->insured_profile_id;
    $plan_id = InsuredProfile::where('id', $insured_profile_id)->pluck('plan_id')->first();
    if($plan_id == 0 || $plan_id == 2){
      $primary_insured_member_data = $request->session()->get('primary_insured_member_data');
      if (empty($primary_insured_member_data)) {
        $primary_insured_member_data = Auth::guard('member')->user();
      }

      if (!empty($primary_insured_member_data)) {
        return view('member.enroll_familymember');
      } else {
        return redirect('/');
      }
    }else {
      $upgrade_url = url('member/upgrade-family-plan');
      return redirect()->back()->with('upgrade_url', $upgrade_url);
    }  
  }

  public function SaveFamilyMember(Request $request)
  {
    $insured_profile_id = Auth::guard('member')->user()->insured_profile_id;
    $relationship = $request->relationship;
    $age = Carbon::parse($request->dateofbirth)->diff(Carbon::now())->y; 
    if($age >= 21 && $relationship == 2){
      return redirect()->back()->with('error','Dependant child over 21 years of age, not eligible to enroll');
    }
    
    if (empty($insured_profile_id)) {
      return redirect('/');
    } else {
      // validations
      $request->validate(
        [
          'relationship' => 'required',
          'lname' => 'required|min:3|max:255',
          'fname' => 'required|min:3|max:255',
          'gender' => 'required',
          'dateofbirth' => 'required',
        ],
        [
          'relationship.required' => 'Please select a valid relationship.',
          'lname.required' => 'Please enter Last name.',
          'fname.required' => 'Please enter First name.',
          'gender.required' => 'Please select Gender.',
          'dateofbirth.required' => 'Please select date of birth.',
        ]
      );

      // generating password to save
      $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
      $encodedpassword = Hash::make($password);

      // getting family number from primary insured row
      $family_number = Auth::guard('member')->user()->family_number;

      // generating member number
      $member_number = Member::where('family_number', $family_number)->max('member_number');
      $member_number++;

      // generating fcb registration  number to save
      $registration_id = Member::max('registration_id');
      if (is_null($registration_id)) {
        $registration_id = 'F000001';
      } else {
        $registration_id++;
      }
      // $policy_number = Member::max('policy_number');
      // if (is_null($policy_number)) {
      //   $policy_number = '20200001';
      // } else {
      //   $policy_number++;
      // }
      // saving data in member table
      $member = new Member;
      $member->insured_profile_id = $insured_profile_id;
      $member->family_number = $family_number;
      // $member->policy_number = $policy_number;
      $member->member_number = $member_number;
      $member->registration_id = $registration_id;
      $member->password = $encodedpassword;
      $member->registration_date = date('Y-m-d');
      $member->first_name = $request->fname;
      $member->last_name = $request->lname;
      $member->dob = $request->dateofbirth;
      $member->gender = $request->gender;
      $member->relationship = $request->relationship;
      $is_member_save = $member->save();
      if ($is_member_save) {
        Session::flash('success', 'Family member successfully enrolled.');
        return Redirect::route('member.dashboard');
      }
    }
  }

  // Member Family profile box
  public function Family()
  {
    $family_num =  Auth::guard('member')->user()->family_number;
    $family_members =  Member::where([
      ['family_number', $family_num],
    ])->get();

    return view('member.family', compact('family_members'));
  }

  // deleting family member
  public function DeleteFamilyMember($familymember_id)
  {
    $familymember = Member::find($familymember_id);

    if ($familymember->relationship == 0) {
      Session::flash('error', 'You can not delete primary insured account.');
    } else {
      $insured_profile_id = Auth::guard('member')->user()->insured_profile_id; 
      $plan_id = InsuredProfile::where('id',$insured_profile_id)->pluck('plan_id')->first();
      if($plan_id == 2){
        $memberdata = Member::where('insured_profile_id',$insured_profile_id)->get()->toArray(); 
        $total = (count($memberdata));
        $familymember->delete();
        Session::flash('success', 'Family member successfully deleted.');
        Session::flash('member_count', $total);
      }else{
        $familymember->delete();
        Session::flash('success', 'Family member successfully deleted.');
        
      }
      
    }

    return Redirect::route('member.dashboard');
  }

  // edit family member
  public function EditFamilyMember($familymember_id)
  {
    $member = Auth::guard('member')->user();
    $familymember = Member::find($familymember_id);
    $account_statuses = get_default_values_from_mastertable('members', 'account_status');
    $family_member_status = ($account_statuses != 0) ? $account_statuses[$familymember->account_status] : '-';
    $member_relationships = get_default_values_from_mastertable('members', 'relationship');
    $primary_insured = ($member_relationships != 0) ? array_search('Primary Insured', $member_relationships) : 0;

    // If the logged in member is not primary insured and the family_member is not the logged in member then restrict them from updating member details
    if ($member->relationship != 0 && $member->id != $familymember->id) {
      return Redirect::route('member.family')->with('error', 'You do not have access to edit member details.');
    }

    return view('member.editfamilymember', compact('member', 'familymember', 'family_member_status', 'account_statuses', 'member_relationships', 'primary_insured'));
  }

  // update family member
  public function UpdateFamilyMember(Request $request)
  {
    $member =  Member::find(Auth::guard('member')->user()->id);
    $relationship = $request->relationship;
    $age = Carbon::parse($request->dob)->diff(Carbon::now())->y; 
    if($age >= 21 && $relationship == 2){
      return redirect()->back()->with('error','Dependant child over 21 years of age, not eligible to enroll');
    }
    $familymember = Member::find($request->family_member_id);
    $member_relationships = get_default_values_from_mastertable('members', 'relationship');
    $primary_insured = ($member_relationships != 0) ? array_search('Primary Insured', $member_relationships) : 0;

    // If the logged in member is not primary insured and the family_member is not the logged in member then restrict them from updating member details
    if ($member->relationship != $primary_insured && $member->id != $familymember->id) {
      return Redirect::route('member.family')->with('error', "You do not have access to edit this member's details.");
    }

    // validations
    if ($member->relationship == $primary_insured && $familymember->relationship != $primary_insured) {
      $request->validate(
        [
          'lname' => 'required|min:3|max:255',
          'fname' => 'required|min:3|max:255',
          'gender' => 'required',
          'dob' => 'required',
          'relationship' => 'required',
          // 'account_status' => 'required',
        ],
        [
          'relationship.required' => 'Please select a valid relationship.',
          'lname.required' => 'Please enter Last name.',
          'fname.required' => 'Please enter First name.',
          'gender.required' => 'Please select Gender.',
          'dob.required' => 'Please select date of birth.',
          // 'account_status.required' => 'Please select Account status.',
        ]
      );
    } else {
      $request->validate(
        [
          'lname' => 'required|min:3|max:255',
          'fname' => 'required|min:3|max:255',
          'gender' => 'required',
          'dob' => 'required',
          'relationship' => 'required',
        ],
        [
          'relationship.required' => 'Please select a valid relationship.',
          'lname.required' => 'Please enter Last name.',
          'fname.required' => 'Please enter First name.',
          'gender.required' => 'Please select Gender.',
          'dob.required' => 'Please select date of birth.',
        ]
      );
    }

    $familymember->first_name = $request->fname;
    $familymember->last_name = $request->lname;
    $familymember->dob = $request->dob;
    $familymember->gender = $request->gender;
    
    // Primary Insured member can not change their relationship and dependents can not be primary insured members
    if ($familymember->relationship != $primary_insured && $request->relationship != $primary_insured) {
      $familymember->relationship = $request->relationship;
    }

    // Only Active Primary Insured members can change the status of their dependents
    if ($member->relationship == $primary_insured && $familymember->relationship != $primary_insured && $member->isActive()) {
      $familymember->account_status = $request->account_status;
    }
    
    $familymember->save();

    Session::flash('success', 'Details updated succesfully.');
    return Redirect::route('member.dashboard');
  }

  public function Contact()
  {
    $insured_profile_id = Auth::guard('member')->user()->insured_profile_id;
    $contactdetails = InsuredProfile::find($insured_profile_id);
    return view('member.contact', compact('contactdetails'));
  }

  public function EditContact()
  {
    $insured_profile_id = Auth::guard('member')->user()->insured_profile_id;
    $contactdetails = InsuredProfile::find($insured_profile_id);
    return view('member.editcontact', compact('contactdetails'));
  }

  public function UpdateContact(Request $request)
  {
    // validations
    $request->validate(
      [
        'lname' => 'required|min:3|max:255',
        'fname' => 'required|min:3|max:255',
        'latitude' => 'required',
        'longitude' => 'required',
        'address1' => 'required|min:3|max:255',
        'city' => 'required',
        'province' => 'required',
        'postalcode' => 'required|regex:/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/',
      ],
      [
        'lname.required' => 'Please enter Last name.',
        'fname.required' => 'Please enter First name.',
        'latitude.required' => 'Please select valid location.',
        'longitude.required' => 'Please select valid location.',
        'address1.required' => 'Please select Address.',
        'city.required' => 'Please enter city name.',
        'province.required' => 'Please enter Province.',
        'postalcode.required' => 'Please enter Postal Code.',
        'postalcode.regex' => 'Please enter valid Postal Code.',
        'telephone.required' => 'Please enter Telephone.',
        'telephone.regex' => 'Please enter valid Telephone.',
      ]
    );

    $insured_profile_id = Auth::guard('member')->user()->insured_profile_id;
    $primary_insured_details2 = InsuredProfile::find($insured_profile_id);
    if ($request->telephone != $primary_insured_details2->telephone) {
      $request->validate([
        'telephone' => 'required|unique:insured_profiles,telephone|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',
      ]);
      $primary_insured_details2->telephone = $request->telephone;
    }
    if ($request->email != $primary_insured_details2->email) {
      $request->validate([
        'email' => 'required|unique:insured_profiles',
      ]);
      $primary_insured_details2->email = $request->email;
    }


    // updating data in member table
    $primary_insured_details1 = Member::find(Auth::guard('member')->user()->id);
    $primary_insured_details1->first_name = $request->fname;
    $primary_insured_details1->last_name = $request->lname;
    $primary_insured_details1->save();

    // updating data in primary insured table
    $primary_insured_details2->latitude = $request->latitude;
    $primary_insured_details2->longitude = $request->longitude;
    $primary_insured_details2->address1 = $request->address1;
    $primary_insured_details2->city = $request->city;
    $primary_insured_details2->postal_code = $request->postalcode;
    $primary_insured_details2->province = $request->province;
    $primary_insured_details2->telephone = $request->telephone;
    $primary_insured_details2->email = $request->email;

    $primary_insured_details2->save();
    Session::flash('success', 'Contact Details successfully updated.');
    return Redirect::route('member.contact');
  }

  public function Enrolled_Step2()
  {
    if (Auth::guard('member')->check()) {
      return Redirect::route('member.dashboard');
    }

    return view('member.enrolled_step2');
  }

  public function Enrolled_CheckStep2(Request $request)
  {
    if (empty($request->fcbid) && empty($request->member_number) && empty($request->group_policy_number)) {
      Session::flash('error', 'Please enter FCB Registration Number or Member Number.');
      return Redirect::back();
    }

    if (empty($request->fcbid)) {
      // validations
      $request->validate(
        [
          'group_policy_number' => 'required|min:8|max:8',
          'member_number' => 'required|min:11|max:11',
        ],
        [
          'group_policy_number.required' => 'Please enter Group Ploicy Number.',
          'member_number.required' => 'Please enter Member Number.',
        ]);
      $member = Member::where([['member_number', $request->member_number], ['policy_number', $request->group_policy_number]])->first();
    } else {
      // validations
      $request->validate(
        [
          'fcbid' => 'required|min:7|max:7',
        ],
        [
          'fcbid.required' => 'Please enter FCB Registration Number.',
        ]);
      $member = Member::where('registration_id', $request->fcbid)->first();
    }

    if ($member) {
      $family_num =  $member->family_number;
      $family_members =  Member::where([
        ['family_number', $family_num],
      ])->get();
      $isprimaryinsured = (substr($member->member_number, 9) == '00') ? true : false;
      $primaryinsurred_fcbid = Member::where('member_number', $family_num . '00')->first();
      $primaryinsurred_fcbid = $primaryinsurred_fcbid->registration_id;
      $insured_profile_id = $member->insured_profile_id;
      $plan_id = InsuredProfile::where('id', $insured_profile_id)->pluck('plan_id')->first();
      return view('member.enrolled-family', compact('family_members', 'isprimaryinsured', 'primaryinsurred_fcbid','plan_id'));
    } else {
      return Redirect::back()->with('error', 'Please enter valid FCB Registration Number or valid Member no.');
    }
  }

  public function Enrolled_CheckLogin(Request $request)
  {
    $is_authenticated = Auth::guard('member')->attempt(array('registration_id' => $request->primaryinsurred_fcbid, 'password' => $request->password));
    return ($is_authenticated);
  }


  public function Login()
  {
    return view('member.login');
  }

  public function CheckLogin(Request $request)
  {
    $request->validate(
      [
        'fcbid' => 'required|min:7|max:255',
        'password' => 'required|min:6|max:255',
      ],
      [
        'fcbid.required' => 'Please enter FCB Registration Number.',
        'password.required' => 'Please enter Password.',
      ]
    );
    $remember_me = ($request->remember_me) ? true : false;

    $is_authenticated = Auth::guard('member')->attempt(array('registration_id' => $request->fcbid, 'password' => $request->password), $remember_me);
    if ($is_authenticated) {
      return Redirect::route('member.dashboard');
    } else {
      return Redirect::back()->with('error', 'Incorrect FCB Registration Number or password.');
    }
  }

  public function logout()
  {
    Auth::guard('member')->logout();
    return Redirect::route('member.login');
  }


  public function dashboard()
  {
    $member = Auth::guard('member')->user();
    $member_postal_code = InsuredProfile::find($member->insured_profile_id)->postal_code;
    $provider_offices = ProviderOffice::where('postal_code', $member_postal_code)->get();
    $family_num =  Auth::guard('member')->user()->family_number;
    $family_members =  Member::where([
      ['family_number', $family_num],
    ])->get();
    $insuredProfile = InsuredProfile::find($member->insured_profile_id);
    
    return view('member.dashboard', compact('member', 'provider_offices', 'member_postal_code','family_members','insuredProfile'));
  }

  public function FindProviders(Request $request)
  {
    $provider_offices = ProviderOffice::whereNotNull('latitude')
      ->whereNotNull('longitude')
      ->where('latitude', '!=', '')
      ->where('longitude', '!=', '')
      ->get();
    return response()->json($provider_offices);
  }

  public function ChangePassword()
  {
    return view('member.changepassword');
  }

  public function UpdatePassword(Request $request)
  {
    $request->validate(
      [
        'current_password' => 'required|min:6|max:255',
        'new_password' => 'required|min:6|max:255|regex:/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
        'confirm_password' => 'required|min:6|max:255|same:new_password',
      ],
      [
        'current_password.required' => 'Please enter Current Password.',
        'new_password.required' => 'Please enter New Password.',
        'new_password.regex' => 'New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
        'confirm_password.required' => 'Please enter  Confirm Password.',
        'confirm_password.same' => 'New Password and Confirm Password must be same.',
      ]
    );

    $primaryinsured = Member::find(Auth::guard('member')->user()->id);
    if (Hash::check($request->current_password, $primaryinsured->password)) {
      $primaryinsured->password = Hash::make($request->new_password);
      $primaryinsured->save();
      Auth::guard('member')->logout();
      return Redirect::route('member.login')->with('success', 'Password changed successfully. Please login with new password.');
    } else {
      return Redirect::back()->with('error', 'Current password is incorrect.');
    }
  }

  public function UpdatePasswordAlert()
  {
    $InsuredProfile =  InsuredProfile::find(Auth::guard('member')->user()->insured_profile_id);
    $InsuredProfile->password_change_alert = 1;
    $InsuredProfile->save();
  }

  public function ShowForgotPassword()
  {
    return view('member.forgotpassword');
  }

  public function SubmitForgotPassword(Request $request)
  {
    // validations
    $request->validate(
      [
        'fcbid' => 'required|min:7|max:7|exists:members,registration_id',
      ],
      [
        'fcbid.required' => 'Please enter FCB Registration Number.',
        'fcbid.exists' => 'Entered FCB Registration Number is not present in database.',
      ]);

    $member =  Member::where('registration_id', $request->fcbid)->first();
    $isprimaryinsured = (substr($member->member_number, 9) == '00') ? true : false;

    if (!$isprimaryinsured) {
      return back()->withInput()->with('error', 'Please enter FCB Registration Number of Primary Insured member.');
    }

    $primaryinsured = InsuredProfile::find($member->insured_profile_id);
    $token = Str::random(64);

    DB::table('password_resets')->insert([
      'email' => $primaryinsured->email,
      'token' => $token,
      'created_at' => Carbon::now()
    ]);

    // Sending mail to member containing token and link to reset password
    $send_data_in_mail = array('fname' => $member->first_name, 'lname' => $member->last_name, 'token' => $token, 'fcbid' => $request->fcbid);
    $emailtemplate =  $this->FindTemplate('member-forgot-password');

    try {
      Mail::send('emails/member/forgot-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($primaryinsured, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($primaryinsured->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in sending the email.');
    }

    return back()->with('success', 'We have e-mailed your password reset link on registered email id.');
  }

  public function ShowResetPassword($token, $fcbid)
  {
    return view('member.showresetpassword', compact('token', 'fcbid'));
  }

  public function SubmitResetPassword(Request $request)
  {
    $request->validate(
      [
        'new_password' => 'required|min:6|max:255|regex:/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
        'confirm_password' => 'required|min:6|max:255|same:new_password',
      ],
      [
        'new_password.required' => 'Please enter New Password.',
        'new_password.regex' => 'New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
        'confirm_password.required' => 'Please enter Confirm Password.',
        'confirm_password.same' => 'New Password and Confirm Password must be same.',
      ]);

    $member =  Member::where('registration_id', $request->fcbid)->first();
    $isprimaryinsured = (substr($member->member_number, 9) == '00') ? true : false;
    if (!$isprimaryinsured) {
      return back()->withInput()->with('error', 'FCB Registration Number is not of a Primary Insured member.');
    }
    $primaryinsured = InsuredProfile::find($member->insured_profile_id);


    $is_valid_token = DB::table('password_resets')->where(['email' => $primaryinsured->email, 'token' => $request->unique_token])->first();
    if (!$is_valid_token) {
      return back()->withInput()->with('error', 'Invalid token!');
    }

    $member->password = Hash::make($request->new_password);
    $member->save();

    DB::table('password_resets')->where(['email' => $primaryinsured->email])->delete();

    // updating password_change_alert so that change password alert will not be shown to user(if user is doing first time login after change password)
    if ($primaryinsured->password_change_alert == 0) {
      $primaryinsured->password_change_alert = 1;
      $primaryinsured->save();
    }

    return Redirect::route('member.login')->with('success', 'Your password has been changed!');
  }

  public function deactivate_member_subscription($subscription_id, $reason)
  {
    $provider = PayPal::setProvider();
    $provider->getAccessToken();
    $provider->suspendSubscription($subscription_id, $reason);
  }

  public function activate_member_subscription($subscription_id, $reason)
  {
    $provider = PayPal::setProvider();
    $provider->getAccessToken();
    $provider->activateSubscription($subscription_id, $reason);
  }

  // Verify that the member paid for the annual membership subscription in PayPal
  public function verify_member_subscription_payment(Carbon $date)
  {
    $member_relationships = get_default_values_from_mastertable('members', 'relationship');
    $primary_insured = 0;

    if ($member_relationships != 0) {
      $primary_insured = array_search('Primary Insured', $member_relationships);
    }

    // TODO Remove later - added for test data
    $date = Carbon::today()->setDay(17);

    // Get all members that registered on same day and month as $date
    $members = Member::whereDay('registration_date', $date->day)
      ->whereMonth('registration_date', $date->month)
      // ->whereYear('registration_date', '<', $date->year)
      ->where('relationship', $primary_insured)
      ->get();

    foreach ($members as $member) {
      if ($member->isActive()) {
        $insured_profile = $member->insured_profile()->first();
        $subscription_id = $insured_profile->paypal_subscription_id;

        $provider = PayPal::setProvider();
        $provider->getAccessToken();
        // $response = $provider->listSubscriptionTransactions($subscription_id, $date->copy()->subYear(1)->addDay(1)->toDateString(), $date->copy()->addDay(1)->toDateString());
        $response = $provider->listSubscriptionTransactions($subscription_id, $date->copy()->addDay(1)->toDateString(), $date->copy()->addDay(2)->toDateString());
        Log::debug($response['transactions']);

        if(count($response['transactions']) < 1) {
          $member->setInactive();
          $this->deactivate_member_subscription($member->paypal_subscription_id, 'Subscription deactivated as member payment failed');
          $this->send_status_inactive_email_to_primary_member($member);
        } else {
          Log::debug("Member subscription paid!");
        }
      }
    }
  }

  // Send Invoices to members for the claims submitted by the provider
  public function process_member_claims(Carbon $date)
  {
    $paypal_details = [
      'currency' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_currency_member_enrollment') ?? 'CAD',
      'email' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_email') ?? '',
      'address_1' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_address_1') ?? '',
      'address_2' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_address_2') ?? '',
      'city' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_city') ?? '',
      'state' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_state') ?? '',
      'postal_code' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_postal_code') ?? '',
      'country' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_country') ?? '',
    ];

    // Get the id for primary insured
    $member_relationships = get_default_values_from_mastertable('members', 'relationship');
    $primary_insured = 0;

    if ($member_relationships != 0) {
      $primary_insured = array_search('Primary Insured', $member_relationships);
    }

    // Get all claims submited on the date queried
    $claims = ProviderClaim::where('processed_date', $date->toDateString())->get();

    foreach ($claims as $claim) {
      // Get the primary insured member paying for the claim
      $claim_member = $claim->member()->first();
      $first_9_digits_member_no = substr($claim_member->member_number, 0, 9);
      $primary_insured_member = Member::where('member_number', 'LIKE', $first_9_digits_member_no . '%')
        ->where('relationship', $primary_insured)
        ->first();

      // PayPal provider
      $provider = PayPal::setProvider();
      $provider->getAccessToken();
      $provider->setCurrency($paypal_details['currency']);
      $status = $this->create_and_send_paypal_invoice($date, $primary_insured_member, $provider, $claim, $paypal_details);

      if ($status) {
        Log::debug('Invoice send for claim #' . $claim->id);
      } else {
        Log::debug('Claim send failed. Setting member and dependents to Inactive.');
        $primary_insured_member->setInactive();
        $this->deactivate_member_subscription($primary_insured_member->paypal_subscription_id, 'Subscription deactivated as member claims failed');
      }

      // TODO Stop after one iteration - For testing only
      return;
    }
  }

  // Create and send PayPal Invoice
  public function create_and_send_paypal_invoice($date, $primary_insured_member, $provider, $claim, $paypal_details)
  {
    // Get the insured profile details of the primary insured member
    $insured_profile = $primary_insured_member->insured_profile()->first();

    // Return if insured profile paypal email is empty
    if (empty($insured_profile->paypal_email)) {
      return false;
    }

    $invoice_no = $provider->generateInvoiceNumber();
    $invoice_number = $invoice_no["invoice_number"];

    $data = [
      "detail" => [
        "invoice_number" => $invoice_number,
        "reference" => "deal-ref",
        "invoice_date" => $date->toDateString(),
        "currency_code" => $paypal_details['currency'],
        "note" => "Thank you for your business.",
        "term" => "No refunds after 30 days.",
        "memo" => "This is a long contract",
        "payment_term" => [
          "term_type" => "NET_10",
          "due_date" => $date->copy()->addDays(10)->toDateString()
        ]
      ],
      "invoicer" => [
        "name" => [
          "given_name" => "First Canadian Benefits",
          "surname" => ""
        ],
        "address" => [
          "address_line_1" => $paypal_details['address_1'],
          "address_line_2" => $paypal_details['address_2'],
          "admin_area_2" => $paypal_details['city'],
          "admin_area_1" => $paypal_details['state'],
          "postal_code" => $paypal_details['postal_code'],
          "country_code" => $paypal_details['country']
        ],
        "email_address" => $paypal_details['email'],
        "phones" => [
          [
            "country_code" => "001",
            "national_number" => "4085551234",
            "phone_type" => "MOBILE"
          ]
        ],
        "website" => "www.test.com",
        "tax_id" => "ABcNkWSfb5ICTt73nD3QON1fnnpgNKBy- Jb5SeuGj185MNNw6g",
        "logo_url" => "https://example.com/logo.PNG",
        "additional_notes" => "2-4"
      ],
      "primary_recipients" => [
        [
          "billing_info" => [
            "name" => [
              "given_name" => $primary_insured_member->first_name,
              "surname" => $primary_insured_member->last_name
            ],
            "address" => [
              "address_line_1" => $insured_profile->address1,
              "address_line_2" => $insured_profile->address2,
              "admin_area_2" => $insured_profile->city,
              "admin_area_1" => $insured_profile->province,
              "postal_code" => $insured_profile->postal_code,
              "country_code" => 'CA'
            ],
            "email_address" => $insured_profile->paypal_email,
            "phones" => [
              [
                "country_code" => "001",
                "national_number" => "4884551234",
                "phone_type" => "HOME"
              ]
            ],
            "additional_info_value" => "add-info"
          ],
          "shipping_info" => [
            "name" => [
              "given_name" => $primary_insured_member->first_name,
              "surname" => $primary_insured_member->last_name
            ],
            "address" => [
              "address_line_1" => $insured_profile->address1,
              "address_line_2" => $insured_profile->address2,
              "admin_area_2" => $insured_profile->city,
              "admin_area_1" => $insured_profile->province,
              "postal_code" => $insured_profile->postal_code,
              "country_code" => 'CA'
            ]
          ]
        ]
      ],
      "items" => [
        [
          "name" => "Claim",
          "description" => "Claim submitted by provider on " . $date->toDateString(),
          "quantity" => "1",
          "unit_amount" => [
            "currency_code" => $paypal_details['currency'],
            "value" => $claim->patient_pays_amount
          ],
          "tax" => [
            "name" => "Sales Tax",
            "percent" => "0"
          ],
          "discount" => [
            "percent" => "0"
          ],
          "unit_of_measure" => "QUANTITY"
        ],
      ],
      "configuration" => [
        "partial_payment" => [
          "allow_partial_payment" => false,
        ],
        "allow_tip" => false,
        "tax_calculated_after_discount" => true,
        "tax_inclusive" => false,
      ],
      "amount" => [
        "breakdown" => [
          "custom" => [
            "label" => "Packing Charges",
            "amount" => [
              "currency_code" => $paypal_details['currency'],
              "value" => "0"
            ]
          ],
          "shipping" => [
            "amount" => [
              "currency_code" => $paypal_details['currency'],
              "value" => "0"
            ],
            "tax" => [
              "name" => "Sales Tax",
              "percent" => "0"
            ]
          ],
          "discount" => [
            "invoice_discount" => [
              "percent" => "0"
            ]
          ]
        ]
      ]
    ];

    $invoice = $provider->createInvoice($data);

    // Return if there is error creating draft invoice
    if (isset($invoice['type']) && $invoice['type'] == 'error') {
      return false;
    }

    $invoice_search = $provider->addInvoiceFilterByInvoiceNumber($invoice_number)->searchInvoices();

    // Return if no invoice exist with invoice_number
    if (isset($invoice_search['total_items']) && $invoice_search['total_items'] == 0) {
      return false;
    }

    // Return if invoice is not a draft or if id doesn't exist
    if (isset($invoice_search['items'][0]['status']) && strtoupper($invoice_search['items'][0]['status']) != 'DRAFT' && isset($invoice_search['items'][0]['id'])) {
      return false;
    }

    $invoice_no = $invoice_search['items'][0]['id'];
    $subject = "Reminder: Payment due for the invoice";
    $note = "Please pay before the due date to avoid incurring late payment charges which will be adjusted in the next bill generated.";
    $provider->sendInvoice($invoice_no, $subject, $note);
    return true;
  }

  public function send_status_inactive_email_to_primary_member($primary_member)
  {
    $member_relationships = get_default_values_from_mastertable('members', 'relationship');
    $primary_insured = ($member_relationships != 0) ? array_search('Primary Insured', $member_relationships) : 0;

    // return if the member is not primary insured member
    if ($primary_member->relationship != $primary_insured) {
      return;
    }

    $primaryinsured = $primary_member->insured_profile()->first();
    $html = '<ul>';

    // Get all the family members of the primary member
    $first_9_digits_member_no = substr($primary_member->member_number, 0, 9);
    $dependent_members = Member::where('member_number', 'LIKE', $first_9_digits_member_no . '%')
      ->get();

    foreach ($dependent_members as $member) {
      $html .= '<li>' . $member->first_name . ' ' . $member->last_name . '</li>';
    }

    $html .= '</ul>';

    $send_data_in_mail = [
      'first_name' => $primary_member->first_name,
      'last_name' => $primary_member->last_name,
      'app' => env('APP_NAME'),
      'link' => route('member.login'),
      'content' => $html,
    ];
    $emailtemplate =  $this->FindTemplate('member-status-inactive');

    try {
      Mail::send('emails/member/template', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($primaryinsured, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($primaryinsured->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in sending the email.');
    }
  }

  public function send_status_active_email_to_primary_member($primary_member)
  {
    $member_relationships = get_default_values_from_mastertable('members', 'relationship');
    $primary_insured = ($member_relationships != 0) ? array_search('Primary Insured', $member_relationships) : 0;

    // return if the member is not primary insured member
    if ($primary_member->relationship != $primary_insured) {
      return;
    }
    
    $primaryinsured = $primary_member->insured_profile()->first();
    $html = '<ul>';

    // Get all the family members of the primary member
    $first_9_digits_member_no = substr($primary_member->member_number, 0, 9);
    $dependent_members = Member::where('member_number', 'LIKE', $first_9_digits_member_no . '%')
      ->get();

    foreach ($dependent_members as $member) {
      $status = $member->isActive() ? 'Active' : 'Inactive';
      $html .= '<li>' . $member->first_name . ' ' . $member->last_name . ' - ' . $status . '</li>';
    }

    $html .= '</ul>';

    $send_data_in_mail = [
      'first_name' => $primary_member->first_name,
      'last_name' => $primary_member->last_name,
      'app' => env('APP_NAME'),
      'link' => route('member.login'),
      'content' => $html,
    ];
    $emailtemplate =  $this->FindTemplate('member-status-active');

    try {
      Mail::send('emails/member/template', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($primaryinsured, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($primaryinsured->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in sending the email.');
    }
  }
  public function paypalplancheck($plan_ID,$paypal_subscription_id){
    $provider = PayPal::setProvider();
    $provider->getAccessToken();
    $response1 = $provider->setReturnAndCancelUrl(route('member.payment.success'), route('member.payment.cancel'))
      ->showSubscriptionDetails($paypal_subscription_id);
    //echo "<pre>";
    //echo $plan_ID;
    $show_plan_id = $response1['plan_id'];
    //print_r($response1); 
    if($plan_ID == $show_plan_id){
      return TRUE;
    }else{
      return FALSE;
    }
    
  }

  public function PaypalpaymentUpgrade(Request $request){
    $success_url = route('member.dashboard'); 
    $paypal_mode = Get_Meta_Tag_Value('Payment_Settings', 'paypal_mode') ?? ''; 
    if($paypal_mode == 'live'){
      $paypal_url = 'https://api-m.paypal.com/';
    }else{
      $paypal_url = 'https://api-m.sandbox.paypal.com';
    }
    $insured_profile_id = Auth::guard('member')->user()->insured_profile_id;
    $plan_data = InsuredProfile::where('id', $insured_profile_id)->first();
    $total_member = Member::where('insured_profile_id', $insured_profile_id)->get()->toArray();
    $total_member = count($total_member);
    $plan = $plan_data->plan_id;
    $paypal_subscription_id = $plan_data->paypal_subscription_id;
    // Plan Id 1 = member , 2 = family member
    if($total_member > 1){
      return  Redirect::route('member.dashboard')->with('error', 'if You want Downgrade to single coverage Please delete All Member');
    }
    if($plan == 2){
      $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_plan_id') ?? '';
      $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_product_id') ?? '';
      $amount = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_amount') ?? '';
    }elseif($plan == 1){
      $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_plan_id') ?? '';
      $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_product_id') ?? '';
      $amount = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_amount') ?? '';
    }
    if (empty($plan_ID) || empty($product_ID)) {
      return  Redirect::back()->with('error', 'Something went wrong with paypal configuration settings. Contact website administrator for help.');
    }
    
    $current_sub_status = $this->paypalplancheck($plan_ID,$paypal_subscription_id);
    
    if($current_sub_status == TRUE){
      $MemberProfile = InsuredProfile::where('paypal_subscription_id', $paypal_subscription_id)->first();
      $MemberProfile->plan_id = 2;
      $MemberProfile->upgrade_plan = NULL;
      $MemberProfile->save();
      $error = "Plan Upgraded!";
      return Redirect::route('member.dashboard')->with('success', $error);
    }else{
      $provider = PayPal::setProvider();
      $access = $provider->getAccessToken();
      $accesstoken = $access['access_token'];
      $token_type = $access['token_type'];
      $paypal_mode = Get_Meta_Tag_Value('Payment_Settings', 'paypal_mode') ?? '';
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-m.paypal.com/v1/billing/subscriptions/'.$paypal_subscription_id.'/revise',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "plan_id": "'.$plan_ID.'",

          "return_url": "'.$success_url.'",
          "cancel_url": "'.$success_url.'"
        }

      
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Authorization: '.$token_type.' '.$accesstoken
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $response = json_decode($response);
      //echo "<pre>";
      //print_r($response); 
    
      //die(); 
      //print_r($response->links); die();
      // $provider = PayPal::setProvider();
      // $provider->getAccessToken();
      // $data = array('plan_id' => $plan_ID);
      // $response = $provider->setReturnAndCancelUrl(route('member.payment.success'), route('member.payment.cancel'))
      //   ->reviseSubscription($paypal_subscription_id, $data);
      if(!empty($response->links)) {
        foreach($response->links as $link) {
          if (strtoupper($link->rel) == 'APPROVE') {
            $MemberProfile = InsuredProfile::where('paypal_subscription_id', $paypal_subscription_id)->first();
            $MemberProfile->upgrade_plan = $plan_ID;
            $MemberProfile->save();
            return redirect($link->href);
          }
          else{   
            $current_sub_status = $this->paypalplancheck($plan_ID,$paypal_subscription_id);
            if($current_sub_status == TRUE){
              $MemberProfile = InsuredProfile::where('paypal_subscription_id', $paypal_subscription_id)->first();
              $MemberProfile->plan_id = 2;
              $MemberProfile->upgrade_plan = NULL;
              $MemberProfile->save();
              $error = "Plan Upgraded!";
              return Redirect::route('member.dashboard')->with('success', $error); 
            }else{
              $error = "You are new subscriber or Something went wrong with paypal account. Contact website administrator for help. ";
              return Redirect::route('member.dashboard')->with('error', $error);
            }         
          }
        }
      }elseif($response->error){
        $error = $response->error;
        return Redirect::route('member.dashboard')->with('error', $error);
      }
      else{
        return Redirect::route('member.dashboard')->with('error', 'Something went wrong with paypal configuration settings. Contact website administrator for help.');
      }
    }  
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

  public function viewClaims(Request $request){
    $member = Member::find(Auth::guard('member')->user()->id);
    $claims = ProviderClaim::where('member_id', $member->id)->get()->toArray(); 
    return view('member.claims.view-claims', ['total_billing_amount' => '', 'claims' => $claims]);         
  }

  public function Checkmember(Request $request){
    $fcb_id = $request->fcb_id;
    $validator = \Validator::make($request->all(), [
      'fcb_id' => 'required|min:7|max:7',
    ]);
    if($validator->fails()){
      return response()->json(['errors'=>$validator->errors()->all()]);
    }else{
      $member_data = Member::where(['registration_id' => $fcb_id])->get()->toArray();
      if ($member_data) {
        $member =  Member::where('registration_id', $request->fcb_id)->first();
        $isprimaryinsured = (substr($member->member_number, 9) == '00') ? true : false;
        if (!$isprimaryinsured) {
          return response()->json(['errors'=>'FCB registration not found, please correct or call FCB support.']);
        }
        else{
          return response()->json(['success'=>'FCB Registration Number Found.']);
        }
      }
      else{
        return response()->json(['errors'=>'FCB registration not found, please correct or call FCB support.']);
      }
    }
  }
  
// Fetch Member based on FCB Registration Number in login page for forgot password
  public function Getmember(Request $request){
    $fcb_id = $request->fcb_id;
    $telephone = $request->telephone;
    $postal_code = $request->postal_code;
    $member_data = Member::where(['registration_id' => $fcb_id])->get()->toArray();
    foreach($member_data as $data){
      $insured_id = $data['insured_profile_id'];
      $first_name = $data['first_name'];
      $last_name = $data['last_name'];
    }
    if($insured_id){
      $insured_data = InsuredProfile::where(['id' => $insured_id,'telephone' => $telephone,'postal_code' => $postal_code])->get()->toArray();
      if($insured_data){
        foreach($insured_data as $data){
          $address1 = $data['address1'];
          $city = $data['city'];
          $postal_code = $data['postal_code'];
          $province = $data['province'];
          $telephone  = $data['telephone'];
          $email  = $data['email'];
        }
        $memberdata = array(
          'fcb_id' => $fcb_id,
          'first_name' => $first_name,
          'last_name' => $last_name,
          'address1' => $address1,
          'city' => $city,
          'postal_code' => $postal_code,
          'province' => $province,
          'telephone' => $telephone,
          'email' => $email,
        );
        return $memberdata;
      }
      else{
        echo "not found";
      }
    }
  }

  public function Resetpassword(Request $request)
  {
    $request->validate(
      [
        'new_password' => 'required|min:6|max:255|regex:/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
      ],
      [
        'new_password.required' => 'Please enter New Password.',
        'new_password.regex' => 'New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
      ]);

    $member =  Member::where('registration_id', $request->fcb_id)->first();

    $isprimaryinsured = (substr($member->member_number, 9) == '00') ? true : false;
    if (!$isprimaryinsured) {
      return back()->withInput()->with('error', 'FCB Registration Number is not of a Primary Insured member.');
    }
    $primaryinsured = InsuredProfile::find($member->insured_profile_id);
    $useremail = $primaryinsured->email;
    $member->password = Hash::make($request->new_password);
    $member->save();

    // updating password_change_alert so that change password alert will not be shown to user(if user is doing first time login after change password)
    if ($primaryinsured->password_change_alert == 0) {
      $primaryinsured->password_change_alert = 1;
      $primaryinsured->save();
    }
    // Sending mail to member containing token and link to reset password
    $send_data_in_mail = array('new_password' => $request->new_password);
    $emailtemplate =  $this->FindTemplate('resetmemberpassword');
    try {
      // Send mail to user
      Mail::send('emails/provider/otp', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($primaryinsured, $useremail, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($useremail)->subject($emailtemplate->subject);
      });
      return Redirect::route('member.login')->with('success', 'Your password has been changed!');
    }catch (Exception $e) {
      return Redirect::route('member.login')->with('error', 'Something went wrong in sending the email.');
    }
    return Redirect::route('member.login')->with('success', 'Your password has been changed!');
  }
// get distance made by ekcs
  public function GetDistance1(Request $request){
    $key = Get_Meta_Tag_Value('General_Settings','Google_Maps_API_Key');
    $lat = $request->lat;
    $lng = $request->lng;
    $start = 0; 
    $rowperpage = 3;
    $end = $request->end;
    if(isset($_GET['start'])){
      $start = $request->start;
    }  
    if(isset($_GET['rowperpage'])){
      $rowperpage = $request->rowperpage;
    }  
    $provider_offices = ProviderOffice::whereNotNull('latitude')
      ->whereNotNull('longitude')
      ->where('latitude', '!=', '')
      ->where('longitude', '!=', '')
      ->offset($start)
      ->limit($start)
      ->limit($rowperpage)
      ->get();
      // echo "<pre>";
      // print_r($provider_offices); die();
      $items = array();
      foreach($provider_offices as $data){
        $latitude = $data->latitude;
        $longitude = $data->longitude; 
        $clinic_name = $data->clinic_name;
        $storeid = $data->id;
        
        $destination = rawurlencode($latitude.' '.$longitude);
        $origin = rawurlencode($lat.' '.$lng);
        //$origin = rawurlencode('43.6460227 -79.9342668');
        $curl = curl_init();
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$destination&origins=$origin&key=$key";
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        $destination_addresses = $data->destination_addresses['0'];
        $distance = $data->rows['0']->elements['0']->distance->text;
        $dis_value = $data->rows['0']->elements['0']->distance->value;
        if($dis_value <= 100000){
          $items[] = array(
            'storeid' => $storeid,
            'clinic_name' => $clinic_name,
            'address' => $destination_addresses,
            'distance' => $distance
          );
        }
      }
      $all_data = count($items);
      if($all_data >= 1){
        $data = array('success' => $items);
      }else{
        $data = array('false' => 'No Record Found');
      }
      return response()->json($data);
      //print_r($items);    
  }

  public function GetDistance(Request $request){
    $key = Get_Meta_Tag_Value('General_Settings','Google_Maps_API_Key');
    $lat = $request->lat;
    $lng = $request->lng;
    $provider_type = $request->provider_type;
    // $lat = "43.6418481";
    // $lng = "-79.3815635";
    $providers = ProviderOffice::whereNotNull('latitude')
      ->whereNotNull('longitude')
      ->where('latitude', '!=', '')
      ->where('longitude', '!=', '')
      ->count();
     
    $providers1 = Provider::where('assigning_authority_number', '=', $provider_type)
      ->get()->toArray();
    $provider2 = []; 
    foreach($providers1 as $userr){
      $id = $userr['id'];
      $itemsss = array_push($provider2,$id);
     
    }
     
    $count_all = round($providers/25);
    $offset1 = 0;
    $start = 0; 
    $rowperpage = 25;
    $end = $request->end;
    $n = 25;
    $data_api = array();
    for($m=0; $m < $count_all; $m++){
      $provider_offices = ProviderOffice::whereNotNull('latitude')
      ->whereNotNull('longitude')
      ->where('latitude', '!=', '')
      ->where('longitude', '!=', '')
      ->offset($offset1)
      ->limit($start)
      ->limit($rowperpage)
      ->get();
      
      
      $offset1 = $offset1 + $n;
      //echo "<br>";
      //sleep(1);
    //}  
    
    
    //die();
    // if(isset($_GET['start'])){
    //   $start = $request->start;
    // }  
    // if(isset($_GET['rowperpage'])){
    //   $rowperpage = $request->rowperpage;
    // }  
    // $provider_offices = ProviderOffice::whereNotNull('latitude')
    //   ->whereNotNull('longitude')
    //   ->where('latitude', '!=', '')
    //   ->where('longitude', '!=', '')
    //   ->offset($start)
    //   ->limit($start)
    //   ->limit($rowperpage)
    //   ->get();
      //echo "<pre>";
      //print_r($provider_offices); die();
      $items = array();
      //$i = 0;
      $destination = '';
      foreach($provider_offices as $data){
        $address = $data->address1;
        $latitude = $data->latitude;
        $longitude = $data->longitude;
        $clinic_name = $data->clinic_name;
        $storeid = $data->id;
        $destination .= rawurlencode($latitude.','.$longitude.'|');
      }
      //echo $destination;
      //die();
        $origin = rawurlencode($lat.' '.$lng);
        $curl = curl_init();
        $url_new = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=$key";
        //$url = "https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$destination&origins=$origin&key=$key";
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url_new,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $res_data = json_decode($response);
        // echo "<pre>\n";
        // print_r( $res_data); die();
        
        if($res_data->status="OK"){
          $i = 0;
        $all = $res_data->rows['0']->elements;
        // echo "<pre>";
        // print_r($all['0']);die();
        foreach($all as $data){
          if($res_data->rows['0']->elements[$i]->status == "OK"){
            $destination_addresses = $provider_offices[$i]->address1;         
            $clinic_name = $provider_offices[$i]->clinic_name;
            $storeid = $provider_offices[$i]->id;            
            $distance = $res_data->rows['0']->elements[$i]->distance->text; 
            $dis_value = $res_data->rows['0']->elements[$i]->distance->value;
            if($dis_value <= 25000){
              if(in_array($storeid,$provider2)){
                $items[] = array(
                  'storeid' => $storeid,
                  'clinic_name' => $clinic_name,
                  'address' => $destination_addresses,
                  'distance' => $distance,
                  'dis' => $dis_value
                );
              }
            }
          }
          $i++;
        }
        
        $data_api[] = $items;
        }
    //     die();
        
        //$da = array_merge($items,$data_api);
    //   //print_r($items);
    //   //die();
      
     
    //   //print_r($items);   
    //   //print_r($data_api); //die();
   }
    // $all_data = count($items);
    // if($all_data >= 1){
    //   $data_api[] = array('success' => $items);
    // }else{
    //   $data_api = array('false' => 'No Record Found');
    // }
    // echo "<pre>";
    // print_r($data_api);
    return response()->json($data_api);
  }

  // public function WebHookZapier(Request $request) {
  
  //   $response = Http::post('https://hooks.zapier.com/hooks/catch/14403144/bvpc74u/', [
  //     'name' => 'Steve',
  //     'email' => 'Network Administrator',
  //   ]);
  // }


}