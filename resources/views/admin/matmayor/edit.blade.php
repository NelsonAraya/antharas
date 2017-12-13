@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('material_mayor.update',$veh->id) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">EDITAR INFORMACION MATERIAL MAYOR</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="patente">PATENTE</label>
					<input id="patente" name="patente" class="form-control" autocomplete="off" autofocus value="{{ $veh->patente }}">
				</div>
				<div class="col-md-1">
					<label for="clave">CLAVE</label>
					<input id="clave" name="clave" class="form-control" autocomplete="off" 
					value="{{ $veh->clave }}">
				</div>
				<div class="col-md-2">
					<label for="modelo">MODELO</label>
					<input id="modelo" name="modelo" class="form-control" autocomplete="off"
					value="{{ $veh->modelo }}">
				</div>
				<div class="col-md-2">
					<label for="marca">MARCA</label>
					<input id="marca" name="marca" class="form-control" autocomplete="off"
					value="{{ $veh->marca }}">
				</div>
				<div class="col-md-1">
					<label for="anio">AÑO</label>
					<input id="anio" name="anio" class="form-control" autocomplete="off"
					value="{{ $veh->anio }}">
				</div>
				<div class="col-md-3">
					<label for="cia">DOTACION</label>
					<select id="cia" name="cia_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cia as $key => $value)
							@if($veh->cia_id==$key)
								<option value="{{ $key }}" selected> {{ $value }}</option>
							@else
								<option value="{{ $key }}"> {{ $value }}</option>
							@endif
						@endforeach
					</select>
				</div>		
			</div>
			<div class="form-group row">
				<div class="col-md-1">
					<label for="">Modificar</label>
					<button type="submit" class="btn btn-success">Modificar</button>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection