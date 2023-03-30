@section('title','Plan Members')
@section('metatitle',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Plan_Members_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<?php
$background = Get_Meta_Tag_Value('Banner_Settings', 'Plan_Members_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Banner_Settings', 'Plan_Members_Desktop_Banner')) : asset('/frontend_assets/images/vendor.jpg');
?>
<div class="main-div" style="background-image: url('{{$background}}');padding-top:0px">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="top-div vendor-sec">
                    <h1>Coming Soon!</h1>
                    <h2>Vendors</h2>
                    <p>Across Canada, FCB’s Affiliate Vendors are coming together to support FCB Providers and Members by offering goods and services at promotional rates.</p>
                    <p>The FCB Health Network could not continue in its efforts if it were not for the contributions made by FCB’s affiliate vendors. With providers' overhead exhausting over 50% of their income, FCB's affiliate vendors offer savings that allow FCB Providers to bill at their contracted rates (RBP), helping Canadians nationwide.</p>
                    <ul class="experience-card">
                        <li>
                        <img src="{{asset('/frontend_assets/images/vendor_icons/1.png');}}" alt="res-broker-hero-bg" />
                        </li>
                        <li>
                        <img src="{{asset('/frontend_assets/images/vendor_icons/2.png');}}" alt="res-broker-hero-bg" /> 
                        </li>
                        <li>
                        <img src="{{asset('/frontend_assets/images/vendor_icons/3.png');}}" alt="res-broker-hero-bg" />
                        </li>
                    </ul>
                    <p>FCB Providers and Members will have access to vendor promo codes through their user dashboard.</p>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Mobile_Banner')):asset('/frontend_assets/images/res-home-hero-1024x451.png');}}" alt="res-broker-hero-bg" />
    </figure>
</div>
<!-- HEADER END  -->
@endsection