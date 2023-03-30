<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayorProfile;
use App\Models\Payor;
use App\Models\PayorInvoice;
use App\Models\Member;
use App\Models\InsuredProfile;
use Illuminate\Support\Facades\Hash;
use Stripe;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\EmailTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Srmklive\PayPal\Facades\PayPal;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportPayorMember;


class PayorController extends Controller
{
  use EmailTrait;

  public function Login()
  {
    return view('payor.login');
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
    // print_r($request->fcbid);
    // die();
    $is_authenticated = Auth::guard('payor')->attempt(array('registration_id' => $request->fcbid, 'password' => $request->password), $remember_me);
    if ($is_authenticated) {
      return Redirect::route('payor.dashboard');
    } else {
      return Redirect::back()->with('error', 'Incorrect FCB Registration Number or Password.');
    }
  }

  public function logout()
  {
    Auth::guard('payor')->logout();
    return Redirect::route('payor.login');
  }


  public function dashboard()
  {
    
    $payor = Auth::guard('payor')->user();
    $PayorProfile = Payor::find($payor->id);
    // $AllPayorMember = Member::where('payor_number', $payor->id)->get();
    $AllPayorMember = Member::where([['payor_number', '=', $payor->id],['account_status' , '=', '1']])->get();
    $total_claim = 0;
    $plan_pays_amount = 0;
    foreach($AllPayorMember as $member){
      $member_id = $member->id;
      $claim = DB::table('claim')->where(['member_id' => $member_id])->get();
      foreach($claim as $claims){
       
         $plan_pays_amts = DB::table('claim_line')->where([['claim_id', '=', $claims->id],['status' , '=', '2']])->get();
        foreach($plan_pays_amts as $val){
          $plan_pays_amt = $val->plan_pays_amount;
         
          if($plan_pays_amt != null){
            $plan_pays_amount += $plan_pays_amt;
            $plan_pays_amount;
            
          }
        }
        
        $claim_lines = DB::table('claim_line')->where([['claim_id', '=', $claims->id],['status' , '=', '2']])->get();
        if($claim_lines != null){
          $total_claim += count($claim_lines);
        }
      }
    }
    
    return view('payor.dashboard', compact('payor','PayorProfile','total_claim','plan_pays_amount'));
  }


  public function ChangePassword()
  {
    return view('payor.changepassword');
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

  

  public function ResetPayorpassword(Request $request)
  {
    $request->validate(
      [
        'new_password' => 'required|min:6|max:255|regex:/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
      ],
      [
        'new_password.required' => 'Please enter New Password.',
        'new_password.regex' => 'New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
      ]);

    $primaryinsured =  Payor::where('registration_id', $request->fcb_id)->first();
    $useremail = $primaryinsured->contact_email;
    $primaryinsured->password = Hash::make($request->new_password);
    $primaryinsured->save();

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
      return Redirect::route('payor.login')->with('success', 'Your password has been changed!');
    }catch (Exception $e) {
      return Redirect::route('payor.login')->with('error', 'Something went wrong in sending the email.');
    }
    return Redirect::route('payor.login')->with('success', 'Your password has been changed!');
  }
  
