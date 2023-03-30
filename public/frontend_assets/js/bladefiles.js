// to add down-triangle symbol in select boxes
$(window).load(function() {
    var selectbox = $(".select-wrap select");
    var down_triangular_symbol = window.location.protocol + "//" + window.location.hostname + "/frontend_assets/images/down-filled-triangular-arrow.png";
    for (var i = 0; i < selectbox.length; i++) {
        selectbox[i].setAttribute("style", "background-image: url(" + down_triangular_symbol + ");");
    }
});

// member enroll step 2 page js
function member_enroll_step2_js() {
    let y = new Date().getFullYear();

    // date of birth datepicker
    $("#dateofbirth").dropdownDatepicker({
        allowFuture: false,
        dropdownClass: "form-control dobselect",
        wrapperClass: "select-wrap dobselectwrap",
        minYear: y-100,
    });
    // Google maps
    google.maps.event.addDomListener(window, "load", initialize);

    function initialize() {
        var input = document.getElementById("autocomplete");
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

            $('input[name="postalcode"]').val(components.postal_code); // inserting value in postal code
            $('input[name="city"]').val(components.locality); // inserting value in city

            //inserting value in province
            var select = document.getElementById("province");
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
            $("#latitude").val(place.geometry["location"].lat());
            $("#longitude").val(place.geometry["location"].lng());
        });
    }

    
}

// member edit contact details page js
function member_edit_contact_details_js() {

    // Google maps start
    $("#latitude").css("opacity", "0");
    $("#latitude").css("width", "0%");
    $("#latitude").css("font-size", "0px");

    $("#longitude").css("opacity", "0");
    $("#longitude").css("width", "0%");
    $("#longitude").css("font-size", "0px");

    // Seach location using google maps
    google.maps.event.addDomListener(window, "load", initialize);

    function initialize() {
        var input = document.getElementById("autocomplete");
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

            $('input[name="postalcode"]').val(components.postal_code); // inserting value in postal code
            $('input[name="city"]').val(components.locality); // inserting value in city

            //inserting value in province
            var select = document.getElementById("province");
            var option;

            for (var i = 0; i < select.options.length; i++) {
                option = select.options[i];

                if (option.text == components.administrative_area_level_1) {
                    option.setAttribute("selected", true);

                    // For a single select, the job's done
                    break;
                }
            }

            //inserting value in latitude and longitude
            $("#latitude").val(place.geometry["location"].lat());
            $("#longitude").val(place.geometry["location"].lng());
        });
    }
}

// provider enroll step1  js start
function provider_enroll_step1_js(provider_case_search, dental_provider_exist_office_exist, health_provider_exist_office_exist) {
    // csrf token for ajax request
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').val(),
        },
    });

    // capitalize postal code
    $('input[name="postal_code"]').keyup(function() {
        this.value = this.value.toUpperCase();
    });

    // initially hide case2 div,case 3-4 div,license no, postal code, office location no., search button, submit button
    $(".provider-step1-FCB-wrapper.provider-step1-case-2-div").hide(); //case2 div hide
    $(".provider-step1-FCB-wrapper.provider-step1-case-3-4-div").hide(); //case 3 4 div hide
    $("div[name='dental_speciality_area']").hide();
    $("div[name='license_area']").hide();
    $("div[name='postal_code_area']").hide();
    $("div[name='office_location_area']").hide();
    $("#provider_enroll_step1_search_button").hide();
    $("#provider_enroll_step1_submit_button").hide();

    // Show input fields based on selection start
    $("#provider_type").on("change", function() {
        var selectedoption = $(this).val();
       
        //if select value change then delete errors of previous selected option,delete previously shown div of case 2,3,4 ,hide submit and search button
        $(".provider_search_error").remove();
        $("div[name='dental_speciality_area'] label.error").remove();
        $("div[name='license_area'] label.error").remove();
        $("div[name='office_location_area'] label.error").remove();
        $("div[name='postal_code_area'] label.error").remove();
        $('#provider_type').removeAttr("disabled");
        $('#dental_speciality').removeAttr("disabled");
        $('input[name="license_number"]').removeAttr("disabled");
        $('input[name="office_location_number"]').removeAttr("disabled");
        $(".provider-step1-FCB-wrapper.provider-step1-case-2-div").hide(); //case2 div hide if previously we have shown it
        $(".provider-step1-FCB-wrapper.provider-step1-case-3-4-div").hide(); //case 3 4 div hide if previously we have shown it
        $("#provider_enroll_step1_submit_button").hide();
        $("#provider_enroll_step1_search_button").hide();

        if (selectedoption) {
            $("#provider_enroll_step1_search_button").show();

            if (selectedoption == 1) {
                $("div[name='dental_speciality_area']").show();
                $("div[name='license_area']").show();
                $("div[name='office_location_area']").show();
                $("div[name='postal_code_area']").hide();
            } else if (selectedoption > 1) {
                $("#License_number").empty().append('License Number');
                $("div[name='license_area']").show();
                $("div[name='postal_code_area']").show();
                $("div[name='dental_speciality_area']").hide();
                $("div[name='office_location_area']").hide();
            }
        } else {
            // If nothing is selected then hide all input fields and search button
            $("div[name='dental_speciality_area']").hide();
            $("div[name='license_area']").hide();
            $("div[name='postal_code_area']").hide();
            $("div[name='office_location_area']").hide();
            $("#provider_enroll_step1_search_button").hide();
            $("#provider_enroll_step1_submit_button").hide();
        }
    });
    $("#dental_speciality").on("change", function() {
        var selectedoption = $(this).val();
        if (selectedoption == 12) {            
            $("#License_number").empty().append('Unique Number');
        }else{            
            $("#License_number").empty().append('License Number');
        }
    });

    // Validate data when clicking on search button
    $("#provider_enroll_step1_search_button").click(function() {
        $(".provider_search_error").remove(); //clear if there is any previous error
        $(".provider-step1-FCB-wrapper.provider-step1-case-2-div").hide(); //case2 div hide if previously we have shown it
        $(".provider-step1-FCB-wrapper.provider-step1-case-3-4-div").hide(); //case 3 4 div hide if previously we have shown it

        if ($("#provider_type").val() == "") {
            var newlabel = document.createElement("Label");
            newlabel.setAttribute("class", "provider_search_error error");
            newlabel.innerHTML = "Please select provider type";
            $(newlabel).insertAfter(".provider_enroll_step1_form_fields");
            return false;
        }

        if ($("#provider_type").val() == 1) {
            if (dental_fields_validate()) {
                // dental validation passed now making ajax request for search case of dental provider
                $.ajax({
                    url: provider_case_search,
                    method: "post",
                    data: {
                        license_number: $("input[name='license_number']").val(),
                        office_location_number: $(
                            "input[name='office_location_number']"
                        ).val(),
                        provider_type: $("select[name='provider_type']").val(),
                        dental_speciality: $("select[name='dental_speciality']").val(),
                    },
                    beforeSend: function() {
                        $("#provider_enroll_step1_search_button").attr(
                            "disabled",
                            "disabled"
                        ); //to stop multiple submits
                    },
                    complete: function() {
                        $("#provider_enroll_step1_search_button").removeAttr("disabled"); //to remove disable attribute from submit button
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.error) {
                            var newlabel = document.createElement("Label");
                            newlabel.setAttribute("class", "provider_search_error error");
                            newlabel.innerHTML = response.error;
                            $(newlabel).insertAfter(".provider_enroll_step1_form_fields");
                            return false;
                        }
                        if (response.case == 1) {
                            // Provider exists and office also exist i.e. Case 1
                            // before redirect to another page change provider select type to none so that if user comes back process should start from starting
                            $("#provider_type").val("").change();

                            var url = dental_provider_exist_office_exist;
                            url = url.replace(":license_num", response.license_number);
                            url = url.replace(":location_num", response.location_number);
                            window.location.href = url;
                        } else if (response.case == 2) {
                            // Provider exists but office does not exist i.e. Case 2
                            $('input[name="provider_case"]').val(response.case);
                            $('input[name="selected_provider_type"]').val(response.provider_type);
                            $('input[name="first_name"]').val(response.provider_fname);
                            $('input[name="last_name"]').val(response.provider_lname);

                            // disable license and office lcation number to stop editing after search complete
                            $('#provider_type').attr("disabled", "disabled");
                            $('#dental_speciality').attr("disabled", "disabled");
                            $('input[name="license_number"]').attr("disabled", "disabled");
                            $('input[name="office_location_number"]').attr("disabled", "disabled");

                            $(".provider-step1-FCB-wrapper.provider-step1-case-2-div").show();
                            $("#provider-step1-case-2-license-number").text(response.license_number);
                            $("#provider-step1-case-2-fname").text(response.provider_fname);
                            $("#provider-step1-case-2-lname").text(response.provider_lname);
                            $("#provider_enroll_step1_search_button").hide();
                            $("#provider_enroll_step1_submit_button").show();
                        }
                        //Provider not exists and office also does not exist i.e. Case 3 and  //Provider not exists but office exist i.e. Case 4
                        else if (response.case == 3 || response.case == 4) {
                            $('input[name="provider_case"]').val(response.case);
                            $('input[name="selected_provider_type"]').val(response.provider_type);

                            //disable license and office lcation number to stop editing after search complete
                            $('#provider_type').attr("disabled", "disabled");
                            $('#dental_speciality').attr("disabled", "disabled");
                            $('input[name="license_number"]').attr("disabled", "disabled");
                            $('input[name="office_location_number"]').attr("disabled", "disabled");

                            $(".provider-step1-FCB-wrapper.provider-step1-case-3-4-div").show();
                            $("#provider-step1-case-3-4-license-number").text(response.license_number);
                            $("#provider_enroll_step1_search_button").hide();
                            $("#provider_enroll_step1_submit_button").show();
                        }
                    },
                    error: function(error) {
                        $("#provider_enroll_step1_search_button").removeAttr("disabled"); //to remove disable attribute from  submit button

                        var newlabel = document.createElement("Label");
                        newlabel.setAttribute("class", "provider_search_error error");
                        newlabel.innerHTML = error.responseJSON.message;
                        $(newlabel).insertAfter(".provider_enroll_step1_form_fields");
                    },
                });
            }
        } else {
            if (health_fields_validate()) {
                // health validation passed now making ajax request for search case of health provider
                $.ajax({
                    url: provider_case_search,
                    method: "post",
                    data: {
                        license_number: $("input[name='license_number']").val(),
                        postal_code: $("input[name='postal_code']").val(),
                        provider_type: $("select[name='provider_type']").val(),
                    },
                    beforeSend: function() {
                        $("#provider_enroll_step1_search_button").attr(
                            "disabled",
                            "disabled"
                        ); //to stop multiple submits
                    },
                    complete: function() {
                        $("#provider_enroll_step1_search_button").removeAttr("disabled"); //to remove disable attribute from  submit button
                    },
                    success: function(response) {
                        if (response.error) {
                            var newlabel = document.createElement("Label");
                            newlabel.setAttribute("class", "provider_search_error error");
                            newlabel.innerHTML = response.error;
                            $(newlabel).insertAfter(".provider_enroll_step1_form_fields");
                            return false;
                        }

                        if (response.case == 1) {
                            // Provider exists and office also exist i.e. Case 1
                            // before redirect to another page change provider select type to none so that if user come back process should start from starting
                            $("#provider_type").val("").change();

                            var url = health_provider_exist_office_exist;
                            url = url.replace(":license_num", response.license_number);
                            url = url.replace(":postal_code", response.postal_code);
                            url = url.replace(" ", "");
                            window.location.href = url;
                        } else if (response.case == 2) {
                            // Provider exists but office does not exist i.e. Case 2
                            $('input[name="provider_case"]').val(response.case);
                            $('input[name="selected_provider_type"]').val(response.provider_type);
                            $('input[name="first_name"]').val(response.provider_fname);
                            $('input[name="last_name"]').val(response.provider_lname);

                            $(".provider-step1-FCB-wrapper.provider-step1-case-2-div").show();
                            $("#provider-step1-case-2-license-number").text(response.license_number);
                            $("#provider-step1-case-2-fname").text(response.provider_fname);
                            $("#provider-step1-case-2-lname").text(response.provider_lname);
                            $("#provider_enroll_step1_search_button").hide();
                            $("#provider_enroll_step1_submit_button").show();
                        }
                        //Provider not exists and office also does not exist i.e. Case 3 and  //Provider not exists but office exist i.e. Case 4
                        else if (response.case == 3 || response.case == 4) {
                            $('input[name="provider_case"]').val(response.case);
                            $('input[name="selected_provider_type"]').val(response.provider_type);

                            $(".provider-step1-FCB-wrapper.provider-step1-case-3-4-div").show();
                            $("#provider-step1-case-3-4-license-number").text(response.license_number);
                            $("#provider_enroll_step1_search_button").hide();
                            $("#provider_enroll_step1_submit_button").show();
                        }
                    },
                    error: function(error) {
                        $("#provider_enroll_step1_search_button").removeAttr("disabled"); //to remove disable attribute from  submit button

                        var newlabel = document.createElement("Label");
                        newlabel.setAttribute("class", "provider_search_error error");
                        newlabel.innerHTML = error.responseJSON.message;
                        $(newlabel).insertAfter(".provider_enroll_step1_form_fields");
                    },
                });
            }
        }
    });
}

// validations methods used in validation
function dental_fields_validate() {
    var is_error = false;
    $("div[name='license_area'] label.error").remove();
    $("div[name='office_location_area'] label.error").remove();
    $("div[name='dental_speciality'] label.error").remove();

    var license_num_length = $("input[name='license_number']").val().length;
    var office_location_num = $("input[name='office_location_number']").val();

    if (license_num_length < 8 || license_num_length > 9) {
        var newlabel = document.createElement("Label");
        newlabel.setAttribute("class", "error");
        if ($("#provider_type").val() == 1) {
            if($("#dental_speciality").val() == 12){
                newlabel.innerHTML = "Unique Number length must be 8 or 9 numbers as assigned by your association.";
            }else{
                newlabel.innerHTML = "Unique Number length must be 8 numbers as assigned by your location.";
            } 
        }else{
            newlabel.innerHTML = "License Number length must be 8 or 9 numbers as assigned by CDA";
        }
        $("div[name='license_area']").append(newlabel);
        is_error = true;
    }

    if (office_location_num.length !== 4) {
        var newlabel = document.createElement("Label");
        newlabel.setAttribute("class", "error");
        if ($("#provider_type").val() == 1) {
            if($("#dental_speciality").val() == 12){
                newlabel.innerHTML = "Office Number must be 4 digits.";
            }
            else{
                newlabel.innerHTML = "Office Number must be 4 digits as assigned by CDA.";
            }
        }else{
            newlabel.innerHTML = "Office1 Number length must be 4 numbers as assigned by CDA";
        }
        $("div[name='office_location_area']").append(newlabel);
        is_error = true;
    }

    if (is_error) return false;
    return true;
}

function health_fields_validate() {
    var is_error = false;
    $("div[name='license_area'] label.error").remove();
    $("div[name='postal_code_area'] label.error").remove();

    var license_num_length = $("input[name='license_number']").val().length;
    var postal_code_value = $("input[name='postal_code']").val();

    if (license_num_length < 1) {
        var newlabel = document.createElement("Label");
        newlabel.setAttribute("class", "error");
        newlabel.innerHTML = "Please enter License Number";
        $("div[name='license_area']").append(newlabel);
        is_error = true;
    }

    if (postal_code_value.length < 1 || !/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/.test(postal_code_value)) {
        var newlabel = document.createElement("Label");
        newlabel.setAttribute("class", "error");
        newlabel.innerHTML = "Please enter a valid postal code";
        $("div[name='postal_code_area']").append(newlabel);
        is_error = true;
    }

    if (is_error) return false;
    return true;
}

// show change password alert js
function showpasswordalert(showalertvalue) {
    //checking password alert exists for user or not
    if (showalertvalue == 0) {
        $("#changepasswordmodal").modal("show");
    }
}

function update_alert_value_for_user(url_for_update_alert_value) {
    $.ajax({
        url: url_for_update_alert_value,
        type: "POST",
        data: "",
        success: function(response) {},
    });
}

