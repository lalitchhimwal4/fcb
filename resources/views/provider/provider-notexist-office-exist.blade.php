<?php

use Illuminate\Support\Facades\DB;

?>
@section('title','Provider-NotExist-Office-Exist')
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
            <form action="{{route('provider.save.provider_notexist.office_exist')}}" method="POST" id="provider_notexist_office_exist">
                <input type="hidden" name="provider_type" value="{{$selected_provider_type}}">
                <div class="container">
                    <div class="enroll-content-wrap">
                        
                        @include('showmessages')
                        @csrf
                        <input type="hidden" name="email" value="{{$office->email}}">
                        <input type="hidden" name="office_id" value="{{$office->id}}">
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
                            <div class="form-group" name="dental_speciality_area">
                                <label class="enroll-label">Dental Speciality</label>
                                <input type="text" class="form-control" placeholder="Dental Speciality" value="{{$speciality_description}}" disabled="disabled">
                            </div>
                            <div class="form-group" name="license_area">
                                <label class="enroll-label">License Number </label>
                                <input type="text" class="form-control" placeholder="123456789" value="{{$license_num}}" disabled="disabled">
                            </div>
                            <div class="form-group" name="office_location_area">
                                <label class="enroll-label">Office Number</label>
                                <input type="text" class="form-control" placeholder="0001" value="{{$office->location_number}}" disabled="disabled">
                            </div>
                        </div>
                        <p class="dental-p">Provider not found, select continue to enroll Provider</p>
                        <div class="provider-profile-wrapper FCB-dental-wrapper only-dental-FCB">
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">License Number</label>
                                    <input type="hidden" class="form-control" name="license_number" placeholder="12345678" value="{{$license_num}}">
                                    <input type="text" class="form-control" name="license_number" placeholder="12345678" value="{{$license_num}}" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Last Name</label>
                                    <input type="hidden" class="form-control" name="last_name" placeholder="Last Name" value={{$lname}}>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value='{{$lname}}' disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">First Name</label>
                                    <input type="hidden" class="form-control" name="first_name" placeholder="First Name" value="{{$fname}}">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$fname}}" disabled="disabled">
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
                                @if($selected_provider_type==1)
                                <div class="form-group" name="dental_speciality_area">
                                    <label class="enroll-label">Dental Specialty </label>
                                    <?php
                                    $dental_specialties = DB::table('speciality_codes')->get(); ?>
                                    <input type="hidden" class="form-control" name="dental_speciality" placeholder="{{$speciality_description}}" value="{{$dental_speciality}}">
                                    <div class="select-wrap">
                                        <select class="form-control" id="dental_speciality" name="dental_speciality" disabled="disabled" >
                                            <option value="">Select</option>
                                            @foreach($dental_specialties as $speciality)
                                            <option value="{{$speciality->speciality_code_number}}" @if($speciality->speciality_code_number == $dental_speciality) selected="selected" @endif>{{$speciality->speciality_code_description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Office Number </label>
                                    <p>{{$office->location_number}}</p>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="enroll-label">Clinic Name</label>
                                    <p>{{$office->clinic_name}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Website</label>
                                    <p>{{$office->website}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Address 1</label>
                                    <p>{{$office->address1}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Address 2</label>
                                    <p><?php echo ($office->address2) ? $office->address2 : '-'; ?></p>
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
                                        ?></p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Postal Code</label>
                                    <p>{{$office->postal_code}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Phone Number</label>
                                    <p>{{$office->telephone}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Fax</label>
                                    <p>{{$office->fax}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Email</label>
                                    <p>{{$office->email}}</p>
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
            </form>
        </div>
    </div>
    </div>
</section>
@endsection
@section('footerjs')
<script>
    $(document).ready(function() {

        if ($("#provider_notexist_office_exist").length > 0) {

            $("#provider_notexist_office_exist").validate({

                rules: {
                    license_number: {
                        required: true,
                        minlength: 8,
                        maxlength: 9,
                    },
                    last_name: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                        minlength: 3,
                    },
                    first_name: {
                        required: true,
                        lettersonly: true,
                        maxlength: 255,
                        minlength: 3,
                    },
                    provider_type: {
                        required: true,
                        digits: true,
                    },
                    terms_and_conditions: {
                        required: true,
                    },
                },
                messages: {

                    provider_type: {
                        digits: 'Provider type value is invalid',
                    },

                },

            })
        }

    })
</script>
@endsection