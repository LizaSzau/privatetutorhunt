/*function initMap() {
	var options = {     
		zoom: 10,
		center: { lat: 33.933241, lng: -84.340288 }
	}
	var map = new google.maps.Map(document.getElementById('map'), options)
	var marker = new google.maps.Marker({
		position: { lat: 33.933241, lng: -84.340288 },
		map: map
	})
}
*/


function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: { lat: 47.489146, lng: 19.078638 },
  });
  const geocoder = new google.maps.Geocoder();
  const infowindow = new google.maps.InfoWindow();
  document.getElementById("submit").addEventListener("click", () => {
    geocodeLatLng(geocoder, map, infowindow);
  });
}

function geocodeLatLng(geocoder, map, infowindow) {
  const input = document.getElementById("latlng").value;
  const latlngStr = input.split(",", 2);
  const latlng = {
    lat: parseFloat(latlngStr[0]),
    lng: parseFloat(latlngStr[1]),
  };
  geocoder.geocode({ location: latlng }, (results, status) => {
    if (status === "OK") {
		console.log(results)
      if (results[0]) {
        map.setZoom(11);
        const marker = new google.maps.Marker({
          position: latlng,
          map: map,
        });
        infowindow.setContent(results[0].formatted_address);
        infowindow.open(map, marker);
      } else {
        window.alert("No results found");
      }
    } else {
      window.alert("Geocoder failed due to: " + status);
    }
  });
}
/*
function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: { lat: -34.397, lng: 150.644 },
  });
  const geocoder = new google.maps.Geocoder();
  document.getElementById("submit").addEventListener("click", () => {
    geocodeAddress(geocoder, map);
  });
}
*/

//0 5 6 7 10
function geocodeAddress(geocoder, resultsMap) {
  const address = document.getElementById("address").value;
  geocoder.geocode({ address: address }, (results, status) => {
    if (status === "OK") {
      resultsMap.setCenter(results[0].geometry.location);
      new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location,
      });
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });
}

(function(document, tag)	{
	var scriptTag = document.createElement(tag), 
		firstScriptTag = document.getElementsByTagName(tag)[0]
		scriptTag.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDvGPAy77REoDVDsTWdIwrjuw2jkS9HiCY&callback=initMap'
		firstScriptTag.parentNode.insertBefore(scriptTag, firstScriptTag);
}(document, 'script'))