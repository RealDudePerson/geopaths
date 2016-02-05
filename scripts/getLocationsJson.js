var tokenPathArrayGlobal;
var jsonGlobal;
var markerArrayGlobal = [];
//TODO UPDATE MAKRERON VARIABLE TO MAKE SENSE
var markerOn = false;
var mapGlobal;
$(document).ready(function() {
    //get H2 from page becuase the h1 will always be the token name
    var tokenName = $("h2").text();
    var getLocationNamesUrl = "../functions.php?getTokenLocations=true&tokenName="+tokenName;
    $.ajax({
        dataType: "json",
        url: getLocationNamesUrl,
        success: function(data){
            jsonGlobal = data;
            buildCoordsObject(data);
        },
    });
});

function initMap(tokenPathArray) {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: tokenPathArray[0],
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });

  var tokenPath = new google.maps.Polyline({
    path: tokenPathArray,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  tokenPath.setMap(map);
  mapGlobal = map;
  toggleMapMarkers();
}

function buildCoordsObject(dataJson){
    var tokenPathArray = [];
    var locations = dataJson.locations;
    for(var i = 0;i < locations.length; i++){
        var mapCoords = new Object();
        var coordArray = locations[i][0].split(",");
        mapCoords.lat = parseFloat(coordArray[0]);
        mapCoords.lng = parseFloat(coordArray[1]);
        tokenPathArray.push(mapCoords);
    }
    tokenPathArrayGlobal = tokenPathArray;
}

$(document).ajaxStop(function(){
    initMap(tokenPathArrayGlobal);
})

function toggleMapMarkers(){
    if(markerOn){

    }else{
        var locations = jsonGlobal.locations;
        for(var i = 0; i < tokenPathArrayGlobal.length; i++){
            var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">'+locations[i][2]+'</h1>'+
      '<div id="bodyContent">'+
      '<p>'+locations[i][3]+'</p>'+
      '<p>Found on: '+locations[i][1]+'</p>'+
      '</div>'+
      '</div>';

            var marker = new google.maps.Marker({
                position: tokenPathArrayGlobal[i],
                map: mapGlobal,
                title: locations[i][2],
                html: contentString
            });
            var infowindow = new google.maps.InfoWindow();
            marker.addListener('click', function() {
                infowindow.setContent(this.html)
                infowindow.open(mapGlobal, this);
            });
            markerArrayGlobal.push(marker);
            AutoCenter();
        }
    }
}

function AutoCenter() {
	//  Create a new viewpoint bound
	var bounds = new google.maps.LatLngBounds();
	//  Go through each...
    /*
	$.each(markers, function (index, marker) {
	       bounds.extend(marker.position);
	});
    */
    for(var i=0;i<markerArrayGlobal.length;i++){
        	bounds.extend(markerArrayGlobal[i].position);
    }
	//  Fit these bounds to the map
	mapGlobal.fitBounds(bounds);
}
