$(document).ready(function() {
    if ("geolocation" in navigator) {
  		/* geolocation is available */
  		navigator.geolocation.getCurrentPosition(function(position) {
  			fillLocation(position.coords.latitude, position.coords.longitude);
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