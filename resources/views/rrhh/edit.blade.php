@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('usuarios.store') }}">
	{{ csrf_field() }}
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
			</div>
			<div class="form-group row">
				<div class="col-md-3">
					<label for="cia">DOTACION</label>
					<select id="cia" name="cia_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cia as $key => $value)
							@if($usu->cia_id== $key)
								<option value="{{ $key }}" selected> {{ $value }}</option>
							@endif
								<option value="{{ $key }}"> {{ $value }}</option>
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
					<label class="radio-inline"><input type="radio" name="conductor">SI</label>
					<label class="radio-inline"><input type="radio" name="conductor">NO</label>	
				</div>			
				<div class="col-md-1">
					<label for="">Modificar</label>
					<button type="submit" class="btn btn-warning">Modificar</button>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection