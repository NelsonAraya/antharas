@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('emergencia.store') }}">
	{{ csrf_field() }}
	<div class="panel panel-primary">
	<div class="panel-heading">Crear Emergencia</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="fecha">FECHA</label>
					<input type="date" id="fecha" name="fecha_emergencia" class="form-control">
				</div>
				<div class="col-md-2">
					<label for="hora">HORA</label>
					<input type="time" id="hora" name="hora_emergencia" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-5">
					<label for="dire">DIRECCION</label>
					<input id="dire" name="direccion" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-3">
					<label for="clave">CLAVE</label>
					<select id="clave" name="clave_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($clave as $key => $value)
							<option value="{{ $key }}"> {{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="cias">COMPAÑIAS</label>
					<select id="cias" data-placeholder="Seleccione Compañias" name="cias[]" multiple 
					class=" form-control chosen-select">
						@foreach($cia as $key => $value)
							@if($key != 11)
								<option  value="{{ $key }}"> {{ $value }}</option>
							@endif	
						@endforeach
					</select>
				</div>	
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="uni">UNIDADES</label>
					<select id="uni" data-placeholder="Seleccione Unidades" name="uni[]" multiple 
					class="form-control chosen-select">
						@foreach($veh as $row)
								<option  value="{{ $row->id }}"> {{ $row->clave }}</option>
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
@section('js')
<script>
	$("#cias").chosen({
		max_selected_options: 9,
		width: "100%"

	}); 
	$("#uni").chosen({
		width: "100%"

	}); 
</script>
@endsection