<?php

use Carbon\Carbon;

?>

@section('title','Explanation of Benefits')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Estimate Reference No. {{$validated['claim']['claimCode'] ?? '-'}}</h4>
                        <p>Date Processed {{Carbon::create($validated['claim']['processDate'])->toDateString() ?? '-'}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
                <div class="eob-alert-messages">
                    @include('showmessages')
                </div>
            </div>
        </div>

        <div class="enroll-content-outer provider-dashboard edit-provider-details">
            <div class="container">
                <div class="eob-flex-container">
                    <div class="enroll-content-wrap">
                        <h4>Estimate Summary</h4>
                        <div class="form-group">
                            <table class="table claim-eob-table">
                                <thead>
                                    <tr>
                                        <th>Patient Responsibility</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Patient pays</td>
                                        <td class="eob-amount highlighted">${{number_format((float)$validated['claim']['totalPatientPaysAmount'], 2, '.', '') ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Submitted amount</td>
                                        <td class="eob-amount">${{number_format((float)$validated['claim']['totalSubmittedAmount'], 2, '.', '') ?? '-'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <table class="table claim-eob-table">
                                <thead>
                                    <tr>
                                        <th>Plan Provisions</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>FCB Contracted Rate</td>
                                        <td class="eob-amount">${{number_format((float)$validated['claim']['totalServiceChargeAmount'], 2, '.', '') ?? ''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="claim-eob-details">
                            <h5>Explanation of Benefits</h5>
                            <p>This EOB statement describes your benefit cost associated with the Health Services. If you have secondary coverage, please send this statement as proof of service and payment to your Insurance Company for reimbursement.</p>
                        </div>
                        <div class="claim-eob-details">
                            <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Tollfree') ? Get_Meta_Tag_Value('General_Settings','Tollfree') : '1-(800) 967-1111'}}" class="tel-no">
                                <h5 class="claim-eob-h5"><i class="fas fa-phone-alt"></i> {{Get_Meta_Tag_Value('General_Settings','Tollfree') ? Get_Meta_Tag_Value('General_Settings','Tollfree') : '1-(800) 967-1111'}}</h5>
                            </a>
                            <p>Have a question about this EOB? Customer advocates are here to help!</p>
                        </div>
                        <div class="claim-eob-details">
                            <h5 class="claim-eob-h5"><i class="fas fa-laptop"></i> FCBHealthNetwork.ca</h5>
                            <p>Login to FCB Access for Members to see claim details.</p>
                        </div>
                        <div>
                            <h6>THIS IS AN INVOICE. KEEP COPY FOR YOUR RECORDS.</h6>
                        </div>
                    </div>
                    <div class="eob-provider-patient-details">
                        <h5 class="enroll-cstm-form-heading"><span>Patient Details</span></h5>
                        <div class="edit-prv-off-row">
                            <div class="form enrol-login-form d-flex">
                                <div class="form-group">
                                    <label class="enroll-label">{{$member->first_name . " " . $member->last_name}}</label>
                                    <p>{{$insured_profile->address1}}</p>
                                    <p>{{$insured_profile->address2}}</p>
                                    <p>{{$insured_profile->postal_code}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Policy</label>
                                    <p>{{$member->policy_number}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Member ID</label>
                                    <p>{{$member->member_number}}</p>
                                </div>
                            </div>
                        </div>
                        <h5 class="enroll-cstm-form-heading"><span>Provider Details</span></h5>
                        <div class="edit-prv-off-row">
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">{{$provider_office->clinic_name}}</label>
                                    <p>{{$provider->first_name . " " . $provider->last_name}}</p>
                                    <p>License # {{$provider->license_number}}</p>
                                    <p>{{$provider_office->address1}}</p>
                                    <p>{{$provider_office->address2}}</p>
                                    <p>{{$provider_office->postal_code}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="claim-eob-lines">
                    <h5 class="claim-eob-h5">Estimate Details</h5>
                    <div class="edit-prv-off-row">
                        <div class="form-group">
                            @if(count($validated['claim']['claimLines']))
                            <table class="table claim-eob-table">
                                <thead>
                                    <tr>
                                        <th>Line</th>
                                        <th>Service Code</th>
                                        <th>Service Description</th>
                                        <th>FCB Contracted Rate</th>
                                        <th>Submitted Amount</th>
                                        <th>Patient Pays</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($validated['claim']['claimLines'] as $i => $line)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$line['serviceCode']}}</td>
                                        <td>{{$line['message']}}</td>
                                        <td>${{$line['serviceChargeAmount']}}</td>
                                        <td>${{$line['totalEligibleAmount']}}</td>
                                        <td>${{$line['patientPaysAmount']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div>No claim services to be displayed</div>
                            @endif
                        </div>
                    </div>
                    <div class="claim-eob-lines-footer">
                        <div>
                            <h5>Key Terms</h5>
                            <p>FCB Contracted Rate: A negotiate rate that a provider will charge you.</p>
                            <p>Submitted Amount: The amount you were charged for the Health Service.</p>
                        </div>
                        <div>
                            <span class="claim-print"><i class="fa fa-print" aria-hidden="true"></i>Print</span>
                        </div>
                    </div>
                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
                    <a href="{{route('provider.logout')}}" class="enrol-btn">Logout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footerjs')
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script>
    $(document).ready(function() {
        $(this).on('click', '.claim-print', function() {
            $('.family-profile-sec').print();
            return false;
        });
    });
</script>
@endsection