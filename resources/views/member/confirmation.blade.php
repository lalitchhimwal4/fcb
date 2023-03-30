@section('title','Confirmation-Member')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
	<div class="member-enrollment-sec">
		<div class="page-header">
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
					<p class="confirm-cong-p">Congratulations, your enrollment with the FCB Health Network is 90% complete!</p>
					<div class="table-responsive">
						<p class="following-p"><strong>Please use the following FCB Registration Number and password to login and select a plan type to complete your registration and start your coverage.</strong></p>
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
					<!--<div class="form enrol-registration-form">
						<form action="{{route('member.afterconfirmation')}}" method="POST" id="enroll_step1_form">
							@csrf
							<div class="form-group">
								<label class="enroll-label">Would you like to enroll additional family members? </label>
								<div class="yes-no-buttons">
									<label class="cstm-radio-label">Yes
										<input type="radio" name="checkexist" value="1">
										<span class="checkmark"></span>
									</label>
									<label class="cstm-radio-label">No
										<input type="radio" name="checkexist" value="2">
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<button type="submit" class="btn comm-mr-top enrol-btn">Confirm</button>
						</form>
					</div>-->
				</div>
			</div>
		</div>
	</div>
</section>

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