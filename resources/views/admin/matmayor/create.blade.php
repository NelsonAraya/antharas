@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('material_mayor.store') }}">
	{{ csrf_field() }}
	<div class="panel panel-primary">
	<div class="panel-heading">Crear Material Mayor</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="patente">PATENTE</label>
					<input id="patente" name="patente" class="form-control" autocomplete="off" autofocus>
				</div>
				<div class="col-md-1">
					<label for="clave">CLAVE</label>
					<input id="clave" name="clave" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="modelo">MODELO</label>
					<input id="modelo" name="modelo" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="marca">MARCA</label>
					<input id="marca" name="marca" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-1">
					<label for="anio">AÑO</label>
					<input id="anio" name="anio" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-3">
					<label for="cia">DOTACION</label>
					<select id="cia" name="cia_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cia as $key => $value)
							<option value="{{ $key }}"> {{ $value }}</option>
						@endforeach
					</select>
				</div>		
			</div>
			<div class="form-group row">	
				<div class="col-md-1">
					<label for="">Registrar</label>
					<button type="submit" class="btn btn-success">Registrar</button>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection