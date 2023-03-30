@section('title','Login-FCB')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec cs-login-div">
        <div class="page-header">
            <h4>User Login</h4>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer">
            <div class="container">
            
                <div class="enroll-content-wrap">
                	 <h4>Select The User Type</h4>
                    @include('showmessages')
                    <div class="cs-form-card fcb-login-buttons d-flex align-items-center flex-wrap">
                        <a href="{{route('payor.login')}}" class="enrol-btn">Payor </a>
                        <a href="{{route('provider.login')}}" class="enrol-btn">Provider</a>
                        <a href="{{route('member.login')}}" class="enrol-btn">Member </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection