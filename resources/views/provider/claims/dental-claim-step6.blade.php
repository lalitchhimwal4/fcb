@section('title','Step 6')
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
                <div class="enroll-content-wrap">
                    <div>
                    <h4>@if($request_type =="claim") Claim Submission Form @else Treatment Estimate Submission @endif</h4>
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
                            <div class="claim-head-col done before-active">
                                <span></span>
                                <h6>Step 5</h6>
                            </div>
                            <div class="claim-head-col active">
                                <span></span>
                                <h6>Step 6</h6>
                            </div>
                            <div class="claim-head-col">
                                <span></span>
                                <h6>Step 7</h6>
                            </div>
                            <!-- <div class="claim-head-col">
                                <span></span>
                                <h6>Step 8</h6>
                            </div> -->
                        </div>
                    </div>
                    <!-- <h5 class="claim-form-heading">Treatment Eligibility</h5> -->
                    <hr>
                    <div class="form">
                    <?php 
                        if(!empty($invalid_clinical_services)){
                                echo '<h5 class="claim-form-heading" style="margin-bottom:15px">Treatment Response</h5>
                                '; 
                                   
                            if($invalid_clinical_services['processStatus'] == 'Completed'){
                                    if($invalid_clinical_services['claim']['statusDescription'] == 'APPROVED'){
                                        echo 'Treatment Eligibility Approved, please review eligibility details and “Continue” to complete process.';
                                    }elseif($invalid_clinical_services['claim']['statusDescription'] == 'FAILED'){
                                        echo 'Treatment Eligibility Failed due to System Failure, please call FCB Support';
                                    }else{
                                        echo 'Treatment Eligibility Declined, please review eligibility details and select “Go Back” to correct';
                                         }
                            }else{
                                echo 'Treatment Eligibility Failed due to System Failure, please
                                call FCB Support';
                            }
                        }else{
                            echo 'Treatment Eligibility Failed due to System Failure, please
                            call FCB Support';
                        }
                            
                        ?>
                        <div class="edit-prv-off-row">
                            <hr>
                        <?php 
                            //echo "<pre>";
                           // print_r($invalid_clinical_services);die();
                            if(!empty($invalid_clinical_services['processStatus'] == 'Completed')){
                                echo '<h5 class="claim-form-heading" style="margin-bottom:15px">Treatment Eligibility Details</h5>
                                ';
                                if($invalid_clinical_services){
                                    if($invalid_clinical_services['claim']['statusDescription'] != ''){
                                        $process_date = $invalid_clinical_services['claim']['processDate'];
                                        $process_date = strtok($process_date, "T");
                                        ?>
                                        <form action="{{route('provider.submit_claim_step6')}}" method="post">
                                        @csrf
                                        @include('showmessages')
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
                                                    <!-- <th>Processed Date</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                          
                                            @foreach($invalid_clinical_services['claim']['claimLines']  as $i => $clinical_service)
                                                <tr>
                                                    <td>{{$clinical_service['lineNumber']}}</td>
                                                    <td>{{$clinical_service['serviceCode']}}</td>
                                                    <td>{{$clinical_service['toothCode']}}</td>
                                                    <td>{{$clinical_service['toothSurfaces']}}</td>
                                                    <td>{{$clinical_service['serviceCodeSubcategory']}}</td>
                                                    <?php $rbp_cost = $clinical_service['eligibleServiceAmount'] - $clinical_service['planPaysAmount']; ?>
                                                    <td>${{number_format((float)$rbp_cost, 2, '.', '')}}</td>
                                                    <td>${{number_format($clinical_service['eligibleLabAmount'],2)}}</td>
                                                    <td>${{number_format($clinical_service['eligibleExpenseAmount'],2)}}</td>
                                                    <td>{{$clinical_service['message']}}</td>
                                                    <!-- <td>{{$process_date}}</td> -->
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                            @if($invalid_clinical_services['claim']['statusDescription'] == 'REJECT') 
                                                @if($request_type =="claim" && $invalid_clinical_services['claim']['claimCode'] != '')
                                                    <a href="{{route('provider.start_over')}}?claimCode={{$invalid_clinical_services['claim']['claimCode']}}" class="btn enrol-btn">Back</a>
                                                @else
                                                    <a href="{{route('provider.claim_step5')}}" class="btn enrol-btn">Back</a>
                                                @endif
                                            @endif    
                                            @if($invalid_clinical_services['claim']['statusDescription'] == 'APPROVED')
                                                <button type="submit" class="btn enrol-btn" @if($failed) disabled @endif>Continue</button>
                                            @endif
                                            @if($invalid_clinical_services['claim']['statusDescription'] == 'FAILED')
                                            <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Continue</a>
                                            @endif
                                            <!-- <a href="{{route('provider.submit_claim_cancellation')}}" class="enrol-btn cancel-btn">Cancel</a> -->
                                        </div>
                                    
                                    <?php }else{?>
                                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                            
                                            <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Continue</a>
                                        </div>
                                    <?php } ?>

                                <?php }else{?>
                                    <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                        
                                        <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Continue</a>
                                    </div>
                                <?php } ?>
                            <?php }else{?>
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                    <table class="table claim-submission-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">Line <br> No</th>
                                                <th width="5%">Service <br> Code</th>
                                                <th width="20%">Service Description</th>
                                                <th width="5%">RBP <br> cost</th>
                                                <th width="5%">Lab <br> Fee</th>
                                                <th width="5%">Expense <br> Fee</th>
                                                <th width="20%">FCB Program Response</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?=$invalid_clinical_services['errorMessage'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Continue</a>
                                </div>
                            <?php } ?>  
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .table.claim-submission-table thead tr th {
        line-height: 20px;
    }
    .table thead th{
        vertical-align: middle;
    }
</style>
@endsection