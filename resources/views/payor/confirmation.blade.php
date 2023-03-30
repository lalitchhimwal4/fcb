@section('title','Confirmation-Member')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
	<div class="member-enrollment-sec">
        
		<div class="page-header">
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
			<h4>Member Enrollment</h4>
			<div class="head-row">
				<div class="head-col passed">
					<span></span>
					<h6> Registration </h6>
				</div>
				<div class="head-col passed">
					<span></span>
					<h6> Profile </h6>
				</div>
				<div class="head-col active">
					<span></span>
					<h6> Confirmation </h6>
				</div>
			</div>
		</div>
        
		<!-- enroll-content-outer -->
		<div class="enroll-content-outer">
			<div class="container">
				<div class="enroll-content-wrap FCB-registration-sec">
					@include('showmessages')
					<h4>Step 3: Confirmation</h4>
                    
					<p class="confirm-cong-p"> Congratulations enrollment with First Canadian Benefits Health Network is Completed.</p>
					<div class="table-responsive">
						<p class="following-p"><strong>Please use the following FCB registration ID and password to login to start coverage.</strong></p>
					</div>
                    <div class="FCB-registration-wrapper provider-FCB-confirmation-wrapper">	
                        <div class="fcb-inner-wrap">
                            <div class="form enrol-login-form d-flex flex-wrap">		
                                <div class="form-group">
                                    <h5>FCB Registration Number</h5>
                                    {{$primary_insured_member_data['reg_id']}}
                                </div>
                                <div class="form-group password-eye-container">
                                    <h5>Password</h5>
                                    <span>
                                        <input type="password" class="form-control" name="fcb_password" value="{{$primary_insured_member_data['password']}}" disabled>
                                        <i class="fas fa-eye-slash password-toggle-eye" onclick="toggle_password_visibility(event.target,'fcb_password')"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>	
                    <a href="{{route('member.login')}}" class="btn enrol-btn">Login</a>
                    @if($primary_insured_member_data['error'])
                        <p class="confirm-cong-p">Error - {{$primary_insured_member_data['error']}}</p>
                    @endif		
				</div>
			</div>
		</div>
	</div>
</section>
<style>
    .page-header {
        background: #e63b2b;
        padding: 30px 0;
        text-align: center;
    }
</style>
@endsection
@section('footerjs')
<script>
	$(document).ready(function() {
		if ($("#enroll_step1_form").length > 0) {
			$("#enroll_step1_form").validate({
				rules: {
					checkexist: {
						required: true,

					},
				},
				messages: {
					checkexist: {
						required: "Please select valid option to continue!",
					},
				},
			})
		}
	})
</script>
@endsection