  public function Checkpayor(Request $request){
    $fcb_id = $request->fcb_id;
    $validator = \Validator::make($request->all(), [
      'fcb_id' => 'required|min:7|max:7',
    ]);
    if($validator->fails()){
      return response()->json(['errors'=>$validator->errors()->all()]);
    }else{
      $Payor_data = Payor::where(['registration_id' => $fcb_id])->get()->toArray();
      if ($Payor_data) {
        $Payor =  Payor::where('registration_id', $request->fcb_id)->first();
        if (!$Payor) {
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

  public function Getpayor(Request $request){
    $fcb_id = $request->fcb_id;
    $telephone = $request->telephone;
    $email = $request->email;
    $Payor_data = Payor::where(['registration_id' => $fcb_id,'contact_telephone' => $telephone,'contact_email' => $email])->get()->toArray();
      if($Payor_data){
        foreach($Payor_data as $data){
          $first_name = $data['contact_first_name'];
          $last_name = $data['contact_last_name'];
          $address1 = $data['address1'];
          $city = $data['city'];
          $postal_code = $data['postal_code'];
          $province = $data['province'];
          $telephone  = $data['contact_telephone'];
          $contact_email  = $data['contact_email'];
        }
        $Payordata = array(
          'fcb_id' => $fcb_id,
          'first_name' => $first_name,
          'last_name' => $last_name,
          'address1' => $address1,
          'city' => $city,
          'postal_code' => $postal_code,
          'province' => $province,
          'telephone' => $telephone,
          'email' => $contact_email,
        );
        return $Payordata;
      }
      else{
        echo "not found";
      }
    }

    public function AllInvoice(){
      $payor = Auth::guard('payor')->user();
      $PayorAllInvoices = PayorInvoice::where(['payor_system_id' => $payor->payor_system_id])->get();
      return view('payor.invoicelist', compact('payor','PayorAllInvoices'));
    }
    public function ViewInvoice($invoiceId){
      $payor = Auth::guard('payor')->user();
      $PayorInvoiceDetails = PayorInvoice::where(['id' => $invoiceId])->get();
      // foreach($PayorInvoiceDetails as $InvoiceDetails){
      //   $payor_system_id = $InvoiceDetails->payor_system_id;
      // }
      //echo "<pre>";
      //print_r($PayorInvoiceDetails); die();
      return view('payor.invoicedetails', compact('payor','PayorInvoiceDetails'));
    }

    public function MemberEligibility(){
      
      $payor = Auth::guard('payor')->user();
      $payormember = Member::where([['policy_number', '=', $payor->policy_number],['payor_number', '=', $payor->id]])->get();
      //print_r($payormember); die();
      if(count($payormember)){
        foreach($payormember as $data){
          $plan_id = InsuredProfile::where(['id' => $data->insured_profile_id ])->pluck('plan_id')->first();
          
          $coverage = get_default_values_from_mastertable('insured_profiles','plan_id')[$plan_id];
          $gender = ($data->gender == 0) ? 'Male' : 'Female';
          $rel = get_default_values_from_mastertable('members','relationship')[$data->relationship];
          $account_statuses = get_default_values_from_mastertable('members', 'account_status')[$data->account_status];
          
          $payormembers[] = array(
            'status' => 1,
            'message' => 'Record Found',
            'id' => $data->member_number,
            'insured_profile_id' => $data->insured_profile_id,
            'family_number' => $data->family_number,
            'member_id' => $data->member_number,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'dob' => $data->dob,
            'gender' => $gender,
            'relationship' => $rel,
            'account_status' => $account_statuses,
            'coverage' => $coverage,
            'payor_number' => $data->payor_number
          ); 
        }
       
      }
      else{
       
        $payormembers[] = array('status' => '0', 'message' => 'No Record Found');
      }
      
      return view('payor.member_eligibility',compact('payor','payormembers'));
    }

    public function GetMemberEligibility(Request $request){
      $payor = Auth::guard('payor')->user();
      $member_number = $request->member_id;
      //$member_number = '10000003400';
      $member_number_length = strlen($member_number);
      $payor_policy_number = $payor->policy_number;
      if($member_number_length == 11){
        
        $first_9_digits_member_no = substr($member_number, 0, 9);
        $primary_insured_member = Member::where([['member_number', 'LIKE', $first_9_digits_member_no . '%'],['policy_number', '=', $payor_policy_number]])->get();
        
      }else{
       
       $primary_insured_member = Member::where([['family_number', '=', $member_number],['policy_number', '=', $payor_policy_number]])->get();
       
      }     
      
          if(count($primary_insured_member)){
            
            
            foreach($primary_insured_member as $data){
              $plan_id = InsuredProfile::where(['id' => $data->insured_profile_id ])->pluck('plan_id')->first();
              
              $coverage = get_default_values_from_mastertable('insured_profiles','plan_id')[$plan_id];
              $gender = ($data->gender == 0) ? 'Male' : 'Female';
              $rel = get_default_values_from_mastertable('members','relationship')[$data->relationship];
              $account_statuses = get_default_values_from_mastertable('members', 'account_status')[$data->account_status];
              
            $items[] = array(
                'id' => $data->id,
                'insured_profile_id' => $data->insured_profile_id,
                'family_number' => $data->family_number,
                'member_id' => $data->member_number,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'dob' => $data->dob,
                'gender' => $gender,
                'relationship' => $rel,
                'account_status' => $account_statuses,
                'coverage' => $coverage,
                'payor_number' => $data->payor_number
              ); 
              
            }
          }
          else{
            $items[] = array('status' => '0', 'message' => 'No Record Found');
            $request->session()->put('search_member_id', $member_number);
        }
      /*}  
      else{
        $items[] = array('status' => '0', 'message' => 'Member Number Invalid');
      } */ 
      $request->session()->put('member_id_by_data', $items);
      //$memberdata = $request->session()->get('member_id_by_data');
      //$request->session()->forget('member_id_by_data');
      return json_encode($items);
    }

    public function AddDependent(Request $request){
      $member_payor_data = $request->session()->get('member_id_by_data');
      $payor = Auth::guard('payor')->user();
      return view('payor.enroll-family-member',compact('payor','member_payor_data'));
    }

    public function ViewFamilyMember(Request $request){
      $member_payor_data = $request->session()->get('member_id_by_data');
      $payor = Auth::guard('payor')->user();
      return view('payor.update-family-member',compact('payor','member_payor_data'));
    }

    public function EditFamilyMember($familymember_id){
      $member = Member::find($familymember_id);
      
      $familymember = Member::find($familymember_id);
      $account_statuses = get_default_values_from_mastertable('members', 'account_status');
      $family_member_status = ($account_statuses != 0) ? $account_statuses[$familymember->account_status] : '-';
      $member_relationships = get_default_values_from_mastertable('members', 'relationship');
      $primary_insured = ($member_relationships != 0) ? array_search('Primary Insured', $member_relationships) : 0;
      
      // If the logged in member is not primary insured and the family_member is not the logged in member then restrict them from updating member details
      if ($member->relationship != 0 && $member->id != $familymember->id) {
        return Redirect::route('payor.membereligibility')->with('error', 'You do not have access to edit member details.');
      }

      return view('payor.edit-family-member', compact('member', 'familymember', 'family_member_status', 'account_statuses', 'member_relationships', 'primary_insured'));
    }

    public function UpdateFamilyMember(Request $request)
    {
      
      $member =  Member::find($request->family_member_id);
      $relationship = $request->relationship;
      $age = Carbon::parse($request->dob)->diff(Carbon::now())->y;
      if($age >= 21 && $relationship == 2){
        return redirect()->back()->with('error','Dependant child over 21 years of age, not eligible to enroll');
      }
      $familymember = Member::find($request->family_member_id);
      $member_relationships = get_default_values_from_mastertable('members', 'relationship');
      $primary_insured = ($member_relationships != 0) ? array_search('Primary Member', $member_relationships) : 0;
      
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
            'account_status' => 'required',
          ],
          [
            'relationship.required' => 'Please select a valid relationship.',
            'lname.required' => 'Please enter Last name.',
            'fname.required' => 'Please enter First name.',
            'gender.required' => 'Please select Gender.',
            'dob.required' => 'Please select date of birth.',
            'account_status.required' => 'Please select Account status.',
          ]
        );
      } else {
        $request->validate(
          [
            'lname' => 'required|min:2|max:255',
            'fname' => 'required|min:2|max:255',
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
      $familymember->account_status = $request->account_status;
      // Primary Insured member can not change their relationship and dependents can not be primary insured members
      if ($familymember->relationship != $primary_insured && $request->relationship != $primary_insured) {
        $familymember->relationship = $request->relationship;
      }
  
      // Only Active Primary Insured members can change the status of their dependents
      //if ($member->relationship == $primary_insured && $familymember->relationship != $primary_insured && $member->isActive()) {
      // $familymember->account_status = $request->account_status;
      //}
      
      $familymember->save();

      $payor = Auth::guard('payor')->user();
      $family_number = $member->family_number;
      $payor_policy_number = $payor->policy_number;
      $primary_insured_member = Member::where([['family_number', '=', $family_number],['policy_number', '=', $payor_policy_number],['account_status', '=', 1]])->get();
      $total_member = count($primary_insured_member);
      if($total_member <= 1){
        $insured_profile_id = $familymember->insured_profile_id;
        $InsuredProfile = InsuredProfile::find($insured_profile_id);
        $InsuredProfile->plan_id = '1';
        $InsuredProfile->save();
      }else{
        $insured_profile_id = $familymember->insured_profile_id;
        $InsuredProfile = InsuredProfile::find($insured_profile_id);
        $InsuredProfile->plan_id = '2';
        $InsuredProfile->save();
      }
      Session::flash('success', 'Details updated succesfully.');
      return Redirect::route('payor.membereligibility');
    }
  

    public function SaveFamilyMember(Request $request){
      $payor = Auth::guard('payor')->user();
      $member_payor_data = $request->session()->get('member_id_by_data');
      //echo "<pre>";
      //print_r($member_payor_data); die();
      $insured_profile_id = $member_payor_data['0']['insured_profile_id']; 
      $payor_number = $member_payor_data['0']['payor_number'];
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
            'lname' => 'required|min:2|max:255',
            'fname' => 'required|min:2|max:255',
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
        $family_number = $member_payor_data['0']['family_number'];
        
        // generating member number
        $policy_number = Member::where('policy_number',$payor->policy_number)->get()->first();
        if($policy_number){
          $member_number = Member::where([['family_number', '=', $family_number],['policy_number', '=', $payor->policy_number]])->max('member_number');
          $member_number++;
        }else{
          $member_number = '10000000100';
        }
        
        // generating fcb registration  number to save
        $registration_id = Member::max('registration_id');
        if (is_null($registration_id)) {
          $registration_id = 'F000001';
        } else {
          $registration_id++;
        }
        
        // saving data in member table
        $member = new Member;
        $member->insured_profile_id = $insured_profile_id;
        $member->family_number = $family_number;
        $member->policy_number = $payor->policy_number;
        $member->member_number = $member_number;
        $member->registration_id = $registration_id;
        $member->password = $encodedpassword;
        $member->registration_date = date('Y-m-d');
        $member->registration_method = 'payor';
        $member->first_name = $request->fname;
        $member->last_name = $request->lname;
        $member->dob = $request->dateofbirth;
        $member->gender = $request->gender;
        $member->relationship = $request->relationship;
        $member->payor_number = $payor_number;
        $is_member_save = $member->save();
        if ($is_member_save) {
          $primary_insured_details = InsuredProfile::find($insured_profile_id);
          $primary_insured_details->plan_id = '2';
          $primary_insured_details->save();
          Session::flash('success', 'Family member successfully enrolled.');
          return Redirect::route('payor.membereligibility');
        }
      }
    }

  public function Add_Member(Request $request){
    $payor = Auth::guard('payor')->user();
    return view('payor.enroll-member',compact('payor'));
  }

    // Member Enrollment step2
  public function Store_Member(Request $request)
  {
    $search_member_id = $request->session()->get('search_member_id');
    $payor = Auth::guard('payor')->user();
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
        'gender.required' => 'Please select your Gender.',
        'dateofbirth.required' => 'Please select your date of birth.',
      ]
    );
   
    // check if email already exist
    $is_email_exist = InsuredProfile::where('email', '=', $request->email)
    ->orWhere('telephone', '=', $request->telephone)
    ->first();
    
    if ($is_email_exist) {
      return Redirect::back()->with('error', 'Account already exist, please use your FCB registration Id to
      login');
    }
    
    $request->session()->put('memberdata', $payor);
    $memberdata = $request->session()->get('memberdata');
    //$request->session()->forget('memberdata');
    
    if($memberdata){ 
      $contact_telephone = $memberdata['contact_telephone'];
      $contact_email = $memberdata['contact_email'];

      $con_tele = InsuredProfile::where('telephone', $contact_telephone)->pluck('telephone')->first();
      if($con_tele){
        $contact_telephone = rand();
      }
      $con_email = InsuredProfile::where('email', $contact_email)->pluck('telephone')->first();
      if($con_email){
        $contact_email = rand(10000,99999);
        $contact_email = 'fcb'.$contact_email.'@gmail.com';
      }
      
      $family_number = Member::where('policy_number', $payor->policy_number)->max('family_number');
      $InsuredProfile = new InsuredProfile;
      $InsuredProfile->payor_id = $payor->id;
      $InsuredProfile->address1 = $memberdata['address1'];
      $InsuredProfile->address2 = ($memberdata['address2']) ? $memberdata['address2'] : '';
      $InsuredProfile->city = $memberdata['city'];
      $InsuredProfile->postal_code = $memberdata['postal_code'];
      $InsuredProfile->province = $memberdata['province'];
      $InsuredProfile->telephone = $contact_telephone;
      $InsuredProfile->email = $contact_email;
      $InsuredProfile->paypal_email = '';
      $InsuredProfile->paypal_subscription_id = '';
      $InsuredProfile->latitude = $memberdata['latitude'];
      $InsuredProfile->longitude = $memberdata['longitude'];
      $InsuredProfile->plan_id = '1';
      $is_ins_save = $InsuredProfile->save();

      if ($is_ins_save) {
        // generating data for member table - password
        $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
        $encodedpassword = Hash::make($password);

        // generating family number to save (we geneeratet this only in primary insured case)
        $policy_number = Member::where('policy_number',$payor->policy_number)->get()->first();
        if(($policy_number)){
          if(!empty($search_member_id)){
            $family_number = $search_member_id;
          }else{
            $family_number = Member::where('policy_number', $payor->policy_number)->max('family_number');
            $family_number++;
          }  
        }else{
          if(!empty($search_member_id)){
            $family_number = $search_member_id;
          }else{
            $family_number = '100000001';
          }
        }

        // generating fcb registration number to save
        $registration_id = Member::max('registration_id');
        if (is_null($registration_id)) {
          $registration_id = 'F000001';
        } else {
          $registration_id++;
        }

        $policy_number = Member::max('policy_number');
        if (is_null($policy_number)) {
          $policy_number = '20200001';
        } else {
          $policy_number++;
        }
        // echo $policy_number; die();
        // saving data in member table
        $member = new Member;
        $member->insured_profile_id = $InsuredProfile->id;
        $member->member_number = $family_number . '00';     //primary insured member no. = family_no + 00
        $member->family_number = $family_number;
        $member->policy_number = $payor->policy_number;
        $member->registration_id = $registration_id;
        $member->password = $encodedpassword;
        $member->registration_date = date('Y-m-d');
        $member->first_name = $request->fname;
        $member->last_name = $request->lname;
        $member->dob = $request->dateofbirth;
        $member->gender = $request->gender;
        $member->payor_number = $payor->id;
        $member->relationship = 0;
        $member->registration_method = 'payor';
        $is_member_save = $member->save();

        if ($is_member_save) {
          // Sending mail to user containing password and FCB Registration Number to login
          /*$send_data_in_mail = array('fname' => $memberdata['fname'], 'lname' => $memberdata['lname'], 'password' => $password, 'fcbid' => $registration_id);
          $emailtemplate =  $this->FindTemplate('member-enrollment-password');

          try {
            // Send mail to user
            Mail::send('emails/member/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($memberdata, $emailtemplate) {
              $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
              $message->to($memberdata['email'])->subject($emailtemplate->subject);
            });
          } catch (Exception $e) {
            //return Redirect::back()->with('error', 'Something went wrong in sending the email.');
            $email_error = 'Something went wrong in sending the email.';
          }
          // Storing data in session to show on confirmation page and auto login on after confirmatioon page
          $primary_insured_member_data = array();
          $primary_insured_member_data['lname'] = $memberdata['lname'];
          $primary_insured_member_data['fname'] = $memberdata['fname'];
          $primary_insured_member_data['reg_date'] = date('Y-m-d');
          $primary_insured_member_data['reg_id'] = $registration_id;
          $primary_insured_member_data['password'] = $password;
          $primary_insured_member_data['error'] = $email_error;
          $request->session()->put('primary_insured_member_data', $primary_insured_member_data);*/
          Session::flash('success', 'Member successfully enrolled.');
          return Redirect::route('payor.membereligibility')->with('success', 'Member Enrolled Successfully.');
        }
      }
    }
    $request->session()->forget('memberdata');
    return Redirect::route('payor.addmember')->with('error', 'Something went wrong in Enrolled Member.');
    
  }

  public function Confirmation(Request $request){
    $request->session()->forget('memberdata');
    $payor = Auth::guard('payor')->user();
    $primary_insured_member_data = $request->session()->get('primary_insured_member_data');
    if (!empty($primary_insured_member_data)) {
      return view('payor.confirmation', compact('primary_insured_member_data','payor'));
    } else {
      $request->session()->forget('primary_insured_member_data');
      return redirect('/');
    }
  }

  public function InvoicesGenerate(){
    $current_d = date('Y-m-d');
    $latest_invoice_run_date = PayorInvoice::latest()->pluck('invoice_run_date')->first(); 
    $latest_invoice_run_date = substr($latest_invoice_run_date, 0 ,10);
    if($current_d != $latest_invoice_run_date){
      
      $first_day_prev_month = date('Y-m-01', strtotime('-1 month'));
      $last_day_prev_month = date('Y-m-t', strtotime('-1 month'));
      $current_date = date('Y-m-d H:i:s');
      $payors = Payor::all();
      foreach($payors as $payorval){
        $payor_id = $payorval->id;
        $single_insured_count = 0;
        $family_insured_count = 0;
        $single_insured = InsuredProfile::where([['payor_id', '=', $payor_id ],['plan_id', '=', '1' ]])->get();
        //echo count($single_insured); die();
        foreach($single_insured as $val){
          $insured_id = $val->id;
          $payor_number = $val->payor_id;
          $single_insured = Member::where([['insured_profile_id', '=', $insured_id ],['payor_number', '=', $payor_number ],['account_status', '=', '1']])->get();
          $single_insured_count += count($single_insured);
        }
        
        $family_insured = InsuredProfile::where([['payor_id', '=', $payor_id ],['plan_id', '=', '2' ]])->get();
        foreach($family_insured as $val){
          $insured_id = $val->id;
          $payor_number = $val->payor_id;
          $family_member = Member::where([['insured_profile_id', '=', $insured_id ],['payor_number', '=', $payor_number ],['account_status', '=', '1']])->get();
          $family_insured_count += count($family_member);
        
        }
        
        /* Claim Count */
        // $AllPayorMember = Member::where('payor_number', $payor_id)->get();
    
        $AllPayorMember = Member::where([['payor_number', '=', $payor_id],['account_status' , '=', '1']])->get();
        $total_claim = 0;
        $plan_pays_amount = 0;
        foreach($AllPayorMember as $member){
          $member_id = $member->id;
          $claim = DB::table('claim')->where(['member_id' => $member_id])->get();
          foreach($claim as $claims){
            $plan_pays_amts = DB::table('claim_line')->whereBetween('service_date', [$first_day_prev_month, $last_day_prev_month])->where([['claim_id', '=', $claims->id],['status' , '=', '2']])->get();
            foreach($plan_pays_amts as $val){
              $plan_pays_amt = $val->plan_pays_amount;
            
              if($plan_pays_amt != null){
                $plan_pays_amount += $plan_pays_amt;
                $plan_pays_amount;
                
              }
            }
            $claim_lines = DB::table('claim_line')->whereBetween('service_date', [$first_day_prev_month, $last_day_prev_month])->where([['claim_id', '=', $claims->id],['status' , '=', '2']])->get();
            if($claim_lines != null){
              $total_claim += count($claim_lines);
            }
          }
        }
      
        /* Claim Count End */

        $claim_fee = $plan_pays_amount * $payorval->percentage_rate; 
        $invoice_total_gross_amount = $single_insured_count * $payorval->insured_signal_pre_rate + $family_insured_count * $payorval->insured_family_pre_rate + $claim_fee;
        $invoice_total_tax_amount = $payorval->tax_rate + $invoice_total_gross_amount;
        $invoice_number = PayorInvoice::max('invoice_number');
        if (is_null($invoice_number)) {
            $invoice_number = '10001';
          }else{
            $invoice_number++;
        }
        $invoice = new PayorInvoice;
        $invoice->payor_system_id  = $payor_id;
        $invoice->invoice_run_date  = $current_date;
        $invoice->invoice_number  = $invoice_number;
        $invoice->invoice_period_start  = $first_day_prev_month;
        $invoice->invoice_period_end  = $last_day_prev_month;
        $invoice->single_insured_count  = $single_insured_count;
        $invoice->family_insured_count  = $family_insured_count;
        $invoice->claim_count  = $total_claim;
        $invoice->claim_RBP_amount  = $plan_pays_amount;
        $invoice->insured_single_pre_rate  = $payorval->insured_signal_pre_rate;
        $invoice->insured_family_pre_rate  = $payorval->insured_family_pre_rate;
        $invoice->percentage_rate  = $payorval->percentage_rate;
        $invoice->single_insured_fee  = $single_insured_count * $payorval->insured_signal_pre_rate;
        $invoice->family_insured_fee  = $family_insured_count * $payorval->insured_family_pre_rate;
        $invoice->claim_fee  = $claim_fee;
        $invoice->tax_rate  = $payorval->invoice_rate;
        $invoice->invoice_total_gross_amount  = $invoice_total_gross_amount;
        $invoice->invoice_total_tax_amount  = $invoice_total_tax_amount;
        $invoice->invoice_total_net_amount  = $invoice_total_tax_amount;
        $invoice->invoice_status  = 'Outstanding';
        $is_invoice_save = $invoice->save();
        //$single_insured_count = 0;
        //$family_insured_count = 0;
      }
    }else{
      echo "already Exists";
    }  
  }

  public function Downloadmember(Request $request){
    $payor = Auth::guard('payor')->user();
      $payormember = Member::where([['policy_number', '=', $payor->policy_number],['payor_number', '=', $payor->id]])->get();
      if(count($payormember)){
        foreach($payormember as $data){
          $plan_id = InsuredProfile::where(['id' => $data->insured_profile_id ])->pluck('plan_id')->first();
          
          $coverage = get_default_values_from_mastertable('insured_profiles','plan_id')[$plan_id];
          $gender = ($data->gender == 0) ? 'Male' : 'Female';
          $rel = get_default_values_from_mastertable('members','relationship')[$data->relationship];
          $account_statuses = get_default_values_from_mastertable('members', 'account_status')[$data->account_status];
          
          $payormembers[] = array(
            'id' => $data->member_number,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'dob' => $data->dob,
            'gender' => $gender,
            'relationship' => $rel,
            'account_status' => $account_statuses,
            'coverage' => $coverage,
          ); 
        }
        return Excel::download(new ExportPayorMember($payormembers), 'member.xlsx');
      }else{
        
        Session::flash('success', 'No Member Id Found.');
        return Redirect::route('payor.membereligibility');
      }
    
  }

}
