@section('title','Contact Us')
@section('metatitle',Get_Meta_Tag_Value('ContactUs_Settings','Meta_Title'))
@section('metakeyword',Get_Meta_Tag_Value('ContactUs_Settings','Meta_Keyword'))
@section('metadescription',Get_Meta_Tag_Value('ContactUs_Settings','Meta_Description'))
@extends('layouts.frontend.main')
@section('content')
<!-- NEWS-SEC START -->
<section class="news  cm-top-mrgn" id="news">
    <div class="counters news-sec contact-sec">
        <div class="container">
            <ul>
                <li>
                    <h2>{{Get_Meta_Tag_Value('ContactUs_Settings','Heading1')?Get_Meta_Tag_Value('ContactUs_Settings','Heading1'):'Contact Us'}}</h2>
                    <span>{{Get_Meta_Tag_Value('ContactUs_Settings','Heading2')?Get_Meta_Tag_Value('ContactUs_Settings','Heading2'):"We're standing by to assist you, send us a message below."}}</span>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- NEWS-SEC END -->
<!-- CONTACT-DETAILS START  -->
<section class="contact-details" id="contact-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="address-detail">
                    <h4>Address, Phone & Email</h4>
                    <ul>
                        <li class="home-address">
                            <i class="fas fa-home"></i>
                            <div class="place">
                                @if(!empty(Get_Meta_Tag_Value('General_Settings','Company_Address')))
                                <p>{{Get_Meta_Tag_Value('General_Settings','Company_Address')}}</p>
                                @else
                                <p>FCB Health Network<br>
                                    421 Bloor Street East, #206<br>
                                    Toronto, Ontario<br>
                                    M4W 3T1</p>
                                @endif
                            </div>
                        </li>
                        <li class="fon">
                            <i class="fas fa-phone-alt"></i>
                            <div class="place">
                                <p>Local:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Admin_Phone')))
                                    <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Admin_Phone')}}">{{Get_Meta_Tag_Value('General_Settings','Admin_Phone')}}</a>
                                    @else
                                    <a href="tel:+14169294685">(416) 929-4685</a>
                                    @endif
                                </p>
                                <p>Toll-Free:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Tollfree')))
                                    <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Tollfree')}}">{{Get_Meta_Tag_Value('General_Settings','Tollfree')}}</a>
                                    @else
                                    <a href="tel:+18889294685">1 (888) 929-4685</a>
                                    @endif
                                </p>
                            </div>
                        </li>
                        <li class="fax">
                            <i class="fas fa-fax"></i>
                            <div class="place">
                                <p>Fax:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Fax')))
                                    {{Get_Meta_Tag_Value('General_Settings','Fax')}}
                                    @else
                                    (416) 929-6876
                                    @endif
                                </p>
                            </div>
                        </li>
                        <li class="info-icon">
                            <i class="fas fa-envelope"></i>
                            <div class="place">
                                <p>
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Admin_Email')))
                                    <a href="mailto:{{Get_Meta_Tag_Value('General_Settings','Admin_Email')}}">{{Get_Meta_Tag_Value('General_Settings','Admin_Email')}}</a>
                                    @else
                                    <a href="mailto:info@fcbhealthnetwork.ca">info@fcbhealthnetwork.ca</a>
                                    @endif
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="address-detail">
                    <h4>Payors\Providers\Members Inquires</h4>
                    <ul>
                        <li class="fon">
                            <i class="fas fa-phone-alt"></i>
                            <div class="place">
                                <p>Local:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Telephone')))
                                    <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Telephone')}}">{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Telephone')}}</a>
                                    @else
                                    <a href="tel:+14169294685">(416) 929-4685</a>
                                    @endif
                                </p>
                                <p>Toll-Free:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Tollfree')))
                                    <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Tollfree')}}">{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Tollfree')}}</a>
                                    @else
                                    <a href="tel:+18889294685">1 (888) 929-4685</a>
                                    @endif
                                </p>
                            </div>
                        </li>
                        <li class="fax">
                            <i class="fas fa-fax"></i>
                            <div class="place">
                                <p>Fax:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Fax')))
                                    {{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Fax')}}
                                    @else
                                    (416) 929-6876
                                    @endif
                                </p>
                            </div>
                        </li>
                        <li class="info-icon">
                            <i class="fas fa-envelope"></i>
                            <div class="place">
                                <p>
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Email')))
                                    <a href="mailto:{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Email')}}">{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Email')}}</a>
                                    @else
                                    <a href="mailto:info@fcbhealthnetwork.ca">info@fcbhealthnetwork.ca</a>
                                    @endif
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="address-detail">
                    <h4>Administrators, Agents and Brokers</h4>
                    <ul>
                        <li class="fon">
                            <i class="fas fa-phone-alt"></i>
                            <div class="place">
                                <p>Local:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Telephone')))
                                    <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Telephone')}}">{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Telephone')}}</a>
                                    @else
                                    <a href="tel:+14169294685">(416) 929-4685</a>
                                    @endif
                                </p>
                                <p>Toll-Free:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Tollfree')))
                                    <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Tollfree')}}">{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Tollfree')}}</a>
                                    @else
                                    <a href="tel:+18889294685">1 (888) 929-4685</a>
                                    @endif
                                </p>
                            </div>
                        </li>
                        <li class="fax">
                            <i class="fas fa-fax"></i>
                            <div class="place">
                                <p>Fax:
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Fax')))
                                    {{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Fax')}}
                                    @else
                                    (416) 929-6876
                                    @endif
                                </p>
                            </div>
                        </li>
                        <li class="info-icon">
                            <i class="fas fa-envelope"></i>
                            <div class="place">
                                <p>
                                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Email')))
                                    <a href="mailto:{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Email')}}">{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Email')}}</a>
                                    @else
                                    <a href="mailto:info@fcbhealthnetwork.ca">info@fcbhealthnetwork.ca</a>
                                    @endif
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endforeach
                <form id="contactform" action="{{route('SaveContactDetails')}}" class="contact-form" method="POST">
                    @csrf
                    <h2>{{Get_Meta_Tag_Value('ContactUs_Settings','ContactForm_Heading')?Get_Meta_Tag_Value('ContactUs_Settings','ContactForm_Heading'):'How can we help you?'}}</h2>
                    <p>{{Get_Meta_Tag_Value('ContactUs_Settings','ContactForm_Text')?Get_Meta_Tag_Value('ContactUs_Settings','ContactForm_Text'):'Have a question about our network? We’d be happy to help. Submit your inquiry using the following form and a representative will be in touch with you shortly.'}}</p>
                    <div class="canadian-form">
                        <div class="form-group">
                            <label for="name">Your Name<sub class="asterick">*</sub></label>
                            <input type="text" name="name" id="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email<sub class="asterick">*</sub></label>
                            <input type="text" name="email" id="email" value="">
                           
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject<sub class="asterick">*</sub></label>
                            <input type="text" name="subject" value="">
                        </div>
                        <div class="form-group">
                            <label for="messagetext">Your Message<sub class="asterick">*</sub></label>
                            <textarea name="message" cols="40" rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn enrol-btn">Send</button>
                        <!-- <a href="javascript:void(0);" onclick="document.getElementById('contactform').submit()" class="contact-submit">Send</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- CONTACT-DETAILS END  -->
@endsection
@section('footerjs')
<script>

$(document).ready(function() {
    //frontend validation start


  addEmailValidation();  //calling function from common.js for validate email


    if ($("#contactform").length > 0) {

        $("#contactform").validate({


            rules: {
                name: {
                    required: true,
                    lettersonly: false,
                    maxlength: 30,
                    minlength: 3,
                },

                email: {

                    required: true,
                    customemail:true,
                },
                subject: {

                    required: true,
                    maxlength: 30,
                    minlength: 3,

                },

                message: {

                    required: true,
                    maxlength: 1000,
                    minlength: 3,
                },

            },
            messages: {

                name: {
                    required: "Please enter Name",
                },
                email: {
                    required: "Please enter Email",
                },
                subject: {
                    required: "Please enter Subject",
                },
                message: {
                    required: "Please enter Message",
                },


            },

         
        })
    }

    //frontend validation complete


})
</script>
@endsection