@section('title','Step 1')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>@if($request_type == "claim") Submit a Claim @else Submit an Estimate @endif</h4>
                        <p>{{Auth::guard('provider')->user()->first_name." ".Auth::guard('provider')->user()->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <!-- <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a> -->
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="enroll-content-outer provider-dashboard edit-provider-details">
            <form action="{{route('provider.claim_step1')}}" method="POST" id="">
                <input type="hidden" name="" value="">
                <input type="hidden" name="" value="">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @csrf
                        @include('showmessages')
                        <div>
                            <h4>@if($request_type =="claim") Treatment Submission @else Treatment Estimate Submission  @endif</h4>
                            <div class="head-row claim-submit">
                                <div class="claim-head-col active">
                                    <span></span>
                                    <h6>Step 1</h6>
                                </div>
                                <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 2</h6>
                                </div>
                                <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 3</h6>
                                </div>
                                <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 4</h6>
                                </div>
                                <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 5</h6>
                                </div>
                                <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 6</h6>
                                </div>
                                <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 7</h6>
                                </div>
                                <!-- <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 8</h6>
                                </div> -->
                            </div>
                        </div>
                        <h4>Provider Details</h4>
                        <h5 class="enroll-cstm-form-heading"><span>Registration Information</span></h5>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group" name="">
                                <label class="enroll-label">FCB Registration ID </label>
                                <input type="text" class="form-control" value="{{$provider->registration_id}}" name="registration_id" disabled>
                            </div>
                            <div class="form-group" name="">
                                <label class="enroll-label">License Number</label>
                                <input type="text" class="form-control" value="{{$provider->license_number}}" name="license_number" disabled>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Speciality Type </label>
                                <input type="text" class="form-control" value="{{$speciality->speciality_code_description}}" name="speciality_description" disabled>
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group" name="">
                                <label class="enroll-label">Provider Last Name </label>
                                <input type="text" class="form-control" value="{{$provider->last_name}}" name="provider_last_name" disabled>
                            </div>
                            <div class="form-group" name="">
                                <label class="enroll-label">Provider First Name</label>
                                <input type="text" class="form-control" value="{{$provider->first_name}}" name="provider_first_name" disabled>
                            </div>
                        </div>
                        <h5 class="enroll-cstm-form-heading"><span>Office Information</span></h5>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group" name="">
                                <label class="enroll-label">Office ID</label>
                                <input type="text" class="form-control" value="{{$office->location_number}}" name="office_id" disabled>
                            </div>
                            <div class="form-group" name="">
                                <label class="enroll-label">Clinic Name </label>
                                <input type="text" class="form-control" value="{{$office->clinic_name}}" name="clinic_name" disabled>
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group" name="">
                                <label class="enroll-label">Address Line 1 </label>
                                <input type="text" class="form-control" value="{{$office->address1}}" name="address_one" disabled>
                            </div>
                            <div class="form-group" name="">
                                <label class="enroll-label">Address Line 2 </label>
                                <input type="text" class="form-control" placeholder="N/A" value="{{$office->address2}}" name="address_two" disabled>
                            </div>
                            <div class="form-group" name="">
                                <label class="enroll-label">Postal Code </label>
                                <input type="text" class="form-control" placeholder="N/A" value="{{$office->postal_code}}" name="postal_code" disabled>
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group" name="">
                                <label class="enroll-label">City </label>
                                <input type="text" class="form-control" value="{{$office->city}}" name="city" disabled>
                            </div>
                            <div class="form-group" name="">
                                <label class="enroll-label">Province </label>
                                <input type="text" class="form-control" value="{{$office->province}}" name="province" disabled>
                            </div>
                            <div class="form-group" name="">
                                <label class="enroll-label">Country </label>
                                <input type="text" class="form-control" placeholder="N/A" value="{{$office->country}}" name="country" disabled>
                            </div>
                        </div>

                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                            <button type="submit" class="btn enrol-btn">Continue</button>
                            <a href="{{route('provider.submit_claim_cancellation')}}" class="enrol-btn btn">Cancel</a>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection