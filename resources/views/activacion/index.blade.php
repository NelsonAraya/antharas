@extends('layouts.main')

@section('content')
<h1>MIS UNIDADES</h1>
<div class="form-group row">
	@foreach($usu->vehiculos as $row)
			@php 
		  		$nom = "";
		  		$chofer="";
		  	@endphp
		@isset($conductor)
			@foreach($conductor as $con)
		  		@if($row->id == $con->vehiculo_id)
		  		@php 
		  			$nom = $con->usuario->nombreSimple();
		  			$chofer = $con->usuario->id;
		  		@endphp
		  			@break
		  		@endif
			@endforeach
		@endisset	
		<div class="col-md-3">
			<label for="conductor">{{ $row->clave }}</label>
			<input type="text" id="conductor" class="form-control" readonly="" value="{{ @$nom }}">
			<br>
			<a @if($row->activacion=='S')
					href="#"
					disabled
				@else	
			 		href="{{ route('activacion.vehiculo',[$usu->id,$row->id,'S']) }}" 
			 	@endif
			 		class="btn btn-success" role="button">Activar</a>
			<a  @if($row->activacion=='N' OR ($chofer!= Auth::user()->id))  
					href="#"
					disabled
				@else	 
					href="{{ route('activacion.vehiculo',[$usu->id,$row->id,'N']) }}" 
				@endif
					class="btn btn-danger" role="button">Desactivar</a>
		</div>
	@endforeach
</div>

@endsection
