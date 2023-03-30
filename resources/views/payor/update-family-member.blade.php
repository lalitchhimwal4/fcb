@section('title','Enroll-Member')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
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
        <!-- Step 3: Profile -->
        <div class="enroll-content-outer">
            <form action="{{route('payor.savefamilymember')}}" method="POST" id="enroll_familymember_form">
               
                @csrf
                <div class="container">

                    <div class="enroll-content-wrap" id="newmemberprofile">
                         @include('showmessages')
                         <h5 class="enroll-cstm-form-heading"><span> Members</span></h5>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>DOB</th>
                                                <th>Gender</th>
                                                <th>Relationship</th>
                                                <th>Coverage</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="InId1">
                                            
                                            @foreach($member_payor_data as $family_member)
                                            <tr>
                                            <td>{{$family_member['last_name']}}</td>
                                            <td>{{$family_member['first_name']}}</td>
                                            <td>{{$family_member['gender']}}</td>
                                            <td>{{$family_member['dob']}}</td>
                                            <td>{{$family_member['relationship']}}</td>
                                            <td>{{$family_member['coverage']}}</td> 
                                            <td>{{$family_member['account_status']}}</td> 
                                            
                                            <td>
                                                <a href="{{route('payor.familymember.edit',$family_member['id'])}}"> <i class="fas fa-edit"></i></a>
                                            </td>
                                            
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="row" id="add_member_enabled" style="display:none;">
                                    <div class="col-sm-4">
                                        <a href="{{route('payor.invoice')}}" class="enrol-btn">Download List</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
  
@endsection
@section('footerjs')    
@endsection
