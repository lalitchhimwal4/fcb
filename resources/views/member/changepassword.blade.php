@section('title','Member-Change Password')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Change Password</h4>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer">
            <div class="container">
                <div class="enroll-content-wrap change-pass-cstm-wrap">
                    <form action="{{route('member.updatepassword')}}" name="member_change_password_form" id="member_change_password_form" method="post" class="marginform">
                        @csrf
                        @include('showmessages')
                        <div class="row cs-form-new-membr">
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card d-flex align-items-center flex-wrap">
                                    <h4>Change Password</h4>
                                </div>
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex">
                            <div class="form-group password-eye-container">
                                <label class="enroll-label">Current Password</label>
                                <span>
                                    <input type="password" class="form-control" name="current_password">
                                     <i class="fas fa-eye-slash password-toggle-eye" onclick="toggle_password_visibility(event.target,'current_password')"></i>
                                </span>
                            </div>
                            <div class="form-group password-eye-container">
                                <label class="enroll-label">New Password</label>
                                <span>
                                    <input type="password" class="form-control" name="new_password" id="new_password">
                                     <i class="fas fa-eye-slash password-toggle-eye" onclick="toggle_password_visibility(event.target,'new_password')"></i>
                                </span>
                            </div>
                            <div class="form-group password-eye-container last-password-eye">
                                <label class="enroll-label">Confirm Password</label>
                                <span>    
                                    <input type="password" class="form-control" name="confirm_password">
                                    <i class="fas fa-eye-slash password-toggle-eye" onclick="toggle_password_visibility(event.target,'confirm_password')"></i>
                                </span>

                            </div>
                        </div>
                     
                        <div class="row cs-form-new-membr">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">
                              
                            </div>
                        </div>

                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                                     <button type="submit" class="btn enrol-btn">Save </button>
                                    <a href="{{route('member.dashboard')}}" class="enrol-btn">Cancel</a> 
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footerjs')
<script>
$(document).ready(function() {

  
    //frontend validation start


    if ($("#member_change_password_form").length > 0) {

        $("#member_change_password_form").validate({


            rules: {

              
                current_password: {
                    required: true,
                    maxlength: 255,
                    minlength: 6,
                },
                new_password: {
                    required: true,
                    maxlength: 255,
                    minlength: 6,
                    pattern: /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/,
                   
                },
                confirm_password: {
                    required: true,
                    maxlength: 255,
                    minlength: 6,
                    equalTo : "#new_password",
                },
            },
            messages: {

           
                current_password: {
                    required: "Please enter current password",
                },
                new_password: {
                    required: "Please enter new Password",
                     pattern: "New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character",
                   
                },
                confirm_password: {
                    required: "Please enter confirm Password",
                    equalTo: "New Password and Confirm Password must be same",
                },
               


            },

        })
    }

    //frontend validation complete
  
  

})

</script>

@endsection
