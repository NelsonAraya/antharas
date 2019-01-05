@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('especialidades.store') }}">
	{{ csrf_field() }}
	<div class="panel panel-primary">
	<div class="panel-heading">Crear Especialidades</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="clave">SIGLA ESPECIALIDAD</label>
					<input id="clave" name="clave" class="form-control" autocomplete="off" autofocus>
				</div>
				<div class="col-md-5">
					<label for="descripcion">NOMBRE ESPECIALIDAD</label>
					<input id="descripcion" name="descripcion" class="form-control" autocomplete="off">
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