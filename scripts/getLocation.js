$(document).ready(function() {
    if ("geolocation" in navigator) {
  		/* geolocation is available */
  		navigator.geolocation.getCurrentPosition(function(position) {
  			var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true";
            var address = $.ajax(url)
            .done(function(data){
               fillLocation(data.results[1].formatted_address);
               $('.hideWhenLocated').hide(500);
            })
            .fail(function(){
                alert("Failed to get an accurate location, you can fill it out manually if you with or leave it as 'N/a'");
                //$('#location').removeClass('hidden');
                //$('#locationLabel').removeClass('hidden');
            });
		});
	}
	
	function fillLocation(location) {
		$("#location").val(location);
	}
});