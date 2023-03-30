@section('title','Enroll-Member')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">

            <!--<h4>Thank you for choosing the FCB Health Network. Member Enrollment will be launching July 1st, 2022. We look forward to having you join.</h4>
            --><h4>Member Enrollment</h4>

            <div class="head-row">
                <div class="head-col active">
                    <span></span>
                    <h6> Registration </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Profile </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Confirmation </h6>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer">
            <form action="{{route('member.enroll.step2')}}" method="POST" id="enroll_step1_form">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        @csrf
                        <h4>Step 1: Registration</h4>
                        <div class="form enrol-registration-form">
                            <div class="form-group">
                                <label class="enroll-label">Is this a first time registration for the family? </label>
                                <div class="yes-no-buttons">
                                    <label class="cstm-radio-label">Yes
                                        <input type="radio" name="checkexist" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="cstm-radio-label">No
                                        <input type="radio" name="checkexist" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <!--  <a href="javascript:void(0);" onClick="document.getElementById('enroll_step1_form').submit()" class="enrol-btn" id="first_step_continue"> Continue</a> -->
                            <button type="submit" class="btn enrol-btn yes-no-cst-btn">Continue</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>
<style>
    .contact-form1 .canadian-form input, .canadian-form textarea {
        border: 1px solid #bdb4b4;
    }    
    .contact-form1 {
        margin-top: 35px;
        background: #fff;
        padding: 21px 48px 50px;
        border-radius: 20px;
    }
    .contact-form1 .form-group {
        margin-bottom: 15px;
    }
    .contact-form1 p{
        text-align: center;
        font-weight: 600;
    }
</style>
@endsection
@section('footerjs')
<script>
$(document).ready(function() {



    if ($("#enroll_step1_form").length > 0) {

        $("#enroll_step1_form").validate({


            rules: {
                checkexist: {
                    required: true,

                },

            },
            messages: {

                checkexist: {
                    required: "Please select valid option to continue!",
                },

            },
           errorPlacement: function(error, element) {
                   if (element.attr("name") == "checkexist") 
                    error.insertAfter(".yes-no-buttons");
                   else 
                    error.insertAfter(element);
               }


        })
    }



})

</script>
@endsection
