var map = L.map('map').setView([21.529737201190642, 103.9581298828125], 8);
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