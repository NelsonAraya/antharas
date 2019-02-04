@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('usuarios.update',$usu->getHashId()) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">Editar Usuario</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="run">RUN</label>
					<input id="run" name="run" class="form-control" autocomplete="off" 
					value="{{ $usu->id.$usu->dv }}" autofocus>
				</div>
				<div class="col-md-1">
					<label for="rol">ROL</label>
					<input id="rol" name="rol" class="form-control" autocomplete="off" 
					value="{{ $usu->rol }}">
				</div>
				<div class="col-md-3">
					<label for="nombres">NOMBRES</label>
					<input id="nombres" name="nombres" class="form-control" autocomplete="off"
					value="{{ $usu->nombres }}">
				</div>
				<div class="col-md-2">
					<label for="paterno">PATERNO</label>
					<input id="paterno" name="apellidop" class="form-control" autocomplete="off"
					value="{{ $usu->apellidop }}">
				</div>
				<div class="col-md-2">
					<label for="materno">MATERNO</label>
					<input id="materno" name="apellidom" class="form-control" autocomplete="off"
					value="{{ $usu->apellidom }}">
				</div>
				<div class="col-md-2">
					<label for="nacimiento">NACIMIENTO</label>
					<input type="date" id="nacimiento" name="fecha_nacimiento" class="form-control"
					value="{{ $usu->fecha_nacimiento }}">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-3">
					<label for="cia">DOTACION</label>
					<select id="cia" name="cia_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cia as $key => $value)
							@if($usu->cia_id== $key)
								<option value="{{ $key }}" selected> {{ $value }}</option>
							@else
								<option value="{{ $key }}"> {{ $value }}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="col-md-2">
					<label for="fono">TELEFONO</label>
					<input id="fono" name="telefono" class="form-control" autocomplete="off"
					value="{{ $usu->telefono }}">
				</div>
				<div class="col-md-4">
					<label for="dire">DIRECCION</label>
					<input id="dire" name="direccion" class="form-control" autocomplete="off"
					value="{{ $usu->direccion }}">
				</div>
				<div class="col-md-3">
					<label for="mail">EMAIL</label>
					<input id="mail" name="email" class="form-control" autocomplete="off"
					value="{{ $usu->email }}">
				</div>				
			</div>
			<div class="form-group row">
				<div class="col-md-3">
					<label for="cargo">CARGO</label>
					<select id="cargo" name="cargo_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cargo as $key => $value)
							@if($usu->cargo_id== $key)
								<option value="{{ $key }}" selected> {{ $value }}</option>
							@endif
							<option value="{{ $key }}"> {{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2">
					<label>CONDUCTOR</label>
					<br>
					<label class="radio-inline"><input type="radio" @if($usu->conductor=='S')
					checked  @endif name="conductor" value="si" >SI</label>
					<label class="radio-inline"><input type="radio" @if($usu->conductor=='N')
					checked  @endif name="conductor" value="no" >NO</label>	
				</div>
				<div class="col-md-2">
					<label for="licencia">LICENCIA</label>
					<input type="date" id="licencia" name="fecha_licencia" class="form-control"
					value="{{ $usu->fecha_licencia }}">
				</div>
				<div class="col-md-2">
					<label for="ingreso">INGRESO CBI</label>
					<input type="date" id="ingreso" name="fecha_ingresocbi" class="form-control"
					value="{{ $usu->fecha_ingresocbi }}">
				</div>
				<div class="col-md-2">
					<label for="estado">ESTADO</label>
					<select id="estado" name="estado" class="form-control">
						<option value="">--Seleccione--</option>
						<option value="A" @if($usu->estado=='A') selected  @endif> Activo</option>
						<option value="I" @if($usu->estado=='I') selected  @endif> Inactivo</option>
					</select>
				</div>				
			</div>
			<div class="form-group row">
				<div class="col-md-2">
					<label for="operativo">OPERATIVO</label>
					<select id="operativo" name="operativo" class="form-control">
						<option value="">--Seleccione--</option>
						@if($usu->operativo=='S')
						<option value="S" selected>OPERATIVO</option>
						<option value="N">NO OPERATIVO</option>
						@else
						<option value="S">OPERATIVO</option>
						<option value="N" selected>NO OPERATIVO</option>
						@endif
					</select>
				</div>
				<div class="col-md-2">
					<label for="sanguineo">GRUPO SANGUINEO</label>
					<select id="sanguineo" name="sanguineo_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($grupo as $key => $value)
							@if($usu->sanguineo_id== $key)
								<option value="{{ $key }}" selected> {{ $value }}</option>
							@endif
							<option value="{{ $key }}"> {{ $value }}</option>
						@endforeach
					</select>	
				</div>		
				<div class="col-md-1">
					<label for="">Modificar</label>
					<button type="submit" class="btn btn-warning">Modificar</button>
				</div>
				<div class="col-md-2">
					<label for="">Restablecer Password</label>
					<a href="{{ route('usuarios.restablecer',$usu->getHashId()) }}" class="btn btn-info" role="button">Restablecer</a>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection