<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - FCB Health Network</title>
    <meta charset="UTF-8">
	<!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta tags -->
    <meta name="title" content="@yield('metatitle')">
    <meta name="keywords" content="@yield('metakeyword')">
    <meta name="description" content="@yield('metadescription')">
    <!-- meta tags complete -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend_assets/images/favicon.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,800&family=Fira+Sans+Condensed:wght@100;200;300;400;500;600;700&family=Fira+Sans:wght@100;200;300;400;500;600;700&family=Mulish:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Design style -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend_assets/css/custom_style.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend_assets/css/responsive.css')}}" />
    <!-- Custom style -->
    <style>
        @media screen and (-webkit-min-device-pixel-ratio:0) { 
            .navbar-brand img{ 
                width: auto !important; 
            } 
        }    
    </style>
</head>

<body>
    <!-- HEADER START  -->
    <header>
        <div class="top-header">
            <div class="social-areas">
                <a href="tel:+18889294685" class="tel-no"><i class="fas fa-phone-alt"></i> Call Us Toll-Free: {{Get_Meta_Tag_Value('General_Settings','Tollfree')?Get_Meta_Tag_Value('General_Settings','Tollfree'):'1-(888) 929-4685'}} </a>
                <!-- <a href="{{Get_Meta_Tag_Value('General_Settings','Facebook_Link') ? Get_Meta_Tag_Value('General_Settings','Facebook_Link'):'#'}}" class="fb-acc"><i class="fab fa-facebook-f"></i> Like Us On Facebook</a> -->
            </div>
            <div class="important-links">
                <ul>
                    <li>
                        <div class="cs-form-card cs-right d-flex align-items-center flex-wrap justify-content-end" data-toggle="modal" data-target="#searchModal">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <?php $googleElement = Get_Meta_Tag_Value('General_Settings', 'Google_Maps_API_Key') ? Get_Meta_Tag_Value('General_Settings', 'Google_Maps_API_Key') : ''; ?>
                            <a href="javascript:void(0);" class="top-header-links network-provider-search">Network Provider Search</a>
                        </div>
                    </li>
                    <!-- <li>
                        <a href="{{route('provider.enroll.step1')}}" class="top-header-links">Provider Registration</a>
                    </li> -->
                    <li>
                        <a href="{{route('Vendors')}}" class="top-header-links">Vendors</a>
                    </li>
                    <li>
                        <a href="{{route('News')}}" class="top-header-links">News</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}">
                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Header_Logo')))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Header_Logo'))}}" alt="logo" class="navbar-brand-img" />
                    @else
                    <img src="{{asset('frontend_assets/images/logo.png')}}" alt="logo" class="navbar-brand-img" />
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{url()->current()==url('/')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item {{url()->current()==route('Providers')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{route('Providers')}}">Providers</a>
                        </li>
                        <li class="nav-item {{url()->current()==route('PlanMembers')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{route('PlanMembers')}}">Plan Members</a>
                        </li>
                        <li class="nav-item {{url()->current()==route('Partners')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{route('Partners')}}">Our Partners</a>
                        </li>
                        <!-- <li class="nav-item {{url()->current()==route('Vision')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{route('Vision')}}">Vision</a>
                        </li>
                        <li class="nav-item {{url()->current()==route('Prescriptions')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{route('Prescriptions')}}">Prescriptions</a>
                        </li> -->
                        <li class="nav-item {{url()->current()==route('Payors')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{route('Payors')}}">Payors</a>
                        </li>
                        <li class="nav-item {{url()->current()==route('ContactUs')?'current-menu-item':''}}">
                            <a class="nav-link" href="{{route('ContactUs')}}">Contact</a>
                        </li>
                        @if(Auth::guard('member')->check())
                        <!-- when member is login  -->
                        <li class="nav-item">
                            <a class="nav-link login-btn" href="{{route('member.dashboard')}}">View Dashboard</a>
                        </li>
                        @elseif(Auth::guard('payor')->check())
                        <!-- when member is login  -->
                        <li class="nav-item">
                            <a class="nav-link login-btn" href="{{route('payor.dashboard')}}">View Dashboard</a>
                        </li>
                        @elseif(Auth::guard('provider')->check())
                        <!-- when admin is login or normal user -->
                        <?php 
                            $step = Request::segment(3); 
                        ?>
                        @if($step != 'step6' && $step != 'step7')
                        <li class="nav-item">
                            <a class="nav-link login-btn" href="{{route('provider.dashboard')}}">View Dashboard</a>
                        </li>
                        @endif
                        
                        @elseif(Auth::check())
                        <!-- when admin is login or normal user -->
                        <li class="nav-item">
                            <a class="nav-link login-btn" href="{{route('admin.dashboard')}}">View Dashboard</a>
                        </li>
                        @else
                        <!-- When no one is login then enroll and login button will appear  -->
                        <li class="nav-item">
                            <a class="nav-link enrol-btn" href="{{route('fcbusers.enroll')}}">Enroll Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link login-btn" href="{{route('fcbusers.login')}}">Login</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @include('includes.frontend.maps')