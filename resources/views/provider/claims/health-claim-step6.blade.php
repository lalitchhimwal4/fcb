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
                            //print_r($clinical_services); die();
                            if(!empty($clinical_services)){
                                echo '<h5 class="claim-form-heading" style="margin-bottom:15px;">Treatment Response</h5>';
                                if($clinical_services['processStatus'] == 'Completed'){
                                        if($clinical_services['claim']['statusDescription'] == 'APPROVED'){
                                            echo 'Treatment Eligibility Approved, please review
                                            eligibility details and “Continue” to complete process';
                                        }elseif($clinical_services['claim']['statusDescription'] == 'FAILED'){
                                            echo 'Treatment Eligibility Failed due to System Failure, Please call FCB Support';
                                        }else{
                                            echo 'Treatment Eligibility Declined, please review eligibility details and select “Go Back” to correct';
                                            }
                                }else{
                                    echo 'Treatment Eligibility Failed due to System Failure, please
                                    call FCB Support';
                                }
                            }    
                            else{
                                echo '<h5 class="claim-form-heading" style="margin-bottom:15px;">Treatment Response</h5>';
                                echo 'Treatment Eligibility Failed due to System Failure, please
                                call FCB Support';
                            }

                        ?>   
                    </div>
                   
                    
                    <div class="form">
                        <div class="edit-prv-off-row"><br>
                        <hr>
                        <?php 
                        if(!empty($clinical_services)){
                                echo '<h5 class="claim-form-heading">Treatment Eligibility Details</h5>
                                ';
                               
                            if($clinical_services['processStatus'] == 'Completed'){
                                
                                if($clinical_services['claim']['statusDescription'] != ''){
                                    $process_date = $clinical_services['claim']['processDate'];
                                    $process_date = strtok($process_date, "T");
                                    ?>    
                                    <form action="{{route('provider.submit_claim_step6')}}" method="post">
                                        @csrf
                                        @include('showmessages')
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="5%">Line <br> No</th>
                                                    <th width="5%">Service <br> Code</th>
                                                    <th width="25%">Service <br> Category</th>
                                                    <th width="25%">Service <br> Description</th>
                                                    <th width="5%">RBP <br> Cost</th>
                                                    <th>FCB program response</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($clinical_services['claim']['claimLines'] as $i => $clinical_service)
                                                    <tr>
                                                        <td>{{$clinical_service['lineNumber']}}</td>
                                                        <td>{{$clinical_service['serviceCode']}}</td>
                                                        <td>{{$clinical_service['serviceCodeCategory']}}</td>
                                                        <td>{{$clinical_service['serviceCodeSubcategory']}}</td>
                                                        <td>${{number_format($clinical_service['eligibleServiceAmount'],2)}}</td>
                                                        <td>{{$clinical_service['message']}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                     
                                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                            @if($clinical_services['claim']['statusDescription'] == 'REJECT') 
                                                @if($request_type =="claim" && $clinical_services['claim']['claimCode'] != '')
                                                    <a href="{{route('provider.start_over')}}?claimCode={{$clinical_services['claim']['claimCode']}}" class="btn enrol-btn">Back</a>
                                                @else
                                                    <a href="{{route('provider.claim_step5')}}" class="btn enrol-btn">Back</a>
                                                @endif
                                            @endif
                                            @if($clinical_services['claim']['statusDescription'] == 'APPROVED')
                                                <button type="submit" class="btn enrol-btn">Continue</button>
                                            @endif
                                            @if($clinical_services['claim']['statusDescription'] == 'FAILED')
                                            <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Continue</a>
                                            @endif
                                               
                                        </div>
                                    
                                    <?php }else{?>
                                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                            
                                            <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Continue</a>
                                        </div>
                                    <?php } ?>

        
                            <?php }else{?>
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%">Line <br> No</th>
                                                <th width="5%">Service <br> Code</th>
                                                <th width="25%">Service <br> Category</th>
                                                <th width="25%">Service <br> Description</th>
                                                <th width="5%">RBP <br> Cost</th>
                                                <th>FCB program response</th>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Continue</a>
                                </div>
                            <?php } ?> 
                                <?php }else{?>
                                    <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="5%">Line <br> No</th>
                                                    <th width="5%">Service <br> Code</th>
                                                    <th width="25%">Service <br> Category</th>
                                                    <th width="25%">Service <br> Description</th>
                                                    <th width="5%">RBP <br> Cost</th>
                                                    <th>FCB program response</th>
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