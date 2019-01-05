@extends('layouts.main')

@section('content')

<div class="form-group row">
	<div class="col-md-12">
		<form method="GET" action="{{ route('usuarios.index') }}" class="navbar_form pull-right">
			<div class="col-md-1">
				<a href="{{ route('usuarios.create') }}" class="btn btn-info" role="button">Nuevo Usuario</a>
			</div>
			<div class="col-md-3 pull-right">
				<div class="input-group">
					<input type="text" class="form-control" name="q" placeholder="Buscar usuario por nombre" autocomplete="off">
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
  		<div class="panel-heading">Listado de Usuarios</div>
  		<div class="panel-body">
	  		<table class="table">
				<thead>
					<tr>
						<th>RUN</th>
						<th>NOMBRE</th>
						<th class="hidden-xs">CARGO</th>
						<th class="hidden-xs">DOTACION</th>
						<th style="width: 100px;">ACCION</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($usu as $row)
					<tr>
						<td> {{ $row->runCompleto() }} </td>
						<td>{{ $row->nombreSimple() }} 
							<span class="hidden-lg hidden-md"><br>({{ $row->cargo->nombre }})</span> 
						</td>
						<td class="hidden-xs">{{ $row->cargo->nombre }}  </td>
						<td class="hidden-xs">{{ $row->cia->nombreCompleto() }}  </td>
						<td>
						<a href="{{ route('usuarios.roles',$row->id) }}" 
							class="btn btn-warning justify-content-center">
		                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
		                </a>
						<a href="{{ route('usuarios.edit',$row->id) }}" class="btn btn-success justify-content-center">
		                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		                </a>
		                <a href="{{ route('home.reporte',$row->id) }}" class="btn btn-info justify-content-center">
		                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		                </a>
		                 <a href="{{ route('usuarios.especialidad',$row->id) }}" class="btn btn-primary justify-content-center">
		                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
		                </a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $usu->render() }}		
  		</div>
		</div>
	</div>
</div>

@endsection