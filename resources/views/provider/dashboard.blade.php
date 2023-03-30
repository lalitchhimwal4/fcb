<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

?>
@section('title','Dashboard-Provider')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Welcome</h4>
                       
                        <p>{{Auth::guard('provider')->user()->first_name." ".Auth::guard('provider')->user()->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-dashboard">
            <div class="container">
                <div class="enroll-content-wrap">
                    @include('showmessages')
                    <div class="row cs-form-new-membr dashboard-welcome-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">
                                <h4>Account Information</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">

                        </div>
                    </div>

                    <h5 class="enroll-cstm-form-heading"><span> Registration Information</span></h5>
                    <div class="table-responsive" id="family-scrollbar">
                        <table class="table family-table dashboard-table" id="scroll-bar-custom">
                            <thead>
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Registration Method</th>
                                    <th>Account Status</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{Auth::guard('provider')->user()->registration_id}}</td>
                                    <td>{{Auth::guard('provider')->user()->registration_method}}</td>
                                    <td class="edit-td">
                                        <?php
                                        $account_statuses = get_default_values_from_mastertable('providers', 'account_status');
                                        if ($account_statuses != 0)
                                            echo $account_statuses[Auth::guard('provider')->user()->account_status];
                                        else
                                            echo "-";
                                        ?>

                                        </a>
                                    </td>
                                    <td class="edit-td">********<a href="{{route('provider.changepassword')}}"><i class="fas fa-edit"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span> Account Information</span></h5>
                    <div class="table-responsive" id="family-scrollbar">
                        <table class="table family-table dashboard-table">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Specialty</th>
                                    <th>License Number</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="edit-td">{{Auth::guard('provider')->user()->first_name}}</td>
                                    <td class="edit-td">{{Auth::guard('provider')->user()->last_name}}</td>
                                    <?php $assigning_authority_number = Auth::guard('provider')->user()->assigning_authority_number; ?>
                                    <td><?php if($assigning_authority_number != 1){
                                        echo DB::table('assigning_authorities')->where('assigning_authority_number', Auth::guard('provider')->user()->assigning_authority_number)->first()->assigning_authority_code_description; 
                                    }
                                    else{
                                        $data = DB::table('speciality_codes')->where('speciality_code_number', Auth::guard('provider')->user()->speciality_code_number)->first();
                                        echo $data->speciality_code_description;
                                    }
                                    ?>
                                    </td>
                                    <td>{{Auth::guard('provider')->user()->license_number}}</td>
                                    <td><a href="{{route('provider.editdetails')}}"><i class="fas fa-edit"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span>Account Management</span></h5>
                    <div class="row cs-form-new-membr view-edit-cstm-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap view-ed-cstm">
                                <a href="{{route('provider.viewoffices')}}" class="enrol-btn family-bottom-btn"> View Registered Office <i class="fas fa-arrow-right"></i></a>

                            </div>
                        </div>
                    </div>
                    <h5 class="enroll-cstm-form-heading claim-heading"><span>Treatment History</span></h5>
                    <div class="row cs-form-new-membr view-edit-cstm-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap view-ed-cstm">
                            <!-- <a href="{{route('provider.view_claims')}}" class="enrol-btn family-bottom-btn"> -->
                                <a href="#" class="enrol-btn family-bottom-btn"> View List of Treatments Performed <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php
                        $account_statuses = get_default_values_from_mastertable('providers', 'account_status');
                        if ($account_statuses != 0){
                            $providerOffice = Session::get('providerOffice');
                            $provider_system_id = Auth::guard('provider')->user()->id;
                            $office_enrollment_status = DB::table('provider_office_enrollments')->where(['provider_system_id' => $provider_system_id])->where(['office_system_id' => $providerOffice])->pluck('office_status')->first();
                          
                            $account_status = Auth::guard('provider')->user()->account_status;
                        }
                        if($office_enrollment_status !=2 && $account_status != 2 ){
                            $assigning_authority_number = Auth::guard('provider')->user()->assigning_authority_number;
                        ?>
                        <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                            <a href="{{route('provider.claim_step1')}}" class="enrol-btn"> Submit Treatments</a>
                            <a href="{{route('provider.claim_step1', ['request_type' => 'estimate'])}}" class="enrol-btn"> Submit A Treatment Estimate</a>
                            @if($assigning_authority_number == '1')
                                <a href="{{route('provider.procedurecodefinder')}}" class="enrol-btn">Procedure Code Finder</a>
                            @endif    
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- The Modal (Password Change alert) -->
<div class="modal fade" id="changepasswordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notice</h5>

                <button type="button" class="close" onClick=changelaterpassword("{{route('provider.update.password.alert')}}") aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Please change your system generated password to make your account more secure.
            </div>
            <div class="modal-footer">
                <button type="button" onClick=changelaterpassword("{{route('provider.update.password.alert')}}") class="btn enrol-btn">I will change later</button>
                <button type="button" onClick=changenowpassword("{{route('provider.update.password.alert')}}","{{route('provider.changepassword')}}") class="btn enrol-btn">Change Now</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<!-- modal end here -->

<!-- The Modal (Password Change alert) -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="changedashboardmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 0rem 1rem;">
                <h5 class="modal-title">Notice</h5>
            </div>
            <div class="modal-body">
                <?php 
                    $office_id = Session::get('providerOffice');
                    $office_data = DB::table('provider_offices')->where('id',$office_id)->first();            
                    $provider_type = Auth::guard('provider')->user()->assigning_authority_number;
                    if($provider_type == 1){
                        echo "Welcome and thank you for logging into the FCB Provider Portal. You are almost done with your enrolment. Please add or correct the following info to include a valid 8 or 9 position Unique ID # and office location number as issued by the CDA.";
                    }else{
                        echo "Welcome and thank you for logging into the FCB Provider Portal. You are almost done with your enrolment. Please add or correct the following info to include a license number as issued by your association and/or college.";
                    }
                   
                ?>
                <h5 class="enroll-cstm-form-heading" style="margin-bottom: 10px;"><span> Account information</span></h5>
                <form action="{{route('provider.savedetailsPopups')}}" method="post" id="edit_provider_details">
                    <div class="container">
                        @csrf
                        @include('showmessages')
                        <?php $provider = Auth::guard('provider')->user(); ?>
                        
                        <div class="row cs-form-new-membr dashboard-welcome-wrap">
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Registration Number</b>
                                <input type="text" class="form-control" id="registration_id" value="{{$provider->registration_id}}" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <div class="form-group" name="license_area">
                                    <b>License Number</b>
                                  
                                    <input type="text" class="form-control" id="license_number" name="license_number" value="{{$provider->license_number}}" required <?php if($provider->license_number != $provider->registration_id){ echo "disabled";} ?>> 
                                </div>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">    
                                <b>Specialty</b>
                                <?php
                                if($provider->assigning_authority_number == 1){
                                    $data = DB::table('speciality_codes')->where('speciality_code_number', Auth::guard('provider')->user()->speciality_code_number)->first();
                                    $provider_type = $data->speciality_code_description; 
                                }else{
                                    $provider_type = DB::table('assigning_authorities')->where('assigning_authority_number', $provider->assigning_authority_number)->first()->assigning_authority_code_description; 
                                }
                                ?>
                                <input type="hidden" class="form-control" id="provider_type" value="{{$provider->assigning_authority_number}}">
                                <input type="text" class="form-control" value="{{$provider_type}}" disabled>
                               
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>First Name</b>
                                <input type="text" class="form-control" name="first_name" value="{{$provider->first_name}}" name="first_name" disabled>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Last Name</b>
                                <input type="text" class="form-control" name="last_name" value="{{$provider->last_name}}" name="last_name" disabled>
                            </div> 

                            
                        </div> 
                        <h5 class="enroll-cstm-form-heading" style="margin-bottom: 10px;"><span> Registered office</span></h5>
                        <div class="row cs-form-new-membr dashboard-welcome-wrap">  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <div class="form-group" name="license_area">
                                    <b>Location Number</b>
                                    
                                    <input type="text" class="form-control" id="location_number" name="location_number" value="{{$office_data->location_number}}" required <?php if($office_data->location_number != ''){ echo "disabled";} ?>> 
                                </div>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Clinic Name</b>
                                <input type="text" class="form-control" name="clinic_name" value="{{$office_data->clinic_name}}" disabled>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Address</b>
                                <input type="text" class="form-control" name="address1" value="{{$office_data->address1}}" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>City</b>
                                <input type="text" class="form-control" name="city" value="{{$office_data->city}}" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Postal Code</b>
                                <input type="text" class="form-control" name="postal_code" value="{{$office_data->postal_code}}" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Phone</b>
                                <input type="text" class="form-control" name="telephone" value="{{$office_data->telephone}}" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Fax</b>
                                <input type="text" class="form-control" name="fax" value="{{$office_data->fax}}" disabled>
                            </div> 
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Email</b>
                                <input type="text" class="form-control" name="email" value="{{$office_data->email}}" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Website</b>
                                <input type="text" class="form-control" name="website" value="{{$office_data->website}}" disabled>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>social media</b>
                                <?php
                                foreach (unserialize($office_data->social_media) as $social) {
                                    $social;
                                }
                                ?>
                                <input type="text" class="form-control" name="social_media" value="{{$social}}" disabled>
                            </div>   
                        </div>    
                        <div class="row mt-2">   
                            <div class="col-lg-9 col-lg-9 col-sm-12 col-12">
                                <button type="submit" class="btn enrol-btn" id="Update_provider">Update</button>
                            </div> 
                            
                            <div class="col-lg-3 col-lg-3 col-sm-12 col-12"> 
                                
                                <a href="{{route('provider.logout')}}" class="btn enrol-btn"> Cancel</a>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end here -->

@endsection
@section('footerjs')
<style>
    @media (min-width: 576px){
        .modal-dialog {
            max-width: 874px;
            margin: 1.75rem auto;
        }
    }

</style>
<script>
    $(document).ready(function() {
        $("#edit_provider_details").validate({
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
                messages: {
                    license_number: {
                        required: function(elem) {
                            if ($("#provider_type").val() == 1) {
                                return "Unique Number length must be 8 numbers as assigned by CDA.";
                            } else {
                                return "Please enter license number";
                            }
                        },
                        minlength: "Unique Number length must be 8 or 9 numbers as assigned by CDA",
                        maxlength: "Unique Number length must be 8 or 9 numbers as assigned by CDA",
                    },
                },    
            },
            
        });
    })  
</script>      
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        }
    });
    $(document).ready(function() {
        //checking password alert exists for user or not
        showpasswordalert(<?php echo Auth::guard('provider')->user()->password_change_alert; ?>); //calling function from bladefiles.js  
        //checking provider alert exists for user or not
        showdashboardalert(<?php 
        $office_id = Session::get('providerOffice');
        $location_number = DB::table('provider_offices')->where('id',$office_id)->pluck('location_number')->first();
        $license_num=Auth::guard('provider')->user()->license_number; 
        $registration_id=Auth::guard('provider')->user()->registration_id;
        if($license_num == $registration_id || $location_number == ''){
            echo "0";
        }else{
            echo "1";
        }
        ?>); 
     
    })

    function showdashboardalert(showalertvalue) {
        if (showalertvalue == 0) {
            $("#changedashboardmodal").modal("show");
            $("#Update_provider").hide();
        }
    }

    function closedashboardpopup(){
        $("#changedashboardmodal").modal("hide");
    }

    $('#license_number').keyup(function(){
        var registration_id = $('#registration_id').val();
        var license_number = $('#license_number').val();
        var location_number = $('#location_number').val();
        if(license_number != registration_id && location_number != ''){
            $('#Update_provider').show();
        }else{
            $('#Update_provider').hide();
        }
    });

    $('#location_number').keyup(function(){
        var registration_id = $('#registration_id').val();
        var license_number = $('#license_number').val();
        var location_number = $('#location_number').val();
        if(license_number != registration_id && location_number != ''){
            $('#Update_provider').show();
        }else{
            $('#Update_provider').hide();
        }
    });
    
</script>
@endsection