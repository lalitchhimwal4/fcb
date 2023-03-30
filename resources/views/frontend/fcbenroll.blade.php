@section('title','Enroll-FCB')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec cs-login-div">
        <div class="page-header">
            <h4>User Enrollment</h4>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer">
            <div class="container">
                <div class="enroll-content-wrap">
                	 <h4>Select The User Type</h4>
                    @include('showmessages')
                    <div class="cs-form-card fcb-login-buttons d-flex align-items-center flex-wrap">
                        <a href="javascript:void(0);" onClick="PayorPopup();" class="enrol-btn">Payor </a>
                        <a href="{{route('provider.enroll.step1')}}" class="enrol-btn">Provider</a>
                        <a href="{{route('member.enroll.step2')}}" class="enrol-btn">Member </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- The Modal (Password Change alert)-->
<div class="modal fade" id="payormodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 0px;">
                <h2 style="padding-left:10px;">Looking to Joining our Network?</h2>
                <button type="button" class="close" onClick=ClosePopup() aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 0px;">
                <form id="contactUsForm" action="javascript:void(0)" class="contact-form" method="POST" novalidate="novalidate">
                    <p>If you are looking to join the FCB Health Network to save 20-30% on
your claims payable, please fill out the form below and a member of
our procurement team will be in contact shortly. If you have already
enrolled in the FCB Health Network, please login with the credentials
provided by FCB, or call our support desk for further assistance.</p>
                    <div class="canadian-form">
                        <div class="form-group">
                            @csrf
                            <label for="name">Company Name<sub class="asterick">*</sub></label>
                            <input type="text" name="company_name" id="company_name" value="">
                        </div>
                        <div class="form-group">
                            <label for="name">Reps Name<sub class="asterick">*</sub></label>
                            <input type="text" name="name" id="name" value="">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email<sub class="asterick">*</sub></label>
                                    <input type="text" name="email" id="email" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone<sub class="asterick">*</sub></label>
                                    <input type="text" name="phone" id="phone" value="">
                                </div>
                            </div>  
                        </div>  
                        <div class="form-group">
                            <label for="messagetext">Message<sub class="asterick">*</sub></label>
                            <textarea name="message" cols="40" rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn enrol-btn" id="submit">Submit</button>
                    </div>
                </form>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<!-- modal end here -->
@section('footerjs')
<style>
    .canadian-form input, .canadian-form textarea{
        border: 1px solid #d1c6c6;
        height: 40px;
        color: #000!important;
    }
    .fade:not(.show) {
        opacity: 1;
        margin-top: 10px;
        padding-top: 8px;
    }
    .contact-form {
        padding: 0px 10px 10px;
        /* overflow-y: scroll !important;
        height: 600px; */
    }
    .canadian-form textarea {
        height: 90px;
        border: 1px solid #d1c6c6;
        margin-bottom : 10px;
    }
    @media (min-width: 576px){
        .modal-dialog {
            max-width: 679px;
            margin: 1.75rem auto;
        }
    }    
</style>
<script>
    
    function PayorPopup(){
        $("#payormodal").show();
    }

    if ($("#contactUsForm").length > 0) {
    $("#contactUsForm").validate({
        rules: {
            company_name: {
                required: true,
                minlength: 2
            },
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                minlength: 10,
                email: true,
            },  
            phone: {
                required: true,
            },   
        },
        messages: {
            company_name: {
                required: "Please enter Company Name",
                maxlength: "Your Company name minlength should be 2 characters long."
            },
            name: {
                required: "Please enter name",
                minlength: "Your name length should be 2 characters long."
            },
            email: {
                required: "Please enter valid email",
                email: "Please enter valid email",
                maxlength: "The email should be 10 characters",
            },   
            phone: {
                required: "Please enter Phone",
            },
        },
        submitHandler: function(form) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $('#submit').html('Please Wait...');
            $("#submit"). attr("disabled", true);
            $.ajax({
                url: "{{url('save-payor-details')}}",
                type: "POST",
                data: $('#contactUsForm').serialize(),
                success: function( response ) {
                    $('#submit').html('Submit');
                    $("#submit"). attr("disabled", false);
                    document.getElementById("contactUsForm").reset(); 
                    $('.canadian-form').empty().html('<p style="color:#e63b2b">'+response+'</p>');
                    setTimeout(function () {
                        $("#payormodal").hide();
                    }, 5000);
                }
            });
        }
    })
}

    function ClosePopup(){
        $("#payormodal").hide();
    }
           
</script>
@endsection