@section('title','Step 3')
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
            <form action="{{route('provider.submit_claim_step3')}}" method="post" id="">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @csrf
                        @include('showmessages')
                        <div>
                            <h4>@if($request_type =="claim") Treatment Submission @else Treatment Estimate Submission  @endif</h4>
                            <div class="head-row claim-submit">
                                <div class="claim-head-col done">
                                    <span></span>
                                    <h6>Step 1</h6>
                                </div>
                                <div class="claim-head-col done  before-active">
                                    <span></span>
                                    <h6>Step 2</h6>
                                </div>
                                <div class="claim-head-col active">
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
                        <h5 class="claim-form-heading">Select a member</h5>
                        <div class="form">
                            <div class="edit-prv-off-row">
                                @foreach($family_members as $i => $family_member)
                                @if($i>0)
                                <hr /> @endif
                                <div class="form enrol-login-form d-flex flex-wrap">
                                    <div class="form-group">
                                        <label class="enroll-label">
                                            <input type="radio" name="member_id" value="{{$family_member->id}}" @if($i==0) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Member Number</label>
                                        <p>{{$family_member->member_number}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Last Name</label>
                                        <p>{{$family_member->last_name}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">First Name</label>
                                        <p>{{$family_member->first_name}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Relationship</label>
                                        <p><?php
                                            switch ($family_member->relationship) {
                                                case 0:
                                                    echo "Primary Member";
                                                    break;
                                                case 1:
                                                    echo "Spouse";
                                                    break;
                                                case 2:
                                                    echo "Dependent";
                                                    break;
                                                case 3:
                                                    echo "Parents";
                                                    break;
                                                case 4:
                                                    echo "Guest";
                                                    break;
                                                case 5:
                                                    echo "Partner";
                                                    break;
                                                default:
                                                    echo "Other";
                                            }
                                            ?></p>
                                    </div>
                                </div>
                                @endforeach
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