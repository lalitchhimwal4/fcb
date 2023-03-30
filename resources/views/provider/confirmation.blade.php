@section('title','Confirmation-Provider')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
	<div class="member-enrollment-sec">
		<div class="page-header">
			<h4>Provider Enrollment</h4>
			<div class="head-row">
				<div class="head-col passed">
					<span></span>
					<h6> Profile </h6>
				</div>
				<div class="head-col passed">
					<span></span>
					<h6> offices </h6>
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
				<div class="enroll-content-wrap FCB-registration-sec provider-FCB-confirmation-outer">
					@include('showmessages')
					<h4>Step 3: Confirmation</h4>
					<p class="confirm-cong-p"> Congratulations enrollment with First Canadian Benefits Health Network is Complete.</p>
					<p class="following-p"><strong>Please use the following FCB Registration Number and password to access your secure web portal</strong></p>
					<div class="FCB-registration-wrapper provider-FCB-confirmation-wrapper">
						<!-- <label class="enroll-label"></label> -->
						<div class="fcb-inner-wrap">
						
							@foreach ($fcb_data as $key => $val)
							<div class="form enrol-login-form d-flex flex-wrap">
								
								<div class="form-group">
									<h5>FCB Registration Number</h5>
									{{$val['id']}}
								</div>
								<div class="form-group password-eye-container">
									<h5>Password</h5>
									<span>
										<input type="password" class="form-control" name="fcb_password" value="{{$val['password']}}" disabled>
										<i class="fas fa-eye-slash password-toggle-eye" onclick="toggle_password_visibility(event.target,'fcb_password')"></i>
									</span>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					<a href="{{route('provider.login')}}" class="btn enrol-btn">Login</a>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection