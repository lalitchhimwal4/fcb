<?php

use Illuminate\Support\Facades\Request;

$backgroundUrl = Get_Meta_Tag_Value('Banner_Settings', 'Providers_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Banner_Settings', 'Providers_Desktop_Banner')) : asset('/frontend_assets/images/providers-hero-bg.jpg');
$section5Url = Get_Meta_Tag_Value('Providers_Settings', 'Section5_Image') ? asset('/storage/' . Get_Meta_Tag_Value('Providers_Settings', 'Section5_Image')) : asset('frontend_assets/images/cost-savings.jpg');
$section8Url = Get_Meta_Tag_Value('Providers_Settings', 'Section8_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Providers_Settings', 'Section8_Desktop_Banner')) : asset('frontend_assets/images/participate-bg.jpg');

?>
@section('title','Providers')
@section('metatitle',Get_Meta_Tag_Value('Providers_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Providers_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Providers_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<div class="main-div providers-bg" style="background-image: url('{{$backgroundUrl}}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="top-div">
                    <h1>{{Get_Meta_Tag_Value('Providers_Settings','Section1_Heading1')?Get_Meta_Tag_Value('Providers_Settings','Section1_Heading1'):'Registered healthcare professionals'}}</h1>
                    <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section1_Heading2')?Get_Meta_Tag_Value('Providers_Settings','Section1_Heading2'):'FCB Health Network Providers'}}</h2>
                    <p>{{Get_Meta_Tag_Value('Providers_Settings','Section1_Description')?Get_Meta_Tag_Value('Providers_Settings','Section1_Description'):'We take great pride in our health network of registered health care professionals who serve our partners with the highest level of quality service at contracted rates.'}}</p>
                    <div class="top-div-btns">
                        <a href="{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button1_Link')?url(Get_Meta_Tag_Value('Providers_Settings','Section1_Button1_Link')):route('fcbusers.enroll')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button1_Text')?Get_Meta_Tag_Value('Providers_Settings','Section1_Button1_Text'):'Become A Provider'}}</a>
                        <!-- <a href="{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button2_Link')?url(Get_Meta_Tag_Value('Providers_Settings','Section1_Button2_Link')):route('fcbusers.login')}}" class="find-btn">{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button2_Text')?Get_Meta_Tag_Value('Providers_Settings','Section1_Button2_Text'):'Login' }} <i class="fas fa-long-arrow-alt-right"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Banner_Settings','Providers_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Providers_Mobile_Banner')):asset('frontend_assets/images/res-provider-hero-bg.jpg');}}" alt="res-provider-hero-bg" />
    </figure>
