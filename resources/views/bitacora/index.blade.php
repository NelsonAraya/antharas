@extends('layouts.main')

@section('content')

<div class="form-group row">
	<table class="table">
		<thead>
			<tr>
				<th>PATENTE</th>
				<th>CLAVE</th>
				<th class="hidden-xs">MODELO</th>
				<th class="hidden-xs">MARCA</th>
				<th class="hidden-xs">CIA ASIGNADA</th>
				<th class="">ESTADO</th>
				<th style="width: 100px;">ACCION</th>
			</tr>
		</thead>
		<tbody>
			@isset($usu)
				@foreach ($usu->vehiculos as $row)
				<tr>
					<td> {{ $row->patente }} </td>
					<td>{{ $row->clave }}  </td>
					<td class="hidden-xs">{{ $row->modelo }}  </td>
					<td class="hidden-xs">{{ $row->marca }}  </td>
					<td class="hidden-xs"> {{ $row->cia->nombreCompleto() }} </td>
					<td> @if($row->estado=='A')Activo @else Inactivo @endif </td>
					<td>
					<a href="{{ route('bitacora.show',$row->id) }}" 
						class="btn btn-success justify-content-center">
	                    <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
	                </a>
	               	<a href="{{ route('bitacora.ver',$row->id) }}" 
						class="btn btn-info justify-content-center">
	                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
	                </a>
					</td>
				</tr>
				@endforeach
			@endisset
			@isset($veh)
				@foreach ($veh as $row)
				<tr>
					<td> {{ $row->patente }} </td>
					<td>{{ $row->clave }}  </td>
					<td class="hidden-xs">{{ $row->modelo }}  </td>
					<td class="hidden-xs">{{ $row->marca }}  </td>
					<td class="hidden-xs"> {{ $row->cia->nombreCompleto() }} </td>
					<td> @if($row->estado=='A')Activo @else Inactivo @endif </td>
					<td>
					<a href="{{ route('bitacora.show',$row->id) }}" 
						class="btn btn-success justify-content-center">
	                    <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
	                </a>
	                <a href="{{ route('bitacora.ver',$row->id) }}" 
						class="btn btn-info justify-content-center">
	                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
	                </a>
					</td>
				</tr>
				@endforeach
			@endisset
		</tbody>
	</table>	
</div>

@endsection