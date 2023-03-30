<?php
use App\Models\Member;
?>
<div class="modal" id="searchModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body search-modal-body">
                <div class="row search-modal-row">
                    <div class="col-md-6 col-sm-12 col-12">
                        <div class="search-modal-content" id="style-scrollbar">
                            <h4>Find a Provider</h4>
                            <div class="form-group">
                                <label class="enroll-label">Provider Type </label>
                                <?php
                                $provider_types = DB::table('assigning_authorities')->get(); ?>
                                
                                    <select class="form-control" id="provider_type_id" name="provider_type_id">
                                        <option value="">Select</option>
                                        @foreach($provider_types as $provider_type)
                                        <option value="{{$provider_type->assigning_authority_number}}">{{$provider_type->assigning_authority_code_description}}</option>
                                        @endforeach
                                    </select>
                                
                            </div>
                            <label class="enroll-label">Search Address </label>
                            <input type="text" class="form-control" id="pac-input">
                            <!-- <div class="location-wrap search-provider-location-wrap">
                                <div class="input-group" id="search-provider-location-input"></div>
                            </div>  -->
                            <select class="form-control" name="province1" id="province1" style="display:none;">
                                        <option value="">Select an option</option>
                                        <option value="NS">Nova Scotia</option>
                                        <option value="PE">Prince Edward Island</option>
                                        <option value="NL">Newfoundland and Labrador</option>
                                        <option value="NB">New Brunswick</option>
                                        <option value="QC">Quebec</option>
                                        <option value="ON">Ontario</option>
                                        <option value="MB">Manitoba</option>
                                        <option value="SK">Saskatchewan</option>
                                        <option value="AB">Alberta</option>
                                        <option value="BC">British Columbia</option>
                                        <option value="YT">Yukon</option>
                                        <option value="NT">Northwest Territories</option>
                                        <option value="NU">Nunavut</option>
                                    </select>
                            <input type="hidden" id="latitude1">
                            <input type="hidden" id="longitude1">
                            <input type="hidden" id="start" value="0">
                            <input type="hidden" id="end" value="5">
                            <input type="hidden" id="totalrecords" value="1020">
                            <input type="hidden" id="rowperpage" value="25">
                            <p id="total_provider" style="color:#e63b2b;"></p>
                            <div class="search-providers-wrapper">
                            </div>
                            <img src="https://c.tenor.com/wfEN4Vd_GYsAAAAM/loading.gif" id="loading" style="display:none;">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12">
                        <div class="search-map" id="map" data-route="{{route('member.findproviders')}}" data-search_radius="{{Get_Meta_Tag_Value('General_Settings','Google_Maps_Search_Radius')??''}}" @if(Auth::guard('member')->user()) data-member_location="{{Member::find(Auth::guard('member')->user()->id)->insured_profile()->first(['latitude', 'longitude'])}}" @endif></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #loading{
        width: 20%;
        margin: auto 38%;
    }
    #total_provider{
        color: #e63b2b;
        font-weight: 500;
        padding-top: 5px;
    }
</style>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $("#pac-input").keyup(function(){
        var input = document.getElementById('pac-input');
    });
   
google.maps.event.addDomListener(window, "load", initialize);
initialize();
function initialize() {
    
    var input = document.getElementById('pac-input');
    var options = {
        componentRestrictions: { country: "CA" },
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener("place_changed", function() {
        var place = autocomplete.getPlace();
        var address_components = place.address_components;
        var components = {};
        jQuery.each(address_components, function(k, v1) {
            jQuery.each(v1.types, function(k2, v2) {
                components[v2] = v1.long_name;
            });
        });
            
        //inserting value in province
        var select = document.getElementById("province1");
        var option;

        for (var i = 0; i < select.options.length; i++) {
            option = select.options[i];

            if (option.text == components.administrative_area_level_1) {
                option.setAttribute("selected", true);

                // For a single select, the job's done
                break;
            }
        }

        // inserting value in latitude and longitude
        $("#latitude1").val(place.geometry["location"].lat());
        $("#longitude1").val(place.geometry["location"].lng());
        var lat = place.geometry["location"].lat();
        var lng = place.geometry["location"].lng()
        var start = $('.start').val();
        var end = $('.end').val();
        $(".search-providers-wrapper").empty();
        $('#loading').show();
        var provider_type = $('#provider_type_id').val();    
        if(provider_type != ''){
            $.ajax({
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: "{{URL::route('getdistance')}}",
                data: { lat : lat, lng : lng, start: start, end : end, provider_type : provider_type },
                success: function (result) {
                    if(result){
                        $('#loading').hide();
                        var result = result.reduce((r, e) => (r.push(...e), r), [])
                        result.sort(function(a, b) {
                        var keyA = new Date(a.dis),
                            keyB = new Date(b.dis);
                    
                        if (keyA < keyB) return -1;
                        if (keyA > keyB) return 1;
                        return 0;
                        });
                        $("#total_provider").empty().append('Total Providers In Your Area: '+result.length);
                        $.each(result, function (key, val) {
                            var listdata = '<div class="sr-modal-location-wrap"><h5 class="heading"><span>'+val.clinic_name+'</span></h5><div class="add-row d-flex flex-wrap justify-content-between"><p><strong>Address:</strong> '+val.address+'<br><strong>Distance:</strong> '+val.distance+'</p></div><div class="bottom-button-wrap d-flex flex-wrap align-items-center float-right"><span id="select-map-location" class="select-map-location">Select This Location<i class="fas fa-arrow-right"></i></span><input type="hidden" name="storeid" value="'+val.storeid+'"></div></div>';
                            $(".search-providers-wrapper").append(listdata);
                        });
                        $('#select-map-location').trigger('click');
                        $('.gm-ui-hover-effect').trigger('click');

                    }else{
                        $("#total_provider").empty().append('No Provider Found');
                    }    
                },
                error: function(err){
                
                }
            });
        }else{
            alert('Please select Provider Type');
        }
    });
}   

});

</script>

