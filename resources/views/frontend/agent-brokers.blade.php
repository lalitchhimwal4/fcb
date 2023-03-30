<?php

use Illuminate\Support\Facades\Request;

?>
@section('title','Payors')
@section('metatitle',Get_Meta_Tag_Value('Agents_Brokers_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('Agents_Brokers_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('Agents_Brokers_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<?php
$background = Get_Meta_Tag_Value('Banner_Settings', 'Payors_Desktop_Banner') ? asset('/storage/' . Get_Meta_Tag_Value('Banner_Settings', 'Payors_Desktop_Banner')) : asset('/frontend_assets/images/broker-hero-bg.jpg');
?>
<!-- HEADER START -->
<div class="main-div agents-bg" style="background-image: url('{{$background}}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="top-div">
                    <h1>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Heading1'):'Providing you with the support and the information that you need to best service your clients'}}</h1>
                    <h2>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Heading2')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Heading2'):'Payors'}}</h2>
                    <p>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Description')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Description'):'First Canadian Benefits (FCB) values the relationships that it establishes with payors. We understand that your business depends on knowing what services are available to your clients and on keeping up with industry changes. Our goal is to provide you with the support and the information that you need to best service your clients.'}}</p>
                    <div class="top-div-btns">
                        <a href="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button1_Link')?url(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button1_Link')):route('fcbusers.enroll')}}" class="enrol-btn">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button1_Text')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button1_Text'):'Enroll Now'}}</a>
                        <!-- <a href="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button2_Link')?url(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button2_Link')):route('fcbusers.login')}}" class="find-btn">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button2_Text')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button2_Text'):'Login' }} <i class="fas fa-long-arrow-alt-right"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <figure class="resposive-img">
        <img src="{{Get_Meta_Tag_Value('Banner_Settings','Payors_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Payors_Mobile_Banner')):asset('/frontend_assets/images/res-broker-hero-bg.jpg');}}" alt="res-broker-hero-bg" />
    </figure>
</div>
<!-- HEADER END  -->
<!-- WHY ENROLL AS A PAYOR START -->
<section class="payor-sec">
    <div class="container">
        <div class=" text-center" >
            <h2 style="margin:40px 0;">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section2_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section2_Heading1'):'Why Enroll as a Payor?'}}</h2>
            @if(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section2_Description'))
            <p>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section2_Description')}}</p>
            @else
            <!-- <p>Health and Dental benefit costs have increased significantly in recent years. Post pandemic recovery is resulting in cases that are out pacing the flow of contributions to plan funds. General economic conditions, regulatory changes, and ongoing uncertainty pose challenges on negotiating increased contribution rates into plans. Currently it is the patient who is bearing most of the fiscal responsibility. As plans gradually reduce coverages to meet costs, it is the patient who will assume the greater copayment and out of pocket expense. Many of these patients will be unable to pay for these out-of-pocket costs and inevitably will not have the treatment performed. As neglect and abstinence take root, so does failing health and productivity in the workplace, inevitably resulting in the need for extensive treatment to bring the member back to their wellbeing.</p>
            <p>There are in fact severe inequities and disparities in the delivery of health benefits. Technology, increased fee guides, inflation, and rising costs of materials dictates the need for more funds. Payors (Insurers, third party administrators (TPAs), corporations, trusts, organizations, and multi-employer sponsored plans, all referred to as payors) must seek for solutions in an alternative delivery of care model to help sustain and maintain current benefits structures. With our resources and providers, payors can look towards funding these solutions. FCB integrates a contracted health network of providers, under clinical governance, to provide payors both savings and compliance to industry standards. FCB integrates provider services as it offers its proprietary health network under reference-based pricing to payors. Payors savings are between 20-30% on all claims payable.</p> -->
<style>
#custom1 p{
	margin: 0 0px;
}
</style>

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
                    <img src="{{asset('/frontend_assets/images/member_Icons/9.png');}}" alt="res-broker-hero-bg" />
                    <h4>More Treatments</h4>
                    <p>Use your plan/policy in the FCB Health Network to receive 20-30% more treatments under your existing plans’ annual maximum with the added bonus of reducing your copayments.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/7.png');}}" alt="res-broker-hero-bg" />
                    <h4>Vendors</h4>
                    <p>Access to our affiliate vendors allowing your members to save on goods and services such as medical supplies, sundries, and more. </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/6.png');}}" alt="res-broker-hero-bg" />
                    <h4>Virtual Care</h4>
                    <p>Virtual care at no cost by video calling one of our network providers.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/8.png');}}" alt="res-broker-hero-bg" />
                    <h4>Online Booking</h4>
                    <p>Online appointment booking to ensure you are making the most of your time.</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/4.png');}}" alt="res-broker-hero-bg" />
                    <h4>Prescriptions</h4>
                    <p>Save on prescriptions with free delivery across Canada and guaranteed lowest dispensing fees.</p><br>
                    <p>Only through Mednow and Rexall*</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/5.png');}}" alt="res-broker-hero-bg" />
                    <h4>Vision</h4>
                    <p>Savings on prescription lenses, frames, and contacts. Maximum of 2 purchases per year.</p><br>
                    <p>Only through Clearly*</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="member-box text-center" >
                    <img src="{{asset('/frontend_assets/images/member_Icons/2.png');}}" alt="res-broker-hero-bg" />
                    <h4>Providers Across Canada</h4>
                    <p>Travelling? Not to worry the FCB Health Network has got you covered. Find new health and dental providers near you by utilizing our interactive provider search.</p>
                </div>
            </div>
           
            

        </div> <!-- Row -->

<!-- <div style="text-align:left;" id="custom1">
<strong>As a member of the FCB Health Network, Payors and their members can expect to receive:</strong>
<ul>
<li>
<span><i class="fas fa-check-circle"></i></span>
<p>Savings of 20-30% on all services performed by utilizing the FCB Health Network under contracted rates (RBP).</p>
</li>
<li>
<span><i class="fas fa-check-circle"></i></span>
<p>In the event you have an existing benefits plan, you may use your plan/policy in the FCB Health Network to receive 20-30% more treatments under your existing plans' annual maximum as well as reduced copayments. Treatments performed/billed above and beyond your plans annual maximum will still be subject to FCB’s Benefit Relief.</p>
</li><li>
<span><i class="fas fa-check-circle"></i></span>
<p>Savings by utilizing our affiliate vendor program, allowing your members to save on goods and services such as medical supplies, sundries, and more.</p>
</li>
<li>
<span><i class="fas fa-check-circle"></i></span>
<p>Virtual Care at no cost by video calling one of our network providers.</p>
</li>
<li>
<span><i class="fas fa-check-circle"></i></span>
<p>Online appointment booking to ensure you are making the most of your time.</p>
</li>
<li>
<span><i class="fas fa-check-circle"></i></span>
<p>Mail order pharmacy with a guaranteed lowest dispensing fee and free delivery. New members also receive $25 credit for all wellness goods.</p>
</li>
<li>
<span><i class="fas fa-check-circle"></i></span>
<p>Savings on hearing aid devices and vision care such as prescription lenses, frames and contacts. Maximum of 2 purchases a year.</p>
</li>
<li>
<span><i class="fas fa-check-circle"></i></span>
<p>Access to a plethora of Health and Dental Providers across Canada in every discipline. Travelling? Not to worry, FCBHN has got you covered! Members will be able to find new health and dental providers nearest them by utilizing our interactive provider search feature. If a member does not see a provider in their area, they may “Nominate a Provider” so the FCB Health Network may reach out.</p>
</li>
</ul><br>
</div> -->

            <!--<p>During the pandemic FCB has embarked on an aggressive growth strategy by partnering with public members, insurers, third party administrators (TPAs), corporations, trusts, organizations, multi-employer sponsored plans, and charitable organizations (all referred to as payors).</p>-->
            <p>FCB has made great strides towards sustaining and maintaining costs, by designing and building the network from the payors perspective. The result is a health network that offers the breadth, depth, and features payors want. FCB has adopted the recommendations of various provider associations as we embrace the better business practices, ethics, and jurisprudence of managing health care.</p>
            @endif
                
                    
        </div>
        <div class="top-div-btns text-right" style="margin:20px 0">
                <a href="javascript:void(0);" class="find-btn" data-toggle="modal" data-target="#exampleModalCenter" style="color: rgb(230, 59, 43);">Find Out More <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
    </div>
</section>
<!-- WHY ENROLL AS A PAYOR END -->
<!-- HOW DOES IT WORK START -->
<section class="why-join-provider" id="why-join-provider">
    <div class="container">
        <div class="who-we-are-content text-center">
            <h2>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Heading1'):'How does it work?'}}</h2>
            <div class="highlighted-sec">
                <p>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Highlighted_Description')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Highlighted_Description'):'FCB is a socially responsible company that provides its services to all Canadians in need. We acknowledge the FCB Health Network Providers as they continue to claim and bill for services under reference-based pricing.'}}</p>
            </div>
            @if(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Description'))
            <p>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Description')}}</p>
            @else
            <p>Payors and their representatives have two options for cost containment and affordable rates.</p>
            <div class="provider-card-sec">
                <div class="provider-card text-center">
                    <h2>Option 1: Standalone Plan</h2>
                    <p>Use FCB's Covid 19 Health and Dental Relief Plan A001 as a standalone plan. By utilizing and receiving treatments under Plan A001, you will be saving 20-30% on all treatments performed by our network providers (unlimited).</p>
                    <a name="reference-based-pricing"></a>
                    <ul class="text-left mb-4">
                        <li>
                            * FCB providers are contracted to accept RBP for all health and dental services specific to their province.
                        </li>
                        <li>
                            * Option 1 allows members to receive coverages with no annual maximums, deductibles, and reduced fees through our contracted rates. Members will also have the opportunity to receive a myriad of goods and services at a reduced rate.
                        </li>
                    </ul>
                    <div class="my-link"><a class="enrol-btn popup-btn" href="{{asset('frontend_assets/resources/Plan_A001_Booklet.pdf')}}"><i class="fas fa-file-pdf"></i> View Plan A001</a></div>
                </div>
                <div class="provider-card text-center">
                    <h2>Option 2: Primary Plan using RBP</h2>
                    <p>Primary plans may now enroll their members into the FCB Health Network to receive a benefit relief on all costs of treatment up to 30% less than the providers current fee guides. Payors can expect savings between 30-40% on all claims payable.
                    <br><br>
                        Payors along with their members will also be receiving savings on a myriad of additional services. 
                        <br><br>
                        Members can also expect reduced copayments as well as more services under your annual maximum. Treatments performed/billed above and beyond your plans annual maximum will still be subject to FCB’s Benefit Relief</p>
                        <!-- <div class="my-link"><a class="enrol-btn popup-btn" href="{{asset('frontend_assets/resources/Plan_A001_Booklet.pdf')}}"><i class="fas fa-file-pdf"></i> View Plan A001</a></div> -->
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- HOW DOES IT WORK END -->
<!-- REFERENCE BASED PRICING START -->
<section class="counters counters-network">
    <div class="container">
        <div class="who-we-are-content text-center text-white">
            <h2 class="text-white">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section4_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section4_Heading1'):'Reference Based Pricing'}}</h2>
            @if(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section4_Description'))
            <p class="text-white">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section4_Description')}}</p>
            @else
            <p class="text-white">Through the evolution of health and dental care, providers have determined their own prices. The result is a broad range of price variances from one provider to another!  The price of a procedure (big or small) will vary simply depending on where the procedure is taking place and who is performing it.</p>
            <p class="text-white">It’s no secret the high cost of health care has many employers feeling limited in their options and ability to provide quality benefits at an affordable cost. Several options exist beyond simply shifting costs to employees. One such option is reference-based pricing (RBP). RBP helps address the cost of care while also addressing employer concerns regarding the affordability of health care benefits.</p>
            @endif
        </div>
    </div>
</section>
<!-- REFERENCE BASED PRICING END -->
<!-- WHAT IS REFERENCE BASED PRICING START -->
<section class="plan-members-alt-bg">
    <div class="container">
        <div class="who-we-are-content text-center">
            <h2>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Heading1'):'What is reference-based pricing?'}}</h2>
            @if(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Description'))
            <p class="text-white">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Description')}}</p>
            @else
            <p>Reference-based pricing is a health plan strategy where the employer sets a ceiling on the amount it will cover for a procedure rather than having the provider determine the cost. Providers are then asked to accept the RBP payment, or provide justification as to why their fees exceed reasonable and customary charges.</p>
            <p>To achieve optimal results for both the employer and member, integrating RBP in health and dental coverages requires specialized administrative capabilities best served by the FCB Health Network.</p>
            <p>Health and Dental plan coverages rarely cover the full amount of any procedure. Cost is typically covered by a combination of funding such as co-pays, deductibles, and plan coverage.</p>
            @endif
        </div>
    </div>
</section>
<!-- WHAT IS REFERENCE BASED PRICING END -->
<!-- How RBP WORKS START -->
<section class="why-join-provider" id="why-join-provider">
    <div class="container">
        <div class="who-we-are-content">
            <h2>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Heading1'):'How RBP Works (Dental Example)'}}</h2>
            <figure>
                <img src="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Image1')?asset('/storage/'.Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Image1')):asset('frontend_assets/images/Simple_Red_and_Beige_Vintage_Illustration_History_Class_Education_Presentation1.png')}}" alt="presentation" />
            </figure>
            @if(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Description'))
            <p>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Description')}}</p>
            @else
            <ol class="plan-members-list">
                <li>Health and Dental providers charge drastically different prices for the same procedure.</li>
                <li>Each province has an established “reasonable and customary” price for that procedure.</li>
                <li>The FCB Health Network uses reasonable and customary (i.e. reference-based) pricing to negotiate with providers to ensure that their employer and member clients are not over-charged.</li>
            </ol>
            @endif
        </div>
    </div>
</section>
<!-- HOW RBP WORKS END -->
<!-- EXAMPLE OF COST VARIANCE START -->
<section class="plan-members-alt-bg">
    <div class="container d-flex">
        <div class="who-we-are-content">
            <h2>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Heading1'):'Example of cost variance: Dental Crown'}}</h2>
            @if(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Description'))
            <p>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Description')}}</p>
            @else
            <p>For example, the cost variance of a Dental Crown might range between $700 and $1100 or more across Canada. However, the quality of the procedure and care provided is basically the same. RBP eliminates the variance with a set amount and ensures a win/win/win scenario:</p>
            <ul>
                <li> * The patient receives quality care at a more affordable cost.</li>
                <li> * The provider receives fair payment for their services.</li>
                <li> * The premiums begin to stabilize for the employer and employees.</li>
            </ul>
            @endif
        </div>
        <div class="p-4 my-auto">
            <figure>
                <img src="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Image1')?asset('/storage/'.Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Image1')):asset('/frontend_assets/images/tooth.png')}}" alt="cost-savings" />
            </figure>
        </div>
    </div>
</section>
<!-- EXAMPLE OF COST VARIANCE END -->
<!-- BENEFITS OF RBP START -->
<section class="why-join-provider" id="why-join-provider">
    <div class="container">
        <div class="who-we-are-content text-center">
            <h2>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section8_Heading1')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section8_Heading1'):'Benefits of RBP? '}}</h2>
            @if(Get_Meta_Tag_Value('Agents_Brokers_Settings','Section8_Description'))
            <p>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section8_Description')}}</p>
            @else
            <p>The objective is simple - address health and dental costs for individual employees and employers. The benefits of RBP however have a far reaching, ripple effect throughout the healthcare community. The intent is to provide an effective tool to help stabilize the cost of healthcare.</p>
            <div class="provider-card-sec">
                <div class="provider-card text-center">
                    <figure>
                        <img src="{{asset('frontend_assets/images/employees-icon.png')}}" alt="presentation" />
                    </figure>
                    <h2>Employees</h2>
                    <p>RBP takes guesswork and worry from employees regarding price - specifically, out of pocket costs. It also encourages members to engage proactively in managing their health and dental costs.</p>
                </div>
                <div class="provider-card text-center">
                    <figure>
                        <img src="{{asset('frontend_assets/images/employers-icon.png')}}" alt="presentation" />
                    </figure>
                    <h2>Employers</h2>
                    <p>Managing cost is a primary motivator of employers choosing self-funded health plans. RBP leverages every opportunity to proactively achieve optimal cost management while still providing quality health care to members.</p>
                </div>
                <div class="provider-card text-center">
                    <figure>
                        <img src="{{asset('frontend_assets/images/healthcare-community-icon.png')}}" alt="presentation" />
                    </figure>
                    <h2>Healthcare Community</h2>
                    <p>Setting fair value pricing through RBP helps create a competitive market focused on improved results through quality performance at an affordable cost.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- BENEFITS OF RBP END -->
<!-- FAQ-SEC START -->
<section class="faq-sec pt-0" id="faq-sec">
    <div class="container">
        <h2>{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Heading')?Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Heading'):'Frequently Asked Questions'}}</h2>
        <!-- accordion -->
        <div class="accordion" id="faq">
            <?php $accordians = Get_Accordians(Request::path());?>
            @foreach($accordians as $accordian)
            <div class="card">
                <div class="card-header" id="faqhead1">
                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq{{$accordian->id}}" aria-expanded="true" aria-controls="faq1">{{($accordian->title)?$accordian->title:''}}</a>
                </div>
                <div id="faq{{$accordian->id}}" class="collapse" aria-labelledby="faqhead1" data-parent="#faq">
                    <div class="card-body">
                        {!!($accordian->description)?$accordian->description:''!!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- accordion end  -->
    </div>
</section>
<!-- FAQ-SEC END -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Why Enroll as a Payor?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p>Health and Dental benefit costs have increased significantly in recent years. Post pandemic recovery is resulting in cases that are out pacing the flow of contributions to plan funds. General economic conditions, regulatory changes, and ongoing uncertainty pose challenges on negotiating increased contribution rates into plans. Currently it is the patient who is bearing most of the fiscal responsibility. As plans gradually reduce coverages to meet costs, it is the patient who will assume the greater copayment and out of pocket expense. Many of these patients will be unable to pay for these out-of-pocket costs and inevitably will not have the treatment performed. As neglect and abstinence take root, so does failing health and productivity in the workplace, inevitably resulting in the need for extensive treatment to bring the member back to their wellbeing.</p>
        <br>
        <p>There are in fact severe inequities and disparities in the delivery of health benefits. Technology, increased fee guides, inflation, and rising costs of materials dictates the need for more funds. Payors (Insurers, third party administrators (TPAs), corporations, trusts, organizations, and multi-employer sponsored plans, all referred to as payors) must seek for solutions in an alternative delivery of care model to help sustain and maintain current benefits structures. With our resources and providers, payors can look towards funding these solutions. FCB integrates a contracted health network of providers, under clinical governance, to provide payors both savings and compliance to industry standards. FCB integrates provider services as it offers its proprietary health network under reference-based pricing to payors. Payors savings are between 20-30% on all claims payable.</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection