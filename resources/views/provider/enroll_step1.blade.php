<?php

use Illuminate\Support\Facades\DB;

?>
@section('title','Profile-Provider')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Provider Enrollment</h4>
            <div class="head-row">
                <div class="head-col active">
                    <span></span>
                    <h6> Profile </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Offices </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Confirmation </h6>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-content-wrap">
            <form action="{{route('provider.enroll.step2')}}" method="POST" id="provider_enroll_step1_form">
                <input type="hidden" name="provider_case" value="">
                <input type="hidden" name="selected_provider_type" value="">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        @csrf
                        <h4>Step 1: Profile</h4>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group">
                                <label class="enroll-label">Provider Type </label>
                                <?php
                                $provider_types = DB::table('assigning_authorities')->get(); ?>
                                <div class="select-wrap">
                                    <select class="form-control" id="provider_type" name="provider_type">
                                        <option value="">Select</option>
                                        @foreach($provider_types as $provider_type)
                                        <option value="{{$provider_type->assigning_authority_number}}">{{$provider_type->assigning_authority_code_description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" name="dental_speciality_area">
                                <label class="enroll-label">Dental Specialty </label>
                                <?php
                                $dental_specialties = DB::table('speciality_codes')->get(); ?>
                                <div class="select-wrap">
                                    <select class="form-control" id="dental_speciality" name="dental_speciality">
                                        <option value="">Select</option>
                                        @foreach($dental_specialties as $dental_speciality)
                                            @if($dental_speciality->speciality_code_number =='99')         
                                                        
                                            @else
                                            <option value="{{$dental_speciality->speciality_code_number}}">{{$dental_speciality->speciality_code_description}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" name="license_area">
                                <label class="enroll-label" id="License_number">License Number </label>
                                <input type="text" class="form-control" placeholder="123456789" name="license_number">

                            </div>
                            <div class="form-group" name="office_location_area">
                                <label class="enroll-label">Office  Number</label>
                                <input type="text" class="form-control" placeholder="0001" name="office_location_number">

                            </div>
                            <div class="form-group" name="postal_code_area">
                                <label class="enroll-label">Postal Code</label>
                                <input type="text" class="form-control" placeholder="A1A 1A1" name="postal_code">

                            </div>
                        </div>
                        <!-- this div is for case 2 when Provider exists but office does not exist -->
                        <div class="FCB-registration-wrapper provider-step1-FCB-wrapper provider-step1-case-2-div">
                            <div class="fcb-inner-wrap">
                                <div class="form enrol-login-form d-flex flex-wrap">
                                    <div class="form-group">
                                        <label class="enroll-label">License Number</label>
                                        <p id="provider-step1-case-2-license-number"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Last Name</label>
                                        <p id="provider-step1-case-2-lname"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">First Name</label>
                                        <p id="provider-step1-case-2-fname"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- this div is for case 3 and 4 when Provider dont exists  -->
                        <div class="FCB-registration-wrapper provider-step1-FCB-wrapper provider-step1-case-3-4-div">
                            <div class="fcb-inner-wrap">
                                <div class="form enrol-login-form d-flex flex-wrap">
                                    <div class="form-group">
                                        <label class="enroll-label">License Number</label>
                                        <p id="provider-step1-case-3-4-license-number"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name">
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="provider_enroll_step1_search_button" class="btn enrol-btn comm-mr-top">Search</button>
                        <button type="submit" id="provider_enroll_step1_submit_button" class="btn enrol-btn comm-mr-top">Continue</button>
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

        addPostalCodeValidation(); //calling function from common.js for validate postal code
        //===================================Frontend validation start======================================//

        if ($("#provider_enroll_step1_form").length > 0) {

            $("#provider_enroll_step1_form").validate({
                rules: {
                    provider_type: {
                        required: true,
                    },
                    dental_speciality: {
                        required: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                return true;
                            } else {
                                return false;
                            }
                        },
                    },
                    license_number: {
                        required: true,
                        
                        minlength: function(elem) {
                            $("div[name='license_area'] label.error").remove();
                            if ($("#provider_type").val() == 1) {
                                return 8;
                            } else {
                                return 1;
                            }
                        },
                        maxlength: function(elem) {
                            $("div[name='license_area'] label.error").remove();
                            if ($("#provider_type").val() == 1) {
                                return 9;
                            } else {
                                return 256;
                            }
                        },
                    },
                    office_location_number: {
                        required: function(elem) {
                            $("div[name='office_location_area'] label.error").remove();
                            return true;
                        },
                        minlength: 4,
                        maxlength: 4,
                        digits: false,
                    },
                    postal_code: {
                        required: function(elem) {
                            $("div[name='postal_code_area'] label.error").remove();
                            return true;
                        },
                        custompostalcode: true,
                    },
                    last_name: {
                        required: true,
                        pattern:/^[a-zA-Z\s-`'’]+$/,
                        //lettersonly: true,
                        maxlength: 255,
                        minlength: 2,
                    },
                    first_name: {
                        required: true,
                        pattern:/^[a-zA-Z\s-`'’]+$/,
                        //lettersonly: true,
                        maxlength: 255,
                        minlength: 2,
                    },
                },
                messages: {
                    dental_speciality: {
                        required: function(elem) {
                            return "Please select a dental specialty";
                        },
                    },
                    license_number: {
                        required: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                if($("#dental_speciality").val() == 12){
                                    return "Unique Number length must be 8 or 9 numbers as assigned by your association.";
                                }else{
                                    return "Unique Number length must be 8 or 9 numbers as assigned by CDA.";
                                } 
                            }else{
                                return "Please enter license number";
                            }
                        },
                        minlength: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                if($("#dental_speciality").val() == 12){
                                    return "Unique Number length must be 8 or 9 numbers as assigned by your association";
                                }else{
                                    return "Unique Number length must be 8 or 9 numbers as assigned by CDA";
                                }
                            }else{
                                return "Unique Number length must be 8 or 9 numbers as assigned by CDA";
                            }  
                        },
                        maxlength: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                if($("#dental_speciality").val() == 12){
                                    return "Unique Number length must be 8 or 9 numbers as assigned by your association";
                                }else{
                                    return "Unique Number length must be 8 or 9 numbers as assigned by CDA";
                                }
                            }else{
                                return "Unique Number length must be 8 or 9 numbers as assigned by CDA";
                            }  
                        },
                    },
                    office_location_number: {
                        required: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                if($("#dental_speciality").val() == 12){
                                    return "Office Number must be 4 digits";
                                }else{
                                    return "Office Number must be 4 digits as assigned by CDA";
                                }
                            }else{
                                return "Office Number length must be 4 numbers as assigned by CDA";
                            }        
                        },
                        minlength: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                if($("#dental_speciality").val() == 12){
                                    return "Office Number must be 4 digits";
                                }else{
                                    return "Office Number must be 4 digits as assigned by CDA";
                                }
                            }else{
                                return "Office Number length must be 4 numbers as assigned by CDA";
                            }        
                        },
                        maxlength: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                if($("#dental_speciality").val() == 12){
                                    return "Office Number must be 4 digits";
                                }else{
                                    return "Office Number must be 4 digits as assigned by CDA";
                                }
                            }else{
                                return "Office Number length must be 4 numbers as assigned by CDA";
                            }        
                        }
                    },
                    postal_code: {
                        required: "Please enter a valid postal code",
                        custompostalcode: "Please enter a valid postal code",
                    },
                    last_name: {
                        required: "Please enter last name!",
                    },
                    first_name: {
                        required: "Please enter first name!",
                    },
                },
                submitHandler: function(form) {

                    if ($('input[name="selected_provider_type"]').val() == "")
                        return false;

                    $('#provider_enroll_step1_submit_button').attr('disabled', 'disabled');

                    //before redirect to another page change provider select type to none so that if user come back process should start from starting
                    $("#provider_type").val("").change();
                   
                    form.submit();
                }

            })
        }


        //===================================Frontend validation end========================================//


        var provider_case_search = "{{route('provider.case.search')}}";
        var dental_provider_exist_office_exist = "{{route('provider.provider_exist.office_exist',['license_num'=>':license_num','location_num'=>':location_num','dental_speciality'=>':dental_speciality'])}}";
        var health_provider_exist_office_exist = "{{route('provider.provider_exist.office_exist',['license_num'=>':license_num','location_num'=>'NULL','postal_code'=>':postal_code'])}}";
        provider_enroll_step1_js(provider_case_search, dental_provider_exist_office_exist, health_provider_exist_office_exist);


    });
</script>
@endsection