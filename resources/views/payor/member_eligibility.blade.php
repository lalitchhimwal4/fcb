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
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            <div class="cs-form-card">
                                <h4>Member Eligibility<br>
                                <span style="font-size:14px">{{$payor->company_name}}</span></h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-sm-12 col-12">
                            
                            <a href="{{route('payor.dashboard')}}" class="enrol-btn" style="float:right">Back to Dashboard</a>
                           
                        </div>
                    </div>
                    <h5 class="enroll-cstm-form-heading"><span> Member Search</span></h5>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                           <p style="text-align:center;font-weight:700">Member ID</p>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="member_id" id="member_id" class="form-control">
                            <span id="member_id_err" class="text-danger"></span>
                        </div>
                        <div class="col-sm-4">
                            
                            <button type="submit" onClick=get_member_eligibility(); class="form-control enrol-btn">Search</button>
                        </div>
                        <div class="col-sm-12" id="family-scrollbar" style="display:none;">
                            <div class="table-responsive mt-3">
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
                                    <tbody id="InId">
                                    
                                    </tbody>
                                </table>
                                 
                            </div>
                            <div class="row" id="add_dependent_enabled">
                                <div class="col-sm-4">
                                    <a href="{{route('payor.add_dependent')}}" class="enrol-btn" id="add_dep">Add Dependant</a>
                                </div>
                                
                                <div class="col-sm-4">
                                    <a href="{{route('payor.viewfamilymember')}}" class="enrol-btn">Update Eligibility</a>
                                </div>
                            </div>
                            <div class="row" id="add_member_enabled" style="display:none;">
                                <div class="col-sm-4">
                                    <a href="{{route('payor.addmember')}}" class="enrol-btn">Add Member</a>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div id="mem_eli" class="mt-5" style="display:block">
                        <h5 class="enroll-cstm-form-heading"><span> Member Eligibility</span></h5>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        @if(!empty($payormembers['0']['status'] == 1))
                                            <tr>
                                                <th>Member ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>DOB</th>
                                                <th>Gender</th>
                                                <th>Relationship</th>
                                                <th>Coverage</th>
                                                <th>Status</th>
                                            </tr>
                                        @endif    
                                        </thead>
                                        <tbody id="InId1">
                                            
                                            @foreach($payormembers as $Payormember)
                                                @if($Payormember['status'] == 1)
                                                    <tr>
                                                        <td>{{$Payormember['id']}}</td>
                                                        <td>{{$Payormember['first_name']}}</td>
                                                        <td>{{$Payormember['last_name']}}</td>
                                                        <td>{{$Payormember['dob']}}</td>
                                                        <td>{{$Payormember['gender']}}</td>
                                                        <td>{{$Payormember['relationship']}}</td>
                                                        <td>{{$Payormember['coverage']}}</td>
                                                        <td>{{$Payormember['account_status']}}</td>
                                                    </tr>
                                                @else
                                                    <p>
                                                        {{$Payormember['message']}}
                                                    </p>       
                                                @endif    
                                             @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if(!empty($payormembers['0']['status'] == 1)) 
                                <div class="row" id="add_member_enabled" style="display:block;">
                                    <div class="col-sm-4">
                                        <a href="{{route('payor.downloadmember')}}" class="enrol-btn">Download List</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div> 
                    </div>
                </div>
            </div>    
        </div>
    </div>
</section>

@endsection
@section('footerjs')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        }
    });
    function get_member_eligibility() { 
        var member_id = $('#member_id').val();
        if(member_id != ''){
        $('#member_id_err').empty();
        let url = '{{route('payor.getmembereligibility')}}';   
        $.ajax({
            url: url,
            method: "post",
            data: {
                member_id : member_id,
            },
            success: function(response) {
                console.log(response);
                var response = JSON.parse(response);
                $('#family-scrollbar').show();
                $('#InId').empty();
                //$('#InId1').empty();
                $.each(response, function (key, val) {
                    if(val.status == '0'){
                        //$('#mem_eli').hide();
                        var data = '<tr><td colspan="7" style="text-align:center;">'+val.message+'</td></tr>';
                        $('#InId').append(data);
                        $('#add_dependent_enabled').hide();
                        $('#add_member_enabled').show();
                    }else{
                        $('#add_dependent_enabled').show();
                        $('#add_member_enabled').hide();
                        var data = '<tr><td>'+val.first_name+'</td><td>'+val.last_name+'</td><td>'+val.dob+'</td><td>'+val.gender+'</td><td>'+val.relationship+'</td><td>'+val.coverage+'</td><td>'+val.account_status+'</td></tr>';
                        $('#InId').append(data);
                        $('#mem_eli').show();
                        var data = '<tr><td>'+val.member_id+'</td><td>'+val.first_name+'</td><td>'+val.last_name+'</td><td>'+val.dob+'</td><td>'+val.gender+'</td><td>'+val.relationship+'</td><td>'+val.coverage+'</td><td>'+val.account_status+'</td></tr>';
                        //$('#InId1').append(data);
                    }    
                });
               
            },
            error: function(error) {  
                console.log(error);  
                alert("Something Went Wrong !!!");
            }
        }); 
    }else{
        $('#member_id_err').empty().append('Please Enter Member ID');
    }
    }     
</script>
@endsection