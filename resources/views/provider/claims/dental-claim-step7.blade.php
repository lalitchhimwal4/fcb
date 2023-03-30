@section('title','Step 7')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>@if($request_type =="claim") Submit a Claim @else Submit an Estimate @endif</h4>
                        <p>{{$provider->first_name." ".$provider->last_name}}</p>
                    </div>
                    @if($request_type != 'estimate' && $request_type != 'claim'))
                        <div class="family-buttons d-flex align-items-center">
                            <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                            <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="enroll-content-outer provider-dashboard edit-provider-details">
            <div class="container">
                <form action="{{route('provider.submit_claim_step7')}}" method="post">
                    <div class="enroll-content-wrap">
                        @csrf
                        @include('showmessages')
                        <div>
                        <h4>@if($request_type =="claim") Treatment Submission @else Treatment Estimate Submission  @endif</h4>
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
                                <div class="claim-head-col done before-active">
                                    <span></span>
                                    <h6>Step 6</h6>
                                </div>
                                <div class="claim-head-col active">
                                    <span></span>
                                    <h6>Step 7</h6>
                                </div>
                                <!-- <div class="claim-head-col">
                                    <span></span>
                                    <h6>Step 8</h6>
                                </div> -->
                            </div>
                        </div>
                        <h5 class="claim-form-heading" style="margin-bottom:20px;">Treatment Summary</h5>
                        <div class="form">
                            <div style="display:none" id="pro_detls">
                                <h5 class="claim-form-heading">Provider Details</h6>
                                    <table class="table claim-submission-table">
                                        <thead>
                                            <tr>
                                                <th>Last name</th>
                                                <th>First name</th>
                                                <th>Clinic Name</th>
                                                <th>Clinic Full address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$provider->last_name}}</td>
                                                <td>{{$provider->first_name}}</td>
                                                <td>{{$office->clinic_name}}</td>
                                                <td>{{$office->address1}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="display:none" id="mem_detls">
                                    <h5 class="claim-form-heading">Member Details</h6>
                                    <table class="table claim-submission-table">
                                        <thead>
                                            <tr>
                                                <th>Policy Number</th>
                                                <th>Member Number</th>
                                                <th>Last name</th>
                                                <th>First name</th>
                                                <th>Relationship</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($family_members as $i => $family_member)
                                            <tr>
                                                <td>{{$family_member->policy_number}}</td>
                                                <td>{{$family_member->member_number}}</td>
                                                <td>{{$family_member->last_name}}</td>
                                                <td>{{$family_member->first_name}}</td>
                                                <td>
                                            <?php
                                            switch ($family_member->relationship) {
                                                case 0:
                                                    echo "Primary Member";
                                                    break;
                                                case 1:
                                                    echo "Spouse";
                                                    break;
                                                case 2:
                                                    echo "Dependent";
                                                    break;
                                                case 3:
                                                    echo "Parents";
                                                    break;
                                                case 4:
                                                    echo "Guest";
                                                    break;
                                                case 5:
                                                    echo "Partner";
                                                    break;
                                                default:
                                                    echo "Other";
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        <h5 class="claim-form-heading">Treatment Eligibility Details</h6>
                            <table class="table claim-submission-table">
                                <thead>
                                    <tr>
                                        <th width="5%">Line <br> No</th>
                                        <th width="5%">Service <br> Code</th>
                                        <th width="5%">Tooth <br> Number</th>
                                        <th width="5%">Tooth <br> Surfaces</th>
                                        <th width="20%">Service Description</th>
                                        <th width="5%">RBP <br> cost</th>
                                        <th width="5%">Lab <br> Fee</th>
                                        <th width="5%">Expense <br> Fee</th>
                                        <th width="20%">FCB Program Response</th>
                                    </tr>
                                </thead>
                                <tbody>     
                                @foreach($clinical_services_validated['claim']['claimLines']  as $i => $clinical_service)
                                    <tr>
                                        <td>{{$clinical_service['lineNumber']}}</td>
                                        <td>{{$clinical_service['serviceCode']}}</td>
                                        <td>{{$clinical_service['toothCode']}}</td>
                                        <td>{{$clinical_service['toothSurfaces']}}</td>
                                        <?php $rbp_cost = $clinical_service['eligibleServiceAmount'] - $clinical_service['planPaysAmount']; ?>
                                        <td>{{$clinical_service['serviceCodeSubcategory']}}</td>
                                        <td>${{number_format($rbp_cost, 2)}}</td>
                                        <td>${{number_format($clinical_service['eligibleLabAmount'],2)}}</td>
                                        <td>${{number_format($clinical_service['eligibleExpenseAmount'],2)}}</td>
                                        <td>{{$clinical_service['message']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h5 class="claim-form-heading">Treatment Summary Details</h6>    
                        
                            <div class="fcb-payment-review">
                                
                                <table class="table claim-submission-table">
                                    <thead>
                                        <tr>
                                            <th>Transaction code</th>
                                            <th>Processed date</th>
                                            <th>Total Member Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $process_date = $clinical_services_validated['claim']['processDate'];
                                                $process_date = strtok($process_date, "T");
                                                
                                               
                                            ?>
                                        
                                        <tr>
                            
                                            <td>{{$clinical_services_validated['claim']['claimCode'] ?? '-'}}</td>
                                            <td>{{$process_date}}</td>
                                            <td>${{number_format($clinical_services_validated['claim']['totalPatientPaysAmount'],2) ?? '-'}}</td>
                                           
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <h5 class="claim-form-heading">Final Confirmation</h5>
                        <div class="form">
@if($request_type =="claim") In the
event an FCB Member has an existing benefits plan, please submit
the fees outlined in the RBP Cost defined in Treatment Eligibility
details as assignment or non-assignment to the primary plan for
reimbursement and collect balance from the Member up to the
maximum defined under Total Member cost<br>
<b>Please Provide member a proof of
payment invoice from inhouse system</b>
@else 

This is an estimate. This estimate confirms member eligibility and eligible RBP
cost for when service is rendered.

@endif
<br>

                        </div>
                        <div>
                            <span class="claim-print" style="float: right;"><i class="fa fa-print" aria-hidden="true"></i>Print</span>
                        </div>
                        <div class="form">
                            <div class="edit-prv-off-row">
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                    <?php if($request_type =="claim"){?>
                                        <button type="submit" class="btn enrol-btn">Done</button>
                                        <a href="{{route('provider.start_over')}}?claimCode={{$clinical_services_validated['claim']['claimCode']}}" class="btn enrol-btn">Start Over</a>
                                    <?php }else{?>
                                        <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Done</a>
                                    <?php  }?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
            $('#pro_detls').show();
            $('#mem_detls').show();
            $('.family-name').hide();
            $('.family-profile-sec').print();
            $('#pro_detls').hide();
            $('#mem_detls').hide();
            $('.family-name').show();
        });
    });
</script>
<style>
    .table.claim-submission-table thead tr th {
        line-height: 20px;
    }
    .table thead th{
        vertical-align: middle;
    }
</style>
@endsection