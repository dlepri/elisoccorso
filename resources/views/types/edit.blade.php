@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <span class="h2"><i class="fas fa-edit"></i> <strong>MODIFICA TIPO</strong></span>
                    <form id="delete-form" method="POST" action="{{route('types.destroy', $type->id)}}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="javascript:;" onclick="javascript: deleteItem(event)" class="btn btn-danger float-right"><i class="fas fa-trash-alt"></i> ELIMINA</a>
                    <a href="{{route('types.index')}}" class="btn btn-primary float-left"><i class="fas fa-arrow-left"></i> INDIETRO</a>
                </div>
                <div class="card-body">
                    {!! laraflash()->render() !!}
                    <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" action="{{route('types.update', $type->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="name">Tipo</label>
                                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name" placeholder="Es: Altro" value="{{old('name', $type->name)}}" name="name">
                                @includeWhen($errors->has('name'), 'components.error', ['error' => $errors->first('name')])
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @if ($errors->has('icon')) is-invalid @endif" id="icon" name="icon">
                                    <label class="custom-file-label" for="icon">Sostituisci immagine (formato: png)</label>
                                    @includeWhen($errors->has('icon'), 'components.error', ['error' => $errors->first('icon')])
                                  </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label>Icona attuale:</label>
                                <img height="30" src="{{asset('storage/'.$type->icon)}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-success btn-block" type="submit"><i class="fas fa-edit"></i> MODIFICA</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
    })
</script>
@endsection
