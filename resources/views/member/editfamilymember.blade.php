@section('title','Edit Family Member')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Family Member Details</h4>
                        <p>{{$familymember->first_name.' '.$familymember->last_name}}</p>
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
                <form action="{{route('member.familymember.update')}}" id="editfamilymemberform" method="post">
                    <input type="hidden" name="family_member_id" value="{{$familymember->id}}">
                    @csrf
                    <input type="hidden" name="account_status" value="{{$familymember->account_status}}">
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        <div class="row cs-form-new-membr">
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card d-flex align-items-center flex-wrap">
                                    <h4>Edit Member Details</h4>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                                    <!-- <a href="{{route('member.editcontact')}}" class="enrol-btn">Edit Contact Details</i></a> -->
                                </div>
                            </div>
                        </div>
                        <h5 class="enroll-cstm-form-heading"><span> Member Information</span></h5>
                        <div class="table-responsive">
                            <table class="table family-table family-member-edit-table">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Gender</th>
                                        <th>Relationship</th>
                                        <!-- <th>Status</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Last Name" name="lname" value="{{$familymember->last_name}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="First Name" name="fname" value="{{$familymember->first_name}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="select-wrap custom-select-form-control">
                                                    <select class="form-control" name="gender">
                                                        <option value="0" {{$familymember->gender==0?'selected':''}}>Male</option>
                                                        <option value="1" {{$familymember->gender==1?'selected':''}}>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="select-wrap custom-select-form-control">
                                                    @if($member->relationship == $primary_insured && $familymember->relationship == $primary_insured)
                                                    {{$member_relationships[$member->relationship]}}
                                                    <input type="hidden" name="relationship" value="{{$member_relationships[$member->relationship]}}">
                                                    @else
                                                    <select class="form-control" name="relationship">
                                                        @foreach($member_relationships as $relationship_index => $relationship_value)
                                                        @if($relationship_index !== $primary_insured)
                                                            @if($relationship_index != '0')
                                                                <option value="{{$relationship_index}}" {{$familymember->relationship == $relationship_index ? 'selected' : ''}}>{{$relationship_value}}</option>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <!-- <td>
                                            <div class="form-group">
                                                <div class="select-wrap custom-select-form-control">
                                                    @if($member->relationship == $primary_insured && $familymember->relationship != $primary_insured)
                                                    <select class="form-control" name="account_status">
                                                        @foreach($account_statuses as $i => $status)
                                                        <option value="{{$i}}" {{$familymember->account_status==$i?'selected':''}}>{{$status}}</option>
                                                        @endforeach
                                                    </select>
                                                    @else
                                                    {{$family_member_status}}
                                                    @endif
                                                </div>
                                            </div>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>    
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form enrol-login-form d-flex  flex-wrap cs-dob-div">
                                    <div class="form-group">
                                        <label class="enroll-label" id="doblabel">Date of Birth<sup>*</sup> </label>
                                        <input type="text" id="dateofbirth" name="dob" value="{{$familymember->dob}}" style="opacity:0; width:0; height:0;">
                                    </div>
                                </div>
                            </div>
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
                                    <a href="{{route('member.dashboard')}}" class="enrol-btn">Cancel</a>
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
        let y = new Date().getFullYear();
        $("#dateofbirth").dropdownDatepicker({
            allowFuture: false,
            dropdownClass: "form-control dobselect",
            wrapperClass: "select-wrap dobselectwrap",
            minYear: y-100,
        });
        //to add dwon-triangle symbol in select boxes
        var selectbox = $('.select-wrap select');
        var down_triangular_symbol = '<?php echo env("APP_URL") . '/frontend_assets/images/down-filled-triangular-arrow.png' ?>';
        for (var i = 0; i < selectbox.length; i++) {
            selectbox[i].setAttribute("style", "background-image: url(" + down_triangular_symbol + ");");
        }
        //frontend validation start

        if ($("#editfamilymemberform").length > 0) {
            $("#editfamilymemberform").validate({
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
                        //lettersonly: true,
                        pattern:/^[a-zA-Z\s-`'’]+$/,
                        maxlength: 255,
                        minlength: 3,
                    },
                    gender: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    account_status: {
                        required: true,
                    },
                },
                messages: {
                    relationship: {
                        required: "please select valid relationship",
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
                    dob: {
                        required: "Please select date of birth",
                    },
                    account_status: {
                        required: "Please select Account Status",
                    },
                },
            })
        }
        //frontend validation complete
    })
</script>
@endsection