function changelaterpassword(url_for_update_alert_value) {
    update_alert_value_for_user(url_for_update_alert_value);
    $("#changepasswordmodal").modal("hide");
}

function changenowpassword(url_for_update_alert_value, changepasswordurl) {
    update_alert_value_for_user(url_for_update_alert_value);
    $("#changepasswordmodal").modal("hide");
    window.location.href = changepasswordurl;
}

// common function for member and provider module
function toggle_password_visibility(eye, inputname) {
    if ($("input[name=" + inputname + "]").attr("type") == "password") {
        $(eye).removeClass("fas fa-eye-slash");
        $(eye).addClass("fa fa-eye");
        $("input[name=" + inputname + "]").attr("type", "text");
    } else {
        $(eye).removeClass("fa fa-eye");
        $(eye).addClass("fas fa-eye-slash");
        $("input[name=" + inputname + "]").attr("type", "password");
    }
}

// Autocomplete Address for provider offices
function Autocomplete_Address_for_provider_office(input_ele_id) {
    google.maps.event.addDomListener(
        window,
        "load",
        find_office_address_using_google_maps
    );
    
    var postalCode = document.getElementById('zipCode');
    
    function find_office_address_using_google_maps() {
        var input = document.getElementById(input_ele_id);
       
        
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
            if(postalCode.value){
                if(components.postal_code === postalCode.value){
                    $('input[name="postal_code"]').val(components.postal_code);
                   
                }
                
            }else{
                $('input[name="postal_code"]').val(components.postal_code); //inserting value in postal code
                //inserting value in disabled postal code for dental
                $('#zipCode').removeAttr("disabled");
                $('#zipCode').val(components.postal_code);
                $('#zipCode').attr("disabled", "disabled");
                
            }
            //$('input[name="postal_code"]').val(components.postal_code); //inserting value in postal code
            $('input[name="city"]').val(components.locality); //inserting value in city
            

            //inserting value in province
            var select = document.getElementById("province");
            var option;
            for (var i = 0; i < select.options.length; i++) {
                option = select.options[i];
                if (option.text == components.administrative_area_level_1) {
                    option.setAttribute("selected", true);
                    // For a single select, the job's done
                    break;
                }
            }

            //inserting value in latitude and longitude
            $("#latitude").val(place.geometry["location"].lat());
            $("#longitude").val(place.geometry["location"].lng());
        });
    }
}