</div>
<!-- HEADER END  -->
<!-- WHY-JOIN-PROVIDER START -->
<section class="why-join-provider" id="why-join-provider">
    <div class="container">
        <div class="who-we-are-content text-center">
            <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section2_Heading1')?Get_Meta_Tag_Value('Providers_Settings','Section2_Heading1'):'Why join as a provider?'}}</h2>
            <p>{{Get_Meta_Tag_Value('Providers_Settings','Section2_Description')?Get_Meta_Tag_Value('Providers_Settings','Section2_Description'):'We are absolutely committed to making sure our providers receive the best possible and latest information, technology and tools available to ensure their success and their ability to provide for payors and plan members. At First Canadian Benefits, we focus on operational excellence, constantly striving to eliminate redundancy and streamline processes for the benefit and value of all our partners. Learn why providers have chosen to join us as their exclusive partners in managing health care.'}}</p>
        </div>
        <ul class="experience-card">
            <li>
                <div class="circle">
                    @if(Get_Meta_Tag_Value('Providers_Settings','Section3_Image1'))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image1'))}}">
                    @else
                    <i class="fas fa-laptop-medical"></i>
                    @endif
                </div>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image1_Title')?Get_Meta_Tag_Value('Providers_Settings','Section3_Image1_Title'):'Easy and simple experience'}}</h2>
            </li>
            <li>
                <div class="circle">
                    @if(Get_Meta_Tag_Value('Providers_Settings','Section3_Image2'))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image2'))}}">
                    @else
                    <i class="fas fa-award"></i>
                    @endif
                </div>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image2_Title')?Get_Meta_Tag_Value('Providers_Settings','Section3_Image2_Title'):'Operational excellence'}}</h2>
            </li>
            <li>
                <div class="circle">
                    @if(Get_Meta_Tag_Value('Providers_Settings','Section3_Image3'))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image3'))}}">
                    @else
                    <i class="fas fa-dollar-sign"></i>
                    @endif
                </div>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image3_Title')?Get_Meta_Tag_Value('Providers_Settings','Section3_Image3_Title'):'Financial discipline'}}</h2>
            </li>
            <li>
                <div class="circle">
                    @if(Get_Meta_Tag_Value('Providers_Settings','Section3_Image4'))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image4'))}}">
                    @else
                    <i class="fas fa-users"></i>
                    @endif
                </div>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image4_Title')?Get_Meta_Tag_Value('Providers_Settings','Section3_Image4_Title'):'Empowering environment'}}</h2>
            </li>
        </ul>
        <ul class="experience-card-second">
            <li>
                <div class="circle">
                    @if(Get_Meta_Tag_Value('Providers_Settings','Section3_Image5'))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image5'))}}">
                    @else
                    <i class="fas fa-user"></i>
                    @endif
                </div>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image5_Title')?Get_Meta_Tag_Value('Providers_Settings','Section3_Image5_Title'):'New Patients'}}</h2>
            </li>
            <li>
                <div class="circle">
                    @if(Get_Meta_Tag_Value('Providers_Settings','Section3_Image6'))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image6'))}}">
                    @else
                    <i class="fas fa-hands"></i>
                    @endif
                </div>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image6_Title')?Get_Meta_Tag_Value('Providers_Settings','Section3_Image6_Title'):'Building Trust'}}</h2>
            </li>
        </ul>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="provide-today-img">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{Get_Meta_Tag_Value('Providers_Settings','Section4_Image')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section4_Image')):asset('/frontend_assets/images/provider-today.jpg')}}" alt="provider-today">
                        </div>
                    </div>

                    <a class="enroll-now-text text-center" href=" {{Get_Meta_Tag_Value('Providers_Settings','Section4_Button_Link')?Get_Meta_Tag_Value('Providers_Settings','Section4_Button_Link'):route('fcbusers.enroll')}}">
                        {{Get_Meta_Tag_Value('Providers_Settings','Section4_Button_Text')?Get_Meta_Tag_Value('Providers_Settings','Section4_Button_Text'):'Enroll Now'}}
                    </a>

                </div>
            </div>
            <?php $customboxes = Get_Custom_Boxes(Request::path()); ?>
            @foreach($customboxes as $custombox)
            <div class="col-lg-6 col-md-12">

                <div class="provider-card-sec">
                    <div class="provider-card text-center">
                        <!-- <figure>
                            <img src="{{$custombox->image?asset('/storage/'.$custombox->image):asset('frontend_assets/images/providers-icon.png')}}" alt="providers-icon">
                        </figure>
                        <h2>{{$custombox->title?$custombox->title:'Become A Provider Today!'}}</h2>
                        <p>{{$custombox->description?$custombox->description:'The First Canadian Benefits Health Network is the largest network in Canada. It offers providers the advantage of size and leverage, with a large patient volume, established relationships with multiple payors, high client retention rate and competitive reimbursements. Please contact us or select Enroll Now to complete the online registration form below. Once registered, providers will be enabling new patients to search and access their clinic for an appointment. Across Canada, employed and unemployed residents will be presenting their FCB Benefit Card outlining plan details and eligibility. FCB plans will reimburse all providers, at the point of service, by submitting claims through the FCB E-Portal.'}}</p>
                        @if($custombox->button_text && $custombox->button_link)
                        <a href="{{$custombox->button_link?$custombox->button_link:route('fcbusers.enroll')}}" class="enrol-btn card-btn">{{$custombox->button_text?$custombox->button_text:'Register Here'}}</a>
                        @endif -->
                        <figure>
                            <img src="{{asset('frontend_assets/images/providers-icon.png')}}" alt="providers-icon">
                        </figure>
                        <h2>Become A Provider Today!</h2>
                        <p>The First Canadian Benefits Health Network is one of the largest health networks in Canada. It offers providers the advantage of size and leverage, with a large patient volume, established relationships with multiple payors, high client retention rate and competitive fees for service. Please contact us or select “Enroll Now” to complete the online registration form. Once registered, providers will be enabling new patients to search and access their clinic for a benefit relief on treatments performed. Across Canada, employed and unemployed residents will be presenting their FCB Benefit Card outlining plan details and eligibility. FCB plan members will be paying all providers, at the point of service, by submitting treatments performed through the <a style="color: red" href="{{asset('frontend_assets/resources/RBP_E-Portal.pdf')}}">FCB E-Portal</a>.</p>
                        <div class="row">
                            <div class="col-lg-6 my-link"><a class="enrol-btn popup-btn" href="{{asset('frontend_assets/resources/Provider_Manual_Dental.pdf')}}"><i class="fas fa-file-pdf"></i>Dental Provider Manual</a></div>
                            <div class="col-lg-6 my-link"><a class="enrol-btn popup-btn" href="{{asset('frontend_assets/resources/Provider_Manual_Health.pdf')}}"><i class="fas fa-file-pdf"></i>  Health Provider Manual</a></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- WHY-JOIN-PROVIDER END -->
<!-- SAVING-AND-DISCOUNT START  -->
<section class="saving-and-discount" id="saving-and-discount" style="background-image: url('{{$section5Url}}')">
    <figure>
        <img src="{{Get_Meta_Tag_Value('Providers_Settings','Section5_Image')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section5_Image')):asset('frontend_assets/images/cost-savings.jpg')}}" alt="cost-savings" />
    </figure>
    <div class="saving-discount-content">
        <div class="who-we-are-content">
            <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section5_Heading1')?Get_Meta_Tag_Value('Providers_Settings','Section5_Heading1'):'Cost savings and discounts'}}</h2>
            @if(Get_Meta_Tag_Value('Providers_Settings','Section5_Description'))
            {!! Get_Meta_Tag_Value('Providers_Settings','Section5_Description') !!}

            @else
            <ul>
                <li>
                    <span><i class="fas fa-check-circle"></i></span>
                    <p>Manufacturers</p>
                </li>
                <li>
                    <span><i class="fas fa-check-circle"></i></span>
                    <p>Laboratories</p>
                </li>
                <li>
                    <span><i class="fas fa-check-circle"></i></span>
                    <p>Suppliers and services</p>
                </li>
                <li>
                    <span><i class="fas fa-check-circle"></i></span>
                    <p>Insurance / Programs</p>
                </li>
            </ul>
            <p class="saving-content">Registered providers will be issued a FCB password along with their registration number enabling them to reduce their office overhead through FCB’s affiliate vendors and also receive new patients in the office, at no extra cost.</p>
            <p class="saving-content">If you are interested in participating in the FCB Health Network, please click Enroll Now and complete your enrollment by creating a participating provider account.</p>
            <p class="saving-content">Providers will also be enabling new patients to access their participating office for virtual consultations and online scheduling working on a multidisciplinary secure platform.</p>
            @endif
            <a href="{{Get_Meta_Tag_Value('Providers_Settings','Section5_Button_Link')?url(Get_Meta_Tag_Value('Providers_Settings','Section5_Button_Link')):route('fcbusers.enroll')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Providers_Settings','Section5_Button_Text')?Get_Meta_Tag_Value('Providers_Settings','Section5_Button_Text'):'Register Here'}}</a>
        </div>
    </div>
</section>
<!-- SAVING-AND-DISCOUNT END  -->
<!-- COUNTERS-NETWORK START  -->
<section class="counters counters-network" id="counters-network">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="counter-box1 text-white text-center">
                    <div class="count">
                        <div class="kit">
                            <i class="fa fa-medkit"></i>
                            <p class="counter-count counter">{{Get_Meta_Tag_Value('Providers_Settings','Section6_CounterNo')?Get_Meta_Tag_Value('Providers_Settings','Section6_CounterNo'):'1,000'}}</p> <span>+</span>
                        </div>
                        <p>{{Get_Meta_Tag_Value('Providers_Settings','Section6_CounterText')?Get_Meta_Tag_Value('Providers_Settings','Section6_CounterText'):'Potential Patients'}}</p>
                        <a href="{{Get_Meta_Tag_Value('Providers_Settings','Section6_Button_Link')?url(Get_Meta_Tag_Value('Providers_Settings','Section6_Button_Link')):route('fcbusers.enroll')}}" class="join-network">{{Get_Meta_Tag_Value('Providers_Settings','Section6_Button_Text')?Get_Meta_Tag_Value('Providers_Settings','Section6_Button_Text'):'Join our network'}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="counter-box2 text-white">
                    <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section6_Heading1')?Get_Meta_Tag_Value('Providers_Settings','Section6_Heading1'):'What is network participation?'}}</h2>
                    <p>{{Get_Meta_Tag_Value('Providers_Settings','Section6_Description')?Get_Meta_Tag_Value('Providers_Settings','Section6_Description'):'Network participation offers providers the exposure and access to multiple payors and patients utilizing the FCB Health Network. We are constantly looking for ways to bring new patients to your practice and to improve your bottom line. By joining the FCB Health Network, you will be making your office available to thousands of patients nationwide both in the private and public sector.'}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- COUNTERS-NETWORK END  -->
<!-- WHAT-ARE-BENEFITS START  -->
<section class="what-are-benefits" id="what-are-benefits">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="zoom-effect-container">
                    <div class="image-card">
                        <img src="{{Get_Meta_Tag_Value('Providers_Settings','Section7_Image')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section7_Image')):asset('/frontend_assets/images/benefits-img.jpg')}}" alt="benefits-img" />
                    </div>
                </div>

                <a class="enroll-now-text text-center" href="{{Get_Meta_Tag_Value('Providers_Settings','Section7_Button_Link')?url(Get_Meta_Tag_Value('Providers_Settings','Section7_Button_Link')):route('fcbusers.enroll')}}">
                    {{Get_Meta_Tag_Value('Providers_Settings','Section7_Button_Text')?Get_Meta_Tag_Value('Providers_Settings','Section7_Button_Text'):'ENROLL NOW'}}
                </a>

            </div>
            <div class="col-lg-7 col-md-12">
                <div class="who-we-are-content">
                    <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section7_Heading1')?Get_Meta_Tag_Value('Providers_Settings','Section7_Heading1'):'What are the benefits?'}}</h2>
                    @if(Get_Meta_Tag_Value('Providers_Settings','Section7_Description'))
                    {!! Get_Meta_Tag_Value('Providers_Settings','Section7_Description') !!}
                    @else
                    <ul>
                        <li>
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>Joining the Health Network under the Suggested Program Guidelines ensures providers are working under the ethics and jurisprudence of their professional governing bodies (governance model).</p>
                        </li>
                        <li>
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>Registered providers will be placed in the FCB website under Provider Search.</p>
                        <li>
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>To help build your practice, FCB provides free advertising for your office by displaying your clinic on our Provider Search.</p>
                        </li>
                        <li>
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>Provider Search is accessed by members looking for healthcare providers in their areas.</p>
                        </li>
                        <li>
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>Network participation allows you to access FCB’s affiliate vendors offering FCB proprietary savings.</p>
                        </li>
                        <li>
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>View patients history in the FCB Health Network.</p>
                        </li>
                        <li>
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>Payment at the point of service.</p>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- WHAT-ARE-BENEFITS END  -->
<!-- HOW-I-PARTICIPATE START  -->
<section class="join-our-network how-i-participate" id="how-i-participate" style="background-image:url('{{$section8Url}}');">
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner1')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner1')):asset('frontend_assets/images/join-first.jpg')}}" alt="join-first" />
    </figure>
    <div class="container">
        <div class="max-1140">
            <div class="join-enrol-sec text-center">
                <h4>{{Get_Meta_Tag_Value('Providers_Settings','Section8_Heading1')?Get_Meta_Tag_Value('Providers_Settings','Section8_Heading1'):'Enroll to become a provider in the First Canadian Benefits Health Network today'}}</h4>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section8_Heading2')?Get_Meta_Tag_Value('Providers_Settings','Section8_Heading2'):'How can I participate?'}}</h2>
                <p>{{Get_Meta_Tag_Value('Providers_Settings','Section8_Description')?Get_Meta_Tag_Value('Providers_Settings','Section8_Description'):'Join the First Canadian Benefits program and/or the network here. Practitioners can enroll today or contact us with any questions you may have.'}}</p>
                <div class="top-div-btns">
                    <a href="{{Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Link')?url(Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Link')):route('fcbusers.enroll')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Text')?Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Text'):'Enroll Now'}}</a>
                    <a href="{{Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Link')?url(Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Link')):route('ContactUs')}}" class="find-btn">{{Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Text')?Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Text'):'Contact Us '}}<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner2')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner2')):asset('frontend_assets/images/res-paticipate.jpg')}}" alt="res-paticipate" />
    </figure>
</section>
<!-- HOW-I-PARTICIPATE END  -->
@endsection