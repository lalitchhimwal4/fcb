@section('title','Home')
@section('metatitle',Get_Meta_Tag_Value('Homepage_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Homepage_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Homepage_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<?php
$background = Get_Meta_Tag_Value('Banner_Settings', 'Homepage_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Banner_Settings', 'Homepage_Desktop_Banner')) : asset('/frontend_assets/images/hero-bg.jpg');
?>
<div class="main-div" style="background-image: url('{{$background}}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="top-div">

                    <h1>{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Heading1')?Get_Meta_Tag_Value('Homepage_Settings','Section1_Heading1'):'Enroll to receive a health and dental benefit relief'}}</h1>
                    <h2>{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Heading2')?Get_Meta_Tag_Value('Homepage_Settings','Section1_Heading2'):'COVID-19 Health & Dental Relief Plan'}}</h2>
                    <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Description')?Get_Meta_Tag_Value('Homepage_Settings','Section1_Description'):'Save 20-30% on countless health and dental treatments and services by utilizing the FCB Health Network'}}</p>
                    <div class="top-div-btns">
                        <a href="{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button1_Link')?url(Get_Meta_Tag_Value('Homepage_Settings','Section1_Button1_Link')):route('fcbusers.enroll')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button1_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section1_Button1_Text'):'Enroll Now'}}</a>
                        <a href="{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button2_Link')?url(Get_Meta_Tag_Value('Homepage_Settings','Section1_Button2_Link')):url('/pages/covid-19-health-dental-relief-plan') }}" class="find-btn">{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button2_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section1_Button2_Text'):'Find out more' }} <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Banner_Settings','Homepage_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Homepage_Mobile_Banner')):asset('/frontend_assets/images/res-hero-bg.jpg');}}" alt="res-hero-bg" />
    </figure>
</div>
<!-- HEADER END  -->
<!-- PROVIDERS-SEC START  -->
<section class="providers-sec" id="providers-sec">
    <div class="container">
        <div class="provider-card-sec">
            <?php $customboxes = Get_Custom_Boxes('homepage') ?>
            @foreach($customboxes as $custombox)
            <div class="provider-card text-center">
                <figure>
                    <img src="{{($custombox->image)?asset('/storage/'.$custombox->image):asset('frontend_assets/images/providers-icon.png')}}" alt="{{($custombox->title)?$custombox->title:'providers-icon'}}" />
                </figure>
                <h2>{{($custombox->title)?$custombox->title:'Providers'}}</h2>
                <p>{{($custombox->description)?$custombox->description:'We take great pride in our network of registered health care professionals who serve our partners with the highest level of quality service.'}}</p>
                @if($custombox->button_text && $custombox->button_link)
                <a href="{{($custombox->button_link)?url($custombox->button_link):'javascript:void(0);'}}" class="enrol-btn card-btn">{{($custombox->button_text)?$custombox->button_text:'Enroll Now'}}</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- PROVIDERS-SEC END  -->
<!-- WHO-WE-ARE START  -->
<section class="who-we-are" id="who-we-are">
    <div class="container">
        <div class="max-1140">
            <div class="who-we-are-content text-center">
                <h2>{{Get_Meta_Tag_Value('Homepage_Settings','Section3_Heading1')?Get_Meta_Tag_Value('Homepage_Settings','Section3_Heading1'):'Who We Are'}}</h2>
                @if(Get_Meta_Tag_Value('Homepage_Settings','Section3_Description'))
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section3_Description')}}</p>
                @else
                <p>First Canadian Benefits (FCB) Health Network is a not-for-profit Ontario based incorporated company. FCB is owned and operated by a dedicated group of health professionals. FCB’s administrators, along with its advisory board, are the managing umbrella for the <a href="http://www.canadianmanagedcareassociation.ca" class="text-red">Canadian Managed Care Association (CMCA)</a> and the <a href="https://www.ontariomanagedcareassociation.ca" class="text-red">Ontario Managed Care Association (OMCA)</a>. Health and dental providers have organized under the FCB banner to provide a benefit relief following the Covid-19 pandemic. FCB has recognized the gaps and disconnects in Canada’s healthcare model and strives to integrate technology and healthcare to improve capacity, efficiency, and accessibility, while ensuring Canadian consumers’ confidence and trust. FCB is continuously improving its technological solutions as it strives for more coherent and adherent communications and flowthroughs resulting in better patient outcomes for Canadians nationwide. More importantly the FCB Health Network produces a funding model that is reintroduced back into the network to sustain and maintain the benefit relief.</p>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- WHO-WE-ARE END -->
<!-- HOW IT WORKS START -->
<section class="who-we-are" id="who-we-are">
    <div class="container">
        <div class="max-1140">
            <div class="who-we-are-content text-center">
                <h2>{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Heading1')?Get_Meta_Tag_Value('Homepage_Settings','Section4_Heading1'):'How it Works'}}</h2>
                @if(Get_Meta_Tag_Value('Homepage_Settings','Section4_Description'))
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Description')}}</p>
                @else
                <p>By utilizing FCB's Registered Providers, Affiliated Vendors and <a href="{{asset('frontend_assets/resources/RBP_E-Portal.pdf')}}" class="text-red">E-Portal</a> under the <a href="{{asset('frontend_assets/resources/Plan_A001_Booklet.pdf')}}" class="text-red">Covid 19 Health and Dental Relief Plan</a>, members and payors are able to save 20-30% on all treatments and services offered by the FCB Health Network. FCB has built a network of providers who agree to bill under <a href="/payors#reference-based-pricing" class="text-red">reference-based pricing (RBP)</a>, allowing all prospective FCB Members to save on treatments performed. As an FCB Member, not only do you save on health and dental treatments, but also on vision care, pharmaceuticals, and hearing aid solutions by utilizing our affiliated partners.</p>
                @endif
            </div>
        </div>
        <div class="hesitate-sec">
            <div class="chat-icon">
                <a href="tel:+{{ Get_Meta_Tag_Value('General_Settings','Tollfree')?Get_Meta_Tag_Value('General_Settings','Tollfree'):'1 (888) 929-4685' }}" class="chat-icon-link">
                    <i class="fa fa-comments"></i>
                </a>
            </div>
            <div class="hesitate-quotes">
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Quote')?Get_Meta_Tag_Value('Homepage_Settings','Section4_Quote'):"Don't hesitate to contact us if you have questions.
                    Send us a message or click to call us toll-free." }}</p>
                <a href="tel:+{{ Get_Meta_Tag_Value('General_Settings','Tollfree')?Get_Meta_Tag_Value('General_Settings','Tollfree'):'1 (888) 929-4685' }}"><span>{{ Get_Meta_Tag_Value('General_Settings','Tollfree')?Get_Meta_Tag_Value('General_Settings','Tollfree'):'1 (888) 929-4685' }}</span></a>
            </div>
            <a href="{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Button_Link')?url(Get_Meta_Tag_Value('Homepage_Settings','Section4_Button_Link')):route('ContactUs')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Button_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section4_Button_Text'):'Contact Us'}}</a>
        </div>
    </div>
</section>
<!-- HOW IT WORKS END -->
<!-- COUNTERS START -->
<section class="counters" id="counters">
    <div class="container">
        <ul>
            <li class="counter-box">
                <div class="kit">
                    <i class="fa fa-medkit"></i>
                    <p class="counter-count counter">{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter1')?Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter1'):'2,500'}}</p> <span>+</span>
                </div>
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter1_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter1_Text'):'Participating Providers'}}</p>
            </li>
            <li class="counter-box">
                <div class="kit">
                    <i class="fas fa-user-shield"></i>
                    <p class="counter-count counter">{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter2')?Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter2'):'3,219'}}</p> <span>+</span>
                </div>
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter2_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter2_Text'):'Individuals Enrolled'}}</p>
            </li>
            <li class="counter-box">
                <div class="kit">
                    <i class="fas fa-piggy-bank"></i>
                    <p class="counter-count counter">{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter3')?Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter3'):'221,197'}}</p> <span>+</span>
                </div>
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter3_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter3_Text'):'Savings Produced'}}</p>
            </li>
        </ul>
    </div>
</section>
<!-- COUNTERS END -->
<!-- WHAT-WE-DO START  -->
<section class="what-we-do" id="what-we-do">
    <div class="container">
        <div class="who-we-are-content text-center">
            <h2>{{Get_Meta_Tag_Value('Homepage_Settings','Section6_Heading1')?Get_Meta_Tag_Value('Homepage_Settings','Section6_Heading1'):'What We Do'}}</h2>
            <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section6_Description')?Get_Meta_Tag_Value('Homepage_Settings','Section6_Description'):'We work with you, your payor and/or health insurance carrier, and administrator to give you access to the First Canadian Benefits Health Network that provides complete high-quality healthcare services at contracted discounted rates. Enroll now to save 20-30% on the following services.'}}</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/acupunture-service.jpg')}}" alt="acupunture-service" />
                        </div>
                    </div>
                    <h2>Acupuncturists</h2>
                    <!-- <a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/audiologist-service.jpg')}}" alt="audiologist-service" />
                        </div>
                    </div>
                    <h2>Audiologist/Hearing</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Chiropodists-service.jpg')}}" alt="Chiropodists-service" />
                        </div>
                    </div>
                    <h2>Chiropodists</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Chiropractors-service.jpg')}}" alt="Chiropractors-service" />
                        </div>
                    </div>
                    <h2>Chiropractors</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Clinical-Psychologists-service.jpg')}}" alt="Clinical-Psychologists-service" />
                        </div>
                    </div>
                    <h2>Clinical Psychologists</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/dental-practitioner.jpg')}}" alt="Dentists-Specialists-service" />
                        </div>
                    </div>
                    <h2>Dentists/Specialists</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Massage-Therapists-service.jpg')}}" alt="Massage-Therapists-service" />
                        </div>
                    </div>
                    <h2>Massage Therapists</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Naturopaths-service.jpg')}}" alt="Naturopaths-service" />
                        </div>
                    </div>
                    <h2>Naturopaths</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            
        </div>
        <div class="row more-services" style="display: none;">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Occupational-Therapist-service.jpg')}}" alt="Occupational-Therapist-service" />
                        </div>
                    </div>
                    <h2>Occupational Therapist</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Osteopaths-img.jpg')}}" alt="Osteopaths-img" />
                        </div>
                    </div>
                    <h2>Osteopaths</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/prescrptions-img.jpg')}}" alt="prescrptions-img" />
                        </div>
                    </div>
                    <h2>Pharmaceuticals/Home Care</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/physiotherapy-img.jpg')}}" alt="physiotherapy-img" />
                        </div>
                    </div>
                    <h2>Physiotherapists</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/speech-therapy-img.jpg')}}" alt="speech-therapy-img" />
                        </div>
                    </div>
                    <h2>Speech Therapists</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/vision-img.jpg')}}" alt="vision-img" />
                        </div>
                    </div>
                    <h2>Vision Care</h2>
                    <!--<a class="enroll-now-text" href="{{url('provider/enroll/step1')}}">ENROLL NOW</a>-->
                </div>
            </div>
        </div>
        <span class="enrol-btn view-more">{{Get_Meta_Tag_Value('Homepage_Settings','Section6_Button_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section6_Button_Text'):'View More'}}</span>
    </div>
</section>
<!-- WHAT-WE-DO END  -->
<!-- OUR-FUTURE START -->
<section class="who-we-are" id="who-we-are">
    <div class="container">
        <div class="max-1140">
            <div class="who-we-are-content text-center">
                <h2>{{Get_Meta_Tag_Value('Homepage_Settings','Section2_Heading1')?Get_Meta_Tag_Value('Homepage_Settings','Section2_Heading1'):'Our Future'}}</h2>
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section2_Description')?Get_Meta_Tag_Value('Homepage_Settings','Section2_Description'):'The FCB Health Network strives to become the premier health network in Canada, providing affordable health and dental care for all Canadians in need. We aim to grow and expand until our clinics are accessible to all Canadians nationwide.'}}</p>
            </div>
        </div>
    </div>
</section>
<!-- OUR-FUTURE END -->
<!-- PROMISE-TO-COMMUNITY START -->
<section class="what-we-do" id="what-we-do">
    <div class="container">
        <div class="who-we-are-content text-center">
            <h2>{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Heading1')?Get_Meta_Tag_Value('Homepage_Settings','Section8_Heading1'):'Our Promise to the Community'}}</h2>
            <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Description')?Get_Meta_Tag_Value('Homepage_Settings','Section8_Description'):'First Canadian Benefits Health Network strongly believes in giving back to the community in which it serves. We have made it our goal to build a community where everyone has equal opportunities. Its why we strive to ensure everyone in our health network is treated equally and fairly to promote equity and inclusion. FCB works closely with local charities and non-profit organizations to make a positive, long-lasting impression, to ultimately promote the wellness and development of individuals, families, and societies most vulnerable. FCB is also working closely with institutions and government to bridge the gap with current proposals of National Dental Care being put forth. Until 2025 FCB promises to offer its Covid-19 Health and Dental Benefit Relief Plan to all Canadians in need. This includes those without employee benefits as well as individuals who would like to add a supplementary plan to their existing coverages.'}}</p>
        </div>
        <!--<div class="text-center">
            <h3>{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Heading2')?Get_Meta_Tag_Value('Homepage_Settings','Section8_Heading2'):'FCB is Working Closely With the Following Charity'}}</h3>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container charities-image-zoom-container">
                        <div class="image-card charities-image-container">
                            <img src="{{asset('frontend_assets/images/charity.png')}}" alt="covid-icon" />
                        </div>
                    </div>
                    <h2>FCB Benefit Relief Fund</h2>
                    <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Description2')?Get_Meta_Tag_Value('Homepage_Settings','Section8_Description2'):'Pledging over 1 billion in benefit relief over 5 years in health and dental services to all Canadians in need, and local businesses. A portion of donations from subscribers of the Benefit Relief Plan/Policy A001 will be reintroduced back into the FCB Health Network.'}}</p>
                    
                </div>
            </div>
        </div>-->
    </div>
</section>
<!-- PROMISE-TO-COMMUNITY END -->

<!-- JOIN-OUR-NETWORK START  -->
<?php
$join_our_network_background = Get_Meta_Tag_Value('Homepage_Settings', 'Section7_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Homepage_Settings', 'Section7_Desktop_Banner')) : asset('/frontend_assets/images/bg-join.jpg');
?>
<section class="join-our-network" id="join-our-network" style="background-image: url('{{$join_our_network_background}}')">
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner1')?asset('/storage/'.Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner1')):asset('/frontend_assets/images/join-first.jpg')}}" alt="join-first" />
    </figure>
    <div class="container">
        <div class="max-1140">
            <div class="join-enrol-sec text-center">
                <h4>{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Heading1')?Get_Meta_Tag_Value('Homepage_Settings','Section7_Heading1'):'Enroll in the First Canadian Benefits Health Network today'}}</h4>
                <h2>{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Heading2')?Get_Meta_Tag_Value('Homepage_Settings','Section7_Heading2'):'Join Our Network'}}</h2>
                <p>{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Description')?Get_Meta_Tag_Value('Homepage_Settings','Section7_Description'):'First Canadian Benefits provides a health network of dental practitioners and health care providers that have been carefully selected to ensure the highest quality, most cost-effective care for our members. Enroll today or contact us with any questions you may have.'}}</p>
                <div class="top-div-btns">
                    <a href="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button1_Link')?url(Get_Meta_Tag_Value('Homepage_Settings','Section7_Button1_Link')):'javascript:void(0);'}}" class="enrol-btn">{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button1_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section7_Button1_Text'):'Enroll Now'}}</a>
                    <a href="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button2_Link')?url(Get_Meta_Tag_Value('Homepage_Settings','Section7_Button2_Link')):route('ContactUs') }}" class="find-btn">{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button2_Text')?Get_Meta_Tag_Value('Homepage_Settings','Section7_Button2_Text'):'Contact Us ' }}<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner2')?asset('/storage/'.Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner2')):asset('/frontend_assets/images/join-second.jpg')}}" alt="join-second" />
    </figure>
</section>
<!-- JOIN-OUR-NETWORK END  -->
@endsection