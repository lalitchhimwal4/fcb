@section('title','Member-Dashboard')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Contact Details</h4>
                        <p>{{Auth::guard('member')->user()->first_name.' '.Auth::guard('member')->user()->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer">
            <div class="container">
                <form action="{{route('member.updatecontact')}}" id="editcontactform" class="marginform" method="post">
                    @csrf
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        <div class="row cs-form-new-membr">
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card d-flex align-items-center flex-wrap">
                                    <h4>View/Edit Contact Details</h4>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                                    <!-- <a href="{{route('member.editcontact')}}" class="enrol-btn">Edit Contact Details</i></a> -->
                                </div>
                            </div>
                        </div>
                        <h5 class="enroll-cstm-form-heading"><span> Contact Information</span></h5>
                        <div class="table-responsive">
                            <table class="table family-table family-member-edit-table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Address1</th>
                                        <th>City</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="First Name" name="fname" value="{{Auth::guard('member')->user()->first_name}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Last Name" name="lname" value="{{Auth::guard('member')->user()->last_name}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Choose location" id="autocomplete" name="address1" value="{{$contactdetails->address1}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="City" name="city" value="{{$contactdetails->city}}">
                                            </div>
                                        </td>
                                        
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table family-table family-member-edit-table">
                                <thead>
                                    <tr>
                                        <th>Province</th>
                                        <th>Postal Code</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <div class="select-wrap custom-select-form-control">
                                                    <select class="form-control" name="province" id="province">
                                                        <option value="">Select an option</option>
                                                        <option value="NS" {{$contactdetails->province=='NS'?'selected':''}}>Nova Scotia</option>
                                                        <option value="PE" {{$contactdetails->province=='PE'?'selected':''}}>Prince Edward Island</option>
                                                        <option value="NL" {{$contactdetails->province=='NL'?'selected':''}}>Newfoundland and Labrador</option>
                                                        <option value="NB" {{$contactdetails->province=='NB'?'selected':''}}>New Brunswick</option>
                                                        <option value="QC" {{$contactdetails->province=='QC'?'selected':''}}>Quebec</option>
                                                        <option value="ON" {{$contactdetails->province=='ON'?'selected':''}}>Ontario</option>
                                                        <option value="MB" {{$contactdetails->province=='MB'?'selected':''}}>Manitoba</option>
                                                        <option value="SK" {{$contactdetails->province=='SK'?'selected':''}}>Saskatchewan</option>
                                                        <option value="AB" {{$contactdetails->province=='AB'?'selected':''}}>Alberta</option>
                                                        <option value="BC" {{$contactdetails->province=='BC'?'selected':''}}>British Columbia</option>
                                                        <option value="YT" {{$contactdetails->province=='YT'?'selected':''}}>Yukon</option>
                                                        <option value="NT" {{$contactdetails->province=='NT'?'selected':''}}>Northwest Territories</option>
                                                        <option value="NU" {{$contactdetails->province=='NU'?'selected':''}}>Nunavut</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Postal Code" name="postalcode" id="postalcode" value="{{$contactdetails->postal_code}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Telephone" name="telephone" value="{{$contactdetails->telephone}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$contactdetails->email}}">
                                            </div>

                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <!--  <div class="" id="latitudeArea">
                                <label class="enroll-label">Latitude</label> -->
                            <input type="text" id="latitude" name="latitude" value="{{$contactdetails->latitude}}" class="form-control">
                            <!--    </div> -->

                            <!--   <div class="" id="longtitudeArea">
                                <label class="enroll-label">Longitude</label> -->
                            <input type="text" name="longitude" id="longitude" value="{{$contactdetails->longitude}}" class="form-control">
                            <!--   </div> -->
                        </div>
                        <div class="row cs-form-new-membr">
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card d-flex align-items-center flex-wrap">
                                    <!-- <a href="{{route('member.family')}}" class="enrol-btn family-bottom-btn"> View/Edit Dependents <i class="fas fa-arrow-right"></i></a> -->
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                                    <button type="submit" class="btn enrol-btn">Save </button>
                                    <a href="{{route('member.contact')}}" class="enrol-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footerjs')
<script>
    $(document).ready(function() {
        member_edit_contact_details_js(); //function defined in custom.js
        //frontend validation start

        addEmailValidation(); //calling function from common.js for validate email
        addPostalCodeValidation(); //calling function from common.js for validate postal code
        addTelephoneValidation(); //calling function from common.js for validate telephone 

        //capitalize postal code
        $("#postalcode").keyup(
            function() {
                this.value = this.value.toUpperCase();
            }
        );

        if ($("#editcontactform").length > 0) {
            $("#editcontactform").validate({
                rules: {
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
                    latitude: {
                        required: true,
                    },
                    longitude: {
                        required: true,
                    },
                    autocomplete: {
                        required: true,
                    },
                    address1: {
                        required: true,
                        maxlength: 255,
                        minlength: 3,
                    },
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
                    // email: {
                    //     required: true,
                    //     customemail: true,
                    // },
                    telephone: {
                        required: true,
                        customtelephone: true,
                    },
                },
                messages: {
                    fname: {
                        required: "Please enter First Name",
                    },
                    lname: {
                        required: "Please enter Last Name",
                    },
                    latitude: {
                        required: "Please select valid location",
                    },
                    longitude: {
                        required: "Please select valid location",
                    },
                    autocomplete: {
                        required: "Please select valid location",
                    },
                    address1: {
                        required: "Please enter Address1",
                    },
                    city: {
                        required: "Please enter City",
                    },
                    province: {
                        required: "Please enter Province",
                    },
                    postalcode: {
                        required: "Please enter Postal Code",
                    },
                    // email: {
                    //     required: "Please enter Email",
                    // },
                    telephone: {
                        required: "Please enter Telephone",
                    },
                },
                groups: {
                    location: "latitude longitude autocomplete"
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "latitude" || element.attr("name") == "longitude" || element.attr("name") == "autocomplete")
                        error.insertAfter("#autocomplete");
                    else
                        error.insertAfter(element);
                }
            })
        }
        //frontend validation complete
    })
</script>
@endsection