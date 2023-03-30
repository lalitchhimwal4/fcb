@section('title','Family-Member')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
	<div class="family-profile-sec">
		<div class="page-header family-profile-header">
			<div class="container">
				<div class="family-hd-wrap d-flex align-items-center justify-content-between">
					<div class="family-name">
						<h4>Family Profile</h4>
						<!-- <p>John Smith</p> -->
					</div>

				</div>
			</div>
		</div>
		<!-- enroll-content-outer -->
		<div class="enroll-content-outer">
			<div class="container">
				<div class="enroll-content-wrap">
					@include('showmessages')
					<h4>Members</h4>
					
						@foreach($family_members as $family_member)

						<div class="table-responsive">
							<table class="table family-table">
								<thead>
									<tr>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Gender</th>
										<th>Date of Birth</th>
										<th>Relationship</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$family_member->last_name}}</td>
										<td>{{$family_member->first_name}}</td>
										<td><?php echo ($family_member->gender == 0) ? 'Male' : 'Female'; ?></td>
										<td>{{$family_member->dob}}</td>
										<td><?php
											switch ($family_member->relationship) {
												case 0:
													echo "Primary Insured";
													break;
												case 1:
													echo "Spouse";
													break;
												case 2:
													echo "Dependent";
													break;
												case 3:
													echo "Parents";
													break;
												case 4:
													echo "Guest";
													break;
												case 5:
													echo "Partner";
													break;
												default:
													echo "Other";
											}
											?>
										</td>
									</tr>
								</tbody>
							</table>

						</div>
						@endforeach
						@if($plan_id == '1') <p style="color:#e63b2b">You have not enrolled any family member</p>
						@endif						
						<!-- @if($isprimaryinsured)
						<a href="javascript:void(0);" data-toggle="modal" data-target="#passwordmodal" class="enrol-btn family-bottom-btn"> Enter New Member <i class="fas fa-arrow-right"></i></a>
						@endif -->

						@if($plan_id == '2')
						<a href="javascript:void(0);" data-toggle="modal" data-target="#passwordmodal" class="enrol-btn family-bottom-btn"> Enter New Member <i class="fas fa-arrow-right"></i></a>
						@endif

				</div>

			</div>
		</div>

	</div>
</section>

<!-- The Modal -->

<div class="modal fade" id="passwordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Enter password</h5>
				<!--    <form action="" id="passwordforlogin" method="post">
        	@csrf -->
				<input type="hidden" id="csrf_token" name="csrf-token" value="{{ csrf_token() }}" />
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<input type="password" id="loginpassword" class="form-control enrolled-login-password" name="password">
					<input type="hidden" value="{{$primaryinsurred_fcbid}}" id="primaryinsurred_fcbid" name="primaryinsurred_fcbid">

					<label id="loginpassworderror" class="error" style="display:none;">Please enter atleast 6 digits password</label>
					<label id="loginfailederror" class="error" style="display:none;">Incorrect password</label>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn enrol-btn" data-dismiss="modal">Close</button>
				<button type="submit" onClick="checkpassword()" class="btn enrol-btn">Continue</button>
			</div>
			<!-- </form> -->
		</div>
	</div>
</div>
<!-- modal end here -->


@endsection


@section('footerjs')
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('#csrf_token').val()
		}
	});


	function checkpassword() {

		document.getElementById("loginpassworderror").style.display = "none";
		document.getElementById("loginfailederror").style.display = "none";

		var password = document.getElementById("loginpassword").value;
		if (password.length < 6) {
			document.getElementById("loginpassworderror").style.display = "block";
			document.getElementById("loginpassword").style.width = "100%";
			document.getElementById("loginpassword").style.marginBottom = "8px";
			return false;
		} else {
			// e.preventDefault();

			$.ajax({
				url: "{{route('member.enrolled.checklogin')}}",
				type: 'POST',
				data: {
					primaryinsurred_fcbid: $('#primaryinsurred_fcbid').val(),
					password: $('#loginpassword').val()
				},
				success: function(response) {
					if (response)
						window.location.href = "{{ route('member.enrollfamilymember')}}";
					else {

						document.getElementById("loginpassworderror").style.display = "none";
						document.getElementById("loginfailederror").style.display = "block";
						document.getElementById("loginpassword").style.width = "100%";
						document.getElementById("loginpassword").style.marginBottom = "8px";
					}
				}
			});

		}

	}
</script>
@endsection