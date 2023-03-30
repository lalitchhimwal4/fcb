@section('title','Enroll-Member')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Member Enrollment</h4>
            <div class="head-row">
                <div class="head-col passed">
                    <span></span>
                    <h6> Registration </h6>
                </div>
                <div class="head-col active">
                    <span></span>
                    <h6> Profile </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Confirmation </h6>
                </div>
            </div>
        </div>
        <!-- Step 3: Profile -->
        <div class="enroll-content-outer">
            <form action="{{route('payor.enroll.save')}}" method="POST" id="enroll_step2_form">

                @csrf
                <div class="container">

                    <div class="enroll-content-wrap" id="newmemberprofile">
                        @include('showmessages')
                        <h4>Step 1: Profile</h4>
                        <h5 class="enroll-cstm-form-heading"><span> Member Information</span></h5>
                        <div class="form enrol-login-form d-flex flex-wrap">
                            <div class="form-group">

                                <label class="enroll-label">Realtionship </label>
                                <div class="select-wrap">
                                    <select class="form-control" name="relationship">
                                        <option value="0">{{get_default_values_from_mastertable('members','relationship')[0]}}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Last Name<sup>*</sup> </label>
                                <input type="text" class="form-control" placeholder="Last Name" name="lname">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">First Name<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="First Name" name="fname">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Gender </label>
                                <div class="select-wrap">
                                    <select class="form-control" name="gender">
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex  flex-wrap cs-dob-div">
                            <div class="form-group">
                                <label class="enroll-label" id="doblabel">Date of Birth<sup>*</sup> </label>
                                <input type="text" id="dateofbirth" name="dateofbirth" style="opacity:0; width:0; height:0;">

                            </div>

                        </div>
                        <br>

                        <button type="submit" id="enroll_step2_form_submit" class="btn enrol-btn">Continue</button>
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
        member_enroll_step2_js(); //function defined in custom.js

        //frontend validation start
        addEmailValidation(); //calling function from common.js for validate email
        addPostalCodeValidation(); //calling function from common.js for validate postal code
        addTelephoneValidation(); //calling function from common.js for validate telephone 
        //addCardValidation(); //calling function from common.js for validate card number

        //capitalize postal code
        $(".postalcode").keyup(
            function() {
                this.value = this.value.toUpperCase();
            }
        );

        if ($("#enroll_step2_form").length > 0) {
            $("#enroll_step2_form").validate({
                rules: {
                    relationship: {
                        required: true,
                    },
                    fname: {
                        required: true,
                        //lettersonly: true,
                        pattern:/^[a-zA-Z\s-`'’]+$/, 
                        maxlength: 255,
                        minlength: 3,
                    },
                    lname: {
                        required: true,
                        pattern:/^[a-zA-Z\s-`'’]+$/,
                        //lettersonly: true,
                        maxlength: 255,
                        minlength: 3,
                    },
                    gender: {
                        required: true,
                    },
                    dateofbirth: {
                        required: true,
                    },
                },
                messages: {
                    relationship: {
                        required: "Please select Relationship",
                    },
                    fname: {
                        required: "Please enter First Name",
                    },
                    lname: {
                        required: "Please enter Last Name",
                    },
                    gender: {
                        required: "Please select Gender",
                    },
                    dateofbirth: {
                        required: "Please select date of birth",
                    },
                },
                
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "latitude" || element.attr("name") == "longitude" || element.attr("name") == "address1")
                        error.insertAfter("#autocomplete");
                    else if (element.attr("name") == "dateofbirth")
                        error.insertAfter(".dobselectwrap");
                    else if (element.attr("name") == "paymentmethod")
                        error.insertAfter(".paypal-label");
                    else
                        error.insertAfter(element);
                },
                submitHandler: function(form) {
                    $('#enroll_step2_form_submit').attr('disabled', 'disabled');
                    form.submit();
                }
            })
        }
        //frontend validation complete
    })
</script>
@endsection