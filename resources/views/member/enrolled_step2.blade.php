@section('title','Member-Login')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Member Login</h4>
         
        </div>
      
        <div class="enroll-content-outer">
            <form action="{{route('member.enrolled.checkstep2')}}" method="POST" id="member_enrolled_login_form">
               
                @csrf
                <div class="container">

                    <div class="enroll-content-wrap" id="newmemberprofile">
                         @include('showmessages')
                        <h4>Login Information</h4>
                      
                        <div class="form enrol-login-form enrolled-login-cstm-form d-flex">
                         
                            <div class="form-group">
                                <label class="enroll-label">FCB Registration ID </label>
                                <input type="text" id= "fcbid" class="form-control" placeholder="F000001" name="fcbid">
                            </div>
                            <span class="enrolled-login-form-separator">OR</span>
                            <div class="form-group">
                                <label class="enroll-label">Group Policy Number</label>
                                <input type="text" class="form-control"  placeholder="20200001" name="group_policy_number">
                            </div>
                              <div class="form-group">
                                <label class="enroll-label">Member Number</label>
                                <input type="text" id="member_number" class="form-control"  name="member_number">
                            </div>
                         
                        </div>
                        
                      
                        <button type="submit" class="btn enrol-btn enrolled-cstm-button">Continue</button>
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


    if ($("#member_enrolled_login_form").length > 0) {

        $("#member_enrolled_login_form").validate({


            rules: {

              
                fcbid: {
                    required: function(element)
                              {
                                   return ($('#member_number').val()==''); //check if member number is empty or not
                               },
                    maxlength: 7,
                    minlength: 7,
                },
                group_policy_number: {
                    required: function()
                              {
                                   return ($('#fcbid').val()==''); //check if fcbid is empty or not
                               },
                    maxlength: 8,
                    minlength: 8,
                },
                 member_number: {
                    required: function()
                              {
                                  
                                  return ($('#fcbid').val()=='');   //check if fcbid is empty or not
                               },
                    maxlength: 11,
                    minlength: 11,
                },
            },
            messages: {

           
                fcbid: {
                    required: "Please enter FCB ID",
                },
                group_policy_number: {
                    required: "Please enter Group policy number",
                },
                 member_number: {
                    required: "Please enter member Number",
                },
               


            },

        })
    }

    //frontend validation complete
  
  

})

</script>

@endsection
