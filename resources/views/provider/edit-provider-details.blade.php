<?php

use Illuminate\Support\Facades\DB;

?>
@section('title','Edit Details-Provider')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Welcome</h4>
                        <p>{{$provider->first_name." ".$provider->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->

        <div class="enroll-content-outer provider-dashboard edit-provider-details">
            <form action="{{route('provider.savedetails')}}" method="post" id="edit_provider_details">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @csrf
                        @include('showmessages')
                        <div class="row cs-form-new-membr dashboard-welcome-wrap">
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                                <div class="cs-form-card d-flex align-items-center flex-wrap">
                                    <h4>Account Information</h4>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            </div>
                        </div>
                        <h5 class="enroll-cstm-form-heading"><span> Registration Information</span></h5>
                        <div class="table-responsive" id="family-scrollbar">
                            <table class="table family-table dashboard-table" id="scroll-bar-custom">
                                <thead>
                                    <tr>
                                        <th>Registration Number</th>
                                        <th>Registration Method</th>
                                        <th>Account Status</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$provider->registration_id}}</td>
                                        <td>{{$provider->registration_method}}</td>
                                        <td class="edit-td select-wrap">
                                       
                                            
                                            <select class="form-control" name="account_status">
                                                <?php
                                                $account_statuses = get_default_values_from_mastertable('providers', 'account_status');
                                                if ($account_statuses != 0) {
                                                    foreach ($account_statuses as $account_status_index => $account_status_value) { ?>
                                                        <option value="{{$account_status_index}}" @if($provider->account_status==$account_status_index) selected="selected" @endif>{{$account_status_value}}</option>
                                                    <?php }
                                                } else {
                                                    echo "-";
                                                } ?>
                                            </select>
                                        
                                        </td>
                                        <td class="edit-td">********<a href="{{route('provider.changepassword')}}"><i class="fas fa-edit"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5 class="enroll-cstm-form-heading"><span> Account Information</span></h5>
                        <div class="table-responsive" id="family-scrollbar">
                            <table class="table family-table dashboard-table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Specialty</th>
                                        <th>License Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="edit-td"><input type="text" class="form-control" value="{{$provider->first_name}}" name="first_name"></td>
                                        <td class="edit-td"><input type="text" class="form-control" value="{{$provider->last_name}}" name="last_name"></td>
                                        <td><?php 
                                        if($provider->assigning_authority_number == 1){
                                            $data = DB::table('speciality_codes')->where('speciality_code_number', Auth::guard('provider')->user()->speciality_code_number)->first();
                                            echo $data->speciality_code_description; 
                                        }else{
                                            echo DB::table('assigning_authorities')->where('assigning_authority_number', $provider->assigning_authority_number)->first()->assigning_authority_code_description; 
                                        }
                                        ?></td>
                                        <td>{{$provider->license_number}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                            <button type="submit" class="btn enrol-btn">Save </button>
                            <a href="{{route('provider.dashboard')}}" class="enrol-btn">Cancel</a>
                        </div>
                    </div>
                    <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
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
        if ($("#edit_provider_details").length > 0) {
            $("#edit_provider_details").validate({
                rules: {
                    last_name: {
                        required: true,
                        //lettersonly: true,
                        pattern:/^[a-zA-Z\s-`'’]+$/,
                        maxlength: 255,
                        minlength: 3,
                    },
                    first_name: {
                        required: true,
                        //lettersonly: true,
                        pattern:/^[a-zA-Z\s-`'’]+$/,
                        maxlength: 255,
                        minlength: 3,
                    },
                    account_status: {
                        required: true,
                    },
                },
                messages: {
                },
            })
        }
    })
</script>
@endsection