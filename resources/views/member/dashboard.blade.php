@section('title','Member-Dashboard')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="family-profile-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Welcome</h4>
                        <p>{{$member->first_name." ".$member->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
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
                    <!-- <div class="row mb-5">
                        <div class="col-sm-12">
                            @if(session('upgrade_url'))
                                <a class="enrol-btn" onClick=upgradeplan("{{route('member.update.password.alert')}}","{{session('upgrade_url')}}") href="{{session('upgrade_url') }}">
                                    Click Here For Upgrade Plan!  
                                </a>
                            @endif
                            @if(session('activated'))
                                <a class="enrol-btn" onClick=changenowpassword("{{route('member.update.password.alert')}}","{{session('activated')}}")>
                                    Click Here!  
                                </a>
                            @endif
                        </div>    
                    </div> -->
                    <div class="row cs-form-new-membr dashboard-welcome-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap">
                                <h4>Account Information</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end" data-toggle="modal" data-target="#searchModal">
                                <?php $googleElement = Get_Meta_Tag_Value('General_Settings', 'Google_Maps_API_Key') ? Get_Meta_Tag_Value('General_Settings', 'Google_Maps_API_Key') : ''; ?>
                                <a href="javascript:void(0);" class="enrol-btn">Search Nearby Provider</a>
                                <!-- searchproviderjs() function defined in bladefiles.js -->
                            </div>
                        </div>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span> Registration Information</span></h5>
                    <div class="table-responsive" id="family-scrollbar">
                        <table class="table family-table dashboard-table">
                            <thead>
                                <tr>
                                    <th>Account Number</th>
                                    <th>Registration Date</th>
                                    <th>Registration Method</th>
                                    <th>Account Status</th>
                                    <th>Password</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$member->family_number}}</td>
                                    <td>{{$member->registration_date}}</td>
                                    <td>{{$member->registration_method}}</td>
                                    <td> <?php
                                            $account_statuses = get_default_values_from_mastertable('members', 'account_status');
                                            if ($account_statuses != 0)
                                                echo $account_statuses[$member->account_status];
                                            else
                                                echo "-";
                                            ?>
                                    </td>
                                    <td class="edit-td">********<a href="{{route('member.changepassword')}}" class="text-danger"><i class="fas fa-edit"></i> Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                   
                    <h5 class="enroll-cstm-form-heading"><span> Registered Members</span></h5>
                    <div class="table-responsive" id="family-scrollbar">
                    @if($family_members->count() < 1) 
						<p>You have not enrolled any family member</p>
					@endif
                    <?php $i = 1; ?>
                    <div class="table-responsive">
							<table class="table family-table">
								<thead>
									<tr>
                                        <th>Member Number</th>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Gender</th>
										<th>Date of Birth</th>
										<th>Relationship</th>
										<th>Action</th>
									</tr>
								</thead>
					@foreach($family_members as $family_member)
                        
						
								<tbody>
									<tr>
                                        <td>{{$family_member->member_number}}</td>
										<td>{{$family_member->last_name}}</td>
										<td>{{$family_member->first_name}}</td>
										<td><?php echo ($family_member->gender == 0) ? 'Male' : 'Female'; ?></td>
										<td>{{$family_member->dob}}</td>
										<td>{{get_default_values_from_mastertable('members','relationship')[$family_member->relationship];}}</td>
										<td>
											<a href="{{route('member.familymember.edit',$family_member->id)}}"> <i class="fas fa-edit"></i></a>
											@if($family_member->relationship != 0) @if($insuredProfile->plan_id != 2)  <a href="{{route('member.familymember.delete',$family_member->id)}}" onclick="return confirm('Are you sure you want to delete this member ?')"> <i class="fas fa-trash-alt"></i></a> @endif @endif
										</td>
									</tr>
								</tbody>
							
                        <?php $i++; ?>
					@endforeach
                    </table>
				</div>
                @if($insuredProfile->plan_id == 0 || $insuredProfile->plan_id == 2)
                <a href="{{route('member.enrollfamilymember')}}" class="enrol-btn family-bottom-btn"> Add New Member <i class="fas fa-arrow-right"></i></a>
                @endif
            </div>
                    
                    <h5 class="enroll-cstm-form-heading"><span>Payment Gateway</span></h5>
                    @if($insuredProfile->plan_id == 0) 
                    <label class="enroll-label">Plan Type<sup>*</sup></label>
                    <div class="table-responsive" id="family-scrollbar">
                        <form action="{{route('member.paypalpayment')}}" method="POST" id="enroll_step2_form">
                            @csrf
                            <input type="hidden" name="email" value="{{$insuredProfile->email}}">
                            <input type="hidden" name="fname" value="{{$member->first_name}}">
                            <input type="hidden" name="lname" value="{{$member->last_name}}">
                            <?php $total = $family_members->count(); 
                            if($total > 1){
                                echo '<input type="radio" name="plan" value="1" disabled="disabled"> Single Member - ('; echo Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_amount') ? ' $' . Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_amount') : '';echo ")<br>";
                                echo '<input type="radio" name="plan" value="2" checked> Family Member - (';echo Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_amount') ? ' $' . Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_amount') : '';echo ")";
                               
  
                            }elseif($total <= 1){
                                echo '<input type="radio" name="plan" value="1" checked> Single Member - (';echo Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_amount') ? ' $' . Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_amount') : '';echo ")<br>";
                                echo '<input type="radio" name="plan" value="2" disabled="disabled"> Family Member - (';echo Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_amount') ? ' $' . Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_amount') : '';echo ")";
                                
                            }
                            ?>
                            
                            <div class="form enrol-login-form enroll-login-credit-form d-flex flex-wrap ">
                                <div class="d-flex">
                                    <div class="form-group">
                                        <label class="enroll-label">Payment Gateway<sup>*</sup></label>
                                        <div class="credit-card-buttons">
                                            <label class="cstm-radio-label paypal-label">Paypal - (Payment is mandatory to start coverage)
                                                <input type="radio" name="paymentmethod" value="2" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="paypal-notes">The email used for paying for the monthly subscription will be used to notify you for all future transactions</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
    <?php 
        $total = $family_members->count(); 
        if($total == 1){
            $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_plan_id') ?? '';
            $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_member_subscription_product_id') ?? '';
            $planID = '1';
        }else{
            $plan_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_plan_id') ?? '';
            $product_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_family_member_subscription_product_id') ?? '';
            $planID = '2';
        }
        
        $client_ID = Get_Meta_Tag_Value('Payment_Settings', 'paypal_client_id') ?? '';     
    ?>                        
  <script src="https://www.paypal.com/sdk/js?client-id=<?=$client_ID;?>&vault=true&intent=subscription">
  </script> 

  <div id="paypal-button-container" style="width:30%"></div>

    <script>
      paypal.Buttons({
        createSubscription: function(data, actions) {
          return actions.subscription.create({
            'plan_id': '<?=$plan_ID;?>' // Creates the subscription
          });
        },
        onApprove: function(data, actions) {
            //console.log(data);

          //alert('You have successfully created subscription ' + data.subscriptionID); // Optional message given to subscriber
          
          upgradememberplan(data.subscriptionID, data.orderID, <?=$planID;?>);
        }
      }).render('#paypal-button-container'); // Renders the PayPal button
    </script>
  
                            <!-- <button type="submit" id="enroll_step2_form_submit" style="border: none;background-color:white;"><img src="{{asset('frontend_assets/images/paypal.png')}}"></button> -->
                        </form>
                        <!-- <button onClick=upgradememberplan1()>Click me</button> -->
                    </div>
                    @endif
                    @if($insuredProfile->plan_id == 1) 
                        <p style="color: green;"><br><strong>Member plan activated - Single coverage ($10)</strong></p>
                        @if($insuredProfile->plan_id == 1) <a href="{{url('member/upgrade-family-plan')}}" target="_blank" class="enrol-btn family-bottom-btn">Upgrade to family coverage ($$$) <i class="fas fa-arrow-right"></i></a> @endif
                    @elseif($insuredProfile->plan_id == 2)
                        <p style="color: green;"><br><strong>Member plan activated - Family coverage ($20)</strong></p>
                        <!--@if($insuredProfile->plan_id == 2) <a href="{{url('member/downgrade-single-plan')}}" class="enrol-btn family-bottom-btn">Downgrade to single coverage ($$$) <i class="fas fa-arrow-right"></i></a> @endif
                -->@endif
                    <h5 class="enroll-cstm-form-heading"><span>Contact Information</span></h5>
                    <div class="row cs-form-new-membr view-edit-cstm-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap view-ed-cstm">
                                <a href="{{route('member.contact')}}" class="enrol-btn family-bottom-btn"> View/Edit Contact Details <i class="fas fa-arrow-right"></i></a>
                                <!-- <a href="{{route('member.family')}}" class="enrol-btn family-bottom-btn"> View/Edit Dependents <i class="fas fa-arrow-right"></i></a> -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end">
                                @if($insuredProfile->plan_id == 1 || $insuredProfile->plan_id == 2) 
                                <a href="{{Get_Meta_Tag_Value('General_Settings','Vision_Portal_Member_Dashboard')?Get_Meta_Tag_Value('General_Settings','Vision_Portal_Member_Dashboard'):'javascript:void(0);'}}" class="enrol-btn"> vision portal <i class="fas fa-arrow-right"></i></a>
                                <a href="{{Get_Meta_Tag_Value('General_Settings','Pharm_Portal_Member_Dashboard')?Get_Meta_Tag_Value('General_Settings','Pharm_Portal_Member_Dashboard'):'javascript:void(0);'}}" class="enrol-btn"> pharm portal <i class="fas fa-arrow-right"></i></a>
                                @else
                                <a href="javascript:void(0);" onClick=VisionPharma() class="enrol-btn"> vision portal <i class="fas fa-arrow-right"></i></a>
                                <a href="javascript:void(0);" onClick=VisionPharma() class="enrol-btn"> pharm portal <i class="fas fa-arrow-right"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span>Treatment History</span></h5>
                    <div class="row cs-form-new-membr view-edit-cstm-wrap">
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card d-flex align-items-center flex-wrap view-ed-cstm">
                                <a href="{{route('member.view_claims')}}" class="enrol-btn family-bottom-btn"> View List of Treatments Performed <i class="fas fa-arrow-right"></i></a>
                                <!-- <a href="{{route('member.family')}}" class="enrol-btn family-bottom-btn"> View/Edit Dependents <i class="fas fa-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- The Modal (Password Change alert)-->
