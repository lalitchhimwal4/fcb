<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use App\Models\Provider\Provider;
use App\Models\Provider\ProviderOffice;
use App\Models\Provider\ProviderOfficeEnrollment;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\EmailTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProviderController extends Controller
{
  use EmailTrait;

  // Provider Enrollment step1
  public function Enroll_Step1()
  {
    return view('provider.enroll_step1');
  }

  // Provider Enrollment step2
  public function Enroll_Step2(Request $request)
  
  {
    // print_r(strlen($request->license_number));die();
    if (empty($request->selected_provider_type)) {
      return Redirect::back()->with('error', 'Please select provider type');
    }

    //dental fields validation start
    if ($request->selected_provider_type == "1") {
      $request->validate(
        [
          'dental_speciality' => 'required|numeric',
          'license_number' => 'required|numeric|digits_between:8,9|regex:/^\S*$/u',
          'office_location_number' => 'required',
        ],
        [
          'dental_speciality.required' => 'Please select a dental speciality',
          'license_number.required' => 'Please enter valid license number',
          'license_number.digits_between' => 'License Number length must be 8 or 9 numbers as assigned by CDA',
          'license_number.numeric' => 'License Number length must be 8 or 9 numbers as assigned by CDA',
          'office_location_number.required' => 'Please enter valid office location number',
          'office_location_number.numeric' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_location_number.min' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_location_number.max' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_location_number.digits_between' => 'Office location Number length must be 4 numbers as assigned by CDA',
        ]
      );
      // dental fields validations complete

      $provider =   Provider::where('license_number', $request->license_number)->first();
      if ($provider) {
        //check if  provider is same as selected provider type or not  
        if ($provider->assigning_authority_number != $request->selected_provider_type) {
          return Redirect::back()->with('error', 'A provider already exists with this license number.Please try with other license number');
        }
      }
      $office = ProviderOffice::where('location_number', $request->office_location_number)->get();

      //=======Cases for provider type dental start===============//
      if ($provider && $office->count() > 0) {
        //when provider and dental office both exist ie. case 1
        return Redirect::route('provider.provider_exist.office_exist', ['license_num' => $request->license_number, 'location_num' => $request->office_location_number]);
      } elseif ($provider && $office->count() < 1) {
        //Provider exists but office does not exist i.e. Case 2
        return Redirect::route('provider.provider_exist.office_notexist', ['license_num' => $request->license_number, 'location_num' => $request->office_location_number]);
      } elseif (!$provider && $office->count() < 1) {
        //Provider not exists and office also does not exist i.e. Case 3
        $fname = ($request->first_name) ? $request->first_name : '';
        $lname = ($request->last_name) ? $request->last_name : '';
        return Redirect::route('provider.provider_notexist.office_notexist', ['provider_type' => $request->selected_provider_type, 'license_num' => $request->license_number, 'location_num' => $request->office_location_number, 'postal_code' => 'NULL', 'fname' => $fname, 'lname' => $lname, 'dental_speciality' => $request->dental_speciality]);
      } else {
        //Provider not exists but office exist i.e. Case 4
        $fname = ($request->first_name) ? $request->first_name : '';
        $lname = ($request->last_name) ? $request->last_name : '';
        return Redirect::route('provider.provider_notexist.office_exist', ['provider_type' => $request->selected_provider_type, 'license_num' => $request->license_number, 'location_num' => $request->office_location_number, 'postal_code' => 'NULL', 'fname' => $fname, 'lname' => $lname, 'dental_speciality' => $request->dental_speciality]);
      }
      //=======Cases for provider type dental end===============//

    } else {

      //health fields validation start
      $request->validate(
        [
          'license_number' => 'required',
          'postal_code' => 'required|regex:/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/',
        ],
        [
          'license_number.required' => 'Please enter valid license number',
          'postal_code.required' => 'Please enter a valid Postal Code',
          'postal_code.regex' => 'Please enter a valid Postal Code',
        ]
      );
      // health fields validations complete

      //cases for health provider start 
      $provider = Provider::where('license_number', $request->license_number)->first();
      if ($provider) {
        if ($provider->assigning_authority_number != $request->selected_provider_type) {
          //check if  provider is same as selected provider type or not 
          return Redirect::back()->with('error', 'A provider already exists with this license number.PLease try with other license number');
        }
      }
      $postal_code = ProviderOffice::where([['postal_code', $request->postal_code], ['location_number', '>=', 10000]])->get();

      if ($provider && $postal_code->count() > 0) {
        //Provider exists and postal_code also exist i.e. Case 1
        return Redirect::route('provider.provider_exist.office_exist', ['license_num' => $request->license_number, 'location_num' => 'NULL', 'postal_code' => $request->postal_code]);
      } elseif ($provider && $postal_code->count() < 1) {
        //Provider exists but postal_code does not exist i.e. Case 2
        return Redirect::route('provider.provider_exist.office_notexist', ['license_num' => $request->license_number, 'location_num' => 'NULL', 'postal_code' => $request->postal_code]);
      } elseif (!$provider && $postal_code->count() < 1) {
        //Provider not exists and postal_code also does not exist i.e. Case 3
        $fname = ($request->first_name) ? $request->first_name : '';
        $lname = ($request->last_name) ? $request->last_name : '';
        return Redirect::route('provider.provider_notexist.office_notexist', ['provider_type' => $request->selected_provider_type, 'license_num' => $request->license_number, 'location_num' => 'NULL', 'postal_code' => $request->postal_code, 'fname' => $fname, 'lname' => $lname]);
      } else {
        //Provider not exists but postal_code exist i.e. Case 4
        $fname = ($request->first_name) ? $request->first_name : '';
        $lname = ($request->last_name) ? $request->last_name : '';
        return Redirect::route('provider.provider_notexist.office_exist', ['provider_type' => $request->selected_provider_type, 'license_num' => $request->license_number, 'location_num' => 'NULL', 'postal_code' => $request->postal_code, 'fname' => $fname, 'lname' => $lname]);
      }

      //cases for health provider complete 
    }
  }

  /*============provider search function start==========*/
  public function Case_Search(Request $request)
  {
    if ($request->provider_type == 1) {
      $response =  $this->Dental_Provider_CaseSearch($request);
    } else {
      $response =  $this->Health_Provider_CaseSearch($request);
    }
    return $response;
  }
  /*============provider search function end==========*/

  //=================Dental provider case  search function start====================================//
  public function Dental_Provider_CaseSearch(Request $request)
  {
    $response = array();

    $provider = Provider::where('license_number', $request->license_number)->first();
    if ($provider) {
      if ($provider->assigning_authority_number != $request->provider_type) {
        //check if  provider is same as selected provider type or not
        $response['error'] = "A provider already exists with this license number.PLease try with other license number";
        return $response;
      }
    }
    $office = ProviderOffice::where('location_number', $request->office_location_number)->get();

    if ($provider && $office->count() > 0) {
      //Provider exists and office also exist i.e. Case 1
      $response['provider_type'] = $provider->assigning_authority_number;
      $response['case'] = 1;
      $response['license_number'] = $request->license_number;
      $response['location_number'] = $request->office_location_number;
    } elseif ($provider && $office->count() < 1) {
      //Provider exists but office does not exist i.e. Case 2
      $response['provider_type'] = $provider->assigning_authority_number;
      $response['case'] = 2;
      $response['license_number'] = $request->license_number;
      $response['provider_fname'] = $provider->first_name;
      $response['provider_lname'] = $provider->last_name;
    } elseif (!$provider && $office->count() < 1) {
      //Provider not exists and office also does not exist i.e. Case 3
      $response['provider_type'] = $request->provider_type;
      $response['case'] = 3;
      $response['license_number'] = $request->license_number;
    } else {
      //Provider not exists but office exist i.e. Case 4
      $response['provider_type'] = $request->provider_type;
      $response['case'] = 4;
      $response['license_number'] = $request->license_number;
    }

    return $response;
  }
  //=================Dental provider case  search function complete====================================// 


  //=================Health provider case  search function start====================================//
  public function Health_Provider_CaseSearch(Request $request)
  {
    $response = array();
    $provider =   Provider::where('license_number', $request->license_number)->first();
    if ($provider) {
      if ($provider->assigning_authority_number != $request->provider_type) {
        //check if  provider is same as selected provider type or not
        $response['error'] = "A provider already exists with this license number.PLease try with other license number";
        return $response;
      }
    }
    $postal_code = ProviderOffice::where([['postal_code', $request->postal_code], ['location_number', '>=', 10000]])->get();

    if ($provider && $postal_code->count() > 0) {
      //Provider exists and postal_code also exist i.e. Case 1
      $response['provider_type'] = $provider->assigning_authority_number;
      $response['case'] = 1;
      $response['license_number'] = $request->license_number;
      $response['postal_code'] = $request->postal_code;
    } elseif ($provider && $postal_code->count() < 1) {
      //Provider exists but postal_code does not exist i.e. Case 2
      $response['provider_type'] = $provider->assigning_authority_number;
      $response['case'] = 2;
      $response['license_number'] = $request->license_number;
      $response['provider_fname'] = $provider->first_name;
      $response['provider_lname'] = $provider->last_name;
    } elseif (!$provider && $postal_code->count() < 1) {
      //Provider not exists and postal_code also does not exist i.e. Case 3
      $response['provider_type'] = $request->provider_type;
      $response['case'] = 3;
      $response['license_number'] = $request->license_number;
      $response['postal_code'] = $request->postal_code;
    } else {
      //Provider not exists but postal_code exist i.e. Case 4
      $response['provider_type'] = $request->provider_type;
      $response['case'] = 4;
      $response['license_number'] = $request->license_number;
    }

    return $response;
  }
  //=================Health provider case  search function complete====================================// 


  //======================Provider exist Office  exist(Case1) start===============================// 
  public function ProviderExist_OfficeExist($license_num, $location_num = NULL, $postal_code = NULL)
  {
    $provider = Provider::where('license_number', $license_num)->first();

    if ($location_num !== "NULL") {
      $office =     ProviderOffice::where('location_number', $location_num)->first();
      $errormsg = "License Number or Office Location Number does not exist.";
      
      $provider_office_enroll = ProviderOfficeEnrollment::where([['office_system_id', $office->id],['provider_system_id', $provider->id]])->first();
      if ($provider && $office) {
        return view('provider.provider-exist-office-exist', compact('provider', 'office','provider_office_enroll'));
      } else {
        return Redirect::route('provider.enroll.step1')->with('error', $errormsg);
      }
    } else {
      $postal_code = wordwrap($postal_code, 3, ' ', true);
      $offices = ProviderOffice::where([['postal_code', $postal_code], ['location_number', '>=', 10000]])->get();
      $errormsg = "License Number or Postal Code  Number does not exist.";

      if ($provider && $offices->count() > 0) {
        return view('provider.provider-exist-postal-exist-health', compact('provider', 'offices', 'postal_code'));
      } else {
        return Redirect::route('provider.enroll.step1')->with('error', $errormsg);
      }
    }
  }
  //======================Provider exist Office  exist(Case1) complete===============================// 

  public function Save_ProviderExist_OfficeExist(Request $request){
    $office =  ProviderOffice::find($request->selected_office);
    if (!$office) {
      return Redirect::back()->with('error', 'Invalid Office selected');
    }
    $provider = Provider::where('license_number', $request->license_number)->first()->toArray();
    //========Sending mail to user containing password and fcb id to login
    if($provider){
      $registration_id = $provider['registration_id'];
    }
    $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
    $encodedpassword = Hash::make($password);
    $send_data_in_mail = array('fname' => $request->first_name, 'lname' => $request->last_name, 'password' => $password, 'fcbid' => $registration_id);
    $emailtemplate =  $this->FindTemplate('provider-enrollment-password');

    try {
      // Send mail to user
      Mail::send('emails/provider/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($office, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($office->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in provider enrollment process. Email can not be send.');
    }

    $enrollment = ProviderOfficeEnrollment::create([
      'office_system_id' => $request->selected_office,
      'provider_system_id' => $provider['id'],
      'password' => $encodedpassword,
    ]);

    if (!$enrollment) {
      return Redirect::back()->with('error', "Something went wrong in enrollment process.");
    }
    /*=============Inserting in  provider office enrollment complete===================*/
    $fcb_data[] = array('id' => $registration_id, 'password' => $password);
    // foreach end
    //Session::put('fcb_number', ['id' => $registration_id]);
    Session::put('fcb_data', $fcb_data);  // password & office id store in session
    // page redirect
    return Redirect::route('provider.confirmation')->with('success', "Provider and provider's Office Enrolled Successfully");
  
  }

  /*===================Provider exist Office not exist(Case2)========================*/
  public function ProviderExistOfficeNotExist($license_num, $location_num = NULL, $postal_code = NULL)
  {
    $provider = Provider::where('license_number', $license_num)->first();
    $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Health.pdf'; // Health Provider Manual

    if ($location_num != 'NULL') {
      $office = ProviderOffice::where('location_number', $location_num)->get();
    } else {
      $office = ProviderOffice::where([['postal_code', $postal_code], ['location_number', '>=', 10000]])->get();
    }

    // Dental Provider
    if ($provider->assigning_authority_number == 1) {
      $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Dental.pdf';
    }

    //Provider exists but office does not exist i.e. Case 2
    if ($provider && $office->count() < 1) {
      return view('provider.provider-exist-office-notexist', ['provider' => $provider, 'office_location_num' => $location_num, 'postal_code' => $postal_code, 'terms_condition_link' => $terms_condition_link]);
    } else {
      return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
    }
  }

  /*=================== Saving Provider exist Office not exist(Case2)========================*/
  public function Save_ProviderExistOfficeNotExist(Request $request)
  {
    //Frontend fields validation start

    //Finding provider to apply validations accordingly
    
    $provider = Provider::where('registration_id', $request->fcb_number)->first();
    
    if ($provider->assigning_authority_number == 1) {
      $request->validate(
        [
          'office_number' => 'required|unique:provider_offices,location_number',
        ],
        [
          'office_number.required' => 'Please enter valid office number',
          'office_number.numeric' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.min' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.max' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.digits_between' => 'Office location Number length must be 4 numbers as assigned by CDA',
        ]
      );
    }

    $request->validate(
      [
        'clinic_name' => 'required|min:3|max:256',
        'address1' => 'required|min:3|max:256',
        'latitude' => 'required',
        'longitude' => 'required',
        'city' => 'required|min:3|max:256',
        'province' => 'required',
        'postal_code' => 'required|regex:/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/',
        'phone_number' => 'required|unique:provider_offices,telephone|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',
        'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        'terms_and_conditions' => 'accepted',
      ],
      [
        'postal_code.required' => 'Invalid address – Selected address postal code does not match',
        'latitude.required' => 'Please select valid location',
        'longitude.required' => 'Please select valid location',
        'address1.required' => 'Please select Address',
      ]
    );
    // Frontend fields validations complete

    $isclinic_exist = ProviderOffice::where([['postal_code', $request->postal_code], ['clinic_name', $request->clinic_name]])->first();
    if ($isclinic_exist) {
      return Redirect::back()->with('error', 'A clinic already exists with same name in same postal code area');
    }

    //generating office location number
    if ($provider->assigning_authority_number == 1) {
      //for dental
      $office_location_number = $request->office_number;
    } else {
      //for health
      $office_location_number = ProviderOffice::where('location_number', '>', 9999)->get()->max('location_number');

      if (is_null($office_location_number)) {
        $office_location_number = 10000;
      } else {
        $office_location_number++;
      }
    }

    $ProviderOffice = ProviderOffice::create([
      'location_number' => $office_location_number,
      'clinic_name' => $request->clinic_name,
      'address1' => $request->address1,
      'address2' => ($request->address2) ? $request->address2 : '',
      'city' => $request->city,
      'postal_code' => $request->postal_code,
      'province' => $request->province,
      'website' => ($request->website) ? $request->website : '',
      'telephone' => $request->phone_number,
      'fax' => ($request->fax) ? $request->fax : '',
      'email' => $request->email,
      'social_media' => $request->social_media ? serialize($request->social_media) : '',
      'latitude' => $request->latitude,
      'longitude' => $request->longitude,
    ]);
    $office_id = $ProviderOffice->id;
    if (!$ProviderOffice) {
      return Redirect::back()->with('error', 'Provider Office can not be registered');
    }
    //generating password to save
    $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
    $encodedpassword = Hash::make($password);
    /*=============Inserting in  provider office enrollment start===================*/
    $enrollment = ProviderOfficeEnrollment::create([
      'office_system_id' => $ProviderOffice->id,
      'provider_system_id' => $provider->id,
      'password' => $encodedpassword,
    ]);
    $registration_id = $request->fcb_number;
    if (!$enrollment)
      return Redirect::back()->with('error', "Something went wrong in enrollment process.");

    //========Sending mail to user containing password and fcb id to login
    $send_data_in_mail = array('fname' => $request->first_name, 'lname' => $request->last_name, 'password' => $password, 'fcbid' => $registration_id);
    $emailtemplate =  $this->FindTemplate('provider-enrollment-password');

    try {
      // Send mail to user
      Mail::send('emails/provider/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($request, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($request->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in provider enrollment process. Email can not be send.');
    }   

    /*=============Inserting in  provider office enrollment complete===================*/
    
    $fcb_data[] = array('id' => $registration_id, 'password' => $password);
    Session::put('fcb_data', $fcb_data);
    return Redirect::route('provider.confirmation')->with('success', 'Provider Office Registered Successfully');
  }
  /*=================== Provider  Exist + Office Not Exist(case2) complete========================*/

  /*=================== Saving Provider exist Office not exist(Case2)========================*/
  public function Save_ProviderExistOfficeExist_ClinicNotFound(Request $request)
  {
    //Frontend fields validation start

    //Finding provider to apply validations accordingly
    
    $provider = Provider::where('license_number', $request->license_number)->first();
   
    if ($provider->assigning_authority_number == 1) {
      $request->validate(
        [
          'office_number' => 'required|unique:provider_offices,location_number',
        ],
        [
          'office_number.required' => 'Please enter valid office number',
          'office_number.numeric' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.min' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.max' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.digits_between' => 'Office location Number length must be 4 numbers as assigned by CDA',
        ]
      );
    }

    $request->validate(
      [
        'clinic_name' => 'required|min:3|max:256',
        'address1' => 'required|min:3|max:256',
        'latitude' => 'required',
        'longitude' => 'required',
        'city' => 'required|min:3|max:256',
        'province' => 'required',
        'postal_code' => 'required|regex:/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/',
        'phone_number' => 'required|unique:provider_offices,telephone|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',
        'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        'terms_and_conditions' => 'accepted',
      ],
      [
        'postal_code.required' => 'Invalid address – Selected address postal code does not match',
        'latitude.required' => 'Please select valid location',
        'longitude.required' => 'Please select valid location',
        'address1.required' => 'Please select Address',
      ]
    );
    // Frontend fields validations complete

    $isclinic_exist = ProviderOffice::where([['postal_code', $request->postal_code], ['clinic_name', $request->clinic_name]])->first();
    if ($isclinic_exist) {
      return Redirect::back()->with('error', 'A clinic already exists with same name in same postal code area');
    }

    //generating office location number
    if ($provider->assigning_authority_number == 1) {
      //for dental
      $office_location_number = $request->office_number;
    } else {
      //for health
      $office_location_number = ProviderOffice::where('location_number', '>', 9999)->get()->max('location_number');

      if (is_null($office_location_number)) {
        $office_location_number = 10000;
      } else {
        $office_location_number++;
      }
    }

    $ProviderOffice = ProviderOffice::create([
      'location_number' => $office_location_number,
      'clinic_name' => $request->clinic_name,
      'address1' => $request->address1,
      'address2' => ($request->address2) ? $request->address2 : '',
      'city' => $request->city,
      'postal_code' => $request->postal_code,
      'province' => $request->province,
      'website' => ($request->website) ? $request->website : '',
      'telephone' => $request->phone_number,
      'fax' => ($request->fax) ? $request->fax : '',
      'email' => $request->email,
      'social_media' => $request->social_media ? serialize($request->social_media) : '',
      'latitude' => $request->latitude,
      'longitude' => $request->longitude,
    ]);
    $office_id = $ProviderOffice->id;
    if (!$ProviderOffice) {
      return Redirect::back()->with('error', 'Provider Office can not be registered');
    }
    //generating password to save
    $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
    $encodedpassword = Hash::make($password);
    /*=============Inserting in  provider office enrollment start===================*/
    $enrollment = ProviderOfficeEnrollment::create([
      'office_system_id' => $ProviderOffice->id,
      'provider_system_id' => $provider->id,
      'password' => $encodedpassword,
    ]);
    $registration_id = $provider->registration_id;
    if (!$enrollment)
      return Redirect::back()->with('error', "Something went wrong in enrollment process.");

    //========Sending mail to user containing password and fcb id to login
    $send_data_in_mail = array('fname' => $request->first_name, 'lname' => $request->last_name, 'password' => $password, 'fcbid' => $registration_id);
    $emailtemplate =  $this->FindTemplate('provider-enrollment-password');

    try {
      // Send mail to user
      Mail::send('emails/provider/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($request, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($request->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in provider enrollment process. Email can not be send.');
    }   

    /*=============Inserting in  provider office enrollment complete===================*/
    
    $fcb_data[] = array('id' => $registration_id, 'password' => $password);
    Session::put('fcb_data', $fcb_data);
    return Redirect::route('provider.confirmation')->with('success', 'Provider Office Registered Successfully');
  }
  /*=================== Provider  Exist + Office Not Exist(case2) complete========================*/


  /*=================== Provider Not Exist + Office Not Exist(case3) start========================*/
  public function ProviderNotExist_OfficeNotExist($provider_type, $license_num, $location_num = NULL, $postal_code = NULL, $fname, $lname, $dental_speciality = NULL)
  {
    $provider = Provider::where('license_number', $license_num)->first();
    $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Health.pdf'; // Health Provider Manual

    if ($location_num != 'NULL') {
      $office = ProviderOffice::where('location_number', $location_num)->get();
    } else {
      $office = ProviderOffice::where([['postal_code', $postal_code], ['location_number', '>=', 10000]])->get();
    }

    $speciality = DB::table('speciality_codes')->where('speciality_code_number', $dental_speciality)->first();
    $speciality_description = $speciality ? $speciality->speciality_code_description : '';

    // Dental Provider
    if ($provider_type == 1) {
      $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Dental.pdf';
    }

    if (!$provider && $office->count() < 1) {
      //Provider not exists and office does not exist i.e. Case 3
      return view('provider.provider-notexist-office-notexist', ['selected_provider_type' => $provider_type, 'license_num' => $license_num, 'office_location_num' => $location_num, 'postal_code' => $postal_code, 'fname' => $fname, 'lname' => $lname, 'speciality_description' => $speciality_description, 'dental_speciality' => $dental_speciality, 'terms_condition_link' => $terms_condition_link]);
    } else {
      return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
    }
  }

  /*==========Saving Provider Not Exist Office Not Exist case 3 info====================*/
  public function Save_ProviderNotExistOfficeNotExist(Request $request)
  {
    $speciality_code_number = 1;

    //Frontend fields validation start
    $request->validate(
      [
        'provider_type' => 'required',
        'terms_and_conditions' => 'accepted',
      ],
      [
        'provider_type.required' => 'Please select provider type',
      ]
    );

    if ($request->provider_type == 1) {
      //Dental Provider
      if ($request->dental_speciality == 12){
        $request->validate(
          [
            'dental_speciality' => 'required|numeric',
            'license_number' => 'required|min:8|max:9|unique:providers',
            'office_number' => 'required|unique:provider_offices,location_number',
          ],
          [
            'dental_speciality.required' => 'Please select a dental speciality',
            'license_number.required' => 'Please enter valid license  number',
            'license_number.min' => 'Unique Number length must be 8 numbers as assigned by your location',
            'license_number.max' => 'Unique Number length must be 8 numbers as assigned by your location',
            'office_number.required' => 'Please enter valid office number',
            'office_number.numeric' => 'Office Location Number must be 4 digits.',
            'office_number.min' => 'Office Location Number must be 4 digits.',
            'office_number.max' => 'Office Location Number must be 4 digits.',
            'office_number.digits_between' => 'Office Location Number must be 4 digits.',
          ]
        );
      }else{
      $request->validate(
        [
          'dental_speciality' => 'required|numeric',
          'license_number' => 'required|min:8|max:9|unique:providers',
          'office_number' => 'required|unique:provider_offices,location_number',
        ],
        [
          'dental_speciality.required' => 'Please select a dental speciality',
          'license_number.required' => 'Please enter valid license  number',
          'license_number.min' => 'Unique Number length must be 8 or 9 numbers as assigned by CDA',
          'license_number.max' => 'Unique Number length must be 8 or 9 numbers as assigned by CDA',
          'office_number.required' => 'Please enter valid office number',
          'office_number.numeric' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.min' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.max' => 'Office location Number length must be 4 numbers as assigned by CDA',
          'office_number.digits_between' => 'Office location Number length must be 4 numbers as assigned by CDA',
        ]
      );
    }
      // validation for dental license no. with speciality codes
      // $first_2_digits_license_no = substr($request->license_number, 0, 2);
      //if ($first_2_digits_license_no != '80' && $first_2_digits_license_no != 20) {
        // $eighth_digit_license_no = substr($request->license_number, -1);
        // $speciality_code = DB::table('speciality_codes')->where('speciality_code_number', $request->dental_speciality)->first();
        // $speciality_sub_category_code = ($speciality_code) ? $speciality_code->speciality_sub_category_code : '';
        // if ($eighth_digit_license_no != $speciality_sub_category_code) {
        //   return Redirect::back()->with('error', 'License Number does not match selected Dental Specialty');
        // }
        $speciality_code_number = $request->dental_speciality;
      //}
    } else {
      //Health Provider
      $request->validate([
        'license_number' => 'required|unique:providers',
      ]);
    }

    $request->validate(
      [
        'last_name' => 'required|min:2|max:256',
        'first_name' => 'required|min:2|max:256',
        'clinic_name' => 'required|min:3|max:256',
        'address1' => 'required|min:3|max:256',
        'city' => 'required|min:3|max:256',
        'province' => 'required',
        'postal_code' => 'required|regex:/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/',
        'phone_number' => 'required|unique:provider_offices,telephone|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',
        'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
      ],
      [
        'postal_code.required' => ' Invalid address – Selected address postal code does not match',
        'address1.required' => 'Please select Address',
      ]
    );
    // Frontend fields validations complete

    $isclinic_exist = ProviderOffice::where([['postal_code', $request->postal_code], ['clinic_name', $request->clinic_name]])->first();
    if ($isclinic_exist) {
      return Redirect::back()->with('error', 'A clinic already exists with same name in same postal code area');
    }

    /*=============Inserting Provider start===================*/

    //generating data  for  provider table
    $assigning_authority = DB::table('assigning_authorities')->where('assigning_authority_number', $request->provider_type)->first();
    $assigning_authority_prefix = ($assigning_authority) ? $assigning_authority->assigning_authority_prefix : 'F0';

    //generating password to save
    $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
    $encodedpassword = Hash::make($password);

    //generating fcb registration  number to save
    $registration_id = Provider::where('registration_id', 'LIKE', $assigning_authority_prefix . '%')->max('registration_id');
    if (is_null($registration_id)) {
      $registration_id = $assigning_authority_prefix . '0000001';
    } else {
      $registration_id++;
    }

    //generating office location number
    if ($request->provider_type == 1) {
      //for dental
      $office_location_number = $request->office_number;
    } else {
      //for health
      $office_location_number = ProviderOffice::where('location_number', '>', 9999)->get()->max('location_number');
      if (is_null($office_location_number)) {
        $office_location_number = 10000;
      } else {
        $office_location_number++;
      }
    }
    //echo $speciality_code_number; die();
    //========Sending mail to user containing password and fcb id to login
    $send_data_in_mail = array('fname' => $request->first_name, 'lname' => $request->last_name, 'password' => $password, 'fcbid' => $registration_id);
    $emailtemplate =  $this->FindTemplate('provider-enrollment-password');

    try {
      // Send mail to user
      Mail::send('emails/provider/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($request, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($request->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in provider enrollment process. Email can not be send.');
    }

    //saving data in provider table
    $provider = Provider::create([
      'license_number' => $request->license_number,
      'registration_id' => $registration_id,
      'password' => $encodedpassword,
      'registration_date' => date('Y-m-d'),
      'assigning_authority_number' => $request->provider_type,
      'last_name' => $request->last_name,
      'first_name' => $request->first_name,
      'speciality_code_number' => $speciality_code_number,
    ]);
    
    if (!$provider) {
      return Redirect::back()->with('error', 'Something went wrong in provider enrollment process.');
    }
    /*=============Inserting Provider complete===================*/

    /*=============Inserting Office start===================*/
    //inserting in table
    $ProviderOffice = ProviderOffice::create([
      'location_number' => $office_location_number,
      'clinic_name' => $request->clinic_name,
      'address1' => $request->address1,
      'address2' => ($request->address2) ? $request->address2 : '',
      'city' => $request->city,
      'postal_code' => $request->postal_code,
      'province' => $request->province,
      'website' => ($request->website) ? $request->website : '',
      'telephone' => $request->phone_number,
      'fax' => ($request->fax) ? $request->fax : '',
      'email' => $request->email,
      'social_media' => ($request->social_media) ? serialize($request->social_media) : '',
      'latitude' => $request->latitude,
      'longitude' => $request->longitude,
    ]);
    
    if (!$ProviderOffice) {
      return Redirect::back()->with('error', "Something went wrong in provider's office enrollment process.");
    }
    /*=============Inserting office complete===================*/
    
    /*=============Inserting in  provider office enrollment start===================*/
    $enrollment = ProviderOfficeEnrollment::create([
      'office_system_id' => $ProviderOffice->id,
      'provider_system_id' => $provider->id,
      'password' => $encodedpassword,
    ]);

    if (!$enrollment) {
      return Redirect::back()->with('error', "Something went wrong in enrollment process.");
    }
    /*=============Inserting in  provider office enrollment complete===================*/
    $fcb_data[] = array('id' => $registration_id, 'password' => $password);
    Session::put('fcb_data', $fcb_data);
    //Session::put('fcb_number', ['id' => $registration_id, 'password' => $password]);
    return Redirect::route('provider.confirmation')->with('success', "Provider and provider's Office Registered Successfully");
  }
  /*=================== Provider Not Exist + Office Not Exist(case3) complete========================*/


  /*=================== Provider Not Exist + Office  Exist(case4) start========================*/
  public function ProviderNotExist_OfficeExist($provider_type, $license_num, $location_num = NULL, $postal_code = NULL, $fname, $lname, $dental_speciality = NULL)
  {
    $provider =   Provider::where('license_number', $license_num)->first();
    $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Health.pdf'; // Health Provider Manual

    if ($provider_type == 1) {
      
      //dental provider
      $office = ProviderOffice::where('location_number', $location_num)->first();

      $speciality = DB::table('speciality_codes')->where('speciality_code_number', $dental_speciality)->first();
      $speciality_description = $speciality ? $speciality->speciality_code_description : '';

      $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Dental.pdf';

      if (!$provider && $office) {
        //Provider not exists and office  exist i.e. Case 4
        return view('provider.provider-notexist-office-exist', ['selected_provider_type' => $provider_type, 'license_num' => $license_num, 'office' => $office, 'fname' => $fname, 'lname' => $lname, 'speciality_description' => $speciality_description, 'dental_speciality' => $dental_speciality, 'terms_condition_link' => $terms_condition_link]);
      } else {
        return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
      }
    } else {
      //health provider
      $offices = ProviderOffice::where([['postal_code', $postal_code], ['location_number', '>=', 10000]])->get();

      if (!$provider && $offices->count() > 0) {
        //Provider not exists and postal code exist i.e. Case 4
        return view('provider.provider-notexist-office-exist-health', ['selected_provider_type' => $provider_type, 'license_num' => $license_num, 'postal_code' => $postal_code, 'offices' => $offices, 'fname' => $fname, 'lname' => $lname, 'terms_condition_link' => $terms_condition_link]);
      } else {
        return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
      }
    }
  }

  /*==========Saving Provider Not Exist Office  Exist case 4 (only dental)====================*/
  public function Save_ProviderNotExistOfficeExist(Request $request)
  {
    $speciality_code_number = 1;

    //Frontend fields validation start
    $request->validate(
      [
        'license_number' => 'required|unique:providers',
        'last_name' => 'required|min:2|max:256',
        'first_name' => 'required|min:2|max:256',
        'provider_type' => 'required|numeric',
        'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        'terms_and_conditions' => 'accepted',
      ],
      [
        'license_number.required' => 'Please enter valid license  number',
        'provider_type.numeric' => 'Provider type value is invalid',
      ]
    );

    //validation for dental provider
    if ($request->provider_type == "1") {
      $request->validate(
        [
          'dental_speciality' => 'required|numeric',
          // 'license_number' => 'required|min:8|max:9',
          'license_number' => 'required|numeric|digits_between:8,9|regex:/^\S*$/u',
        ],
        [
          'dental_speciality.required' => 'Please select a dental speciality',
          // 'license_number.min' => 'License Number length must be 8 or 9 numbers as assigned by CDA',
          // 'license_number.max' => 'License Number length must be 8 or 9 numbers as assigned by CDA',
          'license_number.required' => 'Please enter valid license number',
          'license_number.digits_between' => 'License Number length must be 8 or 9 numbers as assigned by CDA',
          'license_number.numeric' => 'License Number length must be 8 or 9 numbers as assigned by CDA',
        ]
      );
          
      $speciality_code_number = $request->dental_speciality;
      
    }
    // Frontend fields validations complete
    /*=============Inserting Provider start===================*/
    //generating data for provider table
    $assigning_authority = DB::table('assigning_authorities')->where('assigning_authority_number', $request->provider_type)->first();
    $assigning_authority_prefix = ($assigning_authority) ? $assigning_authority->assigning_authority_prefix : 'F0';

    //generating password to save
    $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
    $encodedpassword = Hash::make($password);

    //generating fcb registration  number to save
    $registration_id = Provider::where('registration_id', 'LIKE', $assigning_authority_prefix . '%')->max('registration_id');
    if (is_null($registration_id)) {
      $registration_id = $assigning_authority_prefix . '0000001';
    } else {
      $registration_id++;
    }

    //========Sending mail to user containing password and fcb id to login
    $send_data_in_mail = array('fname' => $request->first_name, 'lname' => $request->last_name, 'password' => $password, 'fcbid' => $registration_id);
    $emailtemplate =  $this->FindTemplate('provider-enrollment-password');

    try {
      // Send mail to user
      Mail::send('emails/provider/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($request, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($request->email)->subject($emailtemplate->subject);
      });
    } catch (Exception $e) {
      return Redirect::back()->with('error', 'Something went wrong in provider enrollment process. Email can not be send.');
    }
    
    //saving data in provider table
    $provider = Provider::create([
      'license_number' => $request->license_number,
      'registration_id' => $registration_id,
      'password' => $encodedpassword,
      'registration_date' => date('Y-m-d'),
      'assigning_authority_number' => $request->provider_type,
      'last_name' => $request->last_name,
      'first_name' => $request->first_name,
      'speciality_code_number' => $speciality_code_number,
    ]);
    

    if (!$provider) {
      return Redirect::back()->with('error', 'Something went wrong in provider enrollment process.');
    }

    /*=============Inserting in  provider office enrollment start===================*/
    $enrollment = ProviderOfficeEnrollment::create([
      'office_system_id' => $request->office_id,
      'provider_system_id' => $provider->id,
      'password' => $encodedpassword,
    ]);

    if (!$enrollment) {
      return Redirect::back()->with('error', "Something went wrong in enrollment process.");
    }
    /*=============Inserting in  provider office enrollment complete===================*/
    $fcb_data[] = array('id' => $registration_id, 'password' => $password);
    Session::put('fcb_data', $fcb_data);
    return Redirect::route('provider.confirmation')->with('success', "Provider Registered Successfully");
    /*=============Inserting Provider complete(only dental complete)===================*/
  }

  /*==========Saving Provider Not Exist Office  Exist case 4 (health provider) start====================*/
  public function Save_ProviderNotExistOfficeExistHealth(Request $request)
  {
    //Frontend fields validation start
    $request->validate(
      [
        'provider_type' => 'required',
        'terms_and_conditions' => 'accepted',
      ],
      [
        'provider_type.required' => 'Provider type is missing',
      ]
    );

    if ($request->provider_type == 1) {
      //Dental Provider
      return Redirect::back()->with('error', 'Provider type is invalid');
    } else {
      //Health Provider
      $request->validate([
        'license_number' => 'required|unique:providers',
      ]);
    }

    $request->validate(
      [
        'last_name' => 'required|min:2|max:256',
        'first_name' => 'required|min:2|max:256',
        'selected_office' => 'required',
      ],
      [
        'selected_office.required' => 'Please select atleast one office to continue.',
        'last_name.required' => 'Please enter valid last name.',
        'first_name.required' => 'Please enter valid first name.',
      ]
    );
    // Frontend fields validations complete
    
    $request->selected_office;
    $office =  ProviderOffice::find($request->selected_office);
    
    if (!$office) {
      return Redirect::back()->with('error', 'Invalid Office selected');
    }

    /*=============Inserting Provider start===================*/
    //generating data  for  provider table
    $assigning_authority = DB::table('assigning_authorities')->where('assigning_authority_number', $request->provider_type)->first();
    $assigning_authority_prefix = ($assigning_authority) ? $assigning_authority->assigning_authority_prefix : 'F0';

    //generating password to save
    $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
    $encodedpassword = Hash::make($password);

    //generating fcb registration  number to save
    $registration_id = Provider::where('registration_id', 'LIKE', $assigning_authority_prefix . '%')->max('registration_id');
    if (is_null($registration_id)) {
      $registration_id = $assigning_authority_prefix . '0000001';
    } else {
      $registration_id++;
    }

    //generating speciality code number
    if ($request->provider_type == 1) {
      //i.e. spaciality code for dental provider
      if (substr($request->license_number, 0, 2) == 20) {
        $speciality_code_number = 1;
      } elseif (substr($request->license_number, 0, 2) == 80) {
        $speciality_code_number = 12;
      } else {
        $speciality_code_number = DB::table('speciality_codes')->where('speciality_sub_category_code', substr($request->license_number, 7, 1))->first()->speciality_code_number;
      }
    } else {
      //i.e. spaciality code for non dental provider
      $speciality_code_number = 1;
    }

    //generating office location number
    if ($request->provider_type == 1) {
      //for dental
      $office_location_number = $request->office_number;
    } else {
      //for health
      $office_location_number = ProviderOffice::where('location_number', '>', 9999)->get()->max('location_number');

      if (is_null($office_location_number)) {
        $office_location_number = 10000;
      } else {
        $office_location_number++;
      }
    }
    $reg_id = Provider::where('license_number', $request->license_number)->pluck('registration_id')->first();
    //========Sending mail to user containing password and fcb id to login
    if($reg_id){
      $registration_id = $reg_id;
    }
      $send_data_in_mail = array('fname' => $request->first_name, 'lname' => $request->last_name, 'password' => $password, 'fcbid' => $registration_id);
      $emailtemplate =  $this->FindTemplate('provider-enrollment-password');

      try {
        // Send mail to user
        Mail::send('emails/provider/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($office, $emailtemplate) {
          $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
          $message->to($office->email)->subject($emailtemplate->subject);
        });
      } catch (Exception $e) {
        return Redirect::back()->with('error', 'Something went wrong in provider enrollment process. Email can not be send.');
      }

    $provider_exist = Provider::where('license_number', $request->license_number)->first();
    if (!$provider_exist) {
      //saving data in provider table
      $provider = Provider::create([
        'license_number' => $request->license_number,
        'registration_id' => $registration_id,
        'password' => $encodedpassword,
        'registration_date' => date('Y-m-d'),
        'assigning_authority_number' => $request->provider_type,
        'last_name' => $request->last_name,
        'first_name' => $request->first_name,
        'speciality_code_number' => $speciality_code_number,
      ]);

      if ($provider == false) {
        return Redirect::back()->with('error', 'Something went wrong in provider enrollment process.');
      }
    }  
    /*=============Inserting Provider complete===================*/

    /*=============Inserting in  provider office enrollment start===================*/
    $enrollment = ProviderOfficeEnrollment::create([
      'office_system_id' => $request->selected_office,
      'provider_system_id' => $provider->id,
      'password' => $encodedpassword,
    ]);

    if ($enrollment  == false) {
      return Redirect::back()->with('error', "Something went wrong in enrollment process.");
    }
    /*=============Inserting in  provider office enrollment complete===================*/
    $fcb_data[] = array('id' => $registration_id, 'password' => $password);
    Session::put('fcb_data', $fcb_data);  // password & office id store in session
    // page redirect
    return Redirect::route('provider.confirmation')->with('success', "Provider and provider's Office Enrolled Successfully");
  }
  /*==========Saving Provider Not Exist Office  Exist case 4 (health provider) complete====================*/

  /*=================== Provider Not Exist + Office  Exist(case4) complete========================*/

  /*====================Health provider clinic not found start========================*/
  public function Health_Clinic_NotFound($provider_type, $license_num, $location_num = NULL, $postal_code = NULL, $fname, $lname)
  {
    $provider = Provider::where('license_number', $license_num)->first();
    $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Health.pdf'; // Health Provider Manual

    if ($provider_type == 1) {
      //dental provider
      return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
    } else {
      //health provider
      $offices = ProviderOffice::where([['postal_code', $postal_code], ['location_number', '>=', 10000]])->get();

      if (!$provider && $offices->count() > 0) {
        //Provider not exists and postal code exist i.e. Case 4
        return view('provider.health-provider-clinic-not-found', ['selected_provider_type' => $provider_type, 'license_num' => $license_num, 'postal_code' => $postal_code, 'fname' => $fname, 'lname' => $lname, 'terms_condition_link' => $terms_condition_link]);
      } else {
        return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
      }
    }
  }
  /*===================Health provider clinic not found complete========================*/

  /*====================Health provider found clinic not found start========================*/
  public function Health_ProviderFound_Clinic_NotFound($provider_type, $license_num, $location_num = NULL, $postal_code = NULL, $fname, $lname)
  {
    $provider = Provider::where('license_number', $license_num)->first();
    
    $terms_condition_link = '/frontend_assets/resources/Provider_Manual_Health.pdf'; // Health Provider Manual

    if ($provider_type == 1) {
      //dental provider
      return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
    } else {
      //health provider
      $offices = ProviderOffice::where([['postal_code', $postal_code], ['location_number', '>=', 10000]])->get();
      
      if ($provider && $offices->count() > 0) {
        //Provider not exists and postal code exist i.e. Case 4
        return view('provider.health-provider-found-clinic-not-found', ['selected_provider_type' => $provider_type, 'license_num' => $license_num, 'postal_code' => $postal_code, 'fname' => $fname, 'lname' => $lname, 'terms_condition_link' => $terms_condition_link]);
      } else {
        return Redirect::route('provider.enroll.step1')->with('error', 'Please enter valid data to complete process successfully.');
      }
    }
  }
  /*===================Health provider found clinic not found complete========================*/

  /*=================== Confirmation Page Start ========================*/
  public function Confirmation(Request $request)
  {
      $fcb_data = Session::get('fcb_data');  
      if($fcb_data){  
        Session::forget('fcb_data');
        return view('provider.confirmation', ['fcb_data' => $fcb_data]);
      } else {
        return redirect('/');
      }
    
  }
  /*=================== Confirmation Page Complete ========================*/

  /*=================== Login ========================*/
  public function Login()
  {
    return view('provider.login');
  }
