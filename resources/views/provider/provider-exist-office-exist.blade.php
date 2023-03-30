<?php

use Illuminate\Support\Facades\DB;

?>
@section('title','Provider-Office Exist')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Welcome</h4>
                        <p>{{$provider->first_name}} {{$provider->last_name}}</p>

                    </div>
                    <div class="family-buttons d-flex align-items-center">
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-content-wrap">
        <form action="{{route('provider.save.provider_exist.postal_exist_health')}}" method="POST" id="provider_notexist_office_exist_health">
            <div class="container">
                <div class="enroll-content-wrap">
                    @include('showmessages')
                    @csrf
                    <h4>Provider Search</h4>
                    <input type="hidden" name="selected_office" value="">
                    <input type="hidden" name="last_name" value="{{$provider->last_name}}">
                    <input type="hidden" name="first_name" value="{{$provider->first_name}}">
                    
                    <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                        <div class="form-group">
                            <label class="enroll-label">Provider Type </label>
                            <?php $provider_types = DB::table('assigning_authorities')->get(); ?>
                            <div class="select-wrap">
                                <select class="form-control" id="provider_type" name="provider_type" disabled="disabled">
                                    <option value="">Select</option>
                                    @foreach($provider_types as $provider_type)
                                    <option value="{{$provider_type->assigning_authority_number}}" @if($provider_type->assigning_authority_number==$provider->assigning_authority_number) selected="selected" @endif>{{$provider_type->assigning_authority_code_description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if($provider->assigning_authority_number==1)
                        <div class="form-group" name="dental_speciality_area">
                            <label class="enroll-label">Dental Speciality</label>
                            <?php $speciality = DB::table('speciality_codes')->where('speciality_code_number', $provider->speciality_code_number)->first(); ?>
                            <input type="text" class="form-control" placeholder="Dental Speciality" value="{{$speciality ? $speciality->speciality_code_description : ''}}" disabled="disabled">
                        </div>
                        @endif
                        <div class="form-group" name="license_area">
                            <label class="enroll-label">License Number </label>
                            <input type="hidden" class="form-control" placeholder="123456789" name="license_number" value="{{$provider->license_number}}">
                            <input type="text" class="form-control" placeholder="123456789" name="" value="{{$provider->license_number}}" disabled="disabled">

                        </div>

                        @if($provider->assigning_authority_number==1)
                        <div class="form-group" name="office_location_area">
                            <label class="enroll-label">Office Number</label>
                            <input type="hidden" class="form-control" placeholder="0001" name="" value="{{$office->location_number}}">
                            <input type="text" class="form-control" placeholder="0001" name="" value="{{$office->location_number}}" disabled="disabled">
                        </div>
                        @else
                        <div class="form-group">
                            <label class="enroll-label">Postal Code</label>
                            <input type="text" class="form-control postalcode" value="{{$office->postal_code}}">
                        </div>
                        @endif
                    </div>
                    <?php 
                        if(empty($provider_office_enroll)){
                            echo '<p class="dental-p">Provider and Office found, please continue to complete enrollment</p>';
                        }else{
                            echo '<p class="dental-p">Provider and office previously enrolled, please select Login to login to your dashboard</p>';
                        }
                    ?>
                    

                    <div class="provider-profile-wrapper FCB-dental-wrapper only-dental-FCB">
                        <div class="form enrol-login-form d-flex flex-wrap">
                            <div class="form-group">
                                <label class="enroll-label">License Number </label>
                                <p>{{$provider->license_number}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Last Name</label>
                                <p>{{$provider->last_name}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">First Name</label>
                                <p>{{$provider->first_name}}</p>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Provider Type</label>
                                @foreach($provider_types as $provider_type)
                                @if($provider_type->assigning_authority_number==$provider->assigning_authority_number)
                                <p>{{$provider_type->assigning_authority_code_description}} </p>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap">
                            @if($provider->assigning_authority_number==1)
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
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap">
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
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap">
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
                    <!-- <a href="{{route('provider.login')}}" class="btn enrol-btn comm-mr-top">Login</a> -->
                    @if(empty($provider_office_enroll))
                        <div class="sel-btn-wrap">
                            <input type="hidden" class="form-control"  name="selected_office" value="{{$office->id}}">
                           
                        </div><br> 
                        <div class="cont-btn-wrp">
                            <button type="submit" id="provider_notexist_office_exist_health_submit_button" class="btn enrol-btn comm-mr-top">Continue</button>
                        </div>  
                    @endif   
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</section>
<script>
function add_office_id(office_id) {
    $('input[name="selected_office"]').val("");
    if ($("#" + office_id).text() == "Select") {
        $("#" + office_id).addClass('selected-office');
        $("#" + office_id).text("Selected");
        $("#" + office_id).css("backgroundColor", "black");
    } else {
        $("#" + office_id).removeClass('selected-office');
        $("#" + office_id).text("Select");
        $("#" + office_id).css("backgroundColor", "#e63b2b");
        $("#continue_btn").hide();
    }
    var selectedoffices = document.querySelectorAll(".selected-office");
    for (var i = 0; i < selectedoffices.length; i++) {
        if (selectedoffices[i].id != office_id) {
            $("#" + selectedoffices[i].id).removeClass('selected-office');
            $("#" + selectedoffices[i].id).text("Select");
            $("#" + selectedoffices[i].id).css("backgroundColor", "#e63b2b");
        }

    }

    if ((document.querySelectorAll(".selected-office")).length == 1) {
        $('input[name="selected_office"]').val(office_id);
        $(".selected-offices-error").hide();
        $("#continue_btn").show();
    }
}
function box_office_id(office_id) {
    if ($('#'+office_id).is(':checked')) {
        $('#'+office_id).siblings('label').html('Selected');
        $('input[name="selected_office"]').val(+ office_id);
        $(".selected-offices-error").hide();
    } else {
        $('#'+office_id).siblings('label').html('Select');
        $('input[name="selected_office"]').val('');
    }
}
</script>
@endsection