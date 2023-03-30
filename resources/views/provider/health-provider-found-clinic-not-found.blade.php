@section('title','Provider-NotExist-Office-NotExist')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header">
            <h4>Provider Enrollment</h4>
            <div class="head-row">
                <div class="head-col passed">
                    <span></span>
                    <h6> Profile </h6>
                </div>
                <div class="head-col active">
                    <span></span>
                    <h6> offices </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Confirmation </h6>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-content-wrap">
            <!-- saving data to case 3 because same condition here(provider not exist +office not exist) -->
            <form action="{{route('provider.save.provider_exist.office_exist_clinic_not_found')}}" method="POST" id="provider_healthclinicnotfound">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        @csrf
                        <h4>Step 2: Offices </h4>
                        <input type="hidden" name="provider_type" value="{{$selected_provider_type}}">
                        <input type="hidden" name="license_number" value="{{$license_num}}">
                        <input type="hidden" name="last_name" value="{{$lname}}">
                        <input type="hidden" name="first_name" value={{$fname}}>

                        <div class="provider-profile-wrapper FCB-dental-wrapper">
                            <div class="form enrol-login-form d-flex flex-wrap">

                                <div class="form-group">
                                    <label class="enroll-label">Clinic Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="clinic_name" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Website</label>
                                    <input type="text" class="form-control" name="website" placeholder="">
                                </div>
                                <div class="" id="latitudeArea">
                                    <label class="enroll-label">Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control">
                                </div>

                                <div class="" id="longtitudeArea">
                                    <label class="enroll-label">Longitude</label>
                                    <input type="text" name="longitude" id="longitude" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Address 1<sup>*</sup></label>
                                    <input type="text" class="form-control" name="address1" id="address1" placeholder="" value="{{old('address1')}}">
                                </div>
                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Address 2 </label>
                                    <input type="text" class="form-control" name="address2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">City<sup>*</sup></label>
                                    <input type="text" class="form-control" name="city" placeholder="">
                                </div>
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
                                <input type="hidden"  class="form-control postalcode" value="" name="postal_code" placeholder="1A1 A1A">
                                <input type="text" id="zipCode" class="form-control postalcode" value="{{($postal_code != 'NULL')?$postal_code:old('postal_code')}}"  placeholder="1A1 A1A" disabled="disabled">
                                </div>
                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Phone Number<sup>*</sup></label>
                                    <input type="text" class="form-control" name="phone_number" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Fax</label>
                                    <input type="text" class="form-control" name="fax" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Email<sup>*</sup></label>
                                    <input type="text" class="form-control" name="email" placeholder="">
                                </div>
                                <div class="form-group social_media_group_wrapper">
                                    <label class="enroll-label">Social Media</label>
                                    <div class="social_media_group">
                                        <input type="text" class="form-control" name="social_media[]" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="add-another-btn-wrap">
                                <a href="javascript:void(0);" onclick="add_new_social_account_field()" class="add-another-btn">+Add another account</a>
                            </div>
                        </div>

                        <div class="form-group terms-conditions-container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms_and_conditions" id="terms_and_conditions">
                                <label class="form-check-label" for="terms_and_conditions">
                                    By checking this box you accept that you have read, understood and accepted the <a href="{{$terms_condition_link ?? ''}}" class="text-red popup-btn">Program Guidelines</a> presented herein
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn enrol-btn comm-mr-top">Continue</button>
                    </div>
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


    addEmailValidation(); //calling function from common.js for validate email
    addPostalCodeValidation(); //calling function from common.js for validate postal code
    addTelephoneValidation(); //calling function from common.js for validate telephone 
    addArrayInputValidation(); //calling function from common.js for validate Social Media 


    //capitalize postal code
    $(".postalcode").keyup(
        function() {
            this.value = this.value.toUpperCase();
        }
    );


    if ($("#provider_healthclinicnotfound").length > 0) {
      
        $("#provider_healthclinicnotfound").validate({
         
            rules: {

                postal_code:{
                    required: true,
                    custompostalcode: true,
                },
                clinic_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 256,
                },
                address1: {
                    required: true,
                    minlength: 3,
                    maxlength: 256,
                },
                city: {
                    required: true,
                    minlength: 3,
                    maxlength: 256,
                },
                province: {
                    required: true,
                },
                postal_code: {
                    required: true,
                    custompostalcode: true,
                },
                phone_number: {
                    required: true,
                    pattern:/^\d{10}$/,
                    customtelephone: true,
                },
                email: {
                    required: true,
                    customemail: true,
                },
                terms_and_conditions: {
                    required: true,
                },
            },
            messages: {
            },
        })
    }
})



//====add social account field function==============//
function add_new_social_account_field() {

    var social_group_unique_id = Math.random().toString(16).slice(2);

    $(".social_media_group_wrapper").append('<div id="' + social_group_unique_id + '" class="social_media_group" style="margin-top:10px;"><input type="text" class="form-control" name="social_media[]" placeholder=""><i onclick=delete_social_account_field("' + social_group_unique_id + '") class="fas fa-minus-circle"></i></div>');



}

function delete_social_account_field(social_group_unique_id) {
    $("#" + social_group_unique_id).remove();

}

    //Address1 autocomplete functionality
    Autocomplete_Address_for_provider_office("address1"); //function defined in bladefiles.js
</script>
@endsection