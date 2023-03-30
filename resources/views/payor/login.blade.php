@section('title','Login-Payor')
@extends('layouts.frontend.main')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Payor Login</h4>
         
        </div>
      
        <div class="enroll-content-outer">
            <form action="{{route('payor.checklogin')}}" method="POST" id="payor_login_form">
               
                @csrf
                <div class="container">

                    <div class="enroll-content-wrap login-form-wrap" id="newpayorprofile">
                         @include('showmessages')
                        <h4>Login Information</h4>
                      
                        <div class="form enrol-login-form d-flex">                         
                            <div class="form-group">
                                <label class="enroll-label">FCB Registration Number</label>
                                <input type="text" class="form-control" placeholder="F000001" name="fcbid" id="fcbid">
                            </div>
                            <div class="form-group password-eye-container">
                                <label class="enroll-label">Password</label>
                                <span>
                                <input type="password" class="form-control"  name="password">
                                  <i class="fas fa-eye-slash password-toggle-eye" onclick="toggle_password_visibility(event.target,'password')"></i>
                              </span>
                            </div> 
                            <div class="form-group">  
                                <a class="forgot-password" id="forgot_link" style="margin-top: 60px;" href="#" onClick=forgotpopup()>Forgot Password</a>  
                            </div>                    
                        </div>
                        <p class="text-danger" id="error_fcbid" style="font-size: 13px;padding-top:2px"></p> 
                        <div class="login-buttons-wrap">
                            <button type="submit" class="btn enrol-btn">Login</button>
                            <div class="remember-me-login">
                               <label class="cstm-radio-label">Remember me
                                        <input type="checkbox" name="remember_me" value="1">
                                        <span class="checkmark"></span>
                                </label>
                            </div> 

                        </div>
                        <!-- <a class="forgot-password" href="{{route('member.showforgotpassword')}}">Forgot Password</a> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- The Modal (Password Change alert) -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="forgotmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forgot Password <p style="font-size: 12px;color: red;display:none;">Password reset selected for the following Account Holder</p></h5> 
                <!-- <button type="button" class="close" onClick=CloseForgot() aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
               
            <div class="modal-body">
                
                <form action="{{route('resetpayorpassword')}}" method="post" id="edit_provider_details">
                    <div class="container">
                        @csrf
                        <input type="hidden" class="form-control" name="fcb_id" id="fcb_id" value="">
                        <h5 class="enroll-cstm-form-heading" style="margin-bottom: 10px;"><span id="acc_info"> Account holder validation</span></h5>
                        <div class="row" id="find_office">
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Telephone</b>
                                <input type="text" class="form-control" name="phone" id="phone" value=""> 
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Email</b>
                                <input type="text" class="form-control" name="contact_email" placeholder="abc@gmail.com" id="contact_email" value="">
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <button type="button" class="btn enrol-btn" onClick=GetPayor() style="padding:8px 28px !important;margin-top: 22px;">Find Account</button>
                            </div>
                            <p id="office_div_error" class="text-danger" style="padding: 14px;"></p>
                        </div>
                        <div class="row cs-form-new-membr dashboard-welcome-wrap" style="display:none;" id="payor_data">  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <div class="form-group" name="license_area">
                                    <b>First Name</b>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="" disabled> 
                                </div>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Last Name</b>
                                <input type="text" class="form-control" name="last_name" id="last_name" disabled>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Address1</b>
                                <input type="text" class="form-control" name="address1" id="address1" value="" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>City</b>
                                <input type="text" class="form-control" name="city" id="city" value="" disabled>
                            </div> 
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Province</b>
                                <input type="text" class="form-control" name="province" id="province" value="" disabled>
                            </div> 
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Postal Code</b>
                                <input type="text" class="form-control" name="postal_code" id="postal_code" value="" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Phone</b>
                                <input type="text" class="form-control" name="telephone" id="telephone" value="" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Email</b>
                                <input type="text" class="form-control" name="email" id="email" value="" disabled>
                            </div>  
                        </div>  
                        <h5 class="enroll-cstm-form-heading" style="margin-bottom: 10px;display:none;" id="h5"><span> Password Reset</span></h5>
                        <div class="row cs-form-new-membr dashboard-welcome-wrap" style="display:none;" id="new_pass">  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <div class="form-group" name="license_area">
                                    <b>Enter New Password</b>
                                    <input type="text" class="form-control" name="new_password" id="new_password" value=""> 
                                </div>
                            </div>
                        </div>      
                        <div class="row mt-2">   
                            <div class="col-lg-9 col-lg-9 col-sm-12 col-12">
                                <button type="submit" class="btn enrol-btn" id="continue" style="display:none;">Continue</button>
                            </div> 
                            
                            <div class="col-lg-3 col-lg-3 col-sm-12 col-12"> 
                                
                                <a class="btn enrol-btn" href="{{route('payor.login')}}"> Cancel</a>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<!-- modal end here -->