// Create the map and intialize it with data
function initMap() {
    const route = $('#map').data('route');
    const member_location = $('#map').data('member_location');

    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 3,
        center: { lat: 56.130367, lng: -106.346771 },
    });

    let locations = [];
    let markers = [];

    // Get all the provider offices and display markers for it
    getAllProviders(route).then(function(data) {
        locations = data;
        //console.log(locations);
        // Load the locations GeoJSON onto the map
        map.data.addGeoJson(locations);
        const infoWindow = new google.maps.InfoWindow();

        // Show the information for a store when its marker is clicked, zoom in and center the map at the marker
        map.data.addListener('click', (event) => {
            const name = event.feature.getProperty('name');
            const address = event.feature.getProperty('address');
            const email = event.feature.getProperty('email');
            const telephone = event.feature.getProperty('telephone');
            const position = event.feature.getGeometry().get();
            const content = `<h4>${name}</h4><p><strong>Address:</strong> ${address}</p>
        <p><strong>Email:</strong> ${email}<br/><strong>Telephone:</strong> ${telephone}</p>`;

            infoWindow.setContent(content);
            infoWindow.setPosition(position);
            infoWindow.setOptions({ pixelOffset: new google.maps.Size(0, -30) });
            infoWindow.open(map);

            // Zoom in if not already zoomed in
            if (map.getZoom() < 10) {
                map.setZoom(10);
            }
            map.setCenter(position);
        });

        // Add locations to side panel
        $('.search-providers-wrapper').html('');
        map.data.forEach((location) => {
            $('.search-providers-wrapper').append(
                '<div class="sr-modal-location-wrap"><h5 class="heading"><span>' +
                location.getProperty('name') +
                '</span></h5><div class="add-row d-flex flex-wrap justify-content-between"><p><strong>Address:</strong> ' +
                location.getProperty('address') +
                '</p></div><div class="bottom-button-wrap d-flex flex-wrap align-items-center float-right"><span id="select-map-location" class="select-map-location">Select This Location<i class="fas fa-arrow-right"></i></span><input type="hidden" name="storeid" value="' +
                location.getProperty('storeid') +
                '"/></div></div>'
            );
        });

        const all_providers = {};

        // Build object for the data features and markers
        map.data.forEach((provider) => {
            const id = provider.getProperty('storeid');
            const position = provider.getGeometry().get();
            const name = provider.getProperty('name');
            const address = provider.getProperty('address');
            const email = provider.getProperty('email');
            const phone = provider.getProperty('telephone');

            all_providers[id] = {
                name: name,
                address: address,
                email: email,
                telephone: phone,
                position: position,
            };

            // Build list of all markers to hide and display based on radius
            marker = new google.maps.Marker({
                id: id,
                position: position,
                map: map,
            });

            // Add click event for markers
            marker.addListener('click', (event) => {
                const content = `<h4>${name}</h4><p><strong>Address:</strong> ${address}</p>
          <p><strong>Email:</strong> ${email}<br/><strong>Telephone:</strong> ${phone}</p>`;

                infoWindow.setContent(content);
                infoWindow.setPosition(position);
                infoWindow.setOptions({ pixelOffset: new google.maps.Size(0, -30) });
                infoWindow.open(map);

                // Zoom in if not already zoomed in
                if (map.getZoom() < 10) {
                    map.setZoom(10);
                }
                map.setCenter(position);
            });

            markers[id] = marker;
        });

        // on clicking 'select this location' link go to be pin in the map and open the info window
        $(document).on('click', '#select-map-location', function() {
            const store_id = $(this).parent().find('input[type=hidden][name=storeid]').val();
            const position = all_providers[store_id].position;
            const content = `<h4>${all_providers[store_id].name}</h4><p><strong>Address:</strong> ${all_providers[store_id].address}</p>
        <p><strong>Email:</strong> ${all_providers[store_id].email}<br/><strong>Telephone:</strong> ${all_providers[store_id].telephone}</p>`;

            // open info window with location details
            infoWindow.setContent(content);
            infoWindow.setPosition(position);
            infoWindow.setOptions({ pixelOffset: new google.maps.Size(0, -30) });
            infoWindow.open(map);

            // Zoom in if not already zoomed in
            if (map.getZoom() < 12) {
                map.setZoom(12);
            }
            map.setCenter(position);
        });

        // check if location service is turned on in the browser
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                    const currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    searchAndDisplayProviders(map, currentLocation, markers);
                },
                (error) => {
                    $('.search-provider-location-wrap').prepend('<label class="provider-search-error">' + error.message + ' <span class="provider-search-error-close"><i class="far fa-times-circle"></i></span></label>');

                    // check if member is logged in to get the member location
                    if (member_location && member_location.latitude && member_location.longitude) {
                        currentLocation = new google.maps.LatLng(member_location.latitude, member_location.longitude);
                        searchAndDisplayProviders(map, currentLocation, markers);
                    }
                });
        }
    }).catch(function(error) {
        $('.search-providers-wrapper').html('<label class="provider-search-error">' + error + ' <span class="provider-search-error-close"><i class="far fa-times-circle"></i></span></label>');
    });

    // create and display an input field for auto complete search
    const input = document.createElement('input');
    const options = {
        types: ['address'],
        componentRestrictions: { country: 'ca' },
        fields: ['address_components', 'geometry', 'name'],
    };

    input.setAttribute('id', 'pac-input');
    input.setAttribute('type', 'text');
    input.setAttribute('placeholder', 'Enter an address');
    input.setAttribute('class', 'form-control');
    $('#search-provider-location-input').append(input);

    const autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.bindTo("bounds", map);

    // Set the origin point when the user selects an address
    const originMarker = new google.maps.Marker({ map: map });
    originMarker.setVisible(false);
    let originLocation = map.getCenter();

    autocomplete.addListener('place_changed', async () => {
        originMarker.setVisible(false);
        originLocation = map.getCenter();
        const place = autocomplete.getPlace();

        // User entered an incorrect place name
        if (!place.geometry) {
            $('.search-providers-wrapper').html('<label class="provider-search-error">No address available for input: \'' + place.name + '\' <span class="provider-search-error-close"><i class="far fa-times-circle"></i></span></label>');
            return;
        }

        // Recenter the map to the selected address
        originLocation = place.geometry.location;
        originMarker.setPosition(originLocation);
        originMarker.setVisible(false);

        // Display all markers
        map.data.forEach(location => {
            id = location.getProperty('storeid');
            markers[id].setMap(map);
        });

        searchAndDisplayProviders(map, originLocation, markers);
        return;
    });
}

