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
                     @foreach($PayorInvoiceDetails as $InvoiceDetails)
                     @endforeach
                     <div class="row" style="margin-bottom:40px">
                        <div class="col-sm-6">
                           <h4>INVOICES DETAILS</h4>
                           <p>Invoice Number : {{ $InvoiceDetails->invoice_number}}
                        </div>
                        <div class="col-sm-6">      
                           <a href="{{route('payor.dashboard')}}" class="enrol-btn" style="float:right">Back to Dashboard</a>
                        </div>     
                     </div>
                     <h5 class="enroll-cstm-form-heading"><span> INVOICES DETAILS</span></h5>
                     <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive" id="family-scrollbar">
                                <table class="table family-table ">
                                    <thead>
                                        <tr>
                                            <th>Run Date</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($PayorInvoiceDetails as $InvoiceDetails)
                                        <tr>
                                            <td>{{$InvoiceDetails->invoice_run_date}}</td>
                                            <td>{{$InvoiceDetails->invoice_period_start}}</td>
                                            <td>{{$InvoiceDetails->invoice_period_end}}</td>
                                            <td>{{$InvoiceDetails->invoice_status}}</td>
                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="table-responsive" id="family-scrollbar">
                              <table class="table family-table ">
                                 <thead>
                                    <tr>
                                       <th>Count</th>
                                       <th>Description</th>
                                       <th>Rate</th>
                                       <th>Fee</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($PayorInvoiceDetails as $InvoiceDetails)
                                    <tr>
                                       <td>{{$InvoiceDetails->single_insured_count}}</td>
                                       <td>Single Plan Member</td>
                                       <td>${{$InvoiceDetails->insured_single_pre_rate }}</td>
                                       <td>${{$InvoiceDetails->single_insured_count * $InvoiceDetails->insured_single_pre_rate}}</td>
                                    </tr>
                                    <tr>
                                       <td>{{$InvoiceDetails->family_insured_count}}</td>
                                       <td>Family Plan Member</td>
                                       <td>${{$InvoiceDetails->insured_family_pre_rate}}</td>
                                       <td>${{$InvoiceDetails->family_insured_count * $InvoiceDetails->insured_family_pre_rate}}</td>
                                    </tr>
                                    <tr>
                                       <td>{{$InvoiceDetails->claim_count}}</td>
                                       <td>RBP Claim Submitted</td>
                                       <td>@if($InvoiceDetails->claim_RBP_amount != '')
                                             ${{$InvoiceDetails->claim_RBP_amount}}
                                          @else
                                             $0
                                          @endif
                                       </td>
                                       <td>@if($InvoiceDetails->claim_RBP_amount != '')
                                             ${{$InvoiceDetails->claim_count * $InvoiceDetails->claim_RBP_amount}}
                                          @else
                                             $0
                                          @endif
                                       </td>
                                    </tr>
                                 @endforeach   
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-7">

                        </div>
                        <div class="col-sm-3">
                           <table class="table family-table" id="invoice_total">
                              <thead>
                                 <tr>
                                    <th>Sub Total  
                                       <span>$
                                             {{$InvoiceDetails->single_insured_count * $InvoiceDetails->single_insured_fee + $InvoiceDetails->family_insured_count * $InvoiceDetails->family_insured_fee + $InvoiceDetails->claim_count * $InvoiceDetails->claim_RBP_amount}}
                                       </span>
                                 </tr> 
                                 <tr>
                                    <th>HST (13%)  <span><span>$
                                          <?php
                                          $hst = $InvoiceDetails->single_insured_count * $InvoiceDetails->single_insured_fee + $InvoiceDetails->family_insured_count * $InvoiceDetails->family_insured_fee + $InvoiceDetails->claim_count * $InvoiceDetails->claim_RBP_amount;
                                          $hst13 = $hst * 13;
                                          $hsttotal = $hst13 / 100;
                                          ?>
                                          {{$hsttotal}}
                                       </span>
                                    </th>
                                 </tr> 
                                 <tr>
                                    <br>
                                    <th>Total  <span><span>$
                                          {{$hsttotal + $hst}}
                                       </span>
                                    </th>
                                 </tr> 
                              <thead> 
                           </table>      
                        </div>
                        <div class="col-sm-2">

                        </div>
                     </div>
                    
                    <div class="row" id="DivIdToPrint" style="display:none;">
                    
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
<tr>
   <td width="49%">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td>
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                     <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">FCB HEALTH NETWORK</td>
                  </tr>
                  <tr>
                     <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">Suite 206, 421 Bloor Street E</td>
                  </tr>
                  <tr>
                     <td>Toronto, ON M4W3T1</td>
                  </tr>
                  <tr>
                     <td>T: (416) 929-4685</td>
                  </tr>
                  <tr>
                     <td>E: Support@fcbhealthnetwork.ca</td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">INVOICE NUMBER : <span style="font-weight:300;"> {{$InvoiceDetails->invoice_number}} </span></td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </td>
   <td width="51%" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td align="right">
               <a class="navbar-brand" href="{{url('/')}}" style="float: right;">
               @if(!empty(Get_Meta_Tag_Value('General_Settings','Header_Logo')))
               <img src="{{asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Header_Logo'))}}" alt="logo" class="navbar-brand-img" />
               @else
               <img src="{{asset('frontend_assets/images/logo.png')}}" alt="logo" class="navbar-brand-img" />
               @endif
               </a>
            </td>
         </tr>
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right"></td>
         </tr>
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;"  align="right">&nbsp;</td>
         </tr>
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">INVOICE DATE : <span style="font-weight:300;"> {{$InvoiceDetails->invoice_run_date}} </span></td>
         </tr>
      </table>
   </td>
