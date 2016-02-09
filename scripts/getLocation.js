$(document).ready(function() {
    if ("geolocation" in navigator) {
  		/* geolocation is available */
  		navigator.geolocation.getCurrentPosition(function(position) {
            //disable submit button while waiting to get location
            $(".submit").prop("disabled",true);
  			var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            //TODO need to update this logic. Only works when a zip code it found

            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true";
            var latLngString = lat+","+lng;
            $("#latlng").val(latLngString);
            var address = $.ajax(url)
            //call google maps to try and get the city name
            //logic should look first for zip code
            //if no zip code is found, then search for something else
            //possibly sublocatily something
            .done(function(data){
               var locationArray = data.results;
               var foundLocation = false;
               for (i = 0;i < locationArray.length; i++) {
                    if (!(locationArray[i].types.indexOf("postal_code")<0)) {
                        fillLocation(locationArray[i].formatted_address);
                        $('.hideWhenLocated').hide(500);
                        $(".submit").prop("disabled",false);
                        foundLocation = true;
                        break;
                    }
                }
                //if postal_code type not found, look for administrative_area_level_2
                if(foundLocation==false){
                    for (i = 0;i < locationArray.length; i++) {
                        if (!(locationArray[i].types.indexOf("administrative_area_level_2")<0)) {
                            fillLocation(locationArray[i].formatted_address);
                            $('.hideWhenLocated').hide(500);
                            $(".submit").prop("disabled",false);
                            foundLocation = true;
                            break;
                        }
                    }
                }
            })
            .fail(function(){
                $(".submit").prop("disabled",false);
            });
		});
	}

	function fillLocation(location) {
		$("#location").val(location);
	}
    setTimeout(function(){
            $(".submit").prop("disabled",false);
        }, 15000)
});
