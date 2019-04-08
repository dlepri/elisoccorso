@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <span class="h2"><i class="fas fa-map-marked-alt"></i> <strong>LISTA PUNTI</strong></span>
                </div>
                <div class="card-body">
                    {!! laraflash()->render() !!}
                	<table id="secondaries" class="table table-hover table-bordered table-condensed">
                		<thead>
                			<tr>
                				<th>PIAZZOLA</th>
                				<th>TIPO</th>
                				<th>NOME</th>
                				<th>DATA INSERIMENTO</th>
                				<th></th>
                				<th class="no-search no-sort"></th>
                			</tr>
                		</thead>
                		<tbody>
                			@foreach($secondaries as $secondary)
                			<tr>
                				<td>{{$secondary->pitch->name}}</td>
                				<td>{{$secondary->type->name}}</td>
                				<td>{{$secondary->name}}</td>
                				<td data-order="{{$secondary->created_at->format('YmdHis')}}">{{$secondary->created_at->format('d/m/Y H:i:s')}}</td>
            					@if ($secondary->active)
	            					<td data-search="visibile" data-order="0">
	            						<i class="fas fa-circle fa-2x text-success"></i>
	            					</td>
            					@else
	            					<td data-search="nascosta" data-order="1">
            							<i class="fas fa-circle fa-2x text-danger"></i>
	            					</td>
            					@endif
                				<td><a href="{{route('secondaries.edit', $secondary->id)}}"><i class="fas fa-edit fa-2x"></i></a></td>
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

	$('#secondaries').dataTable({
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
