var styles = [
  'Road',
  'RoadOnDemand',
  'Aerial',
  'AerialWithLabels',
  'CanvasDark',
  'ordnanceSurvey'
];
var layers = [];
var i, ii;
for (i = 0, ii = styles.length; i < ii; ++i) {
  layers.push(new ol.layer.Tile({
    visible: false,
    preload: Infinity,
    source: new ol.source.BingMaps({
      key: 'ArB45ZSPfo0CKuOPsoLf4baEDVkigy-6VQyabPc2jGJmT2ZvpeTJJb6fia2hj3Ux',
      imagerySet: styles[i],
      // use maxZoom 19 to see stretched tiles instead of the BingMaps
      // "no photos at this zoom level" tiles
      maxZoom: 19
    })
  }));
}
var map = new ol.Map({
  layers: layers,
  // Improve user experience by loading tiles while dragging/zooming. Will make
  // zooming choppy on mobile or slow devices.
  loadTilesWhileInteracting: true,
  target: 'map',
  view: new ol.View({
    center: ol.proj.fromLonLat([103.7338868, 21.2842912]),
    zoom: 9
  })
});

var select = document.getElementById('layer-select');
function onChange() {
  var style = select.value;
  for (var i = 0, ii = layers.length; i < ii; ++i) {
    layers[i].setVisible(styles[i] === style);
  }
}
select.addEventListener('change', onChange);
onChange();