// return FeatureCollection GeoJSON object back with all providers
function getAllProviders(route) {
    let features = [];

    return new Promise(function(resolve, reject) {
        $.ajax({
            url: route,
            type: "GET",
            data: {
                _token: $("#token").val(),
            },
            success: function(response) {
                if (response.length < 1) {
                    reject("No providers");
                }

                for (let i = 0; i < response.length; i++) {
                    features.push({
                        type: 'Feature',
                        properties: {
                            storeid: response[i].id,
                            name: response[i].clinic_name,
                            address: response[i].address1 + ", " + response[i].address2 + " - " + response[i].postal_code,
                            email: response[i].email,
                            telephone: response[i].telephone,
                        },
                        geometry: {
                            type: 'Point',
                            coordinates: [Number(response[i].longitude), Number(response[i].latitude)],
                        },
                    });
                }

                const locations = {
                    type: 'FeatureCollection',
                    features: features,
                }
                resolve(locations);
                
            },
            error: function(error) {
                reject(error);
            },
        });
    });
}

// Remove the error when clicking close icon
$(document).on('click', '.provider-search-error-close', function() {
    $(this).parent().remove();
});

// Google API to calculate the distance between origin and destinations
async function calculateDistances(data, origin) {
    const stores = [];
    const destinations = [];
    const radius = parseFloat($('#map').data('search_radius')) * 1000;

    // Build parallel arrays for the store IDs and destinations
    data.forEach((store) => {
        
        const storeNum = store.getProperty('storeid');
        const storeLoc = store.getGeometry().get();
        stores.push(storeNum);
        destinations.push(storeLoc);
    });

    try {
        // Retrieve the distances of each store from the origin
        // The returned list will be in the same order as the destinations list
        const service = new google.maps.DistanceMatrixService();
        const getDistanceMatrix =
            (service, parameters) => new Promise((resolve, reject) => {
                service.getDistanceMatrix(parameters, (response, status) => {
                    if (status != google.maps.DistanceMatrixStatus.OK) {
                        reject(response);
                       // console.log(response);
                    } else {
                        const distances = [];
                        const results = response.rows[0].elements;
                        for (let j = 0; j < results.length; j++) {
                            if (results[j].status != google.maps.DistanceMatrixStatus.OK) {
                                continue;
                            }
                            const element = results[j].distance;

                            // dont add stores beyond a radius
                            if (!isNaN(radius) && element.value > radius) {
                                continue;
                            }

                            const distanceObject = {
                                storeid: stores[j],
                                distanceText: element.text,
                                distanceVal: element.value,
                            };
                            distances.push(distanceObject);
                        }

                        resolve(distances);
                        //console.log(distances);
                    }
                });
            });

        const distancesList = await getDistanceMatrix(service, {
            origins: [origin],
            destinations: destinations,
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC,
        });

        distancesList.sort((first, second) => {
            return first.distanceVal - second.distanceVal;
        });

        return distancesList;
    } catch (e) {
        throw new Error("Searching for providers returned error."+ e);
    }
}

