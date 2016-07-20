// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};



var valuesinform={
    street_number: 'Customer_address_line_1',
    route: 'Customer_address_line_2',
    locality: 'Customer_town',
    administrative_area_level_1: null,
    country: 'Customer_country',
    postal_code: 'Customer_postcode'
}

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    if (document.getElementById('autocomplete'))
    {    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
    }
}

// [START region_fillform]
function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();


    for (var component in componentForm) {

        if (valuesinform[component]) {
            document.getElementById(valuesinform[component]).value = '';
            document.getElementById(valuesinform[component]).disabled = false;
        }


    }


    // Get each component of the address from the place details
    // and fill the corresponding field on the form.

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType]) {

            //console.log(addressType);
            var val = place.address_components[i][componentForm[addressType]];
            ///document.getElementById(addressType).value = val;

            //console.log('ID VALUE IN FORM'+valuesinform[addressType])
            if (valuesinform[addressType])
                document.getElementById(valuesinform[addressType]).value = val;
        }
    }


}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}
// [END region_geolocation]

//Disable return Key from Submitting the form
function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;