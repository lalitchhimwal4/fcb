@section('title','Reset Password-Member')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Reset Password</h4>
         
        </div>
      
        <div class="enroll-content-outer">
            <form action="{{route('member.submitresetpassword')}}" method="POST" id="member_resetpassword_form">
               
                @csrf
                <div class="container">

                    <div class="enroll-content-wrap login-form-wrap" id="newmemberprofile">
                         @include('showmessages')
                        <h4>Reset Password</h4>
                      
                         <div class="form enrol-login-form d-flex">
                           <input type="hidden" name="unique_token" value="{{$token}}">
                           <input type="hidden" name="fcbid" value="{{$fcbid}}">
                            <div class="form-group">
                                <label class="enroll-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                        </div>
                        <button type="submit" class="btn enrol-btn">Continue</button>
                      
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

  
    //frontend validation start


    if ($("#member_resetpassword_form").length > 0) {

        $("#member_resetpassword_form").validate({


            rules: {

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
            
                new_password: {
                    required: "Please enter new Password",
                     pattern: "New Password must contain atleast one uppercase letter,one lowercase letter,one number,one special character",
                   
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
