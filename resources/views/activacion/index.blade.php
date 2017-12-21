@extends('layouts.main')

@section('content')
<h1>MIS UNIDADES</h1>
<div class="form-group row">
	@isset($usu)
		@if($usu->fecha_licencia==null OR $usu->fecha_licencia<=date('Y-m-d') )
			@php $control_licencia=true; @endphp
		@else
			@php $control_licencia=false; @endphp  
		@endif
		@if($control_licencia)
		<div class="col-md-12">
			<div class="alert alert-danger">
		  		<strong>Atencion!</strong> Su licencia esta Vencida o no Esta registrada.
			</div>
		</div>
		@endif	
		@foreach($usu->vehiculos as $row)
			@php $control=false; @endphp 
			@if($row->estado=='A')
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
				@isset ($rev)
					@foreach ($rev as $revision)
						@if($row->id == $revision['vehiculo_id'])
							@if($revision['fecha_vencimiento']<= date('Y-m-d'))
								@php $control=true; @endphp 
							@endif
						@endif
					@endforeach
				@endisset	
				<div class="col-md-3">
					<label for="conductor">{{ $row->clave }}</label>
					<input type="text" id="conductor" class="form-control" readonly="" value="{{ @$nom }}">
					<br>
					<a @if($row->activacion=='S' OR $control ==true OR $control_licencia == true)
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
					@if($control)
						<br><br>
						<div class="alert alert-warning">
		  					<strong>Atencion!</strong> Vehiculo con papeles vencidos.
						</div>
					@endif
				</div>
			@endif	
		@endforeach
	@endisset	
</div>

@endsection
