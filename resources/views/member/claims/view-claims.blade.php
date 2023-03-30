@section('title','Claim Management')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Claim Management</h4>
                        <p>{{Auth::guard('member')->user()->first_name." ".Auth::guard('member')->user()->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-view-offices-outer provider-edit-offices-outer">
            <div class="container">
                <div class="enroll-content-wrap">
                    <div class="view-claim-header">
                        <div>
                            <h4>View Claims</h4>
                        </div>
                        <!-- <div class="d-flex align-items-center">
                            <a href="{{route('provider.claim_step1')}}" class="enrol-btn"> Submit a Claim</a>
                            <a href="{{route('provider.claim_step1', ['request_type' => 'estimate'])}}" class="enrol-btn"> Submit an Estimate</a>
                        </div> -->
                    </div>
                    <div class="edit-prv-off-row">
                        <div class="form-group">
                            <table class="table claim-step-8-table">
                                <tbody>
                                    <tr>
                                        <th>Billing to Date</th>
                                        <?php
                                        $total_claim_amount = 0;

                                        foreach ($claims as $claim) {
                                            $total_claim_amount += $claim['submitted_amount'];
                                        }
                                        ?>
                                        <td class="eob-amount highlighted">${{number_format((float)$total_claim_amount, 2, '.', '')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            @if($claims)
                            <table class="table claim-submission-table">
                                <thead>
                                    <tr>
                                        <th>Reference Number</th>
                                        <th>Date Processed</th>
                                        <th>Submitted Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @foreach($claims as $claim)
                                    <tr>
                                        <td>{{$claim['reference_number']}}</td>
                                        <td>{{$claim['processed_date']}}</td>
                                        <td>${{number_format((float)$claim['submitted_amount'], 2, '.', '')}}</td>
                                        <td><a href="{{route('provider.claim_eob', ['claim' => $claim['id']])}}" class="view-claim-btn"> View Claim <i class="fas fa-arrow-right"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="navigation-links"></div>
                            <div class="navigation-links">
                            </div>

                            @else
                            <div>No claim to be displayed</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection