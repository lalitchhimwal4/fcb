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
            <form action="{{route('member.enroll.savestep2')}}" method="POST" id="enroll_step2_form">

                @csrf
                <div class="container">

                    <div class="enroll-content-wrap" id="newmemberprofile">
                        @include('showmessages')
                        <h4>Step 1: Profile</h4>
                        <h5 class="enroll-cstm-form-heading"><span> Member Information</span></h5>
                        <div class="form enrol-login-form d-flex flex-wrap">
                            <div class="form-group">

                                <label class="enroll-label">Relationship </label>
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
                        <h5 class="enroll-cstm-form-heading cstm-mr-top"><span> Contact Information </span></h5>
                        <div class="form enrol-login-form d-flex flex-wrap">


                            <div class="" id="latitudeArea">
                                <label class="enroll-label">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control">
                            </div>

                            <div class="" id="longtitudeArea">
                                <label class="enroll-label">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="enroll-label">Address 1<sup>*</sup></label>
                                    <input type="text" name="address1" id="autocomplete" placeholder="Choose Location" class="form-control address1">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="enroll-label"> Address 2</label>
                                    <input type="text" name="address2" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="enroll-label">City<sup>*</sup></label>
                                    <input type="text" name="city" class="form-control city">
                                </div>
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap">    
                            <div class="form-group">
                                <label class="enroll-label">Province<sup>*</sup></label>
                                <div class="select-wrap">
                                    <select class="form-control" name="province" id="province">
                                        <option value="">Select an option</option>
                                        <option value="NS">Nova Scotia</option>
                                        <option value="PE">Prince Edward Island</option>
                                        <option value="NL">Newfoundland and Labrador</option>
                                        <option value="NB">New Brunswick</option>
                                        <option value="QC">Quebec</option>
                                        <option value="ON">Ontario</option>
                                        <option value="MB">Manitoba</option>
                                        <option value="SK">Saskatchewan</option>
                                        <option value="AB">Alberta</option>
                                        <option value="BC">British Columbia</option>
                                        <option value="YT">Yukon</option>
                                        <option value="NT">Northwest Territories</option>
                                        <option value="NU">Nunavut</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label class="enroll-label">Postal Code<sup>*</sup></label>
                                <input type="text" name="postalcode" id="postalcode" placeholder="A1A 1A1" class="form-control postalcode">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label"> Email<sup>*</sup></label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Telephone<sup>*</sup></label>
                                <input type="number" name="telephone" class="form-control">
                            </div>
                        </div><br>
                        <div class="form-group terms-conditions-container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms_and_conditions" id="terms_and_conditions">
                                <label class="form-check-label" for="terms_and_conditions">
                                By checking this box you accept that you have read, understood, and accepted <a href="{{asset('/frontend_assets/resources/Plan_A001_Booklet.pdf')}}" class="text-red popup-btn">Plan A001</a> presented herein.
                                    <!-- By checking this box you accept that you have read, understood and accepted the <a href="#" class="text-red popup-btn">Program Guidelines</a> presented herein -->
                                </label>
                            </div>
                        </div>
                        <!--<div class="form enrol-login-form enroll-login-credit-form d-flex flex-wrap ">
                            <div class="d-flex">
                                <div class="form-group">
                                    <label class="enroll-label">Plan Type<sup>*</sup></label>
                                    <div class="credit-card-buttons">
                                        <label class="cstm-radio-label">Single Member - ( {{ Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_amount') ? ' $' . Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_amount') : ''}})
                                            <input type="radio" name="plan" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <br>
                                        <label class="cstm-radio-label">Family Member - ( {{ Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_amount') ? ' $' . Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_amount') : ''}})
                                            <input type="radio" name="plan" value="2">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form enrol-login-form enroll-login-credit-form d-flex flex-wrap ">
                            <div class="d-flex">
                                <div class="form-group">
                                    <label class="enroll-label">Payment Gateway<sup>*</sup></label>
                                    <div class="credit-card-buttons">
                                        <label class="cstm-radio-label paypal-label">Paypal - (Payment is mandatory for enrollment)
                                            <input type="radio" name="paymentmethod" value="2">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="paypal-notes">The email used for paying for the subscription will be saved with your details to send any future invoices in PayPal</label>
                                    </div>
                                </div>
                            </div>
                        </div>-->

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
                    // latitude: {
                    //     required: true,
                    // },
                    // longitude: {
                    //     required: true,
                    // },
                    // address1: {
                    //     required: true,
                    // },
                    city: {
                        required: true,
                        maxlength: 255,
                    },
                    province: {
                        required: true,
                    },
                    postalcode: {
                        required: true,
                        custompostalcode: true,
                    },
                    email: {
                        required: true,
                        customemail: true,
                    },
                    telephone: {
                        required: true,
                        pattern:/^\d{10}$/,
                        customtelephone: true,
                    },
                    terms_and_conditions: {
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
                    // latitude: {
                    //     required: "Please select valid location",
                    // },
                    // longitude: {
                    //     required: "Please select valid location",
                    // },
                    // address1: {
                    //     required: "Please select valid location",
                    // },
                    city: {
                        required: "Please enter City",
                    },
                    province: {
                        required: "Please enter Province",
                    },
                    postalcode: {
                        required: "Please enter Postal Code",
                    },
                    email: {
                        required: "Please enter Email",
                    },
                    telephone: {
                        required: "Please enter Telephone",
                    },
                    terms_and_conditions: {
                        required: "Please accept terms and conditions",
                    },
                },
                groups: {
                    location: "latitude longitude address1"
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