</tr>
<tr>
   <td colspan="2">&nbsp;</td>
</tr>
<tr>
   <td colspan="2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;padding-left:10px" width="50%" height="32" align="left">Bill to :</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;padding-left:10px" width="50%" height="32" align="left">Plan Details</td>
         </tr>
         <tr>
            <td style="line-height: 24px;font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600;padding-left:10px" align="left">
               Company - {{$payor->company_name}} </br>
               Contact	- {{$payor->contact_first_name}} {{$payor->contact_last_name}} </br>
               Address - {{$payor->address1}} </br>
               Phone   - {{$payor->contact_telephone}} </br>
               Email   - {{$payor->contact_email}}</br>
            </td>
            <td style="line-height: 24px;font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600;border-right:1px solid #ff7600;padding-left:10px" align="left">
               Payor ID # : {{$payor->registration_id}}  </br>
               Group #: {{$payor->policy_number}} </br>
               Plan #: {{$payor->plan_number}} </br>
               Division #: {{$payor->division_number}} </br>
            </td>
         </tr>
      </table>
   </td>
</tr>
<tr>
   <td colspan="2">&nbsp;</td>
</tr>
<tr>
   <td colspan="2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
   <td></td>
   <td align="center">INVOICE PERIOD :  {{$InvoiceDetails->invoice_period_start}} -  {{$InvoiceDetails->invoice_period_end}}</td>
   <td></td>
</tr>
</td>
</tr>
<tr>
   <td colspan="2">&nbsp;</td>
</tr>
<tr>
   <td colspan="2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" width="10%" height="32" align="center">Qty</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" width="30%" height="32" align="center">Description</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #ff7600; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" width="20%" align="center">Claim Amount</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #ff7600; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" width="20%" align="center">Processing Rate</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #ff7600; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600; border-right:1px solid #ff7600;" width="20%" align="center">Fee</td>
         </tr>
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">{{$InvoiceDetails->single_insured_count}}</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" height="32" align="center">Single Plan Members</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">N/A</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">${{$InvoiceDetails->insured_single_pre_rate}}</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">${{$InvoiceDetails->single_insured_fee * $InvoiceDetails->single_insured_count}}</td>
         </tr>
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">{{$InvoiceDetails->family_insured_count}}</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" height="32" align="center">Family Plan Members</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">N/A</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">${{$InvoiceDetails->insured_family_pre_rate}}</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">${{$InvoiceDetails->family_insured_fee * $InvoiceDetails->family_insured_count}}</td>
         </tr>
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">{{$InvoiceDetails->claim_count}}</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" height="32" align="center">RBP Claim Submitted</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">N/A</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">${{$InvoiceDetails->claim_RBP_amount}}</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #ff7600; border-right:1px solid #ff7600; border-right:1px solid #ff7600;" align="center">${{$InvoiceDetails->claim_RBP_amount * $InvoiceDetails->claim_count}}</td>
         </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:0px solid #ff7600;" width="65%" height="32" align="center"></td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:0px solid #ff7600; border-right:1px solid #ff7600;" width="15%" height="32" align="center">Subtotal</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" width="20%" height="32" align="center">${{$InvoiceDetails->single_insured_count * $InvoiceDetails->single_insured_fee + $InvoiceDetails->family_insured_count * $InvoiceDetails->family_insured_fee + $InvoiceDetails->claim_RBP_amount * $InvoiceDetails->claim_count}}</td>
         </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:0px solid #ff7600;" width="65%" height="32" align="center"></td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:0px solid #ff7600; border-right:1px solid #ff7600;" width="15%" height="32" align="center">HST (13%)</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" width="20%" height="32" align="center">${{$hsttotal}}</td>
         </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr style="background: #ff7600;">
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" width="65%" height="32" align="center"></td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" width="15%" height="32" align="center">Total</td>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:0px solid #ff7600; border-bottom:1px solid #ff7600; border-left:1px solid #ff7600; border-right:1px solid #ff7600;" width="20%" height="32" align="center">${{$hsttotal + $hst}}</td>
         </tr>
      </table>
   </td>
