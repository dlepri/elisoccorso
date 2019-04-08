@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <span class="h2"><i class="fas fa-edit"></i> <strong>MODIFICA PUNTO</strong></span>
                    <form id="delete-form" method="POST" action="{{route('secondaries.destroy', $secondary->id)}}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="javascript:;" onclick="javascript: deleteItem(event)" class="btn btn-danger float-right"><i class="fas fa-trash-alt"></i> ELIMINA</a>
                    <a href="{{route('secondaries.index')}}" class="btn btn-primary float-left"><i class="fas fa-arrow-left"></i> INDIETRO</a>
                </div>
                <div class="card-body">
                    {!! laraflash()->render() !!}
                    <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" action="{{route('secondaries.update', $secondary->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name" value="{{old('name', $secondary->name)}}" name="name">
                                @includeWhen($errors->has('name'), 'components.error', ['error' => $errors->first('name')])
                            </div>
                           
                            <div class="col">
                                <label for="image">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @if ($errors->has('icon')) is-invalid @endif" id="image" name="image">
                                    <label class="custom-file-label" for="image"></label>
                                    @includeWhen($errors->has('image'), 'components.error', ['error' => $errors->first('image')])
                                  </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                             <div class="col">
                                <label for="description">Descrizione</label>
                                <input type="text" class="form-control @if ($errors->has('description')) is-invalid @endif" id="description" value="{{old('description', $secondary->description)}}" name="description">
                                @includeWhen($errors->has('description'), 'components.error', ['error' => $errors->first('description')])
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="pitch_id">Piazzola</label>
                                <select class="selectpicker @if ($errors->has('pitch_id')) is-invalid @endif" name="pitch_id">
                                    @foreach($pitches as $pitch)
                                        <option value="{{old('pitch_id', $pitch->id)}}" @if(old('pitch_id', $secondary->pitch_id) == $pitch->id) selected="selected" @endif data-content="{!!$pitch->getInformation()!!}"></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="type_id">Tipo punto</label>
                                <select class="selectpicker" name="type_id">
                                    @foreach($types as $type)
                                        <option value="{{old('type_id', $type->id)}}" @if(old('type_id', $secondary->type_id) == $type->id) selected="selected" @endif data-content="{!!$type->getInformation()!!}"></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="latitude">Latitudine</label>
                                <input type="text" class="form-control" id="latitude" value="{{old('latitude', $secondary->latitude)}}" name="latitude" disabled="disabled">
                            </div>
                            <div class="col">
                                <label for="longitude">Longitudine</label>
                                <input type="text" class="form-control" id="longitude" value="{{old('longitude', $secondary->longitude)}}" name="longitude" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="active" name="active" @if(old('active', $secondary->active)) checked="checked" @endif>
                                    <label class="custom-control-label" for="active">Visibile</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <button class="btn btn-success btn-block" type="submit"><i class="fas fa-edit"></i> MODIFICA</button>
                            </div>
                        </div>
                    </form>
                    <div id="map" class="map">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
<script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>
<script src="https://unpkg.com/ol-layerswitcher@3.0.0"></script>

<script type="text/javascript">
    function deleteItem(e) {
        e.preventDefault();
        if (confirm("Sei sicuro di voler procedere con l'eliminazione? L'opzione è irreversibile")) {
            document.getElementById('delete-form').submit();
        }
        return false;
    }
    $('.custom-file-input').on('input', function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    $('select').selectpicker({
        liveSearch: true,
        liveSearchNormalize: true,
        width: '100%',
        style: 'custom-bootstrap-select'
    });
</script>
<script type="text/javascript">
    var points = [];
    var point = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([parseFloat("{{$secondary->longitude}}"), parseFloat("{{$secondary->latitude}}")])),
    });
    point.setStyle(new ol.style.Style({
        image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
            color: '#e2001a',
            crossOrigin: 'anonymous',
            src: 'https://openlayers.org/en/v4.6.5/examples/data/dot.png'
        }))
    }));
    points.push(point);

    var pointsLayer = new ol.layer.Vector({
        title: 'Punto',
        source: new ol.source.Vector({
            features: points
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
                  pointsLayer, 
                ]
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([parseFloat("{{$secondary->longitude}}"), parseFloat("{{$secondary->latitude}}")]),
            zoom: 8
        })
    });
    </script>
@endsection
