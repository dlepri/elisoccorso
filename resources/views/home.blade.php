@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                    @endif
                    <div id="map" class="map">
                      <div id="popup" class="ol-popup" style="display:none">
                        <a href="javascript:;" id="popup-closer" class="ol-popup-closer"></a>
                        <div id="popup-content"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>
<script src="https://unpkg.com/ol-layerswitcher@3.0.0"></script>
<link rel="stylesheet" href="https://unpkg.com/ol-layerswitcher@3.0.0/src/ol-layerswitcher.css" />
<script>
      $.ajax({
        type: "POST",
        url: "{{route('api.pois')}}",
        success: function(response) {
          $('#popup').show();

          var container = document.getElementById('popup');
          var content = document.getElementById('popup-content');
          var closer = document.getElementById('popup-closer');


          /**
           * Create an overlay to anchor the popup to the map.
           */
          var overlay = new ol.Overlay({
            element: container,
            autoPan: true,
            autoPanAnimation: {
              duration: 250
            }
          });
          closer.onclick = function() {
            overlay.setPosition(undefined);
            closer.blur();
            return false;
          };
          var hospitals = [];
          var pitches = [];
          var secondaries = [];
          var centerpoint;
          $.each(response.hospitals, function(index, value) {
            var hospital = new ol.Feature({
              geometry: new ol.geom.Point(ol.proj.fromLonLat([parseFloat(value.longitude), parseFloat(value.latitude)])),
              details: value,
              type: 'hospital'
            });
            hospital.setStyle(new ol.style.Style({
              image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                color: '#e2001a',
                crossOrigin: 'anonymous',
                src: 'https://openlayers.org/en/v4.6.5/examples/data/dot.png'
              }))
            }));
            hospitals.push(hospital);
            centerpoint = [parseFloat(value.longitude), parseFloat(value.latitude)];
          });
          $.each(response.pitches, function(index, value) {
            var pitch = new ol.Feature({
              geometry: new ol.geom.Point(ol.proj.fromLonLat([parseFloat(value.longitude), parseFloat(value.latitude)])),
              details: value,
              type: 'pitch'
            });
            pitch.setStyle(new ol.style.Style({
              image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                color: '#0000FF',
                crossOrigin: 'anonymous',
                src: 'https://openlayers.org/en/v4.6.5/examples/data/dot.png'
              }))
            }));
            pitches.push(pitch);
            centerpoint = [parseFloat(value.longitude), parseFloat(value.latitude)];
          });

          $.each(response.secondaries, function(index, value) {
            var secondary = new ol.Feature({
              geometry: new ol.geom.Point(ol.proj.fromLonLat([parseFloat(value.longitude), parseFloat(value.latitude)])),
              details: value,
              type: 'secondary'
            });
            secondary.setStyle(new ol.style.Style({
              image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                color: '#008000',
                crossOrigin: 'anonymous',
                src: 'https://openlayers.org/en/v4.6.5/examples/data/dot.png'
              }))
            }));
            secondaries.push(secondary);
          });
          var hospitalsLayer = new ol.layer.Vector({
            title: '<span class="hospital">Ospedali</span>',
            source: new ol.source.Vector({
              features: hospitals
            })
          });
          var pitchesLayer = new ol.layer.Vector({
            title: '<span class="pitch">Piazzole</span>',
            source: new ol.source.Vector({
              features: pitches
            })
          });
          var secondariesLayer = new ol.layer.Vector({
            title: '<span class="secondary">Altro</span>',
            source: new ol.source.Vector({
              features: secondaries
            })
          });
          var map = new ol.Map({
            target: 'map',
            layers: [ 
              new ol.layer.Tile({
                source: new ol.source.OSM()
              }),
              new ol.layer.Group({
                title: 'Visualizza',
                layers: [
                  secondariesLayer,
                  pitchesLayer,
                  hospitalsLayer, 
                ]
              })
            ],
            overlays: [overlay],
            view: new ol.View({
              center: ol.proj.fromLonLat(centerpoint),
              zoom: 8
            })
          });
          var layerSwitcher = new ol.control.LayerSwitcher({
            tipLabel: 'Legenda'
          });
          map.addControl(layerSwitcher);

          var select = new ol.interaction.Select();
          map.addInteraction(select);
          map.on('singleclick', function(evt) {
            var feature = map.forEachFeatureAtPixel(evt.pixel,
            function(feature, layer) {
              return feature;
            });
            if (feature) {
              var properties = feature.getProperties();
              var geometry = feature.getGeometry();
              var coordinate = geometry.getCoordinates();
              console.log(properties.details.popover);
              content.innerHTML = properties.details.popover;
              overlay.setPosition(coordinate);
            }
          });
        }
      });
    </script>
@endsection
