@extends('layouts.main')

@section('content')
<h1>MIS UNIDADES</h1>
<div class="form-group row">
	<div class="panel panel-primary">
  		<div class="panel-heading">Listado de Unidades</div>
  		<div class="panel-body">
  		@isset($usu)
			@if($usu->fecha_licencia==null OR $usu->fecha_licencia<=date('Y-m-d') )
				@php $control_licencia=true; @endphp
			@else
				@php $control_licencia=false; @endphp  
			@endif
			@if($usu->fecha_licencia!=null)
				@php $fecha_aviso = strtotime('-60 day',strtotime($usu->fecha_licencia)); @endphp
				@php $fecha_aviso = date('Y-m-d',$fecha_aviso); @endphp
				@if($fecha_aviso<=date('Y-m-d'))
					@php $control_aviso=true; @endphp
				@else
					@php $control_aviso=false; @endphp
				@endif
			@endif
		@if($control_licencia)
		<div class="col-md-12">
			<div class="alert alert-danger">
		  		<strong>Atencion!</strong> Su licencia esta Vencida o no Esta registrada.
			</div>
		</div>
		@endif
		@if($control_aviso)
		<div class="col-md-12">
			<div class="alert alert-warning">
		  		<strong>Atencion!</strong> Su licencia esta por Vencer.
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
	</div>	
</div>

@endsection
