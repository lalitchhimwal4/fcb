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
                        <!-- <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a> -->
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
                    <h5 class="claim-form-heading">Treatment Plan</h5>
                    <div class="form">
                        <div class="edit-prv-off-row">
                            @foreach($clinical_services as $i => $service)
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Line No.</label>
                                    <p>{{$i+1}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Service Code</label>
                                    <p>{{$service['service_code']}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Tooth Number</label>
                                    <p>{{$service['tooth_number']}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Tooth Surfaces</label>
                                    <p>{{$service['tooth_surfaces']}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Lab Fee</label>
                                    <p>${{$service['lab_fee']}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Expense Fee</label>
                                    <p>${{$service['expense_fee']}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Delete</label>
                                    <span class="delete-dental-service-btn" data-id="{{$i}}"><i class="fa fa-times"></i></span>
                                </div>
                            </div>
                            <hr />
                            @endforeach
                        </div>
                    </div>
                    <div class="form">
                        <div class="edit-prv-off-row">
                            <form action="{{route('provider.add_service_claim_step5')}}" method="post">
                                @csrf
                                @include('showmessages')
                                <div id="clinical-service-row" class="form enrol-login-form d-flex">
                                    <div class="form-group">
                                        <label class="enroll-label">Service Code</label>
                                        <input type="text" class="form-control" name="service_code">
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Tooth Number</label>
                                        <input type="text" class="form-control" name="tooth_number">
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Tooth Surfaces</label>
                                        <input type="text" class="form-control" name="tooth_surfaces">
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Lab Fee</label>
                                        <input type="number" class="form-control" name="lab_fee" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <label class="enroll-label">Expense Fee</label>
                                        <input type="number" class="form-control" name="expense_fee" step="0.01">
                                    </div>
                                </div>
                                <div class="cs-form-card cs-right d-flex align-items-center flex-wrap">
                                    <button type="submit" class="btn add-dental-service-btn">+ Add service</button>
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
                                    <a href="{{route('provider.submit_claim_cancellation')}}" class="btn enrol-btn">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
</script>
@endsection