<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Provider\Provider;
use App\Models\Provider\ProviderClaim;
use App\Models\Provider\ProviderClaimDetail;
use App\Models\Provider\ProviderOffice;
use App\Models\Provider\ProviderOfficeEnrollment;
use App\Models\Provider\ServiceCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ProviderClaimController extends Controller
{
    // Display Step 1 for Health and Dental Providers
    public function index(Request $request, $request_type = NULL)
    {
        $this->forgetSessionData($request);

        $provider = Auth::guard('provider')->user();

        if (!$provider) {
            $this->forgetSessionData($request);
            return Redirect::back()->with('error', 'Something went wrong in claim submission process.');
        }

        if ($request_type == 'estimate') {
            $request->session()->put('request_type', 'estimate');
        } else {
            $request->session()->put('request_type', 'claim');
        }

        $request_type = $request->session()->get('request_type') ?? '';

        $speciality = DB::table('speciality_codes')->where('speciality_code_number', $provider->speciality_code_number)->first();
        $providerOffice = $request->session()->get('providerOffice');
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->where('office_system_id' , $providerOffice)->first();
        $office = ProviderOffice::find($offices->office_system_id);

        return view('provider.claims.claim-step1', compact('provider', 'office', 'speciality', 'request_type'));
    }

    // Submit Claim Step 1 for Health and Dental Providers
    public function submitClaimStep1(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $request_type = $request->session()->get('request_type') ?? '';
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();

        if ($provider->account_status !== 1 || $offices->office_status !== 1) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Please Check Your Enrollment Status, or Call the FCB Support Desk for Assistance!');
        }

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        return Redirect::route('provider.claim_step2');
    }

    // Display Step 2 for Health and Dental Providers
    public function claimStep2(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($provider->account_status !== 1 || $offices->office_status !== 1) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Please Check Your Enrollment Status, or Call the FCB Support Desk for Assistance!');
        }

        return view('provider.claims.claim-step2', ['provider' => $provider, 'request_type' => $request_type]);
    }

    // Submit Claim Step 2 for Health and Dental Providers
    public function submitClaimStep2(Request $request)
    {
        $request->validate(
            [
                'policy_number' => 'required|max:8',
                'member_number' => 'required|min:3|max:11',
            ],
            [
                'policy_number.required' => 'Please enter Group Policy Number',
                'policy_number.min' => 'Group number must be 8 characters',
                'policy_number.max' => 'Group number must be 8 characters',
                'member_number.required' => 'Please enter Member ID',
                'member_number.min' => 'Member ID must be 11 characters.',
                'member_number.max' => 'Member ID must be 11 characters.',
            ]
        );
        $member_no_9_characters = substr($request['member_number'], 0, -2);
        $family_members = Member::where('member_number', 'LIKE', $member_no_9_characters . '%')
            ->min('member_number'); 
        $member = Member::where('policy_number', $request['policy_number'])->where('member_number', $family_members)->first();
        
        if ($member == NULL) {
            return Redirect::back()->with('error', 'Group number or Member ID is invalid, please correct or call FCB support.');
        }
        elseif($member->account_status == '2'){
            return Redirect::back()->with('error', 'Specified Member is not eligible for service, call FCB for support');
        }
        elseif($member->account_status == '0'){
            return Redirect::back()->with('error', 'Member ID Status is Pending, please correct or call FCB support.');
        }

        $request->session()->put('member_id', $member->id);

        return Redirect::route('provider.claim_step3');
    }

    // Display Claim Step 3 for Health and Dental Providers
    public function claimStep3(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
        $member_id = $request->session()->get('member_id');
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($provider->account_status !== 1 || $offices->office_status !== 1) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Please Check Your Enrollment Status, or Call the FCB Support Desk for Assistance!');
        }

        if ($member_id == NULL) {
            return Redirect::route('provider.claim_step2')->with('error', 'Something went wrong in claim submission process. Please enter the member details.');
        }

        $member = Member::where('id', $member_id)->first();
        if ($member == NULL) {
            return Redirect::route('provider.claim_step2')->with('error', 'Policy/Member not found or not valid. Please review data or call FCB support desk.');
        }

        $member_no_9_characters = substr($member->member_number, 0, -2);
        $family_members = Member::where('member_number', 'LIKE', $member_no_9_characters . '%')
            ->where('policy_number', $member->policy_number)
            ->where('account_status', 1)
            ->get();    
            foreach($family_members as $family_member){
                $member_number = $family_member->member_number;
                if($member_number == $member->member_number){
                    $account_status = $family_member->account_status;
                }
                
            }   
        //if (count($family_members) == 0) {
            if($account_status == '0'){
                return Redirect::route('provider.claim_step2')->with('error', 'Member account is Pending. Please
                have Member activate their account to start coverage or call FCB support.');
            }elseif($account_status == '2'){
                //return Redirect::route('provider.claim_step2')->with('error', 'Specified Member is not eligible for service, call FCB for support.');
                return Redirect::route('provider.claim_step2')->with('error', 'Primay account holder not active, call FCB support.');
            }
        //}

        return view('provider.claims.claim-step3', ['provider' => $provider, 'family_members' => $family_members, 'request_type' => $request_type]);
    }

    // Submit Claim Step 3 for Health and Dental Providers
    public function submitClaimStep3(Request $request)
    {
        $request->validate(
            ['member_id' => 'required'],
            ['member_id.required' => 'Please select a Member']
        );

        $member = Member::where('id', $request['member_id'])->first();

        if ($member == NULL) {
            return Redirect::back()->with('error', 'Member not found or not valid. Please review data or call FCB support desk.');
        }

        $request->session()->put('member_id', $member->id);

        return Redirect::route('provider.claim_step4');
    }

    // Display Claim Step 4 for Health and Dental Providers
    public function claimStep4(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $member_id = $request->session()->get('member_id');
        $member = Member::where('id', $member_id)->first();
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($provider->account_status !== 1 || $offices->office_status !== 1) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Please Check Your Enrollment Status, or Call the FCB Support Desk for Assistance!');
        }

        if ($member_id == NULL) {
            return Redirect::route('provider.claim_step2')->with('error', 'Something went wrong in claim submission process. Please enter the member details.');
        }

        if ($member == NULL) {
            return Redirect::route('provider.claim_step3')->with('error', 'Member not found or not valid. Please review data or call FCB support desk.');
        }

        $request->session()->put('member_id', $member_id);
        return view('provider.claims.claim-step4', ['provider' => $provider, 'request_type' => $request_type]);
    }

    // Submit Claim Step 4 for Health and Dental Providers
    public function submitClaimStep4(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $member_id = $request->session()->get('member_id');
        $notes = $request['provider_notes'];
        
        $claim = new ProviderClaim();
        $claim->fill([
            'provider_id' => $provider->id,
            'member_id' => $member_id,
        ]);

        $request->session()->put('provider_claim', $claim);
        $request->session()->put('provider_note', $notes);

        return Redirect::route('provider.claim_step5');
    }

    // Display Claim Step 5 for Health and Dental Providers
    public function claimStep5(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $claim = $request->session()->get('provider_claim');
        $clinical_services = $request->session()->get('clinical_services') ?? [];
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($provider->account_status !== 1 || $offices->office_status !== 1) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Please Check Your Enrollment Status, or Call the FCB Support Desk for Assistance!');
        }

        if ($claim == NULL) {
            return Redirect::route('provider.claim_step2')->with('error', 'Something went wrong in claim submission process. Please enter the member details.');
        }

        if ($provider->assigning_authority_number == 1) {
            return view('provider.claims.dental-claim-step5', ['provider' => $provider, 'clinical_services' => $clinical_services, 'request_type' => $request_type]);
        }
        $assigning_authority_number = $provider->assigning_authority_number;
        $service_code = DB::table('service_code')->where('assigning_authority_number', $assigning_authority_number)->get();
        $provider = Auth::guard('provider')->user();
        $provider_id = $provider->id;
        foreach($service_code as $ser){
            $officeEnroll = ProviderOfficeEnrollment::where('provider_system_id', $provider_id)->first();
            $officeData = ProviderOffice::where('id', $officeEnroll->office_system_id)->first();
            $fee_guide = DB::table('fee_guide')
            ->where('province', $officeData->province)
            ->where('service_code_id', $ser->id)
            ->get()->toArray();
            if(!empty($fee_guide)){
                foreach($fee_guide as $value){
                    $gross_fee = $value->gross_fee;
                    $service_fee = $value->service_fee;
                }
            }else{
                $gross_fee = '0.00';
                $service_fee = '0.00';
            }
            $id = $ser->id;
            $service_code = $ser->service_code;
            $service_code_category = $ser->service_code_category;
            $service_code_subcategory = $ser->service_code_subcategory;

            $data[] = array(
                'id' => $id,
                'service_code' => $service_code,
                'service_code_category' => $service_code_category,
                'service_code_subcategory' => $service_code_subcategory,
                'gross_fee' => $gross_fee,
                'service_fee' => $service_fee,
            );
            
        }
        return view('provider.claims.health-claim-step5', ['provider' => $provider, 'clinical_services' => $clinical_services, 'request_type' => $request_type, 'service_code' => $data]);
    }

    public function getFeeData(Request $request){
        $provider = Auth::guard('provider')->user();
        $provider_id = $provider->id;
        $service_code_id =  $request->service_code_id;
        $service_code_data = DB::table('service_code')->where('id', $service_code_id)->first();
        $officeEnroll = ProviderOfficeEnrollment::where('provider_system_id', $provider_id)->first();
        $office_system_id = $request->session()->get('providerOffice');
        $officeData = ProviderOffice::where('id', $office_system_id)->first();
        $fee_guide = DB::table('fee_guide')
        ->where('province', $officeData->province)
        ->where('service_code_id', $service_code_id)
        ->get();
        if(!empty($fee_guide)){
            foreach($fee_guide as $value){
                $gross_fee = $value->gross_fee;
                $service_fee = $value->service_fee;
            }
        }else{
            $gross_fee = '0.00';
            $service_fee = '0.00';
        }
        $service_code = $service_code_data->service_code;
        $service_code_category = $service_code_data->service_code_category;
        $service_code_subcategory = $service_code_data->service_code_subcategory;

        $data = array(
            'service_code' => $service_code,
            'service_code_category' => $service_code_category,
            'service_code_subcategory' => $service_code_subcategory,
            'gross_fee' => $gross_fee,
            'service_fee' => $service_fee,
        );
        return $data;
    }

    // Add services to claim
    public function addServiceClaimStep5(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $clinical_services = $request->session()->get('clinical_services') ?? [];

        if (count($clinical_services) >= 12) {
            return Redirect::route('provider.claim_step5')->with('error', 'Can not add more than 12 lines.');
        }

        if ($provider->assigning_authority_number == 1) {
            $request->validate(
                [
                    'service_code' => 'required|digits:5',
                    'tooth_number' => 'nullable|digits:2',
                    'tooth_surfaces' => 'nullable|alpha|max:6',
                    'lab_fee' => 'nullable|numeric|min:0.00|max:99999.99',
                    'expense_fee' => 'nullable|numeric|min:0.00|max:99999.99'
                ]
            );
        } else {
            $request->validate(
                [
                    'service_code' => 'required|digits:5',
                    'lab_fee' => 'nullable|numeric|min:0.00|max:99999.99',
                    'expense_fee' => 'nullable|numeric|min:0.00|max:99999.99',
                    'service_code_category' => 'nullable',
                    'service_code_subcategory' => 'nullable',
                ],
                [
                    'service_code.required' => 'Please select an eligible service',
                    
                  ]
            );
        }
        
        $lab_fee = number_format((float)$request->lab_fee, 2, '.', '');
        $expense_fee = number_format((float)$request->expense_fee, 2, '.', '');

        $clinical_services[] = [
            'service_code' => $request->service_code,
            'tooth_number' => $request->tooth_number ?? null,
            'tooth_surfaces' => $request->tooth_surfaces ?? null,
            'lab_fee' => $lab_fee ? : '0.00',
            'expense_fee' => $expense_fee ? : '0.00',
            'service_code_category' => $request->service_code_category ?? null,
            'service_code_subcategory' => $request->service_code_subcategory ?? null,
        ];
        
        $request->session()->put('clinical_services', $clinical_services);

        return Redirect::route('provider.claim_step5');
    }

    // Remove services from Claim
    public function removeServiceClaimStep5(Request $request)
    {
        $id = $request['id'] ?? '';

        if (empty($id) && $id != 0) {
            return response()->json(['error' => 'Can not delete the clinical service']);
        }

        $clinical_services = $request->session()->get('clinical_services') ?? [];
        if (array_key_exists($id, $clinical_services)) {
            unset($clinical_services[$id]);
            $request->session()->put('clinical_services', array_values($clinical_services));
            return response()->json(['data' => 'Clinical service deleted successfully!']);
        }

        return response()->json(['error' => 'Can not delete the clinical service']);
    }

    // Submit Claim Step 5 for Health and Dental Providers
    public function submitClaimStep5(Request $request)
    {
        
        $provider = Auth::guard('provider')->user();
        $provider_claim = $request->session()->get('provider_claim');
        $clinical_services = $request->session()->get('clinical_services') ?? [];
        $office_system_id = $request->session()->get('providerOffice');
        $offices = ProviderOfficeEnrollment::where('office_system_id', $office_system_id)->where('provider_system_id', $provider->id)->first();
        $notes = $request->session()->get('provider_note') ?? null;
        $claim_lines = [];
        $current_date = Carbon::today()->toDateString();
        $claim = [];
        $request_type = $request->session()->get('request_type') ?? '';
        $transaction_type = 1;
        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($request_type == 'estimate') {
            $transaction_type = 2;
        }

        if (count($clinical_services) == 0) {
            return Redirect::route('provider.claim_step5')->with('error', 'Please enter at least one clinical service to continue');
        }
        foreach ($clinical_services as $i => $service) {
            if ($provider->assigning_authority_number == 1) {
                $expense_fee = $service['expense_fee'];
                $lab_fee = $service['lab_fee'];
            }else{
                $lab_fee = 0;
                $expense_fee = 0;
            }
            $claim_lines[] = [
                'lineNumber' => $i + 1,
                'serviceDate' => $current_date,
                'serviceCode' => $service['service_code'],
                'submitLabAmount' => $lab_fee,
                'submitExpenseAmount' => $expense_fee,
                'toothCode' => $service['tooth_number'],
                'toothSurfaces' => $service['tooth_surfaces'],
            ];
        }

        $claim = [
            'transactionType' => $transaction_type,
            'providerOfficeEnrollmentId' => $offices->id,
            'memberId' => $provider_claim->member_id,
            'claimNotes' => $notes,
            'claimLines' => $claim_lines,
        ];
        
        $json_req = (json_encode($claim, JSON_PRETTY_PRINT));
        $response = $this->GetResponseApi($json_req);
        $result = json_decode($response, true);
        $request->session()->put('clinical_services_validated', $result);
        return Redirect::route('provider.claim_step6');
    }

    public function GetResponseApi($json_req){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://35.182.161.148/ClaimAPI/claim/ProcessClaim',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $json_req,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic YWRtaW46cGFzc3dvcmQ='
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    public function ReverseClaim(Request $request){
        $claimCode = $request->claimCode; 
        $data = array('claimCode' => $claimCode);
        $data = json_encode($data, JSON_PRETTY_PRINT);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://35.182.161.148/ClaimAPI/claim/ReverseClaim?claimCode='.$claimCode,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic YWRtaW46cGFzc3dvcmQ='
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return Redirect::route('provider.claim_step5');
    }

    // Display step 6 for Health and Dental Providers
    public function claimStep6(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $claim = $request->session()->get('provider_claim');
        $clinical_services_validated = $request->session()->get('clinical_services_validated') ?? [];
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($provider->account_status !== 1 || $offices->office_status !== 1) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Please Check Your Enrollment Status, or Call the FCB Support Desk for Assistance!');
        }

        if ($claim == NULL) {
            return Redirect::route('provider.claim_step2')->with('error', 'Something went wrong in claim submission process. Please enter the member details.');
        }
       
        if ($provider->assigning_authority_number == 1) {
            $falied = false;
            return view('provider.claims.dental-claim-step6', ['provider' => $provider, 'invalid_clinical_services' => $clinical_services_validated, 'failed' => $falied, 'request_type' => $request_type]);
        }
        return view('provider.claims.health-claim-step6', ['provider' => $provider, 'clinical_services' => $clinical_services_validated, 'request_type' => $request_type]);
    }

    // Submit Step 6 for Health and Dental Providers
    public function submitClaimStep6(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $clinical_services_validated = $request->session()->get('clinical_services_validated') ?? [];
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($provider->assigning_authority_number == 1) {
            $falied = false;
            foreach ($clinical_services_validated['claim']['claimLines'] as $service) {
                if ($service['statusDescription'] == 'failed') {
                    $falied = true;
                }
            }

            if ($falied) {
                return Redirect::back()->with('error', 'Please go back to Step 5 and remove the lines with errors.');
            }
        } else {
            $clinical_services = $request->session()->get('clinical_services') ?? [];
            $selected_services = $request['clinical_services'] ?? [];
            $deleted_services = array_diff(array_keys($clinical_services), $selected_services);
            $provider_claim = $request->session()->get('provider_claim');
            $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
            $notes = $request->session()->get('provider_note') ?? null;
            $claim_lines = [];
            $current_date = Carbon::today()->toDateString();
            $claim = [];
            $transaction_type = 1;

            if ($request_type == 'estimate') {
                $transaction_type = 2;
            }

            foreach ($deleted_services as $value) {
                $id = $value ?? '';

                if ((!empty($id) || $id == 0) && array_key_exists($id, $clinical_services)) {
                    unset($clinical_services[$id]);
                }
            }

            foreach ($clinical_services as $i => $service) {
                $claim_lines[] = [
                    'lineNumber' => $i + 1,
                    'serviceDate' => $current_date,
                    'serviceCode' => $service['service_code'],
                    'submitLabAmount' => $service['lab_fee'],
                    'submitExpenseAmount' => $service['expense_fee'],
                    'toothCode' => $service['tooth_number'],
                    'toothSurfaces' => $service['tooth_surfaces'],
                ];
            }

            $claim = [
                'transactionType' => $transaction_type,
                'providerOfficeEnrollmentId' => $offices->id,
                'memberId' => $provider_claim->member_id,
                'claimNotes' => $notes,
                'claimLines' => $claim_lines,
            ];

            $request->session()->put('clinical_services', array_values($clinical_services));
            $json_req = new Request([json_encode($claim)]);
            $result = json_decode($json_req, true);
            $request->session()->put('clinical_services_validated', $clinical_services_validated);
        }

        $request->session()->forget('clinical_services');
        $request->session()->forget('provider_note');
        return Redirect::route('provider.claim_step7');
    }

    // Display claim step 7 for Health and Dental providers
    public function claimStep7(Request $request)
    {
        $provider = Auth::guard('provider')->user();
        $clinical_services_validated = $request->session()->get('clinical_services_validated') ?? [];
        $claim = $request->session()->get('provider_claim');
        $offices = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($provider->account_status !== 1 || $offices->office_status !== 1) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Please Check Your Enrollment Status, or Call the FCB Support Desk for Assistance!');
        }

        if ($claim == NULL) {
            return Redirect::route('provider.claim_step2')->with('error', 'Something went wrong in claim submission process. Please enter the member details.');
        }

        if (!count($clinical_services_validated['claim']['claimLines'])) {
            return Redirect::route('provider.claim_step5')->with('error', 'Please enter the clinical services');
        }
        $office_system_id = $request->session()->get('providerOffice');
        $office = ProviderOffice::find($office_system_id);

        $member_id = $request->session()->get('member_id');
        $member = Member::where('id', $member_id)->first();
        if ($member) {   
            $member_no_9_characters = substr($member->member_number, 0, 9);
            $family_members = Member::where('member_number', 'LIKE', $member_no_9_characters . '%')
                ->where('policy_number', $member->policy_number)
                ->get();    
        } 

        if ($provider->assigning_authority_number == 1) {
            return view('provider.claims.dental-claim-step7', ['provider' => $provider, 'clinical_services_validated' => $clinical_services_validated, 'request_type' => $request_type, 'office' => $office, 'family_members' => $family_members]);
        }
        
        return view('provider.claims.health-claim-step7', ['provider' => $provider, 'clinical_services_validated' => $clinical_services_validated, 'request_type' => $request_type, 'office' => $office, 'family_members' => $family_members]);
    }

    // Submit step 7 for Claim submission
    public function submitClaimStep7(Request $request)
    {
        $claim = $request->session()->get('provider_claim');
        $clinical_services_validated = $request->session()->get('clinical_services_validated') ?? [];
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if (empty($claim) || empty($clinical_services_validated)) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Error saving claim details.');
        }

        $request->session()->forget('provider_claim');
        $request->session()->forget('provider_note');
        $request->session()->forget('clinical_services');

        // Add the record to database if it is a claim and not an estimate
        if ($request_type == 'claim') {
            //generating fcb claim reference number
            $reference_number = ProviderClaim::where('reference_number', 'LIKE', 'FCB' . Carbon::today()->year . 'DDD%')->max('reference_number');
            if (is_null($reference_number)) {
                $reference_number = 'FCB' . Carbon::today()->year . 'DDD0001';
            } else {
                $reference_number++;
            }

            $new_claim = ProviderClaim::create([
                'reference_number' => $reference_number,
                'provider_id' => $claim->provider_id,
                'member_id' => $claim->member_id,
                'patient_pays_amount' => $clinical_services_validated['claim']['totalPatientPaysAmount'],
                'submitted_amount' => $clinical_services_validated['claim']['totalSubmittedAmount'],
                'fcb_contracted_rate' => $clinical_services_validated['claim']['totalServiceChargeAmount'],
                'processed_date' => Carbon::today()->toDateString(),
                'failed_payment' => false,
            ]);

            foreach ($clinical_services_validated['claim']['claimLines'] as $service) {
                ProviderClaimDetail::create([
                    'provider_claim_id' => $new_claim->id,
                    'service_code' => $service['serviceCode'],
                    'description' => $service['message'] ?? '',
                    'patient_pays_amount' => floatval($service['patientPaysAmount']),
                    'submitted_amount' => floatval($service['totalEligibleAmount']),
                    'fcb_contracted_rate' => floatval($service['serviceChargeAmount']),
                ]);
            }

            $request->session()->forget('member_id');
            $request->session()->forget('clinical_services_validated');
            //return Redirect::route('provider.claim_step8', ['claim' => $new_claim]);
            return Redirect::route('provider.dashboard');
        }

        //return Redirect::route('provider.claim_step8');
        return Redirect::route('provider.dashboard');
    }

    // Display claim step 8 for Health and Dental providers
    public function claimStep8(Request $request, ProviderClaim $claim = NULL)
    {
        $provider = Auth::guard('provider')->user();
        $request_type = $request->session()->get('request_type') ?? '';
        $validated = $request->session()->get('clinical_services_validated') ?? [];
        $member_id = $request->session()->get('member_id') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($request_type == 'estimate') {
            if (empty($validated) || empty($member_id)) {
                $this->forgetSessionData($request);
                return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
            }

            if ($provider->assigning_authority_number == 1) {
                return view('provider.claims.dental-estimate-step8', ['provider' => $provider, 'validated' => $validated]);
            }

            return view('provider.claims.health-estimate-step8', ['provider' => $provider, 'validated' => $validated]);
        }

        $claim_provider = $claim->provider()->first();

        if ($claim_provider->id != $provider->id) {
            return Redirect::route('provider.dashboard')->with('error', 'You do not have access to the claim.');
        }

        if ($provider->assigning_authority_number == 1) {
            return view('provider.claims.dental-claim-step8', ['provider' => $provider, 'claim' => $claim]);
        }

        return view('provider.claims.health-claim-step8', ['provider' => $provider, 'claim' => $claim]);
    }

    public function submitClaimStep8(Request $request, ProviderClaim $claim = NULL)
    {
        $request_type = $request->session()->get('request_type') ?? '';

        if ($request_type != 'estimate' && $request_type != 'claim') {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in claim/estimate submission process. Please try submitting again.');
        }

        if ($request_type == 'estimate') {
            return Redirect::route('provider.claim_eob')->with('success', 'Please print Explanation of Benefit for the estimate.');
        }

        return Redirect::route('provider.claim_eob', ['claim' => $claim])->with('success', 'Please print Explanation of Benefit for the claim and give the copy to member as proof of payment.');
    }

    // Display claim explanation of benefit for Health and Dental providers
    public function claimEob(Request $request, ProviderClaim $claim = NULL)
    {
        $provider = Auth::guard('provider')->user();
        $office = ProviderOfficeEnrollment::where('provider_system_id', $provider->id)->first();
        $provider_office = ProviderOffice::find($office->office_system_id);
        $request_type = $request->session()->get('request_type') ?? '';
        $validated = $request->session()->get('clinical_services_validated') ?? [];
        $member_id = $request->session()->get('member_id') ?? '';
        $request->session()->forget('clinical_services_validated');
        $request->session()->forget('request_type');
        $request->session()->forget('member_id');

        if ($request_type == 'estimate' && (empty($validated) || empty($member_id))) {
            $this->forgetSessionData($request);
            return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in estimate submission process. Please try submitting again.');
        }

        if ($request_type == 'estimate') {
            $member = Member::find($member_id);

            if ($member == NULL) {
                $this->forgetSessionData($request);
                return Redirect::route('provider.dashboard')->with('error', 'Something went wrong in estimate submission process. Please try submitting again.');
            }

            $insured_profile = $member->insured_profile()->first();

            return view(
                'provider.claims.estimate-eob',
                [
                    'provider' => $provider,
                    'provider_office' => $provider_office,
                    'member' => $member,
                    'insured_profile' => $insured_profile,
                    'validated' => $validated,
                ]
            );
        }

        if ($claim) {
            $member = $claim->member()->first();
            $insured_profile = $member->insured_profile()->first();
            $claim_lines = $claim->claimDetails()->get();
            $claim_provider = $claim->provider()->first();

            if ($claim_provider->id != $provider->id) {
                return Redirect::route('provider.dashboard')->with('error', 'You do not have access to the claim.');
            }

            return view(
                'provider.claims.claim-eob',
                [
                    'provider' => $provider,
                    'provider_office' => $provider_office,
                    'member' => $member,
                    'insured_profile' => $insured_profile,
                    'claim' => $claim,
                    'claim_lines' => $claim_lines,
                ]
            );
        }

        $this->forgetSessionData($request);
        return Redirect::route('provider.dashboard')->with('error', 'Error accessing Explanation of Benefits.');
    }

    public function submitClaimCancellation(Request $request)
    {
        // TODO JSON request to cancel the claim

        $this->forgetSessionData($request);

        return Redirect::route('provider.dashboard');
    }

    public function forgetSessionData(Request $request)
    {
        $request->session()->forget('member_id');
        $request->session()->forget('provider_claim');
        $request->session()->forget('provider_note');
        $request->session()->forget('clinical_services');
        $request->session()->forget('clinical_services_validated');
        $request->session()->forget('request_type');
    }

    public function viewClaims(Request $request)
    {
        $provider = Provider::find(Auth::guard('provider')->user()->id);
        $claims = $provider->claims()->paginate(10);
        $total_billing_amount = $provider->total_claim_amount();
        return view('provider.claims.view-claims', ['total_billing_amount' => $total_billing_amount, 'claims' => $claims]);
    }

    // Mock the JSON validation for Step 5 in Claim Submission process
    public function mockJsonValidation(Request $request)
    {
        $claim = json_decode($request[0], true);
        $claim_lines = [];

        foreach ($claim['claimLines'] as $clinical_service) {
            $status_desc = 'Approved';
            $message = null;

            if ($clinical_service['serviceCode'] == '7777' || $clinical_service['serviceCode'] == '8888') {
                $status_desc = 'failed';
                $message = 'Invalid service code or service code not covered by the FCB program. Please correct service code or call FCB support desk.';
            }

            if ($clinical_service['serviceCode'] == '6666') {
                $message = 'Service code does not allow lab fee - Lab Fee disallowed.';
            }

            $claim_lines[] =  [
                'lineNumber' => $clinical_service['lineNumber'],
                'statusDescription' => $status_desc,
                'message' => $message,
                'serviceDate' => $clinical_service['serviceDate'],
                'serviceCode' =>  $clinical_service['serviceCode'],
                'serviceCodeSubcategory' => 'Complete',
                'eligibleServiceAmount' => 125.0,
                'eligibleLabAmount' => 200.0,
                'eligibleExpenseAmount' => 0.0,
                'totalEligibleAmount' => 325.0,
                'planPaysAmount' => 31.25,
                'serviceChargeAmount' => 7.5,
                'patientPaysAmount' => 293.75,
                'toothCode' => $clinical_service['toothCode'],
                'toothSurfaces' => $clinical_service['toothSurfaces'],
            ];
        }

        $validated[] = [
            'claim' => [
                'claimCode' => 'D0000000008',
                'processDate' => Carbon::today()->toDateString() . ' 10:44:28',
                'totalSubmittedAmount' => 505.0,
                'totalEligibleAmount' => 355.0,
                'totalPlanPaysAmount' => 38.75,
                'totalPatientPaysAmount' => 466.25,
                'totalServiceChargeAmount' => 12.5,
                'claimLines' => $claim_lines,
            ],
        ];
        return json_encode($validated);
    }
}
