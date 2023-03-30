@section('title','Payor-Dashboard')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Welcome</h4>
                        <p>{{$payor->contact_first_name." ".$payor->contact_last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('payor.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer">
            <div class="container">
                <div class="enroll-content-wrap">
                    @include('showmessages')
                    <div class="row cs-form-new-membr dashboard-welcome-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">
                                <h4>Account Information</h4>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end" data-toggle="modal" data-target="#searchModal">
                                <?php $googleElement = Get_Meta_Tag_Value('General_Settings', 'Google_Maps_API_Key') ? Get_Meta_Tag_Value('General_Settings', 'Google_Maps_API_Key') : ''; ?>
                                <a href="javascript:void(0);" class="enrol-btn">Search Nearby Provider</a>
                               
                            </div>
                        </div> -->
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span> Company Information</span></h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Company name</th>
                                            <th>Address 1</th>
                                            <th>Address 2</th>
                                            <th>Website</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$payor->company_name}}</td>
                                            <td>{{$payor->address1}}</td>
                                            <td>{{$payor->address2}}</td>
                                            <td>{{$payor->website}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Postal code</th>
                                            <th>Country</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td>{{$payor->city}}</td>
                                            <td>{{$payor->province}}</td>
                                            <td>{{$payor->postal_code}}</td>
                                            <td>{{$payor->country}}</td>
                                            
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span> Contact Information</span></h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Designation</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$payor->contact_last_name}}</td>
                                            <td>{{$payor->contact_first_name}}</td>
                                            <td>{{$payor->contact_designation}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Fax Number</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$payor->contact_email}}</td>
                                            <td>{{$payor->contact_telephone}}</td>
                                            <td>{{$payor->contact_fax}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span> Representative Information</span></h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Company name</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Designation</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$payor->rep_company_name}}</td>
                                            <td>{{$payor->rep_last_name}}</td>
                                            <td>{{$payor->rep_first_name}}</td>
                                            <td>{{$payor->rep_designation}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Extention</th>
                                            <th>Fax Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$payor->rep_email}}</td>
                                            <td>{{$payor->rep_telephone}}</td>
                                            <td>{{$payor->rep_telephone_ext}}</td>
                                            <td>{{$payor->rep_fax}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Address 1</th>
                                            <th>Address 2</th>
                                            <th>Website</th>
                                            <th>City</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$payor->rep_address1}}</td>
                                            <td>{{$payor->rep_address2}}</td>
                                            <td>{{$payor->rep_website}}</td>
                                            <td>{{$payor->rep_city}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            
                                            <th>Province</th>
                                            <th>Postal code</th>
                                            <th>Country</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td>{{$payor->rep_province}}</td>
                                            <td>{{$payor->rep_postal_code}}</td>
                                            <td>{{$payor->rep_country}}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <h5 class="enroll-cstm-form-heading"><span> Plan Information</span></h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>            
                                            <th>Policy Number</th>
                                            <th>Division</th>
                                            <th>Plan</th>
                                            <th>Effective date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$payor->policy_number}}</td>
                                            <td>{{$payor->division_number}}</td>
                                            <td>{{$payor->plan_number}}</td>
                                            <td>{{$payor->effective_date}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>            
                                            
                                            <th>Termination Date</th>
                                            <th>Billing Type</th>
                                            <th>Premium Rate (Single)</th>
                                            <th>Premium Rate (Family)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td>{{$payor->termination_date}}</td>
                                            <td>{{$payor->billing_type}}</td>
                                            <td>$<?=number_format((float)$payor->insured_signal_pre_rate, 2, '.', '');?></td>
                                            <td>$<?=number_format((float)$payor->insured_family_pre_rate, 2, '.', '');?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="table-responsive" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>            
                                            <th>Claim Rate(%)</th>
                                            <th>Total Claim Count</th>
                                            <th>Total Savings</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @if($payor->percentage_rate == '' || $payor->percentage_rate == 0)         
                                            <td>0.00%</td>         
                                        @else
                                        <td>{{$payor->percentage_rate}}%</td>      
                                        @endif 
                                            <td>{{$total_claim}}</td>
                                            <td>$<?=number_format((float)$plan_pays_amount, 2, '.', '');?></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>   
                    <div class="row">
                        <div class="col-sm-4">
                            
                        </div>
                        <div class="col-sm-4">
                            <a href="{{route('payor.invoice')}}" class="enrol-btn">Invoices</a>
                            <!-- <a href="{{route('payor.invoice')}}" class="enrol-btn">Invoices</a> -->
                        </div>
                        <div class="col-sm-4">
                            <a href="{{route('payor.membereligibility')}}" class="enrol-btn">Member Eligibility</a>
                            <!-- <a href="{{route('payor.membereligibility')}}" class="enrol-btn">Member Eligibility</a> -->
                        </div>
                    </div> 
                </div>
            </div>    
        </div>
    </div>
</section>

@endsection
@section('footerjs')
@endsection