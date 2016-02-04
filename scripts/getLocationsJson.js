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


/*
Here is a sample of the json data
{
    "locations": [

    [

    "33.2164873,-117.2879407",
    "1-25-2016 09:39:41",
    "wut"

    ],
    [

        "33.2164873,-117.2879407",
        "1-26-2016 08:22:52",
        "Daniel"

    ],
    [

        "33.2164873,-117.2879407",
        "1-26-2016 17:31:31",
        "ggggg"

    ],
    [

        "33.2164474,-117.2878843",
        "2-3-2016 14:46:07",
        "personx"

    ],
    [

        "31.7081,-98.9825",
        "1-30-2016 14:23:22",
        "Person"

    ],
    [

        "33.2164444,-117.2879561",
        "2-4-2016 07:11:59",
        "Hi"

    ],

        [
            "33.2164444,-117.2879561",
            "2-4-2016 07:14:49",
            "test"
        ]

    ]
]
}
*/

function toggleMapMarkers(){
    if(markerOn){

    }else{
        var locations = jsonGlobal.locations;
        for(var i = 0; i < tokenPathArrayGlobal.length; i++){
            var marker = new google.maps.Marker({
                position: tokenPathArrayGlobal[i],
                map: mapGlobal,
                title: i.toString()
            });

            markerArrayGlobal.push(marker);
        }
    }
}
