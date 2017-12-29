@extends('layouts.main')

@section('content')

<div class="form-group row">
<form method="GET" action="{{ route('claves.index') }}" class="navbar_form pull-right">
	<div class="col-md-1">
		<a href="{{ route('claves.create') }}" class="btn btn-info" role="button">Nueva Clave</a>
	</div>	
	<div class="col-md-3 pull-right">
		<div class="input-group">
			<input type="text" class="form-control" name="q" placeholder="Buscar Clave por Clave" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit">
			    	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</form>
</div>
<div class="form-group row">
	<div class="panel panel-primary">
  		<div class="panel-heading">Listado de Unidades</div>
  		<div class="panel-body">
	  	<table class="table">
			<thead>
				<tr>
					<th>CLAVE</th>
					<th class="hidden-xs">DESCRIPCION</th>
					<th>ACCION</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($cla as $row)
				<tr>
					<td> {{ $row->clave }} </td>
					<td class="hidden-xs">{{ $row->descripcion }}  </td>
					<td>
					<a href="{{ route('claves.edit',$row->id) }}" class="btn btn-warning justify-content-center">
	                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
	                </a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $cla->render() }}	
  		</div>
	</div>
</div>

@endsection