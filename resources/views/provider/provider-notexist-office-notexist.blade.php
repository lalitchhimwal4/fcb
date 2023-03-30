<?php

use Illuminate\Support\Facades\DB;

?>
@section('title','Provider-NotExist-Office-NotExist')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header">
            <h4>Provider Enrollment</h4>
            <div class="head-row">
                <div class="head-col passed">
                    <span></span>
                    <h6> Profile </h6>
                </div>
                <div class="head-col active">
                    <span></span>
                    <h6> offices </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Confirmation </h6>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-content-wrap">
            <form action="{{route('provider.save.provider_notexist.office_notexist')}}" method="POST" id="provider_notexist_office_notexist">
                <input type="hidden" name="provider_type" value="{{$selected_provider_type}}">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        @csrf
                        <h4>Provider Search</h4>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group">
                                <label class="enroll-label">Provider Type </label>
                                <?php $provider_types = DB::table('assigning_authorities')->get(); ?>
                                <div class="select-wrap">
                                    <select class="form-control" id="provider_type" disabled="disabled">
                                        <option value="">Select</option>
                                        @foreach($provider_types as $provider_type)
                                        <option value="{{$provider_type->assigning_authority_number}}" @if($provider_type->assigning_authority_number==$selected_provider_type) selected="selected" @endif>{{$provider_type->assigning_authority_code_description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($selected_provider_type==1)
                            <div class="form-group" name="dental_speciality_area">
                                <label class="enroll-label">Dental Speciality</label>
                                <input type="text" class="form-control" placeholder="" value="{{$speciality_description}}" disabled="disabled">
                            </div>
                            @endif
                            <div class="form-group" name="license_area">
                                <label class="enroll-label">License Number </label>
                                <input type="text" class="form-control" placeholder="" value="{{$license_num}}" disabled="disabled">
                            </div>
                            @if($selected_provider_type==1)
                            <div class="form-group" name="office_location_area">
                                <label class="enroll-label">Office Number</label>
                                <input type="text" class="form-control" placeholder="" value="{{$office_location_num}}" disabled="disabled">
                            </div>
                            @else
                            <div class="form-group">
                                <label class="enroll-label">Postal Code</label>
                                <input type="text" class="form-control postalcode" value="{{$postal_code}}" disabled="disabled">
                            </div>
                            @endif
                        </div>
                        <p class="dental-p">Provider and Office enrollment not found, please fill form below to complete enrollment</p>
                        <div class="provider-profile-wrapper FCB-dental-wrapper">
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">License Number</label>
                                    <input type="text" class="form-control" placeholder="" value="{{$license_num}}" disabled="disabled">
                                    <input type="hidden" class="form-control" name="license_number" placeholder="" value="{{$license_num}}">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Last Name</label>
                                    <input type="hidden" class="form-control" name="last_name" placeholder="" value="{{$lname}}">
                                    <input type="text" class="form-control" name="last_name" placeholder="" value="{{$lname}}" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">First Name</label>
                                    <input type="hidden" class="form-control" name="first_name" placeholder="" value="{{$fname}}">
                                    <input type="text" class="form-control" name="first_name" placeholder="" value="{{$fname}}" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Provider Type</label>
                                    <div class="select-wrap">
                                        <select class="form-control" id="provider_type" name="provider_type" disabled="disabled">
                                            <option value="">Select</option>
                                            @foreach($provider_types as $provider_type)
                                            <option value="{{$provider_type->assigning_authority_number}}" @if($provider_type->assigning_authority_number==$selected_provider_type) selected="selected" @endif>{{$provider_type->assigning_authority_code_description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                @if($selected_provider_type==1)
                                <div class="form-group" name="dental_speciality_area">
                                    <label class="enroll-label">Dental Specialty </label>
                                    <?php
                                    
                                    //$dental_speciality = DB::table('speciality_codes')->where('speciality_code_number',$dental_speciality)->pluck('speciality_code_description')->get(); ?>
                                    <input type="text" class="form-control" placeholder="Dental Speciality" value="{{$speciality_description}}" disabled="disabled">
                                    <input type="hidden" class="form-control" placeholder="dental speciality"  name="dental_speciality" value="{{$dental_speciality}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Office Number</label>
                                    <input type="hidden" class="form-control" name="office_number" placeholder="1234" value="{{$office_location_num}}">
                                    <input type="text" class="form-control"  placeholder="" value="{{$office_location_num}}" disabled="disabled">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="enroll-label">Clinic Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="clinic_name" placeholder="" value="{{old('clinic_name')}}">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Website</label>
                                    <input type="text" class="form-control" name="website" placeholder="" value="{{old('website')}}">
                                </div>
                                <div class="" id="latitudeArea">
                                    <label class="enroll-label">Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control">
                                </div>

                                <div class="" id="longtitudeArea">
                                    <label class="enroll-label">Longitude</label>
                                    <input type="text" name="longitude" id="longitude" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Address 1<sup>*</sup></label>
                                    <input type="text" class="form-control" name="address1" id="address1" placeholder="" value="{{old('address1')}}">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Address 2 </label>
                                    <input type="text" class="form-control" name="address2" placeholder="" value="{{old('address2')}}">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">City<sup>*</sup></label>
                                    <input type="text" class="form-control" name="city" placeholder="" value="{{old('city')}}">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Province<sup>*</sup></label>
                                    <div class="select-wrap">
                                        <select class="form-control" name="province" id="province">
                                            <option value="">Select an option</option>
                                            <option value="NS" {{ (old("province") == "NS" ? "selected":"") }}>Nova Scotia</option>
                                            <option value="PE" {{ (old("province") == "PE" ? "selected":"") }}>Prince Edward Island</option>
                                            <option value="NL" {{ (old("province") == "NL" ? "selected":"") }}>Newfoundland and Labrador</option>
                                            <option value="NB" {{ (old("province") == "NB" ? "selected":"") }}>New Brunswick</option>
                                            <option value="QC" {{ (old("province") == "QC" ? "selected":"") }}>Quebec</option>
                                            <option value="ON" {{ (old("province") == "ON" ? "selected":"") }}>Ontario</option>
                                            <option value="MB" {{ (old("province") == "MB" ? "selected":"") }}>Manitoba</option>
                                            <option value="SK" {{ (old("province") == "SK" ? "selected":"") }}>Saskatchewan</option>
                                            <option value="AB" {{ (old("province") == "AB" ? "selected":"") }}>Alberta</option>
                                            <option value="BC" {{ (old("province") == "BC" ? "selected":"") }}>British Columbia</option>
                                            <option value="YT" {{ (old("province") == "YT" ? "selected":"") }}>Yukon</option>
                                            <option value="NT" {{ (old("province") == "NT" ? "selected":"") }}>Northwest Territories</option>
                                            <option value="NU" {{ (old("province") == "NU" ? "selected":"") }}>Nunavut</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Postal Code<sup>*</sup></label>
                                    <input type="hidden"  class="form-control postalcode" value="" name="postal_code" placeholder="1A1 A1A">
                                    <input type="text" id="zipCode" class="form-control postalcode" value="{{($postal_code != 'NULL')?$postal_code:old('postal_code')}}"  placeholder="1A1 A1A" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Phone Number<sup>*</sup></label>
                                    <input type="text" class="form-control" name="phone_number" placeholder="" value="{{old('phone_number')}}">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Fax</label>
                                    <input type="text" class="form-control" name="fax" placeholder="" value="{{old('fax')}}">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Email<sup>*</sup></label>
                                    <input type="text" class="form-control" name="email" placeholder="" value="{{old('email')}}">
                                </div>
                                <div class="form-group social_media_group_wrapper">
                                    <label class="enroll-label">Social Media</label>
                                    <div class="social_media_group">
                                        <input type="text" class="form-control" name="social_media[]" value="{{old('social_media.0')}}" placeholder="">
                                    </div>
                                    <?php
                                    if (old('social_media')) {
                                        $old_social_group_unique_id = str_replace(" ", "", time());
                                        for ($i = 1; $i < count(old('social_media')); $i++) {

                                    ?>
                                            <div id="{{$old_social_group_unique_id}}" class="social_media_group" style="margin-top:10px;"><input type="text" class="form-control" name="social_media[]" value="{{old('social_media.'.$i)}}" placeholder=""><i onclick=delete_social_account_field(<?php echo $old_social_group_unique_id ?>) class="fas fa-minus-circle"></i></div>
                                    <?php
                                            $old_social_group_unique_id++;
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="add-another-btn-wrap">
                                <a href="javascript:void(0);" onclick="add_new_social_account_field()" class="add-another-btn">+Add another Social Media account</a>
                            </div>
                        </div>

                        <div class="form-group terms-conditions-container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms_and_conditions" id="terms_and_conditions">
                                <label class="form-check-label" for="terms_and_conditions">
                                    By checking this box you accept that you have read, understood and accepted the <a href="{{$terms_condition_link ?? ''}}" class="text-red popup-btn">Program Guidelines</a> presented herein
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn enrol-btn comm-mr-top">Continue</button>
                    </div>
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

        if ($("#provider_notexist_office_notexist").length > 0) {

            $("#provider_notexist_office_notexist").validate({

                rules: {

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
                    last_name: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                        minlength: 2,
                    },
                    first_name: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                        minlength: 2,
                    },
                    provider_type: {
                        required: true,
                    },
                    office_number: {
                        digits: false,
                        required: true,
                        minlength: 4,
                        maxlength: 4,
                    },
                    postal_code: {
                        required: true,
                        custompostalcode: true,
                    },
                    clinic_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 256,

                    },
                    address1: {
                        required: true,
                    },
                    latitude: {
                        required: true,
                    },
                    longitude: {
                        required: true,
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
                    phone_number: {
                        required: true,
                        pattern:/^\d{10}$/,
                        customtelephone: true,
                    },
                    email: {
                        required: true,
                        customemail: true,
                    },
                    terms_and_conditions: {
                        required: true,
                    },
                },
                messages: {

                    license_number: {
                        required: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                return "License Number length must be 8 or 9 numbers as assigned by CDA";
                            } else {
                                return "Please enter license number";
                            }
                        },
                        minlength: "License Number length must be 8 or 9 numbers as assigned by CDA",
                        maxlength: "License Number length must be 8 or 9 numbers as assigned by CDA",
                    },
                    latitude: {

                        required: "Please select valid location",
                    },
                    longitude: {

                        required: "Please select valid location",
                    },
                    address1: {

                        required: "Please select valid location",
                    },
                },
                groups: {
                    location: "latitude longitude address1"
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "latitude" || element.attr("name") == "longitude" || element.attr("name") == "address1")
                        error.insertAfter("#address1");
                    else
                        error.insertAfter(element);
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
        console.log($("#" + social_group_unique_id));
        $("#" + social_group_unique_id).remove();

    }

    //Address1 autocomplete functionality
    Autocomplete_Address_for_provider_office("address1"); //function defined in bladefiles.js
</script>
@endsection