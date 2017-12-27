@extends('layouts.main')

@section('content')
<div class="col-md-6">
	<form method="POST" action="{{ route('cia.busquedalista',Auth::user()->cia_id)}}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">Seleccione Rangos de Busqueda</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-4">
					<label for="inicio">INICIO</label>
					<input type="date" id="inicio" name="inicio" class="form-control">
				</div>
				<div class="col-md-4">
					<label for="termino">TERMINO</label>
					<input type="date" id="termino" name="termino" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2">
					<label for="anio">AÑO</label>
					<input type="text" id="anio" name="anio" class="form-control" placeholder="2017" autocomplete="off">
				</div>
				<div class="col-md-6">
					<label>SELECCIONE OPCION</label>
					<br>
					<label class="radio-inline"><input type="radio" name="tipo" value="1">Inicio / Ternino</label>
					<label class="radio-inline"><input type="radio" name="tipo" value="2">Solo Año</label>
				</div>
			</div>
			<div class="form-group row">		
				<div class="col-md-1">
					<label for="">Agregar</label>
					<button type="submit" id="btn_guardar" class="btn btn-success">Agregar</button>
				</div>
			</div>
		</div>		
	</div>
</form>
</div>
<div class="col-md-6">
	@isset($usu)
		<div class="panel panel-primary">
  		<div class="panel-heading">Lista de Usuarios EMERGENCIAS TOTALES : {{ $cantidad }}</div>
  			<div class="panel-body">
  				<table class="table">
  					<thead>
  						<tr>
  							<th>ROL</th>
  							<th>NOMBRE</th>
  							<th>ASISTIDO</th>
  							<th>PORCENTAJE</th>
  							<th>VER</th>
  						</tr>
  					</thead>
  					<tbody>
  						@foreach($usu as $row)
  							<tr>
  								<td>{{ $row->rol }}</td>
  								<td>{{ $row->nombreSimple() }}</td>
  								<td>{{ $row->asistido }}</td>
  								<td><b>{{ $row->porcentaje }}%</b></td>
  								<td>
  									<a  
										class="btn btn-success justify-content-center">
		                    		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		                			</a>
  								</td>
  							</tr>
  						@endforeach
  					</tbody>
  				</table>
  			</div>
		</div>
	@endisset
</div>
@endsection
