@extends('layouts.main')

@section('content')
<div class="form-group row">
	<div class="col-md-12">
		<form method="GET" action="{{ route('emergencia.showCantidad') }}" class="navbar_form pull-right">
			<div class="col-md-3 pull-right">
				<div class="input-group">
					<input type="text" class="form-control" name="q" placeholder="Ingresar Año" autocomplete="off">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit">
					    	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button>
					</span>
				</div>
		</div>
		</form>	
	</div>
</div>
<div class="form-group row">		
	<div class="col-md-12">
		<div class="panel panel-primary">
  		<div class="panel-heading">Cantidad de Emergencias x Claves Año : {{ @$_GET['q'] }}</div>
  		<div class="panel-body">
	  		<table class="table">
				<thead>
					<tr>
						<th>CLAVE</th>
						<th class="hidden-xs">DESCRIPCION </th>
						<th>CANTIDAD</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($clave as $row)
					<tr>
						<td>{{ $row->clave }}</td>
						<td>{{ $row->descripcion }}</td>
						<td>{{ $row->cantidad }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
  		</div>
		</div>
	</div>
</div>
@endsection