@extends('layouts.main')

@section('content')

<div class="form-group row">
<form method="GET" action="{{ route('material_mayor.index') }}" class="navbar_form pull-right">
	<div class="col-md-1">
		<a href="{{ route('material_mayor.create') }}" class="btn btn-info" role="button">Nuevo Vehiculo</a>
	</div>	
	<div class="col-md-3 pull-right">
		<div class="input-group">
			<input type="text" class="form-control" name="q" placeholder="Buscar Unidad por Clave" autocomplete="off">
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
					<th>PATENTE</th>
					<th>CLAVE</th>
					<th class="hidden-xs">MODELO</th>
					<th class="hidden-xs">MARCA</th>
					<th class="hidden-xs">CIA ASIGNADA</th>
					<th>ESTADO</th>
					<th>ACCION</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($veh as $row)
				<tr>
					<td> {{ $row->patente }} </td>
					<td>{{ $row->clave }}  </td>
					<td class="hidden-xs">{{ $row->modelo }}  </td>
					<td class="hidden-xs">{{ $row->marca }}  </td>
					<td class="hidden-xs"> {{ $row->cia->nombreCompleto() }} </td>
					<td> @if($row->estado=='A')Activo @else Inactivo @endif </td>
					<td>
					<a href="{{ route('material_mayor.edit',$row->getHashId()) }}" class="btn btn-warning justify-content-center">
	                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
	                </a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $veh->render() }}	
  		</div>
	</div>
</div>

@endsection