// Fetch Office based on fcb id  in login page for forgot password
  public function Getoffices(Request $request){
    $fcb_id = $request->fcb_id;
    $provider_id = Provider::where(['registration_id' => $fcb_id])->pluck('id')->first();
    if($provider_id){
      $officeid = ProviderOfficeEnrollment::where(['provider_system_id' => $provider_id])->pluck('office_system_id')->toArray();
      foreach ($officeid as $id){
        
        $officedata = ProviderOffice::where(['id' => $id])->first();
        if($officedata){
          $office_array[] = $officedata;
          
        }
      }
      return $office_array;
    }
  }
  

  public function CheckLogin(Request $request)
  {
    $request->validate(
      [
        'fcbid' => 'required|min:7|max:255',
        'password' => 'required|min:6|max:255',
      ],
      [
        'fcbid.required' => 'Please enter FCB Registration Number ',
        'password.required' => 'Please enter Password',
      ]
    );

    $remember_me = ($request->remember_me) ? true : false;

    $is_valid_fcbid = Provider::where(['registration_id' => $request->fcbid])->first();
    if (!$is_valid_fcbid) {
      return Redirect::back()->with('error', 'Incorrect FCB Registration Number ');
    }
    $provider_system_id = $is_valid_fcbid->id; 
    $password = $request->password; 
    $office_id = '';
    
    $users = ProviderOfficeEnrollment::where(['provider_system_id' => $provider_system_id])->get()->toArray();
    foreach($users as $user){
      //$office_id = $user['office_system_id'];
      $pass = $user['password'];
      if (Hash::check($request->password, $pass)) {
        if(!empty($password)){
          DB::table('providers')
              ->where('registration_id', $request->fcbid)
              ->update(['password' => $pass]);
             $office_id = $user['office_system_id'];  

        }else{
          return Redirect::back()->with('error', 'Incorrect Password');
         }
      }
      
    } 

   $is_authenticated = Auth::guard('provider')->attempt(array('registration_id' => $request->fcbid, 'password' => $request->password), $remember_me);
    if ($is_authenticated) {
     Session::put('providerOffice',$office_id);
     //echo $office_id;die();
      return Redirect::route('provider.dashboard');
      
    } else {
      return Redirect::back()->with('error', 'Incorrect Password');
    }
  }

  public function logout()
  {
    Auth::guard('provider')->logout();
    Session::flush();
    return Redirect::route('provider.login');

  }

  public function Dashboard()
  {
    return view('provider.dashboard');
  }

  public function EditProviderDetails()
  {
    $provider = Auth::guard('provider')->user();
    return view('provider.edit-provider-details', compact('provider'));
  }

  public function SaveProviderDetails(Request $request)
  {
    //Frontend fields validation start
    $request->validate(
      [
        'last_name' => 'required|min:2|max:256',
        'first_name' => 'required|min:2|max:256',
        'account_status' => 'required',
      ],
      [
        'last_name.required' => 'Please enter last name',
        'first_name.required' => 'Please enter first name',
        'account_status.required' => 'Please select valid account status',
      ]
    );
    // Frontend fields validations complete

    $provider =  Provider::find(Auth::guard('provider')->user()->id);
    $provider->last_name = $request->last_name;
    $provider->first_name = $request->first_name;
    $provider->account_status = $request->account_status;
    $provider->save();

    ProviderOfficeEnrollment::where('provider_system_id', Auth::guard('provider')->user()->id)
      ->update(['office_status' => $request->account_status]);

    return Redirect::route('provider.dashboard')->with('success', 'Details Updated Successfully');
  }

  public function SaveProviderDetailsPopup(Request $request){
  
    //Frontend fields validation start
    if(($request->location_number || !empty($request->location_number)) && count($request->all())==2){
      
      $request->validate(
        [
          'location_number' => 'required|unique:provider_offices|min:4|max:4',
        ],
        [
          'location_number.required' => 'Please Enter location number',
          'location_number.min' => 'Invalid Location number, please provide location number as issued by CDA or call FCB support desk for assistance',
          'location_number.max' => 'Invalid Location number, please provide location number as issued by CDA or call FCB support desk for assistance',
          'location_number.unique' => 'Invalid Location number, please provide location number as issued by CDA or call FCB support desk for assistance',
          ]
      );
      $provideroffice =  ProviderOffice::find(Session::get('providerOffice'));
      $provideroffice->location_number = $request->location_number;
      $provideroffice->save();
    }elseif(($request->license_number || !empty($request->license_number)) && count($request->all())==2){
    
      $request->validate(
        [
          'license_number' => 'required|unique:providers',
        ],
        [
          'license_number.required' => 'Please select license number',
          'license_number.unique' => 'The license number has already been taken, please call FCB for assistance to complete your enrollment',
        ]
      );
      $provider =  Provider::find(Auth::guard('provider')->user()->id);
      $provider->license_number = $request->license_number;
      $provider->save();
    }
    else{
      
      $request->validate(
        [
          
          'location_number' => 'required|unique:provider_offices|min:4|max:4',
          'license_number' => 'required|unique:providers',
        ],
        [
          
          'location_number.required' => 'Please Enter location number',
          'license_number.required' => 'Please select license number',
          'location_number.min' => 'Invalid Location number, please provide location number as issued by CDA or call FCB support desk for assistance',
          'location_number.max' => 'Invalid Location number, please provide location number as issued by CDA or call FCB support desk for assistance',
          'license_number.unique' => 'The license number has already been taken, please call FCB for assistance to complete your enrollment',
          'location_number.unique' => 'Invalid Location number, please provide location number as issued by CDA or call FCB support desk for assistance',
          ]
      );
      $provider =  Provider::find(Auth::guard('provider')->user()->id);
      $provider->license_number = $request->license_number;
      $provider->save();

      $provideroffice =  ProviderOffice::find(Session::get('providerOffice'));
      $provideroffice->location_number = $request->location_number;
      $provideroffice->save();
    }
    // Frontend fields validations complete
    return Redirect::route('provider.dashboard')->with('success', 'Details Updated Successfully');
  }


  public function ViewOffices(){
    $enrolled_offices = ProviderOffice::where('id', Session::get('providerOffice'))->get();
    return view('provider.viewoffices', compact('enrolled_offices'));
  }

  public function EditOffice($officeid = NULL){
    $office = ProviderOffice::find($officeid);
    if ($office) {
      return view('provider.editoffice', compact('office'));
    } else {
      return Redirect::back()->with('error', 'Office id is invalid');
    }
  }

  public function UpdateOffice(Request $request){
    $office = ProviderOffice::find($request->office_id);
    if (!$office) {
      return Redirect::back()->with('error', 'Office id is invalid');
    }

    // Frontend fields validations complete
    $request->validate(
      [
        'office_enrollment_status' => 'required',
      ],
      [
        // 'postal_code.required' => 'Please enter valid postal code',       
      ]
    );
    
    ProviderOfficeEnrollment::where('provider_system_id', Auth::guard('provider')->user()->id)
      ->update(['office_status' => $request->office_enrollment_status]);

    $provider = Provider::where([['id', Auth::guard('provider')->user()->id]])->first();
    $provider->account_status = $request->office_enrollment_status;
    $provider->save();

    return Redirect::route('provider.viewoffices')->with('success', 'Details Updated Successfully');
  }

  public function RegisteredProviders($officeid = NULL)
  {
    $office = ProviderOffice::find($officeid);
    if ($office) {
      $registeredproviders_ids_ary = ProviderOfficeEnrollment::where([['office_system_id', $officeid]])->pluck('provider_system_id')->toArray();
      $registeredproviders = Provider::whereIn('id', $registeredproviders_ids_ary)->get();
      //print_r($registeredproviders); die();
      return view('provider.registeredproviders', compact('registeredproviders', 'office'));
    } else {
      return Redirect::back()->with('error', 'Office id is invalid');
    }
  }

  // ==================Change password =========================//
  public function ChangePassword()
  {
    return view('provider.changepassword');
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
        'current_password.required' => 'Please enter Current Password',
        'new_password.required' => 'Please enter New Password',
        'new_password.regex' => 'New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character',
        'confirm_password.required' => 'Please enter  Confirm Password',
        'confirm_password.same' => 'New Password and Confirm Password must be same',
      ]
    );
    $office_id = Session::get('providerOffice');
    $id = Auth::guard('provider')->user()->id;
    $users = ProviderOfficeEnrollment::where('provider_system_id', $id)->get()->toArray();
    $condition1 = '';
    foreach($users as $user){
      $user['password'];
      if(Hash::check($request->new_password,$user['password'] )){
        $condition1  = 'true';
      }
      
    }
    if($condition1){
      return Redirect::back()->with('error', 'New password Already Exist');
    }else{
      $provider = ProviderOfficeEnrollment::where(['office_system_id' => $office_id,'provider_system_id'=> $id])->first();
      if (Hash::check($request->current_password, $provider->password)) {
        $provider->password = Hash::make($request->new_password);
        $provider->save();
        Auth::guard('provider')->logout();
        return Redirect::route('provider.login')->with('success', 'Password changed successfully.Please login with new password');
      } else {
        return Redirect::back()->with('error', 'Current password is incorrect');
      }
    }
  }
  // ==================Change password complete=========================//

  // ==================Update password alert value=========================//
  public function UpdatePasswordAlert()
  {
    $provider_system_id = Auth::guard('provider')->user()->id;
    $office_id = Session::get('providerOffice');
    ProviderOfficeEnrollment::where(['office_system_id' => $office_id],['provider_system_id' => $provider_system_id])
        ->update([
           'password_change_alert' => '1'
        ]);
    $provider = Provider::find(Auth::guard('provider')->user()->id);
    $provider->password_change_alert = 1;
    $provider->save();
  }

  public function ShowForgotPassword(){
    return view('provider.forgotpassword');
  }

  public function Getproviderofficepassword(Request $request){
    $fcb_id = $request->fcb_id;
    $validator = \Validator::make($request->all(), [
      'fcb_id' => 'required|min:9|max:9',
    ]);
    if($validator->fails()){
      return response()->json(['errors'=>$validator->errors()->all()]);
    }else{
      $id = Provider::where(['registration_id' => $fcb_id])->pluck('id')->first();
      if($id){
        return response()->json(['success'=>'Fcb Registration Number Found.']);
      }else{
        return response()->json(['errors'=>'FCB Registration Number not found, please correct or call FCB support.']);
      }
    }
    
}

  public function Getprovider(Request $request){
    $fcb_id = $request->fcb_id;
    $member_data = Provider::where(['registration_id' => $fcb_id])->get()->toArray();
    
    foreach($member_data as $data){
      $assigning_authority_number = $data['assigning_authority_number'];
      $speciality_code_number = $data['speciality_code_number'];
    }
    if($assigning_authority_number == 1){
      $speciality = DB::table('speciality_codes')->where('speciality_code_number', $speciality_code_number)->first();
      $speciality_description = $speciality ? $speciality->speciality_code_description : ''; 
    }else{
      $speciality_description = DB::table('assigning_authorities')->where('assigning_authority_number', $assigning_authority_number)->first()->assigning_authority_code_description; 
    }
    
    //$speciality = DB::table('speciality_codes')->where('speciality_code_number', $assigning_authority_number)->first();
    //$speciality_description = $speciality ? $speciality->speciality_code_description : '';
    $data = array(
      'license_number' => $data['license_number'],
      'registration_id' => $data['registration_id'],
      'speciality_description' => $speciality_description,
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
    );
    return $data;
  }

  public function getofficedetails(Request $request){
    $telephone = $request->telephone;
    $fcb_id = $request->fcb_id;
    $postal = $request->postal_code;
    $provider_id = Provider::where(['registration_id' => $fcb_id])->pluck('id')->first();
    $office_data = ProviderOffice::where(['telephone' => $telephone,'postal_code' => $postal])->get()->toArray();
    if($office_data && !empty($provider_id)){
      foreach($office_data as $data){
      }
      $provider_office_enroll = ProviderOfficeEnrollment::where([['office_system_id', $data['id']],['provider_system_id', $provider_id]])->first(); 
      if($provider_office_enroll){
        $data = array(
          'office_id' => $data['id'],
          'location_number' => $data['location_number'],
          'clinic_name' => $data['clinic_name'],
          'address1' => $data['address1'],
          'city' => $data['city'],
          'postal_code' => $data['postal_code'],
          'telephone' => $data['telephone'],
          'fax' => $data['fax'],
          'email' => $data['email'],
          'website' => $data['website'],
          'social_media' => $data['social_media'],
        );
        return $data;
      }else{
        return 'Selected office not found, please correct or Call FCB support desk';
      }
    }else{
      return  'Selected office not found, please correct or Call FCB support desk';
    }  
    
    
  }
  public function SendProviderOTP(Request $request){
    $useremail = trim($request->email);
    $otp = rand(1000,9999);
    $providerdata = "";
    // Sending mail to user containing password and fcb id to login
    $send_data_in_mail = array('otp' => $otp);
    $emailtemplate =  $this->FindTemplate('otp-provider');
    try {
      // Send mail to user
      Mail::send('emails/provider/otp', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($providerdata,$useremail, $emailtemplate) {
        $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
        $message->to($useremail)->subject($emailtemplate->subject);
      });
      $request->session()->put('provider_otp', $otp);
      return "success";
    } catch (Exception $e) {
      return 'Something went wrong in sending the email.';
    }
  }

  public function Resetpasswordprovider(Request $request){
    $request->validate(
      [
        'new_password' => 'required|min:6|max:255|regex:/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
      ],
      [
        'new_password.required' => 'Please enter New Password.',
        'new_password.regex' => 'New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
      ]);
    
    $office_id = $request->office_id;
    $useremail = $request->email;
    $id = $request->registration_number;
    $provider_id = Provider::where(['registration_id' => $id])->pluck('id')->first();
    $users = ProviderOfficeEnrollment::where('provider_system_id', $provider_id)->get()->toArray();
    
    $condition1 = '';
    foreach($users as $user){
      $user['password'];
      if(Hash::check($request->new_password,$user['password'] )){
        $condition1  = 'true';
      }
      
    }
    if($condition1){
      return Redirect::back()->with('error', 'New password Already Exist');
    }else{
      $provider = ProviderOfficeEnrollment::where(['office_system_id' => $office_id,'provider_system_id'=> $provider_id])->first();
      $new_password = Hash::make($request->new_password);
      $provider->password = $new_password;
      $provider->save();
      $providerdata = "";
      // Sending mail to user containing password and fcb id to login
      $send_data_in_mail = array('new_password' => $request->new_password);
      $emailtemplate =  $this->FindTemplate('resetproviderpassword');
      try {
        // Send mail to user
        Mail::send('emails/provider/otp', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($providerdata,$useremail, $emailtemplate) {
          $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
          $message->to($useremail)->subject($emailtemplate->subject);
        });
      }catch (Exception $e) {
        return Redirect::route('provider.login')->with('success', 'Something went wrong in sending the email.');
      }
      return Redirect::route('provider.login')->with('success', 'Password changed successfully.Please login with new password');
    }
  } 
  
  public function ProcedureCodeFinder(){
    return view('provider.procedurecodefinder');
  }

  public function SearchProcedureCodeById(Request $request){
    $id = $request->id;
    switch ($id) {
      case "1":
        $start = "0000";
        $end   = "09999";
        break;
      case "2":
        $start = "10000";
        $end   = "19999";
        break;
      case "3":
        $start = "20000";
        $end   = "29999";
        break;
      case "4":
        $start = "30000";
        $end   = "39999";
        break;
      case "5":
        $start = "40000";
        $end   = "49999";
        break;
      case "6":
        $start = "50000";
        $end   = "59999";
        break;
      case "7":
        $start = "60000";
        $end   = "69999";
        break;
      case "8":
        $start = "70000";
        $end   = "79999";
        break;
      case "9":
        $start = "80000";
        $end   = "89999";
        break; 
      case "10":
        $start = "90000";
        $end   = "98999";
        break;      
      
    }    
    
    $provider = Auth::guard('provider')->user();
    $provider_id = $provider->id;
    $officeEnroll = ProviderOfficeEnrollment::where('provider_system_id', $provider_id)->first();
    $officeData = ProviderOffice::where('id', $officeEnroll->office_system_id)->first();
    $fee_guide = DB::table('vw_service_code')
    ->where('province', $officeData->province)
    ->where('service_code','>',$start)
    ->where('service_code','<',$end)
    ->get();
    foreach($fee_guide as $value){
      $data[] = array(
        'service_code' => $value->service_code,
        'service_code_category' => $value->service_code_category,
        'service_code_subcategory' => $value->service_code_subcategory,
      );
    }  
    return $data;
  }

}
