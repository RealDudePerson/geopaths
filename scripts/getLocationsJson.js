function initMap(o) {
    console.log(o)
    var mymap = L.map('map');
    mymap.setView([o[0].lat, o[0].lng], 13); /*sets the map center to the first find*/
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiZGFuZ2VyZGFuIiwiYSI6ImNqa3I0N3lqMjFveWozdm96Y2J1N3Z4NDgifQ.V5_TRydwQnbAhJsnV4JYVg'
    }).addTo(mymap);
    latlngarray = [];
    o.forEach(function(cordsObject){
        console.log("Coords Object in the for loop in initMap")
        console.log(cordsObject)
        latlng = [cordsObject.lat, cordsObject.lng]
        latlngarray.push(latlng)
        tmpMarker = L.marker(latlng,{
            title: cordsObject.name
        });
        popUpData = "<p>" + cordsObject.name + "</p>"
        if(cordsObject.comment){
            popUpData += "<p>" + cordsObject.comment + "</p>"
        }
        tmpMarker.bindPopup(popUpData).openPopup();
        tmpMarker.addTo(mymap)
    })
    var polyline = L.polyline(latlngarray, {color: 'blue'}).addTo(mymap);
    // zoom the map to the polyline
    mymap.fitBounds(polyline.getBounds());
}

var tokenPathArrayGlobal, jsonGlobal, markerArrayGlobal = [],
    mapGlobal;


function buildCoordsObject(o) {
    console.log("o Object from builDcoordsObject function:")
    console.log(o)
    for (var a = [], t = o.locations, e = 0; e < t.length; e++) {
        var n = new Object,
            l = t[e][0].split(",");
        n.lat = parseFloat(l[0]);
        n.lng = parseFloat(l[1]);
        n.name = t[e][2];
        n.comment = t[e][3];
        //console.log("t[e] inside buildcoordsobject")
        //console.log(t[e])
        a.push(n)
    }
    tokenPathArrayGlobal = a
    
    console.log("tokenPathArrayGlobal Object from builDcoordsObject function:")
    console.log(tokenPathArrayGlobal)
}

// Main entry point

$(document).ready(function () {
    //get the json data from php
    var o = $("h2").text(),
        a = "../functions.php?getTokenLocations=true&tokenName=" + o;
    $.ajax({
        dataType: "json",
        url: a,
        success: function (o) {
            jsonGlobal = o, buildCoordsObject(o)
        }
    })
    //console.log(tokenPathArrayGlobal)
//once ajax is finished gathering data build the map
}), $(document).ajaxStop(function () {
    initMap(tokenPathArrayGlobal)
});
