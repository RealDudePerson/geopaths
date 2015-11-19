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
               fillLocation(data.results[1].formatted_address);
            })
            .fail(function(){
                alert("fail");
            });
		});
	} 
	else {
  		
	}
	
	function fillLocation(location) {
		$("#location").val(location);
	}
});