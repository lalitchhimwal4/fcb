@section('title','Step 2')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>@if($request_type =="claim") Submit a Claim @else Submit an Estimate @endif</h4>
                        <p>{{$provider->first_name." ".$provider->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <!-- <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a> -->
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="enroll-content-outer provider-dashboard edit-provider-details">
            <form action="{{route('provider.submit_claim_step2')}}" method="post" id="">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @csrf
                        @include('showmessages')
                        <div>
                            <h4>@if($request_type =="claim") Treatment Submission @else Treatment Estimate Submission  @endif</h4>
                            <div class="head-row claim-submit">
                                <div class="claim-head-col done before-active">
                                    <span></span>
                                    <h6>Step 1</h6>
                                </div>
                                <div class="claim-head-col active">
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
                        <h5 class="claim-form-heading">Member Search</h5>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group" name="license_area">
                                <label class="enroll-label">Group Number</label>
                                <input type="text" class="form-control" placeholder="12345678" name="policy_number">
                            </div>
                            <div class="form-group" name="license_area">
                                <label class="enroll-label">Member ID</label>
                                <input type="text" class="form-control" placeholder="12345678911" name="member_number">
                            </div>
                        </div>
                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                            <button type="submit" class="btn enrol-btn">Continue</button>
                            <a href="{{route('provider.submit_claim_cancellation')}}" class="enrol-btn btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection