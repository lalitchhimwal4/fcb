<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

?>
@section('title','Edit-Office-Provider')
@extends('layouts.frontend.main')
@section('content')
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
        <div class="enroll-content-outer provider-view-offices-outer provider-edit-offices-outer">
            <form action="{{route('provider.updateoffice')}}" method="POST" id="edit_office_details">
                <input type="hidden" name="office_id" value="{{$office->id}}">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @csrf
                        @include('showmessages')
                        <h4>Change Enrollment status</h4>
                        <h5 class="enroll-cstm-form-heading"><span>Location Details</span></h5>
                        <div class="edit-prv-off-row">
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group" style="width:100%;margin-top:10px;">
                                <p class="text-danger">Warning: Changing enrollment status to “Inactive” will
remove you from the FCB Health Network program for this office only.<p>
                                </div>
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
                                    <p>
                                        <?php
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
                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Office Enrollment Status </label>

                                    <div class="select-wrap custom-select-form-control">
                                        <select class="form-control" name="office_enrollment_status">
                                            <?php
                                            $office_status = DB::table('provider_office_enrollments')->where([['office_system_id', $office->id], ['provider_system_id', Auth::guard('provider')->user()->id]])->first()->office_status;
                                            $office_statuses_ary = get_default_values_from_mastertable('provider_office_enrollments', 'office_status');
                                            if ($office_statuses_ary != 0)
                                                foreach ($office_statuses_ary as $officestatuskey => $officestatusvalue) { ?>
                                                <option value="{{$officestatuskey}}" @if($officestatuskey==$office_status) selected="selected" @endif>{{$officestatusvalue}}</option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>

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
                            <div class="form enrol-login-form view-third-col d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Website </label>
                                    
                                    <p>{{$office->website}}</p>

                                </div>
                                <div class="form-group social_media_group_wrapper editoffice-socialwrapper">
                                    <label class="enroll-label">Social Media</label>
                                    @foreach(unserialize($office->social_media) as $socialkey=>$socialvalue)
                                    <div class="social_media_group" id="social{{$socialkey}}" @if($socialkey !=0) style="margin-top:10px;" @endif>
                                        <p>{{$socialvalue}}</p>
                                        
                                    </div>
                                    @endforeach
                                    <div class="add-another-btn-wrap">
                                        
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                            <button type="submit" class="btn enrol-btn">Save </button>
                            <a href="{{route('provider.viewoffices')}}" class="enrol-btn">Cancel</a>
                        </div>

                    </div>
                    <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('footerjs')
<script>
    $(document).ready(function() {

        addEmailValidation(); //calling function from common.js for validate email
        addPostalCodeValidation(); //calling function from common.js for validate postal code
        addTelephoneValidation(); //calling function from common.js for validate telephone 
        addArrayInputValidation(); //calling function from common.js for validate Social Media 

        //capitalize postal code
        $(".postalcode").keyup(
            function() {
                this.value = this.value.toUpperCase();
            }
        );

        if ($("#edit_office_details").length > 0) {
            $("#edit_office_details").validate({
                rules: {
                    clinic_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 256,

                    },
                    address1: {
                        required: true,
                        minlength: 3,
                        maxlength: 256,
                    },
                    city: {
                        required: true,
                        minlength: 3,
                        maxlength: 256,
                    },
                    province: {
                        required: true,
                    },
                    postal_code: {
                        required: true,
                        custompostalcode: true,
                    },
                    office_enrollment_status: {
                        required: true,
                    },
                    phone_number: {
                        required: true,
                        customtelephone: true,
                    },
                    fax: {
                        required: true,
                    },
                    email: {
                        required: true,
                        customemail: true,
                    },
                    website: {
                        required: true,
                        minlength: 3,
                        maxlength: 256,
                    },
                    'social_media[]': {
                        array_input_required: true,
                        minlength: 3,
                        maxlength: 256,
                    },
                },
                messages: {
                    'social_media[]': {
                        array_input_required: "Please fill valid values in all added social media fields or you can delete unnecessary fields",
                    },
                },
            })
        }
    })

    //====add social account field function==============//
    function add_new_social_account_field() {
        var social_group_unique_id = Math.random().toString(16).slice(2);
        $(".social_media_group_wrapper").append('<div id="' + social_group_unique_id + '" class="social_media_group" style="margin-top:10px;"><input type="text" class="form-control" name="social_media[]" placeholder="facebook.com/william-dental"><i onclick=delete_social_account_field("' + social_group_unique_id + '") class="fas fa-minus-circle"></i></div>');
    }

    function delete_social_account_field(social_group_unique_id) {
        $("#" + social_group_unique_id).remove();
    }
</script>
@endsection