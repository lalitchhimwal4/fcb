@section('title','Forgot Password-Member')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Forgot Password</h4>
         
        </div>
      
        <div class="enroll-content-outer">
            <form action="{{route('member.submitforgotpassword')}}" method="POST" id="member_forgotpassword_form">
               
                @csrf
                <div class="container">

                    <div class="enroll-content-wrap login-form-wrap" id="newmemberprofile">
                         @include('showmessages')
                        <h4>Member Information</h4>
                      
                        <div class="form enrol-login-form d-flex">                         
                            <div class="form-group">
                                <label class="enroll-label">FCB ID </label>
                                <input type="text" class="form-control" placeholder="F000001" name="fcbid">
                            </div>                      
                        </div> 
                        <button type="submit" id="member_forgotpassword_form_submit" class="btn enrol-btn">Continue</button>
                      
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
    if ($("#member_forgotpassword_form").length > 0) {

        $("#member_forgotpassword_form").validate({


            rules: {

              
                fcbid: {
                    required: true,
                    maxlength: 7,
                    minlength: 7,
                },
             
            },
            messages: {

           
                fcbid: {
                    required: "Please enter FCB ID",
                },
             
            },
             submitHandler: function (form) {
                  $('#member_forgotpassword_form_submit').attr('disabled','disabled');
                  form.submit();
            }   


        })
    }

    //frontend validation complete
  
  

})

</script>

@endsection
