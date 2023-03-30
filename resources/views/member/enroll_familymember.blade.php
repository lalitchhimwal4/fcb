@section('title','Enroll-Member')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
          
                     <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Family Member Enrollment</h4>
                        <!-- <p>John Smith</p> -->
                    </div>
                    <div class="family-buttons d-flex flex-wrap align-items-center">
                        <a href="{{route('member.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('member.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>          
        </div>
        <!-- Step 3: Profile -->
        <div class="enroll-content-outer">
            <form action="{{route('member.savefamilymember')}}" method="POST" id="enroll_familymember_form">
               
                @csrf
                <div class="container">

                    <div class="enroll-content-wrap" id="newmemberprofile">
                         @include('showmessages')
                         
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
                        </div>
                        <div class="form enrol-login-form d-flex flex-wrap align-items-center cs-dob-div">
                            <div class="form-group">
                                <label class="enroll-label">Date of Birth </label>
                                <input type="text" id="dateofbirth" name="dateofbirth" style="opacity:0; width:0; height:0;">
                            </div>
                        </div>
                    
                   
                        <button type="submit" id="enroll_familymember_form_submit" class="btn enrol-btn cstm-mr-top">Continue</button>
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

    //checking password alert exists for user or not
    showpasswordalert(<?php echo App\Models\InsuredProfile::find(Auth::guard('member')->user()->insured_profile_id)->password_change_alert; ?>); //calling function from bladefiles.js  
    //checking password alert exists for user or not complete

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
                    minlength: 3,
                },
                lname: {
                    required: true,
                    //lettersonly: true,
                    pattern:/^[a-zA-Z\s-`'’]+$/,
                    maxlength: 255,
                    minlength: 3,
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
