@section('title','Step 5')
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
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="enroll-content-outer provider-dashboard edit-provider-details">
            <div class="container">
                <div class="enroll-content-wrap">
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
                            <div class="claim-head-col done before-active">
                                <span></span>
                                <h6>Step 4</h6>
                            </div>
                            <div class="claim-head-col active">
                                <span></span>
                                <h6>Step 5</h6>
                            </div>
                            <div class="claim-head-col">
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
                    @if(!$clinical_services == '') <h5 class="claim-form-heading" style="padding-bottom: 10px;">Treatment Plan </h5>@endif
                    <div class="form">
                        <div class="edit-prv-off-row">
                        @if(!$clinical_services == '')
                            <table class="table">
                                <tr>
                                    <td><b>Line No.</b></td>
                                    <td><b>Service Code</b></td>
                                    <td><b>Service Category</b></td>
                                    <td><b>Service Description</b></td>
                                    <td><b>RBP Cost</b></td>
                                    <td><b>Delete</b></td>     
                                </tr> 
                            @endif       
                            @foreach($clinical_services as $i => $service)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$service['service_code']}}</td>
                                    <td>{{$service['service_code_category']}}</td>
                                    <td>{{$service['service_code_subcategory']}}</td>
                                    <td>${{number_format($service['expense_fee'],2)}}</td>
                                    <td><span class="delete-dental-service-btn" data-id="{{$i}}"><i class="fa fa-times"></i></span></td>     
                                </tr>
                                   
                           
                            @endforeach
                        </table>
                        </div>
                        
                    </div>
                    <div class="form">
                        <div class="edit-prv-off-row">
                            <form action="{{route('provider.add_service_claim_step5')}}" method="post">
                                @csrf
                                @include('showmessages')
                                
                                <div class="row" style="display: unset;">
                                    <div class="form-group">
                                        <label class="claim-form-heading" style="cursor: pointer;" onClick=ShowService();>Select Eligible Service <span style="color:#000;">( Call FCB support to add missing Services )</span></label>
                                        <select class="form-control" id="service_code" style="display:none;">
                                        <option value="" style="color:red;font-weight:700;">Service Code | Service Code Description</option>
                                        @foreach($service_code as $service)
                                            <option value="{{$service['id']}}" >{{$service['service_code']}} &emsp;&emsp;&emsp;| {{$service['service_code_category']}} - {{$service['service_code_subcategory']}}</option>
                                        @endforeach
                                        </select>   
                                                                           
                                    </div>
                                    
                                </div> 
                                <div id="clinical-service-row" class="form enrol-login-form d-flex"> 
                                    <div class="form-group">
                                        <!-- <label class="enroll-label">Service code</label> -->
                                        <input type="hidden" class="form-control" name="service_code" id="service_cod_hidden">
                                        <!-- <input type="text" class="form-control" id="service_cod" value="" step="0.01" disabled> -->
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="enroll-label">Lab Fee ($)</label> -->
                                        <input type="hidden" class="form-control" name="lab_fee" id="gross_fee_hidden" value="" step="0.01" >
                                        <!-- <input type="text" class="form-control" id="gross_fee" value="" step="0.01" disabled> -->
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="enroll-label">Expense Fee ($)</label> -->
                                        <input type="hidden" class="form-control" name="expense_fee" id="service_fee_hidden" value="" step="0.01" >
                                        <!-- <input type="text" class="form-control"  id="service_fee" step="0.01" disabled> -->
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="enroll-label">Service Code Category</label> -->
                                        <input type="hidden" class="form-control"  name="service_code_category" id="service_code_category_hidden" step="0.01">
                                        <!-- <input type="text" class="form-control"  id="service_code_category" step="0.01" disabled> -->
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="enroll-label">Service Code Subcategory</label> -->
                                        <input type="hidden" class="form-control"  name="service_code_subcategory" id="service_code_subcategory_hidden" step="0.01">
                                        <!-- <input type="text" class="form-control"  id="service_code_subcategory" step="0.01" disabled> -->
                                    </div>
                                </div>
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                    <button type="submit" id="add_service_btn" class="btn add-dental-service-btn" style="display:none">+ Add service</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form">
                        <div class="edit-prv-off-row">
                            <form action="{{route('provider.submit_claim_step5')}}" method="post">
                                @csrf
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                    <button type="submit" class="btn enrol-btn" @if(count($clinical_services)==0) disabled @endif>Validate</button>
                                    <a href="{{route('provider.submit_claim_cancellation')}}" class="enrol-btn btn">Cancel</a>
                                </div>
                            </form>
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
<style>
    .enroll-label {
        font-size: 15px;
    }
    .enrol-login-form .form-group:not(:last-child) {
        padding-right: 10px;
    }
    .enrol-login-form .form-group1:not(:last-child) {
        padding-right: 30px;
    }
</style>
@endsection
@section('footerjs')
<script>
    $(document).ready(function() {
        $(this).on('click', '.delete-dental-service-btn', function() {
            const id = $(this).data('id');
            const container = $(this).closest('.edit-prv-off-row');
            $.ajax({
                url: `{{route('provider.remove_service_claim_step5')}}`,
                type: 'POST',
                data: {
                    "_token": "{{csrf_token()}}",
                    "id": id
                },
                success: function(res) {
                    if (res.error) {
                        const html = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            ${res.error}
                                            <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>`;
                        container.prepend(html);
                        return;
                    }

                    location.replace(window.location);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    const html = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            ${textStatus}
                                            <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>`;
                    container.append(html);
                }
            });
        });
    });


    $('#service_code').change(function(){
        var service_code_id = $('#service_code').val();
        $.ajax({
            url: `{{route('getFeeData')}}`,
            type: 'GET',
            data: {
                "_token": "{{csrf_token()}}",
                "service_code_id": service_code_id
            },
            success: function(res) {
                $('#service_cod').val(res.service_code);
                $('#gross_fee').val(res.gross_fee);
                $('#service_fee').val(res.service_fee);
                $('#service_code_category').val(res.service_code_category);
                $('#service_code_subcategory').val(res.service_code_subcategory);
                $('#service_cod_hidden').val(res.service_code);
                $('#gross_fee_hidden').val(res.gross_fee);
                $('#service_fee_hidden').val(res.service_fee);
                $('#service_code_category_hidden').val(res.service_code_category);
                $('#service_code_subcategory_hidden').val(res.service_code_subcategory);
            }
        });    
    });
    function ShowService(){
        $('#service_code').show();
        $('#add_service_btn').show();
    }
</script>
@endsection