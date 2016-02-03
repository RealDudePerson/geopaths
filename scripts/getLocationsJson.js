var tokenPathArrayGlobal;
$(document).ready(function() {
    //get H2 from page becuase the h1 will always be the token name
    var tokenName = $("h2").text();
    var getLocationNamesUrl = "../functions.php?getTokenLocations=true&tokenName="+tokenName;
    $.ajax({
        dataType: "json",
        url: getLocationNamesUrl,
        success: function(data){
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
}

function buildCoordsObject(dataJson){
    var tokenPathArray = [];
    var locations = dataJson.locations;
    for(var i = 0;i < locations.length; i++){
        var mapCoords = new Object();
        var coordArray = locations[i][1].split(",");
        mapCoords.lat = parseFloat(coordArray[0]);
        mapCoords.lng = parseFloat(coordArray[1]);
        tokenPathArray.push(mapCoords);
    }
    tokenPathArrayGlobal = tokenPathArray;
}

$(document).ajaxStop(function(){
    initMap(tokenPathArrayGlobal);
})
