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
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12 text-center">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">
                                <h4>Invoices <br><span  style="font-size: 14px;">Group Health</span></h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            
                            <a href="{{route('payor.dashboard')}}" class="enrol-btn" style="float:right">Back to Dashboard</a>
                           
                        </div>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span> Invoices to Date</span></h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Invoice Date</th>
                                            <th>Invoice Number</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Amount Due</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($PayorAllInvoices as $PayorAllInvoice)
                                        <tr>
                                            <td><?php echo substr($PayorAllInvoice->invoice_run_date, 0, 10)?></td>
                                            <td>{{$PayorAllInvoice->invoice_number}}</td>
                                            <td>{{$PayorAllInvoice->invoice_period_start}}</td>
                                            <td>{{$PayorAllInvoice->invoice_period_end}}</td>
                                            <td>{{$PayorAllInvoice->invoice_total_net_amount}}</td>
                                            <td>{{$PayorAllInvoice->invoice_status}}</td>
                                            <td><a href="{{route('payor.invoice.view',$PayorAllInvoice->id)}}" class="enrol-btn view_btn">View</a></td>
                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>    
        </div>
    </div>
</section>
<style>
    .view_btn{
        padding: 5px 26px !important;
    }
</style>
@endsection
@section('footerjs')
@endsection