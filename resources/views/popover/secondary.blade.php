<h5>{{$secondary->name}}</h5>
<p>
	Tipologia: <strong>Secondario ({{$secondary->type->name}})</strong>
	@if ($secondary->pitch)
	<br>Piazzola: <strong>{{$secondary->pitch->name}}</strong>
	@endif
<p>{{$secondary->description}}</p>
<a target="_blank" href="{{route('secondaries.edit', $secondary->id)}}"><i class="fas fa-edit fa-lg fa-fw"></i> Modifica</a>