<style>
@media (min-width: 576px){
    .modal-dialog {
        max-width: 874px;
        margin: 1.75rem auto;
    }
}

</style>
@endsection
@section('footerjs')
<script>
$(document).ready(function() {
    addTelephoneValidation();
    addEmailValidation();
    //frontend validation start
    if ($("#payor_login_form").length > 0) {
        $("#payor_login_form").validate({
            rules: {
                fcbid: {
                    required: true,
                    maxlength: 255,
                    minlength: 7,
                },
                password: {
                    required: true,
                    maxlength: 255,
                    minlength: 6,
                },
                
            },
            messages: {
                fcbid: {
                    required: "Please enter FCB Registration Number",
                },
                password: {
                    required: "Please enter Password",
                },
            },
        })
    }
    //frontend validation complete
    if ($("#edit_provider_details").length > 0) {
        $("#edit_provider_details").validate({
            rules: {
                new_password: {
                    required: true,
                    maxlength: 255,
                    minlength: 6,
                    pattern: /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/,
                
                },
                phone: {
                    required: true,
                    pattern:/^\d{10}$/,
                    customtelephone: true,
                },
                contact_email: {
                    customemail: true,
                },
            },
            messages: {
                new_password: {
                    required: "Please enter new Password",
                    pattern: "New Password must contain at least one uppercase letter, one lowercase letter, one number and one special character",
                
                },
            },
        })
    }
})
</script>
<script>
    /*$('input[name=fcbid]').keyup(function(){
        var fcb_id = $(this).val();
        $('#error_fcbid').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{ route('checkmember') }}",
            method:"POST",
            data:{fcb_id:fcb_id},
            success:function(data){
                if(data > 0){
                    $('#error_fcbid').hide();
                    $("#forgot_link").show();
                }else{
                    $('#error_fcbid').show();
                    $('#error_fcbid').empty().append('FCB registration not found, please correct or call FCB support');
                    $("#forgot_link").hide();
                }
            }
        }); 
    });*/
    $('input[name=fcbid]').keyup(function(){
        $('#error_fcbid').hide();
    });

    function forgotpopup(){
        var fcb_id = $("input[name=fcbid]").val();
        if(fcb_id == ''){
            $('#error_fcbid').show();
            $('#fcbid-error').hide();
            $('#error_fcbid').empty().append('FCB Registration Number is Required');
        }
        else if(fcb_id.length < '7'){
            $('#error_fcbid').show();
            $('#fcbid-error').hide();
            $('#error_fcbid').empty().append('Please enter at least 7 characters.');
        }
        else{
            $('#error_fcbid').hide();
            $('#error_fcbid').hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ route('checkpayor') }}",
                method:"POST",
                data:{fcb_id:fcb_id},
                success:function(data){
                    if(data.success){
                        $('#error_fcbid').hide();
                        $('#fcbid-error').hide();
                        $("#forgotmodal").modal("show");
                    }else{
                        $('#error_fcbid').show();
                        $('#fcbid-error').hide();
                        $('#error_fcbid').empty().append(data.errors);
                    }
                }
            }); 
        }
        
    }
    function CloseForgot(){
        $("#forgotmodal").modal("hide");
    }
    function GetPayor(){
        var fcbid = $("#fcbid").val();
        var phone = $("#phone").val();
        var contact_email = $("#contact_email").val();
        if(phone != '' && contact_email != ''){
            
            if(phone.length < '10'){
                $('#office_div_error').empty().append('Please enter a valid Telephone number.');
                return false;
            }
            if(contact_email == ''){
                $('#office_div_error').empty().append('Please enter a Email');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url:"{{ route('getpayor') }}",
                method:"POST",
                data:{fcb_id:fcbid,telephone:phone,email:contact_email},
                success:function(data)
                {
                    if(data != 'not found'){
                        $('.modal-title p').show();
                        $('#acc_info').empty().append('Account information');
                        $('#find_office').hide();
                        $('#continue').show();
                        $('#payor_data').show();
                        $('#new_pass').show();
                        $('#h5').show();
                        $('#office_div_error').hide();
                        $("#office_id").empty();
                        $('#office_div').show();
                        $('#new_pass').show();
                        $('#fcb_id').val(data.fcb_id);
                        $('#address1').val(data.address1);
                        $('#city').val(data.city);
                        $('#province').val(data.province);
                        $('#postal_code').val(data.postal_code);
                        $('#telephone').val(data.telephone);
                        $('#email').val(data.email);
                        $('#first_name').val(data.first_name);
                        $('#last_name').val(data.last_name);
                    } else{
                        $('#continue').hide();
                        $('#payor_data').hide();
                        $('#new_pass').hide();
                        $('#h5').hide();
                        $('#office_div_error').empty().append('Telephone or Email does not match account holder information, please correct or call FCB support');
                    }
                }
            });
        }else{
            $('#office_div_error').empty().append('Telephone & Postal code Mandatory.');
        }   
    }

</script>
@endsection
