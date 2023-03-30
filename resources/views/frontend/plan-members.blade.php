@section('title','Plan Members')
@section('metatitle',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<?php
$background = Get_Meta_Tag_Value('Banner_Settings', 'Plan_Members_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Banner_Settings', 'Plan_Members_Desktop_Banner')) : asset('/frontend_assets/images/home-hero-1024x451.png');
?>
<div class="main-div" style="background-image: url('{{$background}}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="top-div">
                    <h1>{{Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Heading1')?Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Heading1'):'Whether you need a stand-alone or supplementary plan, FCB has got you covered'}}</h1>
                    <h2>{{Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Heading2')?Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Heading2'):'Plan Members'}}</h2>
                    <p>{{Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Description')?Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Description'):'With thousands of providers at your fingertips, the FCB Health Network gives you the freedom to select a network provider nearest you and receive a benefit relief of 20-30% off all services. Plan/Policy A001 will offer health and dental services up to 30% off the most current fee guide pricing. Registered members will receive an FCB benefit card that enables you and your family to access the network for all your health and dental needs.'}}</p>
                    <div class="top-div-btns">
                        <!-- <a href="{{Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Button1_Link')?url(Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Button1_Link')):route('fcbusers.enroll')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Button1_Text')?Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Button1_Text'):'Enroll Now'}}</a> -->
                        <a style="color: #e63b2b;" class="popup-btn" href="{{asset('frontend_assets/resources/Plan_A001_Booklet.pdf' )}}" class="find-btn">{{Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Button2_Text')?Get_Meta_Tag_Value('Plan_Members_Settings','Section1_Button2_Text'):'View Covid-19 Health and Dental Relief Plan' }} <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Mobile_Banner')):asset('/frontend_assets/images/res-home-hero-1024x451.png');}}" alt="res-broker-hero-bg" />
    </figure>
</div>
<!-- HEADER END  -->
<!-- WHY-JOIN-AS-A-MEMBER? START -->
<section class="" >
    <div class="container">
        <div class="who-we-are-content text-justify" style="margin:40px 0;">
            <h2 class="text-center">{{Get_Meta_Tag_Value('Plan_Members_Settings','Section2_Heading1')?Get_Meta_Tag_Value('Plan_Members_Settings','Section2_Heading1'):'Why Join as a Member?'}}</h2>
        </div>       
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/1.png');}}" alt="res-broker-hero-bg" />
                    <h4>Savings</h4>
                    <p>Save 20-30% on all services performed by FCB Providers.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/2.png');}}" alt="res-broker-hero-bg" />
                    <h4>Providers Near You</h4>
                    <p>Find new health and dental providers near you by using our interactive provider search.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/3.png');}}" alt="res-broker-hero-bg" />
                    <h4>Affordable</h4>
                    <p>No annual maximums, frequency restrictions and no obligations keeping your prices low.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/4.png');}}" alt="res-broker-hero-bg" />
                    <h4>Prescriptions</h4>
                    <p>Save on prescriptions with free delivery across Canada and guaranteed lowest dispensing fees.</p>
                    <p>Only through Mednow and Rexall*</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/5.png');}}" alt="res-broker-hero-bg" />
                    <h4>Vision</h4>
                    <p>By using the FCB Health Network, members receive exclusive savings on glasses, lenses, and contacts.</p>
                    <p>Only through Clearly*</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/6.png');}}" alt="res-broker-hero-bg" />
                    <h4>Availability</h4>
                    <p>Check office availability and book appointments with the click of a button.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/7.png');}}" alt="res-broker-hero-bg" />
                    <h4>Virtual Care</h4>
                    <p>Meet with an FCB Provider from the comfort of your own home.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/8.png');}}" alt="res-broker-hero-bg" />
                    <h4>Vendors</h4>
                    <p>Access to our affiliate vendors allowing you to purchase goods and services at reduced costs.</p>
                </div>
            </div>
            <div class="offset-sm-4 col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/9.png');}}" alt="res-broker-hero-bg" />
                    <h4>More Treatments</h4>
                    <p>Use your plan/policy in the FCB Health Network to receive 20-30% more treatments under your existing plans’ annual maximum with the added bonus of reducing your copayments.</p>
                </div>
            </div>
            

        </div> 
    </div>
</section>
<!-- WHY-JOIN-AS-A-MEMBER? END -->

<section class="" >
    <div class="container">
        <div class="who-we-are-content text-justify" style="margin-top:40px;">
            <h2 class="text-center">{{Get_Meta_Tag_Value('Plan_Members_Settings','Section2_Heading1')?Get_Meta_Tag_Value('Plan_Members_Settings','Section2_Heading1'):'Why Visit a Network Provider'}}</h2>
        </div>       
        <div class="row">
        <img src="{{asset('/frontend_assets/images/RBP_Infographic.png');}}" alt="res-broker-hero-bg" />       
        </div>
        <div class="row">
            <h4 style="padding-bottom:20px;">By utilizing the FCB Health Network of Providers, Plan Members will save 20-30% on health and dental treatments performed. In this specific example, the Plan Member has saved $171 on their dental treatment by visiting an FCB Health Network Provider.</h4>
        </div>
</div> 
</section>  
<section class="" >
    <div class="container">
        <div class="who-we-are-content text-justify" style="margin-top:40px;">
            <h2 class="text-center">{{Get_Meta_Tag_Value('Plan_Members_Settings','Section2_Heading1')?Get_Meta_Tag_Value('Plan_Members_Settings','Section2_Heading1'):'Plan Pricing'}}</h2>
        </div>       
        <div class="row">
        <img src="{{asset('/frontend_assets/images/plan_member_plans.png');}}" alt="res-broker-hero-bg" />       
        </div>
        <div class="row">
            <h4 style="padding-bottom:20px;">Join the FCB Health Network now to receive all the benefits listed above for the low monthly price of $10 or $20 respectively.</h4>
        </div>
</div> 
</section> 
<section class="join-our-network how-i-participate" id="how-i-participate" style="background-image:url('{{asset('/frontend_assets/images/planmember-bg.jpg');}}');">
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner1')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner1')):asset('frontend_assets/images/join-first.jpg')}}" alt="join-first" />
    </figure>
    <div class="container">
        <div class="max-1140">
            <div class="join-enrol-sec text-center">
                <h4>{{Get_Meta_Tag_Value('Providers_Settings','Section8_Heading1')?Get_Meta_Tag_Value('Providers_Settings','Section8_Heading1'):'Enroll to become a Plan Member in the First Canadian Benefits Health Network today!'}}</h4>
                <h2>{{Get_Meta_Tag_Value('Providers_Settings','Section8_Heading2')?Get_Meta_Tag_Value('Providers_Settings','Section8_Heading2'):'How can I Join?'}}</h2>
                <p>{{Get_Meta_Tag_Value('Providers_Settings','Section8_Description')?Get_Meta_Tag_Value('Providers_Settings','Section8_Description'):'Join the First Canadian Benefits program and/or the network here. Plan Members can enroll today or contact us with any questions you may have.'}}</p>
                <div class="top-div-btns">
                    <a href="{{route('member.enroll.step2')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Text')?Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Text'):'Enroll Now'}}</a>
                    <a href="{{Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Link')?url(Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Link')):route('ContactUs')}}" class="find-btn">{{Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Text')?Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Text'):'Contact Us '}}<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner2')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner2')):asset('frontend_assets/images/res-paticipate.jpg')}}" alt="res-paticipate" />
    </figure>
</section>
@endsection