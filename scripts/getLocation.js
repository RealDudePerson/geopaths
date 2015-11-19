$(document).ready(function() {
    if ("geolocation" in navigator) {
  		/* geolocation is available */
  		navigator.geolocation.getCurrentPosition(function(position) {
  			var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true";
            var address = $.ajax(url)
            .done(function(data){
               alert("success");
               alert(data.results[1].formatted_address);
            })
            .fail(function(){
                alert("fail");
            });
            //alert(address.results[1].formatted_address);
		});
	} 
	else {
  		/* geolocation IS NOT available */
  		
	}
	
	function fillLocation(lat, lon) {
		var output = lat + "," + lon;
		$("#location").val(output);
	}
});