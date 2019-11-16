$(document).ready(function() {
  initMap(null);

  load_items_on_maps().then(function(data) {
    if(data) {
      var len = data.length;
      for (var i = 0; i < len; ++i) {
        var name = data[i].Name;
        var tag = data[i].Tag;
        var price = data[i].Price;
        var description = data[i].Description;
        var gps = data[i].GPS;
        var latitude = data[i].Latitude;
        var longitude = data[i].Longitude;
        var postTime = data[i].PostTime;
        var address = data[i].Address;
      }

      initMap(data);
    }
  });
});


function load_items_on_maps() {
  return new Promise (function(resolve) {
    $.ajax({
      type: "POST",
      url: "Map.php",
      dataType: "JSON",
      data: {
        flag: 3
      },
      complete: function (data) {
        resolve(data);
      }
    });
  });
}

// For user's current location
function initMap(data) {

  var m = document.getElementById('map');

  //add map options
  var options = {
    zoom:11,
    center:{lat:44.565214,lng:-123.275675}
  };

  //add map
  var map = new google.maps.Map(m,options);


  // add marker on current location
  var marker = new google.maps.Marker({
    position:{lat:44.565214,lng:-123.275675},
    map:map
  });


  var circle = new google.maps.Circle({
    map: map,
    radius: 8047,    // 5 miles in meters
    fillColor: '#80807d'
  });
  circle.bindTo('center', marker, 'position');

  if (data) {
    var len = data.length;
    var c = 0;
    for (var i = 0; i < len; ++i) {
      var lat = data[i].Latitude;
      var lon = data[i].Longitude;
      if (lat && lon) {
        c += 1;
        console.log(c);
        setmarkers(lat, lon, map);
      }
    }

  }
}

function setmarkers(lat, lon, map) {

  var marker = new google.maps.Marker({
    position:{lat:lat,lng:lon},
    map:map
  });

}
