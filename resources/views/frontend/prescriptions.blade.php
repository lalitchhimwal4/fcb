@section('title','Prescriptions')
@section('metatitle',Get_Meta_Tag_Value('Prescriptions_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Prescriptions_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Prescriptions_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<?php
$background_url = Get_Meta_Tag_Value('Banner_Settings', 'Prescriptions_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Banner_Settings', 'Prescriptions_Desktop_Banner')) : asset('/frontend_assets/images/scripts-hero-bg.jpg');
?>
<div class="main-div prescription-bg" style="background-image: url('{{$background_url}}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="top-div">
                    <h1>{{Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Heading1')?Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Heading1'):'Scripts by FCB is your one stop choice for all your pharmaceutical needs'}}</h1>
                    <h2>{{Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Heading2')?Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Heading2'):'Prescriptions'}}</h2>
                    <p>{!!Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Description')?Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Description'):'Scripts says goodbye to the old days of waiting hours in line for your prescriptions. We offer a streamline solution to aid your needs by delivering your prescription quickly, efficiently, and at the lowest cost anywhere in Canada. Using Scripts by FCB allows you to submit a prescription, refill, or transfer in the comfort of your own home.
Simply take a photo, submit it to our network pharmacist, and let us take care of the rest. Our pharmacists will contact you prior to delivery to confirm the prescription and consult you on how to take your medication
'!!}</p>
                    <div class="top-div-btns">
                        <a href="{{Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button1_Link')?url(Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button1_Link')):'javascript:void(0);'}}" class="enrol-btn">{{Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button1_Text')?Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button1_Text'):'Get Started'}}</a>
                        <a href="{{Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button2_Link')?url(Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button2_Link')):route('ContactUs') }}" class="find-btn">{{Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button2_Text')?Get_Meta_Tag_Value('Prescriptions_Settings','Section1_Button2_Text'):'Contact Us' }} <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Banner_Settings','Prescriptions_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Prescriptions_Mobile_Banner')):asset('/frontend_assets/images/res-scripts.jpg');}}" alt="res-scripts" />
    </figure>
</div>
@endsection