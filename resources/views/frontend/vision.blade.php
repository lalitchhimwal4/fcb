@section('title','Vision')
@section('metatitle',Get_Meta_Tag_Value('Vision_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Vision_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Vision_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<?php
$background_url = Get_Meta_Tag_Value('Banner_Settings', 'Vision_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Banner_Settings', 'Vision_Desktop_Banner')) : asset('/frontend_assets/images/vision-bg-hero.jpg');
?>
<div class="main-div vision-bg" style="background-image:url('{{$background_url}}');">
    <div class="container">
        <div class="top-div vision-top-wrapper">
            <h1>{{Get_Meta_Tag_Value('Vision_Settings','Section1_Heading1')?Get_Meta_Tag_Value('Vision_Settings','Section1_Heading1'):'If you need corrective lenses, and frames, FCB Vision will help with the savings.'}}</h1>
            <h2>{{Get_Meta_Tag_Value('Vision_Settings','Section1_Heading2')?Get_Meta_Tag_Value('Vision_Settings','Section1_Heading2'):'Vision'}}</h2>
            @if(Get_Meta_Tag_Value('Vision_Settings','Section1_Description'))
            {!! Get_Meta_Tag_Value('Vision_Settings','Section1_Description') !!}
            @else
            <p>Vision through First Canadian Benefits includes the following:</p>
            <ul>
                <li>
                    <i class="fas fa-headset"></i> <span>Virtual support</span>
                </li>
                <li>
                    <i class="fas fa-eye"></i> <span>20-30% Benefit relief on all examinations</span>
                </li>
                <li>
                    <i class="fas fa-tv"></i> <span>Order Online</span>
                </li>
                <li>
                    <i class="fas fa-shipping-fast"></i> <span>Free delivery</span>
                </li>
            </ul>
            @endif
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Banner_Settings','Vision_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Vision_Mobile_Banner')):asset('/frontend_assets/images/res-vision-hero-bg.jpg');}}" />
    </figure>
</div>
<!-- HEADER END  -->

<!-- VISION-COUNTERS START -->
<section class="counters vision-counters" id="vision-counters">
    <div class="container">
        <ul>
            <li class="counter-box">
                <span>{{Get_Meta_Tag_Value('Vision_Settings','Section2_Description')?Get_Meta_Tag_Value('Vision_Settings','Section2_Description'):'FCB Vision allows you to purchase glasses, lenses, and frames up to a maximum allowance of $5000 in any 12-month period for eligible members.'}}</span>
                <div class="kit">
                    <i class="fas fa-glasses"></i> <!-- <span>{{Get_Meta_Tag_Value('Vision_Settings','Section2_CurrencySymbol')?Get_Meta_Tag_Value('Vision_Settings','Section2_CurrencySymbol'):'$'}}</span> -->
                    <p>{{Get_Meta_Tag_Value('Vision_Settings','Section2_Amount')?Get_Meta_Tag_Value('Vision_Settings','Section2_Amount'):'Unlimited'}}</p>
                </div>
                <p>{{Get_Meta_Tag_Value('Vision_Settings','Section2_Currency_Text')?Get_Meta_Tag_Value('Vision_Settings','Section2_Currency_Text'):'Maximum Allowance'}}</p>
                <div class="counter-box-btn">
                    <a href="{{Get_Meta_Tag_Value('Vision_Settings','Section2_Button1_Link')?url(Get_Meta_Tag_Value('Vision_Settings','Section2_Button1_Link')):route('fcbusers.enroll')}}" class="join-network">{{Get_Meta_Tag_Value('Vision_Settings','Section2_Button1_Text')?Get_Meta_Tag_Value('Vision_Settings','Section2_Button1_Text'):'Enroll Now'}}</a>
                    <a href="{{Get_Meta_Tag_Value('Vision_Settings','Section2_Button2_Link')?url(Get_Meta_Tag_Value('Vision_Settings','Section2_Button2_Link')):route('ContactUs') }}" class="vision-contact-btn">{{Get_Meta_Tag_Value('Vision_Settings','Section2_Button2_Text')?Get_Meta_Tag_Value('Vision_Settings','Section2_Button2_Text'):'Contact Us' }}<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- VISION-COUNTERS END -->

@endsection