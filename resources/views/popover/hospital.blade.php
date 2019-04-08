<h5>{{$hospital->name}}</h5>
<p>
	Tipologia: <strong>Ospedale</strong>
	<br>Codice: <strong>{{$hospital->code}}</strong>
	@if ($hospital->pitch)
		<br>Piazzola: <strong>{{$hospital->pitch}}</strong>
	@endif
	@if ($hospital->hub)
		<br>Hub: <strong>{{$hospital->hub}}</strong>
	@endif
	<br>Provincia: <strong>{{$hospital->province}}</strong>
</p>