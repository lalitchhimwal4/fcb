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
                         <h5 class="enroll-cstm-form-heading"><span> Member Eligibility</span></h5>
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
                                            @foreach($member_payor_data as $data)
                                            <tr>
                                                <td>{{$data['first_name']}}</td>
                                                <td>{{$data['last_name']}}</td>
                                                <td>{{$data['dob']}}</td>
                                                <td>{{$data['gender']}}</td>
                                                <td>{{$data['relationship']}}</td>
                                                <td>{{$data['coverage']}}</td>
                                                <td>{{$data['account_status']}}</td>
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
                        <!-- <h4>Step 2: Profile</h4> -->
                        <h5 class="enroll-cstm-form-heading"><span>Member Information</span></h5>
                        <div class="form enrol-login-form d-flex flex-wrap">
                            <div class="form-group">
                                <label class="enroll-label">Realtionship </label>
                                <div class="select-wrap">
                                    <select class="form-control" name="relationship">
                                       @foreach(get_default_values_from_mastertable('members','relationship') as $relationship_index=>$relationship_value)
                                            @if($relationship_index!==0)
                                                <option value="{{$relationship_index}}">{{$relationship_value}}</option>
                                            @endif    
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Last Name </label>
                                <input type="text" class="form-control" placeholder="Last Name" name="lname">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" name="fname">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Gender </label>
                                <div class="select-wrap">
                                    <select class="form-control" name="gender">
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Status </label>
                                <input type="text" class="form-control" placeholder="status" name="status" disabled value="{{$member_payor_data['0']['account_status']}}">
                            </div>
                            <div class="form-group">
                                <label class="enroll-label">Coverage </label>
                                <input type="text" class="form-control" placeholder="Coverage" name="coverage" disabled value="{{$member_payor_data['0']['coverage']}}">
                            </div>
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap align-items-center cs-dob-div">
                            <div class="form-group">
                                <label class="enroll-label">Date of Birth </label>
                                <input type="text" id="dateofbirth" name="dateofbirth" style="opacity:0; width:0; height:0;">
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" id="enroll_familymember_form_submit" class="btn enrol-btn cstm-mr-top">Continue</button>
                            </div>
                            <div class="col-sm-2">
                            <a href="{{route('payor.dashboard')}}"  class="btn enrol-btn cstm-mr-top">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
  <!-- The Modal -->
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
        <button type="button" onClick=changelaterpassword("{{route('member.update.password.alert')}}") class="btn enrol-btn" >I will change later</button>
        <button type="button" onClick=changenowpassword("{{route('member.update.password.alert')}}","{{route('member.changepassword')}}") class="btn enrol-btn" >Change Now</button>
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
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        }
       });

  
$(document).ready(function() {

    
   // date of birth datepicker
    let y = new Date().getFullYear();
    $('#dateofbirth').dropdownDatepicker({
        allowFuture: false,
        dropdownClass: "form-control",
        wrapperClass: 'select-wrap dobselectwrap',
        minYear: y-112,

    });


    //frontend validation start

    if ($("#enroll_familymember_form").length > 0) {

        $("#enroll_familymember_form").validate({


            rules: {

                relationship: {
                    required: true,
                },
                fname: {
                    required: true,
                    //lettersonly: true,
                    pattern:/^[a-zA-Z\s-`'’]+$/,
                    maxlength: 255,
                    minlength: 2,
                },
                lname: {
                    required: true,
                    //lettersonly: true,
                    pattern:/^[a-zA-Z\s-`'’]+$/,
                    maxlength: 255,
                    minlength: 2,
                },
                gender: {
                    required: true,
                },
               
                dateofbirth: {
                    required: true,
                }

            },
            messages: {

                relationship: {
                    required: "Please select Relationship",
                },
                fname: {
                    required: "Please enter First Name",
                },
                lname: {
                    required: "Please enter Last Name",
                },
                gender: {

                    required: "Please select Gender",
                },
               
                dateofbirth: {

                    required: "Please select date of birth",
                },


            },
             errorPlacement: function(error, element) {
                   if (element.attr("name") == "dateofbirth") 
                    error.insertAfter(".dobselectwrap");
                   else 
                    error.insertAfter(element);
               },

            submitHandler: function (form) {
                  $('#enroll_familymember_form_submit').attr('disabled','disabled');
                  form.submit();
            }   


        })
    }

    //frontend validation complete
  
  
})




</script>

    
@endsection
