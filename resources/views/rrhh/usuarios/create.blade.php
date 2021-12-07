@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('usuarios.store') }}">
	{{ csrf_field() }}
	<div class="panel panel-primary">
	<div class="panel-heading">Crear Usuario</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="run">RUN</label>
					<input id="run" name="run" class="form-control" autocomplete="off" autofocus>
				</div>
				<div class="col-md-1">
					<label for="rol">ROL</label>
					<input id="rol" name="rol" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-3">
					<label for="nombres">NOMBRES</label>
					<input id="nombres" name="nombres" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="paterno">PATERNO</label>
					<input id="paterno" name="apellidop" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="materno">MATERNO</label>
					<input id="materno" name="apellidom" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="nacimiento">NACIMIENTO</label>
					<input type="date" name="fecha_nacimiento" id="nacimiento" class="form-control">	
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-3">
					<label for="cia">DOTACION</label>
					<select id="cia" name="cia_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cia as $key => $value)
							<option value="{{ $key }}"> {{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2">
					<label for="fono">TELEFONO</label>
					<input id="fono" name="telefono" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-4">
					<label for="dire">DIRECCION</label>
					<input id="dire" name="direccion" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-3">
					<label for="mail">EMAIL</label>
					<input id="mail" name="email" class="form-control" autocomplete="off">
				</div>				
			</div>
			<div class="form-group row">
				<div class="col-md-3">
					<label for="cargo">CARGO</label>
					<select id="cargo" name="cargo_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cargo as $key => $value)
							<option value="{{ $key }}"> {{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2">
					<label>CONDUCTOR</label>
					<br>
					<label class="radio-inline"><input type="radio" name="conductor" value="si">SI</label>
					<label class="radio-inline"><input type="radio" name="conductor" value="no">NO</label>	
				</div>
				<div class="col-md-2">
					<label for="licencia">LICENCIA</label>
					<input type="date" name="fecha_licencia" id="licencia" class="form-control">	
				</div>
				<div class="col-md-2">
					<label for="ingreso">INGRESO CB</label>
					<input type="date" name="fecha_ingresocbi" id="ingreso" class="form-control">	
				</div>
				<div class="col-md-2">
					<label for="operativo">OPERATIVO</label>
					<select id="operativo" name="operativo" class="form-control">
						<option value="">--Seleccione--</option>
						<option value="S">OPERATIVO</option>
						<option value="N">NO OPERATIVO</option>
					</select>	
				</div>
				<div class="col-md-2">
					<label for="sanguineo">GRUPO SANGUINEO</label>
					<select id="sanguineo" name="sanguineo_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($grupo as $key => $value)
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