// Display list of providers with their distance
function showStoresList(data, stores) {
    // console.log(data,stores);
    if (stores.length == 0) {
        const radius = parseFloat($('#map').data('search_radius'));
        let html = 'No providers to be displayed';
        if (radius > 0) {
            html += ' within ' + radius + 'km';
        }
        $('.search-providers-wrapper').html('<label class="provider-search-error">' + html + '. <span class="provider-search-error-close"><i class="far fa-times-circle"></i></span></label>');
        return;
    }

    const all_providers = {};

    // Build object for the name and address
    data.forEach((provider) => {
        all_providers[provider.getProperty('storeid')] = {
            storeName: provider.getProperty('name'),
            address: provider.getProperty('address'),
        };
    });

    const panel = $('.search-providers-wrapper');

    // Clear the previous details
    panel.html('');

    stores.forEach((store) => {
        const store_id = store.storeid;

        panel.append(
            '<div class="sr-modal-location-wrap"><h5 class="heading"><span>' +
            all_providers[store_id].storeName +
            '</span></h5><div class="add-row d-flex flex-wrap justify-content-between"><p><strong>Address:</strong> ' +
            all_providers[store_id].address +
            '<br/><strong>Distance:</strong> ' +
            store.distanceText +
            '</p></div><div class="bottom-button-wrap d-flex flex-wrap align-items-center float-right"><span id="select-map-location" class="select-map-location">Select This Location<i class="fas fa-arrow-right"></i></span><input type="hidden" name="storeid" value="' +
            store_id +
            '"/></div></div>'
        );
    });

    return;
}

// Search and display providers based on a location - latitude and longitude
function searchAndDisplayProviders(map, originLocation, markers) {
    // center and zoom the map if not already zoomed in
    map.setCenter(originLocation);
    if (map.getZoom() < 10) {
        map.setZoom(10);
    }

    // Hide all pins
    map.data.setStyle({
        visible: false,
    });

    // Use the selected address as the origin to calculate distances to each of the provider locations
    calculateDistances(map.data, originLocation).then(rankedLocations => {
        let visibleStoresIds = [];

        // Generate list of pins to be displayed
        rankedLocations.forEach(location => {
            visibleStoresIds.push(location.storeid);
        });

        // Hide pins beyond the search radius
        map.data.forEach(location => {
            id = location.getProperty('storeid');
            if (!visibleStoresIds.includes(id)) {
                markers[id].setMap(null);
            }
        });

        // Show the list of providers in the side panel
        showStoresList(map.data, rankedLocations);
    }).catch(e => {
        $('.search-provider-location-wrap').prepend('<label class="provider-search-error">' + e + ' <span class="provider-search-error-close"><i class="far fa-times-circle"></i></span></label>');
    });
}

$('.what-we-do .view-more').on('click', function() {
    const more_services = $(this).parent().find('.more-services');

    if (more_services.is(":visible") == true) {
        more_services.hide();
        $(this).html('View More');
    } else {
        more_services.show();
        $(this).html('View Less');
    }
});