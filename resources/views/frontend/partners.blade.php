@section('title','Our Partners')
@section('metatitle',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')

<div class="main-div" style="padding-bottom:100px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="top-div" style="padding-bottom:20px;">
                    <h1>Helping our members save on all their health needs.</h1>
                    <h2>Our Partners</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="partner-box">
                    <img src="{{asset('/frontend_assets/images/partner_icons/1.png');}}" alt="res-broker-hero-bg" />
                    <p>As our online pharmaceutical partner, Mednow is helping FCB Members save on new or existing prescriptions with the added bonus of:</p>
                    <ul>
                        <li>The lowest dispensing fees</li>
                        <li>Free delivery across Canada</li>
                        <li>$25 credit for wellness goods</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="partner-box">
                    <img src="{{asset('/frontend_assets/images/partner_icons/2.png');}}" alt="res-broker-hero-bg" />
                    <p>FCB Members save on glasses and contacts by utilizing our vision partner Clearly.</p><br>
                    <p>By utilizing Clearly's promo codes, FCB Members will receive:</p>
                    <ul>
                        <li>30% off Clearly branded glasses. 2 purchases per year</li>
                        <li>$20 off contacts over $119</li>
                        <li>Free delivery across Canada</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="partner-box">
                    <img src="{{asset('/frontend_assets/images/partner_icons/3.png');}}" alt="res-broker-hero-bg" />
                    <p>FCB Members can now show their Member Benefits Card at Rexall Pharmacies to receive the following savings:</p>
                    <ul>
                        <li>Reduced dispensing fees</li>
                        <li>Access to over 390 stores across Canada</li>
                        <li>20% off Rexall brands</li>
                        <li>Free ValueScripts membership for Ontario and B.C members</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
    
</div>

@endsection