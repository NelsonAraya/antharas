@extends('layouts.main')

@section('content')

<div class="form-group row">
<form method="GET" action="{{ route('especialidades.index') }}" class="navbar_form pull-right">
	<div class="col-md-1">
		<a href="{{ route('especialidades.create') }}" class="btn btn-info" role="button">Nueva Especialidad</a>
	</div>	
	<div class="col-md-3 pull-right">
		<div class="input-group">
			<input type="text" class="form-control" name="q" placeholder="Buscar Especialidad" autocomplete="off">
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
  		<div class="panel-heading">Listado de Especialidades</div>
  		<div class="panel-body">
	  	<table class="table">
			<thead>
				<tr>
					<th class="hidden-xs">DESCRIPCION</th>
					<th>ACCION</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($esp as $row)
				<tr>
					<td class="hidden-xs">{{ $row->descripcion }}  </td>
					<td>
					<a href="{{ route('especialidades.show',$row->id) }}" class="btn btn-info justify-content-center">
	                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
	                </a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $esp->render() }}	
  		</div>
	</div>
</div>

@endsection