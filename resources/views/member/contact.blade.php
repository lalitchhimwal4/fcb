@section('title','Member-Dashboard')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Contact Details</h4>
                        <p>{{Auth::guard('member')->user()->first_name.' '.Auth::guard('member')->user()->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer">
            <div class="container">
                <div class="enroll-content-wrap">
                    @include('showmessages')
                    <div class="row cs-form-new-membr">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">
                                <h4>View/Edit Contact Details</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                                <a href="{{route('member.editcontact')}}" class="enrol-btn">Edit Contact Details</i></a>
                            </div>
                        </div>
                    </div>

                    <h5 class="enroll-cstm-form-heading"><span> Contact Information </span></h5>
                    <div class="row">
                        <br>
                    </div>
                    <div class="table-responsive">
                        <table class="table family-table1">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address1</th>
                                    <th>City</th>
                                </tr>
                                <tr>    
                                    <td>{{Auth::guard('member')->user()->first_name}}</td>
                                    <td>{{Auth::guard('member')->user()->last_name}}</td> 
                                    <td>{{$contactdetails->address1}}</td>
                                    <td>{{$contactdetails->city}}</td>
                                </tr>
                                <tr>    
                                    <th>Province</th>
                                    <th>Postal Code</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    
                                </tr>
                                <tr>    
                                    
                                    <td>
                                        <?php
                                        switch ($contactdetails->province) {
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
                                        ?>
                                    </td>
                                    <td>{{$contactdetails->postal_code}}</td>
                                    <td>{{$contactdetails->telephone}}</td>
                                    <td>{{$contactdetails->email}}</td>
                                </tr>
                                
                            </thead>
                            
                        </table>
                    </div>

                    <div class="row cs-form-new-membr">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">

                                <!-- <a href="{{route('member.family')}}" class="enrol-btn family-bottom-btn"> View/Edit Dependents <i class="fas fa-arrow-right"></i></a> -->
                            </div>
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