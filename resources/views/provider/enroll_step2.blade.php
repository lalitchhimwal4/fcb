@section('title','Enroll-Provider')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header">
            <h4>Provider Enrollment</h4>
            <div class="head-row">
                <div class="head-col">
                    <span></span>
                    <h6> Profile </h6>
                </div>
                <div class="head-col active">
                    <span></span>
                    <h6> Offices </h6>
                </div>
                <div class="head-col">
                    <span></span>
                    <h6> Confirmation </h6>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-profile-outer">
            <form action="{{route('member.enroll.step2')}}" method="POST" id="enroll_step1_form">
                <div class="container">
                    <div class="enroll-content-wrap">
                        @include('showmessages')
                        @csrf
                        
                        <div class="provider-profile-wrapper" id="newmemberprofile">
                        <h4>Step 2: Offices</h4>                       
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Office Number</label>                                
                                    <p>01234567</p>
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Clinic Name </label>
                                    <input type="text" class="form-control" placeholder="William Dental">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Website</label>
                                    <input type="text" class="form-control" placeholder="william-dental-to.ca" >
                                </div>
                               <div class="form-group">
                                    <label class="enroll-label">Address1</label>
                                    <input type="text" class="form-control" placeholder="1234 Main St">
                                </div>
                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                <div class="form-group">
                                    <label class="enroll-label">Address2 </label>
                                    <input type="text" class="form-control" placeholder="Suite 200">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">City</label>
                                    <input type="text" class="form-control" placeholder="Toronto" >
                                </div>
                               <div class="form-group">
                                    <label class="enroll-label">Province</label>
                                    <input type="text" class="form-control" placeholder="Ontario">
                                </div>
                                <div class="form-group">
                                    <label class="enroll-label">Postal Code</label>
                                    <input type="text" class="form-control" placeholder="M4T 2N4">
                                </div>
                            </div>
                            <div class="form enrol-login-form d-flex flex-wrap">
                                    <div class="form-group">
                                        <label class="enroll-label">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="416-123-4567" >
                                    </div>
                                   <div class="form-group">
                                        <label class="enroll-label">Fax</label>
                                        <input type="text" class="form-control" placeholder="416-555-4567">
                                    </div>
                                      <div class="form-group">
                                        <label class="enroll-label">Email</label>
                                        <input type="text" class="form-control" placeholder="info@william-dental-to.ca" >
                                    </div>
                                   <div class="form-group">
                                        <label class="enroll-label">Soacil Media</label>
                                        <input type="text" class="form-control" placeholder="facebook.com/william-dental">
                                    </div>
                            </div>
                        </div>     
                        <a href="javascript:;" class="add-another-btn">+Add another account</a>    
                       
                        <div class="form-group terms-conditions-container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms_and_conditions" id="terms_and_conditions">
                                <label class="form-check-label" for="terms_and_conditions">
                                    By checking this box you accept that you have read, understood and accepted the <a href="" class="text-red popup-btn">Program Guidelines</a> presented herein
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn enrol-btn comm-mr-top">Continue</button>
                    </div>
                       
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
