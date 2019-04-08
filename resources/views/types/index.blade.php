@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <span class="h2"><i class="fas fa-list"></i> <strong>LISTA TIPI</strong></span>
                    <a href="{{route('types.create')}}" class="btn btn-primary  float-right"><i class="fas fa-plus"></i> AGGIUNGI</a>
                </div>
                <div class="card-body">
                    {!! laraflash()->render() !!}
                	<table id="types" class="table table-hover table-bordered table-condensed">
                		<thead>
                			<tr>
                				<th>NOME</th>
                				<th class="no-search no-sort"></th>
                			</tr>
                		</thead>
                		<tbody>
                			@foreach($types as $type)
                			<tr>
                				<td data-search="{{$type->name}}" data-order="{{$type->name}}"><img height="30" src="{{asset('storage/'.$type->icon)}}"> {{$type->name}}</td>
                				<td class="text-center"><a href="{{route('types.edit', $type->id)}}"><i class="fas fa-edit fa-2x"></i></a></td>
                			</tr>
                			@endforeach
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript">

	$('#types').dataTable({
		language: {
            lengthMenu: "Mostro _MENU_ risultati per pagina",
            zeroRecords: "Nessun risultato disponibile",
            info: "Mostro pagina _PAGE_ di _PAGES_",
            infoEmpty: "Nessun risultato trovato",
            infoFiltered: "(filtrati da _MAX_ risultati totali)",
            loadingRecords: "Carico risultati...",
		    processing:     "Carico risultati...",
		    search:         "Cerca :",
		    paginate: {
		        first:      "Inizio",
		        last:       "Fine",
		        next:       "Successivo",
		        previous:   "Precedente"
		    },
        },
		columnDefs: [
		  { targets: 'no-sort', orderable: false },
		  { targets: 'no-search', searchable: false },
		]
	});
</script>
@endsection
