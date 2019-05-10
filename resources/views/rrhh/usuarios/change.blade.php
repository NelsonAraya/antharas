@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('nuevaPassword') }}">
	{{ csrf_field() }}
	<div class="panel panel-primary">
	<div class="panel-heading">Cambio Contraseña</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-4">
					<label for="pass">CONTRASEÑA ACTUAL</label>
					<input id="pass" type="password" name="password" class="form-control" autocomplete="off" autofocus>
				</div>
				<div class="col-md-4">
					<label for="pas1">NUEVA CONTRASEÑA</label>
					<input id="pass1" type="password" name="nueva_password" class="form-control" autocomplete="off" minlength="6" maxlength="12">
				</div>
				<div class="col-md-4">
					<label for="pass2">REPETIR NUEVA CONTRASEÑA</label>
					<input id="pass2" type="password" name="nueva_password2" class="form-control" autocomplete="off" minlength="6" maxlength="12">
				</div>
			</div>
			
			<div class="form-group row">
				
				<div class="col-md-1">
					<label for="">Guardar</label>
					<button type="submit" class="btn btn-success">Guardar Contraseña</button>
				</div>
			</div>
		</div>		
	</div>
</form>

@endsection