</tr>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="5%">&nbsp;</td>
      <td width="40%">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
               <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">Cheque Payments To:</td>
                     </tr>
                     <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">FCB Relief Fund</td>
                     </tr>
                     <tr>
                        <td>Suite 206, 421 Bloor Street E.</td>
                     </tr>
                     <tr>
                        <td>Toronto, ON M4W3T1</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
      </td>
      <td width="40%" valign="top">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
               <td>&nbsp;</td>
            </tr>
            <tr>
               <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">Wire Transfer Payments To:</td>
            </tr>
            <tr>
               <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">Beneficiary Acc# : 05752-004-5248766</td>
            </tr>
            <tr>
               <td>Bank:                   TD</td>
            </tr>
            <tr>
               <td>Swift Code:          TDOMCATTTOR</td>
            </tr>
            <tr>
               <td>Bank Address:      80 O'Connor Dr. East York, ON M4B2S7  </td>
            </tr>
            <tr>
               <td>Transit:                05752  </td>
            </tr>
            <tr>
               <td>Inst. No:              004 </td>
            </tr>
         </table>
      </td>
      <td width="5%">&nbsp;</td>
   </tr>
</table>
<table>
   <tr>
      <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:12px;" colspan="2">Please note that this account is payable on receipt. If not paid within 30 days from the invoice date, interest at the rate of prime plus 2% per annum will be charged from the invoice date.</td>
   </tr>
   <tr>
      <td colspan="2" style="font-weight:600;">If you have any questions concerning this invoice,contact:<br><span style="color:#e63b2b">(416) 929-4685 | Support@fcbhealthnetwork.ca</span></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
   </tr>
   <tr>
      <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:16px;color:#e63b2b" colspan="2" align="center">Thank you for your trust!</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
   </tr>
</table>
</table> 
   
   <style>
    .view_btn{
        padding: 5px 26px !important;
    }
    .navbar-brand img{
        width: 135px !important;
    }
    #invoice_total span{
      font-weight: normal;
      float: right;
    }
</style>
               </div>  
               <div class="row cs-form-new-membr dashboard-welcome-wrap mt-5">
                  <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                     <a href="{{route('payor.invoice')}}" class="enrol-btn">Back</a> 
                  </div>
                  <div class="col-lg-6 col-lg-6 col-sm-12 col-12 text-center">
                     <div class="cs-form-card d-flex align-items-center flex-wrap">
                        <button href="#" onclick='printDiv();' class="enrol-btn">Print</button>
                     </div>
                  </div>
               </div> 
            </div>
         </div>    
      </div>
   </div>
</section>
<script>
   function printDiv() {
      document.getElementById("DivIdToPrint").style.display = "block";
      var divToPrint=document.getElementById('DivIdToPrint');
      var newWin=window.open('','Print-Window');
      newWin.document.open();
      newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
      newWin.document.close();
      document.getElementById("DivIdToPrint").style.display = "none";
      setTimeout(function(){newWin.close();},10);
   }
</script>

@endsection
@section('footerjs')
@endsection