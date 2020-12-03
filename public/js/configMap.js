var map = L.map('map').setView([21.529737201190642, 103.9581298828125], 8.5);
var layer = L.esri.basemapLayer('Imagery').addTo(map);
L.esri.basemapLayer('ImageryLabels').addTo(map);
var layerLabels;

function setBasemap (basemap) {
  if (layer) {
    map.removeLayer(layer);
  }

  layer = L.esri.basemapLayer(basemap);

  map.addLayer(layer);

  if (layerLabels) {
    map.removeLayer(layerLabels);
  }

  if (
    basemap === 'ShadedRelief' ||
    basemap === 'Oceans' ||
    basemap === 'Gray' ||
    basemap === 'DarkGray' ||
    basemap === 'Terrain'
  ) {
    layerLabels = L.esri.basemapLayer(basemap + 'Labels');
    map.addLayer(layerLabels);
  } else if (basemap.includes('Imagery')) {
    layerLabels = L.esri.basemapLayer('ImageryLabels');
    map.addLayer(layerLabels);
  }
}

document.querySelector('#layer-select').addEventListener('change', function (e) {
  var basemap = e.target.value;
  setBasemap(basemap);
});

// Focus marker when click on panel
function setFocusByPosition(lat, long){
  return map.setView([lat, long], 13); 
}

var locations = JSON.parse(document.getElementById('locationJson').value);
var smallIcon = new L.Icon({
  iconUrl: window.location.origin+'/public/images/icon/dams-icon.png',
  iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-icon-2x.png',
  iconSize:    [25, 25],
  iconAnchor:  [12, 41],
  popupAnchor: [1, -34],
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  shadowSize:  [41, 41]
});

var myLayer = L.geoJson(locations, {
  pointToLayer: function(feature, latlng) {
    console.log(latlng, feature);
    return L.marker(latlng, {
      icon: smallIcon
    });
  }
}).addTo(map);