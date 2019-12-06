$(document).ready(function() {
  initMap(null);

  load_items_on_maps().then(function(data) {
    if(data) {
      var len = data.length;
      for (var i = 0; i < len; ++i) {
        var Name = data[i].Name;
        var Tag = data[i].Tag;
        var Price = data[i].Price;
        var Description = data[i].Description;
        var GPS = data[i].GPS;
        var Latitude = data[i].Latitude;
        var Longitude = data[i].Longitude;
        var PostTime = data[i].PostTime;
        var Address = data[i].Address;
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

  if(data) {
    var len = data.length;
    for (var i = 0; i < len; ++i) {
      var name = data[i].Name;
      var lat = data[i].Latitude;
      var lon = data[i].Longitute;
      if (lat && lon) {
        setmarkers(lat, lon, map);

      }
    }
  }
}



function setmarkers(name, lat, lon, map) {

  var marker = new google.maps.Marker({
    position:{lat:lat,lng:lon},
    map:map
  });
  var InfoWindow = new google.maps.InfoWindow({
    content:'<h4>' + name + '</h4>'
  });

  marker.addEventListener('click', function () {
    InfoWindow.open(map, marker)
  })

}

