@section('title','View Offices-Provider')
@extends('layouts.frontend.main')
@section('content')

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

?>

<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Office Details</h4>
                        <p>{{Auth::guard('provider')->user()->first_name." ".Auth::guard('provider')->user()->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-view-offices-outer">
            <div class="container">
                <div class="enroll-content-wrap">
                    @include('showmessages')
                    <h4>Registered Office</h4>
                    <h5 class="enroll-cstm-form-heading"><span>Location Details</span></h5>
                    @foreach($enrolled_offices as $office)
                    <div class="edit-prv-off-row">
                        <div class="form enrol-login-form d-flex flex-wrap">
                            @if(Auth::guard('provider')->user()->assigning_authority_number==1)
                            <div class="form-group">
                                <label class="enroll-label">Location Number </label>
                                <p>{{$office->location_number}}</p>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="enroll-label">Clinic Name </label>
                                <p>{{$office->clinic_name}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Street Address</label>
                                <p>{{$office->address1}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">City</label>
                                <p>{{$office->city}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Province</label>
                                <p><?php
                                    switch ($office->province) {
                                        case 'NS':
                                            echo 'Nova Scotia';
                                            break;
                                        case 'PE':
                                            echo 'Prince Edward Island';
                                            break;
                                        case 'NL':
                                            echo 'Newfoundland and Labrador';
                                            break;
                                        case 'NB':
                                            echo 'New Brunswick';
                                            break;
                                        case 'QC':
                                            echo 'Quebec';
                                            break;
                                        case 'ON':
                                            echo 'Ontario';
                                            break;
                                        case 'MB':
                                            echo 'Manitoba';
                                            break;
                                        case 'SK':
                                            echo 'Saskatchewan';
                                            break;
                                        case 'AB':
                                            echo 'Alberta';
                                            break;
                                        case 'BC':
                                            echo 'British Columbia';
                                            break;
                                        case 'YT':
                                            echo 'Yukon';
                                            break;
                                        case 'NT':
                                            echo 'Northwest Territories';
                                            break;
                                        case 'NU':
                                            echo 'Nunavut';
                                            break;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Postal Code</label>
                                <p>{{$office->postal_code}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="edit-prv-off-row">
                        <div class="form enrol-login-form d-flex flex-wrap">
                            <div class="form-group">
                                <label class="enroll-label">Office Enrollment Status </label>
                                <p><?php
                                    $office_status =  DB::table('provider_office_enrollments')->where([['office_system_id', $office->id], ['provider_system_id', Auth::guard('provider')->user()->id]])->first()->office_status;
                                    $office_statuses_ary = get_default_values_from_mastertable('provider_office_enrollments', 'office_status');
                                    if ($office_statuses_ary != 0)
                                        echo $office_statuses_ary[$office_status];
                                    ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Phone Number </label>
                                <p>{{$office->telephone}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Fax Number</label>
                                <p>{{$office->fax}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Email-Address </label>
                                <p>{{$office->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="edit-prv-off-row">
                        <div class="form enrol-login-form view-third-col d-flex flex-wrap">
                            <div class="form-group">
                                <label class="enroll-label">Website </label>
                                <p>{{$office->website}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Social Media</label>
                                <?php
                                foreach (unserialize($office->social_media) as $social) {
                                    echo "<p>" . $social . "</p>";
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="view-offices-button-wrap d-flex align-items-center flex-wrap">
                        <a href="{{route('provider.editoffice',$office->id)}}" class="enrol-btn" <?php if(Auth::guard('provider')->user()->account_status == '2'){ echo 'style="pointer-events: none;"';} ?>><i class="fas fa-edit"></i> Change Enrollment Status</a>
                        <a href="{{route('provider.registeredproviders',['officeid'=>$office->id])}}" class="enrol-btn family-bottom-btn"> View registered providers <i class="fas fa-arrow-right"></i></a>
                    </div>

                    @endforeach

                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection