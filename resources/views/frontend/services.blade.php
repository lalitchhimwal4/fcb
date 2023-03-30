@section('title','Services')
@section('metatitle',Get_Meta_Tag_Value('Services_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Services_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Services_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')


<!-- NEWS-SEC START -->
<section class="news cm-top-mrgn" id="news">
    <div class="counters news-sec">
        <div class="container">
            <ul>
                <li>
                    <h2>{{Get_Meta_Tag_Value('Services_Settings','Section1_Heading1')?Get_Meta_Tag_Value('Services_Settings','Section1_Heading1'):'All Services'}}</h2>
                    <span>{{Get_Meta_Tag_Value('Services_Settings','Section1_Heading2')?Get_Meta_Tag_Value('Services_Settings','Section1_Heading2'):'Enroll and receive health and dental benefit relief at no cost.'}}</span>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- NEWS-SEC END -->

<!-- HEALTHCARE-SERVICES START  -->
<section class="what-we-do healthcare-services" id="healthcare-services">
    <div class="container">
        <div class="who-we-are-content text-center">
            <h2>{{Get_Meta_Tag_Value('Services_Settings','Section2_Heading')?Get_Meta_Tag_Value('Services_Settings','Section2_Heading'):'Healthcare Services'}}</h2>
            <p>{{Get_Meta_Tag_Value('Services_Settings','Section2_Description')?Get_Meta_Tag_Value('Services_Settings','Section2_Description'):'We work with you, your payor and/or health insurance carrier and administrator to give you access to the First Canadian Benefits Health Network that provides complete high quality healthcare services at contracted discounted rates. Enroll to schedule the following services at 20-30% off.'}}</p>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/dental-practitioner.jpg')}}" alt="dental-practitioner" />
                        </div>
                    </div>
                    <h2>Dental Practitioners</h2>
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/Occupational-Therapist-service.jpg')}}" alt="Occupational-Therapist-service" />
                        </div>
                    </div>
                    <h2>Occupational Therapist</h2>
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/prescrptions-img.jpg')}}" alt="prescrptions-img" />
                        </div>
                    </div>
                    <h2>Pharmacists/Home Care</h2>
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
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
                    <span class="enroll-now-text">ENROLL NOW</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="services">
                    <div class="zoom-effect-container">
                        <div class="image-card">
                            <img src="{{asset('frontend_assets/images/vision-img.jpg')}}" alt="vision-img" />
                        </div>
                    </div>
                    <h2>Vision</h2>
                    <span class="enroll-now-text">ENROLL NOW</span>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- HEALTHCARE-SERVICES END  -->

<!-- SERVICES-ENROLL START  -->
<section class="services-enroll" id="services-enroll">
    <h2>{{Get_Meta_Tag_Value('Services_Settings','Section4_Heading1')?Get_Meta_Tag_Value('Services_Settings','Section4_Heading1'):'Enroll in our network today'}}</h2>
    <p>{{Get_Meta_Tag_Value('Services_Settings','Section4_Heading2')?Get_Meta_Tag_Value('Services_Settings','Section4_Heading2'):'Enroll in the First Canadian Benefits Health Network here or contact us with any questions you may have.'}}</p>
    <a href="{{Get_Meta_Tag_Value('Services_Settings','Section4_Button1_Link')?Get_Meta_Tag_Value('Services_Settings','Section4_Button1_Link'):route('fcbusers.enroll')}}" class="join-network">{{Get_Meta_Tag_Value('Services_Settings','Section4_Button1_Text')?Get_Meta_Tag_Value('Services_Settings','Section4_Button1_Text'):'Enroll Now'}}</a>
    <a href="{{Get_Meta_Tag_Value('Services_Settings','Section4_Button2_Link')?Get_Meta_Tag_Value('Services_Settings','Section4_Button2_Link'):route('ContactUs')}}" class="qstn-contact popup-btn">{{Get_Meta_Tag_Value('Services_Settings','Section4_Button2_Text')?Get_Meta_Tag_Value('Services_Settings','Section4_Button2_Text'):'Questions? Contact Us Here'}} <i class="fas fa-long-arrow-alt-right"></i></a>
</section>
<!-- SERVICES-ENROLL START  -->


@endsection