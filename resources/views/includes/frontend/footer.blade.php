<!-- BACK TO TOP BUTTON -->
<a id="button"></a>
<!-- BACK TO TOP BUTTON -->

<!-- FOOTER START  -->
<footer>
    <div class="container">
        <div class="footer-row">
            <div class="footer-row-sec">
                <a href="{{url('/')}}">
                    <figure>
                        @if(!empty(Get_Meta_Tag_Value('General_Settings','Footer_Logo')))
                        <img src="{{asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Footer_Logo'))}}" alt="footer-logo" class="ftr-logo" />
                        @else
                        <img src="{{asset('frontend_assets/images/footer-logo.png')}}" alt="footer-logo" class="ftr-logo" />
                        @endif
                    </figure>
                </a>
            </div>
            <div class="footer-row-sec">
                <h4>Company Address</h4>

                @if(!empty(Get_Meta_Tag_Value('General_Settings','Company_Address')))
                <p>{{Get_Meta_Tag_Value('General_Settings','Company_Address')}}</p>
                @else
                <p>FCB Health Network<br>
                    421 Bloor Street East, #206<br>
                    Toronto, Ontario<br>
                    M4W 3T1</p>
                @endif

                <a href="{{Get_Meta_Tag_Value('General_Settings','Facebook_Link') ? Get_Meta_Tag_Value('General_Settings','Facebook_Link'):'#'}}" class="fb" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="{{Get_Meta_Tag_Value('General_Settings','Instagram_Link') ? Get_Meta_Tag_Value('General_Settings','Instagram_Link'):'#'}}" class="fb" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="{{Get_Meta_Tag_Value('General_Settings','Google_Link') ? Get_Meta_Tag_Value('General_Settings','Google_Link'):'#'}}" class="fb" target="_blank"><i class="fab fa-google-plus"></i></a>
            </div>
            <div class="footer-row-sec">
                <h4>Contact Info</h4>
                <ul>
                    <li>
                        <span>Tel:
                            @if(!empty(Get_Meta_Tag_Value('General_Settings','Admin_Phone')))
                            <a href="tel:{{Get_Meta_Tag_Value('General_Settings','Admin_Phone')}}">{{Get_Meta_Tag_Value('General_Settings','Admin_Phone')}}</a>
                            @else
                            <a href="tel:(416) 929-4685">(416) 929-4685</a>
                            @endif

                        </span>
                    </li>
                    <li>
                        <span>Toll-Free:
                            @if(!empty(Get_Meta_Tag_Value('General_Settings','Tollfree')))
                            <a href="tel:+{{Get_Meta_Tag_Value('General_Settings','Tollfree')}}">{{Get_Meta_Tag_Value('General_Settings','Tollfree')}}</a>
                            @else
                            <a href="tel:1 (888) 929-4685">1 (888) 929-4685</a>
                            @endif
                        </span>
                    </li>
                    <li>
                        <span>Fax:
                            @if(!empty(Get_Meta_Tag_Value('General_Settings','Fax')))
                            {{Get_Meta_Tag_Value('General_Settings','Fax')}}
                            @else
                            (416) 929-6876
                            @endif
                        </span>
                    </li>
                    <li>
                        <span class="email-wrap">Email:
                            @if(!empty(Get_Meta_Tag_Value('General_Settings','Admin_Email')))
                            <a href="mailto:{{Get_Meta_Tag_Value('General_Settings','Admin_Email')}}">{{Get_Meta_Tag_Value('General_Settings','Admin_Email')}}</a>
                            @else
                            <a href="mailto:info@fcbhealthnetwork.ca">info@fcbhealthnetwork.ca</a>
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
            <div class="footer-row-sec">
                <figure>
                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Footer_Logo2')))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Footer_Logo2'))}}" alt="omca-logo" />
                    @else
                    <a href="https://www.ontariomanagedcareassociation.ca/"><img src="{{asset('frontend_assets/images/omca-logo.jpg')}}" alt="omca-logo" /></a>
                    @endif
                </figure>
                <p class="clinical">{{Get_Meta_Tag_Value('General_Settings','Footer_Logo2_Text') ? Get_Meta_Tag_Value('General_Settings','Footer_Logo2_Text'):'Clinical and corporate governance for the FCB Health Network'}}</p>
            </div>
            <div class="footer-row-sec">
                <figure>
                    @if(!empty(Get_Meta_Tag_Value('General_Settings','Footer_Logo3')))
                    <img src="{{asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Footer_Logo3'))}}" alt="cmca-logo" />
                    @else
                    <a href="https://www.canadianmanagedcareassociation.ca/"><img src="{{asset('frontend_assets/images/cmca-logo.jpg')}}" alt="cmca-logo" /></a>
                    @endif

                </figure>
                <p class="clinical">{{Get_Meta_Tag_Value('General_Settings','Footer_Logo3_Text') ? Get_Meta_Tag_Value('General_Settings','Footer_Logo3_Text'):'National voice of the managed care and the licensor of the FCB Health Network IP'}}</p>
            </div>
        </div>
        <div class="privacy-policy">
            <p>{{Get_Meta_Tag_Value('General_Settings','TradeMark_Text') ? Get_Meta_Tag_Value('General_Settings','TradeMark_Text'):'FCB Health Network '}}<!-- <sup>TM</sup>  © -->{{Get_Meta_Tag_Value('General_Settings','TradeMark_Year') ? Get_Meta_Tag_Value('General_Settings','TradeMark_Year'):'2021'}} | <a href="{{url('/pages/privacy-policy')}}">Privacy Policy</a></p>
        </div>
    </div>
</footer>
<!-- FOOTER END  -->
 <div id="check_sub1"></div>

<script src="{{asset('frontend_assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend_assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend_assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="{{asset('frontend_assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('frontend_assets/js/jquery.counterup.min.js')}}"></script>

<!--Validate Jquery -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<!--custom scrollbar js -->
<script src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Common js -->
<script src="{{asset('common/js/common.js')}}"></script>
<script src="{{asset('frontend_assets/js/custom.js')}}"></script>
<script src="{{asset('frontend_assets/js/bladefiles.js')}}"></script>

<!-- Google maps -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{Get_Meta_Tag_Value('General_Settings','Google_Maps_API_Key') ? Get_Meta_Tag_Value('General_Settings','Google_Maps_API_Key'):''}}&libraries=places&callback=initMap&solution_channel=GMP_codelabs_simplestorelocator_v1_a">
</script>

<!-- ***Datepicker js *** source url(https://www.jqueryscript.net/time-clock/dropdown-date-picker.html)-->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<script src="https://unpkg.com/jquery-dropdown-datepicker"></script>
<script type="text/javascript">
    setInterval(function(){
        $('#check_sub1').load("<?=URL::to('/showsubscriptiondetails');?>").fadeIn("slow");
        
    }, 10000);
</script>
</body>
</html>