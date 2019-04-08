<h5>{{$pitch->name}}</h5>
<p>
	Tipologia: <strong>Piazzola</strong>
	<br>Codice: <strong>{{$pitch->code}}</strong>
	@if ($pitch->locality)
		<br>Località: <strong>{{$pitch->locality}}</strong>
	@endif
	@if ($pitch->municipality)
		<br>Città: <strong>{{$pitch->municipality}}</strong>
	@endif
	@if ($pitch->province)
		<br>Provincia: <strong>{{$pitch->province}}</strong>
	@endif
</p>