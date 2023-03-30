<?php

use Illuminate\Support\Facades\DB;

?>
@section('title','Registered-Providers')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>{{$office->clinic_name}}({{$office->location_number}})</h4>
                        <p>{{$office->address1}}, <?php
                                                    switch ($office->province) {
                                                        case 'NS':
                                                            echo 'Nova Scotia';
                                                            break;
                                                        case 'PE':
                                                            echo 'Prince Edward Island';
                                                            break;
                                                        case 'NL':
                                                            echo 'Newfoundland and Labrador';
                                                            break;
                                                        case 'NB':
                                                            echo 'New Brunswick';
                                                            break;
                                                        case 'QC':
                                                            echo 'Quebec';
                                                            break;
                                                        case 'ON':
                                                            echo 'Ontario';
                                                            break;
                                                        case 'MB':
                                                            echo 'Manitoba';
                                                            break;
                                                        case 'SK':
                                                            echo 'Saskatchewan';
                                                            break;
                                                        case 'AB':
                                                            echo 'Alberta';
                                                            break;
                                                        case 'BC':
                                                            echo 'British Columbia';
                                                            break;
                                                        case 'YT':
                                                            echo 'Yukon';
                                                            break;
                                                        case 'NT':
                                                            echo 'Northwest Territories';
                                                            break;
                                                        case 'NU':
                                                            echo 'Nunavut';
                                                            break;
                                                    }
                                                    ?></p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- enroll-content-outer -->
        <div class="enroll-content-outer registered-provider-dashboard">
            <div class="container">
                <div class="enroll-content-wrap">
                    @include('showmessages')
                    <div class="row cs-form-new-membr dashboard-welcome-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">
                                <h4>Registered Provider Information</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">

                        </div>
                    </div>

                    @if($registeredproviders->count() < 1)
                        <p>No registered providers for this office</p>
                    @else
                        @foreach($registeredproviders as $registeredprovider)
                        <div class="table-responsive">
                            <table class="table family-table dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Provider Type</th>
                                        <th>Specialty</th>
                                        <th>Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$registeredprovider->last_name}}</td>
                                        <td>{{$registeredprovider->first_name}}</td>
                                        <td><?php echo DB::table('assigning_authorities')->where('assigning_authority_number', $registeredprovider->assigning_authority_number)->first()->assigning_authority_code_description; ?></td>
                                        <td><?php echo DB::table('speciality_codes')->where('speciality_code_number', $registeredprovider->speciality_code_number)->first()->speciality_code_description; ?></td>
                                        <td>
                                            <?php
                                            $office_status =  DB::table('provider_office_enrollments')->where([['office_system_id', $office->id], ['provider_system_id', $registeredprovider->id]])->first()->office_status;
                                            $office_statuses_ary = get_default_values_from_mastertable('provider_office_enrollments', 'office_status');
                                            if ($office_statuses_ary != 0)
                                                echo $office_statuses_ary[$office_status];
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    @endif

                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                </div>

            </div>
        </div>
    </div>

</section>

@endsection