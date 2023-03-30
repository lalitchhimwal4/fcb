@section('title','Login-Provider')
@extends('layouts.frontend.main')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Provider Login</h4>
         
        </div>
      
        <div class="enroll-content-outer">
            <form action="{{route('provider.checklogin')}}" method="POST" id="provider_login_form">
                @csrf
                <div class="container">
                    <div class="enroll-content-wrap login-form-wrap" id="newproviderprofile">
                         @include('showmessages')
                        <h4>Login Information</h4>
                        <div class="form enrol-login-form d-flex">                         
                            <div class="form-group">
                                <label class="enroll-label">FCB Registration Number </label>
                                <input type="text" class="form-control" id="fcb_id" placeholder="F000001" name="fcbid">
                            </div>
                            <div class="form-group password-eye-container">
                                <label class="enroll-label">Password</label>
                                <span>
                                <input type="password" class="form-control"  name="password">
                                 <i class="fas fa-eye-slash password-toggle-eye" onclick="toggle_password_visibility(event.target,'password')"></i>
                                </span>
                            </div>  
                            <div class="form-group">
                                <a class="forgot-password" id="forgot_link" style="margin-top:60px;" href="#" onClick=forgotpopup()>Forgot Password</a>
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
                <h5 class="modal-title">Forgot Password <p style="font-size: 12px;color: red;display:none;">Password reset requested for selected office</p></h5>
            </div>
            <div class="modal-body">
                <h5 class="enroll-cstm-form-heading" id="acc_info_h5" style="display:none;margin-bottom: 10px;"><span> Account information</span></h5>
                <form action="{{route('resetpasswordprovider')}}" method="post" id="edit_provider_details">
                    <div class="container">
                        @csrf
                        <input type="hidden" name="office_id" id="office_id">
                        <div class="row cs-form-new-membr dashboard-welcome-wrap" style="display:none" id="acc_info">
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Registration Number</b>
                                <input type="text" class="form-control" value=""  id="registration_number" disabled>
                                <input type="hidden" class="form-control" value="" name="registration_number" id="registration_number1">
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <div class="form-group" name="license_area">
                                    <b>License Number</b>
                                    <input type="text" class="form-control" name="license_number" id="license_number" value="" disabled> 
                                </div>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">    
                                <b>Specialty</b>
                                <input type="test" class="form-control" id="specialty" value="" disabled>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>First Name</b>
                                <input type="text" class="form-control" name="first_name" value="" id="first_name" disabled>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Last Name</b>
                                <input type="text" class="form-control" name="last_name" value="" id="last_name" disabled>
                            </div> 

                            
                        </div> 
                        <h5 class="enroll-cstm-form-heading" style="margin-bottom: 10px;"><span> Registered office</span></h5>
                        <div class="row" id="find_office">
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Telephone</b>
                                <input type="hidden" id="provider_fcb_id">
                                <input type="text" class="form-control" name="phone" id="phone" value=""> 
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Postal Code</b>
                                <input type="text" class="form-control" placeholder="A1A 1A1" name="postal" id="postal" value="">
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <button type="button" class="btn enrol-btn" onClick=GetOffice() style="padding:8px 28px !important;margin-top: 22px;">Find Office</button>
                            </div>
                            <p id="office_div_error" class="text-danger" style="padding: 14px;"></p>
                        </div>
                        <div class="row cs-form-new-membr dashboard-welcome-wrap mt-2" id="office_div" style="display:none;">  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Location Number</b>
                                <input type="text" class="form-control" name="location_number" id="location_number" value="" disabled> 
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Clinic Name</b>
                                <input type="text" class="form-control" name="clinic_name" id="clinic_name" value="" disabled>
                            </div>
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Address</b>
                                <input type="text" class="form-control" name="address1" id="address1" value="" disabled>
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>City</b>
                                <input type="text" class="form-control" name="city" id="city" value="" disabled>
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
                                <b>Fax</b>
                                <input type="text" class="form-control" name="fax" id="fax" value="" disabled>
                            </div> 
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Email</b>
                                <input type="text" class="form-control" id="email" value="" disabled>
                                <input type="hidden" class="form-control" name="email" id="email1" value="">
                            </div>  
                            <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                <b>Website</b>
                                <input type="text" class="form-control" name="website" id="website" value="" disabled>
                            </div>
                            
                        </div>  
                        <div style="display:none;" id="reset_password">
                            <h5 class="enroll-cstm-form-heading" style="margin-bottom: 10px;"><span> Reset Password</span></h5>
                            <div class="row mt-2">    
                                <div class="col-lg-4 col-lg-4 col-sm-12 col-12">
                                    <b>Add New Password</b>
                                    <input type="text" class="form-control" name="new_password" id="new_password" value="">  
                                </div>
                            </div>    
                        </div>
                        <div class="row mt-2">   
                            <div class="col-lg-9 col-lg-9 col-sm-12 col-12">
                                <button type="submit" class="btn enrol-btn" id="submit_box" style="display:none;">Continue</button>
                            </div> 
                            
                            <div class="col-lg-3 col-lg-3 col-sm-12 col-12"> 
                                
                                <a href="" class="btn enrol-btn" href="{{route('member.login')}}"> Cancel</a>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               
            </div>
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


    if ($("#provider_login_form").length > 0) {

        $("#provider_login_form").validate({


            rules: {

              
                fcbid: {
                    required: true,
                    maxlength: 255,
                    minlength: 9,
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
                postal: {
                    required: true,
                    custompostalcode: true,
                },
                phone: {
                    required: true,
                    pattern:/^\d{10}$/,
                    customtelephone: true,
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
    $('input[name=fcbid]').keyup(function(){
        $('#error_fcbid').hide();
    });

    function forgotpopup(){
        var fcb_id = $("input[name=fcbid]").val();
        if(fcb_id == ''){
            $('#error_fcbid').show();
            $('#fcb_id-error').hide();
            $('#error_fcbid').empty().append('FCB Registration Number is required to initiate a password change, please correct or call FCB support');
        }
        else if(fcb_id.length < '9'){
            $('#error_fcbid').show();
            $('#fcb_id-error').hide();
            $('#error_fcbid').empty().append('FCb Registration Number must be 9 characters');
        }
        else if(fcb_id.length > '9'){
            $('#error_fcbid').show();
            $('#fcb_id-error').hide();
            $('#error_fcbid').empty().append('FCB Registration Number must be 9 characters');
        }
        else{
            $('#error_fcbid').hide();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ route('getproviderofficepassword') }}",
                method:"POST",
                data:{fcb_id:fcb_id},
                success:function(data){
                    if(data.success){
                        $("#forgotmodal").modal("show");
                        $('#provider_fcb_id').val(fcb_id);
                        provider_data(fcb_id);
                        //office_data(fcb_id);
                    }else{
                        $('#fcb_id-error').hide();
                        $('#error_fcbid').show();
                        $('#error_fcbid').empty().append(data.errors);
                    }
                }
            });
        }    
    }
    function CloseForgot(){
        $("#forgotmodal").modal("hide");
    }

    function provider_data(query){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{ route('getprovider') }}",
            method:"POST",
            data:{fcb_id:query},
            success:function(data)
            {
                if(data){
                    $("#office_id").empty();
                    $('#fcb_id').val(data.fcb_id);
                    $('#registration_number').val(data.registration_id);
                    $('#registration_number1').val(data.registration_id);
                    $('#license_number').val(data.license_number);
                    $('#specialty').val(data.speciality_description);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                } 
            }
        });
    }
   
    /*function office_data(query){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{ route('getoffices') }}",
            method:"POST",
            data:{fcb_id:query},
            success:function(data)
            {
                if(data.length > 0){
                    jQuery("#office_id").empty();
                    jQuery('#new_pass').show();
                    $.each(data, function (index, data) {
                        var officedata = '<option value='+data.id+'>'+data.clinic_name+'</option>';
                        jQuery( "#office_id" ).append( officedata );
                    })
                } 
            }
        });
    }*/

    function GetOffice(){
        var phone = $("#phone").val();
        var postal = $("#postal").val();
        var fcb_id = $('#provider_fcb_id').val();
        if(phone != '' && postal != ''){
            if(phone.length < '10'){
                $('#office_div_error').empty().append('Please enter a valid telephone number.');
                return false;
            }
            if(postal.length > '7'){
                $('#office_div_error').empty().append('Please enter a valid postal code.');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ route('getofficedetails') }}",
                method:"POST",
                data:{fcb_id:fcb_id,telephone:phone,postal_code:postal},
                success:function(data)
                {
                    if(data.email){
                        $('.modal-title p').show();
                        $('#acc_info_h5').show();
                        $('#acc_info').show();
                        $('#find_office').hide();
                        $('#office_div_error').hide();
                        $('#office_div').show();
                        $('#new_pass').show();
                        $('#reset_password').show();
                        $('#submit_box').show();
                        $('#fcb_id').val(data.fcb_id);
                        $('#office_id').val(data.office_id);
                        $('#location_number').val(data.location_number);
                        $('#address1').val(data.address1);
                        $('#city').val(data.city);
                        $('#clinic_name').val(data.clinic_name);
                        $('#email').val(data.email);
                        $('#email1').val(data.email);
                        $('#fax').val(data.fax);
                        $('#postal_code').val(data.postal_code);
                        $('#website').val(data.website);
                        $('#telephone').val(data.telephone);
                    } else{
                        jQuery('#office_div_error').empty().append(data);
                    }
                }
            });
        }else{
            jQuery('#office_div_error').empty().append('Telephone & Postal Code Required.');
        }
    }

    
</script>
@endsection
