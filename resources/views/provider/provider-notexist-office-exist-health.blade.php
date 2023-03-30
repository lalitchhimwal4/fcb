<?php

use Illuminate\Support\Facades\DB;

?>
@section('title','Provider-NotExist-Office-Exist-Health')
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
            <form action="{{route('provider.save.provider_notexist.office_exist_health')}}" method="POST" id="provider_notexist_office_exist_health">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        @csrf
                        <input type="hidden" name="selected_office" value="">
                        <input type="hidden" name="last_name" value="{{$lname}}">
                        <input type="hidden" name="first_name" value="{{$fname}}">
                        <h4>Provider Search</h4>
                        <div class="form enrol-login-form d-flex flex-wrap provider_enroll_step1_form_fields">
                            <div class="form-group">
                                <label class="enroll-label">Provider Type </label>
                                <?php $provider_types = DB::table('assigning_authorities')->get(); ?>
                                <input type="hidden" class="form-control" placeholder="123456789" name="provider_type" value="{{$selected_provider_type}}">
                                <div class="select-wrap">
                                    <select class="form-control" id="provider_type" disabled="disabled" >
                                        <option value="">Select</option>
                                        @foreach($provider_types as $provider_type)
                                        <option value="{{$provider_type->assigning_authority_number}}" @if($provider_type->assigning_authority_number==$selected_provider_type) selected="selected" @endif>{{$provider_type->assigning_authority_code_description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" name="license_area">
                                <label class="enroll-label">License Number </label>
                                <input type="hidden" class="form-control" placeholder="123456789" name="license_number" value="{{$license_num}}">
                                <input type="text" class="form-control" placeholder="123456789" name="" value="{{$license_num}}" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Postal Code</label>
                                <input type="hidden" class="form-control" placeholder="A1A 1A1" value="{{$postal_code}}">
                                <input type="text" class="form-control" placeholder="A1A 1A1" value="{{$postal_code}}" disabled="disabled">
                            </div>
                        </div>
                        <p class="dental-p">Multiple Offices found. Please select existing clinic or add a new clinic</p>

                        @foreach($offices as $office)
                        <div class="provider-profile-wrapper FCB-dental-wrapper only-dental-FCB Provider-NotExist-Office-Exist-Health-wrapper">
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Office Number </label>
                                    <p>{{$office->location_number}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Clinic Name</label>
                                    <p>{{$office->clinic_name}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Address 1</label>
                                    <p>{{$office->address1}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Address 2</label>
                                    <p><?php echo ($office->address2) ? $office->address2 : '-'; ?></p>
                                </div>
                                <!--  <div class="form-group">
                                    <label class="enroll-label">Website</label>
                                    <p>{{$office->website}}</p>
                                </div> -->

                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <!--  <div class="form-group">
                                    <label class="enroll-label">Address 2</label>
                                    <p><?php echo ($office->address2) ? $office->address2 : '-'; ?></p>
                                </div> -->
                                <div class="form-group">
                                    <label class="enroll-label">City</label>
                                    <p>{{$office->city}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Postal Code</label>
                                    <p>{{$office->postal_code}}</p>
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
                                    <label class="enroll-label">Telephone</label>
                                    <p>{{$office->telephone}}</p>
                                </div>

                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <!--  <div class="form-group">
                                    <label class="enroll-label">Phone Number</label>
                                    <p>{{$office->telephone}}</p>
                                </div> -->
                                <!--  <div class="form-group">
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
                                </div> -->
                                <!-- <div class="sel-btn-wrap">
                                    
                                    <input type="checkbox" id="{{$office->id}}" onClick="box_office_id(this.id);" value="{{$office->id}}" name="office_id[]" /> <label for="boxid">Select</label>
                                </div> -->
                                
                                <div class="sel-btn-wrap">
                                    
                                    <button type="button" id="{{$office->id}}" onClick="add_office_id(this.id);" class="btn enrol-btn comm-mr-top">Select</button>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- <label class="error selected-offices-error">Please select one Office to continue</label> -->
                        
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">
                                <div class="cont-btn-wrp" style="float: right;">
                                    <span><a class="clinic-not-found btn enrol-btn comm-mr-top" style="color:#fff;" href="{{route('provider.healthclinicnotfound',['provider_type'=>$selected_provider_type,'license_num'=>$license_num,'location_num'=>'NULL','postal_code'=>$postal_code,'fname'=>$fname,'lname'=>$lname])}}">Add a New Clinic</a></span>
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

                        <div class="cont-btn-wrp">
                            <button type="submit" id="provider_notexist_office_exist_health_submit_button" class="btn enrol-btn comm-mr-top">Continue</button>
                            <!-- <span><p class="clinic-not-found" >Applicable Clinic Not Found</p></span> -->
                        </div>
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
        }
    }

    // $(document).ready(function() {
    //     $(".selected-offices-error").hide();

    //     $("#provider_notexist_office_exist_health_submit_button").click(function() {
    //         $(".selected-offices-error").hide();
    //         if ($('input[name="selected_office"]').val() == "") {
    //             $(".selected-offices-error").show();
    //             return false;
    //         }
    //         $('#provider_notexist_office_exist_health_submit_button').attr('disabled', 'disabled');
    //         $("#provider_notexist_office_exist_health").submit();


    //     });

    // }); 
</script>
<script>
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