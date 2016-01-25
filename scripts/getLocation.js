$(document).ready(function() {
    if ("geolocation" in navigator) {
  		/* geolocation is available */
        $(".submit").prop("disabled",true);
  		navigator.geolocation.getCurrentPosition(function(position) {
  			var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true";
            var address = $.ajax(url)
            .done(function(data){
               //fillLocation(data.results[1].formatted_address);
               var locationArray = data.results;
               for (i = 0;i < locationArray.length; i++) {
                    if (!(locationArray[i].types.indexOf("postal_code")<0)) {
                        fillLocation(locationArray[i].formatted_address);
                        $('.hideWhenLocated').hide(500);
                        $(".submit").prop("disabled",false);
                        break;
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
});