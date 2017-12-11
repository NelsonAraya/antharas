@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('conductores.update',$usu->id) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">LISTA MATERIAL MAYOR CBI</div>
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
				<div class="col-md-2">
					<label>CONDUCTOR</label>
					<br>
					<label class="radio-inline"><input type="radio" @if($usu->conductor=='S')
					checked  @endif name="conductor" value="si" >SI</label>
					<label class="radio-inline"><input type="radio" @if($usu->conductor=='N')
					checked  @endif name="conductor" value="no" >NO</label>	
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