<div class="modal fade" id="changepasswordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notice</h5>
                <button type="button" class="close" onClick=changelaterpassword("{{route('member.update.password.alert')}}") aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Please change your system generated password to make your account more secure.
            </div>
            <div class="modal-footer">
                <button type="button" onClick=changelaterpassword("{{route('member.update.password.alert')}}") class="btn enrol-btn">I will change later</button>
                <button type="button" onClick=changenowpassword("{{route('member.update.password.alert')}}","{{route('member.changepassword')}}") class="btn enrol-btn">Change Now</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<!-- modal end here -->

<!-- The Modal (Upgrade Plan Popup)-->
<div class="modal fade" id="upgradeplanmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">do you paypal upgrade</h5>
                <button type="button" class="close" aria-label="Close" onClick=closeupgradepopup();>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: center;padding-bottom: 10px;">Current enrolled plan is for Single coverage, please upgrade plan to Family coverage, before additional members can be added.</p>
                <a class="enrol-btn" href="{{url('member/upgrade-family-plan')}}">
                Upgrade Plan!  
                </a>
            </div>
        </div>
    </div>
</div>
<!-- modal end here -->

<!-- The Modal (Downgrade Plan Popup)-->
<div class="modal fade" id="downgradeplanmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">do you paypal downgrade</h5>
                <button type="button" class="close" aria-label="Close" onClick=closedowngradepopup();>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--<p style="text-align: center;padding-bottom: 10px;">Current enrolled plan is for Family coverage, if you downgrade plan to Single coverage, After additional members can Not be added.</p>
    --><a class="enrol-btn" target="_blank" href="{{url('member/downgrade-single-plan')}}">
                    Downgrade Plan!  
                </a>
            </div>
        </div>
    </div>
</div>
<!-- modal end here -->
<!-- The Modal (VisionPharma Popup)-->
<div class="modal fade" id="VisionPharmaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notice</h5>
                <button type="button" class="close" aria-label="Close" onClick=CloseVisionPharmaModal();>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: center;padding-bottom: 10px;">Please select a plan type and pay to access this feature.</p>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- modal end here -->

@endsection
@section('footerjs')
<script>
    
    <?php if(session('upgrade_url')){ ?>
    $(document).ready(function() {
        let url = '<?php echo session('upgrade_url'); ?>';
        if (url != '') {
            $("#upgradeplanmodal").modal("show");
        }
    });
    <?php } ?>

    function closeupgradepopup(){
        $("#upgradeplanmodal").modal("hide");
    }
    function upgradepopup(){
        $("#upgradeplanmodal").modal("show");
    }
    function downgradepopup(){
        $("#downgradeplanmodal").modal("show");
    }

    <?php if(session('member_count')){ ?>
    $(document).ready(function() {
        if (<?php echo session('member_count'); ?> == 2) {
            $("#downgradeplanmodal").modal("show");
        }
    });
    <?php } ?>

    function closedowngradepopup(){
        $("#downgradeplanmodal").modal("hide");
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        }
    });
    $(document).ready(function() {

        //checking password alert exists for user or not
        showpasswordalert(<?php echo App\Models\InsuredProfile::find($member->insured_profile_id)->password_change_alert; ?>); //calling function from bladefiles.js  
        //checking password alert exists for user or not complete

        // Autocomplete_Address_in_member_Dashboard("{{route('member.findproviders')}}");
    })
</script>
<script>
    // $("#style-scrollbar").mCustomScrollbar({
    //     scrollButtons: {
    //         enable: false
    //     }
    // });

    if ($("#enroll_step2_form").length > 0) {
            $("#enroll_step2_form").validate({
                rules: {
                    paymentmethod: {
                        required: true,
                    },
                },
                messages: {
                    paymentmethod: {
                        required: "Please Select Payment",
                    },
                },
                submitHandler: function(form) {
                    $('#enroll_step2_form_submit').attr('disabled', 'disabled');
                    form.submit();
                }
            })
        }            
</script>

<script>
function upgradememberplan(subscription_id,token,plan) { 
    let paypal_success = '{{route('member.payment.success')}}';   
    $.ajax({
        url: paypal_success,
        method: "get",
        data: {
            
            token: token,
            plan : plan,
            subscription_id: subscription_id,
        },
        success: function(response) {
            // console.log(response);
            alert(response)
            window.location.href = '{{route('member.dashboard')}}';
        },
        error: function(error) {  
            // console.log(error);  
            alert("Something Went Wrong !!!");
        }
    }); 
}       

</script>
<script>
    function VisionPharma(){
        $("#VisionPharmaModal").modal("show");
    }
    function CloseVisionPharmaModal(){
        $("#VisionPharmaModal").modal("hide");
    }
</script>
<!-- <script>
    function upgradeplan(url_for_upgrade_plan, changepasswordurl) {
    update_alert_value_for_user(url_for_update_alert_value);
    $("#changepasswordmodal").modal("hide");
    window.location.href = changepasswordurl;
}
</script> -->

@endsection