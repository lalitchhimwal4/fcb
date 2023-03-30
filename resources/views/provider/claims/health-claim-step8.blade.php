@section('title','Step 8')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Submit a Claim</h4>
                        <p>{{$provider->first_name." ".$provider->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="enroll-content-outer provider-dashboard edit-provider-details">
            <form action="{{route('provider.submit_claim_step8', ['claim' => $claim])}}" method="post">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @csrf
                        @include('showmessages')
                        <div>
                            <h4>Claim Submission Form</h4>
                            <div class="head-row claim-submit">
                                <div class="claim-head-col done">
                                    <span></span>
                                    <h6>Step 1</h6>
                                </div>
                                <div class="claim-head-col done">
                                    <span></span>
                                    <h6>Step 2</h6>
                                </div>
                                <div class="claim-head-col done">
                                    <span></span>
                                    <h6>Step 3</h6>
                                </div>
                                <div class="claim-head-col done">
                                    <span></span>
                                    <h6>Step 4</h6>
                                </div>
                                <div class="claim-head-col done">
                                    <span></span>
                                    <h6>Step 5</h6>
                                </div>
                                <div class="claim-head-col done">
                                    <span></span>
                                    <h6>Step 6</h6>
                                </div>
                                <div class="claim-head-col done before-active">
                                    <span></span>
                                    <h6>Step 7</h6>
                                </div>
                                <div class="claim-head-col active">
                                    <span></span>
                                    <h6>Step 8</h6>
                                </div>
                            </div>
                        </div>
                        <h5 class="claim-form-heading"><span>Step 8: </span> Summary & Final Approval</h5>
                        <div class="form d-flex flex-wrap step8-claim-form">
                            <div class="form-group">
                                <table class="table claim-submission-table">
                                    <thead>
                                        <tr>
                                            <th>Claim Summary</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total FCB contracted rate</td>
                                            <td>${{number_format((float)$claim->fcb_contracted_rate, 2, '.', '')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Total submitted amount</td>
                                            <td>${{number_format((float)$claim->submitted_amount, 2, '.', '')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Patient pays</td>
                                            <td>${{number_format((float)$claim->patient_pays_amount, 2, '.', '')}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <table class="table claim-step-8-table">
                                    <tbody>
                                        <tr>
                                            <th>Reference Number</th>
                                            <td>{{$claim->reference_number}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Processed</th>
                                            <td>{{$claim->processed_date}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="cs-form-card cs-right d-flex align-items-center float-left">
                            <button type="submit" class="btn enrol-btn">Done</button>
                            <a href="{{route('provider.submit_claim_cancellation')}}" class="enrol-btn cancel-btn">Cancel</a>
                        </div>
                        <div class="cs-form-card d-flex align-items-center float-right">
                            <span class="claim-print"><i class="fa fa-print" aria-hidden="true"></i>Print</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('footerjs')
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script>
    $(document).ready(function() {
        $(this).on('click', '.claim-print', function() {
            $('.enroll-content-wrap').print();
            return false;
        });
    });
</script>
@endsection