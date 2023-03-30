@section('title','Family-Member')
@extends('layouts.frontend.main')
@section('content')

<section class="main-page-wrap">
	<div class="family-profile-sec">
		<div class="page-header family-profile-header">
			<div class="container">
				<div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
					<div class="family-name">
						<h4>Family Profile</h4>
						<p>{{Auth::guard('member')->user()->name}}</p>
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
					<h4>Members</h4>
					
					@if($family_members->count() < 1) 
						<p>You have not enrolled any family member</p>
					@endif

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
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$family_member->last_name}}</td>
										<td>{{$family_member->first_name}}</td>
										<td><?php echo ($family_member->gender == 0) ? 'Male' : 'Female'; ?></td>
										<td>{{$family_member->dob}}</td>
										<td>{{get_default_values_from_mastertable('members','relationship')[$family_member->relationship];}}</td>
										<td>
											<a href="{{route('member.familymember.edit',$family_member->id)}}"> <i class="fas fa-edit"></i></a>
											@if($family_member->relationship != 0) <a href="{{route('member.familymember.delete',$family_member->id)}}" onclick="return confirm('Are you sure you want to delete this member ?')"> <i class="fas fa-trash-alt"></i></a> @endif
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					@endforeach

					<a href="{{route('member.enrollfamilymember')}}" class="enrol-btn family-bottom-btn"> Add New Member <i class="fas fa-arrow-right"></i></a>
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